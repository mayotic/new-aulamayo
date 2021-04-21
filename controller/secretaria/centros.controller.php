<?php
global $conf, $appconf, $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Init user object
$user = new User($_SESSION['userlogedin']);
$tdata['userlogedin'] = json_encode(['id' => $user->id, 'tipo_inscrito' => $user->tipo_inscrito]);

// User is admin
$is_admin = App::getUserTipe($_SESSION['userlogedin']) == $appconf['tipo_admin'] ? true : false;

// Generic xcrud setup
$grid_where = '';
$row_buttons = [];

$grid   = [
          'language'          =>  'es',
          'table'             =>  'centros_trabajo',
          'table_name'        =>  'Centros de trabajo',
          // 'unset_add'         =>  true,
          // 'unset_view'        =>  true,
          // 'unset_remove'      =>  true,
          // 'unset_csv'         =>  true,
          // 'unset_print'       =>  true,
          // 'unset_edit'        =>  true,
          // 'templates'         =>  ['mode(list,view,edit,create)' => 'file.php',
          // 'vars'              =>  ['var'  =>  [value]],
          // 'hide_button'       =>  'view',  //view, edit, remove, duplicate, add, csv, print, save_new, save_edit, save_return, return
          'list_limit'        =>  25,
          'where'             =>  $grid_where,
          // 'pass_default'      =>  [$defaults],
          // 'search_columns'    =>  [],
          // 'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          // 'order_by'          =>  ['apellido_1', 'asc']
];

// Fields xcrud setup
$fields = [
  'id_centro_trabajo'   =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              // 'tab'              =>  false
                            ],
 'nombre'               =>  [ 'label'          =>  'Centro de trabajo',
                            'column_name'      =>  'Centro de trabajo',
                            'column_callback'  =>  false,
                            'columns'          =>  true,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            // 'tab'              =>  'Informacion inscrito',
                            // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                            // 'readonly'         => $tipo_inscrito_readonly,
                            // 'pass_default'     => $tipo_inscrito_default
                          ],
'id_localidad'         =>  [ 'label'           =>  'Localidad',
                            'column_name'      =>  'Localidad',
                            'column_callback'  =>  false,
                            'columns'          =>  true,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            // 'tab'              =>  'Informacion inscrito',
                            'relation'         =>  ['localidades', 'id_localidad', 'nombre'],
                            // 'readonly'         => $tipo_inscrito_readonly,
                            // 'pass_default'     => $tipo_inscrito_default
                          ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render();


?>
