<?php
global $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudloc = Xcrud::get_instance();
$xcrudloc->table('localidades');

$xcrudloc->relation('id_comunidad','comunidades','id_comunidad','nombre');

$tdata['content'] = $xcrudloc->render();
?>
