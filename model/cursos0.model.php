<?php

defined('_DA') or exit('Restricted Access');

/**
 *
 */
class CursosModel {

    public $dbx;
    public $main_table = 'cursos';
    public $primary_key = 'id_curso';

    public function __construct() {
        $config = [
            'driver' => 'mysql',
            'host' => _HOST,
            'database' => _DB,
            'username' => _USER,
            'password' => _PASS,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => ''
        ];
        $this->dbx = new \Buki\Pdox($config);
    }

    /**
     * Get a list of cursos from cursos and cursos_extend tables with filters, order and pagination
     *
     * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
     *
     * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
     */
    public function getCursos($params = []) {
        // var_dump(array_column(Tools::get_fields('cursos'), 'Field')); exit;
        $this->dbx->table('cursos')
                ->select(preg_filter('/^/', 'cursos.', array_diff(array_column(Tools::get_fields('cursos'), 'Field'), ['moodle_pass'])))
                ->select(preg_filter('/^/', 'cursos_extend.', array_column(Tools::get_fields('cursos_extend'), 'Field')))
                ->leftJoin('cursos_extend', 'cursos.id_curso', 'cursos_extend.id_curso');

        $this->dbx->attachFilters($params);
        $this->dbx->attachOrder($params);
        $this->dbx->attachPagination($params);

        //$this->dbx->getAll();
        //echo "query: ".$this->dbx->getQuery()."<br>"; //exit();
        return $this->dbx->getAll();
    }

    public function getNombreEntidadAcreditadoraCurso($id_entidad) {
        $this->dbx->table('entidades_acreditadoras');
        $this->dbx->where(['id_entidad' => $id_entidad]);

        return $this->dbx->getAll();
    }

    /**
     * Return the user courses if exists
     * @param  array  $params -> Format: ['filter' => ['field_name' => value, 'field_name2' => ['>', 3]], 'order' => 'order_field ASC', 'pagination' => [10, 1]]
     * @return array  Array of objects representing the user's courses
     */
    public function getCursosUsuario($params = []) {
        $this->dbx->table('matriculas')
                ->leftJoin('cursos', 'cursos.id_curso', 'matriculas.id_curso')
                ->leftJoin('cursos_extend', 'matriculas.id_curso', 'cursos_extend.id_curso');

        $this->dbx->attachFilters($params);
        $this->dbx->attachOrder($params);
        $this->dbx->attachPagination($params);

        return $this->dbx->getAll();
    }

    /**
     * Insert a course into cursos
     * @param  Associative array $fields_values array of fields and values to insert. Format: ['field_name' => [value], 'field_name2' => [value]]
     * @return  Return the iserted row id or false if error
     */
    public function insertCurso($fields_values) {
        $this->dbx->table($this->main_table);
        $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
        return $this->dbx->insert($fields);
    }

    /**
     * Update cursos $fields
     * @param  associative array $fields_values -> Format: ['field_name' => [value], 'field_name2' => [value]]
     * @param  string / number $key_value    Value of primary key of usuario to update
     * @return [type]                [description]
     */
    public function updateCurso($fields_values, $key_value) {
        $this->dbx->table($this->main_table);
        $fields = Tools::check_fields($fields_values, $this->main_table, 'associative');
        $this->dbx->where($this->primary_key, $key_value);
        return $this->dbx->update($fields);
    }

    /**
     * Make a search from cursos and cursos_extend tables in textual way
     *
     * @param  array  $strins -> string to search
     *
     * @return Multidimensional array -> Example: [stdObject ['id' => 2, 'name' => 'xxx'], stdObject ['id' => 10, 'name' => 'yyy']]
     */
    public function searchCursos($string, $canal = false) {
        $search_fields = ['c.nombre', 'c.director', 'c.dirigido_a', 'c.patrocinado_por', 'ce.descripcion', 'ce.objetivos', 'ce.programa', 'ce.docentes', 'ce.evaluacion', 'ce.creditos_text'];
        $this->dbx->table('cursos c')->leftJoin('cursos_extend ce', 'c.id_curso', 'ce.id_curso')
                ->grouped(function($q) use ($search_fields, $string, $canal) {

                    foreach ($search_fields as $key => $field) {
                        if ($key == 1) {
                            $q->like($field, '%' . $string);
                        } else {
                            $q->orLike($field, '%' . $string);
                        }
                        $q->orLike($field, '%' . $string . '%');
                        $q->orLike($field, $string . '%');
                    }
                })
                ->where(['c.activo' => '1']);

        if ($canal) {
            $this->dbx->where(['id_categoria' => $canal]);
        }

        return $this->dbx->getAll();
    }

    /**
     * Return the id of canal/categoria from url id
     * @param  string $url_id The url id
     * @return numeric db id of canal/categoria
     */
    public function getCanalId($url_id) {
        return $this->dbx->select('id_categoria')->table('categorias')->where(['url_id' => $url_id])->get();
    }

    /**
     * Retorna los datos de acceso al curso de Moodle para un curso y usuario dados
     * @param  [numeric] $id_curso   [Id del curso al que se accede]
     * @param  [numeric] $id_usuario [id del usuario del que se enviaran las credenciales de acceso a moodle]
     * @param  [string] $format [Format of the params. Possible values: 'form, url, json']
     * @return [object]              [objecto con los parametros para la url]
     */
    public function getMoodleAccessCourseParams($id_curso, $id_usuario, $format = 'form') {
        $this->dbx->select('u.email as username, aes_decrypt(c.moodle_pass, "lzyWGKfXak") as password, c.id_moodle as curso, c.id_moodle as id')
                ->table('matriculas m')
                ->leftJoin('cursos c', 'm.id_curso', 'c.id_curso')
                ->leftJoin('usuarios u', 'm.id_usuario', 'u.id_usuario')
                ->where(['m.id_curso' => $id_curso, 'm.id_usuario' => $id_usuario]);

        $params = $this->dbx->get();
        $output = false;

        switch ($format) {
            case 'form':

                $curs = $this->getCursos(['filter' => ['cursos.id_curso' => $id_curso]]);
                //echo "<pre>"; var_dump($curs); echo "</pre>"; exit();

                if ($external_course = $this->externalCourse($id_curso)) {
                    $output = '<form action="' . $this->getMoodleUrlAccessCourse($id_curso) . '" method="POST" id="' . $id_usuario . '_' . $id_curso . '" target="_blank">';
                    $output .= '<button type="submit" class="btn btn-info" href="#"><span class="text-white">Ir al curso</span></button>';
                    $output .= '</form>';
                    break;
                }

                if (!isset($_SESSION['userlogedin']) && !strpos($_SERVER["REQUEST_URI"], 'ficha-curso')) {
                    $button = '<button  type="button" class="btn btn-outline-dark" style="visibility:hidden" ><span href="#" class="">&nbsp;&nbsp;</span></button>';
                } else {
                    $button = '<button type="button" class="btn btn-info" href="#" onclick="goLogin(); return false;"><span class="text-white">Inscríbase</span></button>';
                    if (!empty($id_curso) and in_array($id_curso, array_column($this->getCursosUsuario(['filter' => ['id_usuario' => $id_usuario]]), 'id_curso'))) {
                        $button = '<button type="submit" class="btn btn-info" href="#"><span class="text-white">Acceder al curso</span></button>';
                    } else {
                        if (isset($_SESSION['userlogedin'])) {
                            $button = '<button id="btn_userlogedin" type="button" class="btn btn-info" data-idcurso="' . $id_curso . '" onclick="getTexosLegales(' . $id_curso . ',' . $id_usuario . ',\'' . $curs[0]->nombre . '\')" ><span class="text-white">Inscríbase</span></button>';
                        }
                    }
                }

                //Check if course is closed
                $fecha_actual = strtotime(date("Y-m-d"));
                $timestamp_fecha_fin = strtotime($curs[0]->fecha_fin);
                $curso_cerrado = false;
                if ($timestamp_fecha_fin < $fecha_actual) {
                    $curso_cerrado = true;
                }
                //if( $curso_cerrado && strpos($_SERVER["REQUEST_URI"], 'ficha-curso') ){
                if ($curso_cerrado) {
                    $button = '<button id="btn_cerrado" type="button" class="btn btn-outline-dark" disabled ><span href="#" class="">Curso cerrado</span></button>';
                }

                $output = '<form action="' . $this->getMoodleUrlAccessCourse($id_curso) . '" method="POST" id="' . $id_usuario . '_' . $id_curso . '" target="_blank">';
                $output .= '<input name="username" type="hidden" id="username" value="' . (!empty($params->username) ? $params->username : 0) . '">';
                $output .= '<input name="password" type="hidden" id="password" value="' . (!empty($params->password) ? $params->password : 0) . '">';
                $output .= '<input name="curso" type="hidden" id="curso" value="' . (!empty($params->curso) ? $params->curso : 0) . '">';
                $output .= '<input name="id" type="hidden" id="id" value="' . (!empty($params->id) ? $params->id : 0) . '">';
                $output .= $button;
                $output .= '</form>';
                break;
            case 'url':
                $output = http_build_query($params);
                break;
            case 'json':
                $output = json_encode($params);
                break;
        }

        return $output;
    }

    public function getMoodleAccessCourseButton($id_curso, $id_usuario) {
        return $this->getMoodleAccessCourseParams($id_curso, $id_usuario, 'form');
    }

    public function getMoodleUrlAccessCourse($id_curso = false) {
        if (!$url_external = $this->externalCourse($id_curso)) {
            $return = MOODLE_URL_ACCES_COURSE;
        } else {
            $return = $url_external;
        }
        return $return;
    }

    public function externalCourse($id_curso) {
        if (empty($url = $this->dbx->table('cursos')->select('url_curso_externo')->where(['id_curso' => $id_curso])->get()->url_curso_externo)) {
            $return = false;
        } else {
            $return = $url;
        }
        return $return;
    }

    /**
     * Get the url or path of the certificate for a user and course. If not exist, first,
     * the certificate is constructed. For make the certificate, previously, is checked
     * if the user as aproved the course on Moodel.
     *
     * @param  numeric  $id_usuario -> The user id
     * @param  numeric  $id_curso  -> The course id
     * @param  string   $format    -> The format of $location. Values: path | url
     *
     * @return string   The location of certificate in the $format especified
     */
    public function getCertificado($id_usuario, $id_curso, $format) {
        global $conf;

        $background = $this->dbx->table('cursos')->select('plantilla_certificado')->where(['id_curso' => $id_curso])->get()->plantilla_certificado;

        if (empty($background)) {
            return false;
        }

        $path = $conf['appinfo']['approot'] . 'public/uploads/certificados/certificado_' . $id_usuario . '_' . $id_curso . '.pdf';
        if ($format == 'path') {
            $location = $path;
        } else {
            $location = $conf['appinfo']['appfolder'] . 'public/uploads/certificados/certificado_' . $id_usuario . '_' . $id_curso . '.pdf';
            ;
        }

        if (!file_exists($path)) {
            if (!self::makeCertificado($id_usuario, $id_curso, $path)) {
                return false;
            } else {
                $first_date_generation = '';
                $csv_code = Tools::myEncrypt($dni . $id_curso . date('%Y-%m-%d %h:%m:%i'));
            }
        }

        return $location;
    }

    /**
     * Construct the certificate and put them in a especific folder in the format :  certificado_[id_usuario]_[id_curso].pdf
     * @param  numeric  $id_usuario [description]
     * @param  numeric $id_curso   [description]
     * @param  string $path       Path to store the certificate
     * @return boolean     true/false if the certificate is made or not.
     */
     public function makeCertificado($id_usuario, $id_curso, $path) {
         global $conf;

         $curso    = $this->dbx->table('cursos')->where(['id_curso' => $id_curso])->get();
         $usuario  = $this->dbx->table('usuarios')->where(['id_usuario' => $id_usuario])->get();

         $p['p']['x'] = 10;
         $p['p']['y'] = 40;

         Tools::loadInclude('pdf/fpdf', 'fpdf');

         $pdf = new FPDF();

         // Plana 1
         $pdf->AddPage();
         $pdf->SetSubject('Centros de excelencia en urticaria');
         $pdf->SetTitle('Certificado del curso');
         $pdf->SetCreator('Ediciones Mayo S.A.');
         $pdf->SetAuthor('Ediciones Mayo S.A.');
         $pdf->Image($conf['appinfo']['approot'] . 'public/uploads/certificados/backgrounds/' . $curso->plantilla_certificado, 0, 0, 0, 0);
         $pdf->SetFont('Helvetica');

         $this->fpdfTextWriter($pdf,
                       $usuario->nombre . ' ' . $usuario->apellido_1 . ' ' . $usuario->apellido_2,
                       ['w' => 200, 'h' => 0, 'align' => 'L'],
                       ['x' => $p['p']['x'] + 30, 'y' => $p['p']['y'] + 68],
                       ['Helvetica', '', 12],
                       ['front' => [0, 0, 0], 'back' => [255, 255, 255]]
                     );

        setlocale(LC_ALL,"es_ES");

         $this->fpdfTextWriter($pdf,
                       strftime("%A %d de %B del %Y"),
                       ['w' => 200, 'h' => 0, 'align' => 'L'],
                       ['x' => $p['p']['x'] + 117, 'y' => $p['p']['y'] + 198],
                       ['Helvetica', '', 12],
                       ['front' => [0, 0, 0], 'back' => [255, 255, 255]]
                     );

         // Plana 2
         $pdf->AddPage();
         $pdf->Image($conf['appinfo']['approot'] . 'public/uploads/certificados/backgrounds/' . $curso->plantilla_certificado_2, 0, 0, 0, 0);


          $this->fpdfTextWriter($pdf,
                        $usuario->nombre . ' ' . $usuario->apellido_1 . ' ' . $usuario->apellido_2,
                        ['w' => 200, 'h' => 0, 'align' => 'L'],
                        ['x' => $p['p']['x'] + 28, 'y' => $p['p']['y'] + 55],
                        ['Helvetica', '', 12],
                        ['front' => [0, 0, 0], 'back' => [255, 255, 255]]
                      );


         $pdf->Output('F', $path);

         return file_exists($path);
     }

     public function fpdfTextWriter( &$fpdf, $text, $box, $pos, $font = ['Helvetica', 'BI', 24], $colors = ['front' => [0,0,0], 'back' => [255, 255, 255]] ) {

       if (($args = func_num_args() == 6) or $args == 4) {

         $fpdf->SetXY($pos['x'], $pos['y']);

         call_user_func_array([$fpdf, 'SetTextColor'], $colors['front']);
         call_user_func_array([$fpdf, 'SetFillColor'], $colors['back']);

         call_user_func_array([$fpdf, 'SetFont'], $font);

         $fpdf->Cell($box['w'], $box['h'], $text, 0, 0, $box['align']);

         return true;

       }

       return false;
     }

}

?>
