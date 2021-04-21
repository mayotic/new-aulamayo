<?php
global $conf, $appconf, $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

// Init user object
$user = new User($_SESSION['userlogedin']);
$tdata['userlogedin'] = json_encode(['id' => $user->id, 'tipo_inscrito' => $user->tipo_inscrito]);

// User is admin
$is_admin = App::getUserTipe($_SESSION['userlogedin']) == $appconf['tipo_admin'] ? true : false;

$tipoins_where = 'id_tipo_inscrito = ' . $appconf['tipo_asistente'];
$respons_where = 'id_tipo_inscrito IN (' . $appconf['tipo_delegado'] . ')';

// For 'inscrito' type conditionals
switch ($user->tipo_inscrito) {
  case $appconf['tipo_admin']:
    break;

  case $appconf['tipo_gerente']:
    break;

  case $appconf['tipo_delegado']:
    break;
}
// var_dump($defaults); exit;
$grid   = [
          'language'          =>  'es',
          'table'             =>  'economics',
          'table_name'        =>  'Costes por inscrito <i class="fa fa-euro-sign"></i>',
          'unset_add'         =>  true,
          'unset_view'        =>  false,
          'unset_remove'      =>  true,
          'unset_csv'         =>  false,
          'unset_print'       =>  false,
          'unset_edit'        =>  true,
          'templates'         =>  ['list' => 'xcrud_list_view-economic.php'],
          // 'templates' => ['[list,view,edit,create]' => 'file.php'],
          // 'vars'              =>  ['var'  =>  [value]],
          // 'hide_button'       =>  'view',  //view, edit, remove, duplicate, add, csv, print, save_new, save_edit, save_return, return
          'list_limit'        =>  25,
          'where'             =>  'id_tipo_inscrito <> ' .$appconf['tipo_admin'],
          // 'pass_default'      =>  [$defaults],
          'search_columns'    =>  ['id_tipo_inscrito,id_gerente,nombre,apellido_1,apellido_2,email'],
];

// Fields xcrud setup
$fields = [
  'id_inscrito'         =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              'tab'              =>  false
                            ],
  'id_tipo_inscrito'    =>  [ 'label'            =>  'Tipo inscrito',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                            ],
  'id_gerente'          =>  [ 'label'            =>  'Responsable',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         => ['inscritos', 'id_inscrito', ['nombre', 'apellido_1', 'apellido_2'], $respons_where],
                          ],
  'nombre'              =>  [ 'label'            =>  '<br/><h4><i class="far fa-address-card"></i> &nbsp;Datos asistente</h4><hr/>Nombre',
                              'column_name'      =>  'Nombre',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'apellido_1'          =>  [ 'label'            =>  'Apellido 1',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'apellido_2'          =>  [ 'label'            =>  'Apellido 2',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'email'               =>  [ 'label'            =>  'email',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'tot_precio_ida'          =>  [ 'label'            =>  'Viaje ida',
                              'columns'          =>  true,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'sum'              => true,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte'
                          ],
 'tot_precio_vuelta'        =>  [ 'label'          =>  'Viaje vuelta',
                              'columns'          =>  true,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'sum'              => true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                          ],
  'precio_alojamiento'    =>  [ 'label'            =>  'Alojamiento',
                                'columns'          =>  true,
                                'column_name'      =>  '',
                                'column_callback'  =>  false,
                                'fields'           =>  $is_admin ? true : false,
                                'sum'              => true,
                                'disabled'         =>  false,
                                'tab'              =>  'Informacion inscrito'
                              ],
  'precio_servicios'     =>  [ 'label'             =>  'Servicios',
                              'columns'            =>  true,
                              'column_name'        =>  '',
                              'column_callback'    =>  false,
                              'fields'             =>  $is_admin ? true : false,
                              'sum'                => true,
                              'disabled'           =>  false,
                              'tab'                =>  'Informacion inscrito'
                          ],
  'total'                 =>  [ 'label'            =>  'Total',
                              'columns'            =>  true,
                              'column_name'        =>  '',
                              'column_callback'    =>  false,
                              'fields'             =>  $is_admin ? true : false,
                              'sum'                => true,
                              'disabled'           =>  false,
                              'tab'                =>  'Informacion inscrito'
                          ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render();


?>
