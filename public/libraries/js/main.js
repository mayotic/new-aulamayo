$(function(){
    $('#logout').on('click', function (event) {
      event.preventDefault();
      $.get('/ajax/logout.php',
              {},
              function (data) {
                switch (data) {
                  case 'ok':
                    let redirect = '/login';
                    if (window.location.pathname.search('manager') != -1) {
                      redirect = '/manager/login';
                    }
                    window.location.href = redirect;
                    break;
                  case 'error':
                    alert('Ha habido un error al cerrar la sesion.');
                    break;
                  default:
                }
              }
      );
    });

    $('a.nav-link[href="/programa"]').addClass('programa').prepend('<i class="fas fa-file-download"></i>&nbsp;');

    if (typeof window.sitevars != 'undefined' && typeof window.sitevars.env != 'undefined' && window.sitevars.env == 'dev') {
      $('body').prepend('<div class="develop">Dev</div>');
    }

    // Hightlight parent menu option if child option selected
    $('#mysidebar ul > li.nav-item.dropdown').each(function (){
        var option = this;
        $(option).find('.dropdown-menu .dropdown-item').each(function () {
            let soption = this;
            if ($(soption).hasClass('active')) {
              $(option).addClass('active');
            }
        });
    });


    $('#canales_formativos').click(function() {

       if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
           && location.hostname == this.hostname) {

               var $target = $(this.hash);

               $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

               if ($target.length) {

                   var targetOffset = $target.offset().top;

                   $('html,body').animate({scrollTop: targetOffset}, 1000);

                   return false;

              }

         }

    });

    if (!localStorage.getItem("tresmeses")) {
      Swal.fire({
        type: 'info',
        title: '¡Bienvenidos a la nueva plataforma Aula Mayo!',
        html: 'Debe registrarse de nuevo para acceder a los cursos. <br/>Durante los próximos 3 meses, podrá acceder a su historial en <a href="https://www.antigua.aulamayo.com" target="_blank">https://www.antigua.aulamayo.com</a>',
        showConfirmButton: true
      })
      localStorage.setItem("tresmeses", 'viewed');
    }    

});




// jQuery extensions
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
$.setCookie = function (cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
$.getCookie = function (cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

$.fn.clickToggle = function(func1, func2) {
    var funcs = [func1, func2];
    this.data('toggleclicked', 0);
    this.click(function() {
        var data = $(this).data();
        var tc = data.toggleclicked;
        $.proxy(funcs[tc], this)();
        data.toggleclicked = (tc + 1) % 2;
    });
    return this;
};

$.fn.serializeToObj = function() {
    return this.serializeArray().reduce(function (output, value) {
      output[value.name] = value.value
      return output
    }, {});
};

/* Extends String object */
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

var Tools = {
    switchSidebar: function (sidebar, sb_class_remove, sb_class_add, content, content_class_remove, content_class_add) {
      $(sidebar).removeClass(sb_class_remove);
      $(content).removeClass(content_class_remove);
      $(sidebar).addClass(sb_class_add);
      $(content).addClass(content_class_add);
    },
    tmpl: function (data, template, wrapper = '{{content}}') {
    	let output = '', row = '';
    	for (var i in data) {
    		let keys = Object.keys(data[i]), row = template;
    		for (k in keys) {
    			row = row.replaceAll('{{' + keys[k] + '}}', data[i][keys[k]]);
    		}
    		output += row;
    	}
    	return wrapper.replace('{{content}}', output);
    },

    /* Front helpers */
    addPartialSpinner: function (node) {
    	$(node).addClass('loading-spinner').find('.courtain').addClass('overlay');
    },

    removePartialSpinner: function (node) {
    	$(node).removeClass('loading-spinner').find('.courtain').removeClass('overlay');
    },

    exportHTMLtoWORD: function (data) {
    	var title = (typeof data.title !== 'undefined') ? data.title : '';
    	var content = (typeof data.content !== 'undefined') ? data.content : '';
    	 var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
    				"xmlns:w='urn:schemas-microsoft-com:office:word' "+
    				"xmlns='http://www.w3.org/TR/REC-html40'>"+
    				"<head><meta charset='utf-8'><title>" + title + "</title></head><body>";
    	 var footer = "</body></html>";
    	 // var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
    	 var sourceHTML = header + content + footer;

    	 var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
    	 var fileDownload = document.createElement("a");
    	 document.body.appendChild(fileDownload);
    	 fileDownload.href = source;
    	 fileDownload.download = 'document.doc';
    	 // console.log(fileDownload); // Debug
    	 fileDownload.click();
    	 document.body.removeChild(fileDownload);
    },

    // charts
    buildCharts : function () {
        loadChartJsPhp();
        // Hide cero values from chart
        for (var chart in ChartJSPHP) {
          // ChartJSPHP.CasosClinicos.options.plugins.datalabels.formatter = [function];
          ChartJSPHP[chart].options.plugins.datalabels.display = function(context) {
              return context.dataset.data[context.dataIndex] != 0;
           }
          ChartJSPHP[chart].update();
        }
    },
    deployData: function (data) {
      // Deploy data
      for (var index in data) {
        // if ($('template.row[data-parent="#' + index + '"]').length > 0 && $('template.wrapper[data-parent="#' + index + '"]').length > 0) {

        if ($('#' + index).length > 0) {
            if ($('template[data-parent="#' + index + '"][data-template=row]') != undefined &&
                $('template[data-parent="#' + index + '"][data-template=wrapper]') != undefined) {
                  let output = Tools.tmpl(data[index],
                                          $('template[data-parent="#' + index + '"][data-template=row]').html(),
                                          $('template[data-parent="#' + index + '"][data-template=wrapper]').html());
              $('#' + index).html(output);
            }else{
              switch (typeof data[index]) {
                case 'object':
                  Tools.deployData(data[index]);
                  break;
                default:
                  if ($('#' + index).length !== 0) {
                    $('#' + index).html(data[index]);
                  }
                  break;
              }
            }
        }

      }
    },
    stringToNumber: function (string) {
      let strnumber = '';
      for (var i = 0; i < string.length; i++) {
        if (parseInt(string[i]) == string[i]) {
          strnumber += string[i];
        }
      }
      return parseInt(strnumber);
    },
    objToString: function (obj) {
      var str = '';
      for (var p in obj) {
          if (obj.hasOwnProperty(p)) {
              str += p + '::' + obj[p] + '\n';
          }
      }
      return str;
    },
    getPlatformInfo: function () {
      {
      var unknown = '-';

      // screen
      var screenSize = '';
      if (screen.width) {
          width = (screen.width) ? screen.width : '';
          height = (screen.height) ? screen.height : '';
          screenSize += '' + width + " x " + height;
      }

      //browser
      var nVer = navigator.appVersion;
      var nAgt = navigator.userAgent;
      var browser = navigator.appName;
      var version = '' + parseFloat(navigator.appVersion);
      var majorVersion = parseInt(navigator.appVersion, 10);
      var nameOffset, verOffset, ix;

      // Opera
      if ((verOffset = nAgt.indexOf('Opera')) != -1) {
          browser = 'Opera';
          version = nAgt.substring(verOffset + 6);
          if ((verOffset = nAgt.indexOf('Version')) != -1) {
          version = nAgt.substring(verOffset + 8);
          }
      }
      // MSIE
      else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {
          browser = 'Microsoft Internet Explorer';
          version = nAgt.substring(verOffset + 5);
      }
      // Chrome
      else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {
          browser = 'Chrome';
          version = nAgt.substring(verOffset + 7);
      }
      // Safari
      else if ((verOffset = nAgt.indexOf('Safari')) != -1) {
          browser = 'Safari';
          version = nAgt.substring(verOffset + 7);
          if ((verOffset = nAgt.indexOf('Version')) != -1) {
          version = nAgt.substring(verOffset + 8);
          }
      }
      // Firefox
      else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {
          browser = 'Firefox';
          version = nAgt.substring(verOffset + 8);
      }
      // MSIE 11+
      else if (nAgt.indexOf('Trident/') != -1) {
          browser = 'Microsoft Internet Explorer';
          version = nAgt.substring(nAgt.indexOf('rv:') + 3);
      }
      // Other browsers
      else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
          browser = nAgt.substring(nameOffset, verOffset);
          version = nAgt.substring(verOffset + 1);
          if (browser.toLowerCase() == browser.toUpperCase()) {
          browser = navigator.appName;
          }
      }
      // trim the version string
      if ((ix = version.indexOf(';')) != -1) version = version.substring(0, ix);
      if ((ix = version.indexOf(' ')) != -1) version = version.substring(0, ix);
      if ((ix = version.indexOf(')')) != -1) version = version.substring(0, ix);

      majorVersion = parseInt('' + version, 10);
      if (isNaN(majorVersion)) {
          version = '' + parseFloat(navigator.appVersion);
          majorVersion = parseInt(navigator.appVersion, 10);
      }

      // mobile version
      var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);

      // cookie
      var cookieEnabled = (navigator.cookieEnabled) ? true : false;

      if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {
          document.cookie = 'testcookie';
          cookieEnabled = (document.cookie.indexOf('testcookie') != -1) ? true : false;
      }

      // system
      var os = unknown;
      var clientStrings = [
          {s:'Windows 10', r:/(Windows 10.0|Windows NT 10.0)/},
          {s:'Windows 8.1', r:/(Windows 8.1|Windows NT 6.3)/},
          {s:'Windows 8', r:/(Windows 8|Windows NT 6.2)/},
          {s:'Windows 7', r:/(Windows 7|Windows NT 6.1)/},
          {s:'Windows Vista', r:/Windows NT 6.0/},
          {s:'Windows Server 2003', r:/Windows NT 5.2/},
          {s:'Windows XP', r:/(Windows NT 5.1|Windows XP)/},
          {s:'Windows 2000', r:/(Windows NT 5.0|Windows 2000)/},
          {s:'Windows ME', r:/(Win 9x 4.90|Windows ME)/},
          {s:'Windows 98', r:/(Windows 98|Win98)/},
          {s:'Windows 95', r:/(Windows 95|Win95|Windows_95)/},
          {s:'Windows NT 4.0', r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
          {s:'Windows CE', r:/Windows CE/},
          {s:'Windows 3.11', r:/Win16/},
          {s:'Android', r:/Android/},
          {s:'Open BSD', r:/OpenBSD/},
          {s:'Sun OS', r:/SunOS/},
          {s:'Linux', r:/(Linux|X11)/},
          {s:'iOS', r:/(iPhone|iPad|iPod)/},
          {s:'Mac OS X', r:/Mac OS X/},
          {s:'Mac OS', r:/(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
          {s:'QNX', r:/QNX/},
          {s:'UNIX', r:/UNIX/},
          {s:'BeOS', r:/BeOS/},
          {s:'OS/2', r:/OS\/2/},
          {s:'Search Bot', r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
      ];
      for (var id in clientStrings) {
          var cs = clientStrings[id];
          if (cs.r.test(nAgt)) {
          os = cs.s;
          break;
          }
      }

      var osVersion = unknown;

      if (/Windows/.test(os)) {
          osVersion = /Windows (.*)/.exec(os)[1];
          os = 'Windows';
      }

      switch (os) {
          case 'Mac OS X':
          osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];
          break;

          case 'Android':
          osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];
          break;

          case 'iOS':
          osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);
          osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);
          break;
      }

      var flashVersion = 'no check', d, fv = [];
      if (typeof navigator.plugins !== 'undefined' && typeof navigator.plugins["Shockwave Flash"] === "object") {
          d = navigator.plugins["Shockwave Flash"].description;
          if (d && !(typeof navigator.mimeTypes !== 'undefined' && navigator.mimeTypes["application/x-shockwave-flash"] && !navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)) { // navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin indicates whether plug-ins are enabled or disabled in Safari 3+
          d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
          fv[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
          fv[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
          fv[2] = /[a-zA-Z]/.test(d) ? parseInt(d.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0;
          }
      } else if (typeof window.ActiveXObject !== 'undefined') {
          try {
          var a = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
          if (a) { // a will return null when ActiveX is disabled
              d = a.GetVariable("$version");
              if (d) {
              d = d.split(" ")[1].split(",");
              fv = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
              }
          }
          }
          catch(e) {}
      }
      if (fv.length) {
          flashVersion = fv[0] + '.' + fv[1] + ' r' + fv[2];
      }
      }

      return {
        screen: screenSize,
        browser: browser,
        browserVersion: version,
        mobile: mobile,
        os: os,
        osVersion: osVersion,
        cookies: cookieEnabled,
        flashVersion: flashVersion
      }

  }

};




// Deploy of data when not ajax call
jQuery(function(){
  if (typeof window.tdata != 'undefined'){
    Tools.deployData(window.tdata);
  }
});


// Tweak for TinyMCE for allow edit HTML code from modal and for another fields in modal
$(document).on('focusin', function(e) {
      if ($(e.target).closest(".tox-textfield").length || $(e.target).closest(".tox-textarea").length) {
          e.stopImmediatePropagation();
      }
});
