<?php
include '../cms/core.php';

$action = (Tools::post('action') ? Tools::post('action') : 'save');

$filter = (Tools::post('filter') ? Tools::post('filter') : []);
$pagination = (Tools::post('pagination') ? Tools::post('pagination') : [10, 1]);
$order = (Tools::post('order') ? Tools::post('order') : []);

//Falta afegir els altres camps de la taula...
$fields = (Tools::post('fields') ? Tools::post('fields') : ['id_pais row', 'id_curso', 'nombre']);


$cursos = new CursosModel();
$result = $cursos->getCursos(['fields' => ['id_curso', 'nombre'], 'filter' => ['url_curso_externo' => '', 'activo' => 1],   'order' => $order]);
//echo "<pre>"; var_dump($result); echo "</pre>"; exit();
//echo json_encode(['cursos-' . $action => $result['rows'], 'cursos-total-rows' => $result['total']->total_rows]);
echo json_encode(['cursos' => $result, 'totalcursos' => count($result)]);

?>
