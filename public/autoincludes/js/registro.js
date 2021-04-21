
(function () {  
    //'use strict';  
    window.addEventListener('load', function () {  
        
        // Get all form-groups in need of validation
        //var validateGroup = document.getElementsByClassName('validate-me');
        
        var form = document.getElementById('registro-form');  
        form.addEventListener('submit', function (event) {  
            if (form.checkValidity() === false) {  
                event.preventDefault();  
                event.stopPropagation(); 
            }else{  
                var sendForm = true;
                checkEmail(sendForm);
                //send_form();
                return false;
            }
            
            form.classList.add('was-validated'); 
            bsSelectValidation();
            
            
        }, false);  
    }, false);  
})(); 


$(document).ready(function(){
    
    $.ajax({
          type: "POST",
          url: '/ajax/profesiones-list.php',
          data: {},
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    });
    
    $.ajax({
          type: "POST",
          url: '/ajax/pais-list.php',
          data: {},
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    }).fail( function( data, jqXHR, textStatus, errorThrown ) {
        //console.log(data);
    });
    
    $('#pais-select').change(function(){
        recargarSelect('/ajax/provincias-list.php',  $('#pais').val());
    });
    
    $('#provincias-select').change(function(){
        recargarSelect('/ajax/localidades-list.php',  $('#provincia').val());
    });
    
    $('#profesiones-select').change(function(){
        recargarSelect('/ajax/especialidades-list.php',  $('#profesion').val());
    });
    
    $('#email').on('change', function() {
        var sendForm = false;
        checkEmail(sendForm);
        return false;
    });              
    
    
    // ----------- Set all elements as INVALID --------------
      var myInputElements = document.querySelectorAll(".form-control");
      var i;
      // ------------ Check passwords similarity --------------
      $('#password, #confirma_password').on('keyup', function () {
          
        var str = $('#password').val();
        var pswd = str.length;
        
        if( pswd == 8 || pswd > 8 ){
            $('#pswdValid').show();
            $('#pswdInvalid').hide();
            $('.myPwdClass').addClass('is-valid');
            $('.myPwdClass').removeClass('is-invalid');
        }else{
            $('#pswdValid').hide();
            $('#pswdInvalid').show();
            $('.myPwdClass').removeClass('is-valid');
            $('.myPwdClass').addClass('is-invalid');
        }
          
        if ($('#password').val() !== '' && $('#confirma_password').val() !== '' && $('#password').val() === $('#confirma_password').val() ) {
          $('#cPwdValid').show();
          $('#cPwdInvalid').html('Las contraseñas coinciden').css('color', 'green');
          $('.myCpwdClass').addClass('is-valid');
          $('.myCpwdClass').removeClass('is-invalid');
          for (i = 0; i < myInputElements.length; i++) {
            var myElement = document.getElementById(myInputElements[i].id);
            if (myElement.classList.contains('is-invalid')) {
              break;
            }
          }
        } else {
          $('#cPwdValid').hide();
          $('#cPwdInvalid').show();
          $('#cPwdInvalid').html('Las contraseñas no coinciden').css('color', 'red');
          $('.myCpwdClass').removeClass('is-valid');
          $('.myCpwdClass').addClass('is-invalid');
        }
      });
});

function recargarSelect(url, valor){
    $.ajax({
          type: "POST",
          url: url,
          data: {filter:valor},
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    });
}

 
$('#registro-form').change(bsSelectValidation);
    
function bsSelectValidation() {
    if ($("#registro-form").hasClass('was-validated')) {
        $(".selectpicker").each(function (i, el) {
            if ($(el).is(":invalid")) {
                $(el).closest(".form-group").find(".valid-feedback").removeClass("d-block");
                $(el).closest(".form-group").find(".invalid-feedback").addClass("d-block");
            } else {
                $(el).closest(".form-group").find(".invalid-feedback").removeClass("d-block");
                $(el).closest(".form-group").find(".valid-feedback").addClass("d-block");
            }
        });
    }
}

function send_form() {
    
    array_checked = [];
    array_no_checked = [];
    var InputElements = document.querySelectorAll(".check_curso");
    var i;
    var id_texto_legal = '';

    for (i = 0; i < InputElements.length; i++) {
        if( InputElements[i].checked ){
            id_texto_legal = InputElements[i].dataset.idtextolegal;
            array_checked.push(id_texto_legal);
        }else{
            id_texto_legal = InputElements[i].dataset.idtextolegal;
            array_no_checked.push(id_texto_legal);
        }
    }
    //console.log(array_checked);
    //console.log(array_no_checked);    
    
    $.ajax({
        type: "POST",
        url: "/ajax/registro-save.php",
        dataType: "json",
        data: {nombre: $('#nombre').val(), apellido1: $('#apellido1').val(), apellido2: $('#apellido2').val(), dni_nie: $('#dni_nie').val(), 
               profesion: $('#profesion').val(), especialidad: $('#especialidad').val(), centro_trabajo: $('#centro_trabajo').val(), pais: $('#pais').val(),
               provincia: $('#provincia').val(), poblacion: $('#poblacion').val(), codigo_postal: $('#codigo_postal').val(), email: $('#email').val(),
               password: $('#password').val(), confirma_password: $('#confirma_password').val(), 
               cond: $('input:checkbox[name="cond"]:checked').val(), auth: $('input:checkbox[name="auth"]:checked').val(),
               array_checked: JSON.stringify(array_checked),
               array_no_checked: JSON.stringify(array_no_checked) },
        beforeSend: function(){
                        $('#submit_btn').attr('disabled','disabled');
                        $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;REGISTRANDO...');
                    },
        success: function (data) { 
            if(data.status === 'ok'){
                $("#registro-form")[0].reset();

                // ----------- Remove all elements is-valid class --------------
                var InputElements = document.querySelectorAll(".form-control");
                var i;
                for (i = 0; i < InputElements.length; i++) {
                   InputElements[i].classList.remove('is-valid');
                }

                $('#cPwdInvalid').html('').hide();

                Swal.fire({        
                    type: 'success',
                    //title: data.message,
                    text: data.message,
                });

                var form = document.getElementById('registro-form'); 
                form.classList.remove('was-validated');

            } else {

                Swal.fire({        
                    type: 'error',
                    //title: data.message,
                    text: data.message,
                });
            }
            $('#pswdValid').hide();
            $('#submit_btn').html('REGISTRARSE');
            $("#submit_btn").attr("disabled",false);
            return false;
        }
    });
    
}


function checkEmail(sendForm){
    
    event.preventDefault();
    
    var email = $('#email').val();		
    var dataString = 'email='+email;

    var emailvalid = validarEmail(email);
 
    if( emailvalid ){

        $.ajax({
            type: "POST",
            url: "/ajax/check-email-availablity.php",
            dataType: 'json',
            data: dataString,
            success: function(data) {
                if(data.status === 'ok'){
                    $('#email').focus();
                    
                    Swal.fire({
                        type: 'error',
                        title: '¡Atención!',
                        text: data.message,
                    });
                    
                    $( "#email" ).removeClass( "is-valid" ).addClass( "is-invalid" );
                    $( "#invalid_email" ).text(data.message).show();
                    $( "#msgProfesion" ).removeClass("d-block");
                    $( "#msgEspecialidad" ).removeClass("d-block");
                    $( "#msgPais" ).removeClass("d-block");
                    $( "#msgProvincia" ).removeClass("d-block");
                    
                }else{
                    $( "#email" ).removeClass( "is-invalid" ).addClass( "is-valid" );
                    $( "#invalid_email" ).hide();
                    
                    if( sendForm && data.error ){
                        send_form();
                        return false;
                    }
                }
            },
            
        });
        
     }else{
        $('#email').focus();
        $( "#email" ).removeClass( "is-valid" ).addClass( "is-invalid" );
    }
}

function validarEmail(valor) {
    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)) {
        return true;
    } else {
        return false;
    }
}