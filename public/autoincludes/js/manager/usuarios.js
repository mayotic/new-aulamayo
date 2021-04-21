
// Init
$(function () {

    $('#change-pass').on('show.bs.modal', function (e){
      $('#change-pass input#pass').data('primary', $(e.relatedTarget).data('primary'));
    });

    $(document).on('click', 'a[data-action=certificado]', function (e) {

      var self = this;

      jQuery.ajax({
        url:'/ajax/get-certificado.php?usuario=' + $(this).data('usuario') + '&curso=' + $(this).data('curso'),
        cache:false,
        xhr: function() {
             var xhr = new XMLHttpRequest();
             xhr.onreadystatechange = function() {
                 if (xhr.readyState == 2) {
                     if (xhr.status == 200) {
                         xhr.responseType = "blob";
                     } else {
                         xhr.responseType = "json";
                     }
                 }
             };
             return xhr;
        },
        success: function(data){
               console.log(data);
               var blob = data;
               console.log(blob.size);
               var link=document.createElement('a');
               link.href=window.URL.createObjectURL(blob);
               link.download="certificado_" + $(self).data('curso') + '_' + $(self).data('usuario') + ".pdf";
               link.click();
        },
        error:function(response){
          alert(response);
        }
    });

    });

    $('#save-newpass').on('click', function () {
        $.ajax({
          type: "POST",
          url: '/ajax/change-pass.php',
          data: {id: $('input#pass').data('primary'), pass: $('input#pass').val()},
          success: function (data) {
            alert(data.message);
          },
          dataType: 'json'
        });
    });

});
