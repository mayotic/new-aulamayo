<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['app']['default_lang']);

$cursos = new CursosModel();
$filter = ['activo' => 1, 'fecha_fin' => ['>', date('Y-m-d')] ];

if ($canalid = Tools::post('canalid')) {
  $filter['id_categoria'] = $canalid;
}

$cursos_activos = $cursos->getCursos(['filter' => $filter, 'order' => ['fecha_inicio ASC']]);

$status= 'ko'; $result = 'No existen cursos.';
if (!empty($cursos_activos)) {
  // var_dump($cursos_activos); exit;
  foreach ($cursos_activos as $key => $curso) {
    $cursos_activos[$key]->btn_curso = $cursos->getMoodleAccessCourseButton((!empty($curso) ? $curso->id_curso : 0), (!empty($_SESSION['userlogedin']) ? $_SESSION['userlogedin']  : 0));
  }
  $status = 'ok'; $result = $cursos_activos;
}

echo json_encode(['status' => $status, 'result' => $result]);

exit();

?>
