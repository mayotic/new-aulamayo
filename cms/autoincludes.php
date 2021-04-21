<?php
defined('_DA') or exit('Restricted Access');

class AutoIncludes {

  public static function getFileName($remove_extension = false, $is_include = false) {
    $file_name = false;

    if (!$is_include){
      $file_name = basename($_SERVER['PHP_SELF']);
    }else{
      $includes =  get_included_files();
      $file_name = basename($includes[count($includes) - 1]);
    }

    if ($remove_extension){
      $file_name = pathinfo($file_name, PATHINFO_FILENAME);
    }

    return str_replace('/', '', $file_name);
  }
  public static function getCurrentpage () {
    $http_folder = AutoIncludes::getHttpFolder();
    return ($http_folder !== '' ? '/' : '') . $http_folder . '/' . AutoIncludes::getFileName(true);
  }
  public static function getHttpRoot() {
    return isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : (isset($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : '_UNKNOWN_');
  }

  public static function getCurrentPath() {
    return getcwd();
  }

  public static function getRootPath() {
    return $_SERVER['DOCUMENT_ROOT'];
  }
  public static function getAppRootPath () {
    global $conf;
    return $_SERVER['DOCUMENT_ROOT'] . $conf['app']['folder'];
  }
  public static function getAppRootUrl () {
    global $conf;
    return self::getHttpRoot() . $conf['app']['folder'];
  }
  public static function getHttpFolder () {
    global $conf;
    $realpath = explode('/', ($_SERVER['PHP_SELF']));

    $uripath = array_values(array_filter($realpath));

    $uripath[count($uripath) - 1] = parse_url($uripath[count($uripath) - 1])['path'];

    if (str_replace('.php', '', $uripath[count($uripath) - 1]) == self::getFileName(true)) {
      unset($uripath[count($uripath) - 1]);
    }

    $sitepath = explode('/', $conf['app']['folder']);

    foreach ($uripath as $key => $value) {
      if (in_array($value, $sitepath)) {
        unset($uripath[$key]);
      }
    }

    return implode('/', $uripath );
  }

  public static function loadResource ($type, $is_include = false, $follow_tree = true) {
    global $conf;
    $resfolder = $conf['app']['resources'] . '/' . $type;
    $folder = ($follow_tree ? '/' . self::getHttpFolder() : '');
    $fullfilePath = $resfolder . (($folder != '/' and $folder != '') ? $folder : '') . '/' . self::getFileName(true, $is_include) . '.' . $type;

    if (file_exists(self::getRootPath() . $fullfilePath)) {
      switch ($type) {
        case 'js':
          return '<script type="text/javascript" src="' . $fullfilePath . '"></script>';
          break;
        case 'css':
          return '<link rel="stylesheet" href="' . $fullfilePath . '">';
          break;
        default:
          break;
      }
    }
    return false;
  }

  public static function loadCss ($is_include = false, $follow_tree = true) {
    return self::loadResource('css', $is_include, $follow_tree);
  }

  public static function loadJs ($is_include = false, $follow_tree = true) {
    return self::loadResource('js', $is_include, $follow_tree);
  }

  public static function loadAll ($is_include = false) {
    return self::loadCss($is_include) . self::loadJs($is_include);
  }

  public static function loadController ($is_include = false) {
    global $conf, $tdata;
    $contfolder = $conf['app']['controllers'];
    $filename = self::getFileName(true, $is_include);
    // $folder = self::getHttpFolder($_SERVER['REQUEST_URI']);
    $folder = ( $is_include ? implode('/', array_diff(explode('/', $is_include), explode('/', $_SERVER['DOCUMENT_ROOT']))) : self::getHttpFolder($_SERVER['REQUEST_URI']) );

    $fullfilePath = $contfolder . ($folder !== '' ? '/' : '') . $folder . '/' . self::getFileName(true, $is_include) . '.controller.php';

    if (file_exists($conf['app']['root'] . $fullfilePath)) {
      include $conf['app']['root'] . $fullfilePath;
    }
    return '';
  }

}
