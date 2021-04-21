<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
    AutoIncludes::loadController();
    
    if(isset($_SESSION['userlogedin']) && $_SESSION['userlogedin'] ){ 
        header('location: /home');
    }

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
                                <h4 class="mb-0 blue-text"><?=Tools::_t('iniciar_sesion')?></h4>
			</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-xs-12 col-md-6 m-auto">
                        
                        <div id="msg"></div>
                        
                        <form id="login-form" method="post" action="" class="needs-validation" novalidate>
                            <div class="div_login text-left mb-2" >
                                <div class="input-group  mb-0 ">
                                    <div class="input-group-prepend ico-envelope">
                                        <span class="input-group-text btn btn-form-contact"><i class='far fa-envelope text-info' style='font-size:21px'></i></span>
                                    </div>
                                    <input name="inputEmail" id="inputEmail" type="email" class="form-control" placeholder="<?=Tools::_t('correo_electronico')?>" required autofocus pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">&nbsp;
                                    <div class="invalid-feedback"><?=Tools::_t('su_email')?></div>
                                </div>
                            </div>

                            <div class="div_pswd text-left mb-3" >
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend ico-lock">
                                        <span class="input-group-text btn btn-form-contact"><i class='fas fa-lock text-info' style='font-size:21px'></i></span>
                                    </div> 
                                    <input id="inputPassword" name="inputPassword" type="password" class="form-control" placeholder="<?=Tools::_t('contrasena')?>"  required  >&nbsp;
                                    <div class="invalid-feedback"><?=Tools::_t('su_contrasena')?></div>
                                </div>
                            </div>

                            <div id="form-login-submit" class="control-group mb-3 text-center" >
                                <div class="controls">
                                    <button type="submit" class="btn blue-background text-white mb-3 w-50 btn-sesion" id="submit_btn" data-loading-text="<i class='fas fa-spinner fa-spin gap-right'></i>" >Iniciar sesi&oacute;n</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <span class="blue-text"><a href="recuperar-pswd.php"><?=Tools::_t('olvidado_contrasena')?></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php 
            Tools::loadTemplatePart('footer-front');
        ?>
        
        <script type="text/javascript">
            window.url_home = '/home';
        </script>
    </body>
</html>
