<?php
defined('_DA') or exit('Restricted Access');

class Tools {
  public static function phpInfo () {
    echo phpinfo();
  }
  public static function loadJquery($version = '3.4.1.min') {
    $output = '
    <script src="https://code.jquery.com/jquery-' . $version . '.js" crossorigin="anonymous"></script>';
    return $output;
  }
  public static function loadBootStrap($version = '4.3.1', $poperversion = '1.14.7/umd') {
    $output = '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/' . $poperversion . '/popper.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/' . $version . '/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/' . $version . '/js/bootstrap.min.js" crossorigin="anonymous"></script>
    ';
    return $output;
  }
  public static function loadFontAwesome($version = 'v5.7.0') {
    $output = '
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    ';
    return $output;
  }
  public static function loadSelect2($version = '4.0.12') {
    $output = '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/' . $version . '/js/select2.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/' . $version . '/css/select2.min.css" crossorigin="anonymous">
    ';
    return $output;
  }
  public static function loadJqueryUI($version = '1.12.1') {
    $output = '<script src="https://code.jquery.com/ui/' . $version . '/jquery-ui.min.js" crossorigin="anonymous"></script>';
    return $output;
  }
  public static function loadResourceLibrary ($folder, $type, $name) {
    global $conf;
    // $libfolder = explode('/', $conf['appinfo']['libfolder']);
    $libfolder = $conf['appinfo']['libfolder'];
    $current_path = AutoIncludes::getHttpFolder();
    $fullfilePath = $libfolder . ($folder !== '' ? '/' : '') . $folder . '/' . $name . '.' . $type;
    // $fullfilePath = '/' . implode('/', array_filter(array_merge($libfolder, [$folder, $name])));

    if (file_exists(AutoIncludes::getRootPath() . $fullfilePath)) {
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
  public static function loadLibrary ($type, $name) {
    return self::loadResourceLibrary('/' . $type, $type, $name);
  }
  public static function loadImage ($type, $name, $include_tag = false) {
    global $conf;
    $imgfolder = $conf['appinfo']['imgfolder'] . '/';
    $fullfilePath = $imgfolder . $name . '.' . $type;

    if (file_exists(AutoIncludes::getRootPath() . $fullfilePath)) {
      if ($include_tag) {
        return '<img src="' . $fullfilePath . '">';
      }else{
        return $fullfilePath;
      }
    }
    return false;
  }
  public static function includeFile ($folder, $name) {
    if (file_exists($fullfilePath = AutoIncludes::getRootPath() . $folder . '/' . $name . '.php')) {
        return include_once $fullfilePath;
    }
    return false;
  }
  public static function loadInclude($folder, $name) {
    global $conf;
    return self::includeFile($conf['appinfo']['incfolder'] . (empty($folder) ? '' : '/' ) . $folder, $name);
  }
  public static function includeHook($folder, $name) {
    global $conf;
    return self::includeFile($conf['appinfo']['hooksfolder'] . (empty($folder) ? '' : '/' ) . $folder, $name . '.hook');
  }
  public static function loadTranslation($lang) {
    global $conf;
    return self::includeFile($conf['appinfo']['langfolder'], $lang);
  }
  public static function loadTemplatePart ($name) {
    global $conf;
    return self::includeFile($conf['appinfo']['tempfolder'] . '/part', $name);
  }
  public static function loadXcrud() {
    return self::loadInclude('xcrud', 'xcrud');
  }
  public static function loadPdox () {
    self::loadInclude('pdox', 'Cache');
    self::loadInclude('pdox', 'PdoxInterface');
    self::loadInclude('pdox', 'Pdox');
    return true;
  }
  public static function loadPhpMailer () {
    self::loadInclude('phpmailer/src', 'PHPMailer');
    self::loadInclude('phpmailer/src', 'SMTP');
    self::loadInclude('phpmailer/src', 'Exception');
    return true;
  }
  public static function getFileDocBlock($file) {
    $fileDocComment = token_get_all( file_get_contents( $file ) );
    $is_set = (isset($fileDocComment[1]) and isset($fileDocComment[1][1]) and isset($fileDocComment[1][1][0]) and isset($fileDocComment[1][1][1]));
    $comment = ($is_set and $fileDocComment[1][1][0] == '/' and $fileDocComment[1][1][1] == '*') ? $fileDocComment[1][1] : '';
    return str_replace(['/*', '*/'], ['', ''], $comment);
  }
  public static function buildMenu($menuid = 'main', $render_tree = false, $row_template = '<a href="{{link}}">{{linkname}}</a>', $submenu_wrapper  = '<div class="sub-list">{{content}}</div>', $submenu_template = '<a class="dropdown-item" href="{{link}}">{{linkname}}</a>', $wrapper = '{{content}}', $path, $start) {
    global $hooks;
    $files_tree = self::getFileTree($path . '/' . $start);
    $menu_info = [];
    $amenu = [];
    if ($inici = strpos($start, $_SERVER['DOCUMENT_ROOT']) and count($start) != count($_SERVER['DOCUMENT_ROOT'])){
      $html_folder = substr($start, $inici + 1);
    }else{
      $html_folder = '';
    }

    foreach ($files_tree as $folder => $files) {
      if (!is_array($files)) {
        $files = [$files];
      }
      foreach ($files as $key => $file) {
        if (!is_array($file) and pathinfo($file, PATHINFO_EXTENSION) == 'php') {
          // Get the first comment block where the menu info is
          $dir = (!is_numeric($folder) ? $path . '/' . $start . '/' . $folder : $start);

          $parent = is_dir($dir) ? $folder : '';

          $comment = self::getFileDocBlock($path . '/' . $start . ($parent == '' ? '' : '/' . $parent) . '/' . $file);
          if ($comment === '') { continue; }
          // Clasify the menu info for this file
          $menu = explode( '|', explode('=', $comment)[1] );
          // Include the menu option if menu identifier matches
          if (trim($menu[0]) == $menuid) {
            if ($render_tree and $parent !== ''){
              $amenu[$parent][$menu[2]] = ['link' => '/' . $start . ($parent == '' ? '' : '/' . $parent) . '/' .  pathinfo($file, PATHINFO_FILENAME),
                                           'linkname' => $menu[1],
                                           'parentname' => $parent,
                                           'pagename' => (AutoIncludes::getFileName(true) == basename($file, '.php') ? 'active' : ''),
                                           'icon' => (isset($menu[3]) ? $menu['3'] : '')];
            }else{
              $amenu[$menu[2]] = ['link' => ($parent == '' ? '' : '/' . $parent) . '/' . $start . '/' . pathinfo($file, PATHINFO_FILENAME),
                                  'linkname' => $menu[1],
                                  'pagename' => (AutoIncludes::getFileName(true) == basename($file, '.php') ? 'active' : ''),
                                  'icon' => (isset($menu[3]) ? $menu['3'] : '')];
            }
          }
        }
      }
    }

    //  Run Hooks
    if (isset($hooks['menuFilter'])) {
      $amenu = $hooks['menuFilter']($amenu);
    }

    ksort($amenu, SORT_NUMERIC);
    foreach ($amenu as $key => $value) {
      if (is_array($value)) {
        ksort($amenu[$key], SORT_NUMERIC);
      }
    }
    foreach ($amenu as $key => $value) {
      if (!is_numeric($key)) {
        $after = array_key_first($amenu[$key]) - 1;
        $element = $amenu[$key];
        unset($amenu[$key]);
        // var_dump([$key => $element]);
        Tools::array_insert($amenu, $after, [$key => $element]);
      }
    }

// var_dump($amenu);

    return ($render_tree) ? Tools::makeHtmlTreeList($amenu, $row_template, $submenu_template, $submenu_wrapper, $wrapper) : Tools::tmpl($amenu, $row_template, $wrapper);
  }

  public static function makeHtmlTreeList($data_list, $row_template, $sublist_template, $sublist_wrapper, $wrapper = '{{content}}') {
    $html = '';
    foreach ($data_list as $key => $row) {
      if (self::arrayDepth($row) == 0) {
        $html .= self::tmpl([$row], $row_template);
      }else{
        $html .= self::tmpl($row, $sublist_template, str_replace('{{parentname}}', array_values($row)[0]['parentname'], $sublist_wrapper));
      }
    }
    return str_replace('{{content}}', $html, $wrapper);
  }

  public static function arrayDepth($array) {
    $depth = 0;
    $iteIte = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
    foreach ($iteIte as $ite) {
        $d = $iteIte->getDepth();
        $depth = $d > $depth ? $d : $depth;
    }
    return $depth;
  }

  public static function getFileTree($dir_path = false) {
    global $conf;
    $dir_path = (!$dir_path) ? $_SERVER['DOCUMENT_ROOT'] : $dir_path;
    $rdi = new \RecursiveDirectoryIterator($dir_path);
    $rii = new \RecursiveIteratorIterator($rdi);
    $tree = [];
    foreach ($rii as $splFileInfo) {
        $file_name = $splFileInfo->getFilename();
        $parents = explode('/', $splFileInfo->getPathName());
        // Skip hidden files and directories. At the moment, only first level of tree is walkabout
        if ($file_name[0] === '.' or !in_array('/' . $parents[count($parents) - 2], $conf['appinfo']['pagesfolders'])) {
            continue;
        }
        $path = $splFileInfo->isDir() ? array($file_name => array()) : array($file_name);
        for ($depth = $rii->getDepth() - 1; $depth >= 0; $depth--) {
            $path = array($rii->getSubIterator($depth)->current()->getFilename() => $path);
        }
        $tree = array_merge_recursive($tree, $path);
    }
    return $tree;
  }

  /* Mini template system */
  public static function tmpl($data, $row_template, $wrapper = '{{content}}') {
  	$output = ''; $row = '';
  	foreach ($data as $key => $row) {
  		$outrow = $row_template;
  		foreach ($row as $field => $value) {
  			$outrow = str_replace('{{' . $field . '}}', $value, $outrow);
  		}
  		$output .= $outrow;
  	}

  	return str_replace('{{content}}', $output, $wrapper);
  }
  public static function redirect($url) {
    if ($url !== self::getCurrentPage()) {
      header('Location: '. $url);
      exit();
    }
  }
  public static function getCurrentPage() {
    $http_folder = AutoIncludes::getHttpFolder();
    return ($http_folder !== '' ? '/' : '') . $http_folder . '/' . AutoIncludes::getFileName(true);
  }
  public static function myEncrypt($string_to_encrypt, $password = 'lzyWGKfXak') {
    return openssl_encrypt($string_to_encrypt, "AES-128-ECB", $password);
  }
  public static function myDecrypt($encrypted_string, $password = 'lzyWGKfXak') {
    return openssl_decrypt($encrypted_string, "AES-128-ECB", $password);
  }

  public static function aesEncrypt($val, $salt = 'lzyWGKfXak', $cypher = null, $mySqlKey = true) {
      $key = $mySqlKey ? self::mysqlAesKey($salt) : $salt;

      if (function_exists('mcrypt_encrypt')) {
          $cypher = (!$cypher || $cypher == strtolower('aes-128-ecb')) ? MCRYPT_RIJNDAEL_128 : $cypher;
          $pad_value = 16 - (strlen($val) % 16);
          $val = str_pad($val, (16 * (floor(strlen($val) / 16) + 1)), chr($pad_value));
          return @mcrypt_encrypt($cypher, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
      } elseif (function_exists('openssl_encrypt')) {
          $cypher = (!$cypher || $cypher == MCRYPT_RIJNDAEL_128) ? 'aes-128-ecb' : $cypher;
          return openssl_encrypt($val, $cypher, $key, true);
      }

      throw new \BadFunctionCallException('No encryption function could be found.');

  }

  public static function aesDecrypt($val, $salt = 'lzyWGKfXak', $cypher = null, $mySqlKey = true) {
      $key = $mySqlKey ? self::mysqlAesKey($salt) : $salt;

      if (function_exists('mcrypt_decrypt')) {
          $cypher = (!$cypher || $cypher == strtolower('aes-128-ecb')) ? MCRYPT_RIJNDAEL_128 : $cypher;
          $val = @mcrypt_decrypt($cypher, $key, $val, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM));
          return rtrim($val, chr(0)."..".chr(16));
      } elseif (function_exists('openssl_decrypt')) {
          $cypher = (!$cypher || $cypher == MCRYPT_RIJNDAEL_128) ? 'aes-128-ecb' : $cypher;
          return openssl_decrypt($val, $cypher, $key, true);
      }

      throw new \BadFunctionCallException('No decryption function could be found.');

  }

  public static function mysqlAesKey($key) {
    $new_key = str_repeat(chr(0), 16);
    for ($i = 0, $len = strlen($key); $i < $len; $i++) {
        $new_key[$i % 16] = $new_key[$i % 16] ^ $key[$i];
    }
    return $new_key;
  }

  public static function loginControl() {
    $auth = new Auth();
    $auth->checkLoginAndRedirect();
    return true;
  }
  public static function rightsControl($rights, $alltopass = false) {
    global $conf;
    $user = new User($_SESSION['userlogedin']);
    if(!$user->can($rights, $alltopass)) {
      Tools::redirect($conf['appinfo']['url_home']);
    }
    return true;
  }
  public static function getProtectedValue($obj, $name) {
    $array = (array)$obj;
    $prefix = chr(0).'*'.chr(0);
    return $array[$prefix.$name];
  }
  public static function exportUserToJs() {
    $user = false;
    if (isset($_SESSION['userlogedin']) and $_SESSION['userlogedin']) {
      $user = $_SESSION['userlogedin'];
    }
    return '<script type="text/javascript">window.userlogedin = ' . (!empty($user) ? $user : 'false') . '</script>';
  }
  public static function _t($string, $echo = true) {
    global $_l;
    if ($echo) {
      echo $_l[$string];
    }else {
      return $_l[$string];
    }
  }
  public static function showAllPhpErrors () {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  }
  public static function isAjax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }
  public static function getUserAgent () {
    $info = new UserAgentInfo();
    $osName = $info->operatingSystem();
    $osVersion = $info->osVersion();
    $browserName = $info->browser()['browser'];
    $browserVersion = $info->browserVersion();
    $ip = $info->ip();
    $isMobile = $info->isMobile();
    $data = [
        'Operating System Name'    => $osName,
        'Operating System Version' => $osVersion,
        'Browser Name'             => $browserName,
        'Browser Version'          => $browserVersion,
        'Ip address'               => $ip,
        'Is Mobile'                => $isMobile,
    ];
    return $data;
  }
  public static function deviceCompatible () {
    $userAgent = Tools::getUserAgent();

    $is_compatible = true;
    switch ($userAgent['Operating System Name']) {
      case 'Macintosh':
        if ((int)explode('_', $userAgent['Operating System Version'])[0] < 10) {
          $is_compatible = false;
        }
        if ($userAgent['Browser Name'] == 'Microsoft Internet Explorer') {
          $is_compatible = false;
        }
        break;

      default:
        if ($userAgent['Browser Name'] == 'Microsoft Internet Explorer') {
          $is_compatible = false;
        }
        break;
    }

    return $is_compatible;
  }
  public static function xcrud ($grid, $fields, $instance = false) {
    self::loadInclude('xcrud', 'xcrud');

    if (!$instance) {
      $xcrud = Xcrud::get_instance();
    }else{
      $xcrud = $instance;
    }

    // Grig settings
    foreach ($grid as $key => $params) {
      if (method_exists($xcrud, $key)) {
        call_user_func_array( [$xcrud, $key], (!is_array($params) ? [$params] : $params) );
      }else{
        switch ($key) {
          case 'row_buttons':
            if (is_array($params)){
              foreach ($params as $v) {
                call_user_func_array( [$xcrud, 'button'], (!is_array($v) ? [$v] : $v) );
              }
            }
            break;
          case 'row_actions':
            if (is_array($params)){
              foreach ($params as $v) {
                call_user_func_array( [$xcrud, 'create_action'], (!is_array($v) ? [$v] : $v) );
              }
            }
            break;
            case 'custom_buttons':
            $custom_buttons = [];
              if (is_array($params)){
                $xcrud->set_var('custom_buttons', $params);
              }
              break;
        }
      }
    }

    // Variables to share with xcrud for templates and callbacks ($this->get_var('var_name'))
    if (isset($grid['hide_buttons'])) {
      foreach ($grid['hide_buttons'] as $value) {
        $xcrud->hide_button($value);
      }
    }

    // Templates for diferent views (list, view, edit, create)
    if (isset($grid['templates'])) {
      foreach ($grid['templates'] as $mode => $template) {
        $xcrud->load_view($mode, $template);
      }
    }

    // Variables to share with xcrud for templates and callbacks ($this->get_var('var_name'))
    if (isset($grid['vars'])) {
      foreach ($grid['vars'] as $var => $value) {
        $xcrud->set_var($var, $value);
      }
    }

    // Fields settings
    $cols = []; $readonly = []; $disabled = [];
    foreach ($fields as $key => $sets) {

      if (isset($sets['set_attr']) and $sets['set_attr']) {
        $xcrud->set_attr($key, $sets['set_attr']);
      }

      if (isset($sets['column_pattern']) and $sets['column_pattern']) {
        $xcrud->column_pattern($key, $sets['column_pattern']);
      }

      if (isset($sets['validation_required']) and $sets['validation_required']) {
        $xcrud->validation_required($key, $sets['validation_required']);
      }

      if (isset($sets['validation_pattern']) and $sets['validation_pattern']) {
        $xcrud->validation_pattern($key, $sets['validation_pattern']);
      }

      if (isset($sets['subselect']) and $sets['subselect']) {
        $xcrud->subselect($key, $sets['subselect']);
      }

      if (isset($sets['pass_default']) and $sets['pass_default']) {
        $xcrud->pass_default([$key => $sets['pass_default']]);
      }

      if (isset($sets['sum']) and $sets['sum']) {
        $xcrud->sum($key);
      }

      if (isset($sets['label']) and $sets['label']) {
        $xcrud->label($key, $sets['label']);
      }

      if (isset($sets['column_name']) and $sets['column_name']) {
        $xcrud->column_name($key, $sets['column_name']);
      }

      if (isset($sets['column_width']) and $sets['column_width']) {
        $xcrud->column_width($key, $sets['column_width']);
      }

      if (isset($sets['field_type']) and $sets['field_type']) {
        if (!is_array($sets['field_type'])) {
          $sets['field_type'] = [$sets['field_type']];
        }
        if (is_array($sets['field_type'])) {
          call_user_func_array([$xcrud, 'change_type'], array_merge([$key], $sets['field_type']));
        }
      }

      if (isset($sets['highlight']) and $sets['highlight']) {
        foreach ($sets['highlight'] as $v) {
          call_user_func_array([$xcrud, 'highlight'], array_merge([$key], $v));
        }
      }

      // Callbacks for columns
      if (isset($sets['column_callback']) and $sets['column_callback']) {
        if (is_array($sets['column_callback'])) {
          call_user_func_array([$xcrud, 'column_callback'], array_merge([$key], $sets['column_callback']));
        }
      }

      // Relations
      if (isset($sets['relation']) and $sets['relation']) {
        if (is_array($sets['relation']) and count($sets['relation']) > 2) {
          call_user_func_array([$xcrud, 'relation'], array_merge([$key], $sets['relation']));
        }
      }

      // FK Relations
      if (isset($sets['fk_relation']) and $sets['fk_relation']) {
        if (is_array($sets['fk_relation']) and count($sets['fk_relation']) > 6) {
          // var_dump(array_merge([$key], $sets['fk_relation'])); exit;
          call_user_func_array([$xcrud, 'fk_relation'], array_merge([$key], $sets['fk_relation']));
        }
      }

      // Nested tables
      if (isset($sets['nested']) and $sets['nested']) {
        foreach ($sets['nested'] as $k => $set) {
          ${'nested_' . $set['nested_table']} = $xcrud->nested_table($set['nested_name'], $key, $set['nested_table'], $set['nested_field']);
          if (!isset($set['grid'])) {
            $set['grid'] = [];
          }
          if (!isset($set['fields'])) {
            $set['fields'] = [];
          }
          ${'nested_' . $set['nested_table']} = self::xcrud($set['grid'], $set['fields'], ${'nested_' . $set['nested_table']});
        }
      }

      // Callbacks for fields
      if (isset($sets['field_callback']) and $sets['field_callback']) {
        call_user_func_array([$xcrud, 'field_callback'], array_merge([$key], $sets['field_callback']));
      }

      if (isset($sets['columns']) and $sets['columns']) {
        $cols[] = $key;
      }

      if (isset($sets['fields']) and $sets['fields']) {
        $params = [];
        if (isset($sets['tab'])) {
          $params = (is_array($sets['tab']) ? $sets['tab'] : [$sets['tab']]);
        }
        call_user_func_array([$xcrud, 'fields'], array_merge([$key], [false], $params));
      }

      if (isset($sets['readonly']) and $sets['readonly']) {
        // $readonly[] = $key;
        call_user_func_array([$xcrud, 'readonly'], array_merge([$key], $sets['readonly']));
      }

      if (isset($sets['disabled']) and $sets['disabled']) {
        if(!is_array($sets['disabled'])) {
          $xcrud->disabled($key);
        }else{
          if (is_array($sets['disabled'][1])) {
            foreach ($sets['disabled'][1] as $mode) {
              $xcrud->disabled($key, $mode);
            }
          }else{
            $xcrud->disabled($key, $sets['disabled'][1]);
          }
        }
      }

      if (isset($sets['order_by']) and $sets['order_by']) {
        $xcrud->order_by($key, $sets['order_by']);
      }

      if (isset($sets['column_class']) and $sets['column_class']) {
        $xcrud->column_class($key, $sets['column_class']);
      }

      if (isset($sets['highlight_row']) and $sets['highlight_row']) {
        foreach ($sets['highlight_row'] as $v) {
          call_user_func_array([$xcrud, 'highlight_row'], array_merge([$key], $v));
        }
      }

    }

    if (!empty($cols)) {
      $xcrud->columns($cols);
    }
    // if (!empty($flds)) {
    //   $xcrud->fields($flds);
    // }
    // if (!empty($readonly)) {
    //   $xcrud->readonly($readonly);
    // }

    // if (!empty($disabled)) {
    //   $xcrud->disabled($disabled);
    // }

    // $xcrud->limit($grid['list_limit']);

    return $xcrud;
  }
  /**
 * @param array      $array
 * @param int|string $position
 * @param mixed      $insert
 */
  public static function array_insert(&$array, $position, $insert) {
      if (is_int($position)) {
          array_splice($array, $position, 0, $insert);
      } else {
          $pos   = array_search($position, array_keys($array));
          $array = array_merge(
              array_slice($array, 0, $pos),
              $insert,
              array_slice($array, $pos)
          );
      }
  }

  public static function is_assoc($arr) {
    return array_values($arr) === $arr;
  }

  public static function get($var) {
    if (!empty($_GET[$var])) {
      return $_GET[$var];
    }else {
      return false;
    }
  }

  public static function post($var) {
    if (!empty($_POST[$var])) {
      return $_POST[$var];
    }else {
      return false;
    }
  }

  public static function request($var) {
    if (!empty($_REQUEST[$var])) {
      return $_REQUEST[$var];
    }else {
      return false;
    }
  }

  /**
    *
    * Comprova si existeixen els camps a la taula i retorna
    * els que existeixen
    *
    * @param    array   $fields els camps a validar
    * @param    string  $table la taula on es validaran els camps
    * @return   array   Camps validats de la taula
    *
    */
  public static function check_fields($fields, $table, $array_format = 'indexed') {

    if ($clean_fields = self::get_fields($table)) {
      foreach ($clean_fields as $key => $field_info) {

        if ($array_format == 'indexed') {
          if (in_array($field_info->Field, $fields)) {
            unset($fields[array_search($field_info->Field, $fields)]);
          }
        }else{
          if (!isset($fields[$field_info->Field])) {
            unset($fields[$field_info->Field]);
          }
        }

      }

      return $fields;
    }

    return false;

  }

  /**
    *
    * Retorna els camps de la taula especificada
    *
    * @param    string  $table la taula on es validaran els camps
    * @return   array   Camps de la taula
    *
    */
  public static function get_fields($table) {
    $config = [
      'driver'	    => 'mysql',
      'host'		    => _HOST,
      'database'	  => _DB,
      'username'	  => _USER,
      'password'	  => _PASS,
      'charset'	    => 'utf8',
      'collation'	  => 'utf8_general_ci',
      'prefix'	    => ''
    ];

    $dbx = new \Buki\Pdox($config);
    if ( !empty($fields = $dbx->query('DESCRIBE ' . $table)->fetchAll()) ) {
      return $fields;
    }else{
      return false;
    }
  }

  /**
    *
    * Valida un email usando filter_var y comprobar las DNS.
    *  Devuelve true si es correcto o false en caso contrario
    *
    * @param    string  $str la dirección a validar
    * @return   boolean
    *
    */
   public static function is_valid_email($str){
     $result = filter_var($str, FILTER_VALIDATE_EMAIL);
     /*
     if ($result){
       list($user, $domain) = explode('@', $str);
       $result = checkdnsrr($domain, 'MX');
     }
     */
     return $result;
   }

   public static function get_status_header($status_code) {
       $http = array(
           100 => 'HTTP/1.1 100 Continue',
           101 => 'HTTP/1.1 101 Switching Protocols',
           200 => 'HTTP/1.1 200 OK',
           201 => 'HTTP/1.1 201 Created',
           202 => 'HTTP/1.1 202 Accepted',
           203 => 'HTTP/1.1 203 Non-Authoritative Information',
           204 => 'HTTP/1.1 204 No Content',
           205 => 'HTTP/1.1 205 Reset Content',
           206 => 'HTTP/1.1 206 Partial Content',
           300 => 'HTTP/1.1 300 Multiple Choices',
           301 => 'HTTP/1.1 301 Moved Permanently',
           302 => 'HTTP/1.1 302 Found',
           303 => 'HTTP/1.1 303 See Other',
           304 => 'HTTP/1.1 304 Not Modified',
           305 => 'HTTP/1.1 305 Use Proxy',
           307 => 'HTTP/1.1 307 Temporary Redirect',
           400 => 'HTTP/1.1 400 Bad Request',
           401 => 'HTTP/1.1 401 Unauthorized',
           402 => 'HTTP/1.1 402 Payment Required',
           403 => 'HTTP/1.1 403 Forbidden',
           404 => 'HTTP/1.1 404 Not Found',
           405 => 'HTTP/1.1 405 Method Not Allowed',
           406 => 'HTTP/1.1 406 Not Acceptable',
           407 => 'HTTP/1.1 407 Proxy Authentication Required',
           408 => 'HTTP/1.1 408 Request Time-out',
           409 => 'HTTP/1.1 409 Conflict',
           410 => 'HTTP/1.1 410 Gone',
           411 => 'HTTP/1.1 411 Length Required',
           412 => 'HTTP/1.1 412 Precondition Failed',
           413 => 'HTTP/1.1 413 Request Entity Too Large',
           414 => 'HTTP/1.1 414 Request-URI Too Large',
           415 => 'HTTP/1.1 415 Unsupported Media Type',
           416 => 'HTTP/1.1 416 Requested Range Not Satisfiable',
           417 => 'HTTP/1.1 417 Expectation Failed',
           500 => 'HTTP/1.1 500 Internal Server Error',
           501 => 'HTTP/1.1 501 Not Implemented',
           502 => 'HTTP/1.1 502 Bad Gateway',
           503 => 'HTTP/1.1 503 Service Unavailable',
           504 => 'HTTP/1.1 504 Gateway Time-out',
           505 => 'HTTP/1.1 505 HTTP Version Not Supported',
       );

       header($http[$status_code]);
   }

   public static function sendMail($destination_email, $subject, $body, $email_from_text = '', $email_reply_text = '', $email_copy_text = '', $email_copy2_text = '' ) {
     global $conf;
     // Load phpmail libraries
     self::loadPhpMailer();

     //Create a new PHPMailer instance
     $mail = new PHPMailer\PHPMailer\PHPMailer();

     //Tell PHPMailer to use SMTP
     $mail->CharSet = 'UTF-8';
     $mail->isSMTP();

     $mail->SMTPDebug = false;

     //Set the hostname of the mail server
     $mail->Host = $conf['mailservice']['smtp'];
     $mail->Port = $conf['mailservice']['port'];

     //Set the encryption system to use - ssl (deprecated) or tls
     $mail->SMTPSecure = 'tls';

     //Whether to use SMTP authentication
     $mail->SMTPAuth = true;

     //Username to use for SMTP authentication - use full email address for gmail
     $mail->Username = $conf['mailservice']['mailuser'];
     //Password to use for SMTP authentication
     $mail->Password = $conf['mailservice']['mailpass'];

     //Set who the message is to be sent from
     $mail->setFrom($conf['emails']['mailfrom'], $email_from_text);
     //Set an alternative reply-to address
     $mail->addReplyTo($conf['emails']['mailreply'], $email_reply_text);
     //Set who the message is to be sent to
     $mail->addAddress($destination_email);
     $mail->AddCC($conf['emails']['mailcc1'], $email_copy_text);
     $mail->addBcc($conf['emails']['mailcc2'], $email_copy2_text);

     //Set the subject line
     $mail->Subject = $subject;
     $mail->Body = $body;

     $mail->IsHTML(true);
     if (!$mail->send()) {
       return json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
     } else {
         return json_encode(['status' => 'ok', 'message' => 'Mail enviado correctamente']);
     }
  }

  public static function getFullUrl() {
    return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  }

  public static function isManager() {
    $url_parts = parse_url(self::getFullUrl());
    $referrer_parts = parse_url($_SERVER['HTTP_REFERER']);

    $direct_manager = ((!empty($url_parts)) and strpos($url_parts['path'], MANAGER_FOLDER) == 1);
    $referrer_manager = ((!empty($referrer_parts)) and strpos($referrer_parts['path'], MANAGER_FOLDER) == 1);

    return ($direct_manager or $referrer_manager);
  }

  public static function isAdminUser($user_id = false) {
    $id_usuario = ($user_id ? $user_id : $_SESSION['userlogedin']);
    if (!empty($id_usuario)) {
      $user_info = new User($id_usuario);
      if ($user_info->tipo_usuario == USR_TIPO_ADMIN) {
        return true;
      }
    }
    return false;
  }

   // public static function binaryToStringResults($recordset) {
   //   foreach ($recordset as $key => $row) {
   //     foreach ($row as $field => $value) {
   //       if (self::is_binary($value)) {
   //         $recordset[$key]->$field = base64_encode($value);
   //       }
   //     }
   //   }
   //   return $recordset;
   // }
   //
   // public static function is_binary($string):bool {
   //    return preg_match('~[^\x20-\x7E\t\r\n]~', $string) > 0;
   //  }

}

/**
 * PHP UserInfo Class.
 *
 * @author   Malik Umer Farooq <lablnet01@gmail.com>
 * @author-profile https://www.facebook.com/malikumerfarooq01/
 *
 * @license MIT
 *
 * @link    https://github.com/Lablnet/PHP-UserInfo-Class
 */
class UserAgentInfo
{
    /**
     * Get user agente.
     *
     * @return agent
     */
    private static function agent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    /**
     * Get OperatingSystem name.
     *
     * @return void
     */
    public function operatingSystem()
    {
        $UserAgent = self::agent();
        if (preg_match_all('/windows/i', $UserAgent)) {
            $PlatForm = 'Windows';
        } elseif (preg_match_all('/linux/i', $UserAgent)) {
            $PlatForm = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $UserAgent)) {
            $PlatForm = 'Macintosh';
        } elseif (preg_match_all('/Android/i', $UserAgent)) {
            $PlatForm = 'Android';
        } elseif (preg_match_all('/iPhone/i', $UserAgent)) {
            $PlatForm = 'IOS';
        } elseif (preg_match_all('/ubuntu/i', $UserAgent)) {
            $PlatForm = 'Ubuntu';
        } else {
            $PlatForm = 'unknown';
        }
        return $PlatForm;
    }
    /**
     * Get Browser Name.
     *
     * @return void
     */
    public function browser()
    {
        $UserAgent = self::agent();
        if (preg_match_all('/Edge/i', $UserAgent)) {
            $Browser = 'Microsoft Edge';
            $B_Agent = 'Edge';
        } elseif (preg_match_all('/MSIE/i', $UserAgent)) {
            $Browser = 'Microsoft Internet Explorer';
            $B_Agent = 'IE';
        } elseif (preg_match_all('/OPR/i', $UserAgent)) {
            $Browser = 'Opera';
            $B_Agent = 'Opera';
        } elseif (preg_match_all('/Opera/i', $UserAgent)) {
            $Browser = 'Opera';
            $B_Agent = 'Opera';
        } elseif (preg_match_all('/Chrome/i', $UserAgent)) {
            $Browser = 'Google Chrome';
            $B_Agent = 'Chrome';
        } elseif (preg_match_all('/Safari/i', $UserAgent)) {
            $Browser = 'Apple Safari';
            $B_Agent = 'Safari';
        } elseif (preg_match_all('/firefox/i',$UserAgent)) {
            $Browser = 'Mozilla Firefox';
            $B_Agent = 'Firefox';
        } else {
            $Browser = null;
            $B_Agent = null;
        }
        return [
            'browser' => $Browser,
            'agent'   => $B_Agent,
        ];
    }
    /**
     * Get Os version.
     *
     * @return void
     */
    public function oSVersion()
    {
        $UserAgent = self::agent();

        if (preg_match_all('/windows nt 10/i', $UserAgent)) {
            $OsVersion = 'Windows 10';
        } elseif (preg_match_all('/windows nt 6.3/i', $UserAgent)) {
            $OsVersion = 'Windows 8.1';
        } elseif (preg_match_all('/windows nt 6.2/i', $UserAgent)) {
            $OsVersion = 'Windows 8';
        } elseif (preg_match_all('/windows nt 6.1/i', $UserAgent)) {
            $OsVersion = 'Windows 7';
        } elseif (preg_match_all('/windows nt 6.0/i', $UserAgent)) {
            $OsVersion = 'Windows Vista';
        } elseif (preg_match_all('/windows nt 5.1/i', $UserAgent)) {
            $OsVersion = 'Windows Xp';
        } elseif (preg_match_all('/windows xp/i', $UserAgent)) {
            $OsVersion = 'Windows Xp';
        } elseif (preg_match_all('/windows me/i', $UserAgent)) {
            $OsVersion = 'Windows Me';
        } elseif (preg_match_all('/win98/i', $UserAgent)) {
            $OsVersion = 'Windows 98';
        } elseif (preg_match_all('/win95/i', $UserAgent)) {
            $OsVersion = 'Windows 95';
        } elseif (preg_match_all('/Windows Phone +[0-9]/i', $UserAgent, $match)) {
            $OsVersion = $match;
        } elseif (preg_match_all('/Android +[0-9]/i', $UserAgent, $match)) {
            $OsVersion = $match;
        } elseif(preg_match_all('/Linux +x[0-9]+/i', $UserAgent, $match)) {
            $OsVersion = $match;
        } elseif(preg_match_all('/ +[0-9][0-9]_[0-9]_[0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        } elseif(preg_match_all('/ +[0-9]_[0-9]_[0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        } elseif(preg_match_all('/ +[0-9][0-9]_[0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        } elseif(preg_match_all('/ +[0-9][0-9].[0-9][0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        } elseif(preg_match_all('/ +[0-9][0-9].[0-9][0-9].[0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        } elseif(preg_match_all('/ +[0-9][0-9].[0-9][0-9].[0-9][0-9]+/i', $UserAgent, $match)) {
            $OsVersion = trim($match[0][0]);
        }

        return $OsVersion;
    }
    /**
     * Get Browser version.
     *
     * @return void
     */
    public function browserVersion()
    {
        $UserAgent = self::agent();
        $B_Agent = self::Browser()['agent'];
        if ($B_Agent !== null) {
            $known = ['Version', $B_Agent, 'other'];
            $pattern = '#(?<browser>'.implode('|', $known).
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $UserAgent, $matches)) {
            }
            $i = count($matches['browser']);
            if ($i != 1) {
                if (strripos($UserAgent, 'Version') < strripos($UserAgent, $B_Agent)) {
                    $Version = $matches['version'][0];
                } else {
                    $Version = $matches['version'][0];
                }
            } else {
                $Version = $matches['version'][0];
            }
        }
        return $Version;
    }
    /**
     * Get The user ip.
     *
     * @return void
     */
    public function ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_add = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['        HTTP_X_FORWADED_FOR'])) {
            $ip_add = $_SERVER['HTTP_X_FORWADED_FOR'];
        } else {
            $ip_add = $_SERVER['REMOTE_ADDR'];
        }
        return $ip_add;
    }
    /**
     * Check user from mobile or not.
     *
     * @return void
     */
    public function isMobile()
    {
        $agent = self::agent();
        return (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $agent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($agent, 0, 4))) ? true : false;
    }
}
?>
