<?php
global $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudaloja = Xcrud::get_instance();
$xcrudaloja->table('alojamiento');

// Show
// $xcrudeve->label('id_tipo_evento', 'Tipo e');

// Dependent fields
// $xcrudtrans->relation('id_poblacion','localidades','id_localidad','nombre');
// $xcrudeve->change_type('descripcion', 'textarea');

// $xcrudses->columns('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');
// $xcrudses->fields('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');

// $xcrudtrans->change_type('hora1', 'time');


$tdata['content'] = $xcrudaloja->render();
?>
