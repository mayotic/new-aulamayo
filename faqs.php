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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page">PREGUNTAS FRECUENTES</li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        <!-- PREGUNTAS FRECUENTES -->
        <section class="container text-left pb-3">
            <div class="container p-4 ">
                 <h3 class="mb-3">
                     <?=mb_strtoupper($_l['preguntas_frecuentes'])?>
                </h3>
                
                <h4><?=Tools::_t('inscrip_acceso')?></h4>
                <br>
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" href="#collapse1">
                            <a class="card-title"><?=Tools::_t('faq1')?></a>
                        </div>
                        <div id="collapse1" class="card-body collapse" data-parent="#accordion">
                            <p><?=Tools::_t('faq1_resp')?></p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <a class="card-title"><?=Tools::_t('faq2')?></a>
                        </div>
                        <div id="collapse2" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq2_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            <a class="card-title"><?=Tools::_t('faq3')?></a>
                        </div>
                        <div id="collapse3" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq3_resp')?>
                            </p>
                        </div>
                        
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            <a class="card-title"><?=Tools::_t('faq4')?></a>
                        </div>
                        <div id="collapse4" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq4_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                            <a class="card-title"><?=Tools::_t('faq5')?></a>
                        </div>
                        <div id="collapse5" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq5_resp')?>
                            </p>
                        </div>
                    </div>
                </div>
                
                
                
                
                <br><br>
                <h4><?=Tools::_t('funcionamiento_cursos')?></h4>
                <br>
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" href="#collapse6">
                            <a class="card-title"><?=Tools::_t('faq6')?></a>
                        </div>
                        <div id="collapse6" class="card-body collapse" data-parent="#accordion">
                            <p><?=Tools::_t('faq6_resp')?></p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                            <a class="card-title"><?=Tools::_t('faq7')?></a>
                        </div>
                        <div id="collapse7" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq7_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                            <a class="card-title"><?=Tools::_t('faq8')?></a>
                        </div>
                        <div id="collapse8" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq8_resp')?>
                            </p>
                        </div>
                        
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                            <a class="card-title"><?=Tools::_t('faq9')?></a>
                        </div>
                        <div id="collapse9" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq9_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                            <a class="card-title"><?=Tools::_t('faq10')?></a>
                        </div>
                        <div id="collapse10" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq10_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                            <a class="card-title"><?=Tools::_t('faq11')?></a>
                        </div>
                        <div id="collapse11" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq11_resp')?>
                            </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                            <a class="card-title"><?=Tools::_t('faq12')?></a>
                        </div>
                        <div id="collapse12" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq12_resp')?>
                            </p>
                        </div>
                        
                    </div>
                </div>
                
                
                
                
                
                
                
                <br><br>
                <h4><?=Tools::_t('creditos')?></h4>
                <br>
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" href="#collapse13">
                            <a class="card-title"><?=Tools::_t('faq13')?></a>
                        </div>
                        <div id="collapse13" class="card-body collapse" data-parent="#accordion">
                            <p><?=Tools::_t('faq13_resp')?></p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" data-parent="#accordion" href="#collapse14">
                            <a class="card-title"><?=Tools::_t('faq14')?></a>
                        </div>
                        <div id="collapse14" class="card-body collapse" data-parent="#accordion">
                            <p>
                                <?=Tools::_t('faq14_resp')?>
                            </p>
                        </div>
                        
                        
                    </div>
                </div>
                
                
                <br><br>
                <h4><?=Tools::_t('diploma_certificado')?></h4>
                <br>
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" href="#collapse15">
                            <a class="card-title"><?=Tools::_t('faq15')?></a>
                        </div>
                        <div id="collapse15" class="card-body collapse" data-parent="#accordion">
                            <p><?=Tools::_t('faq15_resp')?></p>
                        </div>
                        
                    </div>
                </div>
                
                
                <br><br>
                <h4><?=Tools::_t('decl_conf_intereses')?></h4>
                <br>
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed cardtext" data-toggle="collapse" href="#collapse16">
                            <a class="card-title"><?=Tools::_t('faq16')?></a>
                        </div>
                        <div id="collapse16" class="card-body collapse" data-parent="#accordion">
                            <p><?=Tools::_t('faq16_resp')?></p>
                        </div>
                        
                    </div>
                </div>
                
                
                
            </div>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
