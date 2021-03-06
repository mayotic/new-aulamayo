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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['condiciones_generales'])?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-left">
            <div class="container p-4 ">
                <h3 class="mb-3">
                    <?php  echo mb_strtoupper($_l['condiciones_generales']); ?>
                </h3>
            </div>

            <main class="container pageContent mb-5">
                <article class="">
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th>RESPONSABLE</th>
                        </tr>
                        <tr>
                            <td>
                                Sitio web: <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                                <br>
                                Responsable y titular: EDICIONES MAYO, S.A. (en adelante, EDICIONES MAYO)
                                <br>
                                CIF: A:08735041
                                <br>
                                Domicilio: calle Aribau, 185-187, 2?? planta, 08021, Barcelona
                                <br>
                                Tel??fono de contacto: + 34 932 090 255
                                <br>
                                E-mail de contacto: <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a>
                            </td>
                        </tr>
                    </table>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th>FINALIDAD</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> es una p??gina web que presenta la posibilidad de ??????????????????????????????
                            </td>
                        </tr>
                    </table>
                    <br>
                    <h3 class="text-left noMarge">1. CONDICIONES GENERALES </h3>
                    <p>
                        Estas Condiciones Generales regulan el funcionamiento de los servicios del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. que EDICIONES MAYO pone a disposici??n de los usuarios
                        interesados. La utilizaci??n del SITIO WEB atribuye la condici??n de usuario y supone la aceptaci??n plena y sin reservas de todas y cada una de las presente
                        Condiciones Generales. Si el usuario no est?? de acuerdo con las Condiciones Generales, no tendr?? derecho a utilizar el SITIO WEB ni los servicios que ofrece.
                        Si el usuario desea registrarse en el sitio web o realizar alguno de los cursos, webinars, simposiums, congresos, formaci??n acreditada, formaci??n online y
                        presencial (entre otros) deber?? aceptar la Pol??tica de Privacidad y se entiende que acepta las presentes Condiciones Generales.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">2. ACCESO Y USO DEL SITIO WEB ES GRATUITO </h3>
                    <p>
                        La prestaci??n de los servicios del SITIO WEB por parte de EDICIONES MAYO al usuario tiene car??cter gratuito y no exige la previa suscripci??n ni registro, a
                        menos que el usuario decida registrarse o bien realizar alguno de los cursos, webinars, simposiums, congresos, formaci??n acreditada, formaci??n online y
                        presencial (entre otros) de los que se ofrecen en el SITIO WEB.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">3. MODIFICACIONES EN EL SITIO WEB Y LOS SERVICIOS </h3>
                    <p>
                        EDICIONES MAYO se reserva el derecho a modificar unilateralmente y en cualquier momento, sin previo aviso, la presentaci??n o configuraci??n del SITIO WEB, as?? como
                        los servicios ofrecidos y las Condiciones Generales. Dichas modificaciones ser??n para mejorar los servicios y la oferta de servicios al usuario, seg??n las
                        tendencias de mercado, mejorar y/o actualizar el SITIO WEB y adecuarse a la normativa aplicable en cada momento.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">4. USO CORRECTO DEL SITIO WEB Y DE LOS SERVICIOS </h3>
                    <p>
                        El usuario se compromete a utilizar el SITIO WEB, los contenidos y los servicios de conformidad a la Ley, a las presentes Condiciones Generales, a las buenas
                        costumbres y al orden p??blico. De la misma forma, el usuario se obliga a no utilizar el sitio
                        <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>, el contenido y los servicios que se ofrecen en
                        ??ste con fines o efectos il??citos, contrarios al contenido de estas Condiciones Generales, lesivas de los derechos e intereses de terceros o, que de cualquier
                        forma, puedan da??ar, inutilizar, sobrecargar o deteriorar el SITIO WEB, su contenido o los servicios o impedir la normal utilizaci??n o disfrute del SITIO WEB
                        por otros usuarios.
                    </p>
                    <p>
                        El usuario deber?? abstenerse de obtener otros informaciones, mensajes, entrevistas, opiniones, comentarios gr??ficos, archivos de sonido y/o imagen, v??deos,
                        fotograf??as, im??genes, ilustraciones, m??sica, feel & look, software, marcas, logos y otros signos distintivos, nombres, obras cient??ficas, casos cl??nicos,
                        estudios cient??ficos, estad??sticas (entre otros) y, en general, cualquier clase de material accesible a trav??s del SITIO WEB o de los servicios, empleando
                        para ello medios distintos de los que se hayan puesto a su disposici??n, o en general, de los que se empleen habitualmente en Internet.
                    </p>
                    <p>
                        El usuario deber?? abstenerse de manipular datos identificativos de EDICIONES MAYO, as?? como el contenido y los servicios que se ofrecen en el SITIO WEB.
                    </p>
                    <p>
                        El usuario deber?? abstenerse de manipular los dispositivos t??cnicos de protecci??n de contenidos o de informaci??n, y en general de configuraci??n de los espacios del SITIO WEB.
                    </p>
                    <p>
                        EDICIONES MAYO se reserva el derecho de denegar el acceso a la p??gina web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                        en cualquier momento y sin necesidad de previo aviso a aquellos usuarios que incumplan estas Condiciones Generales.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">5. POL??TICA DE PRIVACIDAD </h3>
                    <p>
                        Siempre que el usuario facilite sus datos de car??cter personal a EDICIONES MAYO, el usuario consiente el tratamiento de los mismos en los t??rminos que se
                        exponen aqu?? en forma de extracto y de forma detallada en la Pol??tica de Privacidad (documento completo). La Pol??tica de Privacidad deber?? ser aceptada con
                        car??cter previo y expreso por el usuario antes de que ??ste pueda remitir los datos personales a EDICIONES MAYO y ??sta ejecutar la acci??n para la cual se
                        precisan los datos personales solicitados.
                    </p>
                    <p>
                        Con car??cter general, cuando un usuario facilita sus datos personales a trav??s del SITIO WEB, EDICIONES MAYO los trata e incorpora en los procesos de
                        tratamiento de datos de responsabilidad de EDICIONES MAYO cuya finalidad ser?? la indicada en cada momento asociada al formulario de solicitud de datos y en
                        el apartado Finalidades de la Pol??tica de Privacidad. La Pol??tica de Privacidad aplicada por EDICIONES MAYO est?? sujeta al Reglamento General 2016/679, 27
                        de abril 2016 del Parlamento Europeo y del Consejo, relativo a la protecci??n de las personas f??sicas en lo que respecta al tratamiento de datos personales
                        y a la libre circulaci??n de estos datos (Reglamento General de Protecci??n de Datos, RGPD) y a la Ley Org??nica 3/2018, de 5 de diciembre de 2018, de Protecci??n
                        de Datos Personales y Garant??a de los Derechos Digitales (LOPDGDD).
                    </p>
                    <p>
                        El usuario puede ejercitar los derechos de acceso, rectificaci??n, supresi??n (olvido), oposici??n, limitaci??n y portabilidad de los datos contenidos en dicho
                        tratamiento. Para ello, rogamos lo comunique mediante un correo electr??nico a la direcci??n
                        <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a> indicando la referencia
                        "Protecci??n de Datos". El usuario deber?? aportar la documentaci??n acreditativa de su identidad.
                    </p>
                    <p>
                        Los datos ser??n conservados mientras se desarrolle la finalidad por la que fueron comunicados o mientras est?? vigente el consentimiento de su titular. De
                        cancelarse el consentimiento o bien terminarse la finalidad, los datos ser??n conservados bloqueados hasta que prescriban las obligaciones legales que puedan
                        aplicarse sobre ??stos. Vencidas las mismas los datos ser??n borrados de los sistemas de tratamiento.
                    </p>
                    <p>
                        EDICIONES MAYO garantiza que tratar?? confidencialmente sus datos personales, asimismo, el servidor en el que se almacenan los datos goza de las medidas de
                        seguridad necesarias para evitar el acceso a dichos datos por parte de terceros no autorizados y se encuentra ubicado en territorio de la Uni??n Europea.
                    </p>
                    <p>
                        La Autoridad de Control competente en materia de protecci??n de datos es Agencia Espa??ola de Protecci??n de Datos, c/ Jorge Juan, n??6, Madrid, 28001.
                    </p>
                    <p>
                        El usuario puede conocer los proveedores de servicios de EDICIONES MAYO prestan actividades en tanto que Encargados de Tratamiento en nuestra Pol??tica de Privacidad.
                    </p>
                    <br>


                    <h3 class="pt-2 text-left noMarge">6. LIMITACI??N DE GARANT??AS Y RESPONSABILIDADES </h3>
                    <p>
                        EDICIONES MAYO no controla ni garantiza la ausencia de virus ni de otros elementos en los contenidos que puedan producir alteraciones en tu sistema inform??tico
                        (software y hardware) o en los documentos electr??nicos y ficheros almacenados en tu sistema inform??tico. EDICIONES MAYO excluye cualquier responsabilidad por
                        los da??os y perjuicios de toda naturaleza que puedan deberse a la presencia de virus o a la presencia de otros elementos en los contenidos que puedan producir
                        alteraciones en los sistemas inform??ticos, documentos electr??nicos o ficheros de los usuarios.
                    </p>
                    <p>
                        EDICIONES MAYO har?? lo posible para garantizar la seguridad de la informaci??n que sea facilitada por los usuarios. No obstante, no puede garantizar que las
                        transmisiones de informaci??n sean totalmente seguras.
                    </p>
                    <p>
                        Sin perjuicio de los niveles de seguridad de protecci??n, los datos de car??cter personal legalmente requeridos, la instalaci??n de todos los medios y medidas
                        t??cnicas a su alcance para evitar la p??rdida, mal uso, alteraci??n, acceso no autorizado y robo de los datos facilitados, el usuario sabe y conoce que la
                        seguridad en el entorno de Internet no puede ser garantizada al cien por cien.
                    </p>
                    <p>
                        EDICIONES MAYO excluye cualquier responsabilidad por los da??os y perjuicios de toda naturaleza que puedan deberse a la falta de veracidad, exactitud, exhaustividad
                        y/o actualidad de los contenidos del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">7. DERECHOS DE AUTOR, PROPIEDAD INTELECTUAL E INDUSTRIAL </h3>
                    <p>
                        La mayor??a de los contenidos del SITIO WEB <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. son de propiedad exclusiva y mundial de EDICIONES MAYO incluyendo, sin limitaci??n, informaciones,
                        mensajes, entrevistas, opiniones, comentarios gr??ficos, archivos de sonido y/o imagen, v??deos, fotograf??as, im??genes, ilustraciones, m??sica, feel & look,
                        software, marcas, logos y otros signos distintivos, nombres, obras cient??ficas, casos cl??nicos, estudios cient??ficos, estad??sticas (entre otros), en
                        cualquiera de los lenguajes de programaci??n utilizados o utilizables, as?? como todo el software de funcionamiento y desarrollo del SITIO WEB. En el resto
                        de supuestos, los contenidos han sido debidamente licenciados a EDICIONES MAYO por sus propietarios. En cualquier caso, la reproducci??n, distribuci??n,
                        comunicaci??n al p??blico, puesta a disposici??n al p??blico, cesi??n y cualquier otro acto o modalidad de explotaci??n que no haya sido expresamente autorizada
                        por el propietario a EDICIONES MAYO o por el titular de los derechos de explotaci??n quedan expresamente prohibidos.
                    </p>
                    <p>
                        EDICIONES MAYO no concede ninguna licencia o autorizaci??n de uso de ninguna clase sobre sus derechos de propiedad intelectual e industrial ni sobre los derechos
                        cedidos ni sobre cualquier otra propiedad o derecho relacionado con el SITIO WEB y los servicios ofrecidos.
                    </p>
                    <p>
                        Todas las marcas y denominaciones de servicios que aparecen en el SITIO WEB son marcas registradas y de propiedad de EDICIONES MAYO. En el resto de los casos
                        son marcas licenciadas a EDICIONES MAYO por sus titulares leg??timos.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">8. REDES SOCIALES texto aplicable en caso de redes sociales </h3>
                    <p>
                        Desde el SITIO WEB, el usuario interesado puede acceder a publicaciones de ??????????????? de EDICIONES MAYO. Sin embargo, la informaci??n publicada a trav??s de esta rede
                        social est?? sujeta a las normas establecidas por la propia red social y las presentes Condiciones Generales ??nicamente regulan el contenido SITIO WEB.
                    </p>
                    <p>
                        Cualquier otro enlace del SITIO WEB que redirija al usuario a otro sitio web que no sea <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                        no es responsabilidad de EDICIONES MAYO.
                        Estos enlaces est??n en el SITIO WEB con car??cter meramente informativo, pero quedan a la discrecionalidad del usuario clicar en ellos y consultar estos otros sitios web.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">9. NAVEGACI??N CON COOKIES </h3>
                    <p><strong>??Qu?? son las cookies?</strong></p>
                    <p>
                        Las cookies son archivos que se pueden descargar en su equipo a trav??s de las p??ginas web y cumplen un papel fundamental en la prestaci??n de numerosos servicios
                        de la sociedad de la informaci??n. Entre otros, permiten a una p??gina web almacenar y recuperar informaci??n sobre los h??bitos de navegaci??n de un usuario o de
                        su equipo y, dependiendo de la informaci??n obtenida, se pueden utilizar para reconocer al usuario y mejorar el servicio ofrecido. En cumplimiento de la
                        Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Informaci??n y de Comercio Electr??nico (LSSI), el RGPD y la LOPDGDD, a continuaci??n de informamos
                        sobre las cookies que se utilizan en el SITIO WEB, seg??n su gestor, finalidad o duraci??n.
                    </p>
                    <p>
                        Las cookies que se utilizan en el sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> son:
                    </p>
                    <p class="" style="color: #8cb7d8 !important; font-weight: bold;">Seg??n qui??n gestione la cookie</p>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #8cb7d8 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #8cb7d8 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #8cb7d8 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies Propias
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que se env??an al equipo terminal del usuario desde un equipo o dominio gestionado por el propio editor y desde el que se
                                    presta el servicio solicitado por el usuario.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #8cb7d8 !important;  width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #8cb7d8 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #8cb7d8 !important;  width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies de Terceros
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que se env??an al equipo terminal del usuario desde un equipo o dominio que no es gestionado por el editor, sino que otra entidad.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>

                    <br>
                    <p class="" style="color: #f9e0a9 !important; font-weight: bold;">Seg??n la finalidad que tenga la cookie</p>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #f9e0a9 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies t??cnicas
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten al usuario la navegaci??n a trav??s de una p??gina web, plataforma, aplicaci??n y la utilizaci??n de las diferentes opciones o
                                    servicios que en ella existan. Permiten controlar el tr??fico y la comunicaci??n de datos, identificar la sesi??n, acceder a partes de acceso
                                    restringido, recordar elementos que integran un pedido, realizar un proceso de compra, gestionar el pago, contar visitas a efectos de facturaci??n.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #f9e0a9 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies de preferencias o personalizaci??n
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten recordar la informaci??n para que el usuario acceda al servicio con determinadas caracter??sticas que puedan diferenciar
                                    su experiencia de la de otros usuarios (idioma, n??mero de resultados cuando un usuario realiza una b??squeda)
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #f9e0a9 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies de an??lisis o mediaci??n
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten al responsable de las mismas el seguimiento y an??lisis del comportamiento de los usuarios de los sitios web a los que
                                    est??n vinculadas, incluida la cuantificaci??n de los impactos de los anuncios. Se utilizan con el fin de introducir mejoras en funci??n del
                                    an??lisis de los datos d uso del servicio por parte de los usuarios.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>


                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #f9e0a9 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies de publicidad comportamental
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que almacenan informaci??n del comportamiento de los usuarios obtenida a trav??s de la observaci??n continuada de sus h??bitos de
                                    navegaci??n, lo que permite desarrollar un perfil espec??fico para mostrar publicidad.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>


                    <br>
                    <p class="" style="color: #c97c7c !important; font-weight: bold;">Plazo de tiempo que una cookie permanece activada</p>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #c97c7c !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #c97c7c !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #c97c7c !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies de sesi??n
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas dise??adas para recabar y almacenar datos mientras el usuario accede a la p??gina web. Se utilizan para almacenar informaci??n que solo
                                    interesa conservar para la prestaci??n del servicio solicitado por el usuario.
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #c97c7c !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #c97c7c !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #c97c7c !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies temporales y persistentes
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas en las que los datos siguen almacenados en el terminal y pueden ser accedidos y tratados durante un periodo definido por el responsable
                                    de la cookie y que puede variar entre minutos y varios a??os
                                </p>
                            </td>
                            <td>
                                <p>
                                    &nbsp;
                                </p>
                            </td>
                        </tr>
                    </table>
                    <br>

                    <p><strong>Indica si est??s de acuerdo o no con la Pol??tica de Cookies</strong></p>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class=""><strong>Personaliza tus preferencias</strong></th>
                            <th class="" style="color:orange">Si</th>
                            <th class="" style="color:red">N0</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies propias
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies de terceros
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies t??cnicas
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies de preferencias o personalizaci??n
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies de an??lisis o medici??n
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies de publicidad comportamental
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies de sesi??n
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Cookies persistentes
                                </p>
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                            <td>
                                <input type="checkbox" />
                            </td>
                        </tr>
                    </table>
                    <br>

                    <h3 class="pt-2 text-left noMarge">10. LEY Y JURISDICCI??N</h3>
                    <p>
                        Las presentes Condiciones Generales, as?? como cualquier relaci??n entre usted como Usuario y EDICIONES MAYO, se regir??n por la legislaci??n espa??ola.
                    </p>
                    <p>
                        Para cualquier cuesti??n litigiosa derivada de la existencia o contenido de estas Condiciones Generales o de las relaciones entre el Usuario y EDICIONES MAYO,
                        ambas partes, con renuncia expresa a cualquier otro fuero que les pudiera corresponder, se someten expresamente a la jurisdicci??n y competencia exclusiva de
                        los Juzgados y Tribunales de la Ciudad de Barcelona.
                    </p>
                    <br>

                </article>
                <p class="small">??ltima actualizaci??n: julio de 2020</p>
            </main>
        </section>
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
