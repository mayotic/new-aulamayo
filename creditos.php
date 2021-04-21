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
                                <li class="breadcrumb-item active breadcrumb-text" aria-current="page"><?=mb_strtoupper($_l['creditos'])?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-left">
            <div class="container p-4 ">
                <h3 class="mb-3">
                    <?php  echo mb_strtoupper($_l['creditos']); ?>
                </h3>

                <div class="row">
                    <div class="col-md-12 mt-3 mb-1">
                        <p class="mb-4">
                            El uso de este sitio web y sus diferentes secciones (administradas por Ediciones Mayo, S.A.) está supeditado a la legislación vigente y a la aceptación
                            íntegra de los términos, condiciones y comunicaciones contenidos en el presente documento que suscribe Ediciones Mayo, S.A., inscrita en el Registro
                            Mercantil de Barcelona, tomo 8179, libro 4489, sección 2.ª, folio 90, hoja 54194, inscripción 1.ª 13-04-83, con CIF A-08735045 y domicilio social en la
                            calle Aribau, 185-187, 2ª planta, 08021 Barcelona.
                        </p>
                        <p class="text-center">
                            <a href="https://www.edicionesmayo.es" target="_blank" style="color:#17a2b8; text-decoration:none;">www.edicionesmayo.es</a><br>
                            <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a><br>
                            Aribau, 185-187, 2ª planta, 08021, 08036 Barcelona<br>
                            Tel.: +34 932 090 255 - Fax: +34 932 020 643<br>
                            López de Hoyos, 286, bajos B, 28043 Madrid<br>
                            Tel.: +34 914 115 800 - Fax: +34 915 159 693<br><br>
                        </p>
                        <p>
                            En cumplimiento del Capítulo II de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE),
                            los informamos de que la presente página web es propiedad de Ediciones Mayo, S.A., de ahora en adelante también el prestador, domiciliada en la calle
                            Aribau, 185-187, 2ª planta, 08021, 08036 Barcelona, con CIF A-08735045, teléfono de contacto 932 090 255 y correo electrónico
                            <a href="mailto:edmayo@edicionesmayo.es" style="color:#17a2b8; text-decoration:none;">edmayo@edicionesmayo.es</a>
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
