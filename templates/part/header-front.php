<?php
    global $conf, $_l;
    // Load controllers automatically
    AutoIncludes::loadController();
    // Assign page title to $tdata var
    $tdata['pagetitle'] = ucfirst(AutoIncludes::getFileName(true));
    if( isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){
        $tdata['user'] = new User($_SESSION['userlogedin']);
        //$name_username = $tdata['user']->nombre." ".$tdata['user']->getUserInfo()['apellido_1'];
        //echo "<pre>"; var_dump($tdata['user']); echo "</pre>"; exit();
        //$name_username = $tdata['user']->nombre;
        $name_username = $tdata['user']->nombre.' '.$tdata['user']->apellido_1.' '.$tdata['user']->apellido_2;
    }else{
        $name_username = '';
    }
?>
    <!DOCTYPE html>
    <html lang="es" style="overflow-x: hidden;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php //echo $tdata['pagetitle']; ?>AULAMAYO</title>
        <link rel="icon" type="image/png" href="/public/img/favicon_aulamayo.png">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Raleway:300,400,500,600&display=swap" rel="stylesheet">
    </head>
    <?php
        // Jquery and jquery ui
        echo Tools::loadJquery('3.3.1.min');
        echo Tools::loadJqueryUI('1.12.1');

        // Load Bootstrap and Font Awesome
        echo Tools::loadBootStrap();
        echo Tools::loadFontAwesome('4.7');

        // Load Dropzone libraries
        //echo Tools::loadResourceLibrary('dropzone', 'js', 'dropzone.min');
        //echo Tools::loadResourceLibrary('dropzone', 'css', 'dropzone.min');

        // Generic css and js files
        echo Tools::loadLibrary('css', 'styles');
        echo Tools::loadLibrary('css', 'sweetalert2.min');
        echo Tools::loadLibrary('css', 'animate');
        echo Tools::loadLibrary('js', 'sweetalert2.all.min');

        echo Tools::loadLibrary('js', 'main');

        // Especific libraries
        echo Tools::loadLibrary('js', 'velocity.min');
        echo Tools::loadLibrary('css', 'magic-checkbox.min');

        // Load especific styles for the page
        echo AutoIncludes::loadCss();
        // Load specific styles for this file
        echo AutoIncludes::loadCss(true, false);

        // Load especific js for the page
        echo AutoIncludes::loadJs();
        // Load specific js for this file
        echo AutoIncludes::loadJs(true, false);

        // Other (specific) libraries
        echo Tools::loadLibrary('js', 'tools');
        echo Tools::loadLibrary('js', 'subject-observer');
        echo Tools::loadLibrary('js', 'jquery.dateformat.min');
        echo Tools::loadLibrary('js', 'jquery-paginator');

        // get the user loged in for js
        // echo Tools::exportUserToJs();
        // Load translations
        Tools::loadTranslation($lang = 'es');
    ?>
            <link rel="stylesheet" href="/public/libraries/css/bootstrap-checkboxes.min.css">

            <script type="text/javascript">

              var _gaq = _gaq || [];
              _gaq.push(['_setAccount', 'UA-8749014-3']);
              _gaq.push(['_setDomainName', 'aulamayo.com']);
              _gaq.push(['_setAllowLinker', true]);
              _gaq.push(['_trackPageview']);

              (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
              })();

            </script>

      </head>

      <body id="page-top" style="overflow-x: hidden; <?php echo AutoIncludes::getFileName(true); ?>">

      <!-- NAVIGATION -->
        <div class="sticky">
            <div class="wrap header">

                <header class="content">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <div class="container">
                            <div class="container">
                                <div class="row mt-3">
                                    <div id="logoMayo" class="col-md-2">
                                        <a class="navbar-brand" href="/home">
                                            <img src="<?php echo Tools::loadImage('jpg', 'logo-aulamayo');?>" style="width: 100%;">
                                        </a>
                                    </div>

                                    <div class="col-md-10">

                                        <div id="toolbar" class="text-right" role="toolbar" >

                                            <?php if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){ ?>
                                                    <div class="d-inline-block mr-2" role="group">
                                                        <a href="/mis-cursos" ><button type="button" class="btn btn-outline-info btn_menu btn-sm"><?=Tools::_t('mis_cursos')?></button></a>
                                                    </div>
                                                    <div id="btnUser" class="dropdown acces d-inline-block">
                                                        <button class="btn btn-info dropdown-toggle text-white btn_menu btn-sm" type="button" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <a href="#"><i class="fas fa-user-circle mr-1 text-white ico_user"></i></a>
                                                            <?=$name_username?>
                                                        </button>
                                                        <div class="dropdown-menu down_menu" aria-labelledby="dropdownMenuButton">
                                                            <?php if( isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){ ?>
                                                                <a class="dropdown-item" href="/usuario-editar"><?=Tools::_t('editar_perfil')?></a>
                                                                <hr class="sep-user">
                                                                <a class="dropdown-item" href="#"><span id="logout"><?=Tools::_t('cerrar_sesion')?></span></a>
                                                            <?php }else{ ?>
                                                                <a class="dropdown-item" href="#"><span id="logout"><?=Tools::_t('cerrar_sesion')?></span></a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                            <?php
                                                }else{
                                            ?>
                                                    <div class="btn-group mr-2" role="group">
                                                        <a href="/login" ><button type="button" class="btn btn-outline-info btn_menu btn-sm"><?=Tools::_t('iniciar_sesion')?></button></a>
                                                    </div>
                                                    <div class="btn-group mr-2" role="group">
                                                        <a href="/registro" ><button type="button" class="btn btn-info btn_menu btn-sm"><?=Tools::_t('registrarse')?></button></a>
                                                    </div>
                                            <?php
                                                }
                                            ?>

                                            <button id="menu_lines" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                        </div>


                                        <div class="collapse navbar-collapse mt-2" id="navbarNav">
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/conocenos"><?=mb_strtoupper($_l['conocenos'])?></a>
                                                </li>
                                                <li class="nav-item border-md-right">
                                                    <!--<a class="nav-link" href="/cursos"><?=mb_strtoupper($_l['cursos'])?></a>-->
                                                    <a class="nav-link" href="http://<?=$_SERVER['SERVER_NAME']?>/home#canalesformativos" id="canales_formativos"><?=mb_strtoupper($_l['canales_formativos'])?></a>
                                                </li>
                                                <li class="nav-item border-md-right">
                                                    <a class="nav-link" href="/faqs"><?=mb_strtoupper($_l['preguntas_frecuentes'])?></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/contacto"><?=mb_strtoupper($_l['secretaria'])?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </nav>
                </header>
            </div>
        </div>
