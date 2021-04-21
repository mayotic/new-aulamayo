<?php
include '../cms/core.php';

$filter = (Tools::post('filter') ? ['id_profesion'=>Tools::post('filter')] : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [100, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$especialidades = new EspecialidadesModel();
$params = ['filter' =>$filter, 'pagination' =>$pagination, 'order' =>$order];
$result = $especialidades->getEspecialidades($params);
echo json_encode(['especialidades-select'=>$result]);
?>
