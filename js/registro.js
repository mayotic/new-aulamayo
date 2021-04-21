$(document).ready(function(){
    
    $.extend(jQuery.validator.messages, {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Por favor, introduzca un email correcto",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: $.validator.format("Please enter no more than {0} characters."),
        minlength: $.validator.format("Please enter at least {0} characters."),
        rangelength: $.validator.format("Please enter a value between {0} and {1} characters long."),
        range: $.validator.format("Please enter a value between {0} and {1}."),
        max: $.validator.format("Please enter a value less than or equal to {0}."),
        min: $.validator.format("Please enter a value greater than or equal to {0}.")
    });
    
    $("#registro-form").validate({
            submitHandler : function(form) {
                $('#submit_btn').attr('disabled','disabled');
                $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;Iniciando sesión...');
                form.submit();  
            },
            rules : {
                    nombre : {
                        required : true
                    },
                    apellido1 : {
                        required : true
                    },
                    apellido2 : {
                        required : true
                    },
                    dni : {
                        required : true
                    },
                    profesion : {
                        required : true
                    },
                    especialidad : {
                        required : true
                    },
                    centro_trabajo : {
                        required : true
                    },
                    codigo_postal : {
                        required : true
                    },
                    provincia : {
                        required : true
                    },
                
                    email: {
                        required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                        },
                        email: true
                    },
                    confirma_email : {
                        required : true
                    },
                    password : {
                        required : true
                    },
                    confirma_password : {
                        required : true
                    }
            },
            messages : {
                    nombre : {
                        required : "Por favor, introduzca su nombre"
                    },
                    apellido1 : {
                        required : "Por favor, introduzca su primer apellido"
                    },
                    apellido2 : {
                        required : "Por favor, introduzca su segundo apellido"
                    },
                    dni : {
                        required : "Por favor, introduzca su DNI/NIE"
                    },
                    profesion : {
                        required : "Por favor, introduzca su profesión"
                    },
                    especialidad : {
                        required : "Por favor, introduzca su especialidad"
                    },
                    centro_trabajo : {
                        required : "Por favor, introduzca su centro de trabajo"
                    },
                    codigo_postal : {
                        required : "Por favor, introduzca su código postal"
                    },
                    provincia : {
                        required : "Por favor, introduzca su provincia"
                    },
                    email : {
                        required : "Por favor, introduzca su correo electrónico"
                    },
                    confirma_email : {
                        required : "Por favor, confirme su correo electrónico"
                    },
                    password : {
                        required : "Por favor, introduzca su contraseña"
                    },
                    confirma_password : {
                        required : "Por favor, confirme su contraseña"
                    }
            },
            errorPlacement : function(error, element) {
                //$(element).closest('div').find('.help-block').html(error.html());
                $(element).closest('.div_nombre').find('.help-block').html(error.html());
                $(element).closest('.div_apellido1').find('.help-block').html(error.html());
                $(element).closest('.div_apellido2').find('.help-block').html(error.html());
                $(element).closest('.div_profesion').find('.help-block').html(error.html());
                $(element).closest('.div_especialidad').find('.help-block').html(error.html());
                $(element).closest('.div_centro_trabajo').find('.help-block').html(error.html());
                $(element).closest('.div_codigo_postal').find('.help-block').html(error.html());
                $(element).closest('.div_provincia').find('.help-block').html(error.html());
                $(element).closest('.div_email').find('.help-block').html(error.html());
                $(element).closest('.div_email').find('.help-block').html(error.html());
                $(element).closest('.div_confirma_email').find('.help-block').html(error.html());
                $(element).closest('.div_password').find('.help-block').html(error.html());
                $(element).closest('.div_confirma_password').find('.help-block').html(error.html());
            },
            highlight : function(element) {
                //$(element).closest('div').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_nombre').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_apellido1').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_apellido2').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_profesion').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_especialidad').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_centro_trabajo').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_codigo_postal').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_provincia').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_email').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_confirma_email').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_password').removeClass('has-success').addClass('has-error');
                $(element).closest('.div_confirma_password').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                //$(element).closest('div').removeClass('has-error').addClass('has-success');
                //$(element).closest('div').find('.help-block').html('');
                $(element).closest('.div_nombre').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_nombre').find('.help-block').html('');
                
                $(element).closest('.div_apellido1').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_apellido1').find('.help-block').html('');
                
                $(element).closest('.div_apellido2').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_apellido2').find('.help-block').html('');
                
                $(element).closest('.div_profesion').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_profesion').find('.help-block').html('');
                
                $(element).closest('.div_especialidad').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_especialidad').find('.help-block').html('');
                
                $(element).closest('.div_centro_trabajo').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_centro_trabajo').find('.help-block').html('');
                
                $(element).closest('.div_codigo_postal').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_codigo_postal').find('.help-block').html('');
                
                $(element).closest('.div_provincia').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_provincia').find('.help-block').html('');
                
                $(element).closest('.div_email').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_email').find('.help-block').html('');
                
                $(element).closest('.div_confirma_email').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_confirma_email').find('.help-block').html('');
                
                $(element).closest('.div_password').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_password').find('.help-block').html('');
                
                $(element).closest('.div_confirma_password').removeClass('has-error').addClass('has-success');
                $(element).closest('.div_confirma_password').find('.help-block').html('');
            }
    });
	
});


