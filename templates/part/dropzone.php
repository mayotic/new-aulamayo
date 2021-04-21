<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf, $tdata;

// Drop zone
$tdata['dropzone'] = '';
$tdata['canupload'] = false;

$user = new User($_SESSION['userlogedin']);

if ($user->tipo_inscrito == $appconf['tipo_admin']) {
  $tdata['canupload'] = true;
}
?>
<div class="row documentos dropzone-wrapper xcrud" style="display:none;">
  <div class="col-md-12">
    <label class="col-control-label" for="selectbasic" style="border-bottom: 1px solid #ddd">Zona de descarga de documentación</label>
  </div>

  <div class="col-md-6 docslist">
    <?=$tdata['dropzone']?>
  </div>

  <?php if ($tdata['canupload']) : ?>
    <div class="col-md-6">
      <div id="dropzone">
        <form action="/ajax/upload.php" class="dropzone needsclick" id="Documents" method="POST">
          <input type="hidden" name="id_inscrito" value=''>
          <div class="dz-message needsclick">
            Arrastrar aquí los documentos o hacer click para cargarlos.<br>
          </div>
      </form>
    </div>
    </div>
  <?php endif; ?>

</div>
