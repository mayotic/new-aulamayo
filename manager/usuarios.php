<?php
/*
menu=main|Usuarios|1|fas fa-user-graduate
*/
  include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
  AutoIncludes::loadController();

  Tools::loadTemplatePart('header');

?>

<div id="content" class="container-fluid">
  <div class="row">

    <nav id="mysidebar" class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">

        <?php Tools::loadTemplatePart('menu'); ?>
      </div>
    </nav>

    <main id="mycontent" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-capitalize"><i class="fas fa-user-graduate"></i> &nbsp;<?=AutoIncludes::getFileName(true)?></h1>
        <?php Tools::loadTemplatePart('other-buttons'); ?>
      </div>

     <?=$tdata['content'];?>

    </main>

  </div>

</div>


<!-- Modal for row edit at template-->
<div class="modal fade" id="change-pass" tabindex="-1" role="dialog" aria-labelledby="editlabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content xcrud">
      <div class="modal-header">
        <h4 class="modal-title" id="editlabel"> Cambiar contrasseña</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">

        <div class="form-group col-md-6">
          <label class="control-label col-sm-12">Entre la nueva contraseña</label>
          <div class="col-sm-9">
            <input id="pass" class="form-control" data-required="3" type="password" data-type="text" value="" name="newpass" maxlength="50">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button id="save-newpass" type="button" class="btn btn-default" data-dismiss="modal">Guardar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php
  Tools::loadTemplatePart('footer');
?>

<script type="text/javascript">
$('#toggle-button').clickToggle(
  function () {
    Tools.switchSidebar('#mysidebar', 'd-md-block d-none', 'zero-width', '#mycontent', 'col-md-9 col-lg-10', 'col-md-12 col-lg-12');
  },
  function () {
    Tools.switchSidebar('#mysidebar', 'zero-width', 'd-md-block d-none', '#mycontent', 'col-md-12 col-lg-12', 'col-md-9 col-lg-10');
  }
);
function doActions(faction) {
  if (faction) {
    switch (faction) {
      case 'editrow':
        if($.urlParam('fid')) {
          $('a#editrow').data('primary', $.urlParam('fid')).click();
        }
        break;
      default:

    }
  }
}
$(window).on('load', function () {
  if (typeof window.external_action == 'undefined') {
      window.external_action = true;
      doActions($.urlParam('faction'));
  }
});
</script>

</body>

</html>
