<?php
global $appconf;
$auth = new Auth();
$is_admin = false;

if (!empty($_SESSION['userlogedin'])){
  $user_info = new User($_SESSION['userlogedin']);
  if ($user_info->tipo_usuario == USR_TIPO_ADMIN) {
    $is_admin = true;
  }
}
if ($auth->logedIn() and $is_admin) {
  header('Location:/manager/cursos');
}

?>
