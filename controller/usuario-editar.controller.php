<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $_l;

if(!isset($_SESSION['userlogedin']) && !$_SESSION['userlogedin'] ){ 
    header('Location: /home');
}

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

$textos = new TextoslegalesModel();
$tdata['textos'] = $textos->getTextoslegales(['filter' => ['id_tipo_texto_legal' => 3]]);
//echo "<pre>"; var_dump($tdata['textos']); echo "</pre>"; exit();


$usuario = new UsuariosModel();
$tdata['usuario'] = $usuario->getUsuarios(['filter' => ['id_usuario' => $_SESSION['userlogedin']]]);
//echo "<pre>"; var_dump($tdata['usuario']); echo "</pre>"; exit();