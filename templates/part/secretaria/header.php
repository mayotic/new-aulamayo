<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $_l;
AutoIncludes::loadController(true);
$tdata['pagetitle'] = ucfirst(AutoIncludes::getFileName(true));

// $tdata['pagetitle'] = Tools::_t($tdata['pagetitle']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php var_dump($tdata);?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php

    // Jquery and jquery ui
    echo Tools::loadJquery('2.2.4');
    echo Tools::loadJqueryUI('1.12.1');

    // Load Bootstrap and Font Awesome
    echo Tools::loadBootStrap();
    echo Tools::loadFontAwesome('4.7');

    // Generic css and js files
    echo Tools::loadLibrary('css', 'main');
    echo Tools::loadLibrary('js', 'main');

    // Load especific styles for the page
    echo AutoIncludes::loadCss();
    // Load specific styles for this file
    echo AutoIncludes::loadCss(true);

    // Load especific js for the page
    echo AutoIncludes::loadJs();
    // Load specific js for this file
    echo AutoIncludes::loadJs(true);

    // Other (specific) libraries
    echo Tools::loadLibrary('js', 'tools');
    echo Tools::loadLibrary('js', 'subject-observer');

    ?>
  </head>
  <body class="<?php echo AutoIncludes::getFileName(true); ?>">
    <a href="<?=$conf['appinfo']['url_home']?>">
        <header class="container" style="background-image: url(<?php echo Tools::loadImage('png', 'logo-foro-img');?>), url(<?php echo Tools::loadImage('png', 'logo-foro-text');?>)"> </header>
    </a>
