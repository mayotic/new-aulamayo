<?php
include_once '../cms/core.php';

$action = (Tools::post('action') ? Tools::post('action') : 'list');

$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [10, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

$fields = (Tools::post('fields') ? Tools::check_fields( Tools::post('fields'), 'comunidades' ) : ['c.id_comunidad row', 'c.id_comunidad', 'c.nombre comunidad', 'p.id_pais', 'p.nombre pais']);
$joins = [['paises p', 'c.id_pais', 'p.id_pais']];

$com_crud = new CrudModel('comunidades c', 'c.id_comunidad');
$result = $com_crud->crudList($filter, $pagination, $order, $fields, $joins);

echo json_encode(['comunidades-' . $action => $result['rows'], 'total-rows' => $result['total']->total_rows]);
?>
