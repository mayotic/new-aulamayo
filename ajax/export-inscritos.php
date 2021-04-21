<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $conf, $appconf;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = new Medoo([
                    'database_type'  => 'mysql',
                    'database_name'  => _DB,
                    'server'         => _HOST,
                    'username'       => _USER,
                    'password'       => _PASS,
                    'charset'        => 'utf8',
                    'collation'      => 'utf8_general_ci',
                  ]);

// $inscrito = (isset($_REQUEST['id']) ? " WHERE inscrito_sesion.id_inscrito = " . $_REQUEST['id'] : '');
$inscritos = $con->query("select
(select nombre from tipos_inscrito where tipos_inscrito.id_tipo_inscrito = inscritos.id_tipo_inscrito) as 'En calidad de',

(select (select concat(usu2.nombre, ' ', usu2.apellido_1, ' ', ifnull(usu2.apellido_2, '')) from usuarios as usu2 where usu2.id_inscrito = usu1.id_gerente) from usuarios as usu1 where usu1.id_inscrito = inscritos.id_gerente) as 'Gerente',

(select (select email from usuarios as usu2 where usu2.id_inscrito = usu1.id_gerente) from usuarios as usu1 where usu1.id_inscrito = inscritos.id_gerente) as 'Email gerente',

(select concat(nombre, ' ', apellido_1, ' ', ifnull(apellido_2, '')) from usuarios where usuarios.id_inscrito = inscritos.id_gerente) as Delegado,

(select email from usuarios where usuarios.id_inscrito = inscritos.id_gerente) as 'Email delegado',

nombre as 'Nombre asistente',

concat(apellido_1, ' ', ifnull(apellido_2, '')) as 'Apellidos asistente',

email as 'Email asistente',

ifnull(dni, '') as 'DNI',

direccion_fiscal as 'Dirección fiscal',

telefono as 'Teléfono',

(select nombre from especialidades where especialidades.id_especialidad = inscritos.id_especialidad) as Especialidad,

(select nombre from centros_trabajo where centros_trabajo.id_centro_trabajo = inscritos.id_centro_trabajo) as Centro,

(select nombre from paises where paises.id_pais = inscritos.id_pais) as Pais,

(select nombre from comunidades where comunidades.id_comunidad = inscritos.id_comunidad) as Comunidad,

(select nombre from localidades where localidades.id_localidad = inscritos.id_localidad) as Localidad,

comentarios as 'Comentarios',



(select view_transportes_ida.fecha from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: fecha salida',

trayecto_ida as 'Ida: trayecto',

(select view_transportes_ida.terminal_llegada from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: terminal llegada',

(select view_transportes_ida.referencia from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: medio',

(select REPLACE(view_transportes_ida.hora1, 'Salida:', '') from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: hora salida',

(select REPLACE(view_transportes_ida.hora2, 'Llegada:', '') from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: hora llegada',




(select view_transportes_vuelta.fecha from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: fecha salida',

(select view_transportes_vuelta.terminal_salida from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: terminal salida',

trayecto_vuelta as 'Vuelta: trayecto',

(select view_transportes_vuelta.referencia from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_vuelta) as 'Vuelta: medio',

(select REPLACE(view_transportes_vuelta.hora1, 'Salida:', '') from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: hora salida',

(select REPLACE(view_transportes_vuelta.hora2, 'Llegada:', '') from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: hora llegada',



(select nombre from acuerdos where acuerdos.id_acuerdo = inscritos.id_acuerdo) as Acuerdo,

(select nombre from derechos where derechos.id_derecho = inscritos.id_derecho) as Derechos,

(SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',alojamiento.nombre) SEPARATOR ' • ')
FROM alojamiento
LEFT JOIN inscrito_alojamiento ON inscrito_alojamiento.id_alojamiento = alojamiento.id_alojamiento
WHERE inscrito_alojamiento.id_inscrito = inscritos.id_inscrito AND 1) as Alojamientos,

(SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',servicios.nombre) SEPARATOR ' • ')
FROM servicios
LEFT JOIN inscrito_servicio ON inscrito_servicio.id_servicio = servicios.id_servicio
WHERE inscrito_servicio.id_inscrito = inscritos.id_inscrito AND 1) as Servicios,

(SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',view_sesion_evento.id_sesion) SEPARATOR ' • ')
FROM view_sesion_evento
LEFT JOIN inscrito_sesion ON inscrito_sesion.id_sesion = view_sesion_evento.id_sesion
WHERE inscrito_sesion.id_inscrito = inscritos.id_inscrito AND 1) as Eventos

from inscritos" . (isset($_GET['delegado']) ? ' WHERE id_gerente = ' . $_GET['delegado'] : ''));

$alojamientos = $con->query('SELECT * FROM alojamiento')->fetchAll(PDO::FETCH_ASSOC);
$servicios    = $con->query('SELECT * FROM servicios')->fetchAll(PDO::FETCH_ASSOC);
$eventos      = $con->query('SELECT * FROM view_sesion_evento')->fetchAll(PDO::FETCH_ASSOC);

$header = ['En calidad de',

'Gerente',

'Email gerente',

'Delegado',

'Email delegado',

'Nombre asistente',

'Apellidos asistente',

'Email asistente',

'DNI',

'Dirección fiscal',

'Teléfono',

'Especialidad',

'Centro',

'Pais',

'Comunidad',

'Localidad',

'Comentarios',



'Ida: fecha salida',

'Ida: trayecto',

'Ida: terminal llegada',

'Ida: medio',

'Ida: hora salida',

'Ida: hora llegada',



'Vuelta: fecha salida',

'Vuelta: terminal salida',

'Vuelta: trayecto',

'Vuelta: medio',

'Vuelta: hora salida',

'Vuelta: hora llegada',


'Acuerdo',

'Derechos'
];

foreach ($alojamientos as $key => $value) {
  $header[] = $value['nombre'];
}
foreach ($servicios as $key => $value) {
  $header[] = $value['nombre'];
}
foreach ($eventos as $key => $value) {
  $header[] = $value['identificador'] . ' del ' . date_format(date_create($value['dia_inicio']), 'd/m/Y') . ' a las ' . $value['hora_inicio'] . ' al '  . date_format(date_create($value['dia_fin']), 'd/m/Y') . ' a las ' . $value['hora_fin'];
}

$list = array ();
$filename = 'inscritos.csv';
 // Append results to array
 array_push($list, $header);
 $realrow = [];
 while ($row = $inscritos->fetch(PDO::FETCH_ASSOC)) {
   foreach ($row as $key => $value) {
     switch ($key) {
       case 'Alojamientos':
         foreach ($alojamientos as $key => $aloja) {
           if (in_array($aloja['nombre'], explode(' • ', $value))) {
             $realrow[] = mb_convert_encoding('1', 'UTF-8');
           }else{
             $realrow[] = mb_convert_encoding('0', 'UTF-8');
           }
         }
         break;
       case 'Servicios':
         foreach ($servicios as $key => $serv) {
           if (in_array($serv['nombre'], explode(' • ', $value))) {
             $realrow[] = mb_convert_encoding('1', 'UTF-8');
           }else{
             $realrow[] = mb_convert_encoding('0', 'UTF-8');
           }
         }
         break;
       case 'Eventos':
         foreach ($eventos as $key => $event) {
           if (in_array($event['id_sesion'], explode(' • ', $value))) {
             $realrow[] = mb_convert_encoding('1', 'UTF-8');
           }else{
             $realrow[] = mb_convert_encoding('0', 'UTF-8');
           }
         }
         break;
       case 'Comentarios':
         $realrow[] = mb_convert_encoding(strip_tags($value), 'UTF-8');
         break;
       default:
         $realrow[] = mb_convert_encoding($value, 'UTF-8');
         break;
     }

   }
   array_push($list, array_values($realrow));
   $realrow = [];
 }
 // var_dump($list); exit;
 // Output array into CSV file
 $fp = fopen('php://output', 'w');
 // Fix extrange chars in accents for excel
 fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

 header('Content-Type: text/csv;charset=utf-8');
 header('Content-Disposition: attachment; filename="'.$filename.'"');
 foreach ($list as $ferow) {
     fputcsv($fp, $ferow, ';');
 }
 exit;



// ' select
//  (select nombre from tipos_inscrito where tipos_inscrito.id_tipo_inscrito = inscritos.id_tipo_inscrito) as 'En calidad de',
//
//  (select (select concat(usu2.nombre, ' ', usu2.apellido_1, ' ', ifnull(usu2.apellido_2, '')) from usuarios as usu2 where usu2.id_inscrito = usu1.id_gerente) from usuarios as usu1 where usu1.id_inscrito = inscritos.id_gerente) as 'Gerente',
//
//  (select (select email from usuarios as usu2 where usu2.id_inscrito = usu1.id_gerente) from usuarios as usu1 where usu1.id_inscrito = inscritos.id_gerente) as 'Email gerente',
//
//  (select concat(nombre, ' ', apellido_1, ' ', apellido_2) from usuarios where usuarios.id_inscrito = inscritos.id_gerente) as Delegado,
//
//  (select email from usuarios where usuarios.id_inscrito = inscritos.id_gerente) as 'Email delegado',
//
//  nombre as 'Nombre asistente',
//
//  concat(apellido_1, ' ', ifnull(apellido_2, '')) as 'Apellidos asistente',
//
//  email as 'Email asistente',
//
//  ifnull(dni, '') as 'DNI',
//
//  direccion_fiscal as 'Dirección fiscal',
//
//  telefono as 'Teléfono',
//
//  (select nombre from especialidades where especialidades.id_especialidad = inscritos.id_especialidad) as Especialidad,
//
//  (select nombre from centros_trabajo where centros_trabajo.id_centro_trabajo = inscritos.id_centro_trabajo) as Centro,
//
//  (select nombre from paises where paises.id_pais = inscritos.id_pais) as Pais,
//
//  (select nombre from comunidades where comunidades.id_comunidad = inscritos.id_comunidad) as Comunidad,
//
//  (select nombre from localidades where localidades.id_localidad = inscritos.id_localidad) as Localidad,
//
//  comentarios as 'Comentarios',
//
//
//  (select view_transportes_ida.nombre_tipo from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: medio',
//
//  (select view_transportes_ida.referencia from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: referencia',
//
//  (select view_transportes_ida.fecha from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: fecha salida',
//
//  (select REPLACE(view_transportes_ida.hora1, 'Salida:', '') from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: hora salida',
//
//  trayecto_ida as 'Ida: trayecto',
//
//  (select view_transportes_ida.terminal_salida from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: terminal salida',
//
//  (select view_transportes_ida.terminal_llegada from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: terminal llegada',
//
//  (select view_transportes_ida.fecha2 from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: fecha llegada',
//
//  (select REPLACE(view_transportes_ida.hora2, 'Llegada:', '') from view_transportes_ida where view_transportes_ida.id_ida = inscritos.id_medio_ida) as 'Ida: hora llegada',
//
//
//
//
//  (select view_transportes_vuelta.nombre_tipo from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_vuelta) as 'Vuelta: medio',
//
//  (select view_transportes_vuelta.referencia from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_vuelta) as 'Vuelta: referencia',
//
//  (select view_transportes_vuelta.fecha from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: fecha salida',
//
//  (select REPLACE(view_transportes_vuelta.hora1, 'Salida:', '') from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: hora salida',
//
//  trayecto_vuelta as 'Vuelta: trayecto',
//
//  (select view_transportes_vuelta.terminal_salida from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: terminal salida',
//
//  (select view_transportes_vuelta.terminal_llegada from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: terminal llegada',
//
//  (select view_transportes_vuelta.fecha2 from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: fecha llegada',
//
//  (select REPLACE(view_transportes_vuelta.hora2, 'Llegada:', '') from view_transportes_vuelta where view_transportes_vuelta.id_vuelta = inscritos.id_medio_ida) as 'Vuelta: hora llegada',
//
//
//
//  (select nombre from acuerdos where acuerdos.id_acuerdo = inscritos.id_acuerdo) as Acuerdo,
//
//  (select nombre from derechos where derechos.id_derecho = inscritos.id_derecho) as Derechos,
//
//  (SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',alojamiento.nombre) SEPARATOR ' • ')
//  FROM alojamiento
//  LEFT JOIN inscrito_alojamiento ON inscrito_alojamiento.id_alojamiento = alojamiento.id_alojamiento
//  WHERE inscrito_alojamiento.id_inscrito = inscritos.id_inscrito AND 1) as Alojamientos,
//
//  (SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',servicios.nombre) SEPARATOR ' • ')
//  FROM servicios
//  LEFT JOIN inscrito_servicio ON inscrito_servicio.id_servicio = servicios.id_servicio
//  WHERE inscrito_servicio.id_inscrito = inscritos.id_inscrito AND 1) as Servicios,
//
//  (SELECT GROUP_CONCAT(DISTINCT CONCAT_WS(' | ',view_sesion_evento.id_sesion) SEPARATOR ' • ')
//  FROM view_sesion_evento
//  LEFT JOIN inscrito_sesion ON inscrito_sesion.id_sesion = view_sesion_evento.id_sesion
//  WHERE inscrito_sesion.id_inscrito = inscritos.id_inscrito AND 1) as Eventos
//
//  from inscritos'
?>
