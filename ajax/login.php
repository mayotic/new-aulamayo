<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

    if( !Tools::post('user') && !Tools::post('pass') ){
        echo 'error1';
        exit();
    }

    if( Tools::is_valid_email(Tools::post('user')) ){
        $user = new Auth();
        if ($user->login()) {
          echo 'ok';
        }else{
          echo 'error2';
        }
    }
?>
