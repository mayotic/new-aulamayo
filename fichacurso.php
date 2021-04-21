<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();

    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>
    
    <body>
        
        <!-- DESCRIPCIÓN CURSO -->
        <section class="text-left">
            <div class="container p-3 ">
                <h3 class="mb-3">
                    DECISIONES CLÍNICAS EN ATENCIÓN PRIMARIA: SIGNOS DE ALARMA Y COMPLICACIONES DE CONSULTAS FRECUENTES
                </h3>
                <div class="border">
                    <div class="d-flex flex-row justify-content-between pl-3 pt-1">
                        <div class="text-left">
                          <h6 class="text-info text-left">ACREDITADO CON 2,3 CRÉDITOS</h6>
                        </div>
                        <div class="text-left pr-3">
                            <i class="fas fa-graduation-cap text-info" aria-hidden="true"></i>&nbsp;<span class="text-dark font-weight-bold">ON-LINE</span>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between pl-3 pt-1 pb-2">
                        <div class="text-left">
                            <i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;<span class="text-dark"><b>Julio 2019 - Julio 2020</b></span>
                        </div>
                        <div class="text-left pr-3">
                            <span class="text-info font-weight-bold">GRATUITO</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                   <div class="col-md-7 mt-3">
                        <img src="img/canal-medicina2.jpg" class="img-fluid">
                    </div>
                    <div class="col-md-5 bg-light py-3 pr-5 pl-5 mt-3">
                        <p class="m-3"><b>Dirigido a:</b> Médicos de Atención Primaria</p>
                        <p class="m-3">
                            <b>Director del curso:</b> Dr. J.L. Almudí Alegre.<br/>
                            Médico de Atención Primaria y Cordinador <br/> del Centro de Salud Peñafiel (Valladolid).
                        </p>
                        <p class="m-3"><b>Acreditado por:</b> el Consell Català de Formació <br/>
                            Continuada de les Professions Sanitàries, <br/>
                            Comisión de Formación Continuada del <br/>
                            Sistema Nacional de Salud 
                        </p>
                        <p class="m-3 font-weight-bold">Inscripción gratuita</p>
                        <div class="d-flex flex-row justify-content-center  pt-3 ">
                            <button type="button" class="btn blue-background text-white w-100">ACCEDER AL CURSO</button>
                        </div>
                    </div>
                </div>
                
                <div class="canales">
                    <a href="#"><img src="img/canales_popup.png"></a>
                </div>
                
                <p class="text-dark  mt-3">
                    Aula Mayo es la plataforma online de formación continuada que Ediciones Mayo pone a disposición del profesional sanitario.<br/>
                    La formación continuada es un componente imprescindible para los profesionales sanitarios. Los avances científicos y el <br/>
                    entorno legal requieren una respuesta en forma de oferta formativa actualizada y completa.
                </p>
            </div>
        </section>
        
        <!-- ACCORDION -->
        <section class="container text-left pb-3">
            <div class="">
                <div id="accordion" class="accordion">
                    <div class="card mb-0 border-0">
                        <div class="card-header mb-1 collapsed" data-toggle="collapse" href="#collapseOne">
                            <a class="card-title"> OBJETIVOS </a>
                        </div>
                        <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                            <p class="blue-text"><b>TEMA 1. La EPOC existe. Carecterísticas de la enfermedad</b></p>
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <a class="card-title"> PROGRAMA </a>
                        </div>
                        <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                            <p class="blue-text"><b>TEMA 1. La EPOC existe. Carecterísticas de la enfermedad</b></p>
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
                        </div>
                        
                        <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <a class="card-title"> EQUIPO DOCENTE </a>
                        </div>
                        <div id="collapseThree" class="card-body collapse" data-parent="#accordion">
                            <p class="blue-text"><b>TEMA 1. La EPOC existe. Carecterísticas de la enfermedad</b></p>
                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS. </div>
                        </div>
                        
                        <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            <a class="card-title"> EVALUACIÓN Y DIPLOMA </a>
                        </div>
                        <div id="collapseFour" class="card-body collapse" data-parent="#accordion">
                            <p class="blue-text"><b>TEMA 1. La EPOC existe. Carecterísticas de la enfermedad</b></p>
                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS. </div>
                        </div>
                        
                        <div class="card-header mb-1 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            <a class="card-title"> CRÉDITOS </a>
                        </div>
                        <div id="collapseFive" class="card-body collapse" data-parent="#accordion">
                            <p class="blue-text"><b>TEMA 1. La EPOC existe. Carecterísticas de la enfermedad</b></p>
                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. samus labore sustainable VHS. </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
