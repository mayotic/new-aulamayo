<?php
global $tdata, $conf, $appconf;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudusu = Xcrud::get_instance();
$xcrudusu->table('inscritos');

// Grid visualization
$xcrudusu->table_name('Usuarios', 'Usuarios del sistema','far fa-user');
$xcrudusu->columns('id_tipo_inscrito, nombre, apellido_1, apellido_2, email');
$xcrudusu->fields('id_tipo_inscrito, id_gerente, nombre, apellido_1, apellido_2, email, pass, Permisos del usuario');
$xcrudusu->change_type('pass', 'password');

// Labels
$xcrudusu->label(['id_tipo_inscrito'  => 'Tipo inscrito',
                  'id_gerente'        => 'Responsable',
                  'pass'              => 'Contraseña'
                ]);

// Relations
$xcrudusu->relation('id_tipo_inscrito','tipos_inscrito','id_tipo_inscrito','nombre');
$xcrudusu->relation('id_gerente','inscritos','id_inscrito',['nombre', 'apellido_1', 'apellido_2'], 'id_tipo_inscrito = ' . $appconf['tipo_gerente'] . ' OR id_tipo_inscrito = ' . $appconf['tipo_delegado']);

// User permisions
$xcrudusu->fk_relation('Permisos del usuario','id_inscrito','users_permissions','user_id','permission_id','permissions','permission_id', 'permission_name');

// Template data
$tdata['content'] = $xcrudusu->render();
?>
