<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $_l;

if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){ 
    header('Location: /home');
}

Tools::loadTranslation($lang = $conf['app']['default_lang']);

$textos = new TextoslegalesModel();
$tdata['textos'] = $textos->getTextoslegales(['filter' => ['id_tipo_texto_legal' => 3]]);
