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

// Generic xcrud setup

$grid_where = '';
// Per user type content filters (where) for main content and selects
// Filters (where's) for selects
$tipoins_where = '';
$respons_where = 'id_tipo_inscrito IN (' . $appconf['tipo_delegado'] . ')';
$medios_where = '';
$delegado= '';
$table_name = 'Inscritos <i class="far fa-address-card"></i>';

$tipo_inscrito_readonly = false;
$tipo_inscrito_default = false;

// $row_buttons = [['ajax/edit-inscritos?action=edit&row={id_inscrito}', 'Editar', 'fas fa-edit', 'edicion']];
$row_buttons = [];
// $defaults = ['id_tipo_inscrito' => $appconf['tipo_asistente']];

// Diferents filtres segons la plana
switch (AutoIncludes::getFileName(true)) {
  case 'inscritosdelegado':
    // It comes from page delegados
    if (isset($_REQUEST['delegado'])) {
      $dlg = new User($_REQUEST['delegado']);
      $delegado = '<br/><span style="font-size:16px; color:#777">Delegado: ' . $dlg->getUserInfo()['nombre'] . ' ' . $dlg->getUserInfo()['apellido_1'] . ' ' . $dlg->getUserInfo()['apellido_2'] . '</span>';
      // Filtre inscrits nomes del delegat si entrem via link de inscrits per delegat
      $grid_where .= 'id_gerente = ' . $_REQUEST['delegado'];
      // Passem valor per defecte delegat quan es crea inscrit si es ve a traves del link d inscrits per delegat
      $defaults['id_gerente'] = $_REQUEST['delegado'];
      $table_name = 'Inscritos <i class="far fa-address-card"></i>' . $delegado;
    }
    break;

  case 'ponentes':
    $table_name = 'Ponentes <i class="fas fa-chalkboard-teacher"></i>' . $delegado;
    $grid_where .= 'id_tipo_inscrito = ' . $appconf['tipo_ponente'];

    $tipoins_where = 'id_tipo_inscrito = ' . $appconf['tipo_ponente'];
    $tipo_inscrito_readonly = ['create'];
    $tipo_inscrito_default = $appconf['tipo_ponente'];
    break;

  case 'delegados':
    $table_name = 'Delegados <i class="fa fa-user-friends"></i>';
    $grid_where .= 'id_tipo_inscrito = ' . $appconf['tipo_delegado'];
    $tipoins_where = 'id_tipo_inscrito = ' . $appconf['tipo_delegado'];

    $row_buttons = [['inscritosdelegado?delegado={id_inscrito}', 'Inscritos', 'fas fa-user-friends', 'inscritos']];

    $tipo_inscrito_readonly = ['create'];
    $tipo_inscrito_default = $appconf['tipo_delegado'];
    // $xcrudel->button('inscritosdelegado?delegado={id_inscrito}', 'Inscritos', 'fas fa-user-friends', 'inscritos');
    break;

  default:
    break;
}

// For 'inscrito' type conditionals

switch ($user->tipo_inscrito) {
  case $appconf['tipo_admin']:
    break;

  case $appconf['tipo_gerente']:
    $medios_where .= ' medio_extra = 0';
    break;

  case $appconf['tipo_delegado']:
    $medios_where .= ' medio_extra = 0';
    // Selects filters
    // Leave admin users from tipo_inscrito select
    $tipoins_where = 'id_tipo_inscrito = ' . $appconf['tipo_asistente'];
    $respons_where .= (!empty($respons_where) ? ' AND ' : '') . 'id_inscrito = ' . $user->id;

    $tipo_inscrito_readonly = ['create'];
    $tipo_inscrito_default = $appconf['tipo_asistente'];

    break;
}

// var_dump($defaults); exit;
$grid   = [
          'language'          =>  'es',
          'table'             =>  'inscritos',
          'table_name'        =>  $table_name,
          'unset_add'         =>  !$is_admin ? ((isset($_REQUEST['delegado']) and $user->id == $_REQUEST['delegado']) ? false : true) : false,
          'unset_view'        =>  false,
          'unset_remove'      =>  !$is_admin ? true : false,
          'unset_csv'         =>  !$is_admin ? true : false,
          'unset_print'       =>  !$is_admin ? true : false,
          'unset_edit'        =>  !$is_admin ? true : false,
          // 'templates'         =>  ['mode(list,view,edit,create)' => 'file.php',
          // 'vars'              =>  ['var'  =>  [value]],
          // 'hide_button'       =>  'view',  //view, edit, remove, duplicate, add, csv, print, save_new, save_edit, save_return, return
          'list_limit'        =>  25,
          'where'             =>  $grid_where,
          // 'pass_default'      =>  [$defaults],
          'search_columns'    =>  ['id_tipo_inscrito,nombre,apellido_1,apellido_2,email'],
          'after_insert'      =>  ['App::sendMailAfterInsert',  $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
          'row_buttons'       =>  $row_buttons,
          'order_by'          =>  ['apellido_1', 'asc']
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
                              'columns'          =>  ((AutoIncludes::getFileName(true) == 'delegados' or AutoIncludes::getFileName(true) == 'ponentes') ? false : true),
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['tipos_inscrito', 'id_tipo_inscrito', 'nombre', $tipoins_where],
                              'readonly'         => $tipo_inscrito_readonly,
                              'pass_default'     => $tipo_inscrito_default,
                              'validation_required' => 1
                            ],
  'id_gerente'          =>  [ 'label'            =>  'Responsable',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  ((AutoIncludes::getFileName(true) == 'delegados' or AutoIncludes::getFileName(true) == 'ponentes') ? false : true),
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         => ['inscritos', 'id_inscrito', ['nombre', 'apellido_1', 'apellido_2'], $respons_where],
                              'readonly'         => ($user->tipo_inscrito == $appconf['tipo_delegado'] ? ['create'] : false),
                              'pass_default'     => ($user->tipo_inscrito == $appconf['tipo_delegado'] ? $user->id : false)
                          ],
  'nombre'              =>  [ 'label'            =>  '<br/><h4><i class="far fa-address-card"></i> &nbsp;Datos asistente</h4><hr/>Nombre',
                              'column_name'      =>  'Nombre',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'validation_required' => 3
                            ],
  'apellido_1'          =>  [ 'label'            =>  'Apellido 1',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  true,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'validation_required' => 3
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
                              'tab'              =>  'Informacion inscrito',
                              'validation_required' => 3,
                              'validation_pattern'  => 'email'
                            ],
  'dni'                 =>  [ 'label'            =>  'DNI',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'direccion_fiscal'    =>  [ 'label'            =>  'Dirección fiscal',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'telefono'            =>  [ 'label'            =>  'Teléfono',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'id_especialidad'     =>  [ 'label'            =>  'Especialidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         => ['especialidades', 'id_especialidad', 'nombre']
                            ],
  'id_pais'             =>  [ 'label'            =>  'Pais',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['paises','id_pais','nombre']
                            ],
  'id_comunidad'        =>  [ 'label'            =>  'Comunidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['comunidades','id_comunidad','nombre','','','','','','id_pais','id_pais']
                            ],
  'id_localidad'        =>  [ 'label'            =>  'Localidad',
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'columns'          =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['localidades','id_localidad','nombre','','','','','','id_comunidad','id_comunidad']
                            ],
  'id_centro_trabajo'   =>  [ 'label'            =>  'Centro trabajo',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'relation'         =>  ['centros_trabajo','id_centro_trabajo','nombre','','','','','','id_localidad','id_localidad']
                            ],
  'id_localidad_medio_ida' =>  [ 'label'         =>  '<br/><h4><i class="fa fa-plane"></i> &nbsp;Logística</h4><br/><h5 class="form-title-2">Transporte ida</h5><hr/>Localidad',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  ($is_admin ? 'Transporte y gestión' : 'Informacion inscrito'),
                              'relation'         =>  ['localidades','id_localidad','nombre']
                            ],
  'id_medio_ida'        =>  [ 'label'            =>  'Medio',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  ($is_admin ? 'Transporte y gestión' : 'Informacion inscrito'),
                              'relation'         =>  ['view_transportes_ida','id_ida', ['nombre_tipo', 'referencia', 'fecha', 'hora1', 'hora2'], $medios_where, 'nombre_tipo,fecha,hora1 asc','',' • ','','id_poblacion','id_localidad_medio_ida']
                            ],
  'trayecto_ida'        =>  [ 'label'            =>  'Trayecto',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                            ],
  // 'terminal_salida_ida' =>  [ 'label'            =>  'Terminal origen',
  //                             'columns'          =>  false,
  //                             'column_name'      =>  '',
  //                             'column_callback'  =>  false,
  //                             'fields'           =>  $is_admin ? true : false,
  //                             'disabled'         =>  false,
  //                             'tab'              =>  'Transporte y gestión'
  //                           ],
  'terminal_llegada_ida'=>  [ 'label'            =>  'Terminal destino',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                            ],
  // 'fecha_llegada_ida'   =>  [ 'label'            =>  'Fecha y hora de llegada',
  //                             'columns'          =>  false,
  //                             'column_name'      =>  '',
  //                             'column_callback'  =>  false,
  //                             'fields'           =>  $is_admin ? true : false,
  //                             'disabled'         =>  false,
  //                             'tab'              =>  'Transporte y gestión'
  //                           ],
  'precio_ida'          =>  [ 'label'            =>  'Precio',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                          ],
  'id_localidad_medio_vuelta' =>  [ 'label'         =>  '<br/><h5 class="form-title-2">Transporte vuelta</h5><hr/>Localidad',
                            'columns'          =>  false,
                            'column_name'      =>  '',
                            'column_callback'  =>  false,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'tab'              =>  ($is_admin ? 'Transporte y gestión' : 'Informacion inscrito'),
                            'relation'         =>  ['localidades','id_localidad','nombre']
                          ],
  'id_medio_vuelta'   =>  [ 'label'            =>  'Medio',
                            'columns'          =>  false,
                            'column_name'      =>  '',
                            'column_callback'  =>  false,
                            'fields'           =>  true,
                            'disabled'         =>  false,
                            'tab'              =>  ($is_admin ? 'Transporte y gestión' : 'Informacion inscrito'),
                            'relation'         =>  ['view_transportes_vuelta','id_vuelta', ['nombre_tipo', 'referencia', 'fecha', 'hora1', 'hora2'], $medios_where, 'nombre_tipo,fecha,hora1 asc','',' • ','','id_poblacion','id_localidad_medio_vuelta']
                          ],
  'trayecto_vuelta'     =>  [ 'label'            =>  'Trayecto',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                            ],
  'terminal_salida_vuelta'=>  [ 'label'          =>  'Terminal origen',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                            ],
  'terminal_llegada_vuelta'=>  [ 'label'         =>  'Terminal destino',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión'
                            ],
  // 'fecha_llegada_vuelta'=>  [ 'label'            =>  'Fecha y hora de llegada',
  //                             'columns'          =>  false,
  //                             'column_name'      =>  '',
  //                             'column_callback'  =>  false,
  //                             'fields'           =>  $is_admin ? true : false,
  //                             'disabled'         =>  false,
  //                             'tab'              =>  'Transporte y gestión'
  //                           ],
  'precio_vuelta'       =>  [ 'label'            =>  'Precio',
                            'columns'          =>  false,
                            'column_name'      =>  '',
                            'column_callback'  =>  false,
                            'fields'           =>  $is_admin ? true : false,
                            'disabled'         =>  false,
                            'tab'              =>  'Transporte y gestión'
                          ],
  'comentarios'         =>  [ 'label'            =>  'Comentarios',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito'
                            ],
  'Sesion eventos'      =>  [ 'label'            =>  '<br/><h4><i class="far fa-calendar-alt"></i> &nbsp;Eventos</h4><hr/>Cafés y talleres',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  ['App::reformatMultiSelectView', $_SERVER['DOCUMENT_ROOT'] . '/include/app.php'],
                              'fields'           =>  true,
                              'disabled'         =>  false,
                              'tab'              =>  'Informacion inscrito',
                              'fk_relation'      => ['id_inscrito',
                                                    'inscrito_sesion',
                                                    'id_inscrito',
                                                    'id_sesion',
                                                    'sesiones_evento',
                                                    'id_sesion',
                                                    array('nombre', 'dia_inicio','hora_inicio', 'dia_fin', 'hora_fin', 'plazas', 'id_evento'),'','','||']
                            ],
  'id_acuerdo'          =>  [ 'label'            =>  '<br/><h5 class="form-title-2">Datos de gestión</h5><hr/>Acuerdo',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión',
                              'relation'         =>  ['acuerdos','id_acuerdo','nombre']
                            ],
  'id_derecho'          =>  [ 'label'            =>  'Derechos',
                              'columns'          =>  false,
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'tab'              =>  'Transporte y gestión',
                              'relation'         =>  ['derechos','id_derecho','nombre']
                            ],
  // 'fecha_ida'           =>  [ 'label'            =>  'Fecha ida',
  //                             'columns'          =>  false,
  //                             'column_name'      =>  '',
  //                             'column_callback'  =>  false,
  //                             'fields'           =>  $is_admin ? true : false,
  //                             'disabled'         =>  false,
  //                             'tab'              =>  'Transporte y gestión'
  //                           ],

  // 'fecha_vuelta'        =>  [ 'label'            =>  'Fecha vuelta',
  //                             'columns'          =>  false,
  //                             'column_name'      =>  '',
  //                             'column_callback'  =>  false,
  //                             'fields'           =>  $is_admin ? true : false,
  //                             'disabled'         =>  false,
  //                             'tab'              =>  'Transporte y gestión'
  //                           ],

  'validado'            =>  [ 'label'            =>  'Validado',
                              'columns'          =>  (AutoIncludes::getFileName(true) == 'ponentes' ? true : false),
                              'column_name'      =>  '',
                              'column_callback'  =>  false,
                              'fields'           =>  $is_admin ? true : false,
                              'disabled'         =>  false,
                              'highlight_row'    =>  (AutoIncludes::getFileName(true) == 'ponentes' ? [['=', '1', '#c2f4b5']] : false),
                              'tab'              =>  'Transporte y gestión'
                            ]
];

if (AutoIncludes::getFileName(true) == 'delegados') {
  // Extra column with totals
  $fields['Validados'] = [
                          'subselect'     => 'SELECT count(id_inscrito) FROM usuarios WHERE id_gerente = {id_inscrito} AND validado = 1',
                          'columns'       => true,
                          'column_width'  => '100px',
                          'highlight'     => [['<', '{Inscritos}', '#ffcec7'], ['=', '0', '#ffcec7']],
  ];
  $fields['Inscritos'] = [
                          'subselect'     => 'SELECT count(id_inscrito) FROM usuarios WHERE id_gerente = {id_inscrito}',
                          'columns'       => true,
                          'column_width'  => '100px'
  ];

}

// Fields 'Alojamiento' and 'Servicios' as nested tables or fk relation depending on user type
if ($is_admin) {
  // Nesteds for id_inscrito:
  $nesteds_id_inscritos = [
                            ['nested_name' => 'Alojamiento',
                            'nested_table' => 'inscrito_alojamiento',
                            'nested_field' => 'id_inscrito',
                            'grid'         => ['table_name' => ' ',
                                               'hide_'

                            ],
                            'fields'  => [
                              'id_inscrito'    =>  ['label'  =>  'Inscrito',
                                                    'column_name'      =>  '',
                                                    'column_callback'  =>  false,
                                                    'columns'          =>  false,
                                                    'fields'           =>  false,
                                                    'disabled'         =>  false,
                                                    'tab'              =>  false
                                                  ],
                              'id_alojamiento'=>  ['label'  =>  'Alojamiento',
                                                  'column_name'      =>  'Alojamiento',
                                                  'column_callback'  =>  false,
                                                  'columns'          =>  true,
                                                  'fields'           =>  true,
                                                  'disabled'         =>  [true, 'edit'],
                                                  'tab'              =>  false,
                                                  'relation'         => ['alojamiento', 'id_alojamiento', 'nombre']
                                                  ],
                              'precio'        =>  ['label'           =>  'Precio',
                                                  'column_name'      =>  'Precio',
                                                  'column_callback'  =>  false,
                                                  'columns'          =>  true,
                                                  'fields'           =>  true,
                                                  ]

                            ]
                          ],
                          ['nested_name' => 'Servicios',
                          'nested_table' => 'inscrito_servicio',
                          'nested_field' => 'id_inscrito',
                          'grid'         => ['table_name' => ' '

                          ],
                          'fields'  => [
                            'id_inscrito'    =>  ['label'  =>  'Inscrito',
                                                  'column_name'      =>  '',
                                                  'column_callback'  =>  false,
                                                  'columns'          =>  false,
                                                  'fields'           =>  false,
                                                  'disabled'         =>  false,
                                                  'tab'              =>  false
                                                ],
                            'id_servicio'=>  ['label'  =>  'Servicios',
                                                'column_name'      =>  'Servicio',
                                                'column_callback'  =>  false,
                                                'columns'          =>  true,
                                                'fields'           =>  true,
                                                'disabled'         =>  [true, 'edit'],
                                                'tab'              =>  false,
                                                'relation'         => ['servicios', 'id_servicio', 'nombre']
                                                ],
                            'precio'        =>  ['label'           =>  'Precio',
                                                'column_name'      =>  'Precio',
                                                'column_callback'  =>  false,
                                                'columns'          =>  true,
                                                'fields'           =>  true,
                                                ]
                          ]
                         ]
                      ];
  $fields['id_inscrito']['nested'] = $nesteds_id_inscritos;
}else{
  $new_array = ['label'       => '<br/><h4><i class="fa fa-building"></i> &nbsp;Alojamiento</h4><hr/>',
                'fields'      => true,
                'tab'         => 'Informacion inscrito',
                'fk_relation' => ['id_inscrito',
                                  'inscrito_alojamiento',
                                  'id_inscrito',
                                  'id_alojamiento',
                                  'alojamiento',
                                  'id_alojamiento',
                                  array('nombre'),'','','||']
  ];
  Tools::array_insert($fields, 'comentarios', ['Alojamiento' => $new_array]);

  $new_array = ['label'       => '<br/><h4><i class="far fa-thumbs-up"></i> &nbsp;Servicios</h4><hr/>',
                'fields'      => true,
                'tab'         => 'Informacion inscrito',
                'fk_relation' => ['id_inscrito',
                                  'inscrito_servicio',
                                  'id_inscrito',
                                  'id_servicio',
                                  'servicios',
                                  'id_servicio',
                                  array('nombre'),'','','||']
  ];
  Tools::array_insert($fields, 'comentarios', ['Servicios' => $new_array]);

}

$mode = false; $ikey = false;
$allowed_actions = ['edit', 'create', 'view'];
if (isset($_REQUEST['action']) and isset($_REQUEST['row'])
    and !empty(trim($_REQUEST['action'])) and !empty(trim($_REQUEST['row']))
    and in_array($_REQUEST['action'], $allowed_actions)) {
      $mode = $_REQUEST['action'];
      $ikey = $_REQUEST['row'];
      echo Tools::xcrud($grid, $fields)->render($mode, $ikey);
}else{
      $tdata['content'] = Tools::xcrud($grid, $fields)->render($mode, $ikey);
}


?>
