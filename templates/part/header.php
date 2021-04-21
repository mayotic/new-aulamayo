<?php
global $conf, $_l;
// Load controllers automatically
AutoIncludes::loadController(true);
// Assign page title to $tdata var
$tdata['pagetitle'] = ucfirst(AutoIncludes::getFileName(true));
?>
<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden;">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$tdata['pagetitle']?></title>
<!--
  Custom fonts for this template
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->

  <!-- Page level plugin CSS-->
  <!-- <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->

  <!-- Custom styles for this template-->

</head>
    <?php

    // Jquery and jquery ui
    echo Tools::loadJquery('2.2.4');
    echo Tools::loadJqueryUI('1.12.1');

    // Load Bootstrap and Font Awesome
    echo Tools::loadBootStrap();
    echo Tools::loadFontAwesome('4.7');

    // Load Dropzone libraries
    echo Tools::loadResourceLibrary('dropzone', 'js', 'dropzone.min');
    echo Tools::loadResourceLibrary('dropzone', 'css', 'dropzone.min');

    // Generic css and js files
    echo Tools::loadLibrary('css', 'main');
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
  </head>

  <body id="page-top <?php echo AutoIncludes::getFileName(true); ?>">

  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 logo-class" style="background-image: url(<?php echo Tools::loadImage('png', 'logo-am');?>)" href="<?=$conf['appinfo']['url_home']?>">
      <!-- <header class="container" style="background-image: url(<?php echo Tools::loadImage('png', 'logo-am');?>)"> </header> -->
    </a>
    <button id="toggle-button" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <!-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a> -->
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a id='logout'  class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>
