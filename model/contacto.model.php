<?php
defined('_DA') or exit('Restricted Access');

/**
 *
 */

class ContactoModel
{

  public $dbx;
  public $main_table = 'contacto_log';
  public $primary_key = 'id_contacto';

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
   * Get a list of registers of contact form from contact_log table with filters, order and pagination
   *
   * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
   * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
   */
  public function getContactos($params = [])
  {
      $this->dbx->table($this->main_table);

      $this->dbx->attachFilters($params);
      $this->dbx->attachOrder($params);
      $this->dbx->attachPagination($params);

      return $this->dbx->getAll();

  }

  public function saveContacto($fields_values)
  {
      $this->dbx->table($this->main_table);
      $fields = Tools::check_fields($fields_values, 'contacto_log', 'associative');
      return $this->dbx->insert($fields);

  }

}

?>
