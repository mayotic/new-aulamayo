<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

//echo "<pre>"; var_dump($_POST); echo "</pre>"; exit();
if (Tools::post('idcurso')) {
    $id_curso = $_POST['idcurso'];
}

$textos_legales = new TextoslegalesModel();
$texts_legales_curso = $textos_legales->getTextoslegalesCurso(['filter' => ['curso_texto_legal.id_curso' => $id_curso]]);

$textos_legales_array = array();
foreach($texts_legales_curso as $text_legal_curso){
    $id_texto_legal = $text_legal_curso->id_texto_legal;
    
    $text_legal_desc = $textos_legales->getTextoslegales(['filter' => ['id_texto_legal' => $id_texto_legal]]);
    $titulo = $text_legal_desc[0]->titulo;
    $texto = $text_legal_desc[0]->texto;
    $url = $text_legal_desc[0]->url;
    $obligatorio = $text_legal_desc[0]->obligatorio;
    
    $texts_legals = $titulo.'#--#'.$texto.'#--#'.$url.'#--#'.$obligatorio.'#--#'.$id_texto_legal.'#--#'.$id_curso;
    array_push($textos_legales_array, $texts_legals);
    
}

if (!empty($texts_legals)) {
    echo json_encode(['status' => 'ok', 'texts_legals' => $textos_legales_array]);
}else{
    echo json_encode(['status' => 'ko', 'message' => $_l['ko_contrasena']]);
}
exit();
?>
