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
          'table'             =>  'matriculas',
          'table_name'        =>  ['Matriculas', '', 'fas fa-money-check'],
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
          'search_columns'    =>  ['referencia, id_usuario, id_curso', 'referencia'],
          // 'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          'order_by'          =>  ['referencia', 'asc'],
          // 'join'              =>  ['id_curso', 'cursos_extend', 'id_curso']

];

// join( field, joined_table, join_on_field [, alias] [, not_insert] )

// Fields xcrud setup
$fields = [
  'id_matricula'        =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'referencia'          =>  [ 'label'            =>  'Referencia',
                              'column_name'      =>  'Referencia',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_matricula}">{value}</a>',
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12'],
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'id_usuario'          =>  [ 'label'            =>  'Alumno',
                              'column_name'      =>  'Alumno',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'tab'              =>  'Ficha del usuario',
                              'relation'         =>  ['usuarios', 'id_usuario', 'nombre', ''],
                              // 'readonly'         => ['edit', 'view', 'create'],
                              // 'pass_default'     => <default_value>,
                              'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12']
                            ],
  'id_curso'            =>  [ 'label'                 =>  'Curso',
                              'column_name'      =>  'Curso',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'tab'              =>  'Ficha del usuario',
                              'relation'         =>  ['cursos', 'id_curso', 'nombre', ''],
                              // 'readonly'         => ['edit', 'view', 'create'],
                              // 'pass_default'     => <default_value>,
                              'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12']
                            ],
  'fecha_creacion'      =>  [ 'label'            =>  'Fecha matrícula',
                              'column_name'      =>  'Fecha',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'readonly'         => ['edit', 'view', 'create'],
                              // 'pass_default'     => <default_value>,
                              'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12']
                            ],
  'activa'              =>  [ 'label'            =>  'Activa',
                              'columns'          =>  true,
                              'column_name'      =>  'Activa',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                            ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render((isset($_GET['action']) ? $_GET['action'] : false), (isset($_GET['id']) ? $_GET['id'] : false));
?>
