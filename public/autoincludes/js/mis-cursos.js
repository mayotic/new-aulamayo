
$(document).ready(function(){

    $(".gridcursos").show();
    $(".rowcursos").hide();

    $("#gridview").click(function(){
        $("#gridview").attr("src", "/public/img/view_grid_on.png");
        $("#listview").attr("src", "/public/img/view_list_off.png");
        $(".gridcursos").show();
        $(".rowcursos").hide();
    });

    $("#listview").click(function(){
        $("#gridview").attr("src", "/public/img/view_grid_off.png");
        $("#listview").attr("src", "/public/img/view_list_on.png");
        $(".gridcursos").hide();
        $(".rowcursos").show();
        $("#split_country").hide();
    });

    //  Init
    $(document).on('click', '.certificate', function (e) {
      e.preventDefault();

window.open(location.protocol + '//' + location.hostname + '/ajax/get-certificado.php?curso=' + $(this).data('curso') + '&usuario=' + $(this).data('usuario'));

  //     $.ajax({
  //       url: '/ajax/get-certificado.php',
  //       type: 'GET',
  //       // dataType: 'binary',
  //       data: {curso: $(this).data('curso'), usuario: $(this).data('usuario')}
  //     })
  //     .done(function() {
  //       console.log("success");
  //     })
  //     .fail(function() {
  //       console.log("error");
  //     })
  //     .always(function(data){
  //       // var a = document.createElement('a');
  //       // var url = window.URL.createObjectURL(new Blob([data], {type: "application/pdf"}));
  //       // a.href = url;
  //       // a.download = 'certificado.pdf';
  //       // document.body.append(a);
  //       // a.click();
  //       // a.remove();
  //       // window.URL.revokeObjectURL(url);
  // });

    });

});


function showIdMoodle(id_moodle){
    var titulo = "Id Moodle: " + id_moodle;

    Swal.fire({
        title: titulo,
        text: "Accediendo al curso...",
        showConfirmButton: false,
        timer: 3000
    })
}

function descrgarCertificado(id_moodle){
    var titulo = "Id Moodle: " + id_moodle;

    Swal.fire({
        text: "Descargando Certificado del curso...",
        showConfirmButton: false,
        timer: 3000
    })
}
