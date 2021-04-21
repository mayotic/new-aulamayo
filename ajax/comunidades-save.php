<?php
include '../cms/core.php';

if (Tools::post('filter') and Tools::post('fields')) {
  $action = (Tools::post('action') ? Tools::post('action') : 'save');
  $filter = (Tools::post('filter') ? Tools::post('filter') : ['id_comunidad' => Tools::post('primary')]); // implement extra filter + primary
  $fields = (Tools::post('fields') ? Tools::check_fields( Tools::post('fields'), 'comunidades' ) : ['nombre', 'id_pais']);

  $com_crud = new CrudModel('comunidades', 'id_comunidad');
  $result = $com_crud->crudSave($filter, $fields);
  if ($result) {
    echo json_encode(['message' => 'Operation succesfully', 'sql' => $result]);
  }else {
    echo json_encode(['error' => true, 'message' => 'Error in query']);
  }
}else{
  echo json_encode(['error' => true, 'message' => 'Primary not send']);
}
 ?>
