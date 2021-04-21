<?php
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

<!--
this.primary_key  = $(node).data('primary_key');

this.order        = $(node).data('order').split(',');
this.filters      = $(node).data('filters').split(',');
this.pagination   = $(node).data('pagination').split(',');
this.rows_page    = $(node).data('rows_page');
this.total_rows   = 0;

this.source_list  = $(node).data('source_list');
this.source_edit  = $(node).data('source_edit');
this.source_save  = $(node).data('source_save');
this.source_new   = $(node).data('source_new');
this.source_del   = $(node).data('source_del');

this.paginator    = $(node).data('paginator');

this.edit_modal   = $(node).data('edit_modal');
this.save_button  = $(node).data('save_button');
 -->

     <div id="comunidades-list"
          data-primary_key="id_comunidad"
          data-order="comunidad,ASC"
          data-filter=""
          data-pagination="10,1"
          data-rows_page="10"
          data-total_rows=""
          data-source_list="/ajax/comunidades-list.php"
          data-source_edit="/ajax/comunidades-edit.php"
          data-source_save="/ajax/comunidades-save.php"
          data-source_delete="/ajax/comunidades-delete.php"
          data-paginator="#paginator"
          data-edit_modal="#edit-modal"
          data-save_button="#modal-save">

     </div>

     <div id="paginator"></div>

    </main>

  </div>

</div>

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

<?php
Tools::loadTemplatePart('comunidades-list');
Tools::loadTemplatePart('comunidades-edit');
Tools::loadTemplatePart('paises-select');
?>

<!-- Modal for row edit at template-->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editlabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content xcrud">
      <div class="modal-header">
        <h4 class="modal-title" id="editlabel">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div id="comunidades-edit" class="modal-body xcrud-ajax">

      </div>
      <div class="modal-footer">
        <button id="modal-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="modal-save" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


</body>
<?php echo Tools::loadLibrary('js', 'crud'); ?>
</html>
