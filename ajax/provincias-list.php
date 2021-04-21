<?php
include '../cms/core.php';

$filter = (Tools::post('filter') ? ['id_pais'=>Tools::post('filter')] : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [100, 1]);
$order = (Tools::post('order') ? Tools::post('order') : ['nombre ASC']);

$provincias = new ProvinciasModel();
$params = ['filter' =>$filter, 'pagination' =>$pagination, 'order' =>$order];
$result = $provincias->getProvincias($params);
echo json_encode(['provincias-select'=>$result]);
?>
