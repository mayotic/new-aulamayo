<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();
 
    global $tdata, $_l;
    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>
    
    <body>
        <section class="bg-light" style="max-height:50px;">
            <div class="container" style="max-height:50px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <nav aria-label="breadcrumb" class="bg-light d-flex justify-content-between" style="max-height:50px; margin-right:10px;">
                            <a href="#"></a>
                            <ol class="breadcrumb bg-light">
                                <li class="breadcrumb-item"><a href="home.php" class="grey-fort"><i class="fas fa-home text-grey" aria-hidden="true"></i></a></li>
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['registro'])?></li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        <section class="text-left">
            <form id="registro-form" method="post" action="" class="needs-validation" novalidate>
                <div class="container p-4 ">
                    <h3 class="mb-3"><?=mb_strtoupper($_l['registro'])?></h3>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 text-right mb-1"><span><?=Tools::_t('todos_campos_obl')?></span></div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10 bg-light  ">
                                <div class="login-form m-3">
                                    
                                    <p class=""><?=mb_strtoupper($_l['datos_personales'])?></p>
                                    <div class="div_nombre">
                                        <!--<div class="input-group mt-3 validate-me">-->
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                            </div>
                                            <input name="nombre" id="nombre" type="text" class="form-control" placeholder="<?=Tools::_t('nombre')?>" required autofocus>
                                            <div class="invalid-feedback"><?=Tools::_t('su_nombre')?></div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-row">
                                        
                                        <div class=" col-md-6 div_apellido1" >
                                            <div class="input-group mt-3" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="apellido1" id="apellido1" type="text" class="form-control" placeholder="<?=Tools::_t('primer_apellido')?>" required>
                                                <div class="invalid-feedback"><?=Tools::_t('su_apellido1')?></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 div_apellido2">
                                            <div class="input-group mt-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="apellido2" id="apellido2" type="text" class="form-control" placeholder="<?=Tools::_t('segundo_apellido')?>" required>
                                                <div class="invalid-feedback"><?=Tools::_t('su_apellido2')?></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="div_nombre">
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                            </div>
                                            <input name="dni_nie" id="dni_nie" type="text" class="form-control" placeholder="<?=Tools::_t('dni_nie')?>" required>
                                            <div class="invalid-feedback"><?=Tools::_t('su_dni_nie')?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class=" col-md-6 div_profesion">
                                            <div class="form-group input-group mt-3 mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <div id="profesiones-select">
                                                    
                                                </div>
                                                <div id="msgProfesion" class="invalid-feedback"><?=Tools::_t('su_profesion')?></div>
                                            </div>
                                        </div>
                                        
                                        <div class=" col-md-6 div_especialidad">
                                            <div class="form-group input-group mt-3 mb-0"> 
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <div id="especialidades-select" >
                                                    <select name="especialidad" id="especialidad"  class="custom-select selectpicker" required>
                                                        <option value="" selected><?= Tools::_t('seleccione_especialidad') ?></option>
                                                    </select>
                                                </div>
                                                <div id="msgEspecialidad" class="invalid-feedback"><?=Tools::_t('su_especialidad')?></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="div_centro_trabajo">
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn btn-form-contact"><i class='fas fa-briefcase text-info' style='font-size:21px'></i></span>
                                            </div>
                                            <input name="centro_trabajo" id="centro_trabajo" type="text" class="form-control" placeholder="<?=Tools::_t('centro_de_trabajo')?>" required>
                                            <div class="invalid-feedback"><?=Tools::_t('su_centro_trabajo')?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class=" col-md-6 div_codigo_postal">
                                            <div class="form-group input-group mt-3 mb-0" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <div id="pais-select" >
                                                    
                                                </div>
                                                <div id="msgPais" class="invalid-feedback"><?=Tools::_t('su_pais')?></div>
                                            </div>
                                        </div>
                                        
                                        <div class=" col-md-6 div_provincia">
                                            <div class="form-group input-group mt-3 mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <div id="provincias-select">
                                                    <select name="provincia" id="provincia"  class="custom-select selectpicker" required>
                                                        <option value="" selected><?= Tools::_t('seleccione_provincia') ?></option>
                                                    </select>
                                                </div>
                                                <div id="msgProvincia" class="invalid-feedback"><?=Tools::_t('su_provincia')?></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row mb-3">
                                        <div class=" col-md-6 div_poblacion">
                                            <div class="form-group input-group mt-3 mb-0">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="poblacion" id="poblacion" type="text" class="form-control" placeholder="<?=Tools::_t('poblacion')?>" required>
                                                <div class="invalid-feedback"><?=Tools::_t('su_poblacion')?></div>
                                            </div>
                                        </div>
                                        
                                        <div class=" col-md-6 div_codigo_postal">
                                            <div class="input-group mt-3" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="codigo_postal" id="codigo_postal" type="text" class="form-control" placeholder="<?=Tools::_t('codigo_postal')?>" required>
                                                <div class="invalid-feedback"><?=Tools::_t('su_cpostal')?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                    <p class="mb-0"><?=mb_strtoupper($_l['datos_usuario'])?></p> 
                                    <div class="div_centro_trabajo">
                                        <div class="input-group mt-3" >
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='far fa-envelope text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="email" id="email" type="email" class="form-control myEmailClass" placeholder="<?=Tools::_t('correo_electronico')?>" required>
                                                <div id="invalid_email" class="invalid-feedback"><?=Tools::_t('su_email')?></div>
                                            </div>
                                    </div>
                                    
                                    <div class="form-row mb-4">
                                        <div class=" col-md-6 div_password">
                                            <div class="input-group mt-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='fas fa-lock text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="password" id="password" type="password" class="form-control myPwdClass" minlength="8" placeholder="<?=Tools::_t('contrasena')?>" pattern=".{8,}" required>
                                                <div id="pswdValid" class="valid-feedback"><?=Tools::_t('contrasenya_correcta')?></div>
                                                <div id="pswdInvalid" class="invalid-feedback"><?=Tools::_t('su_contrasena_min8')?></div>
                                            </div>
                                        </div>
                                        
                                        <div class=" col-md-6 div_confirma_password">
                                            <div class="input-group mt-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn btn-form-contact"><i class='fas fa-lock text-info' style='font-size:21px'></i></span>
                                                </div>
                                                <input name="confirma_password" id="confirma_password" type="password" class="form-control myCpwdClass" minlength="8" placeholder="<?=Tools::_t('confirme_contrasena')?>" pattern=".{8,}" required>
                                                <div id="cPwdValid" class="valid-feedback"></div>
                                                <div id="cPwdInvalid" class="invalid-feedback"><?=Tools::_t('su_confirme_contrasena')?></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="">
                                        <?php
                                        //echo "<pre>"; var_dump($tdata['textos']); echo "</pre>"; exit();
                                        if( count($tdata['textos']) > 0 ){
                                            $i = 0;
                                            foreach ($tdata['textos'] as $texto){ 
                                                $id_texto_legal = $texto->id_texto_legal;
                                                $titulo = $texto->titulo;
                                                $text = $texto->texto;
                                                $id_tipo_texto_legal = $texto->id_tipo_texto_legal;
                                                $url = $texto->url;
                                                $link_cond = $url != '' ? '<a href="'.$url.'" target="_blank" style="text-decoration:underline; color:#17a2b8; font-size:14px;">Ver</a>' : '';
                                                $obligatorio = $texto->obligatorio;
                                                $required_text = $obligatorio == '1' ? 'required' : '';
                                        ?>
                                                <div class="form-group ">
                                                    <div class="form-check">
                                                        <input id="check_" name="checks" class="form-check-input check_curso" type="checkbox" data-idtextolegal="<?=$id_texto_legal?>" <?=$required_text?> >
                                                        <label class="form-check-label" for="gridCheck">
                                                            <?php echo $titulo.'&nbsp;&nbsp;'.$link_cond; ?>
                                                        </label>
                                                        <div class="invalid-feedback"><?=Tools::_t('debe_aceptar_cond')?></div>
                                                    </div>
                                                </div>
                                        <?php 
                                            $i++;
                                            }
                                        }
                                        ?>
                                        
                                    </div>
                                    <br>
                                    
                                </div>
                            </div>
                     </div>
                    
                    <div class="col-md-1"></div>
                    <div class="col-md-10"></div>
                    <div class="d-flex flex-row justify-content-center  pt-3 mt-2 mb-2">
                        <div id="msg" class="w-100"></div>
                    </div>
                    <div class="d-flex flex-row justify-content-center  pt-3 mt-2 mb-3">
                        <div id="msg"></div>
                        <button type="submit" class="btn blue-background text-white mb-3 w-40 btn-sesion" id="submit_btn" data-loading-text="<i class='fas fa-spinner fa-spin gap-right'></i>" ><?=mb_strtoupper($_l['registrarse'])?></button>
                    </div>
                    <div class="col-md-1"></div>

                </div>
            </form>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
            Tools::loadTemplatePart('profesiones-select');
            Tools::loadTemplatePart('especialidades-select');
            Tools::loadTemplatePart('pais-select');
            Tools::loadTemplatePart('provincias-select');
            Tools::loadTemplatePart('localidades-select');
        ?>
    </body>
</html>
