
<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    global $tdata;
    AutoIncludes::loadController();

    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>
    <body>
        <!-- MAIN HEADER -->
        <header class="main-header" style="position: relative; background: url(/public/img/aulamayo-1.jpg); background-size: cover; min-height: 400px;">
            <div class="background-overlay text-black py-5">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-12 text-center justify-content-center align-self-end">
                            <h1 class="mb-3" style="margin-top:200px; font-size: 160%;">
                                <?=Tools::_t('la_plataforma')?>
                            </h1>
                            <div class="input-group text-center justify-content-center">
                                <div class="input-group text-center justify-content-center ">
                                    <input type="text" onKeyUp="fx(this.value, '')" name="string_to_search" id="string_to_search" autocomplete="off" class="form-control search-input" placeholder="<?=Tools::_t('encuentra_tu_curso')?>" tabindex="1">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn query-submit"  tabindex="2"><i class="fa fa-search" style="color:#727272; font-size:20px"></i></button>
                                    </div>
                                </div>
                                <div id="livesearch" class="text-center justify-content-center"></div>
                            </div>
                            <div id="search-layer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- AULA MAYO -->
        <section class=" text-left bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">
                        <p id="canalesformativos">
                            <?=Tools::_t('aula_mayo_text1')?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BANNERS -->

        <section  class="text-center bg-light">
          <?php Tools::loadTemplatePart('home-banners') ?> 
        </section>

        <!--
        <div class="social">
            <a href="#"><img src="<?php //echo Tools::loadImage('png', 'podemos-ayudarte');?>"></a>
	</div>
        -->

        <!-- CANALES FORMATIVOS -->
        <?php if( !empty($tdata['canales']) ) :  ?>
            <section  class="text-center bg-light">
                <div class="container p-5">
                    <h3 class=" pb-1 text-center text-black"><?=mb_strtoupper($_l['canales_formativos'])?></h3>
                    <div class="text-center mb-3"><img src="<?php echo Tools::loadImage('jpg', 'sep');?>" class="img-fluid w-40"></div>
                    <p class="text-left"><?=Tools::_t('text_canales_formativos')?></p>
                    <br/>
                    <div class="row">
                        <?php
                            foreach ($tdata['canales'] as $data) :
                                $imagen = explode('.', $data->imagen);
                                $name_img = $imagen[0];
                                $ext_img = $imagen[1];
                        ?>
                                <div class="col-lg-3">
                                    <div class="card card-canal mb-3">
                                        <a href="/cursos/<?=$data->url_id?>">
                                            <div class="card-img-top">
                                                <img src="<?php echo Tools::loadImage($ext_img, $name_img);?>" class="img-fluid w-100">
                                                <h6 class="mt-3"><?php echo mb_strtoupper($data->nombre); ?></h6>
                                                <div class="text-center mb-2"><img src="<?php echo Tools::loadImage('jpg', 'sep');?>" width="75"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- <section   class="text-center bg-light pb-5">
          <a target="_blank" href="https://www.diabetes.lilly.es/hcp/baqsimi?utm_source=ActaPediatrica&utm_medium=banner&utm_campaign=LanzamientoBaqsimi">
            <img class="img-fluid" src="<?=Tools::loadImage('gif', 'banner_BAQSIMI_735x80-A_OV')?>"/>
          </a>
        </section> -->

        <section   class="text-center bg-light pb-5">
          <!--Banner 1-->
          <center>
            <a href="<?php  echo $banner_ad[$key1]["url"];?>" onClick="_gaq.push(['_trackEvent', 'baqsimi-aulamayo', 'Click', '<?php echo $banner_ad[$key1]["title"];?>',,true]);" target="_blank">
            <img class="img-fluid" src="<?php echo $banner_ad[$key1]["img"];?>" alt="<?php echo $banner_ad[$key1]["title"];?>" border="0"/></a>
            <img  width=0 height=0 src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onload="_gaq.push(['_trackEvent', 'baqsimi-aulamayo', 'Impression', '<?php echo $banner_ad[$key1]["title"];?>',,true]); ">
          </center>
          <!--end of Banner 1-->
        </section>

        <section   class="text-center bg-light pb-5">
          <!--Banner 2-->
          <center>
            <a href="https://res.mail1.gskpro.com/res/gsk_mkt_prod1/20ee21b5f92e5a04e8ada1281f406886.pdf" target="_blank">
              <img class="img-fluid" src="/public/img/MEN-BEX-banner-vademecum_728x90.gif" />
            </a>
          </center>
          <!--end of Banner 2-->
        </section>

        <!-- POR QUE AULA MAYO -->
        <section class="text-center">
            <div class="container p-5 ">
                <p class="blue-text w400">
                    <b>
                        <?php //echo Tools::_t('aula_mayo_text2'); ?>
                    </b>
                </p>
                <h3 class=" pb-3 text-center blue-text w400"><b><?=Tools::_t('porque_aulamayo')?></b></h3>
                <p class="text-dark">
                    <?php //echo Tools::_t('aula_mayo_text3'); ?>
                </p>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <div class="card-body icon-whyaulamayo">
                                <img src="<?php echo Tools::loadImage('png', 'tutorial');?>" class="img-fluid rounded-circle mb-3">
                                <p>
                                    <?=Tools::_t('aula_mayo_text4')?>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <div class="card-body icon-whyaulamayo">
                                <img src="<?php echo Tools::loadImage('png', 'aprendizaje');?>" class="img-fluid rounded-circle mb-3">
                                <p>
                                    <?=Tools::_t('aula_mayo_text5')?>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <div class="card-body icon-whyaulamayo">
                                <img src="<?php echo Tools::loadImage('png', 'certificado');?>"  class="img-fluid rounded-circle mb-3">
                                <p>
                                    <?=Tools::_t('aula_mayo_text7')?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CURSOS DESTACADOS -->
        <?php if( !empty($tdata['cursos_destacados']) ){  ?>
            <section class="mb-3">
                <div class="container my-4">
                    <h3 class=" pb-1 text-center text-black"><?=mb_strtoupper($_l['cursos_destacados'])?></h3>
                    <div class="text-center"><img src="<?php echo Tools::loadImage('jpg', 'sep');?>" class="img-fluid w-40"></div>
                    <!--Carousel Wrapper-->
                    <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel" data-interval="false">

                        <?php
                            $total_cursos = count($tdata['cursos_destacados']);
                            if( $total_cursos > 3 ){
                                $controls = '
                                            <!--Controls-->
                                            <div class="controls-indicators text-right mt-1 mb-1">
                                                <a class="btn-floating" href="#multi-item-example" data-slide="prev"><span style="font-size:40px; color:#17a2b8;"><i class="fa fa-chevron-circle-left"></i></span></a>
                                                <a class="btn-floating" href="#multi-item-example" data-slide="next"><span style="font-size:40px; color:#17a2b8;"><i class="fa fa-chevron-circle-right"></span></i></a>
                                            </div>
                                            <!--/.Controls-->
                                        ';
                        ?>

                        <?php
                            }else{
                                $controls = '</br></br>';
                            }
                            echo $controls;
                        ?>

                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">

                            <?php
                            $carrousel = '';
                            $i = 1;
                            foreach ($tdata['cursos_destacados'] as $data){
                                if( $i == 1 ){ $active = 'active'; }else{ $active = ''; }

                                if( ($i == 1) ){
                                    $carrousel .= '<div class="carousel-item '.$active.'">';
                                    $carrousel .= '<div class="row">';
                                }

                                $id_curso = $data->id_curso;
                                $nombre_curso = $data->nombre;
                                $id_moodle = $data->id_moodle;
                                $precio_curso = $data->precio;
                                $imagen = explode('.', $data->imagen);
                                $name_img = $imagen[0];
                                $ext_img = $imagen[1];
                                $img_curso = Tools::loadImage($ext_img, $name_img);
                                if( $data->creditos == '' || $data->creditos == 0){
                                    $num_creditos = '&nbsp;';
                                }else{
                                    $num_cred = explode('.', $data->creditos);
                                    if( $num_cred[1] == '00' && $num_cred[0] == '1' ){
                                        $num_creditos = $num_cred[0].' '.mb_strtolower($_l['credito']);
                                    }else{
                                        $num_creditos = number_format($data->creditos, 2, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $num_cred[1] == '00' && $num_cred[0] != '1' ){
                                        $num_creditos = number_format($data->creditos, 0, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $data->creditos == '0.01'){
                                        $num_creditos = '0,1 '.mb_strtolower($_l['credito']);
                                    }
                                    if( substr($data->creditos, -1) == '0' && $num_cred[1] != '00' ){
                                        $num_creditos = number_format($data->creditos, 1, ',', '.').' '.mb_strtolower($_l['creditos']);
                                    }
                                    if( $num_cred[1] == '10' ){ $num_creditos = number_format($data->creditos, 1, ',', '.').' '.mb_strtolower($_l['credito']); }
                                }
                                $titulo_curso = mb_strtoupper($data->nombre);
                                $timestamp_fecha_ini = strtotime($data->fecha_inicio);
                                $fecha_ini_curso = date('d/m/Y', $timestamp_fecha_ini);
                                $timestamp_fecha_fin = strtotime($data->fecha_fin);
                                $fecha_fin_curso = date('d/m/Y', $timestamp_fecha_fin);
                                $url_id_curso = $data->url_id;

                                $cursos = new CursosModel();
                                $form_moodle = $cursos->getMoodleAccessCourseButton((!empty($id_curso) ? $id_curso : 0), (!empty($_SESSION['userlogedin']) ? $_SESSION['userlogedin']  : 0));

                                $carrousel .= '
                                        <div class="col-md-4">
                                            <div class="card card-canal card-curso mb-3">
                                                <div class="card-img-top">
                                                    <a href="/ficha-curso/'.$url_id_curso.'" class="text-dark nav__link">
                                                        <div class="pl-2 pr-2 pt-2">
                                                            <img src="'.$img_curso.'" class="img-fluid w-100">
                                                            <h6 class="mt-3 text-info text-left p-1">'.$num_creditos.'</h6>
                                                            <div style="height:90px;">
                                                                <p class="mt-3 text-dark text-left p-1"><span class="font-weight-bold">'.$titulo_curso.'</span></p>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-left p-2">
                                                                <div class="text-left">
                                                                    <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark"><b>'.$fecha_ini_curso.'  -  '.$fecha_fin_curso.'</b></span>
                                                                </div>
                                                            </div>
                                                            <br><div class="text-center">'.$form_moodle.'</div>
                                                        </div>
                                                        <i class="w-100">&nbsp;</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    ';

                                if( ($i % 3 == 0) && $i <= $total_cursos ){
                                    $carrousel .= '</div>';
                                    $carrousel .= '</div>';
                                    $carrousel .= '<div class="carousel-item">';
                                    $carrousel .= '<div class="row">';
                                }elseif($i == $total_cursos){
                                    $carrousel .= '</div>';
                                    $carrousel .= '</div>';
                                }
                                $i++;
                            }

                            echo $carrousel;
                            ?>
                        </div>
                        <!--/.Slides-->
                    </div>
                    <!--/.Carousel Wrapper-->
                </div>
                <br/>
            </section>
        <?php }  ?>

        <?php
            Tools::loadTemplatePart('footer-front');
        ?>

        <script>
            jQuery(document).ready(function(){
                <?php if( $total_cursos <= 3){  ?>
                    $('.carousel').carousel('pause');
                <?php }  ?>
            });
        </script>

    </body>
</html>
