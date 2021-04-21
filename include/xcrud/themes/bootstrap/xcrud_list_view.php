<?php
// $public_classes = [];
// foreach (get_class_methods($this) as $method) {
//     $reflect = new ReflectionMethod($this, $method);
//     // if ($reflect->isPublic()) {
//       $public_classes[] = $reflect;
//     // }
// }
// var_dump($public_classes);
?>

<?php if ($this->is_create or $this->is_csv or $this->is_print){?>
        <div class="xcrud-top-actions row">
          <div class="col-md-2">
            <?php echo $this->add_button('btn btn-success','fa fa-plus'); ?>
          </div>
          <div class="col-md-7">
            <?php echo $this->render_search(); ?>
          </div>
          <div class="col-md-3">
            <div class="btn-group float-right">
                <?php
                if ($custom_buttons = $this->get_var('custom_buttons')) {
                  foreach ($custom_buttons as $key => $button) {
                    echo $this->custom_button($button['name'],
                                              $button['task'],
                                              $button['after'],
                                              $button['class'],
                                              $button['icon'],
                                              $button['new_window'],
                                              $button['mode'],
                                              $button['hide_text'],
                                              $button['primary'],
                                              $button['custom_action']);
                  }
                }
                echo $this->print_button('btn btn-light','fas fa-print');
                echo $this->csv_button('btn btn-light','fas fa-file'); ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
<?php } ?>
        <div class="xcrud-list-container">
        <table class="xcrud-list table table-striped table-hover table-bordered">
            <thead>
                <?php echo $this->render_grid_head('tr', 'th'); ?>
            </thead>
            <tbody>
                <?php echo $this->render_grid_body('tr', 'td'); ?>
            </tbody>
            <tfoot>
                <?php echo $this->render_grid_footer('tr', 'td'); ?>
            </tfoot>
        </table>
        </div>
        <nav aria-label="" class="xcrud-nav">
            <?php echo $this->render_limitlist(true); ?>
            <?php echo $this->render_pagination(); ?>
            <?php echo $this->render_benchmark(); ?>
        </nav>
