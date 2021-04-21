<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['app']['default_lang']);

$user_info = [];
if(!empty($_SESSION['userlogedin'])) {
  $users = new UsuariosModel();
  $user_info = ( !empty( $usr = $users->getUsuarios(['filter' => ['id_usuario' => $_SESSION['userlogedin']]]) ) ? $usr : [] );
}

$cursos = new CursosModel();
$filter = ['activo' => 1, 'fecha_fin' => ['>', date('Y-m-d')] ];

if ($canalid = Tools::post('canalid')) {
  $filter['id_categoria'] = $canalid;
}

$cursos_activos = $cursos->getCursos(['filter' => $filter, 'order' => ['fecha_inicio ASC']]);

// Si usuari consell, agafem els cursos pendent acreditació
if (!empty($user_info) and $user_info[0]->id_tipo_usuario == USR_TIPO_CONSEJO) {
    $cursos_acreditacion = $cursos->getCursos(['filter' => ['activo' => 0, 'pendiente_acreditacion' => 1], 'order' => ['fecha_inicio ASC']]);

    if (!empty($cursos_acreditacion)) {
      $cursos_activos = array_merge($cursos_activos, $cursos_acreditacion);
    }
}
// var_dump($user_info);
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
