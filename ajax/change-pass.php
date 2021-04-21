<?php
include '../cms/core.php';

if (isset($_REQUEST['id']) and !empty($_REQUEST['id'])) {
  $result = App::changePass($_REQUEST['id'], $_REQUEST['pass']);
  if (!empty($result)){
    echo json_encode(['result' => 'ok', 'message' => 'Contraseña cambiada correctamente']);
  }
}else{
  echo json_encode(['result' => 'error', 'message' => 'Ha ocurrido un error al cambiar la contrasseña']);
}

?>
