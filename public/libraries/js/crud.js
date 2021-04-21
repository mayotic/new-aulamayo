function crud (node) {
  var _self = this;

  this.string_to_object = function (string) {
    let first_level = string.split(',').filter(function(el) {return el.length != 0}),
        final_array = [];
    for (ind in first_level) {
      final_array.push(first_level[ind].split('|')).filter(function(el) {return el.length != 0});
    }
    return final_array;
  }

  this.node         = node;
  this.primary_key  = $(node).data('primary_key');

  this.order        = $(node).data('order').split(',');
  this.filter       = this.string_to_object($(node).data('filter'));
  this.pagination   = $(node).data('pagination').split(',');
  this.rows_page    = $(node).data('rows_page');
  this.total_rows   = 0;

  this.source_list  = $(node).data('source_list');
  this.source_edit  = $(node).data('source_edit');
  this.source_save  = $(node).data('source_save');
  this.source_new   = $(node).data('source_new');
  this.source_del   = $(node).data('source_del');

  this.paginator    = $(node).data('paginator');

  this.edit_modal   = $(node).data('edit_modal');
  this.save_button  = $(node).data('save_button');

  this.refresh_properties = function (propertie = false) {
      if (propertie) {
          this[propertie] = $(this.node).data(propertie);
      }else{
          this.primary_key  = $(this.node).data('primary_key');

          this.order        = $(this.node).data('order').split(',');
          this.filter      = this.string_to_object($(this.node).data('filter'));
          this.pagination   = $(this.node).data('pagination').split(',');
          this.rows_page    = $(this.node).data('rows_page');
          this.total_rows   = 0;

          this.source_list  = $(this.node).data('source_list');
          this.source_edit  = $(this.node).data('source_edit');
          this.source_save  = $(this.node).data('source_save');
          this.source_new   = $(this.node).data('source_new');
          this.source_del   = $(this.node).data('source_del');

          this.paginator    = $(this.node).data('paginator');

          this.edit_modal   = $(this.node).data('edit_modal');
          this.save_button  = $(this.node).data('save_button');
      }
  }

  this.refresh_crud = function () {
    this.init_crud();
  }

  this.init_crud = function () {
      // First load -> List call
      $.post( this.source_list,
              {'order': this.order, 'filter': this.filter, 'pagination': this.pagination},
              function (data) {
                // Draw and arrange data
                Tools.deployData(data);
                _self.total_rows = data['total-rows'];
                $(_self.node + ' > table > tbody > tr:first-child').remove(); // Tweak for remove first tr in tables wen empty due to template sistem

                if (typeof _self.paginator != 'undefined') {
                    // Pagination system
                    let pages = _self.total_rows / _self.rows_page;
                    let total_pages = (pages == parseInt(pages) ? pages : pages + 1);

                    $(_self.paginator).twbsPagination({
                        totalPages: total_pages,
                        visiblePages: 5,
                        onPageClick: function (event, page) {
                            // console.info(page + ' (from options)');
                        }
                    }).on('page', function (event, page) {
                          _self.pagination = [_self.rows_page, page];
                          $.post( _self.source_list,
                                  {'order': _self.order, 'filter': _self.filter, 'pagination': _self.pagination},
                                  function (data) {
                                    Tools.deployData(data);
                                    _self.total_rows = data['total-rows'];
                                    $(_self.node + ' > table > tbody > tr:first-child').remove();
                                  },
                                  'json'
                          );
                    });
                }

              },
              'json'
      );
  }

  this.init_sorters = function () {
      // Sort system
      $(document).on('click', this.node + ' thead th[data-sortable=1] a', function (e) {
          _self.order = [$(this).parent().data('field'), (_self.order[1] ==  'ASC' ? 'DESC' : 'ASC')];
          $.post( _self.source_list,
                  {'order': _self.order, 'filter': _self.filter, 'pagination': _self.pagination},
                  function (data) {
                    Tools.deployData(data);
                    _self.total_rows = data['total-rows'];
                    $(_self.node + ' > table > tbody > tr:first-child').remove();
                  },
                  'json'
          );
      });
  }

  this.bind_edit = function () {
      // Edit system
      $(this.edit_modal).on('show.bs.modal', function(e) {
          var primary = $(e.relatedTarget).data('primary');
          $(e.currentTarget).find('.modal-body').attr('data-primary', primary);
          var filter = {};
          filter[_self.primary_key] = primary;
          $.post(
            _self.source_edit,
            {filter: filter, action: 'edit'},
            function (data) {
              Tools.deployData(data);
              _self.load_related_data();
            },
            'json'
          );
      });

      // Save system
      $(this.save_button).on('click', function(e) {
          var primary = $(this).parents(_self.edit_modal).find('.modal-body').attr('data-primary'),
          fields = $(this).parents(_self.edit_modal).find('form').serializeToObj();
                    console.log($(this).parents(_self.edit_modal).find('.modal-body').attr('data-primary'));
          var filter = {};
          filter[_self.primary_key] = primary;
          $.post(
            _self.source_save,
            {filter: filter, fields: fields, action: 'save'},
            function (data) {
              _self.refresh_crud();
              // Tools.deployData(data);
            },
            'json'
          );
      });
  }

  this.load_related_data = function () {
    $(_self.edit_modal + ' [data-remote=1]').each(function () {
        var selected = $(this).data('key'),
        _this = this;
        $.post(
            $(this).data('source'),
            {action: $(this).data('type')},
            function (data) {
              Tools.deployData(data);
              $(_this).find('option[value=' + selected + ']').prop('selected', true)
            },
            'json'
        );
    });
  }

}
