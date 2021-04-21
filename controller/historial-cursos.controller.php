<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata;

//echo "<pre>"; var_dump($_SESSION); echo "</pre>"; exit();

$cursos = new CursosModel();
// $tdata['cursos_historial'] = $cursos->getCursos(['filter' => ['usuario_curso.id_usuario' => $_SESSION['userlogedin']], 'order' => ['fecha_inicio ASC']]);
$tdata['cursos_historial'] = $cursos->getCursosUsuario(['filter' => ['usuario_curso.id_usuario' => $_SESSION['userlogedin']], 'order' => ['cursos.fecha_inicio ASC']]);
// $tdata['cursos_historial'] = $cursos->getCursos(['filter' => ['activo' => 1], 'order' => ['fecha_inicio ASC']]);
