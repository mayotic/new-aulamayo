
         <button onclick="topFunction()" id="myBtn" title="Go to top"> <!-- <span class="lnr lnr-chevron-up"></span> -->
             <svg class="bi bi-caret-up-fill" width="1.5em" height="1.6em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 00.753-1.659l-4.796-5.48a1 1 0 00-1.506 0z"/>
            </svg>
         </button>


        <footer>
            <section class="p-3 mt-3 bg-light"></section>       
        
            <!-- GRUPO EDICIONES MAYO -->
            <section class="pt-5 pb-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 mb-4 p-2 text-center">
                            <a href="http://www.sietediasmedicos.com/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo25');?>" class="" height="50"></a>
                        </div>
                        <div class="col-md-3 mb-4 p-2 text-center">
                            <a href="http://www.elfarmaceutico.es/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo_ef');?>" class="" height="40"></a>
                        </div>
                        <div class="col-md-3 mb-4 p-2 text-center">
                            <a href="http://www.actapediatrica.com/" target="_blank"><img src="<?php echo Tools::loadImage('png', 'logo_custom_for_web');?>" class="" height="50"></a>
                        </div>
                        <div class="col-md-3 mb-4 p-2 text-center">
                            <a href="http://www.espacioasma.es/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo-espacioAsma');?>" height="60"></a>
                        </div>
                                                
                        <!--
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6 p-3 ml-4 text-center">
                            <a href="http://www.sietediasmedicos.com/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo25');?>" class="" height="50"></a>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6  p-3 ml-5 text-center">
                            <a href="http://www.elfarmaceutico.es/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo_ef');?>" class="" height="40"></a>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6  p-3 ml-4 text-center">
                            <a href="http://www.actapediatrica.com/" target="_blank"><img src="<?php echo Tools::loadImage('png', 'logo_custom_for_web');?>" class="" height="50"></a>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6  p-3 ml-4 text-center">
                            <a href="http://www.espacioasma.es/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo-espacioAsma');?>" height="60"></a>
                        </div>
                        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6  p-3 ml-4 text-center">
                            <a href="http://www.sietediasmedicos.com/" target="_blank"><img src="<?php echo Tools::loadImage('jpg', 'logo25');?>" class="" height="50"></a>
                        </div>
                       -->
                    </div>
                </div>
            </section>
            
            <section class="py-5 bg-light">
                <div id="mayoFooter" class="container">
                    <div class="row">
                        <div id="logoMayoFooter" class="col-md-2 text-right mb-3">
                            <img src="<?php echo Tools::loadImage('png', 'mayo-logo-formacion');?>" class="img-fluid w-50 mt-0">
                        </div>
                        <div class="col-md-4 border-subfooterrightgrey mb-4">
                            <p class="mb-1 text-info"><a href="https://www.edicionesmayo.es" style="color:#17a2b8; text-decoration: none;" target="_blank">www.edicionesmayo.es</a></p>
                        </div>
                        <div class="col-md-3 border-subfooterrightgrey mb-4">
                            <p class="mb-1"><a href="/faqs" style="color:#000; text-decoration: none;"><?=Tools::_t('preguntas_frecuentes')?></a></p>
                            <p class="mb-1"><a href="/contacto" style="color:#000; text-decoration: none;"><?=Tools::_t('secretaria')?></a></p>
                        </div>
                        <div class="col-md-3 mb-4">
                            <p class="mb-1"><a href="/politica-privacidad" style="color:#000; text-decoration: none;"><?=Tools::_t('politica_privacidad')?></a></p>
                            <p class="mb-1"><a href="/creditos" style="color:#000; text-decoration: none;"><?=Tools::_t('creditos')?></a></p>
                            <p class="mb-1"><a href="/condiciones-generales" style="color:#000; text-decoration: none;"><?=Tools::_t('condiciones_generales')?></a></p>
                            <p class="mb-1"><a href="/politica-cookies" style="color:#000; text-decoration: none;"><?=Tools::_t('politica_cookies')?></a></p>
                        </div>
                    </div>
                </div>
            </section>
        
            <div class="p-3 bg-white">
                <div class="row text-center text-grey">
                    <div class="col ml-auto">
                        <p class="text-secondary">&copy; <?=date('Y')?> Ediciones Mayo S.A.</p>
                    </div>
                </div>
            </div>      
            
            <!--//BLOQUE COOKIES-->
            <div id="barraaceptacion">
                <div class="inner">
                    <?=Tools::_t('texto_cookies')?>
                </div>
            </div>

            <?php echo Tools::loadLibrary('js', 'main-front'); ?>
        </footer>

