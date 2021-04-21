<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();
    
    global $_l;

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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['conocenos'])?></li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        <section class="container text-left pb-3">
            <div class="container p-4 ">
                 <h3 class="mb-3">
                    <?=mb_strtoupper($_l['conocenos'])?>
                </h3>
                <br>
                <!--<div class="text-left mb-3"><img src="<?php echo Tools::loadImage('png', 'mayo-logo-formacion');?>" class="img-fluid"></div>--> 
                <p><?=Tools::_t('grupo_mayo_text1')?></p>
                <br><br>
            </div>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
