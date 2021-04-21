<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';

    function sendHttpRequest($host, $path, $query, $port=80){
      header("POST $path HTTP/1.1\r\n" );
      header("Host: $host\r\n" );
      header("Content-type: application/x-www-form-urlencoded\r\n" );
      header("Content-length: " . strlen($query) . "\r\n" );
      header("Connection: close\r\n\r\n" );
      header($query);
    }


    function redirect_post($url, array $data, array $headers = null) {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        if (!is_null($headers)) {
            $params['http']['header'] = '';
            foreach ($headers as $k => $v) {
                $params['http']['header'] .= "$k: $v\n";
            }
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if ($fp) {
            echo @stream_get_contents($fp);
            die();
        } else {
            // Error
            throw new Exception("Error loading '$url', $php_errormsg");
        }
    }



    $host = 'https://www.jquery-az.com';
    $path = '/bootstrap-margin-padding-classes-spacing-explained-5-examples';
    $query = urlencode('username=tal&pass=qual');
    $data = ['user' => 'Tal', 'pass' => 'Qual'];
    // sendHttpRequest($host, $path, $query);
    redirect_post($host . $path, $data);

    // var_dump(check_fields(['id_curso', 'xxx', 'nombre'], 'cursos')); exit;

    // $cursos = new CursosModel();
    // var_dump($cursos->getCursos([ 'filter' => ['id_categoria' => 1, 'fecha_inicio' => ['>', '2020-03-01']],
    //                               'pagination' => [10, 2],
    //                               'order' => ['cursos.id_curso', 'DESC']
    //                             ]));

    // id_contacto	int(11) Increment automàtic
    // nombre	varchar(150)
    // apellidos	varchar(150)
    // email	varchar(150)
    // id_curso	int(5)
    // texto	text
    // fecha


    // $contacto = new ContactoModel();
    // $contacto->saveContacto(['nombre' => 'Jordi', 'apellidos' => 'Juvillà Posé', 'email' => 'jjuvilla@edicionesmayo.es', 'id_curso' => 103,
    //                         'texto'  => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
    //                         'fecha' => date('Y-m-d H:i:s')])
?>
