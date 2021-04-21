<?php
defined('_DA') or exit('Restricted Access');

/**
 *
 */

class ComunidadesModel
{

  public $dbx;
  public $main_table = 'comunidades';
  public $primary_key = 'id_comunidad';

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

  /**
   * Get a list of comunidades from comunidades table with filters, order and pagination
   *
   * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
   * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
   */
  public function getComunidades($params = [])
  {
      $this->dbx->table($this->main_table);
  
      $this->dbx->attachFilters($params);
      $this->dbx->attachOrder($params);
      $this->dbx->attachPagination($params);

      return $this->dbx->getAll();

  }

}

?>
