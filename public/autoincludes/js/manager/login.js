$(function(){

  $('button[type=submit]').on('click', function (event) {

    event.preventDefault();

    $.post('/ajax/login-manager.php',
            {user: $('#inputEmail').val(), pass: $('#inputPassword').val()},
            function (data) {
              console.log(data);
              if (!data.error) {
                window.location.href = window.url_home;
              }else{
                alert(data.message);
              }
            },
            'json'
    );

  });

});
