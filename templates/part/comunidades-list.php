<!-- Wrapper template -->
<template class="wrapper" data-parent="#comunidades-list"  data-template="wrapper">
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="5%" class="" scope="col">#</th>
        <th width="65%" data-sortable="1" data-sorted="ASC" data-field="comunidad" scope="col"><a href="#">Comunidad</a></th>
        <th width="35%" data-sortable="1" data-sorted="" data-field="pais" scope="col"><a href="#">Pais</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          {{content}}
        </td>
    </tr>
    </tbody>
  </table>
</template>

<!-- Row template -->
<template class="row" data-parent="#comunidades-list"  data-template="row">
    <tr>
      <th data-key="{{id_comunidad}}" scope="row">{{row}}</th>
      <td>
        <a class="" href="#" title="Comunidad" data-toggle="modal" data-target="#edit-modal" data-primary="{{id_comunidad}}">
          {{comunidad}}
        </a>
      </td>
      <td>{{pais}}</td>
    </tr>
</template>
