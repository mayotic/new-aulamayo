<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
  die('Acceso no permitido');
}

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

/*
if (!Tools::post('referencia') && !Tools::post('id_usuario') && !Tools::post('id_curso')) {
    echo json_encode(['status' => 'ko', 'message' => ''  , JSON_UNESCAPED_UNICODE);
    exit();
}
*/

if( isset($_POST) ){
    
    //INSERT TEXTOS LEGALES-USUARIO
    $ids_textos_legales = json_decode($_POST['array_ids_textos_legales']);
    //echo "<pre>"; var_dump($ids_textos_legales); echo "</pre>"; exit();
    
    if( count($ids_textos_legales) > 0 ){
        foreach ($ids_textos_legales as $id_texto_legal){
            $text_legales_user = new TextoslegalesModel;
            $tlu = $text_legales_user->setTextoslegalesUsuario(
                [ 
                    'id_usuario'      => trim($_POST['id_usuario']),  
                    'id_texto_legal'  => trim($id_texto_legal),
                    'id_curso'        => trim($_POST['id_curso']),
                    'fecha'           => date('Y-m-d H:i:s')
                ]
            );
        }
    }
    
    //INSERT MATRICULA
    $matricula = new MatriculasModel();
    $mat = $matricula->insertMatricula( 
        [
            'referencia'       => trim($_POST['referencia']),
            'id_usuario'       => trim($_POST['id_usuario']),
            'fecha_creacion'   => date('Y-m-d H:i:s'),
            'activa'           => 1, 
            'id_curso'         => trim($_POST['id_curso'])
        ]
    );
    
    if( $mat ){
        echo json_encode(['status' => 'ok', 'message' => $_l['ok_usuario_registrado']], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['status' => 'ko', 'message' => $_l['prod_error_intnuevo']], JSON_UNESCAPED_UNICODE);
    }
}
exit();
?>
