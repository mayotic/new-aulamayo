<?php
class CrudModel {
  public $dbx;
  public $crud_table;
  public $crud_primary;

  public function __construct($table, $primary)
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
      $this->crud_table = $table;
      $this->crud_primary = $primary;
  }

  public function crudList( $filters = [],
                            $pagination = [],
                            $order = [],
                            $fields = ['*'],
                            $joins = [] )
  {

      $this->dbx->select(implode(',', $fields))
                ->table($this->crud_table);

      if (!empty($joins)) {
        foreach ($joins as $key => $join) {
          call_user_func_array([$this->dbx, 'join'], $join);
        }
      }

      if (!empty($filters)){
        $this->dbx->where($filters);
      }

      if (!empty($pagination)){
        $this->dbx->pagination($pagination[0], $pagination[1]);
      }

      if (!empty($order)){
        $this->dbx->orderBy($order[0], $order[1]);
      }

      $result = ['rows' => $this->dbx->getAll(), 'total' => $this->dbx->table($this->crud_table)->count($this->crud_primary, 'total_rows')->get()];

      return $result;
  }

  public function crudSave($primary, $values)
  {
  // var_dump($primary);
    // var_dump(!empty($primary) and !empty($values) ); exit;
      // if (!empty($primary) and Tools::is_assoc($primary) and !empty($values) and Tools::is_assoc($values)) {
      if (!empty($primary) and !empty($values)) {
        $result = $this->dbx->table($this->crud_table)
                  ->where($primary)
                  ->update($values);
          return $this->dbx->getQuery() ;
      }
      return false;
  }

  public function crudDelete($primary)
  {
      if (!empty($primary) and Tools::is_assoc($primary) and !empty($values) and is_assoc($values)) {
        $this->dbx->table($this->crud_table)
                  ->where($primary)
                  ->delete();
      }
  }

}
 ?>
