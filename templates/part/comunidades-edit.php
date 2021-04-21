
<!-- Templates for comunidades edit wrapper -->
<template class="wrapper" data-parent="#comunidades-edit" data-template="wrapper">

  <form class="container" novalidate="" action="" method="POST" enctype='multipart/form-data'>
      {{content}}
  </form>

</template>

<!-- Templates for comunidades edit row -->
<template class="row" data-parent="#comunidades-edit" data-template="row">

  <div class="form-group">
      <label class="form-control-label" for="comunidad">Comunidad</label>
      <input type="text" class="form-control" name="nombre" value="{{comunidad}}" id="comunidad" autocomplete="no" required>
      <div class="valid-feedback">Correcto</div>
      <div class="invalid-feedback">Entre el nombre de la comunidad</div>
  </div>

  <div class="form-group">
      <label class="form-control-label" for="pais">Pais</label>

      <select id="paises-select"
              data-key="{{id_pais}}"
              class="form-control"
              required
              autocomplete="yes"
              name="id_pais"
              data-remote="1" 
              data-source="/ajax/paises-select.php"
              data-fields="p.id_pais, p.nombre"
              data-type="select">
      </select>

      <div class="valid-feedback">Rango correcto</div>
      <div class="invalid-feedback">Mínimo 3, máximo 5</div>
  </div>

</template>
