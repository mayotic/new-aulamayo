<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();

    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>

    <body>
        <section class="bg-light" style="max-height:50px;">
            <div class="container" style="max-height:50px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <nav aria-label="breadcrumb" class="bg-light d-flex justify-content-between" style="max-height:50px; margin-right:10px;">
                            <a href="#"></a>
                            <ol class="breadcrumb bg-light">
                                <li class="breadcrumb-item"><a href="home.php" class="grey-fort"><i class="fas fa-home text-grey" aria-hidden="true"></i></a></li>
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['mis_cursos'])?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- MIS CURSOS -->
        <section class=" bg-white">
            <div class="container p-4">
                <h3 class="mb-0"><?=mb_strtoupper($_l['mis_cursos'])?></h3>

                <div class="row marginB30">
                    <div class="col-md-12 text-right">
                        <?=$_l['visualizar']?> <img id="gridview" class="view" src="<?php echo Tools::loadImage('png', 'view_grid_on');?>"> | <img id="listview" class="view" src="<?php echo Tools::loadImage('png', 'view_list_off');?>">
                    </div>
                </div>

                <div class="row text-center">
                    <?php  echo $tdata['mis_cursos']; ?>
                </div>
            </div>
            <br/>
        </section>

        <?php
            Tools::loadTemplatePart('footer-front');
            Tools::loadTemplatePart('profesiones-select');
        ?>
    </body>
</html>
