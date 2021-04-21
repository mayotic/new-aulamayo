$(function() {
  $(document).on('xcrudafterrequest', function(event, container) {
    if (Xcrud.current_task === 'edit' || Xcrud.current_task === 'create') {
      $('input[name=c2VzaW9uZXNfZXZlbnRvLm5vbWJyZQ--]').val( getIdentificador() + ' • ' + getNombre() + ' • ' + getDescripcion() + ' • ' + getAutores() ).prop('readonly', true);
    }
  });
});

function getIdentificador() {
  return $('input[name=ZXZlbnRvcy5pZGVudGlmaWNhZG9y]').val();
}
function getNombre() {
  return $('input[name=ZXZlbnRvcy5ub21icmU-]').val();
}
function getDescripcion() {
  return $('<span>' + $('textarea[name=ZXZlbnRvcy5kZXNjcmlwY2lvbg--]').val() + '</span>').text();
}
function getAutores() {
  return $('<span>' + $('textarea[name=ZXZlbnRvcy5hdXRvcmVz]').val() + '</span>').text();
}
