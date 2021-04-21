<?php
global $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudtrans = Xcrud::get_instance();
$xcrudtrans->table('transportes_vuelta');

// Show
// $xcrudeve->label('id_tipo_evento', 'Tipo e');

// Dependent fields
$xcrudtrans->relation('id_poblacion','localidades','id_localidad','nombre');
$xcrudtrans->relation('tipo','transportesgen','id_transporte','nombre');
$xcrudtrans->relation('id_impuesto','impuestos','id_impuesto','nombre');
// $xcrudeve->change_type('descripcion', 'textarea');

// $xcrudses->columns('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');
// $xcrudses->fields('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');

// $xcrudses->change_type('fecha', 'date', '', array('range_end' => 'dia_fin', 'placeholder' => 'Desde ...'));
$xcrudtrans->change_type('hora1', 'time');
$xcrudtrans->change_type('hora2', 'time');
$xcrudtrans->change_type('fecha', 'date');

$tdata['content'] = $xcrudtrans->render();
?>
