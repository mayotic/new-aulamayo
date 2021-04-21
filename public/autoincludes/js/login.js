
(function () {
    "use strict";
    window.addEventListener("load", function () {
        var form = document.getElementById("login-form");
        form.addEventListener("submit", function (event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                sendForm();
            }
            form.classList.add("was-validated");
        }, false);
    }, false);
}());

function sendForm() {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "/ajax/login.php",
        data: {user: $('#inputEmail').val(), pass: $('#inputPassword').val()},
        beforeSend: function () {
            $('#submit_btn').attr('disabled', 'disabled');
            $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;Iniciando sesión...');
        },
        success: function (data) {
            if (data === 'ok') {
                window.location.href = window.url_home;
                //$("#msg").attr('class','alert alert-success text-center').html("Correo electrónico y contraseña correctos").show();
            } else {
                $("#msg").attr('class', 'alert alert-danger text-center').html("Correo electrónico o contraseña incorrectos").show();
                $('#submit_btn').html('Iniciar sesión');
                $("#submit_btn").prop("disabled", false);
                //$('#msg').delay(4000).slideUp();
            }
        }
    });
}
