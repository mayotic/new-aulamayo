<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $_l;

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

$canal =  $_l['todos_los_cursos'];
if(isset($_GET['canal'])){
    $canal = $_GET['canal'];
}

$canales = new CanalesModel();
$tdata['canales'] = $canales->getCanales();

$tdata['nombre_canal'] = $_l['todos_los_cursos'];
$canales_toshow = array();
foreach ($tdata['canales'] as $data){
    if( $canal != $data->url_id ){
        array_push($canales_toshow,$data->id_categoria);
    }else{
        $tdata['nombre_canal'] = $data->nombre;
    }
}

$list_canales = '<ul>';
$total_canals = count($canales_toshow);
$i = 1;
foreach ($canales_toshow as $channel){
    $can = $canales->getCanales(['filter' => ['id_categoria' => $channel]]);
    foreach ($can as $ca){
        $list_canales .= '<li><a href="/cursos/'.$ca->url_id.'">'.$ca->nombre.'</a></li>';
        if( $i < $total_canals){ $list_canales .= '<hr>'; }
    }
    $i++;
}
$list_canales .= '</ul>';

$tdata['list_canales'] = $list_canales;


$cursos = new CursosModel();
$tdata['cursos_destacados'] = $cursos->getCursos(['filter' => ['destacado' => 1, 'activo' => 1], 'order' => ['fecha_inicio ASC']]);


if(isset($_GET['canal'])){
    $canalid = $cursos->getCanalId($_GET['canal']);
    $tdata['cursos_activos'] = $cursos->getCursos(['filter' => ['activo' => 1, 'id_categoria' => $canalid->id_categoria], 'order' => ['fecha_inicio ASC']]);
    $tdata['canal_id'] = $canalid->id_categoria;
}else{
    $tdata['cursos_activos'] = $cursos->getCursos(['filter' => ['activo' => 1], 'order' => ['fecha_inicio ASC']]);
    $tdata['canal_id'] = '';
}
//echo "<pre>"; var_dump($tdata['cursos_activos']); echo "</pre>"; exit();

$tdata['cursos_usuario'] = array();
if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){

    $tdata['mis_cursos'] = $cursos->getCursosUsuario(['filter' => ['matriculas.id_usuario' => $_SESSION['userlogedin']], 'order' => ['cursos.fecha_inicio ASC']]);

    foreach ($tdata['mis_cursos'] as $miscursos ){
        array_push($tdata['cursos_usuario'], $miscursos->id_curso);
    }
}
