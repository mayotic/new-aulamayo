<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf, $tdata;

// Drop zone
$tdata['dropzone'] = '';
$tdata['canupload'] = false;

// Get the inscrito and delegado ids
$tdata['id_usuario'] = $_POST['id_usuario'];
$tdata['id_inscrito'] = $_POST['id_inscrito'];

$user = new User($_SESSION['userlogedin']);

if ($user->tipo_inscrito == $appconf['tipo_admin']) {
  $tdata['canupload'] = true;
}

$path = $appconf['upload_inscritos_folder'] . '/' . $tdata['id_inscrito'] . '/';

if (!file_exists(AutoIncludes::getRootPath() . $path)) {
    mkdir(AutoIncludes::getRootPath() . $path, 0777, true);
}

$fileList = scandir(AutoIncludes::getRootPath() . $path);
$haveFiles = false;

foreach($fileList as $filename) {
    if(is_file($path . $filename)) {
        $haveFiles = true;
        if ($_SESSION['rol'] == 1) {
          $remove = '<button type="button" class="btn btn-danger fileremove" data-inscrito="' . $id_inscrito . '" data-filename="' . $filename . '">X</button>';
        }else {
          $remove = '';
        }
        $tdata['dropzone'] .= '<button type="button" class="btn btn-primary btn-xs"><a href="' . $path . '/' . $filename . '" target="_blank" download="' . $path . '/' . $filename . '">' . $filename . '</a>' . $remove . '</button>';
    }
}
if (!$haveFiles) {
  $tdata['dropzone'] = '<h4>Todavía no hay documentos para descargar</h4>';
}
?>
<div class="row documentos xcrud">
  <label class="col-md-12 col-control-label" for="selectbasic" style="border-bottom: 1px solid #ddd">ZONA DE DESCARGA DE DOCUMENTACIÓN</label>

  <div class="col-md-6 docslist">
    <?=$tdata['dropzone']?>
  </div>

  <?php if ($tdata['canupload']) : ?>
    <div class="col-md-6">
      <div id="dropzone">
        <form action="/ajax/upload.php" class="dropzone needsclick" id="Documents">
          <div class="dz-message needsclick">
            Arrastrar aquí los documentos o hacer click para cargarlos.<br>
          </div>
      </form>
    </div>
    </div>
  <?php endif; ?>

</div>
