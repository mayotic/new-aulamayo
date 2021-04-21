
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
    
    $.ajax({
          type: "POST",
          url: '/ajax/profesiones-list.php',
          data: {},
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    }).fail( function( data ) {
        //console.log(data);
    }).done( function(data) {
        var idprofesion = $('#idprofesion').val();
        $('#profesiones-select option[value='+idprofesion+']').attr('selected','selected');
    });
    
    var idprofesion = $('#idprofesion').val();
    $.ajax({
          type: "POST",
          url: '/ajax/especialidades-list.php',
          data: { filter: idprofesion },
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    }).fail( function( data ) {
        //console.log(data);
    }).done( function(data) {
        var idespecialidad = $('#idespecialidad').val();
        $('#especialidades-select option[value='+idespecialidad+']').attr('selected','selected');
    });
    
    $.ajax({
          type: "POST",
          url: '/ajax/pais-list.php',
          data: {},
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    }).fail( function( data ) {
        //console.log(data);
    }).done( function(data) {
        var idpais = $('#idpais').val();
        $('#pais-select option[value='+idpais+']').attr('selected','selected');
    });
    
    var idpais = $('#idpais').val();
    $.ajax({
          type: "POST",
          url: '/ajax/provincias-list.php',
          data: { filter: idpais },
          success: function (data) {
            Tools.deployData(data);
          },
          dataType: 'json'
    }).fail( function( data ) {
        //console.log(data);
    }).done( function(data) {
        var idprovincia = $('#idprovincia').val();
        $('#provincias-select option[value='+idprovincia+']').attr('selected','selected');
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
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/ajax/registro-save.php",
        dataType: "json",
        data: {nombre: $('#nombre').val(), apellido1: $('#apellido1').val(), apellido2: $('#apellido2').val(), 
               profesion: $('#profesion').val(), especialidad: $('#especialidad').val(), centro_trabajo: $('#centro_trabajo').val(), pais: $('#pais').val(),
               provincia: $('#provincia').val(), poblacion: $('#poblacion').val(), codigo_postal: $('#codigo_postal').val(), 
               password: $('#password').val(), confirma_password: $('#confirma_password').val(), 
               auth: $('input:checkbox[name="auth"]:checked').val(), accion: 'update' },
        beforeSend: function(){
                        $('#submit_btn').attr('disabled','disabled');
                        $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;GUARDANDO...');
                    },
        success: function (data) { 
            if(data.status === 'ok'){

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
            $('#submit_btn').html('GUARDAR');
            $("#submit_btn").attr("disabled",false);
            return false;
        }
    });
}