
(function () {  
    'use strict';  
    window.addEventListener('load', function () {  
        var form = document.getElementById('registro-form');  
        form.addEventListener('submit', function (event) {  
            if (form.checkValidity() === false) {  
                event.preventDefault();  
                event.stopPropagation(); 
            }else{  
                send_form();
                return false;
            }
            form.classList.add('was-validated');  
            bsSelectValidation();
            
        }, false);  
    }, false);  
})(); 


$(document).ready(function(){
    
    //alert("ieeep");
    
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
        console.log(data);
        //alert( 'Error!!' );
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
    
    $('#email').on('blur', function() {
 
        var email = $(this).val();		
        var dataString = 'email='+email;
 
        $.ajax({
            type: "POST",
            url: "/ajax/check-email-availablity.php",
            dataType: 'json',
            data: dataString,
            success: function(data) {
                if(data.status === 'ok'){
                    $('#email').focus();
                    $( "#email" ).removeClass( "is-valid" ).addClass( "is-invalid" );
                    $( "#invalid_email" ).text(data.message).show();
                }else{
                    $( "#email" ).removeClass( "is-invalid" ).addClass( "is-valid" );
                    $( "#invalid_email" ).html('').hide();
                }
            }
        });
    });              
    
    
    
    // ----------- Set all elements as INVALID --------------
      var myInputElements = document.querySelectorAll(".form-control");
      var i;
      /*
      for (i = 0; i < myInputElements.length; i++) {
        myInputElements[i].classList.add('is-invalid');
        myInputElements[i].classList.remove('is-valid');
      }
      */
      // ------------ Check passwords similarity --------------
      $('#password, #confirma_password').on('keyup', function () {
        if ($('#password').val() !== '' && $('#confirma_password').val() !== '' && $('#password').val() === $('#confirma_password').val() ) {
          $('#cPwdValid').show();
          //$('#cPwdInvalid').hide();
          $('#cPwdInvalid').html('Las contraseñas coinciden').css('color', 'green');
          $('.myCpwdClass').addClass('is-valid');
          $('.myCpwdClass').removeClass('is-invalid');
          //$("#submit_btn").attr("disabled",false);
          for (i = 0; i < myInputElements.length; i++) {
            var myElement = document.getElementById(myInputElements[i].id);
            if (myElement.classList.contains('is-invalid')) {
              //$("#submit_btn").attr("disabled",true);
              break;
            }
          }
        } else {
          $('#cPwdValid').hide();
          $('#cPwdInvalid').show();
          $('#cPwdInvalid').html('Las contraseñas no coinciden').css('color', 'red');
          $('.myCpwdClass').removeClass('is-valid');
          $('.myCpwdClass').addClass('is-invalid');
          //$("#submit_btn").attr("disabled",true);
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
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/ajax/registro-save.php",
        dataType: "json",
        data: {nombre: $('#nombre').val(), apellido1: $('#apellido1').val(), apellido2: $('#apellido2').val(), dni_nie: $('#dni_nie').val(), 
               profesion: $('#profesion').val(), especialidad: $('#especialidad').val(), centro_trabajo: $('#centro_trabajo').val(), pais: $('#pais').val(),
               provincia: $('#provincia').val(), poblacion: $('#poblacion').val(), codigo_postal: $('#codigo_postal').val(), email: $('#email').val(),
               password: $('#password').val(), confirma_password: $('#confirma_password').val(), 
               cond: $('input:checkbox[name="cond"]:checked').val(), auth: $('input:checkbox[name="auth"]:checked').val() },
        beforeSend: function(){
                        $('#submit_btn').attr('disabled','disabled');
                        $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;REGISTRANDO...');
                    },
        success: function (data) { 
            if(data.status === 'ok'){
                $("#msg").attr('class','alert alert-success text-center').html(data.message).show();

                $("#registro-form")[0].reset();
               
                // ----------- Remove all elements is-valid class --------------
                var InputElements = document.querySelectorAll(".form-control");
                var i;
                for (i = 0; i < InputElements.length; i++) {
                   InputElements[i].classList.remove('is-valid');
                }
               
                $('#cPwdInvalid').html('').hide();
                $('#submit_btn').html('REGISTRARSE');
                $('#msg').delay(4000).slideUp();
            } else {
                $("#msg").attr('class','alert alert-danger text-center').html(data.message).show();
                $('#submit_btn').html('REGISTRARSE');
                $('#msg').delay(4000).slideUp();
            }
            $("#submit_btn").attr("disabled",false);
        }
    });
}