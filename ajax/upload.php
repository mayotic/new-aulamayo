<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf;

$path = AutoIncludes::getRootPath() . $appconf['upload_inscritos_folder'] . '/' . $_POST['id_inscrito'];

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

if (!move_uploaded_file(
    $_FILES['file']['tmp_name'],
    $path . '/' . $_FILES['file']['name']
)) {
  echo json_encode([
      'status' => 'error',
      'path' => $path . '/' . $_FILES['file']['name'],
      'docs' => false
  ]);
}else{
  echo json_encode([
        'status' => 'ok',
        'path' => $path . '/' . $_FILES['file']['name'],
        // 'docs' => docsList($_SESSION['idinscrito'])
      ]);
  // // Mail send
  // include '../enviamaildocumentacion.php';
  //
  // enviaMail();
  // echo docsList();
  echo App::sendMailAfterDocumentation($_POST['id_inscrito']);
}

?>
