
<!-- Templates for profesiones select -->
<template class="wrapper" data-parent="#poblaciones-select" data-template="wrapper">
    <select name="poblacion" id="poblacion"  class="custom-select selectpicker" required>
        <option value="" selected><?= Tools::_t('seleccione_poblacion') ?></option>
        {{content}}
    </select>
</template>

<template class="row" data-parent="#poblaciones-select" data-template="row">
    <option value="{{id_localidad}}">{{nombre}}</option>
</template>
