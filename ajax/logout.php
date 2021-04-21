<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

$user = new Auth();
if ($user->logout()) {
  echo 'ok';
}else{
  echo 'error';
}
?>
