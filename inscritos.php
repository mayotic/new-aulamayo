<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
AutoIncludes::loadController();

    // Header and menu templates
    Tools::loadTemplatePart('header');
    Tools::loadTemplatePart('menu');

?>
    <div id='main'>
      <article class="container">

        <?php Tools::loadTemplatePart('dropzone'); ?>

        <div class="xcrud-top-actions btn-group regresar">
          <a href="/delegados" class="btn btn-outline-info">
            <i class="fas fa-angle-left"></i>&nbsp; Regresar
          </a>
        </div>

        <div class="row grid crud">
          <div class="col-md-12">
            <?=$tdata['content']?>
          </div>
        </div>
      </article>
    </div>

    <?php
      Tools::loadTemplatePart('footer');
      ?>

    <script type="text/javascript">

      window.user = eval(<?=$tdata['userlogedin']?>);
      window.etipo_max = {<?=EVENTO_TIPO_CAFE?>: <?=EVENTO_MAX_CAFES?>};
      window.etipo_max['<?=EVENTO_TIPO_TALLER?>'] = <?=EVENTO_MAX_TALLERES?>;
      window.tipo_delegado = '<?=$appconf['tipo_delegado']?>';

      Dropzone.options.Documents = {
        init: function() {
          this.on("success", function(response) {
            if(response.status == 'success') {
              getDocumentsList($('input[name=primary]').val());
              console.log(window.maildocsend);
              if (typeof window.maildocsend == 'undefined') {
                // $.post('enviarmaildocumentacion.php', {apellido1: apellido1, apellido2: apellido2, nombre: nombre, email: email, delegado: delegado}, function (data) {
                //   //console.log(data);
                // });
                window.maildocsend = true;
              }
            }
          });
        }
      };
    </script>

  </body>
</html>
