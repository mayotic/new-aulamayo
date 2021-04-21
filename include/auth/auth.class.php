<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

class Auth {
  public $dbx;
  public $users_table;
  public $userid_field;
  public $useremail_field;
  public $userpass_field;
  public function __construct() {
    $this->userid_field = 'id_usuario';
    $this->users_table = 'usuarios';
    $this->useremail_field = 'email';
    $this->userpass_field = 'pass';

    $config = [
      'driver'	    => 'mysql',
      'host'		    => _HOST,
      'database'	  => _DB,
      'username'	  => _USER,
      'password'	  => _PASS,
      'charset'	    => 'utf8',
      'collation'	  => 'utf8_general_ci',
      'prefix'	    => ''
    ];
    $this->dbx = new \Buki\Pdox($config);
  }
  public function checkLoginAndRedirect($url = false, $url_notrights = false) {
      // If not auhtenticaded session go to $conf['appinfo']['url_notrights'] else $conf['appinfo']['url_home']
      global $conf;
      if (!self::checkLogin()) {
        Tools::redirect(($url_notrights ? $url_notrights : $conf['appinfo']['url_notrights']));
      }
      if ($url){
        Tools::redirect($url);
      }
      return true;
  }

  public function checkLogin() {
      if (empty($_SESSION['userlogedin'])) {
        return false;
      }else{
        return true;
      }
  }

  public function logedIn() {
    return $this->checkLogin();
  }

  public function logout() {
    //$_SESSION['userlogedin'] = false;
    if (isset($_SESSION['userlogedin'])) {
        unset($_SESSION["userlogedin"]);
    }
    return true;
  }

  public function login() {
      $this->email = isset($_POST['user']) ? $_POST['user'] : '';
      $this->pass = isset($_POST['pass']) ? $_POST['pass'] : '';

      if (!$user_logedin = $this->isValidUser($this->email, Tools::myEncrypt($this->pass))) {
          $_SESSION['userlogedin'] = false;
          return false;
      }

      $_SESSION['userlogedin'] = $user_logedin->{$this->userid_field};
      return $user_logedin;
  }

  public function isValidUser($email, $pass) {
      if ( $user = $this->dbx
                  ->select($this->userid_field)
                  ->table($this->users_table)
                  ->where([$this->useremail_field => $email, $this->userpass_field => $pass, 'activo' => 1])
                  ->get()) {
        return $user;
      }
      return false;
  }
}
