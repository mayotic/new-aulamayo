
<!-- Templates for profesiones select -->
<template class="wrapper" data-parent="#profesiones-select" data-template="wrapper">
    <select name="profesion" id="profesion"  class="custom-select selectpicker form-control" required>
        <option value="" selected><?= Tools::_t('seleccione_profesion') ?></option>
        {{content}}
    </select>
</template>

<template class="row" data-parent="#profesiones-select" data-template="row">
    <option value="{{id_profesion}}">{{nombre}}</option>
</template>
