<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();

    // Header and menu templates
    Tools::loadTemplatePart('header-front');
?>
    
    <body>
        <section id="login">
            <div class="container p-4 my-3">
                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <div class="form-header">
				<i class="fa fa-user blue-text"></i>
                                <h4 class="mb-0 blue-text"><?=Tools::_t('recuperar_contrasena')?></h4>
			</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-xs-12 col-md-6 m-auto">
                        
                        <div id="msg"></div>
                        
                        <form id="recuperarpswd-form" method="post" action="" class="needs-validation" novalidate>
                            <div class="div_login text-left mb-4" >
                                <div class="input-group  mb-0 ">
                                    <div class="input-group-prepend ico-envelope">
                                        <span class="input-group-text btn btn-form-contact"><i class='far fa-envelope text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Correo electrónico" aria-label="Email" autofocus required>&nbsp;
                                    <div class="invalid-feedback"><?=Tools::_t('su_email')?></div>
                                </div>
                            </div>

                            <div id="form-login-submit" class="control-group mb-3 text-center" >
                                <div class="controls">
                                    <button type="submit" class="btn blue-background text-white mb-3 w-50 btn-sesion" id="submit_btn" data-loading-text="<i class='fas fa-spinner fa-spin gap-right'></i>"><?=Tools::_t('enviar')?></button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <span class="blue-text"><a href="login.php"><?=Tools::_t('iniciar_sesion')?></a></span>
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
