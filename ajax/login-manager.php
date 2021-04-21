<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

    if( !Tools::post('user') && !Tools::post('pass') ){
        echo 'error1';
        exit();
    }

    if( Tools::is_valid_email(Tools::post('user')) ){
        $user = new Auth();
        if ($user_logedin = $user->login() and Tools::isManager()) {
          // var_dump($user->login()); exit;
            if (Tools::isAdminUser($user_logedin->id_usuario)) {
              echo json_encode(['error' => false, 'message' => 'Autentificación correcta']);
              exit();
            }
            echo json_encode(['error' => true, 'message' => 'No tiene privilegios para acceder a esta página']);
            exit();
        }else{
          echo json_encode(['error' => true, 'message' => 'Credenciales incorrectas o no es entorno manager']);
          exit();
        }
    }
?>
