<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
  die('Acceso no permitido');
}

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

/*
if (!Tools::post('nombre') && !Tools::post('apellidos') && !Tools::post('email') && !Tools::post('consulta')) {
    echo json_encode(['status' => 'ko', 'message' => $_l['campos_obl_menos_curso']]  , JSON_UNESCAPED_UNICODE);
    exit();
}

if (!Tools::is_valid_email(Tools::post('email'))) {
    echo json_encode(['status' => 'ko', 'message' => $_l['su_email'], 'campo' => 'email']    , JSON_UNESCAPED_UNICODE);
    exit();
}
*/

sleep(1);
$usuario = new UsuariosModel();

//UPDATE USUARIO
//echo "<pre>"; var_dump($_POST); echo "</pre>"; exit();

if( isset($_POST['accion']) && $_POST['accion'] == 'update' ){

    $res = $usuario->updateUsuario(
            [
                'nombre'           => ucfirst(trim($_POST['nombre'])),
                'apellido_1'       => ucfirst(trim($_POST['apellido1'])),
                'apellido_2'       => ucfirst(trim($_POST['apellido2'])),
                'id_profesion'     => $_POST['profesion'],
                'id_especialidad'  => $_POST['especialidad'],
                'centro_trabajo'   => trim($_POST['centro_trabajo']),
                'id_pais'          => $_POST['pais'],
                'id_comunidad'     => $_POST['provincia'],
                'poblacion'        => $_POST['poblacion'],
                'codigo_postal'    => trim($_POST['codigo_postal'])
                //'texto'          => $_POST['cond'],
                //'texto'          => $_POST['auth'],
                //'auth'           => isset($_POST['auth']) ? 1 : 0
            ], $_SESSION['userlogedin']
    );

    //Update pswd
    if( isset($_POST['password']) && $_POST['password'] != '' ){
        $usuario->updateUsuario( ['pass' => Tools::myEncrypt($_POST['password']) ], $_SESSION['userlogedin'] );
    }

    if ($res || $res == 0) {
        echo json_encode(['status' => 'ok', 'message' => $_l['ok_datos_modificados']], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => 'ko', 'message' => $_l['prod_error_intnuevo']], JSON_UNESCAPED_UNICODE);
    }


//INSERT USUARIO
}else{

    $id_usuario = $usuario->insertUsuario(
            [
                'nombre'           => ucfirst(trim($_POST['nombre'])),
                'apellido_1'       => ucfirst(trim($_POST['apellido1'])),
                'apellido_2'       => ucfirst(trim($_POST['apellido2'])),
                'dni'              => trim($_POST['dni_nie']),
                'id_profesion'     => $_POST['profesion'],
                'id_especialidad'  => $_POST['especialidad'],
                'centro_trabajo'   => trim($_POST['centro_trabajo']),
                'id_pais'          => $_POST['pais'],
                'id_comunidad'     => $_POST['provincia'],
                'poblacion'        => $_POST['poblacion'],
                'codigo_postal'    => trim($_POST['codigo_postal']),
                'email'            => strtolower(trim($_POST['email'])),
                'pass'             => Tools::myEncrypt($_POST['password']),
                'activo'           => 1,
                'fecha_alta'       => date('Y-m-d H:i:s'),
                'id_tipo_usuario'  => USR_TIPO_ESTUDIANTE
                //'texto'          => $_POST['cond'],
                //'texto'          => $_POST['auth'],
                //'auth'           => isset($_POST['auth']) ? 1 : 0
            ]
        , 'App::sendMailAfterRegUser');


    //INSERT TEXTOS LEGALES - USUARIO CHECKED
    $array_checked = json_decode($_POST['array_checked']);
    //echo "<pre>"; var_dump($array_checked); echo "</pre>"; exit();
    if( count($array_checked) > 0 ){
        foreach ($array_checked as $id_texto_legal){
            $text_legales_user = new TextoslegalesModel;
            $tlu = $text_legales_user->setTextoslegalesUsuario(
                [
                    'id_usuario'      => trim($id_usuario),
                    'id_texto_legal'  => trim($id_texto_legal),
                    'fecha'           => date('Y-m-d H:i:s')
                ]
            );
        }
    }

    //INSERT TEXTOS LEGALES - USUARIO NOT CHECKED
    /*
    $array_no_checked = json_decode($_POST["array_no_checked"]);
    foreach ($array_no_checked as $valor_no_sel){
        echo "checkboxes_no_seleccionats: ".$valor_no_sel."<br>";
    }
    */

    if ( $id_usuario ) {
        echo json_encode(['status' => 'ok', 'message' => $_l['ok_usuario_registrado']], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => 'ko', 'message' => $_l['prod_error_intnuevo']], JSON_UNESCAPED_UNICODE);
    }

}
exit();

?>
