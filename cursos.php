<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();

    global $tdata, $_l;

    // Header and menu templates
    Tools::loadTemplatePart('header-front');

    if( isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){
        $id_user = $_SESSION['userlogedin'];
    }else{
        $id_user = 0;
    }

    $ids_cursos_usuario_array = $tdata["cursos_usuario"];
    //echo "<pre>"; var_dump($cursos_usuario_array); echo "</pre>"; exit();

    $ids_cursos_usuario = '';
    if( count($ids_cursos_usuario_array) > 0){
        foreach ($ids_cursos_usuario_array as $id_curso_arrays){
            $ids_cursos_usuario .= $id_curso_arrays."#++#";
        }
    }
    $ids_cursos_usuario = trim($ids_cursos_usuario, "#++#");

    $canalid = $tdata['canal_id'];
    if($canalid == ''){ $canalid = 0; }
?>
<body onload="verCursosActivos(<?=$id_user?>, '<?=$ids_cursos_usuario?>', <?=$canalid?>);" >

        <!-- HEADER -->
        <?php
            $img_canal = '';
            switch ($tdata['nombre_canal']){
                case "Canal Medicina":
                    $img_canal = 'canalmedicina.jpg';
                    break;
                case "Canal Farmacia":
                    $img_canal = 'canalfarmacia.jpg';
                    break;
                case "Canal Enfermería":
                    $img_canal = 'canalenfermecia.jpg';
                    break;
                case "Terapias Emergentes":
                    $img_canal = 'canalterapia.jpg';
                    break;
                default :
                    $img_canal = 'aulamayo-1.jpg';
                    break;
            }
        ?>

        <header class="main-header" style="position: relative; background: url(/public/img/<?=$img_canal?>); background-size: cover;">
            <div class="background-overlay text-black py-5">
                <div class="container">
                    <div class="row d-flex h-100">
                        <div class="col-sm-12 text-center justify-content-center align-self-end">
                            <h1 class="mb-3" style="margin-top:200px;">
                                <?=mb_strtoupper($tdata['nombre_canal'])?>
                            </h1>
                            <div class="input-group text-center justify-content-center">
                                <div class="input-group text-center justify-content-center ">
                                    <input type="text" onKeyUp="fx(this.value, <?=$canalid?>)" name="string_to_search" id="string_to_search" autocomplete="off" class="form-control search-input" placeholder="<?=Tools::_t('encuentra_tu_curso')?>" tabindex="1">
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

        <section class="bg-white" style="max-height:50px;">
            <div class="container" style="max-height:50px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <nav aria-label="breadcrumb" class="bg-white d-flex justify-content-between" style="max-height:50px; margin-right:10px;">
                            <a href="#"></a>
                            <ol class="breadcrumb bg-white">
                                <li class="breadcrumb-item"><a href="/home" class="grey-fort"><i class="fas fa-home text-grey" aria-hidden="true"></i></a></li>
                                <!--<li class="breadcrumb-item"><a href="/cursos" class="grey-fort"><?=mb_strtoupper($_l['cursos'])?></a></li>-->
                                <li class="breadcrumb-item"><a href="http://<?=$_SERVER['SERVER_NAME']?>/home#canalesformativos" class="grey-fort"><?=mb_strtoupper($_l['canales_formativos'])?></a></li>
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($tdata['nombre_canal'])?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <div class="canales2">
            <?=$tdata['list_canales']?>
        </div>

        <section class="text-left">
            <div class="container p-4 ">
                <p class="text-dark">
                    <?php
                        switch ($tdata['nombre_canal']) {
                            case "Canal Medicina":
                                echo Tools::_t('canal_medicina_text1');
                                break;
                            case "Canal Farmacia":
                                echo Tools::_t('canal_farmacia_text1');
                                break;
                            case "Canal Enfermería":
                                echo Tools::_t('canal_enfermeria_text1');
                                break;
                            case "Terapias Emergentes":
                                echo Tools::_t('canal_terapias_emerg');
                                break;
                            default :
                                //echo " Lorem Ipsum is simply dummy text of the printing and typesetting industry.";
                                echo "";
                                break;
                        }
                    ?>
                </p>
            </div>
        </section>

        <!-- CURSOS -->
        <section class="text-center bg-white">
            <div class="container p-2">
                <h3 class=" pb-3 text-center text-black"><?php if( $tdata['nombre_canal'] != 'Todos los cursos' ){ echo mb_strtoupper($_l['cursos']); } echo ' '.mb_strtoupper($tdata['nombre_canal']); ?></h3>
                <div class=" text-left mb-3" role="toolbar" >
                    <div class="btn-group mr-2" role="group">
                        <button id="btn_cursos_activos" type="button" class="btn blue-background text-white mb-2" onclick="verCursosActivos(<?=$id_user?>, '<?=$ids_cursos_usuario?>', <?=$canalid?>);"><?=mb_strtoupper($_l['cursos_activos'])?></button>
                    </div>
                    <div class="btn-group mr-2" role="group">
                        <button id="btn_cursos_realizados" type="button" class="btn blue-outline mb-2" onclick="verTososCursosCanal(<?=$id_user?>, '<?=$ids_cursos_usuario?>', <?=$canalid?>);"><?=mb_strtoupper($_l['todos_cursos'])?></button>
                    </div>
                </div>
                <div id="cards" class="row"></div>
            </div>
            <br/>
        </section>

        <?php
            Tools::loadTemplatePart('footer-front');
        ?>

    </body>
</html>
