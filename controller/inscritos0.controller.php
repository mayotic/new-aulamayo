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

$xcrudins = Xcrud::get_instance();
$xcrudins->table('inscritos');

// GRID VISUALIZATION:
// Grid title
if (isset($_REQUEST['delegado'])) {
  $dlg = new User($_REQUEST['delegado']);
  $delegado = '<br/><span style="font-size:16px; color:#777">Delegado: ' . $dlg->getUserInfo()['nombre'] . ' ' . $dlg->getUserInfo()['apellido_1'] . ' ' . $dlg->getUserInfo()['apellido_2'] . '</span>';
}else{
  $delegado= '';
}
$xcrudins->table_name('Inscritos <i class="far fa-address-card"></i>' . $delegado);

// Overview columns
$xcrudins->columns('id_tipo_inscrito, nombre, apellido_1, apellido_2');

// Edit and add filter fields depending of user type
$info_fields = 'id_tipo_inscrito, id_gerente, nombre, apellido_1, apellido_2,
                email, dni, direccion_fiscal,
                telefono, id_especialidad, id_pais, id_comunidad, id_localidad,
                id_centro_trabajo';

if (App::getUserTipe($_SESSION['userlogedin']) !== $appconf['tipo_admin']) {
  $info_fields .=', Alojamiento, Servicios';
}

$info_fields .= ', comentarios, Sesion eventos';

$admin_fields = 'id_acuerdo, id_derecho, fecha_ida,trayecto_ida,terminal_salida_ida,terminal_llegada_ida,fecha_llegada_ida,fecha_vuelta,trayecto_vuelta,
                terminal_salida_vuelta,terminal_llegada_vuelta, fecha_llegada_vuelta, validado';
// New
$economic_fields = 'precio_ida,precio_vuelta';

if (App::getUserTipe($_SESSION['userlogedin']) !== $appconf['tipo_admin']) {
  $xcrudins->fields($admin_fields . ',id_localidad_medio_ida,id_medio_ida, id_localidad_medio_vuelta, id_medio_vuelta', true); // Oculta els camps de secretaria
  $xcrudins->unset_csv( true );
  $xcrudins->unset_print( true );
}else{
  $xcrudins->fields($info_fields, false, 'Informacion inscrito');
  $xcrudins->fields($admin_fields, false, 'Datos gestión');

  // new
  $xcrudins->fields('id_localidad_medio_ida,id_medio_ida, precio_ida, id_localidad_medio_vuelta, id_medio_vuelta, precio_vuelta', false, 'Transportes');
  $xcrudaloj = $xcrudins->nested_table('Alojamientos', 'id_inscrito', 'inscrito_alojamiento', 'id_inscrito');
  $xcrudaloj->relation('id_alojamiento','alojamiento','id_alojamiento','nombre');
  $xcrudaloj->fields('id_inscrito', true);
  $xcrudaloj->columns('id_inscrito', true);
  $xcrudaloj->disabled('id_alojamiento', 'edit');
  $xcrudaloj->label(['id_alojamiento' => 'Alojamiento', 'precio' => 'Precio']);

  // $xcrudaloj->unset_add();
  $xcrudaloj->unset_view();
  // $xcrudaloj->unset_remove();
  $xcrudaloj->unset_csv();
  $xcrudaloj->unset_print();
  $xcrudaloj->unset_search();
  $xcrudaloj->unset_pagination();
  $xcrudaloj->unset_limitlist();

  $xcrudaloj->hide_button('save_new');
  $xcrudaloj->hide_button('save_edit');
  // $xcrudaloj->hide_button('return');

  $xcrudserv = $xcrudins->nested_table('Servicios', 'id_inscrito', 'inscrito_servicio', 'id_inscrito');
  $xcrudserv->relation('id_servicio','servicios','id_servicio','nombre');
  $xcrudserv->fields('id_inscrito', true);
  $xcrudserv->columns('id_inscrito', true);
  $xcrudserv->disabled('id_servicio', 'edit');
  $xcrudserv->label(['id_servicio' => 'Servicio', 'precio' => 'Precio']);

  // $xcrudserv->unset_add();
  $xcrudserv->unset_view();
  // $xcrudserv->unset_remove();
  $xcrudserv->unset_csv();
  $xcrudserv->unset_print();
  $xcrudserv->unset_search();
  $xcrudserv->unset_pagination();
  $xcrudserv->unset_limitlist();

  $xcrudserv->hide_button('save_new');
  $xcrudserv->hide_button('save_edit');
  // $xcrudserv->hide_button('return');
}

// Hide pass field
// $xcrudins->fields('pass', true);

// Fields validations
$fields_required = ['nombre' => 1,
                    'apellido_1' => 1,
                    'telefono' => 1,
                    'email' => 1];

$fields_for_validation = ['email' => 'email'];

$xcrudins->validation_required($fields_required);
$xcrudins->validation_pattern($fields_for_validation);

// Reformat layout of inputs
// $xcrudins->field_callback ('Sesion eventos', 'App::addLegendToEventos', $_SERVER['DOCUMENT_ROOT'] . '/include/app.php');

// Reformat layout of inputs
$xcrudins->column_callback ('Sesion eventos', 'App::reformatMultiSelectView', $_SERVER['DOCUMENT_ROOT'] . '/include/app.php');

// Labels
$xcrudins->label(['id_tipo_inscrito'          => 'Tipo inscrito',
                  'id_gerente'                => 'Responsable',
                  'nombre'                    => '<br/><h4><i class="far fa-address-card"></i> &nbsp;Datos asistente</h4><hr/>Nombre',
                  'id_acuerdo'                => 'Acuerdo',
                  'id_derecho'                => 'Derechos',
                  'id_especialidad'           => 'Especialidad',
                  'id_pais'                   => 'País',
                  'id_comunidad'              => 'Comunidad',
                  'id_localidad'              => 'Provincia',
                  'id_centro_trabajo'         => 'Centro trabajo',
                  'id_localidad_ida'          => 'Poblacion ida',
                  'id_medio_ida'              => 'Transporte ida',
                  'id_medio_vuelta'           => 'Transporte vuelta',
                  'id_localidad_medio_ida'    => '<br/><h4><i class="fa fa-plane"></i> &nbsp;Logística</h4><hr/>Localidad ida',
                  'id_localidad_medio_vuelta' => 'Localidad vuelta',
                  'Alojamiento'               => '<br/><h4><i class="fa fa-building"></i> &nbsp;Alojamiento</h4><hr/>Alojamiento',
                  'dni'                       => 'DNI',
                  'direccion_fiscal'          =>  'Dirección fiscal',
                  'telefono'                  => 'Teléfono',
                  'id_centro_trabajo'         =>  'Centro de trabajo',
                  'Sesion eventos'            =>  '<br/><h4><i class="far fa-calendar-alt"></i> &nbsp;Eventos</h4><hr/>Sesion eventos'
                ]);
$xcrudins->column_name('nombre', 'Nombre');

// Hide button in edit mode
$xcrudins->hide_button('save_edit');

// GRID CONTENT
// Per user type content filters (where) for main content and selects
// Filters (where's) for selects
$tipoins_where = '';
$respons_where = '';
$medios_where = '';

switch ($user->tipo_inscrito) {
  case $appconf['tipo_admin']:
    // Main filter
    if (isset($_REQUEST['delegado'])) {
      $xcrudins->where('id_gerente =', $_REQUEST['delegado']);
      $xcrudins->pass_default(['id_gerente' => $_REQUEST['delegado']]);
    }

    break;

  case $appconf['tipo_gerente']:
    // Main filter
    if (isset($_REQUEST['delegado'])) {
      $xcrudins->where('id_gerente =', $_REQUEST['delegado']);
    }else{
      $xcrudins->where('id_inscrito =', 0);
    }
    // Filter "medios transporte" (not "extras"), if not manager user
    $medios_where = 'medio_extra = 0';

    break;

  case $appconf['tipo_delegado']:
    // Main filter
    $xcrudins->where('id_gerente =', $user->id);

    // Selects filters
    // Leave admin users from tipo_inscrito select
    $tipoins_where .= 'id_tipo_inscrito = ' . $appconf['tipo_asistente'];
    $respons_where .= 'id_inscrito = ' . $user->id;

    // Default values
    $xcrudins->pass_default(['id_tipo_inscrito' => $appconf['tipo_asistente']]);
    $xcrudins->pass_default(['id_gerente' => $user->id]);

    // Read only
    $xcrudins->readonly('id_tipo_inscrito, id_gerente');

    // Filter "medios transporte" (not "extras"), if not manager user
    $medios_where = 'medio_extra = 0';

    break;

  // default:
  //   break;
}

// Unset excel export original button. We made our custom excel export
// $xcrudins->unset_csv();

// Add, edit and remove buttons depending of rights
if (!$user->can(['manage', 'edit:' . AutoIncludes::getFileName(true)], false)) {
  $xcrudins->unset_edit();
  if ((int)$_REQUEST['delegado'] !== (int)$user->id) {
    $xcrudins->unset_add();
  }
}
if (!$user->can(['manage', 'remove:' . AutoIncludes::getFileName(true)], false)) {
  $xcrudins->unset_remove();
}

// Resolution of ids with their literals in another tables
$xcrudins->relation('id_tipo_inscrito','tipos_inscrito','id_tipo_inscrito','nombre', $tipoins_where);
$xcrudins->relation('id_gerente','inscritos','id_inscrito',['nombre', 'apellido_1', 'apellido_2'], $respons_where);

if ($user->tipo_inscrito == $appconf['tipo_admin']) {
  $xcrudins->relation('id_acuerdo','acuerdos','id_acuerdo','nombre');
  $xcrudins->relation('id_derecho','derechos','id_derecho','nombre');
}

$xcrudins->relation('id_especialidad','especialidades','id_especialidad','nombre');
$xcrudins->relation('medio_usuario','transportesgen','id_transporte','nombre');

// Dependent fields
$xcrudins->relation('id_pais','paises','id_pais','nombre');
$xcrudins->relation('id_comunidad','comunidades','id_comunidad','nombre','','','','','','id_pais','id_pais');
$xcrudins->relation('id_localidad','localidades','id_localidad','nombre','','','','','','id_comunidad','id_comunidad');
$xcrudins->relation('id_centro_trabajo','centros_trabajo','id_centro_trabajo','nombre','','','','','','id_localidad','id_localidad');

// MEDIO Transporte
// Medios ida
$xcrudins->relation('id_localidad_medio_ida','localidades','id_localidad','nombre');
$xcrudins->relation('id_medio_ida','view_transportes_ida','id_ida', ['nombre_tipo', 'referencia', 'fecha', 'hora1', 'hora2'], $medios_where, 'nombre_tipo,fecha,hora1 asc','',' • ','','id_poblacion','id_localidad_medio_ida');

// Medios vuelta
$xcrudins->relation('id_localidad_medio_vuelta','localidades','id_localidad','nombre');
$xcrudins->relation('id_medio_vuelta','view_transportes_vuelta','id_vuelta', ['nombre_tipo', 'referencia', 'fecha', 'hora1', 'hora2'], $medios_where, 'nombre_tipo,fecha,hora1 asc','',' • ','','id_poblacion','id_localidad_medio_vuelta');

if (App::getUserTipe($_SESSION['userlogedin']) !== $appconf['tipo_admin']) {
  // Transports
  $xcrudins->fk_relation('Alojamiento',
                        'id_inscrito',
                        'inscrito_alojamiento',
                        'id_inscrito',
                        'id_alojamiento',
                        'alojamiento',
                        'id_alojamiento',
                        array('nombre'),'','','||');

  // Services
  $xcrudins->fk_relation('Servicios',
                        'id_inscrito',
                        'inscrito_servicio',
                        'id_inscrito',
                        'id_servicio',
                        'servicios',
                        'id_servicio',
                        array('nombre'),'','','||');
  // $xcrudins->change_type('Alojamiento', 'checkbox');
}


// Inscription to events
$xcrudins->fk_relation('Sesion eventos',
                      'id_inscrito',
                      'inscrito_sesion',
                      'id_inscrito',
                      'id_sesion',
                      'sesiones_evento',
                      'id_sesion',
                      array('nombre', 'dia_inicio','hora_inicio', 'dia_fin', 'hora_fin', 'plazas', 'id_evento'),'','','||');
// Aviso por email
// $email_body = '
// Gerente: jvilanova@edicionesmayo.es
// Nombre Delegado: {id_gerente} <br/>
// Tipo inscrito: {id_tipo_inscrito}
// Nombre: {nombre} <br/>
// Apellidos: {apellido_1} {apellido_2} <br/>
// Email Participante: {email} <br/>
// DNI: {dni} <br/>
// Dirección fiscal: {direccion_fiscal} <br/>
// Teléfono: {telefono} <br/>
// Especialidad:  {id_especialidad} <br/>
// Centro de trabajo: {id_centro_trabajo} <br/>
// País:  {id_pais} <br/>
// Alojamiento:  {Alojamiento} <br/>
// Servicios:  {Servicios} <br/>
// Comentarios: {comentarios} <br/>
// Eventos (Cafés y talleres):
// {Sesion eventos}
// ';

// $emails_copia = $conf['emails']['mailcc1'] . ',' . $conf['emails']['mailcc2'] . ',' . $user->email;
// $xcrudins->alert_create( 'email', $emails_copia, 'Nuevo inscrito.', $email_body );

// Email send after insert
$xcrudins->after_insert('App::sendMailAfterInsert', $_SERVER['DOCUMENT_ROOT'] . '/include/app.php');

// Change types
$xcrudins->change_type('id_medio_ida', 'radio');
$xcrudins->change_type('id_medio_vuelta', 'radio');

$tdata['content'] = $xcrudins->render();

?>
