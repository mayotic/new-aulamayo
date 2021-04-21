<?php
defined('_DA') or exit('Restricted Access');
/**
 *
 */
class ProfesionesModel
{
  public $dbx;
  public function __construct()
  {
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
  public function getProfesiones($params = []) {
    $this->dbx->table('profesiones');

    $this->dbx->attachFilters($params);
    $this->dbx->attachOrder($params);
    $this->dbx->attachPagination($params);

    return $this->dbx->getAll();

  }
}

?>
