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
                                Domicilio: calle Aribau, 185-187, 2ª planta, 08021, Barcelona
                                <br>
                                Teléfono de contacto: + 34 932 090 255
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
                                <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> es una página web que presenta la posibilidad de …………………………
                            </td>
                        </tr>
                    </table>
                    <br>
                    <h3 class="text-left noMarge">1. CONDICIONES GENERALES </h3>
                    <p>
                        Estas Condiciones Generales regulan el funcionamiento de los servicios del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. que EDICIONES MAYO pone a disposición de los usuarios
                        interesados. La utilización del SITIO WEB atribuye la condición de usuario y supone la aceptación plena y sin reservas de todas y cada una de las presente
                        Condiciones Generales. Si el usuario no está de acuerdo con las Condiciones Generales, no tendrá derecho a utilizar el SITIO WEB ni los servicios que ofrece.
                        Si el usuario desea registrarse en el sitio web o realizar alguno de los cursos, webinars, simposiums, congresos, formación acreditada, formación online y
                        presencial (entre otros) deberá aceptar la Política de Privacidad y se entiende que acepta las presentes Condiciones Generales.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">2. ACCESO Y USO DEL SITIO WEB ES GRATUITO </h3>
                    <p>
                        La prestación de los servicios del SITIO WEB por parte de EDICIONES MAYO al usuario tiene carácter gratuito y no exige la previa suscripción ni registro, a
                        menos que el usuario decida registrarse o bien realizar alguno de los cursos, webinars, simposiums, congresos, formación acreditada, formación online y
                        presencial (entre otros) de los que se ofrecen en el SITIO WEB.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">3. MODIFICACIONES EN EL SITIO WEB Y LOS SERVICIOS </h3>
                    <p>
                        EDICIONES MAYO se reserva el derecho a modificar unilateralmente y en cualquier momento, sin previo aviso, la presentación o configuración del SITIO WEB, así como
                        los servicios ofrecidos y las Condiciones Generales. Dichas modificaciones serán para mejorar los servicios y la oferta de servicios al usuario, según las
                        tendencias de mercado, mejorar y/o actualizar el SITIO WEB y adecuarse a la normativa aplicable en cada momento.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">4. USO CORRECTO DEL SITIO WEB Y DE LOS SERVICIOS </h3>
                    <p>
                        El usuario se compromete a utilizar el SITIO WEB, los contenidos y los servicios de conformidad a la Ley, a las presentes Condiciones Generales, a las buenas
                        costumbres y al orden público. De la misma forma, el usuario se obliga a no utilizar el sitio
                        <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>, el contenido y los servicios que se ofrecen en
                        éste con fines o efectos ilícitos, contrarios al contenido de estas Condiciones Generales, lesivas de los derechos e intereses de terceros o, que de cualquier
                        forma, puedan dañar, inutilizar, sobrecargar o deteriorar el SITIO WEB, su contenido o los servicios o impedir la normal utilización o disfrute del SITIO WEB
                        por otros usuarios.
                    </p>
                    <p>
                        El usuario deberá abstenerse de obtener otros informaciones, mensajes, entrevistas, opiniones, comentarios gráficos, archivos de sonido y/o imagen, vídeos,
                        fotografías, imágenes, ilustraciones, música, feel & look, software, marcas, logos y otros signos distintivos, nombres, obras científicas, casos clínicos,
                        estudios científicos, estadísticas (entre otros) y, en general, cualquier clase de material accesible a través del SITIO WEB o de los servicios, empleando
                        para ello medios distintos de los que se hayan puesto a su disposición, o en general, de los que se empleen habitualmente en Internet.
                    </p>
                    <p>
                        El usuario deberá abstenerse de manipular datos identificativos de EDICIONES MAYO, así como el contenido y los servicios que se ofrecen en el SITIO WEB.
                    </p>
                    <p>
                        El usuario deberá abstenerse de manipular los dispositivos técnicos de protección de contenidos o de información, y en general de configuración de los espacios del SITIO WEB.
                    </p>
                    <p>
                        EDICIONES MAYO se reserva el derecho de denegar el acceso a la página web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                        en cualquier momento y sin necesidad de previo aviso a aquellos usuarios que incumplan estas Condiciones Generales.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">5. POLÍTICA DE PRIVACIDAD </h3>
                    <p>
                        Siempre que el usuario facilite sus datos de carácter personal a EDICIONES MAYO, el usuario consiente el tratamiento de los mismos en los términos que se
                        exponen aquí en forma de extracto y de forma detallada en la Política de Privacidad (documento completo). La Política de Privacidad deberá ser aceptada con
                        carácter previo y expreso por el usuario antes de que éste pueda remitir los datos personales a EDICIONES MAYO y ésta ejecutar la acción para la cual se
                        precisan los datos personales solicitados.
                    </p>
                    <p>
                        Con carácter general, cuando un usuario facilita sus datos personales a través del SITIO WEB, EDICIONES MAYO los trata e incorpora en los procesos de
                        tratamiento de datos de responsabilidad de EDICIONES MAYO cuya finalidad será la indicada en cada momento asociada al formulario de solicitud de datos y en
                        el apartado Finalidades de la Política de Privacidad. La Política de Privacidad aplicada por EDICIONES MAYO está sujeta al Reglamento General 2016/679, 27
                        de abril 2016 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales
                        y a la libre circulación de estos datos (Reglamento General de Protección de Datos, RGPD) y a la Ley Orgánica 3/2018, de 5 de diciembre de 2018, de Protección
                        de Datos Personales y Garantía de los Derechos Digitales (LOPDGDD).
                    </p>
                    <p>
                        El usuario puede ejercitar los derechos de acceso, rectificación, supresión (olvido), oposición, limitación y portabilidad de los datos contenidos en dicho
                        tratamiento. Para ello, rogamos lo comunique mediante un correo electrónico a la dirección
                        <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a> indicando la referencia
                        "Protección de Datos". El usuario deberá aportar la documentación acreditativa de su identidad.
                    </p>
                    <p>
                        Los datos serán conservados mientras se desarrolle la finalidad por la que fueron comunicados o mientras esté vigente el consentimiento de su titular. De
                        cancelarse el consentimiento o bien terminarse la finalidad, los datos serán conservados bloqueados hasta que prescriban las obligaciones legales que puedan
                        aplicarse sobre éstos. Vencidas las mismas los datos serán borrados de los sistemas de tratamiento.
                    </p>
                    <p>
                        EDICIONES MAYO garantiza que tratará confidencialmente sus datos personales, asimismo, el servidor en el que se almacenan los datos goza de las medidas de
                        seguridad necesarias para evitar el acceso a dichos datos por parte de terceros no autorizados y se encuentra ubicado en territorio de la Unión Europea.
                    </p>
                    <p>
                        La Autoridad de Control competente en materia de protección de datos es Agencia Española de Protección de Datos, c/ Jorge Juan, nº6, Madrid, 28001.
                    </p>
                    <p>
                        El usuario puede conocer los proveedores de servicios de EDICIONES MAYO prestan actividades en tanto que Encargados de Tratamiento en nuestra Política de Privacidad.
                    </p>
                    <br>


                    <h3 class="pt-2 text-left noMarge">6. LIMITACIÓN DE GARANTÍAS Y RESPONSABILIDADES </h3>
                    <p>
                        EDICIONES MAYO no controla ni garantiza la ausencia de virus ni de otros elementos en los contenidos que puedan producir alteraciones en tu sistema informático
                        (software y hardware) o en los documentos electrónicos y ficheros almacenados en tu sistema informático. EDICIONES MAYO excluye cualquier responsabilidad por
                        los daños y perjuicios de toda naturaleza que puedan deberse a la presencia de virus o a la presencia de otros elementos en los contenidos que puedan producir
                        alteraciones en los sistemas informáticos, documentos electrónicos o ficheros de los usuarios.
                    </p>
                    <p>
                        EDICIONES MAYO hará lo posible para garantizar la seguridad de la información que sea facilitada por los usuarios. No obstante, no puede garantizar que las
                        transmisiones de información sean totalmente seguras.
                    </p>
                    <p>
                        Sin perjuicio de los niveles de seguridad de protección, los datos de carácter personal legalmente requeridos, la instalación de todos los medios y medidas
                        técnicas a su alcance para evitar la pérdida, mal uso, alteración, acceso no autorizado y robo de los datos facilitados, el usuario sabe y conoce que la
                        seguridad en el entorno de Internet no puede ser garantizada al cien por cien.
                    </p>
                    <p>
                        EDICIONES MAYO excluye cualquier responsabilidad por los daños y perjuicios de toda naturaleza que puedan deberse a la falta de veracidad, exactitud, exhaustividad
                        y/o actualidad de los contenidos del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">7. DERECHOS DE AUTOR, PROPIEDAD INTELECTUAL E INDUSTRIAL </h3>
                    <p>
                        La mayoría de los contenidos del SITIO WEB <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. son de propiedad exclusiva y mundial de EDICIONES MAYO incluyendo, sin limitación, informaciones,
                        mensajes, entrevistas, opiniones, comentarios gráficos, archivos de sonido y/o imagen, vídeos, fotografías, imágenes, ilustraciones, música, feel & look,
                        software, marcas, logos y otros signos distintivos, nombres, obras científicas, casos clínicos, estudios científicos, estadísticas (entre otros), en
                        cualquiera de los lenguajes de programación utilizados o utilizables, así como todo el software de funcionamiento y desarrollo del SITIO WEB. En el resto
                        de supuestos, los contenidos han sido debidamente licenciados a EDICIONES MAYO por sus propietarios. En cualquier caso, la reproducción, distribución,
                        comunicación al público, puesta a disposición al público, cesión y cualquier otro acto o modalidad de explotación que no haya sido expresamente autorizada
                        por el propietario a EDICIONES MAYO o por el titular de los derechos de explotación quedan expresamente prohibidos.
                    </p>
                    <p>
                        EDICIONES MAYO no concede ninguna licencia o autorización de uso de ninguna clase sobre sus derechos de propiedad intelectual e industrial ni sobre los derechos
                        cedidos ni sobre cualquier otra propiedad o derecho relacionado con el SITIO WEB y los servicios ofrecidos.
                    </p>
                    <p>
                        Todas las marcas y denominaciones de servicios que aparecen en el SITIO WEB son marcas registradas y de propiedad de EDICIONES MAYO. En el resto de los casos
                        son marcas licenciadas a EDICIONES MAYO por sus titulares legítimos.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">8. REDES SOCIALES texto aplicable en caso de redes sociales </h3>
                    <p>
                        Desde el SITIO WEB, el usuario interesado puede acceder a publicaciones de …………… de EDICIONES MAYO. Sin embargo, la información publicada a través de esta rede
                        social está sujeta a las normas establecidas por la propia red social y las presentes Condiciones Generales únicamente regulan el contenido SITIO WEB.
                    </p>
                    <p>
                        Cualquier otro enlace del SITIO WEB que redirija al usuario a otro sitio web que no sea <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                        no es responsabilidad de EDICIONES MAYO.
                        Estos enlaces están en el SITIO WEB con carácter meramente informativo, pero quedan a la discrecionalidad del usuario clicar en ellos y consultar estos otros sitios web.
                    </p>
                    <br>

                    <h3 class="pt-2 text-left noMarge">9. NAVEGACIÓN CON COOKIES </h3>
                    <p><strong>¿Qué son las cookies?</strong></p>
                    <p>
                        Las cookies son archivos que se pueden descargar en su equipo a través de las páginas web y cumplen un papel fundamental en la prestación de numerosos servicios
                        de la sociedad de la información. Entre otros, permiten a una página web almacenar y recuperar información sobre los hábitos de navegación de un usuario o de
                        su equipo y, dependiendo de la información obtenida, se pueden utilizar para reconocer al usuario y mejorar el servicio ofrecido. En cumplimiento de la
                        Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI), el RGPD y la LOPDGDD, a continuación de informamos
                        sobre las cookies que se utilizan en el SITIO WEB, según su gestor, finalidad o duración.
                    </p>
                    <p>
                        Las cookies que se utilizan en el sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> son:
                    </p>
                    <p class="" style="color: #8cb7d8 !important; font-weight: bold;">Según quién gestione la cookie</p>
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
                                    Son aquellas que se envían al equipo terminal del usuario desde un equipo o dominio gestionado por el propio editor y desde el que se
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
                                    Son aquellas que se envían al equipo terminal del usuario desde un equipo o dominio que no es gestionado por el editor, sino que otra entidad.
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
                    <p class="" style="color: #f9e0a9 !important; font-weight: bold;">Según la finalidad que tenga la cookie</p>
                    <table class="tabPolitica mb-3 w-100">
                        <tr>
                            <th class="" style="background-color: #f9e0a9 !important; width:150px;">TIPO DE COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important;">FINALIDAD DE LA COOKIE</th>
                            <th class="" style="background-color: #f9e0a9 !important; width:100px;">NOMBRE DE LAS COOKIES</th>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Cookies técnicas
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten al usuario la navegación a través de una página web, plataforma, aplicación y la utilización de las diferentes opciones o
                                    servicios que en ella existan. Permiten controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso
                                    restringido, recordar elementos que integran un pedido, realizar un proceso de compra, gestionar el pago, contar visitas a efectos de facturación.
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
                                    Cookies de preferencias o personalización
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten recordar la información para que el usuario acceda al servicio con determinadas características que puedan diferenciar
                                    su experiencia de la de otros usuarios (idioma, número de resultados cuando un usuario realiza una búsqueda)
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
                                    Cookies de análisis o mediación
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas que permiten al responsable de las mismas el seguimiento y análisis del comportamiento de los usuarios de los sitios web a los que
                                    están vinculadas, incluida la cuantificación de los impactos de los anuncios. Se utilizan con el fin de introducir mejoras en función del
                                    análisis de los datos d uso del servicio por parte de los usuarios.
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
                                    Son aquellas que almacenan información del comportamiento de los usuarios obtenida a través de la observación continuada de sus hábitos de
                                    navegación, lo que permite desarrollar un perfil específico para mostrar publicidad.
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
                                    Cookies de sesión
                                </p>
                            </td>
                            <td>
                                <p>
                                    Son aquellas diseñadas para recabar y almacenar datos mientras el usuario accede a la página web. Se utilizan para almacenar información que solo
                                    interesa conservar para la prestación del servicio solicitado por el usuario.
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
                                    de la cookie y que puede variar entre minutos y varios años
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

                    <p><strong>Indica si estás de acuerdo o no con la Política de Cookies</strong></p>
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
                                    Cookies técnicas
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
                                    Cookies de preferencias o personalización
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
                                    Cookies de análisis o medición
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
                                    Cookies de sesión
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

                    <h3 class="pt-2 text-left noMarge">10. LEY Y JURISDICCIÓN</h3>
                    <p>
                        Las presentes Condiciones Generales, así como cualquier relación entre usted como Usuario y EDICIONES MAYO, se regirán por la legislación española.
                    </p>
                    <p>
                        Para cualquier cuestión litigiosa derivada de la existencia o contenido de estas Condiciones Generales o de las relaciones entre el Usuario y EDICIONES MAYO,
                        ambas partes, con renuncia expresa a cualquier otro fuero que les pudiera corresponder, se someten expresamente a la jurisdicción y competencia exclusiva de
                        los Juzgados y Tribunales de la Ciudad de Barcelona.
                    </p>
                    <br>

                </article>
                <p class="small">Última actualización: julio de 2020</p>
            </main>
        </section>
        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
