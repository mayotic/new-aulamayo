<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

if (Tools::request('email')) {
    
    $email_user = new UsuariosModel();
    $res = $email_user->getUsuarios(['filter' => ['email' => Tools::request('email')]]);
    
    if($res) {
        echo json_encode(['status' => 'ok', 'message' => $_l['email_repetido'], 'error' => false]);
        exit();
    }else{
        echo json_encode(['status' => 'ko', 'message' => '', 'error' => true]);
        exit();
    }
} 
?>
