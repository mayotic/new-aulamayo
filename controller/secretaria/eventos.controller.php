<?php
global $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudeve = Xcrud::get_instance();
$xcrudeve->table('eventos');
$xcrudeve->table_name('Cafés y talleres');

// Show
$xcrudeve->label('id_tipo_evento', 'Tipo evento  ');

// Dependent fields
$xcrudeve->relation('id_tipo_evento','tipos_evento','id_tipo_evento','nombre');
// $xcrudeve->change_type('descripcion', 'text');
// $xcrudeve->change_type('autores', 'text');

$xcrudses = $xcrudeve->nested_table('sesiones-evento', 'id_evento', 'sesiones_evento', 'id_evento');

// $xcrudses->columns('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');
// $xcrudses->fields('nombre, dia_inicio, hora_inicio, dia_fin, hora_fin, plazas');

$xcrudses->change_type('dia_inicio', 'date', '', array('range_end' => 'dia_fin', 'placeholder' => 'Desde ...'));
$xcrudses->change_type('dia_fin', 'date', '', array('range_start' => 'dia_inicio', 'placeholder' => 'Hasta ...'));

$tdata['content'] = $xcrudeve->render();
?>
