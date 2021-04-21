<?php
include '../cms/core.php';

$filter = (Tools::post('filter') ? ['id_comunidad'=>Tools::post('filter')] : []);
//$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [100, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$localidades = new LocalidadesModel();
$params = ['filter' =>$filter, 'pagination' =>$pagination, 'order' =>$order];
$result = $localidades->getLocalidades($params);
//echo "<pre>"; var_dump($result); echo "</pre>"; exit();
echo json_encode(['poblaciones-select'=>$result]);
?>
