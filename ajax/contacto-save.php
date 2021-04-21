<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
  die('Acceso no permitido');
}

Tools::loadTranslation($lang = $conf['app']['default_lang']);

if (!Tools::post('nombre') && !Tools::post('apellidos') && !Tools::post('email') && !Tools::post('consulta')) {
    echo json_encode(['status' => 'ko', 'message' => $_l['campos_obl_menos_curso']]  , JSON_UNESCAPED_UNICODE);
    exit();
}

if (!Tools::is_valid_email(Tools::post('email'))) {
    echo json_encode(['status' => 'ko', 'message' => $_l['su_email'], 'campo' => 'email']    , JSON_UNESCAPED_UNICODE);
    exit();
}

sleep(1);
$contacto = new ContactoModel();
$res = $contacto->saveContacto(
        ['nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'id_curso' => (int)$_POST['curso'],
            'texto' => $_POST['consulta'],
            'fecha' => date('Y-m-d H:i:s')]
);

//echo "<pre>"; var_dump($res); echo "</pre>"; exit();
if (is_string($res)) {
    echo json_encode(['status' => 'ok', 'message' => $_l['ok_envio_consulta']], JSON_UNESCAPED_UNICODE);
    exit();
} else {
    echo json_encode(['status' => 'ko', 'message' => $_l['producido_error']], JSON_UNESCAPED_UNICODE);
    exit();
}
?>
