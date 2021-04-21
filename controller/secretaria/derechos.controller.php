<?php
global $tdata;

// Login control - If not, goes to login page especified in config file
Tools::loginControl();

// Rights control - If not have rigths, goes to home page especified in config file
Tools::rightsControl(['manage', 'view:' . AutoIncludes::getFileName(true)]);

// Xcrud
Tools::loadInclude('xcrud', 'xcrud');

$xcrudcom = Xcrud::get_instance();
$xcrudcom->table('derechos');

$tdata['content'] = $xcrudcom->render();
?>
