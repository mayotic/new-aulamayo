<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/cms/core.php';
AutoIncludes::loadController();

Tools::loadTemplatePart('header');
Tools::loadTemplatePart('menu-login');

?>
    <div id='main'>
      <article class="container">

        <?php
        if (Tools::deviceCompatible()) : ?>
        <form class="form-signin">
              <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
              <h1 class="h3 mb-3 font-weight-normal">Autentificación</h1>
              <label for="inputEmail" class="sr-only">Dirección de correo</label>
              <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
              <label for="inputPassword" class="sr-only">Contraseña</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="">
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Recuérdame
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
              <!-- <p class="mt-5 mb-3 text-muted"></p> -->
        </form>
      <?php else: ?>
        <div class="row">
          <div class="col-md-12 text-center" style="padding: 25px;">
            <!-- <h1>Your operating system or browser is not compatible with this website.</h1> -->
            <h1>Es6amos actualizando la página. Volvemos en seguida</h1>
          </div>
        </div>
      <?php endif; ?>

      </article>
    </div>
    <?php
      Tools::loadTemplatePart('footer');
      ?>
  </body>
  <script type="text/javascript">
    window.url_home = '<?=$conf['appinfo']['url_home']?>';
  </script>
</html>
