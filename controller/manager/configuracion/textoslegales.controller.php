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
          'table'             =>  'textos_legales',
          'table_name'        =>  ['Textos legales', '', 'fas fa-balance-scale'],
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
          'search_columns'    =>  ['titulo', 'texto'],
          // 'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          'order_by'          =>  ['titulo', 'asc'],
          // 'join'              =>  ['id_curso', 'cursos_extend', 'id_curso']

];

// join( field, joined_table, join_on_field [, alias] [, not_insert] )

// Fields xcrud setup
$fields = [
  'id_texto_legal'      =>  [ 'label'           =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'id_tipo_texto_legal' =>  ['label'             =>  'Tipo de texto legal',
                            'column_name'        =>  'Tipo de texto legal',
                            'column_callback'    =>  false,
                            'columns'            =>  true,
                            'fields'             =>  true,
                            // 'disabled'          =>  [true, 'edit'],
                            'tab'                =>  false,
                            'relation'           =>  ['tipos_textos_legales', 'id_tipo_texto_legal', 'nombre'],
                            'set_attr'           =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                            // 'column_pattern'    =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_usuario_curso}">{value}</a>',
                            ],
  'obligatorio'         =>  [ 'label'             =>  'Obligatorio',
                              'column_name'        =>  'Obligatorio',
                              'column_callback'    =>  false,
                              'columns'            =>  true,
                              'fields'             =>  true,
                              // 'disabled'          =>  [true, 'edit'],
                              'tab'                =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-6', 'details_field_cell' => 'col-sm-12'],
                              // 'column_pattern'    =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_usuario_curso}">{value}</a>',
                              ],
  'titulo'              =>  [ 'label'            =>  'Título',
                              'column_name'      =>  'Título',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_texto_legal}">{value}</a>',
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12'],
                              // 'tab'              =>  'Ficha del curso'
                            ],
  'texto'               =>  [ 'label'            =>  'Texto',
                              'column_name'      =>  'Texto',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'readonly'         => ['edit', 'view', 'create'],
                              // 'pass_default'     => <default_value>,
                              'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12']
                            ],
  'url'                 =>  [ 'label'            =>  'Link',
                              'column_name'      =>  'Link',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              // 'readonly'         => ['edit', 'view', 'create'],
                              // 'pass_default'     => <default_value>,
                              // 'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12']
                            ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render((isset($_GET['action']) ? $_GET['action'] : false), (isset($_GET['id']) ? $_GET['id'] : false));
?>
