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
$tdata['userlogedin'] = json_encode(['id' => $user->id, 'tipo_inscrito' => $user->tipo_usuario]);

// User is admin
$is_admin = App::getUserTipe($_SESSION['userlogedin']) == $appconf['tipo_admin'] ? true : false;

// Generic xcrud setup
$grid_where   = '';
$row_buttons  = [];

$grid   = [
          'language'          =>  'es',
          'table'             =>  'comunidades',
          'table_name'        =>  ['Comunidades', '', 'fas fa-map-signs'],
          'unset_add'         =>  false,
          'unset_view'        =>  true,
          'unset_remove'      =>  false,
          'unset_csv'         =>  false,
          'unset_print'       =>  false,
          // 'unset_edit'        =>  false,
          'hide_buttons'      =>  ['edit', 'save_edit', 'save_new', 'return'],
          // 'templates'         =>  ['mode(list,view,edit,create)' => 'file.php'],
          // 'vars'              =>  ['var'  =>  [value]],
          // 'hide_button'       =>  'view',  //view, edit, remove, duplicate, add, csv, print, save_new, save_edit, save_return, return
          'list_limit'        =>  25,
          'where'             =>  $grid_where,
          // 'pass_default'      =>  [],
          'search_columns'    =>  ['nombre'],
          // 'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          'order_by'          =>  ['nombre', 'asc'],
          // 'join'              =>  ['id_curso', 'cursos_extend', 'id_curso']

];

// join( field, joined_table, join_on_field [, alias] [, not_insert] )

// Fields xcrud setup
$fields = [
  'id_comunidad'          =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                            ],
  'nombre'              =>  [ 'label'            =>  'Provincia',
                              'column_name'      =>  'Provincia',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_comunidad}">{value}</a>',
                            ],
'id_pais'               =>  [ 'label'            =>  'País',
                              'column_name'      =>  'País',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 1,
                              'relation'         =>  ['paises', 'id_pais', 'nombre'],
                              'validation_required' => 1
                          ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render((isset($_GET['action']) ? $_GET['action'] : false), (isset($_GET['id']) ? $_GET['id'] : false));
?>
