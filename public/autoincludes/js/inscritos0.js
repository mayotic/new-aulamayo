//  Functions
function getDocumentsList(inscrito){
  $.post('/ajax/list_docs.php', {'id_inscrito': inscrito}, function(data) {
    drawDocumentsList(data);
  });
}

function drawDocumentsList(list) {
  $('.docslist').html(list);
}

function removeDocument(doc, file) {
  $.post('/ajax/remove-file.php', {'id_inscrito': $('input[name=primary]').val(), file: file}, function(data) {
    if (data == 'ok'){
      getDocumentsList($('input[name=primary]').val());
    }
  });
}

function groupedMultiSelect (node, inscripciones) {
  let row, structure = [];

  $(node).find('option').each(function(){
    row = $(this).text().split('||');
    if ( row.length == 6 ) {
      let index = row[2] + ' - ' + row[4],
          value = row[0] + '||' + $(this).val() + '||' + $(this).prop('selected') + '||' + disponible($(this).val(), row[5], inscripciones);
      if (typeof structure[index] === 'undefined'){
        structure[index] = [value];
      }else{
        structure[index].push(value) ;
      }
    }
  });

  $(node).html(htmlGroupedSelect(structure));
}

function htmlGroupedSelect(structure) {
  let output = '';
  for (var optgroup in structure) {
    output += '<optgroup label="' + optgroup + '">';
    for (i=0; i < structure[optgroup].length; i++) {
        let litvalue = structure[optgroup][i].split('||');
        output += '<option value="' + litvalue[1] + '" ' + (litvalue[2] == 'true' ? ' selected' : '') + (litvalue[3] == 'false' ? ' disabled' : '') +  '>' + litvalue[0] + '</option>';
    }
    output += '</optgroup>';
  }
  return output;
}

function disponible(sesion_evento, plazas, inscripciones) {
  for (k=0; k < inscripciones.length; k++) {
    if (parseInt(inscripciones[k].id_sesion) == parseInt(sesion_evento)) {
      if (parseInt(inscripciones[k].inscritos) < parseInt(plazas)) {
        return true;
      }else{
        return false;
      }
    }
  }
}

function eventSelected (option) {
  var opttext = $(option).text(), selected = false;
  $(option).parent().parent().find('option').each(function(){
    if ($(this).text() == opttext && $(this).prop('selected') == true) {
      selected = true;
    }
  });
  return selected;
}

// init
$(function () {

  $(document).on('xcrudafterrequest', function(event, container) {

    // Request the docs list
    if (Xcrud.current_task === 'edit') {
      $('.dropzone-wrapper').show();
      var id_inscrito = $('input[name=primary]').val();
      getDocumentsList(id_inscrito);
      $('form#Documents input[name=id_inscrito]').val(id_inscrito);
    }else{
      $('.dropzone-wrapper').hide();
    }

    // Format the multiselect grouping hours intervals
    if (Xcrud.current_task === 'edit' || Xcrud.current_task === 'create') {
      $.get('/ajax/get-plazas.php', '', function (data) {
        groupedMultiSelect('select[name=aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z]', data);
      }, 'json');
    }

  });

  $(document).on('click', '.fileremove', function () {
    removeDocument($(this).data('inscrito'), $(this).data('filename'));
  });

  // Change the behavior of selections in multiselect control:
  // 1) not necessari hit ctrl to select an option
  // 2) select / unselect on click
  // 3) only can select one option per column
  $(document).on('mousedown', 'select[name=aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z] option', function(e) {
      e.preventDefault();
      if ($(this).prop('selected')) {
        $(this).prop('selected', false);
      } else {
        let parent = $(this).parent();
        $(parent).find('option').prop('selected', false);
        if (!eventSelected(this)) {
          $(this).prop('selected', true);
        }
      }
      return false;
  });

});
