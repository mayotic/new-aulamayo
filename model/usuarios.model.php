<?php
defined('_DA') or exit('Restricted Access');

/**
 * Class for lists, insert or update usuarios
 */
class UsuariosModel
{
  public $dbx;
  public $main_table = 'usuarios';
  public $primary_key = 'id_usuario';

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
   * Get a list of users from usuarios table with filters, order and pagination
   *
   * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
   * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
   */
  public function getUsuarios($params = []) {
    $this->dbx->table('usuarios');

    $this->dbx->attachFilters($params);
    $this->dbx->attachOrder($params);
    $this->dbx->attachPagination($params);

    return $this->dbx->getAll();

  }

  /**
   * Insert a user into usuarios
   * @param  Associative array $fields_values array of fields and values to insert. Format: ['field_name' => [value], 'field_name2' => [value]]
   * @return  Return the iserted row id or false if error
   */
  public function insertUsuario($fields_values, $callback = false)
  {
      $this->dbx->table($this->main_table);
      $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
      if ($fields) {
        $last_insert =  $this->dbx->insert($fields);
        if($last_insert) {
          if ($callback) {
            $callback($last_insert);
          }
          return true;
        }
      }
      return false;
  }

  /**
   * Update usuario $fields
   * @param  associative array $fields_values -> Format: ['field_name' => [value], 'field_name2' => [value]]
   * @param  string / number $key_value    Value of primary key of usuario to update
   * @return [type]                [description]
   */
  public function updateUsuario($fields_values, $key_value)
  {
      $this->dbx->table($this->main_table);
      $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
      $this->dbx->where($this->primary_key, $key_value);
      return $this->dbx->update($fields);

  }

}

?>
