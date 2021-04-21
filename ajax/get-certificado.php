<?php
include '../cms/core.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if (Tools::get('curso') and Tools::get('usuario')) {

  $cursom = new CursosModel();

  // If the call comes from intranet (formacion.aulamayo.com)
  if (filter_var(Tools::get('usuario'), FILTER_VALIDATE_EMAIL)) {
    // We get user id
    $usrmod = new UsuariosModel();
    $user = $usrmod->getUsuarios(['filter' => ['email' => Tools::get('usuario')]]);
    $_GET['usuario'] = $user[0]->id_usuario;

    // We get course id of Moodle
    $coursemod = new CursosModel();
    $curso = $coursemod->getCursos(['filter' => ['id_moodle' => Tools::get('curso')]]);
    $_GET['curso'] = $curso[0]->id_curso;

    // Check if certificate is allow (the user was passed the course)
    if (Tools::get('checkallowcert')) {
        $btn_curso = $cursom->allowCertificate((!empty($_GET['curso']) ? $_GET['curso'] : 0), (!empty($_GET['usuario']) ? $_GET['usuario']  : 0));
        if (!$btn_curso) {
          echo false; exit;
        }
        echo true; exit;
    }
  }

  // This make the certificate
  if ( $cert_path = $cursom->getCertificado(Tools::get('usuario'), Tools::get('curso'), 'path') ) {
    header("Content-type:application/pdf");
    header("Content-Disposition:attachment;filename=certificado_" . Tools::get('curso') . Tools::get('usuario') . "_.pdf");
    readfile($cert_path);
    exit;
  }else{
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == 'cgi')
        header("Status: 404 Not Found");
    else
        header("HTTP/1.1 404 Not Found");

    echo json_encode(['error' => true,
                      'message' => 'Ha habido un error al generar el certificado. Es posible que el curso no tenga asociada una plantilla o que se haya producido un error de otro tipo.'
                      ]);
  }
}else{
  $sapi_type = php_sapi_name();
  if (substr($sapi_type, 0, 3) == 'cgi')
      header("Status: 404 Not Found");
  else
      header("HTTP/1.1 404 Not Found");

  echo json_encode(['error' => true,
                    'message' => 'Faltan parámetros'
                      ]);
}

 ?>
