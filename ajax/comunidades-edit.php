<?php
include_once '../cms/core.php';

if (Tools::post('filter')) {
  include_once 'comunidades-list.php';
}else{
  echo json_encode(['error' => true, 'message' => 'Primary not send']);
}
 ?>
