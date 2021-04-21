<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['app']['default_lang']);

$canalid = '';
if (Tools::post('canalid')){
    $canalid = $_POST['canalid'];
}

$cursos = new CursosModel();
$hoy = date('Y-m-d');
if( $canalid != 0 ){
    $cursos_realizados = $cursos->getCursos(['filter' => ['activo' => 1, 'id_categoria' => $canalid, 'fecha_fin' => ['<', $hoy] ], 'order' => ['fecha_inicio ASC']]);
}else{
    $cursos_realizados = $cursos->getCursos(['filter' => ['activo' => 1,  'fecha_fin' => ['<', $hoy]  ], 'order' => ['fecha_inicio ASC']]);
}
//echo "<pre>"; var_dump($cursos_realizados); echo "</pre>"; exit();

if( !empty($cursos_realizados) ) {
    echo json_encode(['status' => 'ok', 'result' => $cursos_realizados]);
}else{
    echo json_encode(['status' => 'ko', 'result' => 'No existen cursos.']);
}
exit();

?>
