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
          'table'             =>  'pagos',
          'table_name'        =>  ['Pagos', '', 'fas fa-donate'],
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
          'search_columns'    =>  ['id_curso', 'referencia_pago', 'descripcion', 'id_cupon', 'fecha_pago'],
          // 'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          'order_by'          =>  ['id_pago', 'asc'],
          // 'join'              =>  ['id_curso', 'cursos_extend', 'id_curso']

];

// join( field, joined_table, join_on_field [, alias] [, not_insert] )

// Fields xcrud setup
$fields = [
  'id_pago'             =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'id_tipo_pago'        =>  [ 'label'            =>  'Tipo pago',
                              'column_name'      =>  'Tipo pago',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 1,
                              'relation'         =>  ['tipos_pago', 'id_tipo_pago', 'nombre'],
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-3'],
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'id_usuario'          =>  [ 'label'            =>  'Usuario',
                              'column_name'      =>  'Usuario',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 1,
                              'relation'         =>  ['usuarios', 'id_usuario', ['nombre', 'apellido_1', 'apellido_2']],
                              // 'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'id_curso'            =>  [ 'label'            =>  'Curso',
                              'column_name'      =>  'Curso',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_pago}">{value}</a>',
                              'relation'         =>  ['cursos', 'id_curso', 'nombre'],
                              // 'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              // 'tab'              =>  'Ficha del curso'
                            ],
'descripcion'           =>  [ 'label'          =>  'Descripción',
                              'column_name'      =>  'Descripción',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-6'],
                              // 'validation_required' => 1,
                              // 'tab'              =>  'Ficha del curso'
                           ],
'referencia_pago'      =>  [ 'label'          =>  'Referencia',
                              'column_name'      =>  'Referencia',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'validation_required' => 1,
                              // 'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-6'],
                              // 'tab'              =>  'Ficha del curso'
                          ],
'fecha_pago'          =>  [ 'label'             =>  'Fecha de pago',
                             'column_name'      =>  'Fecha de pago',
                             'column_callback'  =>  false,
                             'columns'          =>  true,
                             'fields'           =>  true,
                             'disabled'         =>  false,
                             // 'validation_required' => 1,
                             // 'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-6'],
                             // 'tab'              =>  'Ficha del curso'
                         ],
'id_cupon'             => [ 'label'            =>  'Cupón',
                            'column_name'      =>  'Cupón',
                            'column_callback'  =>  false,
                            'columns'          =>  false,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'relation'         =>  ['cupones', 'id_cupon', 'codigo'],
                            // 'validation_required' => 1,
                            // 'tab'              =>  'Ficha del curso'
                          ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render((isset($_GET['action']) ? $_GET['action'] : false), (isset($_GET['id']) ? $_GET['id'] : false));
?>
