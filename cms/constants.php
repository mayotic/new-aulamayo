<?php
// For some initializations (static properties), we ned constants
define('_HOST', $conf['db']['host']);
define('_USER', $conf['db']['user']);
define('_PASS', $conf['db']['pass']);
define('_DB', $conf['db']['database']);

define('ALLOWED_TAGS', '<h1><h2><h3><h4><h5><h6><strong><em>');
