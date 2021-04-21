<!-- <?php //echo $this->render_table_name($mode); ?> -->
<script type="text/javascript">
window.xcrud_data = {mode:'<?=$mode?>'}
</script>
<div class="xcrud-top-actions btn-group">
    <?php
    echo $this->render_button('save_return','save','list','btn btn-primary','far fa-save','create,edit', $this->get_var('hide_edit_buttons_text'));
    echo $this->render_button('save_new','save','create','btn btn-light','','create,edit', $this->get_var('hide_edit_buttons_text'));
    echo $this->render_button('save_edit','save','edit','btn btn-light','','create,edit', $this->get_var('hide_edit_buttons_text'));
    echo $this->render_button('return','list','','btn btn-warning', 'fas fa-reply', '', $this->get_var('hide_edit_buttons_text')); ?>
</div>
<div class="xcrud-view">
<?php
// echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table')) : $this->render_fields_list($mode,'div','div','label','div');
echo $this->render_fields_list($mode,'div','div','label','div');
?>
</div>
<div class="xcrud-top-actions btn-group">
    <?php
    // echo $this->render_button('save_return','save','list','btn btn-primary','','create,edit');
    // echo $this->render_button('save_new','save','create','btn btn-light','','create,edit');
    // echo $this->render_button('save_edit','save','edit','btn btn-light','','create,edit');
    // echo $this->render_button('return','list','','btn btn-warning'); ?>
</div>
<div class="xcrud-nav">
    <?php echo $this->render_benchmark(); ?>
</div>
