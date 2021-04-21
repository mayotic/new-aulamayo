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
          'table'             =>  'contacto_log',
          'table_name'        =>  ['Consultas formulario de contacto', '', 'far fa-comments'],
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

// Fields xcrud setup
$fields = [
  'id_contacto'         =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                            ],
  'nombre'              =>  [ 'label'            =>  'Nombre',
                              'column_name'      =>  'Nombre',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_contacto}">{value}</a>',
                            ],
  'apellidos'           =>  [ 'label'            =>  'Apellidos',
                              'column_name'      =>  'Apellidos',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 1
                            ],
  'email'               =>  [ 'label'            =>  'email',
                              'column_name'      =>  'email',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 1
                            ],
  'id_curso'            =>  [ 'label'            =>  'Curso',
                              'column_name'      =>  'Curso',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 1,
                              'relation'         =>  ['cursos', 'id_curso', 'nombre'],
                            ],
  'fecha'               =>  [ 'label'            =>  'Fecha',
                              'column_name'      =>  'Fecha',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-6'],
                              'validation_required' => 1,
                            ],
  'texto'               =>  [ 'label'            =>  'Texto',
                              'column_name'      =>  'Texto',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12'],
                              'validation_required' => 1,
                            ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render((isset($_GET['action']) ? $_GET['action'] : false), (isset($_GET['id']) ? $_GET['id'] : false));
?>
