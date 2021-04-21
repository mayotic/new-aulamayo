<?php
global $tdata;
?>
<div class="row documentos xcrud">
  <label class="col-md-12 col-control-label" for="selectbasic" style="border-bottom: 1px solid #ddd">ZONA DE DESCARGA DE DOCUMENTACIÓN</label>

  <div class="col-md-6 docslist">
    <?=$tdata['dropzone']?>
  </div>

  <?php if ($tdata['canupload']) : ?>
    <div class="col-md-6">
      <div id="dropzone">
        <form action="Include/upload.php" class="dropzone needsclick" id="Documents">
          <div class="dz-message needsclick">
            Arrastrar aquí los documentos o hacer click para cargarlos.<br>
          </div>
      </form>
    </div>
    </div>
  <?php endif; ?>

</div>
