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
  let row, structure = [], output = '';

  $(node).find('option').each(function(){
    row = $(this).text().split('||');
    if ( row.length == 7 ) {
      let day = row[1],
          column = row[2] + ' - ' + row[4],
          value = row[0] + '||' + $(this).val() + '||' + $(this).prop('selected') + '||' + disponible($(this).val(), row[5], inscripciones) + '||' + row[6];
      if (typeof structure[day] === 'undefined'){
        structure[day] = [column];
      }else{
        structure[day].push(column) ;
      }
      if (typeof structure[day][column] === 'undefined'){
        structure[day][column] = [value];
      }else{
        structure[day][column].push(value);
      }
    }
  });

  for (var day in structure) {
    output += '<div class="optgroup-title" label="' + $.format.date(new Date(day), 'dd/MM/yyyy') + '"><h5 class="groups-title">' + $.format.date(new Date(day), 'dd/MM/yyyy') + '</h5></div>';
    output += htmlGroupedSelect(structure[day], node);
  }

  $(node).after('<div id="' + $(node).attr('name') + '" class="eventos">' + output + '</div>').hide();
  let field_name = $(node).attr('name');
  $(node).remove();

  // Control de selecteds
  $(document).on('click', 'div#' + field_name + ' input[type=checkbox]', function (e) {
    if ($(this).prop('checked')) {
      let parent = $(this).parent();

      $(parent).find('input').prop('checked', false);

      if (!eventSelected(this)) {
        let evento = $(this).data('event'), tipo = getTipoEvento(evento);
        if (getTipoEventoCount(evento) < window.etipo_max[tipo]){
          $(this).prop('checked', true);
        }
      }
    }
    // sincronizeSelect(this, node);
    sincronizeSelect('aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z', '#aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z');
  });
  // End control select

}

function getTipoEvento(evento) {
  return window.tipos_evento[evento]['id_tipo_evento'];
}

function getTipoEventoCount(evento) {
  let count = 0, tipo_current = getTipoEvento(evento);
  $('input[data-event]').each(function () {
    let tipo = getTipoEvento($(this).data('event'));
    if (tipo == tipo_current) {
      if($(this).prop('checked')){
        count++;
      }
    }
  });
  return count;
}

function htmlGroupedSelect(structure, node) {
  let output = '';

  let tipo_evento = '';
  for (var optgroup in structure) {

    if (!Array.isArray(structure[optgroup])) { continue; }
    let break_class = (tipo_evento != getTipoEvento(structure[optgroup][0].split('||')[4]) ? 'break' : '');
    output += '<div class="optgroup checkbox checkbox-primary ' + break_class + '" label="' + optgroup + '"><h6 class="group">' + optgroup + '</h6>';

    // Correct order for elements (Café 10 after Café 9)
    structure[optgroup].sort(function (a, b) {
      let splitter = ' ';

      a = Tools.stringToNumber(a.split(splitter)[1]);
      b = Tools.stringToNumber(b.split(splitter)[1]);

      if (a > b)
        return 1;
      if (a < b)
        return -1;
      // a must be equal to b
      return 0;
    });

    tipo_evento = getTipoEvento(structure[optgroup][0].split('||')[4]);

    let tipo_admin = '1';

    for (i=0; i < structure[optgroup].length; i++) {
        let litvalue = structure[optgroup][i].split('||');
        let literal = litvalue[0].split(' • ');
        output += '<input name="' + $(node).attr('name') + '" type="checkbox" data-type="checkboxes" class="magic-checkbox xcrud-input" data-event="' + litvalue[4] + '" value="' + litvalue[1] + '" ' + (litvalue[2] == 'true' ? ' checked' : '') + ((litvalue[3] == 'false' && window.user.tipo_inscrito != tipo_admin) ? ' disabled' : '') +  '><span class="input-label"><span class="identificador">' + literal[0] + (litvalue[3] == 'false' ? '<span class="plazas-agotadas"> (Plazas agotadas)</span>' : '') + '</span><span class="evento">' + literal[1] + '</span><span class="descripcion">' + literal[2] + '</span><span class="autores">' + literal[3] + '</span></span>';
    }
    output += '</div>';
  }
  return output;
}

function eventSelected (chbox) {
  var chbevent = $(chbox).data('event'), selected = false;
  $(chbox).parent().parent().find('input[type=checkbox]').each(function(){
    if (parseInt($(this).data('event')) == parseInt(chbevent) && $(this).prop('checked') == true) {
      selected = true;
    }
  });
  return selected;
}

function sincronizeSelect(selectname, checksparent) {
  $(checksparent).find('input').each(function(){
    $('select[name=' + selectname + '] option[value=' + $(this).val() + ']').prop('selected', $(this).prop('checked'));
  });

  // let value = $(input).val(),
  //     checked = $(input).prop('checked');
  //     console.log(checked); console.log(node);
  // if ( checked ) {
  //   $(node + ' option[value=' + value + ']').prop('selected', true);
  // }else{
  //   $(node + ' option[value=' + value + ']').prop('selected', false);
  // }
}

function disponible(id_sesion, plazas, inscripciones) {
  for (k=0; k < inscripciones.length; k++) {
    if (parseInt(inscripciones[k].id_sesion) == parseInt(id_sesion)) {
      if (parseInt(inscripciones[k].inscritos) < parseInt(plazas)) {
        return true;
      }else{
        return false;
      }
    }
  }
}

// Init
$(function () {

  $(document).on('xcrudafterrequest', function(event, container) {

    // Request the docs list
    if (Xcrud.current_task === 'edit') {
      // Set name on title
      let fullname = $('input[name=aW5zY3JpdG9zLm5vbWJyZQ--]').val() + ' ' + $('input[name=aW5zY3JpdG9zLmFwZWxsaWRvXzE-]').val() + ' ' +  $('input[name=aW5zY3JpdG9zLmFwZWxsaWRvXzI-]').val();
      if ($('.inscrito-title').length != 0) {
        $('.xcrud-ajax > h2 > i').after().remove();
      }
      $('.xcrud-ajax > h2 > i').after('<div class="inscrito-title">' + fullname  + '</div>');
      $('.dropzone-wrapper').show();
      var id_inscrito = $('input[name=primary]').val();
      getDocumentsList(id_inscrito);
      $('form#Documents input[name=id_inscrito]').val(id_inscrito);
    }else{
      // Unset name on title
      $('.xcrud-ajax > h2 > i').after().remove();
      $('.dropzone-wrapper').hide();
    }

    // Format the multiselect grouping hours intervals
    if (Xcrud.current_task === 'edit' || Xcrud.current_task === 'create') {

      // Remove the first option if only one option and "delegado" (to ensure the default values)
      if (window.user['tipo_inscrito'] == window.tipo_delegado) {
        $('select[name=aW5zY3JpdG9zLmlkX3RpcG9faW5zY3JpdG8-] option:first, select[name=aW5zY3JpdG9zLmlkX2dlcmVudGU-] option:first').remove();
      }

      $.get('/ajax/get-tipos_evento.php', '', function (tipose) {
        // Declare tipos_evento as global
        window.tipos_evento = tipose;
        $.get('/ajax/get-plazas.php', '', function (plazas) {
          groupedMultiSelect('select[name=aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z]', plazas);
        }, 'json');
      }, 'json');
    }

    // Extra info in titles and title sections
    if($('.leyenda-eventos').length == 0) {
      $('select[name=aW5zY3JpdG9zLlNlc2lvbiBldmVudG9z]').before('<span class="leyenda-eventos">Seleccione un máximo de tres cafes y cuatro talleres</span>');
    }

    //  Other tweaks
    $('select[name=aW5zY3JpdG9zLkFsb2phbWllbnRv] option:first, select[name=aW5zY3JpdG9zLlNlcnZpY2lvcw--] option:first').remove();

  });

  $(document).on('click', '.fileremove', function () {
    removeDocument($(this).data('inscrito'), $(this).data('filename'));
  });

  $('[data-task=csv]').remove();
  let delegado = ($.urlParam('delegado') != null ? '?delegado=' + $.urlParam('delegado') : '');
  $('<a href="/ajax/export-inscritos.php' + delegado + '" class="btn btn-light export-csv"><i class="fas fa-file"></i> Exportar a Excel</a>').insertAfter('[data-task=print]');
  // $('.export-csv').on('click', function() {
  //   $.get('/ajax/export-inscritos.php', '', function (plazas) {
  //   });
  // })

  // Change the behavior of selections in multiselect control:
  // 1) not necessari hit ctrl to select an option
  // 2) select / unselect on click
  $(document).on('mousedown', 'select[name=aW5zY3JpdG9zLkFsb2phbWllbnRv] option, select[name=aW5zY3JpdG9zLlNlcnZpY2lvcw--] option', function(e) {
      e.preventDefault();
      $(this).parent().focus();
      if ($(this).prop('selected')) {
        $(this).prop('selected', false);
      } else {
        $(this).prop('selected', true);
      }
      return false;
  });

  // Update of "alojamiento" price
  $(document).on('change', 'select[name="aW5zY3JpdG9fYWxvamFtaWVudG8uaWRfYWxvamFtaWVudG8-"]', function () {
    $.post('ajax/get-aloja-precio.php', {id: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9fYWxvamFtaWVudG8ucHJlY2lv"]').val(response);
    });
  });

  // Update of "servicio" price
  $(document).on('change', 'select[name="aW5zY3JpdG9fc2VydmljaW8uaWRfc2VydmljaW8-"]', function () {
    $.post('ajax/get-servicio-precio.php', {id: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9fc2VydmljaW8ucHJlY2lv"]').val(response);
    });
  });

  // Update of "transporte ida" price
  $(document).on('change', 'select[name="aW5zY3JpdG9zLmlkX21lZGlvX2lkYQ--"]', function () {
    $.post('ajax/get-tida-precio.php', {id: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9zLnByZWNpb19pZGE-"]').val(response);
    });
  });

  // Update of "transporte vuelta" price
  $(document).on('change', 'select[name="aW5zY3JpdG9zLmlkX21lZGlvX3Z1ZWx0YQ--"]', function () {
    $.post('ajax/get-tvuelta-precio.php', {id: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9zLnByZWNpb192dWVsdGE-"]').val(response);
    });
  });

  // Update of "Terminal llegada ida"
  $(document).on('change', 'select[name="aW5zY3JpdG9zLmlkX21lZGlvX2lkYQ--"]', function () {
    $.post('ajax/get_terminal.php', {id_ida: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9zLnRlcm1pbmFsX2xsZWdhZGFfaWRh"]').val(response['terminal_llegada_ida']);
    }, 'json');
  });

  // Update of "Terminales vuelta"
  $(document).on('change', 'select[name="aW5zY3JpdG9zLmlkX21lZGlvX3Z1ZWx0YQ--"]', function () {
    $.post('ajax/get_terminal.php', {id_vuelta: $(this).val()}, function (response) {
        $('input[name="aW5zY3JpdG9zLnRlcm1pbmFsX3NhbGlkYV92dWVsdGE-"]').val(response['terminal_salida_vuelta']);
        $('input[name="aW5zY3JpdG9zLnRlcm1pbmFsX2xsZWdhZGFfdnVlbHRh"]').val(response['terminal_llegada_vuelta']);
    }, 'json');
  });

  // $(document).on('click', '.xcrud-actions .edicion', function (e) {
  //   e.preventDefault;
  //   $('#editmodal iframe').attr('src', $(this).attr('href'));
  //   $('#editmodal').modal('show');
  //   return false;
  // })

});


// function groupedMultiSelect (node, inscripciones) {
//   let row, structure = [], output = '';
//
//   $(node).find('option').each(function(){
//     row = $(this).text().split('||');
//     if ( row.length == 6 ) {
//       let day = row[1],
//           column = row[2] + ' - ' + row[4],
//           value = row[0] + '||' + $(this).val() + '||' + $(this).prop('selected') + '||' + disponible($(this).val(), row[5], inscripciones);
//       if (typeof structure[day] === 'undefined'){
//         structure[day] = [column];
//       }else{
//         structure[day].push(column) ;
//       }
//       if (typeof structure[day][column] === 'undefined'){
//         structure[day][column] = [value];
//       }else{
//         structure[day][column].push(value);
//       }
//     }
//   });
//
//   for (var day in structure) {
//     output += '<optgroup class="optgroup-title" label="' + $.format.date(new Date(day), 'dd/MM/yyyy') + '"></optgroup>';
//       output += htmlGroupedSelect(structure[day])
//   }
//   $(node).html(output);
// }

// function htmlGroupedSelect(structure) {
//   let output = '';
//   for (var optgroup in structure) {
//     if (!Array.isArray(structure[optgroup])) { continue; }
//     output += '<optgroup label="' + optgroup + '">';
//     for (i=0; i < structure[optgroup].length; i++) {
//         let litvalue = structure[optgroup][i].split('||');
//         output += '<option value="' + litvalue[1] + '" ' + (litvalue[2] == 'true' ? ' selected' : '') + (litvalue[3] == 'false' ? ' disabled' : '') +  '>' + litvalue[0] + '</option>';
//     }
//     output += '</optgroup>';
//   }
//   return output;
// }
//
// function disponible(id_sesion, plazas, inscripciones) {
//   for (k=0; k < inscripciones.length; k++) {
//     if (parseInt(inscripciones[k].id_sesion) == parseInt(id_sesion)) {
//       if (parseInt(inscripciones[k].inscritos) < parseInt(plazas)) {
//         return true;
//       }else{
//         return false;
//       }
//     }
//   }
// }
//
// function eventSelected (option) {
//   var opttext = $(option).text(), selected = false;
//   $(option).parent().parent().find('option').each(function(){
//     if ($(this).text() == opttext && $(this).prop('selected') == true) {
//       selected = true;
//     }
//   });
//   return selected;
// }
