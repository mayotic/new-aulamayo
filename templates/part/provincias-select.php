
<!-- Templates for profesiones select -->
<template class="wrapper" data-parent="#provincias-select" data-template="wrapper">
    <select name="provincia" id="provincia"  class="custom-select selectpicker form-control" required>
        <option value="" selected><?= Tools::_t('seleccione_provincia') ?></option>
        {{content}}
    </select>
</template>

<template class="row" data-parent="#provincias-select" data-template="row">
    <option value="{{id_comunidad}}">{{nombre}}</option>
</template>
