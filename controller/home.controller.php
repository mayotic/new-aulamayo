<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $banner_ad, $key1;

// Chanels
$canales = new CanalesModel();
$tdata['canales'] = $canales->getCanales();

// Courses
$cursos = new CursosModel();
$tdata['cursos_destacados'] = $cursos->getCursos(['filter' => ['destacado' => 1, 'activo' => 1], 'order' => ['fecha_inicio ASC']]);

// User
if (!empty($_SESSION['userlogedin'])) {
  $user = new User($_SESSION['userlogedin']);
  // var_dump($user->tipo_usuario);
  if ($user->tipo_usuario == USR_TIPO_CONSEJO) {
    $cursos_consejo = $cursos->getCursos(['filter' => ['activo' => 0, 'pendiente_acreditacion' => 1], 'order' => ['fecha_inicio ASC']]);
    $tdata['cursos_destacados'] = array_merge($tdata['cursos_destacados'], $cursos_consejo);
  }
}

// User courses
$tdata['cursos_usuario'] = array();
if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){
    $tdata['mis_cursos'] = $cursos->getCursosUsuario(['filter' => ['matriculas.id_usuario' => $_SESSION['userlogedin']], 'order' => ['cursos.fecha_inicio ASC']]);
    foreach ($tdata['mis_cursos'] as $miscursos ){
        array_push($tdata['cursos_usuario'], $miscursos->id_curso);
    }
}

// publi

$banner_ad = array(
                  array("title" => "Banner baqsimi aulamayo",
                        "img"  =>  Tools::loadImage('gif', 'banner_BAQSIMI_735x80-A_OV'),
                        "url"  =>  'https://www.diabetes.lilly.es/hcp/baqsimi?utm_source=ActaPediatrica&utm_medium=banner&utm_campaign=LanzamientoBaqsimi',
                        )
                  );

//Random Key For One Banner
$key1 = array_rand($banner_ad);

//replaces spaces in title with underscore, incase there are any (optional)
$banner_ad[$key1]["title"] = str_replace(' ', '_', $banner_ad[$key1]["title"]);
