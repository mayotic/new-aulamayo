<?php
defined('_DA') or exit('Restricted Access');
/**
 *
 */
class PaisesModel
{
  public $dbx;
  public $main_table = 'paises';
  public $primary_key = 'id_pais';

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
  public function getPaises($params = [])
  {
      $this->dbx->table($this->main_table);

      $this->dbx->attachFilters($params);
      $this->dbx->attachOrder($params);
      $this->dbx->attachPagination($params);

      return $this->dbx->getAll();

  }

}

?>
