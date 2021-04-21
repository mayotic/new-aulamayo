<?php
if ( session_status() == PHP_SESSION_NONE and (empty($start_sessions) and $start_sessions !== false)) {
  session_start();
}

// Constants
if (!defined('_DA')) {
  define('_DA', 1);
}

// Load site configs
$conf = include 'config.php';
$appconf = include $conf['app']['root'] . '/include/appconf.php';
$tdata = [];

// Set session environment
$_SESSION['env'] = $conf['env'];

// Show errors if developer environment
if ($conf['env'] == 'dev') {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Hooks
if (!isset($hooks)) {
  $hooks = [];
}

// CONSTANTS
// For some initializations (static properties), we ned constants for db connection
if (!defined('_HOST')) {
  define('_HOST', $conf['db']['host']);
  define('_USER', $conf['db']['user']);
  define('_PASS', $conf['db']['pass']);
  define('_DB', $conf['db']['database']);
}

// Include app constants
include_once $conf['app']['root'] . '/include/appcons.php';

// Include the basics
include_once 'autoincludes.php';
include_once $conf['app']['root'] . '/include/tools.php';

// Pdox
// include_once $conf['app']['root'] . '/include/pdox/Cache.php';
include_once $conf['app']['root'] . '/include/pdox/PdoxInterface.php';
include_once $conf['app']['root'] . '/include/pdox/Pdox.php';
// Auth library
include_once $conf['app']['root'] . '/include/auth/auth.class.php';
// Users and rights library
include_once $conf['app']['root'] . '/include/acl/user.class.php';
// App code
include_once $conf['app']['root'] . '/include/app.php';

spl_autoload_register(function ($class_name) {
  global $conf;

  if (strpos($class_name, 'Requests_') === 0) { // Starts with Request_ (autoload httpclient classes)
    $file = str_replace('_', '/', $class_name);
    if (file_exists($conf['app']['root'] . '/include/httpclient/' . $file . '.php')) {
      require_once $conf['app']['root'] . '/include/httpclient/' . $file . '.php';
    }
  }elseif(strpos($class_name, 'Model', strlen($class_name) - strlen('Model')) !== false){ // Ends with Model (autoload Models classes)
    include_once $conf['app']['root'] . '/model/' . strtolower(str_replace('Model', '',$class_name)) . '.model.php';
  }
});
