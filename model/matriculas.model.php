<?php
defined('_DA') or exit('Restricted Access');
/**
 *
 */
class MatriculasModel
{
  public $dbx;
  public $main_table = 'matriculas';
  public $primary_key = 'id_matricula';

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
  public function getMatriculas($params = []) {
    $this->dbx->table('matriculas');

    $this->dbx->attachFilters($params);
    $this->dbx->attachOrder($params);
    $this->dbx->attachPagination($params);

    return $this->dbx->getAll();

  }

  /**
   * Insert a course into cursos
   * @param  Associative array $fields_values array of fields and values to insert. Format: ['field_name' => [value], 'field_name2' => [value]]
   * @return  Return the iserted row id or false if error
   */
  public function insertMatricula($fields_values)
  {
      $this->dbx->table($this->main_table);
      $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
      return $this->dbx->insert($fields);

  }
}

?>
