<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
global $appconf, $tdata, $_l;

Tools::loadTranslation($lang = $conf['appinfo']['default_lang']);

if(!isset($_SESSION['userlogedin']) && !$_SESSION['userlogedin'] ) {
    header('Location: /home');
}
$cursos = new CursosModel();
$cursos_usuario = $cursos->getCursosUsuario(['filter' => ['matriculas.id_usuario' => $_SESSION['userlogedin']], 'order' => ['cursos.fecha_inicio ASC']]);

if (!empty($cursos_usuario)) {

  foreach ($cursos_usuario as $key => $curso) {

    // Botó curs (acces, registrat o login)
    $cursos_usuario[$key]->btn_curso = $cursos->getMoodleAccessCourseButton((!empty($curso) ? $curso->id_curso : 0), (!empty($_SESSION['userlogedin']) ? $_SESSION['userlogedin']  : 0));

    // Credits del curs
    if( empty($curso->creditos) ){
        $cursos_usuario[$key]->num_creditos = '&nbsp;';
    }else{
        //$cursos_usuario[$key]->num_creditos = mb_strtoupper($_l['acreditado_con']).' '.$curso->creditos.' '.mb_strtoupper($_l['creditos']);
        $num_cred = explode('.', $curso->creditos);

        if( $num_cred[1] == '00' && $num_cred[0] == '1' ){
            $num_creditos = $num_cred[0].' '.mb_strtolower($_l['credito']);
        }else{
            $num_creditos = number_format($curso->creditos, 2, ',', '.').' '.mb_strtolower($_l['creditos']);
        }
        if( $num_cred[1] == '00' && $num_cred[0] != '1' ){
            $num_creditos = number_format($curso->creditos, 0, ',', '.').' '.mb_strtolower($_l['creditos']);
        }
        if( $curso->creditos == '0.01'){
            $num_creditos = '0,1 '.mb_strtolower($_l['credito']);
        }
        if( substr($curso->creditos, -1) == '0' && $num_cred[1] != '00'){
            $num_creditos = number_format($curso->creditos, 1, ',', '.').' '.mb_strtolower($_l['creditos']);
        }
        if( $num_cred[1] == '10' ){ $num_creditos = number_format($curso->creditos, 1, ',', '.').' '.mb_strtolower($_l['credito']); }
        $cursos_usuario[$key]->num_creditos = $num_creditos;
    }

    // Imatge del curso
    $tmp = explode('.', $curso->imagen);
    $cursos_usuario[$key]->img_curso = Tools::loadImage($tmp[1], $tmp[0]);

    // Dates formatades
    $cursos_usuario[$key]->fecha_ini_curso = date('d/m/Y', strtotime($curso->fecha_inicio));
    $cursos_usuario[$key]->fecha_fin_curso = date('d/m/Y', strtotime($curso->fecha_fin));

    $cursos_usuario[$key]->allow_certificate = ($cursos->allowCertificate($curso->id_curso, $_SESSION['userlogedin']) ? '' : 'disabled');
    // $cursos_usuario[$key]->allow_certificate = 'disabled';

  }

}

// ' . ($cursos_usuario->allow_certificate ? '' : 'disabled') . '
// var_dump($cursos_usuario); exit;
$cursos_row_tmpl = '
    <div class="gridcursos col-lg-3 mb-4" style="min-width:320px;">
        <div class="card card-canal card-curso">
            <div class="card-img-top">
                <a href="/ficha-curso/{{url_id}}">
                    <div class="pl-2 pr-2 pt-2">
                        <img src="{{img_curso}}" class="img-fluid w-100">
                        <h6 class="mt-3 text-info text-left p-1" style="text-transform: lowercase;">{{num_creditos}}</h6>
                        <div class="" style="height:120px;">
                            <p class="mt-3 text-dark text-left p-1"><span class="font-weight-bold" style="text-transform: uppercase;">{{nombre}}</span></p>
                        </div>
                        <div class="d-flex flex-row justify-content-left p-2">
                            <div class="text-left">
                                <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark"><b>{{fecha_ini_curso}}  -  {{fecha_fin_curso}}</b></span>
                            </div>
                        </div>
                        <br><div class="text-center">{{btn_curso}}</div>
                        <br><div class="text-center">


                        <button type="button" data-usuario="' . $_SESSION['userlogedin'] . '" data-curso="{{id_curso}}"
                        class="btn btn-secondary font14 certificate" style="width:156px;" {{allow_certificate}}>
                        <i class="fas fa-download text-white" aria-hidden="true"></i>
                        &nbsp; &nbsp;'.$_l['diploma'].'</button>


                        </div>
                    </div>
                    <i class="w-100">&nbsp;</i>
                </a>
            </div>
        </div>
    </div>

    <div class="rowcursos">
        <hr class="marginT10 marginB20 display-inline">
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                <a href="/ficha-curso/{{url_id}}"><img src="{{img_curso}}" title="" class="img-responsive imgbook2"></a>
            </div>
            <div class="col-md-7" style="width:500px;">
                <div class="col-md-12">
                    <h6 class="mt-3 text-info text-left p-1">{{num_creditos}}</h6>
                    <div class="" style="height:auto;">
                        <p class="mt-3 text-dark text-left p-0"><span class="font-weight-bold" style="text-transform: uppercase;">{{nombre}}</span></p>
                    </div>
                    <div class="d-flex flex-row justify-content-left p-2 mb-3">
                        <div class="text-left">
                            <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark"><b>{{fecha_ini_curso}}  -  {{fecha_fin_curso}}</b></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2" justify-content-center text-center align-items-center style="width:350px;">
                <div class="text-center">{{btn_curso}}</div><br>
                <div class="text-center">

                <a href="#" class="text-white" style="text-decoration:none; cursor:none;">
                <button type="button" data-usuario="' . $_SESSION['userlogedin'] . '" data-curso="{{id_curso}}"
                class="btn btn-secondary font14 certificate" style="width:156px;" disabled>
                <i class="fas fa-download text-white" aria-hidden="true"></i>
                &nbsp; &nbsp;'.$_l['diploma'].'</button>
                </a>

                </div>
            </div>
        </div>
    </div>
';
// var_dump($cursos_usuario);
$tdata['mis_cursos'] = Tools::tmpl($cursos_usuario, $cursos_row_tmpl);
