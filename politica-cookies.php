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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['politica_cookies'])?></li>
                            </ol>   
                        </nav>
                    </div>
                </div>
            </div>
        </section> 
        
        <section class="text-left">
            <div class="container p-4 ">
                <h3 class="mb-3">
                    <?php  echo mb_strtoupper($_l['politica_cookies']); ?>
                </h3>
                
                <div class="row">
                    <div class="col-md-12 mt-3 mb-1">
                        <p>
                            Una cookie es un archivo de texto que se almacena en el ordenador o dispositivo móvil mediante un servidor web, y tan sólo ese servidor será capaz de 
                            recuperar o leer el contenido de la cookie. Las cookies permiten al sitio web recordar preferencias de navegación y navegar de manera eficiente, y hacen 
                            la interacción entre el usuario y el sitio web más rápida y fácil. Este sitio web utiliza los siguientes tipos de cookies: 
                        </p>
                        
                        <br>
                        <h4>1. Cookies de rendimiento</h4>
                        <p>
                            Se trata de cookies que recogen información sobre cómo utiliza el sitio web, por ejemplo, las páginas que visita o si se produce algún error, y que también 
                            ayudan a la localización y solución de problemas del sitio web. Toda la información recogida en las mismas es totalmente anónima y nos ayuda a entender cómo 
                            funciona nuestro sitio, realizando las mejoras oportunas para facilitar su navegación. Dichas cookies permitirán: 
                        </p>
                        <ul>
                            <li>Que usted navegue por el sitio.</li>
                        </ul>
                        <ul>
                            <li>
                                Que <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> recopile información sobre cómo utiliza usted la página web, para así entender la usabilidad del sitio y ayudarnos a implementar las 
                                mejoras necesarias. Estas cookies no recogerán ninguna información sobre usted que pueda ser usada con fines publicitarios, o información acerca de sus 
                                preferencias (tales como sus datos de usuario) más allá de esa visita en particular.
                            </li>
                        </ul>
                        
                        <br><br>
                        <h4>2. Cookies funcionales</h4>
                        <p>
                            Nuestro propósito con estas cookies no es otro que mejorar la experiencia de los usuarios de <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. Podrá rechazar en cualquier momento el uso de 
                            dichas cookies. <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> utiliza estas cookies para recordar ciertos parámetros de configuración o para proporcionar ciertos servicios o mensajes que 
                            pueden llegar a mejorar su experiencia en nuestro sitio, y no se utilizan con fines de marketing. Dichas cookies permitirán: 
                        </p>
                        <ul>
                            <li>
                                Recordar sus datos de inicio de sesión como cliente al volver a la página. Estas cookies no recogerán ninguna información sobre usted que pueda ser usada con 
                                fines publicitarios, o información acerca de sus preferencias (tales como sus datos de usuario) más allá de esa visita en particular.
                            </li>
                        </ul>
                        
                        <br><br>
                        <h4>3. ¿Cómo evitar y borrar las cookies?</h4>
                        <p>
                            Si usted no quiere poner cookies en su equipo, usted puede rechazar cookies en su navegador; y ahí puede elegir qué cookies aceptar, bloquear o borrar. Si usted 
                            quiere borrar ya las cookies en su equipo y tiene un PC y un navegador actualizado, puede hacerlo pulsando las teclas CTRL (Control) + SHIFT (Mayúsculas) + DELETE (Suprimir) 
                            simultáneamente en su navegador. Si los accesos directos del teclado no funcionan en su navegador, por favor visite la página de soporte para el navegador en cuestión. 
                        </p>
                    </div>
                </div>
                
            </div>
        </section>
        
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
