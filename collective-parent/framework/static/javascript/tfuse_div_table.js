(function () {
    var methods = {
        changeCheckboxId:function (self) {
            var uniqueID = Math.floor(Math.random() * 99999);
            self.find('.div-table-td[data-type=checkbox]').each(function () {
                var td = jQuery(this);
                var id = td.attr('data-id');

                td.find('[id^="' + id + '"],label[for^="' + id + '"]').each(function () {
                    var self = jQuery(this);
                    if (self.attr('for'))
                        self.attr('for', id + '_' + (uniqueID));
                    else
                        self.attr('id', id + '_' + uniqueID);
                });
                uniqueID = Math.floor(Math.random() * 99999);
            });
        },
        setInputValue:function (event) {
            var  self = event.data.self;
            var tableId = self.attr('id');
            self.find('input[name="' + tableId + '"]').val(JSON.stringify(self.find('.div-table-first-body input, .div-table-first-body textarea, .div-table-first-body select').serializeObject()));
        },
        checkAllRows:function (event) {
            var self = event.data.self;
            if (jQuery(this).is(':checked'))
                self.find('.btq_checkbox_column').attr('checked', 'checked');
            else
                self.find('.btq_checkbox_column').removeAttr('checked');
        },
        deleteRows:function (event) {
            var self = event.data.self;

            var checkboxes = self.find('.div-table-delete-checkbox-row input[type="checkbox"]');

            jQuery.each(checkboxes, function () {
                if (jQuery(this).is(':checked'))
                    jQuery(this).closest('.div-table-tr').remove();
            });
            self.find('.btq_checkbox_column_all').removeAttr('checked');
            self.find('input').trigger('change');
            return false;
        },
        addInput:function (callback, id) {
            var id = '#' + id + '_chzn';

            jQuery(id).find('.chzn-drop').prepend(
                '<div class="tf_selectsearch_create_options_wrapper">' +
                    '<div class="tf_selectsearch_create_options_content">' +
                    '<input   type="text"/><a class="add button tfuse_selectsearch_create_option_action">Add</a>' +
                    '<div style="clear: both"></div> ' +
                    '</div>' +
                    '</div>'
            );

            jQuery('.tfuse_selectsearch_create_option_action').data('record', {'callback':callback, 'id':'#' + id});
        },
        addRow:function (event) {
            var self = event.data.self,
            firstTr = event.data.firstTr,
            row = firstTr.clone(),
            selectsearch = row.find('.tfuse-select');

            self.find('.div-table-first-body').append(row.show());
            if(selectsearch.length > 0){
                selectsearch.removeClass('chzn-done').removeAttr('id').next('div').remove();
                selectsearch.tfuse_chosen();
            }
            methods.changeCheckboxId(self);
            self.find('input').trigger('change');

            return false;
        }

    };

    jQuery.fn.extend({
        tfuseMakeDivTable: function(){
            jQuery(this).each(function(){
                var $this    = jQuery(this);
                var $wrapper = $this.closest('.tf-interface-option');

                methods.changeCheckboxId($this);
                // methods.addCheckboxToRow($this);
                // methods.addButtons($this);

                var firstTr = $this.find('.default-value-row');
                $wrapper.on('click', '#' + $this.attr('id') + ' .btq_shopping_delete_rows', {self:$this}, methods.deleteRows);
                // jQuery(document).on('change', '#' + $this.attr('id') + ' .btq_checkbox_column_all', {self:$this}, methods.checkAllRows);
                $wrapper.on('change', '#' + $this.attr('id') + ' input, #' + $this.attr('id') + ' textarea, #' + $this.attr('id') + ' select', {self:$this}, methods.setInputValue);
                $wrapper.on('click', '#' + $this.attr('id') + ' .btq_shopping_add_row', {self:$this, firstTr:firstTr}, methods.addRow);

                $this.find('input').trigger('change');
            });
        }
    });
})();