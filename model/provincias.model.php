<?php
defined('_DA') or exit('Restricted Access');
/**
 *
 */
class ProvinciasModel
{
    public $dbx;
    public function __construct()
    {
        $config = [
            'driver'	  => 'mysql',
            'host'	  => _HOST,
            'database'    => _DB,
            'username'    => _USER,
            'password'    => _PASS,
            'charset'	  => 'utf8',
            'collation'   => 'utf8_general_ci',
            'prefix'	  => ''
        ];
        $this->dbx = new \Buki\Pdox($config);
    }
    public function getProvincias($params = []) {
        $this->dbx->table('comunidades');

        $this->dbx->attachFilters($params);
        $this->dbx->attachOrder($params);
        $this->dbx->attachPagination($params);

        return $this->dbx->getAll();
    }
}
?>
