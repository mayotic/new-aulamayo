<?php
defined('_DA') or exit('Restricted Access');
// include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

// Config for app
// $appconf = Tools::loadInclude('', 'appconf');

// Tools::loadPdox();
// Tools::loadPhpMailer();

class App {
  // static $dba;
  static $dbx;
  public static function init() {
    // self::$dba = new Medoo([
    //                   'database_type'  => 'mysql',
    //                   'database_name'  => _DB,
    //                   'server'         => _HOST,
    //                   'username'       => _USER,
    //                   'password'       => _PASS,
    //                   'charset'        => 'utf8',
    //                   'collation'      => 'utf8_general_ci'
    //                 ]);

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
                    self::$dbx = new \Buki\Pdox($config);
  }
  public static function getUserTipe($user_id) {
    global $conf;
    return (int)self::$dbx
                ->query( "SELECT id_tipo_usuario FROM usuarios WHERE id_usuario = $user_id")
                ->fetch('array')['id_tipo_usuario'];
  }
  public static function getUserTypeName($user_id) {
    global $conf;
    return self::$dbx
                ->query( "SELECT tipos_usuario.nombre FROM usuarios JOIN tipos_usuario ON usuarios.id_tipo_usuario = tipos_usuario.id_tipo_usuario WHERE id_usuario = $user_id" )
                ->fetch('array')['nombre'];

  }

  public static function usuariosBeforeInsert($postdata, $xcrud) {
    $postdata->set('pass', Tools::myEncrypt($postdata->get('pass')));
  }
  public static function usuariosBeforeUpdate($postdata, $xcrud) {
    $postdata->set('pass', Tools::myEncrypt($postdata->get('pass')));
  }
  // Before update and insert courses callbacks
  public static function cursosBeforeInsert($postdata, $xcrud) {
    $postdata->set('moodle_pass', Tools::aesEncrypt($postdata->get('moodle_pass')));
    $postdata->set('creditos', str_replace(',', '.', $postdata->get('creditos')));
  }
  public static function cursosBeforeUpdate($postdata, $xcrud) {
    $postdata->set('moodle_pass', Tools::aesEncrypt($postdata->get('moodle_pass')));
    $postdata->set('creditos', str_replace(',', '.', $postdata->get('creditos')));
  }
  // Arrange out of fields before show in edit mode
  public static function arrangeCoursefields($value, $field, $priimary_key, $list, $xcrud) {
    switch ($field) {
      case 'cursos.creditos':
      return '<input class="xcrud-input form-control" type="text" data-type="float" value="' . str_replace('.', ',', $value) . '"
      name="' . $xcrud->fieldname_encode($field)   . '" data-pattern="numeric"
      details_row="form-group col-md-6" details_field_cell="col-sm-4" maxlength="8">';
        break;

      default:
        // code...
        break;
    }
  }
  // Before usuarios show create dialog
  public static function usuariosBeforeShowCreateDialog($row_data, $xcrud) {
    $row_data->set('pass', Tools::myDecrypt($row_data->get('pass')));
  }
  public static function toggleUsuario($xcrud) {
    $row = self::$dbx->select('activo')->table('usuarios')->where('id_usuario', $xcrud->get('primary'))->get();
    self::$dbx->table('usuarios')->where('id_usuario', $xcrud->get('primary'))->update(['activo' => ($row->activo == 1 ? 0 : 1)]);
  }
  public static function toggleCurso($xcrud) {
    $row = self::$dbx->select('activo')->table('cursos')->where('id_curso', $xcrud->get('primary'))->get();
    self::$dbx->table('cursos')->where('id_curso', $xcrud->get('primary'))->update(['activo' => ($row->activo == 1 ? 0 : 1)]);
  }
  public static function changePass($id, $newpass) {
      return self::$dbx->table('usuarios')->where('id_usuario', $id)->update(['pass' => Tools::myEncrypt($newpass)]);
  }
  public static function getPass($id) {
      return self::$dbx->table('usuarios')->select('pass')->where('email', $id)->get()->pass;
  }
  public static function passDecrypt($value, $field, $priimary_key, $list, $xcrud) {
      $field_attr = Tools::getProtectedValue($xcrud, 'field_attr');
      $maxlength = $field_attr[$field]['maxlength'] ? $field_attr[$field]['maxlength'] : '';
      return '<input type="text" name="'.$xcrud->fieldname_encode($field).'" value="' . Tools::myDecrypt($value) . '" class="xcrud-input form-control" maxlength="' . $maxlength . '"/>';
  }

  public static function aesDecrypt($value, $field, $priimary_key, $list, $xcrud) {
      $field_attr = Tools::getProtectedValue($xcrud, 'field_attr');
      $validation_required = Tools::getProtectedValue($xcrud, 'validation_required')['cursos.moodle_pass'];
      $attrs = '';
      foreach ($field_attr[$field] as $key => $value) {
        $attrs .= ' ' . $key . '="' . $value . '"';
      }
      return '<input type="text" name="'.$xcrud->fieldname_encode($field).'" value="' . Tools::aesDecrypt($value) . '" data-required=' . $validation_required . ' class="xcrud-input form-control" ' . $attrs . '/>';
  }

  public static function sendMailAfterRegUser($user_id) {
    $user = new UsuariosModel();
    $user_info = $user->getUsuarios(['filter' => ['id_usuario' => $user_id]]);
    if (!empty($user_info[0])) {
      $body = 'Bienvenido a Aula MAYO, <br/>
                le adjuntamos su usuario y contraseña para acceder a
                https://aulamayo.com
                <br/>
                <br/>
                Usuario: ' . $user_info[0]->email . '<br/>
                Contraseña: ' . Tools::myDecrypt($user_info[0]->pass) . '<br><br><br>
                Secretaria Aula Mayo: secretaria@aulamayo.com';
      Tools::sendMail($user_info[0]->email, 'Bienvenido a Aula Mayo', $body);
    }

    return false;
  }

  public static function reformatMultiSelectView ($value, $fieldname, $primary_key, $row, $xcrud) {
    $pvalue = explode(',', $value);
    $output = '<ul class="list-group">';
    foreach ($pvalue as $key => $sesion_evento) {
      $evento_info = self::getSessionEvent($sesion_evento);
      $evento = explode(' • ', $evento_info['nombre']);
      $output .= '<li class="list-group-item">';
      $output .= '<b>' . (isset($evento[0]) ? $evento[0] : '') . '</b><br/>';
      $output .= '<span class="descripcion">' . (isset($evento[1]) ? $evento[1] : '') . '</span><br/>';
      $output .= '<span class="descripcion">' . (isset($evento[2]) ? $evento[2] : '') . '</span><br/>';
      $output .= '<span class="autores">' . (isset($evento[3]) ? $evento[3] : '') . '</span><br/>';
      $output .= '<b>Inicio</b>: ' . date_format(date_create($evento_info['dia_inicio']), 'd/m/Y') . ' a las ' . date_format(date_create($evento_info['hora_inicio']), 'H:i');
      $output .= '<br/><b>Fin</b>: ' . date_format(date_create($evento_info['dia_fin']), 'd/m/Y') . ' a las ' . date_format(date_create($evento_info['hora_fin']), 'H:i');
      $output .= '</li>';
    }
    return $output .= '</ul>';
  }

}

App::init();
