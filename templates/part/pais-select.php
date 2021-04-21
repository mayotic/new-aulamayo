
<!-- Templates for profesiones select -->
<template class="wrapper" data-parent="#pais-select" data-template="wrapper">
    <select name="pais" id="pais"  class="custom-select selectpicker" required>
        <option value="" selected><?= Tools::_t('seleccione_pais') ?></option>
        {{content}}
    </select>
</template>

<template class="row" data-parent="#pais-select" data-template="row">
    <option value="{{id_pais}}">{{nombre}}</option>
</template>
