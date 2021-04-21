
<!-- Templates for profesiones select -->
<template class="wrapper" data-parent="#especialidades-select" data-template="wrapper">
    <select name="especialidad" id="especialidad"  class="custom-select selectpicker form-control" required>
        <option value="" selected><?= Tools::_t('seleccione_especialidad') ?></option>
        {{content}}
    </select>
</template>

<template class="row" data-parent="#especialidades-select" data-template="row">
    <option value="{{id_especialidad}}">{{nombre}}</option>
</template>
