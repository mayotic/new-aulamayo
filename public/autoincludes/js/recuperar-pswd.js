
(function () {
    "use strict";
    window.addEventListener("load", function () {
        var form = document.getElementById("recuperarpswd-form");
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
        url: "/ajax/get-pass.php",
        dataType: "json",
        data: {email: $('#email').val()},
        beforeSend: function () {
            $('#submit_btn').attr('disabled', 'disabled');
            $('#submit_btn').html('<i class="fas fa-spinner fa-spin gap-center"></i>&nbsp;&nbsp;Enviando...');
        },
        success: function (data) {
            if (data.status === 'ok') {
                $("#msg").attr('class','alert alert-success text-center').html(data.message).show();
            } else {
                $("#msg").attr('class', 'alert alert-danger text-center').html(data.message).show();
            }
            $('#submit_btn').html('Enviar');
            $("#submit_btn").prop("disabled", false);
            //$('#msg').delay(4000).slideUp();
        }
    });
}
