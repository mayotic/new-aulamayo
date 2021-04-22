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
          'table'             =>  'usuarios',
          'table_name'        =>  ['Usuarios', '', 'fas fa-user-graduate'],
          'unset_add'         =>  false,
          'unset_view'        =>  true,
          'unset_remove'      =>  false,
          'unset_csv'         =>  false,
          'unset_print'       =>  false,
          'hide_buttons'      =>  ['edit', 'save_edit', 'save_new', 'return'],
          'list_limit'        =>  25,
          'where'             =>  $grid_where,
          'search_columns'    =>  ['id_tipo_usuario, nombre, apellido_1, apellido_2, email'],
          'row_buttons'       =>  $row_buttons,

          'before_insert'     =>  ['App::usuariosBeforeInsert', $conf['app']['root'] . '/include/app.php'],
          'before_update'     =>  ['App::usuariosBeforeUpdate',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],

          'before_create'     =>  ['App::usuariosBeforeShowCreateDialog', $conf['app']['root'] . '/include/app.php'],

          'order_by'          =>  ['apellido_1', 'asc'],
          'row_actions'       =>  [['activar', 'App::toggleUsuario', $conf['app']['root'] . '/include/app.php'],
                                   ['desactivar', 'App::toggleUsuario', $conf['app']['root'] . '/include/app.php']],
          'row_buttons'       =>  [['#',
                                    'Activar',
                                    'fas fa-toggle-off',
                                    'xcrud-action',
                                    array(  // set action vars to the button
                                        'data-task'     => 'action',
                                        'data-action'   => 'activar',
                                        'data-primary'  => '{id_usuario}')
                                    ,
                                    array(  // set condition ( when button must be shown)
                                        'activo',
                                        '!=',
                                        '1')
                                    ],
                                    ['#',
                                     'Desactivar',
                                     'fas fa-toggle-on',
                                     'xcrud-action',
                                     array(  // set action vars to the button
                                        'data-task'     => 'action',
                                        'data-action'   => 'desactivar',
                                        'data-primary'  => '{id_usuario}')
                                     ,
                                     array(  // set condition ( when button must be shown)
                                        'activo',
                                        '=',
                                        '1')
                                    ],
                                    ['#',
                                     'Cambiar contrassenya',
                                     'fa fa-key',
                                     'custom-action',
                                     array(  // set action vars to the button
                                        'data-toggle'   => 'modal',
                                        'data-target'   => '#change-pass',
                                        'data-primary'  => '{id_usuario}')
                                    ]
                                ]
];

// Fields xcrud setup
$fields = [
  'id_usuario'          =>  [ 'label'            =>  '',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  false,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario'
                            ],
  'id_tipo_usuario'     =>  [ 'label'             =>  'Tipo usuario',
                              'column_name'      =>  'Tipo usuario',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario',
                              'relation'         =>  ['tipos_usuario', 'id_tipo_usuario', 'nombre', ''],
                              'validation_required' => 1,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-4']
                            ],
  'nombre'              =>  [ 'label'            =>  '<br/><h4><i class="far fa-address-card"></i> &nbsp;Datos usuario</h4><hr/>Nombre',
                              'column_name'      =>  'Nombre',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'column_pattern'   =>  '<a href="#" class="xcrud-action" data-task="edit" data-primary="{id_usuario}">{value}</a>',
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-4'],
                              'tab'              =>  'Ficha del usuario'
                            ],
  'apellido_1'          =>  [ 'label'            =>  'Apellido 1',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'tab'              =>  'Ficha del usuario'
                            ],
  'apellido_2'          =>  [ 'label'            =>  'Apellido 2',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario'
                            ],
  'email'               =>  [ 'label'            =>  'email',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'validation_required' => 3,
                              'validation_pattern'  => 'email',
                              'tab'              =>  'Ficha del usuario'
                            ],
  'dni'                 =>  [ 'label'            =>  'DNI',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario'
                            ],
  'direccion_fiscal'    =>  [ 'label'            =>  'Dirección fiscal',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario',
                            ],
  'telefono'            =>  [ 'label'            =>  'Teléfono',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario',
                            ],
  'id_profesion'        =>  [ 'label'            =>  'Profesión',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'relation'         =>  ['profesiones','id_profesion','nombre'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'id_especialidad'     =>  [ 'label'            =>  'Especialidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'relation'         =>  ['especialidades','id_especialidad','nombre','','','','','','id_profesion','id_profesion'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'id_pais'             =>  [ 'label'            =>  'Pais',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'relation'         =>  ['paises','id_pais','nombre'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'id_comunidad'        =>  [ 'label'            =>  'Comunidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'relation'         =>  ['comunidades','id_comunidad','nombre','','','','','','id_pais','id_pais'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'id_localidad'        =>  [ 'label'            =>  'Localidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'relation'         =>  ['localidades','id_localidad','nombre','','','','','','id_comunidad','id_comunidad'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'fecha_alta'          =>  [ 'label'            =>  'Fecha alta',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario',
                            ],
  'comentarios'         =>  [ 'label'            =>  'Comentarios',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-12'],
                              'tab'              =>  'Ficha del usuario',
                            ],
  'pass'                =>  [ 'label'            =>  'Contraseña',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'set_attr'         =>  ['details_row' => 'form-group col-md-12', 'details_field_cell' => 'col-sm-6'],
                              'tab'              =>  'Ficha del usuario',
                              'before_update'    =>  [''],
                              'field_callback'   =>  ['App::passDecrypt', $conf['app']['root'] . '/include/app.php' ]
                            ],
  'activo'              =>  [ 'label'            =>  'Activo',
                              'columns'          =>  true,
                              'column_name'      =>  'Activo',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Ficha del usuario',
                            ]
];

  $nesteds_id_usuario = [
                            ['nested_name' => 'Matriculas del usuario',
                             'nested_table' => 'matriculas',
                             'nested_field' => 'id_usuario',
                             'grid'         => [ 'table_name' => ' ',
                                                 'unset_view'        =>  true,
                                                 'hide_buttons'      =>  ['edit', 'save_edit', 'save_new', 'add'],
                                                 'vars'              =>  ['hide_edit_buttons_text' => true],
                                                 'row_buttons'       =>  [
                                                                            ['#',
                                                                             'Certificado',
                                                                             'fas fa-award',
                                                                             'btn-warning',
                                                                             array(  // set action vars to the button
                                                                                 'data-task'     => 'action',
                                                                                 'data-action'   => 'certificado',
                                                                                 'data-usuario'  => '{id_usuario}',
                                                                                 'data-curso'    => '{id_curso}')
                                                                            ]
                                                                         ],
                                                 // 'row_actions'       =>  [
                                                 //                            ['certificado', 'App::getCertificadoController',
                                                 //                            $conf['app']['root'] . '/include/app.php'
                                                 //                            ]
                                                 //                         ],
                                                 'hide_'

                             ],
                            'fields'  => [
                              'id_usuario'    =>  ['label'            =>  'Usuario',
                                                    'column_name'     =>  '',
                                                    'column_callback' =>  false,
                                                    'columns'         =>  false,
                                                    'fields'          =>  false,
                                                    'disabled'        =>  false,
                                                  ],
                              'id_curso'      =>  ['label'            =>  'Curso',
                                                  'column_name'       =>  'Curso',
                                                  'column_callback'   =>  false,
                                                  'columns'           =>  true,
                                                  'fields'            =>  true,
                                                  'tab'               =>  false,
                                                  'relation'          =>  ['cursos', 'id_curso', 'nombre'],
                                                  'column_pattern'    =>  '<a href="/manager/cursos?fid={id_curso}&faction=editrow" class="" target="_blank">{value}</a>',
                                                  ]
                            ]
                          ],
                          ['nested_name' => 'Permisos del usuario',
                           'nested_table' => 'users_permissions',
                           'nested_field' => 'user_id',
                           'grid'         => [ 'table_name' => ' ',
                                               'unset_view'        =>  true,
                                               'hide_buttons'      =>  ['edit', 'save_edit', 'save_new'],
                                               'vars'              =>  ['hide_edit_buttons_text' => true],
                                               // 'row_actions'       =>  [
                                               //                            ['certificado', 'App::getCertificadoController',
                                               //                            $conf['app']['root'] . '/include/app.php'
                                               //                            ]
                                               //                         ],
                                               'hide_'

                           ],
                          'fields'  => [
                            'user_id'      =>  ['label'            =>  'Usuario',
                                                  'column_name'     =>  '',
                                                  'column_callback' =>  false,
                                                  'columns'         =>  false,
                                                  'fields'          =>  false,
                                                  'disabled'        =>  false,
                                                ],
                            'permission_id' =>  ['label'            =>  'Permiso',
                                                'column_name'       =>  'Permiso',
                                                'column_callback'   =>  false,
                                                'columns'           =>  true,
                                                'fields'            =>  true,
                                                'tab'               =>  false,
                                                'relation'          =>  ['permissions', 'permission_id', 'permission_name'],
                                                'column_pattern'    =>  '<a href="/manager/configuracion/permisos?fid={permission_id}&faction=editrow" class="" target="_blank">{value}</a>',
                                                ]
                          ]
                        ]
                      ];

  $fields['id_usuario']['nested'] = $nesteds_id_usuario;

  $tdata['content'] = Tools::xcrud($grid, $fields)->render();
?>
