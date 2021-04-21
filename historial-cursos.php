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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['historial_cursos'])?></li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        
        <!-- HISTORIAL CURSOS -->
        <section class=" bg-white">
            <div class="container p-4">
                <h3 class="mb-3"><?=mb_strtoupper($_l['historial_cursos'])?></h3>
                <br>
                <div class="row text-center">
                    <?php
                    $cursos_activos = '';
                    foreach ($tdata['cursos_historial'] as $data){ 
                        
                        $id_curso = $data->id_curso;
                        $id_moodle = $data->id_moodle;
                        $precio_curso = $data->precio;
                        $imagen = explode('.', $data->imagen);
                        $name_img = $imagen[0];
                        $ext_img = $imagen[1];
                        $img_curso = Tools::loadImage($ext_img, $name_img);
                        $num_creditos = mb_strtoupper($_l['acreditado_con']).' '.$data->creditos.' '.mb_strtoupper($_l['creditos']);
                        $titulo_curso = mb_strtoupper($data->nombre);
                        $timestamp_fecha_ini = strtotime($data->fecha_inicio);
                        $fecha_ini_curso = date('d/m/Y', $timestamp_fecha_ini);
                        $timestamp_fecha_fin = strtotime($data->fecha_fin);
                        $fecha_fin_curso = date('d/m/Y', $timestamp_fecha_fin);

                        $btn_curso = '';
                    
                        $cursos_activos .= '
                                            <div class="col-lg-3 mb-4">
                                                <div class="card card-canal card-curso">
                                                    <div class="card-img-top">
                                                        <a href="fichacurso.php" class="text-dark nav__link">
                                                            <div class="pl-2 pr-2 pt-2">
                                                                <img src="'.$img_curso.'" class="img-fluid w-100">
                                                                <h6 class="mt-3 text-info text-left p-1">'.$num_creditos.'</h6>
                                                                <div class="" style="height:100px;">
                                                                    <p class="mt-3 text-dark text-left p-1">'.$titulo_curso.'</p>
                                                                </div>
                                                                <div class="d-flex flex-row justify-content-left p-2">
                                                                    <div class="text-left">
                                                                        <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark"><b>'.$fecha_ini_curso.'  -  '.$fecha_fin_curso.'</b></span>
                                                                    </div>
                                                                </div>
                                                                <br><div class="text-center">'.$btn_curso.'</div>
                                                            </div>
                                                            <i class="w-100">&nbsp;</i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                    }
                    echo $cursos_activos;
                    ?>
                    
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
