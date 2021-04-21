<div class="xcrud<?php echo $this->is_rtl ? ' xcrud_rtl' : ''?>">
    <?php echo $this->render_table_name(false, 'div', true)?>
    <div class="xcrud-container"<?php echo ($this->start_minimized) ? ' style="display:none;"' : '' ?>>
        <div class="xcrud-ajax" data-instance="<?=$this->instance_name?>">
            <?php echo $this->render_view() ?>
<?php //var_dump($this); ?>
            <a href="#" style="display:none;" id="editrow" class="xcrud-action" data-task="edit" data-primary="">Edit row</a>
        </div>
        <div class="xcrud-overlay"></div>
    </div>
</div>

  <!-- Modal for row edit at template-->
  <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editlabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content xcrud">
        <div class="modal-header">
          <h4 class="modal-title" id="editlabel"><?php echo $this->render_table_name('edit'); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body xcrud-ajax">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <script type="text/javascript">
    $('#edit-modal').on('hiden.bs.modal', function () {
      // var container = $('.xcrud-ajax.<?=$this->instance_name?>');
      var container = $('[data-instance=<?=$this->instance_name?>]');
      Xcrud.request(container, Xcrud.list_data(container));
      // Xcrud.reload(container);
      // $.ajax({
      //         type: "post",
      //         url: Xcrud.config("url"),
      //         data: Xcrud.list_data(".xcrud", {task: "list"}),
      //         success: function(response){
      //             alert(response);
      //         }
      // });
    });
  </script>
