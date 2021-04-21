
$(document).ready(function(){

    selectCursos();

    $('#consulta').on('focus', function (event) {
        $( "#consulta" ).text( "" );
    });
    $('#consulta').on('focusout', function (event) {
        if( $( "#consulta" ).val() === '' ){
            $( "#consulta" ).text( "Su consulta*" );
        }
    });

    let currForm1 = document.getElementById('contact-form');
    // Validate on input:
    currForm1.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener(('input'), () => {
            if (input.checkValidity()) {
                input.classList.remove('is-invalid')
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid')
                input.classList.add('is-invalid');
            }

            var is_valid = $('.form-control').length === $('.form-control.is-valid').length;
            $("#submit_btn").attr("disabled", !is_valid);
        });
    });
    // Validate on textarea:
    currForm1.querySelectorAll('.form-control').forEach(textarea => {
        textarea.addEventListener(('textarea'), () => {
            if (textarea.checkValidity()) {
                textarea.classList.remove('is-invalid')
                textarea.classList.add('is-valid');
            } else {
                textarea.classList.remove('is-valid')
                textarea.classList.add('is-invalid');
            }
        });
    });

    $('button[type=submit]').on('click', function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/ajax/contacto-save.php",
            dataType: "json",
            data: {nombre: $('#nombre').val(), apellidos: $('#apellidos').val(), email: $('#email').val(), curso: $('#curso').val(), consulta: $('#consulta').val() },
            beforeSend: function(){
                            $('#submit_btn').attr('disabled','disabled');
                            $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;Enviando...');
                        },
            success: function (data) {
                if(data.status === 'ok'){
                    $("#msg").attr('class','alert alert-success text-center').html(data.message).show();
                    //$("#msg").attr('class','alert alert-success text-center').html('Su consulta se ha enviado correctamente, muchas gracias').show();
                    $("#contact-form")[0].reset();
                    $( "#consulta" ).text( "Su consulta*" );
                    $( "#nombre" ).removeClass( "is-valid" );
                    $( "#apellidos" ).removeClass( "is-valid" );
                    $( "#email" ).removeClass( "is-valid" );
                    $( "#curso" ).removeClass( "is-valid" );
                    $( "#consulta" ).removeClass( "is-valid" );
                    $('#submit_btn').html('Enviar');
                    $("#submit_btn").prop("disabled", true);
                    $('#msg').delay(4000).slideUp();
                }else{
                    var campo = data.campo;
                    if(campo === 'email'){
                        $('#email').focus();
                        $( "#email" ).removeClass( "is-valid" ).addClass( "is-invalid" );
                    }else{
                        $("#msg").attr('class','alert alert-danger text-center').html(data.message).show();
                    }
                    $('#submit_btn').html('Enviar');
                    $("#submit_btn").prop("disabled", false);
                    //$('#msg').delay(4000).slideUp();
                }
            }
        });
    });


    function selectCursos() {
        $.post(
            '/ajax/cursos-select.php',
            function (data) {
                //console.log(data);
                var totalcursos = data.totalcursos;
                var i;
                for (i = 0; i < totalcursos; i++) {
                    var sel = document.getElementById("curso");
                    var opt = document.createElement("option");
                    opt.value = data.cursos[i]['id_curso'];
                    opt.text = data.cursos[i]['nombre'];

                    sel.add(opt, sel.options[i]);
                }
            },
            'json'
        );
    }

});
