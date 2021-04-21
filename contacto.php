<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();

    global $_l;
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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['secretaria'])?></li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        <section class="text-left">
            <div class="container p-4 ">
                <h3 class="mb-3">
                    <?php  echo mb_strtoupper($_l['secretaria']); ?>
                </h3>
                
                <div class="row">
                    <div class="col-md-6 text-right mb-1"><span><?=Tools::_t('campos_obligatorios')?>*</span></div>
                </div>
                <div class="row row-eq-height">
                    <div class="col-md-6 bg-light ">
                       
                       <p class="m-3"><?=Tools::_t('escriba_su_consulta')?></p>
                        
                       <div class="login-form m-3">
                            <form id="contact-form" method="post" class="form-signin" role="form" action="" class="needs-validation" novalidate>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="<?=Tools::_t('nombre')?>*" required autofocus>
                                    <!--<div class="valid-feedback">Valid</div>-->
                                    <div class="invalid-feedback"><?=Tools::_t('su_nombre')?></div>
                                </div>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-form-contact"><i class='far fa-user text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <input name="apellidos" id="apellidos" type="text" class="form-control" placeholder="<?=Tools::_t('apellidos')?>*" required> 
                                    <div class="invalid-feedback"><?=Tools::_t('sus_apellidos')?></div>
                                </div>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-form-contact"><i class='far fa-envelope text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Correo electrónico*" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> 
                                    <div class="invalid-feedback"><?=Tools::_t('su_email')?></div>
                                </div>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-form-contact"><i class='fas fa-briefcase text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <select id="curso" name="curso" class="custom-select" >
                                        <option value="0"><?=Tools::_t('seleccione_curso')?></option>
                                    </select>
                                    <div class="invalid-feedback"><?=Tools::_t('su_curso')?></div>
                                </div>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-form-contact" style="display:inline-block"><i class="fas fa-pencil-alt text-info" style='font-size:21px;'></i></span>
                                    </div>
                                    <textarea name="consulta" id="consulta" rows="5" cols="56"  class="form-control" required><?=Tools::_t('su_consulta_form')?>*</textarea>
                                    <div class="invalid-feedback"><?=Tools::_t('su_consulta')?></div>
                                </div>
                                   
                                <div id="msg"></div>
                                
                                <div class="d-flex flex-row justify-content-center  pt-3 mt-2 mb-3"> 
                                    <button id="submit_btn"  type="submit" class="btn blue-background text-white mb-3 w-50" disabled><?php  echo strtoupper($_l['enviar']); ?></button>
                                </div> 
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-1 mt-3"></div>
                    
                    <div class="col-md-5  border p-3" style=" max-height: 268px">
                        <div class="m-2 mt-3">
                            <img src="<?php echo Tools::loadImage('jpg', 'ico-tel');?>" hspace="5" vspace="5" style="float: none;" />
                            <span class="w500"><?=Tools::_t('telefono_contacto')?></span>
                        </div>
                        <div class="m-2" style="float:left;">
                            <span style="float:left"><img src="<?php echo Tools::loadImage('jpg', 'ico-rel');?>" hspace="3" vspace="3" style="float:left" /></span>
                            <span style="float:left;" class="w500"><?=Tools::_t('horario')?>:</span><br/>
                            <span><?=Tools::_t('horario_text1')?></span><br/>
                            <span style="margin-left: 68px;"><?=Tools::_t('horario_text2')?></span>
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
