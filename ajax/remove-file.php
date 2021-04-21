<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf;

// $path = $_SERVER['DOCUMENT_ROOT'] . '/leti2019/uploads/inscritos/docs/' . $_POST['ins'] . '/' . $_POST['file'];

$path = AutoIncludes::getRootPath() . $appconf['upload_inscritos_folder'] . '/' . $_POST['id_inscrito'] . '/' . $_POST['file'];

// echo $path; exit;
if (unlink($path)) {
  // echo json_encode(['status' => 'ok']);
  echo 'ok';
}

?>
