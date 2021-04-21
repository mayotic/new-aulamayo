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
    
    $("#forgetpassword-form").validate({
        submitHandler : function(form) {
            $('#submit_btn').attr('disabled','disabled');
                $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;Enviando...');
                form.submit();
        },
        rules : {
            email : {
                required : true,
                email: true,
                remote:"check-email.php"
            }
        },
        messages : {
            email : {
                required : "Por favor, introduzca el correo electrónico",
                remote : "El correo electrónico no existe"
            }
        },
        errorPlacement : function(error, element) {
            $(element).closest('.div_login').find('.help-block').html(error.html());
        },
        highlight : function(element) {
            $(element).closest('.div_login').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.div_login').removeClass('has-error').addClass('has-success');
            $(element).closest('.div_login').find('.help-block').html('');
        }
    });
    
	
});


