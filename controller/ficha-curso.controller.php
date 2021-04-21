<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $_l;

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

if (Tools::get('curso')) {
    $nombre_curso = $_GET['curso'];
}else{
    Tools::redirect('/home');
}

$curso = new CursosModel();
$id_curso = $curso->getCursos(['filter' => ['url_id' => $nombre_curso]]);


$tdata['curso'] = $curso->getCursos(['filter' => ['cursos.id_curso' => $id_curso[0]->id_curso]]);
//echo "<pre>"; var_dump($tdata['curso']); echo "</pre>"; exit();

if( $tdata['curso'][0]->id_entidad_acreditadora != '0'){
    $entidad_acred = $curso->getNombreEntidadAcreditadoraCurso($tdata['curso'][0]->id_entidad_acreditadora);
    $tdata['entidad_acred'] = $entidad_acred[0]->nombre;
}else{
    $tdata['entidad_acred'] = '';
}

$tdata['cursos_usuario'] = array();
if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){ 
    
    $tdata['mis_cursos'] = $curso->getCursosUsuario(['filter' => ['matriculas.id_usuario' => $_SESSION['userlogedin']], 'order' => ['cursos.fecha_inicio ASC']]);
    
    foreach ($tdata['mis_cursos'] as $miscursos ){
        array_push($tdata['cursos_usuario'], $miscursos->id_curso);
    }
}
