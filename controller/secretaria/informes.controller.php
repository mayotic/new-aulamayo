<?php

// Login control
Tools::loginControl();

$response['totales'] =  ['titulo_num_asistentes'  => 'Total asistentes',
                         'desc_num_asistentes'    => 'Total asistentes (sin contar delegados, gerentes, ponentes, etc ...)',
                         'num_asistentes'         => App::getNumAsistentes(),
                         'titulo_num_ponentes'    => 'Ponentes',
                         // 'desc_num_ponentes'      => 'Total ponentes del foro',
                         // 'num_ponentes'           => App::getNumPonentes(),
                         'num_ponentes'           => App::getNumPonentes(),
                         'titulo_num_ponentes_ab' => 'Total ponentes "Advisory"',
                         'desc_num_ponentes_ab'   => 'Total ponentes "Advisory" del foro',
                         'num_ponentes_ab'        => App::getNumPonentesAB(),
                         'titulo_num_admins'      => 'Total staff',
                         'desc_num_admins'        => 'Total personal organizador del foro',
                         'num_admins'             => App::getNumAdmins(),
                         'titulo_num_confirmados' => 'Total asistentes validados',
                         'desc_num_confirmados'   => 'Total asistentes validados por secretaría (datos correctos)',
                         'num_confirmados'        => App::getNumConfirmados(),
                         'titulo_num_por_alojamiento'   => 'Totales por alojamiento',
                         'num_por_alojamiento'    => App::getNumPorAlojamiento(),
                         'titulo_num_por_servicios'   => 'Totales por servicio',
                         'num_por_servicios'      => App::getNumPorServicio(),
                         'num_por_cafetaller'     => App::getNumPorCafeTaller(),
                         // 'presu_por_usuario'      => App::getUsersBudget()
                        ];

if (!Tools::isAjax()){
  echo '<script type="text/javascript">window.tdata = ' . json_encode($response) . '</script>';
}else{
  echo json_encode($response);
}

?>
