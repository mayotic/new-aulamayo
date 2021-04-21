<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf;

if (isset($_POST['id_inscrito'])) {
  $path = $appconf['upload_inscritos_folder'] . '/' . $_POST['id_inscrito'] . '/';

  if (!file_exists(AutoIncludes::getRootPath() . $path)) {
    mkdir(AutoIncludes::getRootPath() . $path, 0777, true);
  }

  $fileList = scandir(AutoIncludes::getRootPath() . $path);

  $haveFiles = false;
  $output = '';
  $user = new User($_SESSION['userlogedin']);
  foreach($fileList as $filename) {
      if(is_file(AutoIncludes::getRootPath() . $path . $filename)) {
          $haveFiles = true;
          if ($user->tipo_inscrito == $appconf['tipo_admin']) {
            $remove = '<button type="button" class="btn btn-danger fileremove" data-inscrito="' . $_POST['id_inscrito'] . '" data-filename="' . $filename . '">X</button>';
          }else {
            $remove = '';
          }
          $output .= '<button type="button" class="btn btn-primary btn-xs"><a href="' . $path . '/' . $filename . '" target="_blank" download="' . $path . '/' . $filename . '">' . $filename . '</a>' . $remove . '</button>';
      }
  }
  if (!$haveFiles) {
    $output = '<h4>Todavía no hay documentos para descargar</h4>';
  }
  echo $output;
}
?>
