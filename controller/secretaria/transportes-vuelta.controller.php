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
          'table'             =>  'transportes_vuelta',
          'table_name'        =>  'Transportes Vuelta',
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
  'id_vuelta'            =>  [ 'label'            =>  '',
                            'column_name'      =>  '',
                            'column_callback'  =>  false,
                            'columns'          =>  false,
                            'fields'           =>  false,
                            'disabled'         =>  false,
                            // 'tab'              =>  false

                            'nested'           => array(
                                                  [
                                                  'nested_name'  => 'Cargos',
                                                  'nested_table' => 'transportes_vuelta_cargos',
                                                  'nested_field' => 'id_vuelta',
                                                  'grid'         => ['table_name' => ' ',
                                                                     'hide_'

                                                  ],
                                                  'fields'  => [
                                                    'id_vuelta_cargo'=>  [ 'label'  =>  'Inscrito',
                                                                      'column_name'      =>  '',
                                                                      'column_callback'  =>  false,
                                                                      'columns'          =>  false,
                                                                      'fields'           =>  false,
                                                                      'disabled'         =>  false,
                                                                      'tab'              =>  false
                                                                    ],
                                                    'id_vuelta'    =>  [ 'label'  =>  'Inscrito',
                                                                      'column_name'      =>  '',
                                                                      'column_callback'  =>  false,
                                                                      'columns'          =>  false,
                                                                      'fields'           =>  false,
                                                                      'disabled'         =>  false,
                                                                      'tab'              =>  false,
                                                                      'relation'         => ['transportes_vuelta', 'id_vuelta', 'nombre']
                                                                    ],
                                                    'id_cargo'  =>  ['label'             =>  'Cargo',
                                                                    'column_name'      =>  'Cargo',
                                                                    'column_callback'  =>  false,
                                                                    'columns'          =>  true,
                                                                    'fields'           =>  true,
                                                                    'disabled'         =>  [true, 'edit'],
                                                                    'tab'              =>  false,
                                                                    'relation'         => ['cargos', 'id_cargo', ['nombre', 'importe'], '', '', '', ' - ']
                                                                    ]

                                                  ]
                                                ]
                                              )
                            ],
  'tipo'                =>  [ 'label'            =>  'Tipo transporte',
                              'column_name'      =>  'Tipo',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Datos generales',
                              'relation'         =>  ['transportesgen', 'id_transporte', 'nombre'],
                              // 'readonly'         => $tipo_inscrito_readonly,
                              // 'pass_default'     => $tipo_inscrito_default
                            ],
  'id_poblacion'       =>  [ 'label'             =>  'Poblaci??n',
                              'column_name'      =>  'Poblaci??n',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Datos generales',
                              'relation'         =>  ['localidades', 'id_localidad', 'nombre'],
                              // 'readonly'         => $tipo_inscrito_readonly,
                              // 'pass_default'     => $tipo_inscrito_default
                            ],
 'referencia'           =>  [ 'label'          =>  'Referencia',
                            'column_name'      =>  'Referencia',
                            'column_callback'  =>  false,
                            'columns'          =>  true,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'tab'              =>  'Datos generales',
                            // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                            // 'readonly'         => $tipo_inscrito_readonly,
                            // 'pass_default'     => $tipo_inscrito_default
                          ],
// 'lugar'               =>  [ 'label'          =>  'Lugar',
//                           'column_name'      =>  'Lugar',
//                           'column_callback'  =>  false,
//                           'columns'          =>  false,
//                           'fields'           =>  true,
//                           'disabled'         =>  false,
//                           'tab'              =>  'Datos generales',
//                           // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
//                           // 'readonly'         => $tipo_inscrito_readonly,
//                           // 'pass_default'     => $tipo_inscrito_default
//                         ],
'fecha'             =>  [ 'label'            =>  'Fecha de salida',
                          'column_name'      =>  'Fecha de salida',
                          'column_callback'  =>  false,
                          'columns'          =>  true,
                          'fields'           =>  true,
                          'disabled'         =>  false,
                          'tab'              =>  'Datos generales',
                          // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                          // 'readonly'         => $tipo_inscrito_readonly,
                          // 'pass_default'     => $tipo_inscrito_default
                        ],
'hora1'             =>  [ 'label'            =>  'Hora de salida',
                          'column_name'      =>  'Hora de salida',
                          'column_callback'  =>  false,
                          'columns'          =>  true,
                          'fields'           =>  true,
                          'disabled'         =>  false,
                          'tab'              =>  'Datos generales',
                          // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                          // 'readonly'         => $tipo_inscrito_readonly,
                          // 'pass_default'     => $tipo_inscrito_default
                        ],
'fecha2'             =>  [ 'label'           =>  'Fecha de llegada',
                          'column_name'      =>  'Fecha de llegada',
                          'column_callback'  =>  false,
                          'columns'          =>  true,
                          'fields'           =>  true,
                          'disabled'         =>  false,
                          'tab'              =>  'Datos generales',
                          // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                          // 'readonly'         => $tipo_inscrito_readonly,
                          // 'pass_default'     => $tipo_inscrito_default
                        ],
'hora2'             =>  [ 'label'            =>  'Hora de llegada',
                          'column_name'      =>  'Hora de llegada',
                          'column_callback'  =>  false,
                          'columns'          =>  true,
                          'fields'           =>  true,
                          'disabled'         =>  false,
                          'tab'              =>  'Datos generales',
                          // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                          // 'readonly'         => $tipo_inscrito_readonly,
                          // 'pass_default'     => $tipo_inscrito_default
                        ],

'terminal_salida_vuelta'=>  [ 'label'           =>  'Terminal origen',
                          'column_name'      =>  'Terminal destino',
                          'column_callback'  =>  false,
                          'columns'          =>  false,
                          'fields'           =>  true,
                          'disabled'         =>  false,
                          'tab'              =>  'Datos generales',
                          // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                          // 'readonly'         => $tipo_inscrito_readonly,
                          // 'pass_default'     => $tipo_inscrito_default
                        ],


  'terminal_llegada_vuelta'=>  [ 'label'           =>  'Terminal destino',
                            'column_name'      =>  'Terminal destino',
                            'column_callback'  =>  false,
                            'columns'          =>  false,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'tab'              =>  'Datos generales',
                            // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                            // 'readonly'         => $tipo_inscrito_readonly,
                            // 'pass_default'     => $tipo_inscrito_default
                          ],
  'medio_extra'       =>  [ 'label'              =>  'Es medio extra',
                              'column_name'      =>  'Es medio extra',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Datos generales',
                              // 'relation'         =>  ['impuestos', 'id_impuesto', 'nombre'],
                              // 'readonly'         => $tipo_inscrito_readonly,
                              // 'pass_default'     => $tipo_inscrito_default
                          ],
  'importe'           =>  [ 'label'            =>  'Importe',
                            'column_name'      =>  'Importe',
                            'column_callback'  =>  false,
                            'columns'          =>  false,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'tab'              =>  'Datos econ??micos',
                            // 'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                            // 'readonly'         => $tipo_inscrito_readonly,
                            // 'pass_default'     => $tipo_inscrito_default
                            ],
  'id_impuesto'         =>  [ 'label'            =>  'Impuesto',
                              'column_name'      =>  'Impuesto',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Datos econ??micos',
                              'relation'         =>  ['impuestos', 'id_impuesto', 'nombre'],
                              // 'readonly'         => $tipo_inscrito_readonly,
                              // 'pass_default'     => $tipo_inscrito_default
                            ]
];

$tdata['content'] = Tools::xcrud($grid, $fields)->render();
?>
