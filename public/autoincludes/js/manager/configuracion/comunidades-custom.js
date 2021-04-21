$(function () {

    com_crud = new crud('#comunidades-list');
    com_crud.init_crud();
    com_crud.init_sorters();
    com_crud.bind_edit();

});
