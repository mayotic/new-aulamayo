<?php
include '../cms/core.php';

$action = (Tools::post('action') ? Tools::post('action') : 'save');

$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [10, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$fields = (Tools::post('fields') ? Tools::post('fields') : ['id_pais row', 'id_pais', 'nombre pais']);

$com_crud = new CrudModel('paises', 'id_pais');
$result = $com_crud->crudList($filter, $pagination, $order, $fields);
echo json_encode(['paises-' . $action => $result['rows'], 'paises-total-rows' => $result['total']->total_rows]);
?>
