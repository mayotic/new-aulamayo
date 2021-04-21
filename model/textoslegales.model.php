<?php
defined('_DA') or exit('Restricted Access');
/**
 *
 */
class TextoslegalesModel
{
  public $dbx;
  public $main_table = 'usuario_texto_legal';
  public function __construct()
  {
    $config = [
        'driver'	  => 'mysql',
        'host'		  => _HOST,
        'database'	  => _DB,
        'username'	  => _USER,
        'password'	  => _PASS,
        'charset'	  => 'utf8',
        'collation'	  => 'utf8_general_ci',
        'prefix'	  => ''
    ];
    $this->dbx = new \Buki\Pdox($config);
  }
  public function getTextoslegales($params = []) {
    $this->dbx->table('textos_legales');

    $this->dbx->attachFilters($params);
    $this->dbx->attachOrder($params);
    $this->dbx->attachPagination($params);

    return $this->dbx->getAll();

  }
  public function getTipoTextoLegal($id_texto_legal) {
    $this->dbx->table('textos_legales tl')
              ->leftJoin('usuario_texto_legal utl', 'tl.id_texto_legal', 'utl.id_texto_legal')
              ->where(['tl.id_texto_legal' => $id_texto_legal]);

    return $this->dbx->getAll();
  }
  public function getTextoslegalesCurso($params = []) {
    $this->dbx->table('curso_texto_legal');

    if (!empty($params['filter'])){
      foreach ($params['filter'] as $field => $value) {
        if (is_array($value) and count($value) == 2) {
          $this->dbx->where($field, $value[0], $value[1]);
        }else{
          $this->dbx->where([$field => $value]);
        }
      }
    }

    if(!empty($params['pagination'])){
      call_user_func_array([$this->dbx, 'pagination'], $params['pagination']);
    }

    if(!empty($params['order'])){
      call_user_func_array([$this->dbx, 'orderBy'], $params['order']);
    }

    return $this->dbx->getAll();

  }
  public function setTextoslegalesUsuario($fields_values) {
    $this->dbx->table('usuario_texto_legal');
    $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
    if ($fields) {
      return $this->dbx->insert($fields);
    }else{
      return false;
    }
  }
  
  /**
   * Get a list of legal texts from usuario_texto_legal table with filters, order and pagination
   *
   * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
   * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
  */
  public function getTextoslegalesUsuario($params = []) {
    $this->dbx->table('usuario_texto_legal');

    $this->dbx->attachFilters($params);
    $this->dbx->attachOrder($params);
    $this->dbx->attachPagination($params);

    return $this->dbx->getAll();

  }
  
  
  
  

}

?>
