<?php
include '../cms/core.php';

$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [100, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$profesiones = new ProfesionesModel();
$params = ['filter' =>$filter, 'pagination' =>$pagination, 'order' =>$order];
$result = $profesiones->getProfesiones($params);
echo json_encode(['profesiones-select'=>$result]);
?>
