<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();
    
    global $_l;

    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>
    
    <body>
        <section class="bg-white" style="min-height: 100px;">
            <div class="container" style="max-height:50px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <nav aria-label="breadcrumb" class="bg-white d-flex justify-content-between" style="max-height:50px; margin-right:10px;">
                            <a href="#"></a>
                            <ol class="breadcrumb bg-white">
                                <li class="breadcrumb-item"><a href="/home" class="grey-fort"><i class="fas fa-home text-grey" aria-hidden="true"></i></a></li>
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($tdata['curso'][0]->nombre)?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        
        
        <!-- DESCRIPCIÓN CURSO -->
        <section class="text-left">
            <div class="container p-3 ">
                <h3 class="mb-3">
                    <?php 
                        echo mb_strtoupper($tdata['curso'][0]->nombre); 
                    ?>
                </h3>
                <div class="border">
                    <div class="d-flex flex-row justify-content-between pl-3 pt-2">
                        <div class="text-left">
                            <?php
                                if( $tdata['curso'][0]->creditos == '' || $tdata['curso'][0]->creditos == 0){
                                    $num_creditos = '&nbsp;';
                                }else{
                                    $num_cred = explode('.', $tdata['curso'][0]->creditos);
                                    
                                    if( $num_cred[1] == '00' && $num_cred[0] == '1' ){
                                        $num_creditos = $num_cred[0].' '.mb_strtolower($_l['credito']);
                                    }else{
                                        $num_creditos = number_format($tdata['curso'][0]->creditos, 2, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $num_cred[1] == '00' && $num_cred[0] != '1' ){
                                        $num_creditos = number_format($tdata['curso'][0]->creditos, 0, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $tdata['curso'][0]->creditos == '0.01'){
                                        $num_creditos = '0,1 '.mb_strtolower($_l['credito']);
                                    }
                                    if( substr($tdata['curso'][0]->creditos, -1) == '0' && $num_cred[1] != '00' ){
                                        $num_creditos = number_format($tdata['curso'][0]->creditos, 1, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $num_cred[1] == '10' ){ $num_creditos = number_format($tdata['curso'][0]->creditos, 1, ',', '.').' '.mb_strtolower($_l['credito']); }
                                }
                            ?>
                            <h6 class="text-info text-left"><?php echo $num_creditos ?></h6>
                        </div>
                        <div class="text-left pr-3">
                            <i class="fas fa-graduation-cap text-info" aria-hidden="true"></i>&nbsp;<span class="text-dark font-weight-bold"><?php echo mb_strtoupper($_l['on_line']); ?></span>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between pl-3 pt-1 pb-1">
                        <div class="text-left">
                            <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;<span class="text-dark"><b><?php echo date('d/m/Y', strtotime($tdata['curso'][0]->fecha_inicio)).' - '.date('d/m/Y', strtotime($tdata['curso'][0]->fecha_fin)); ?></b></span>
                        </div>
                        <div class="text-left pr-3">
                            <?php
                                if( $tdata['curso'][0]->precio == '' || $tdata['curso'][0]->precio == 0){
                                    $precio = mb_strtoupper($_l['gratuito']);
                                }else{
                                    $precio = number_format($tdata['curso'][0]->precio, 0, ',', '.').' €';
                                }
                            ?>
                            <span class="text-info font-weight-bold"><?php echo $precio; ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-7 mt-3">
                        <img src="<?php $imagen = explode('.', $tdata['curso'][0]->imagen); echo Tools::loadImage($imagen[1], $imagen[0]);?>" class="img-fluid">
                    </div>
                    <!--<div class="col-md-5 bg-light py-3 pr-5 pl-5 mt-3">-->
                    <div class="col-md-5 bg-light p-3 font14 mt-3">
                        <div class="ml-3 mt-3">
                            <span class="font-weight-bold"><?=Tools::_t('dirigido_a')?>:</span><br/>  <?=$tdata['curso'][0]->dirigido_a?>
                        </div>
                        <div class="ml-3">
                            <span class="font-weight-bold"><?=Tools::_t('director_curso')?>:</span><br/> <?=$tdata['curso'][0]->director?>
                        </div>
                        <div class="ml-3">
                            <span class="font-weight-bold"><?=Tools::_t('acreditado_por')?>:</span><br/> <?=$tdata['entidad_acred']?><br/><br/>
                        </div>
                        <div class="ml-3">
                            <span class="font-weight-bold"><?=Tools::_t('patrocinado_por')?>:</span><br/> <?=$tdata['curso'][0]->patrocinado_por?><br/>
                        </div>
                        <div class="ml-3 font-weight-bold text-center">
                            <?php
                                $cursos = new CursosModel();
                                $btn_curso = $cursos->getMoodleAccessCourseButton((!empty($tdata['curso'][0]->id_curso) ? $tdata['curso'][0]->id_curso : 0), (!empty($_SESSION['userlogedin']) ? $_SESSION['userlogedin']  : 0));
                            ?>
                            <span class="font-weight-bold"><?php echo $btn_curso; ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="canales"></div>
                
                <p class="text-dark  mt-4">
                    <?=$tdata['curso'][0]->descripcion?>
                </p>
            </div>
        </section>
        
        <!-- ACCORDION -->
        <section class="container text-left pb-3">
            <div class="">
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        
                        <?php if( $tdata['curso'][0]->objetivos != '' ){ ?>
                            <div class="card-header mb-1 collapsed" data-toggle="collapse" href="#collapseOne">
                                <a class="card-title w500"><?php echo mb_strtoupper($_l['objetivo']); ?></a>
                            </div>
                            <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                                <?=$tdata['curso'][0]->objetivos?>
                            </div>
                        <?php } ?>
                        
                        <?php if( $tdata['curso'][0]->programa != '' ){ ?>
                            <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <a class="card-title w500"><?php echo mb_strtoupper($_l['programa']); ?></a>
                            </div>
                            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                                <?=$tdata['curso'][0]->programa?>
                            </div>
                        <?php } ?>
                        
                        <?php if( $tdata['curso'][0]->docentes != '' ){ ?>
                            <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <a class="card-title w500"><?php echo mb_strtoupper($_l['equipo_docente']); ?></a>
                            </div>
                            <div id="collapseThree" class="card-body collapse" data-parent="#accordion">
                                <?=$tdata['curso'][0]->docentes?>
                            </div>
                        <?php } ?>
                        
                        <?php if( $tdata['curso'][0]->evaluacion != '' ){ ?>
                            <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                <a class="card-title w500"><?php echo mb_strtoupper($_l['evaluacion_diploma']); ?></a>
                            </div>
                            <div id="collapseFour" class="card-body collapse" data-parent="#accordion">
                                <?=$tdata['curso'][0]->evaluacion?>
                            </div>
                        <?php } ?>
                        
                        <?php if( $tdata['curso'][0]->creditos_text != '' ){ ?>
                            <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                <a class="card-title w500"><?php echo mb_strtoupper($_l['creditos']); ?></a>
                            </div>
                            <div id="collapseFive" class="card-body collapse" data-parent="#accordion">
                                <?=$tdata['curso'][0]->creditos_text?>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
