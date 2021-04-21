<?php
include '../cms/core.php';

$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [10, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$paises = new PaisesModel();
$params = ['filter' =>$filter, 'pagination' =>$pagination, 'order' =>$order];
$result = $paises->getPaises($params);
//echo "<pre>"; var_dump($result); echo "</pre>"; exit();
echo json_encode(['pais-select'=>$result]);
?>
