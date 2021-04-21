$(function() {
  $('.cafestalleres').select2();

  $('#num_por_alojamiento .row').each(function(){
    if ($(this).find('.nombre').text().trim() != '') {
      $(this).addClass('border-list-top');
    }
  });

  $('#num_por_servicios .row').each(function(){
    if ($(this).find('.nombre').text().trim() != '') {
      $(this).addClass('border-list-top');
    }
  });

});
