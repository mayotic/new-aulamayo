<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['app']['default_lang']);

if ($email = Tools::request('email')) {

    // echo "<pre>"; var_dump($result); echo "</pre>"; exit();
    if (!empty($pass = App::getPass(Tools::request('email')))) {
        //Pendent enviar email contrasenya
        //echo json_encode(['status' => 'ok', 'message' => $_l['ok_contrasena'], 'data' => Tools::myDecrypt($result)]);
        echo json_encode(['status' => 'ok', 'message' => $_l['ok_contrasena']]);
        $body = '<h2>Ha olvidado su contraseña?</h2>
        <h3>Esta es su contraseña actual: ' . Tools::myDecrypt($pass) . '</h3><br/>
        <br/><br/>
        Secretaria de Aula Mayo<br/>
        email: secretaria@aulamayo.com';
        Tools::sendMail($email, 'Recuperación de contraseña', $body, $email_from_text = 'Secretaria Aula Mayo', $email_reply_text = 'Secretaria Aula Mayo', $email_copy_text = '', $email_copy2_text = '' );
        exit();
    }

    echo json_encode(['status' => 'ko', 'message' => $_l['ko_contrasena']]);
    exit();
}

echo json_encode(['status' => 'ko', 'message' => $_l['ko_contrasena']]);
exit();

?>
