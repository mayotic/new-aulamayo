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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['politica_privacidad'])?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-left">
            <div class="container p-4 ">
                <h3 class="mb-3">
                    <?php  echo mb_strtoupper($_l['politica_privacidad']); ?>
                </h3>

                <div class="row">
                    <div class="col-md-12 mt-3 mb-1">
                        <h4>1. Presentación</h4>
                        <p>
                            A continuación, Ediciones Mayo, S.A., le informa en detalle de su política de privacidad en relación con el tratamiento de datos personales que lleva
                            a cabo en el sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. La presente política de privacidad será de aplicación desde el mismo momento en que usted facilite datos
                            personales a través del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>, utilizando para ello alguno de los formularios previstos según la finalidad para la que se solicite
                            autorización para tratar los datos.
                        </p>
                        <br>
                        <h4>2. Responsable del tratamiento</h4>
                        <p>
                            Ediciones Mayo, S.A., es la sociedad mercantil responsable del tratamiento de datos personales del sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. Sus datos de contacto son:
                        </p>

                        <p style="font-weight:600;">
                            Datos del responsable del tratamiento:
                        </p>
                        <p>Responsable: Ediciones Mayo, S.A.</p>
                        <p>Domicilio: Aribau, 185-187, 2ª planta</p>
                        <p>Ciudad: Barcelona</p>
                        <p>Código postal: 08021</p>
                        <p>Teléfono: 932 090 255</p>
                        <p>Correo electrónico: <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a></p>
                        <p>CIF: A-08735045</p>
                        <br>

                        <h4>3. Cómo se lleva a cabo el tratamiento de datos personales</h4>
                        <p style="font-weight:600;">
                            3.1. Normativa aplicable
                        </p>
                        <p>
                            El tratamiento de datos personales por parte de Ediciones Mayo, S.A., se lleva a cabo conforme a lo establecido en el Reglamento (UE), 2016/679, del
                            Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos
                            personales y a la libre circulación de estos datos y por el que se deroga la Directiva 95/46/CE (Reglamento General de Protección de Datos [RGPD]); la
                            Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y Garantía de los Derechos Digitales, por la que se deroga la Ley
                            Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (LOPD), y el Real Decreto 1720/2007, de 21 de diciembre, por el que
                            se aprueba el reglamento de desarrollo de la LOPD (vigente en aquellos artículos que no contradigan el RGPD).
                        </p>
                        <br>

                        <h4>3.2. Finalidades del tratamiento y legitimación para el tratamiento</h4>
                        <p style="font-weight:600;">
                            Finalidades
                        </p>
                        <p>
                            Según el formulario que usted remita voluntariamente a Ediciones Mayo, S.A., sus datos personales serán tratados para finalidades bien diferenciadas.
                            Con carácter general, sus datos serán incorporados a nuestros sistemas de información con el fin de realizar las gestiones comerciales y administrativas
                            necesarias con los usuarios de la web.
                        </p>

                        <table class="tabPolitica mb-3">
                            <tr>
                              <th>Finalidad</th>
                              <th>Tratamiento</th>
                            </tr>
                            <tr>
                              <td>Contacto/atención de consultas</td>
                              <td>Sus datos personales serán tratados por Ediciones Mayo, S.A., para responder a las consultas y proporcionar informaciones requeridas por usted</td>
                            </tr>
                            <tr>
                              <td>Registro</td>
                              <td>Sus datos personales serán tratados por Ediciones Mayo, S.A., para gestionar y mantener activa su alta en el sitio web como usuario registrado con
                                  el fin de que pueda disponer de las ventajas que este registro implica
                              </td>
                            </tr>
                            <tr>
                              <td>Newsletter</td>
                              <td>Sus datos personales serán tratados por Ediciones Mayo, S.A., para remitirle el boletín de noticias de la página web</td>
                            </tr>
                            <tr>
                              <td>Suscripción al blog</td>
                              <td>Sus datos personales serán tratados para gestionar su suscripción al blog informativo con aviso de actualización</td>
                            </tr>
                            <tr>
                              <td>Participación en foros</td>
                              <td>Los datos aportados por usted serán tratados para regular la participación en el foro en el que usted hubiera elegido participar</td>
                            </tr>
                            <tr>
                              <td>Publicación de su testimonio</td>
                              <td>Los datos aportados por usted serán tratados para atender las sugerencias propuestas, experiencias u opiniones respecto a los productos
                                  y/o servicios para ser publicadas en la página web y así poder ayudar a otros usuarios
                              </td>
                            </tr>
                        </table>
                        <br>
                        <p style="font-weight:600;">
                            Legitimación
                        </p>
                        <p>
                            Para cada uno de los tratamientos la base legal es distinta:
                        </p>
                        <table class="tabPolitica mb-3">
                            <tr>
                              <th>Finalidad</th>
                              <th>Legitimación</th>
                            </tr>
                            <tr>
                              <td>Contacto/atención de consultas</td>
                              <td>
                                  El tratamiento de sus datos personales es necesario para poder atender la consulta que presente un usuario en particular<br><br>
                                  Si la consulta es sobre la página web, la legitimación es la aceptación de la política de privacidad que ha aceptado en el
                                  momento previo a remitir la consulta y las condiciones de uso de la página web<br><br>
                                  Si la consulta es sobre cualquier otro asunto no directamente relacionado con la página web, pero dentro del contexto del contenido
                                  de la publicación online <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>, la legitimación es la aceptación de la política de privacidad que ha aceptado en el momento
                                  previo a remitir la consulta y las condiciones de uso de la página web
                              </td>
                            </tr>
                            <tr>
                              <td>Registro</td>
                              <td>El tratamiento de sus datos personales es necesario con el fin de mantener activa su alta como usuario registrado en el sitio web
                                  <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>. Los datos los habrá facilitado usted voluntariamente a través del formulario previsto para este fin<br><br>
                                  El tratamiento de sus datos personales es necesario para poder gestionar a su favor las ventajas de ser usuario registrado del sitio web<br><br>
                                  La legitimación del presente tratamiento se formaliza en el momento en que usted, antes de remitir el formulario con sus datos personales,
                                  acepta de forma expresa la política de privacidad
                              </td>
                            </tr>
                            <tr>
                              <td>Newsletter</td>
                              <td>
                                  El tratamiento de datos personales es necesario con el fin de poder realizar el envío de la newsletter y cumplir con el mandato que usted nos
                                  ha dado cuando nos ha remitido el formulario de suscripción a la newsletter con sus datos personales y aceptando de forma expresa la política de privacidad
                              </td>
                            </tr>
                            <tr>
                              <td>Suscripción al blog*</td>
                              <td>
                                  El tratamiento de datos personales es necesario con el fin de poder gestionar su participación en el blog. La legitimación del presente tratamiento se activa
                                  desde el momento en que usted acepta de forma expresa la presente política de privacidad
                              </td>
                            </tr>
                            <tr>
                              <td>Participación en foros*</td>
                              <td>
                                  El tratamiento de datos personales es el necesario y mínimo con el fin de poder gestionar su participación en el foro que usted haya elegido. La legitimación del
                                  presente tratamiento es activa desde el momento en que usted acepta de forma expresa la presente política de privacidad<br><br>
                                  Las publicaciones se mostrarán públicamente a los usuarios del foro online
                              </td>
                            </tr>
                            <tr>
                              <td>Publicación de su testimonio*</td>
                              <td>
                                  El tratamiento de datos personales es el necesario y mínimo con el fin de poder de llevar a cabo la publicación de su testimonio en relación con un tema o producto
                                  respecto al cual se publica una información en el sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                              </td>
                            </tr>
                        </table>
                        <p style="font-size:11px;">
                            *Limitación de responsabilidad: usted decide libre y voluntariamente suscribirse al blog, participar en los foros o dar su testimonio. Ediciones Mayo, S.A., se limita a
                            publicar sus aportaciones y bajo ninguna circunstancia es responsable de los efectos y consecuencias que la publicación de su nombre, imagen y/u opinión pueda causarles a
                            usted, su familia y sus allegados, entre otros.
                        </p>

                        <br><br>
                        <h4>3.3. Cómo debe facilitar sus datos personales y qué datos personales trata Ediciones Mayo, S.A.</h4>
                        <p style="font-weight:600;">
                            Cómo debe facilitar sus datos personales
                        </p>
                        <p>
                            Usted garantiza la veracidad de los datos aportados y se compromete a comunicar cualquier cambio que se produzca en los mismos.
                        </p>
                        <p>
                            Ediciones Mayo, S.A., mediante un asterisco (*) en las casillas correspondientes de los distintos formularios, le informa a usted de esta obligatoriedad, indicando qué datos
                            es necesario proporcionar. Mediante la indicación e introducción de los datos, usted otorga el consentimiento inequívoco a Ediciones Mayo, S.A., para que proceda al tratamiento
                            de los datos facilitados en pro de las finalidades mencionadas. El no facilitar los datos personales solicitados o el no aceptar la presente política de privacidad y los
                            respectivos avisos legales de privacidad correspondiente a cada uno de los formularios de registro de datos personales puede suponer la imposibilidad de que
                            Ediciones Mayo, S.A., pueda atender sus peticiones.
                        </p>
                        <p style="font-weight:600;">
                            ¿Qué datos personales trata Ediciones Mayo, S.A.?
                        </p>
                        <table class="tabPolitica mb-3">
                            <tr>
                              <th>Finalidad</th>
                              <th>Datos tratados</th>
                            </tr>
                            <tr>
                              <td>Contacto/atención de consultas</td>
                              <td>
                                    <ul>
                                        <li>De contacto: dirección de correo electrónico, nombre y apellidos, teléfono de contacto (opcional)</li>
                                    </ul>
                              </td>
                            </tr>
                            <tr>
                              <td>Registro</td>
                              <td>
                                    <ul>
                                        <li>De contacto: nombre, apellidos, dirección de correo electrónico, dirección fiscal, código postal, población fiscal</li>
                                    </ul>
                                    <ul>
                                        <li>Identificativos: nombre de usuario, DNI, contraseña</li>
                                    </ul>
                                    <ul>
                                        <li>Profesionales: profesión, especialidad, centro de trabajo, dirección profesional, código postal, población, provincia</li>
                                    </ul>
                              </td>
                            </tr>
                            <tr>
                              <td>Newsletter</td>
                              <td>
                                    <ul>
                                        <li>De contacto: dirección de correo electrónico</li>
                                    </ul>
                              </td>
                            </tr>
                            <tr>
                              <td>Suscripción al blog</td>
                              <td>
                                    <ul>
                                        <li>De contacto: dirección de correo electrónico, nombre y apellidos</li>
                                    </ul>
                              </td>
                            </tr>
                            <tr>
                              <td>Participación en foros</td>
                              <td>
                                    <ul>
                                        <li>De contacto: dirección de correo electrónico, nombre y apellidos</li>
                                    </ul>
                              </td>
                            </tr>
                            <tr>
                              <td>Publicación de su testimonio</td>
                              <td>
                                    <ul>
                                        <li>De contacto: dirección de correo electrónico, nombre y apellidos</li>
                                    </ul>
                              </td>
                            </tr>
                        </table>




                        <br><br>
                        <h4>3.4. ¿Qué derechos se pueden ejercer?</h4>
                        <table class="tabPolitica mb-3 mt-3">
                            <tr>
                              <th>Derecho</th>
                              <th>Qué me permite hacer este derecho</th>
                            </tr>
                            <tr>
                              <td>Acceso</td>
                              <td>
                                  Usted tiene derecho a que Ediciones Mayo, S.A., le confirme si está o no tratando sus datos personales y, en su caso, solicitar el acceso
                                  a estos datos, así como obtener la información sobre el tratamiento (finalidades, categorías de los datos tratados, destinatarios...)
                              </td>
                            </tr>
                            <tr>
                              <td>Rectificación</td>
                              <td>
                                  Usted tiene derecho a solicitar la rectificación de sus datos personales que sean incorrectos o inexactos
                              </td>
                            </tr>
                            <tr>
                              <td>Supresión (olvido)</td>
                              <td>
                                  Usted tiene derecho a solicitar la supresión de sus datos personales de los sistemas y procesos de tratamiento de Ediciones Mayo, S.A., cuando
                                  estos datos ya no sean necesarios para las finalidades por las cuales fueron recogidos
                              </td>
                            </tr>
                            <tr>
                              <td>Oposición</td>
                              <td>
                                  Usted puede oponerse en cualquier momento a que sus datos personales sean tratados, incluyendo la oposición a la elaboración de perfiles
                              </td>
                            </tr>
                            <tr>
                              <td>Limitación</td>
                              <td>
                                  Usted tiene derecho a solicitar que se limite el tratamiento de datos personales, por ejemplo, mientras se resuelven las aclaraciones solicitadas
                                  por usted en relación con un tratamiento de datos
                              </td>
                            </tr>
                            <tr>
                              <td>Portabilidad</td>
                              <td>
                                  Usted tiene derecho a ejercer el derecho de portabilidad de sus datos personales y, por lo tanto, a recibir sus datos personales en un formato de
                                  uso común y lectura mecánica y transmitirlos a otro responsable de su elección, sin que exista ningún impedimento por parte de Ediciones Mayo, S.A.
                              </td>
                            </tr>
                        </table>

                        <br><br>
                        <h4>3.5. ¿Qué debe hacer usted si desea ejercer alguno de los anteriores derechos?</h4>
                        <p class="mt-3">
                            Para poder ejercer los derechos anteriores, podrá dirigirse de forma totalmente gratuita mediante carta postal a:
                        </p>
                        <p>
                            <strong>Ediciones Mayo, S.A.</strong>
                        </p>
                        <p>
                            Aribau, 185-187, 2ª planta, 08021 Barcelona
                        </p>
                        <p>
                            Tel.: +34 932 090 255 - Fax: +34 932 020 643
                        </p>
                        <br>
                        <p><strong>Atención de consultas y transparencia</strong></p>
                        <p>Ediciones Mayo, S.A.</p>
                        <p>Aribau, 185-187, 2ª planta, 08021. 08036 Barcelona</p>
                        <br>

                        <p>O bien mediante mensaje de correo electrónico a: <a href="mailto:datos@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">datos@edicionesmayo.es</a></p>
                        <p>
                            Tanto si lo hace a través de correo postal como si lo hace mediante mensaje de correo electrónico, deberá indicar el derecho o los derechos que desea ejercer y deberá
                            aportar documento acreditativo fehaciente de su identidad. Una vez recibida su petición de ejercicio de derechos, Ediciones Mayo, S.A., procederá en la mayor brevedad
                            posible a atenderle debidamente y según los plazos y formas establecidos en el RGPD.
                        </p>

                        <br><br>
                        <h4>3.6. Encargados de tratamiento</h4>
                        <p class="mt-3">
                            Con el fin de que Ediciones Mayo, S.A., pueda llevar a cabo y mantener el funcionamiento de la página web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> y activada la interacción con
                            usted, si es el caso, ha contratado algunos servicios a terceros que en el marco del RGPD son encargados de tratamiento y ejecutarán los servicios para
                            el debido cumplimiento de las distintas finalidades de tratamiento de datos personales. Sus datos personales no serán cedidos a terceros.
                        </p>
                        <table class="tabPolitica mb-3 mt-3">
                            <tr>
                              <th>Encargado de tratamiento</th>
                              <th>Prestación de servicios</th>
                            </tr>
                            <tr>
                              <td>NewsletterSoft</td>
                              <td>
                                  Alquiler de software para el envío de e-mailings, newsletter
                              </td>
                            </tr>
                            <tr>
                              <td>Arsys Internet, S.L.U.</td>
                              <td>
                                  Alojamiento de servidor web
                              </td>
                            </tr>
                        </table>

                        <br><br>
                        <h4>3.7. Transferencias internacionales</h4>
                        <p class="mt-3">
                            Sus datos personales no serán objeto de transferencias internacionales, es decir, no serán cedidos ni tratados por/para terceros que se encuentren ubicados
                            fuera del territorio de la Unión Europea o bien no formen parte del Espacio Económico Europeo (EEE).
                        </p>

                        <br><br>
                        <h4>3.8. Cesiones a terceros</h4>
                        <p class="mt-3">
                            Ediciones Mayo, S.A., no cederá los datos personales a terceros, excepto por obligación legal. Sin embargo, en el caso de ser cedidos a algún tercero se
                            produciría una información previa solicitando el consentimiento expreso para tal cesión. La entidad responsable de la base de datos, así como los que
                            intervengan en cualquier fase del tratamiento y/o las entidades a quienes se los hayan comunicado –en todo caso siempre con la correspondiente autorización
                            otorgada por el usuario–, están obligados a observar el secreto profesional y a la adopción de los niveles de protección y las medidas técnicas y organizativas
                            necesarias a su alcance para garantizar la seguridad de los datos de carácter personal, evitando, dentro de lo posible, accesos no autorizados, modificaciones
                            ilícitas, sustracciones y/o la pérdida de los datos, con objeto de procurar el correspondiente nivel de seguridad de los ficheros de Ediciones Mayo, S.A., según
                            la naturaleza y sensibilidad de los datos facilitados por los usuarios del presente sitio web.
                        </p>

                        <br><br>
                        <h4>3.9. Comunicaciones comerciales por medios electrónicos</h4>
                        <p class="mt-3">
                            Usted podrá autorizarnos a que le remitamos comunicaciones comerciales por medios electrónicos cuando formalice determinados formularios. En este sentido,
                            en dichos formularios usted hallará una casilla con la indicación de que, si desea recibir informaciones comerciales de Ediciones Mayo, S.A., de sus
                            productos y/actividades debe activarla con el fin de indicar y registrar de forma expresa su autorización. Igualmente, en algunos casos hallará una segunda
                            casilla con la indicación de que, si desea recibir informaciones comerciales del patrocinador, debe activarla con el fin de indicar y registrar de forma
                            expresa su autorización para esta comunicación de sus datos a terceros.
                        </p>

                        <br><br>
                        <h4>3.10. Medidas técnicas y organizativas</h4>
                        <p class="mt-3">
                            Los datos que nos facilite se tratarán de forma confidencial. Ediciones Mayo, S.A., ha adoptado todas las medidas técnicas y organizativas y todos los niveles de
                            protección necesarios para garantizar la seguridad en el tratamiento de los datos y evitar su alteración, pérdida, robo, tratamiento o acceso no autorizado, de acuerdo
                            con el estado de la tecnología y naturaleza de los datos almacenados. Asimismo, se garantiza también que el tratamiento y el registro en ficheros, programas, sistemas o
                            equipos, locales y centros cumplen con los requisitos y condiciones de integridad y seguridad establecidos en la normativa vigente.
                        </p>

                        <br><br>
                        <h4>3.11. ¿Durante cuánto tiempo se tratarán sus datos personales y durante cuánto tiempo se conservan?</h4>
                        <p class="mt-3">
                            Ediciones Mayo, S.A., tratará con carácter general sus datos siempre que esté vigente el consentimiento otorgado por usted para un tratamiento particular
                            de datos de los anteriormente detallados.<br><br>
                            Cursando una petición por escrito de su voluntad de finalizar uno/varios tratamiento/s con indicación de cuál/es, Ediciones Mayo, S.A., suspenderá el
                            tratamiento de datos personales para los datos indicados. Si existen obligaciones legales derivadas de este tratamiento, sus datos personales permanecerán
                            bloqueados hasta que dichas obligaciones prescriban. Una vez vencidos estos plazos, sus datos personales serán debidamente borrados de los sistemas de
                            tratamiento de datos personales.
                        </p>

                        <br><br>
                        <h4>Imágenes de la página web</h4>
                        <p class="mt-3">
                            A través de esta política de privacidad lo informamos de que las fotografías que estén colgadas en la web son propiedad de Ediciones Mayo, S.A., incluyendo
                            las imágenes de los menores, para cuya obtención se habrá obtenido el consentimiento previo de los padres, tutores o representantes legales mediante la
                            firma de los formularios realizados al efecto por los centros de los cuales los menores forman parte. Sin embargo, los padres, tutores o representantes de
                            los menores, como titulares del ejercicio de los derechos de éstos, y siempre previo requerimiento formal por escrito, pueden indicar la negativa al uso de
                            la imagen del menor; en este caso, la imagen se mostrará pixelada.
                        </p>

                        <br><br>
                        <h4>Exactitud y veracidad de los datos</h4>
                        <p class="mt-3">
                            El usuario es el único responsable de la veracidad y corrección de los datos que remita a Ediciones Mayo, S.A., exonerando a Ediciones Mayo de cualquier
                            responsabilidad al respecto. Los usuarios garantizan y responden, en cualquier caso, de la exactitud, vigencia y autenticidad de los datos personales
                            facilitados, y se comprometen a mantenerlos debidamente actualizados. El usuario acepta proporcionar información completa y correcta en el formulario de
                            registro o suscripción.
                        </p>

                        <br><br>
                        <h4>Contenido de la web y enlaces («links»)</h4>
                        <p class="mt-3">
                            Ediciones Mayo, S.A., se reserva el derecho a actualizar, modificar o eliminar la información contenida en la web, pudiendo incluso limitar o no permitir
                            el acceso a la información.<br><br>
                            Ediciones Mayo, S.A., no asume ningún tipo de responsabilidad por la información contenida en las webs de terceros a las que se pueda acceder por los links
                            o enlaces desde cualquier página web propiedad de Ediciones Mayo, S.A.<br><br>
                            La presencia de links o enlaces sólo tiene finalidad informativa y en ningún caso supone ninguna sugerencia, invitación o reconocimiento sobre los mismos.
                        </p>

                        <br><br>
                        <h4>Atención de consultas y transparencia</h4>
                        <p class="mt-3">
                            Cualquier consulta relacionada con el tratamiento de datos personales que lleva a cabo Ediciones Mayo, S.A., en el marco de su página web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>
                            puede ser dirigida a:<br><br>
                            <span style="font-weight:600;">Ediciones Mayo, S.A.</span><br><br>
                            Aribau, 185-187, 2ª planta, 08021 Barcelona<br><br>
                            Tel.: +34 932 090 255<br><br>
                            Fax: +34 932 020 643<br><br>
                            Correo electrónico: <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a>
                        </p>

                        <br><br>
                        <h4>Controversias y reclamaciones</h4>
                        <p class="mt-3">
                            En cualquier momento y cuando lo considere conveniente, usted puede dirigirse a la autoridad competente en materia de protección de datos con el fin de dirimir
                            una controversia o bien presentar una reclamación:<br><br>
                            <span style="font-weight:600;">Agencia Española de Protección de Datos</span><br><br>
                            Jorge Juan, 6. 28001 Madrid<br><br>
                            <a href="https://www.agpd.es" target="_blank" style="color:#17a2b8; text-decoration:none;">http://www.agpd.es</a>
                        </p>

                        <br><br>
                        <h4>Cambios de la presente política de privacidad</h4>
                        <p class="mt-3">
                            Ediciones Mayo, S.A., se reserva el derecho a modificar la presente política de privacidad para adaptarla a novedades legislativas o jurisprudenciales.
                        </p>

                        <br><br>
                        <h4>Política de «cookies»</h4>
                        <p class="mt-3">
                            El tratamiento de datos personales a través de <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a> está asociado al uso de cookies. Le recomendamos que consulte nuestra política de cookies.
                        </p>

                        <br><br>
                        <h4>Correos comerciales</h4>
                        <p class="mt-3">
                            De acuerdo con la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSICE), Ediciones Mayo, S.A., no
                            realiza prácticas de spam; por lo tanto, no envía correos comerciales por correo electrónico que no hayan sido previamente solicitados o autorizados por
                            el usuario. En consecuencia, en cada uno de los formularios de la página web, el usuario tiene la posibilidad de dar su consentimiento expreso para recibir
                            nuestro boletín, con independencia de la información comercial puntualmente solicitada.
                        </p>

                        <br><br>
                        <h4>Legislación</h4>
                        <p class="mt-3">
                            A todos los efectos, las relaciones entre Ediciones Mayo, S.A., con los usuarios de sus servicios telemáticos, presentes en esta web, están sometidas a la
                            legislación y jurisdicción española a la que se someten expresamente las partes, siendo competentes para la resolución de todos los conflictos derivados o
                            relacionados con su uso los juzgados y tribunales de Barcelona.
                        </p>

                        <br><br>
                        <h4>Aceptación y consentimiento</h4>
                        <p class="mt-3">
                            El usuario declara haber sido informado de las condiciones sobre protección de datos de carácter personal, aceptando y consintiendo el tratamiento
                            automatizado de los mismos por parte de Ediciones Mayo, S.A., en la forma y para las finalidades indicadas en la presente política de privacidad en
                            relación con el tratamiento de datos personales en el sitio web <a href="https://www.aulamayo.com" target="_blank" style="color:#17a2b8; text-decoration:none;">www.aulamayo.com</a>.
                        </p>

                        <p></p>
                        <p></p>




                    </div>
                </div>

            </div>
        </section>

        <?php
            Tools::loadTemplatePart('footer-front');
        ?>
    </body>
</html>
