(function($){
    $.find.selectors[":"].event = function(el, pos, match) {
        var search = (function(str){
            if (str.substring(0,2) === "on") {str = str.substring(2);}
            return str;
        })(String(match[3]).trim().toLowerCase());
        if (search) {
            var events = $._data(el, "events");
            return ((events && typeof events.search !== 'undefined') || el["on"+search]);
        }
        return false;
    };
})(jQuery);

jQuery.fn.getEvents = function() {
    if (typeof(jQuery._data) === 'function') {
        return jQuery._data(this.get(0), 'events') || {};
    }

    // jQuery version < 1.7.?
    if (typeof(this.data) === 'function') {
        return this.data('events') || {};
    }

    return {};
};

$.fn.subject = function(eventName, customEvent, action) {
    $('[data-action*="#' + $(this).attr('id') + ':"]').observe(customEvent, action);
    return this.on(eventName, function (e) {
      $(this).trigger(customEvent);
    });
};

$.fn.observe = function(customEvent, callback) {
    return $(this).sort(function (a, b) {
        let contentA, contentB;

        let valuesA = $(a).attr('data-action').split('|');
        for (let action in valuesA) {
          if (valuesA.hasOwnProperty(action)) {
            let action_parts = valuesA[action].split(':');
            if (action_parts[1] == customEvent) {
              contentA = parseInt(action_parts[3]);
            }
          }
        }

        let valuesB = $(b).attr('data-action').split('|');
        for (let action in valuesB) {
          if (valuesB.hasOwnProperty(action)) {
            let action_parts = valuesB[action].split(':');
            if (action_parts[1] == customEvent) {
              contentB = parseInt(action_parts[3]);
            }
          }
        }

        return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
      }).each(function(){
        var el = this;
        $(document).on(customEvent, el, function(e){
          if (typeof $(el).attr('data-action') !== 'undefined') {
            let actions = $(el).attr('data-action'), action;
            actions = actions.split('|');
            for (i in actions) {
              action = actions[i].split(':');
              if (action[0] == '#' + $(e.target).attr('id') && action[1] == customEvent) {
                 window.actions[action[2]](el, e);
              }else{
                callback(el, e);
              }
            }
          }else{
              callback(el, e);
          }
        })
    });
};

$.fn.getObservers = function(oEvent) {
    return $('[data-action*="#' + $(this).attr('id') + ':' + oEvent + '"]');
};

$.fn.getActiveObservers = function(oEvent) {
  var node_set = false;
  $.each($._data(document, 'events')[oEvent], function () {
    if (!node_set) {
      node_set = this.data;
    }else{
      node_set = $(node_set).add(this.data);
    }
  });
  return $(node_set).filter('[data-action*="#' + $(this).attr('id') + ':' + oEvent + '"]');
};

$.fn.stopObserve = function (observers, customEvent) {
   if (typeof observers !== 'undefined') {
    for (observer in observers) {
      $(document).undelegate(observer, customEvent);
    }
  }
};

$.fn.startObserve = function (observers, customEvent, action) {
   if (typeof observers !== 'undefined') {
     if (typeof $._data(document, 'events')[customEvent.type] === 'undefined'){
       $(observers).observe(customEvent.type, action);
     }else{
       $(document).delegate(observers, customEvent.type, actions[action]);
     }
   }
};

$(function () {
  if(typeof actions !== 'undefined' && typeof actions.init !== 'undefined') {
    actions.init();
  }
});


// var actions = {
//   init: function (observer, event) { console.log('Inicialitzat!!'); },
//   fet: function (observer, event) {
//     console.log(observer); console.log(event.target); },
//   fet2: function (observer, event) { console.log('funcio 2!!'); console.log(observer); console.log(event);},
//   fet3: function (observer, event) { console.log('funcio 3!!'); }
// };

// $(document).on('load', actions.init);
// $(document).subject('load', 'init', actions.init);

// $(function() {
  // $('#subject-1').subject('click', 'test', actions.fet);
  // console.log($('#subject-1').getObservers('test'));
// });
