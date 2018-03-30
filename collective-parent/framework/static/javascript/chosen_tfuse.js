jQuery(document).ready(function()
{
    var $selects = jQuery('select.tfuse-select');

    $selects.tfuse_chosen();

    var $wrappers = $selects.closest('.tf-interface-option');

    $selects = undefined;

    $wrappers.on('click', '.tfuse-selectsearch-enable-delete-btn', function(){
        var ignoredItemsArr = jQuery(this).data('ignored_items');
        var li_rows = jQuery(this).find('.chzn-results').children('.active-result');

        li_rows.each(function(){
            var one_li =jQuery(this);

            if (jQuery.inArray(one_li.text(),ignoredItemsArr) == -1 && !one_li.hasClass('delete-row-btn')) {
                one_li.addClass('delete-row-btn').after('<a href="#" class="tfuse_selectsearch_delete_option_action">X</a>');
            }
        });
    });

    $wrappers.on({
        click: function (event) {
            var ul = jQuery(this).closest('.tfuse-selectsearch-enable-delete-btn');
            var select = ul.data('record').select;
            var callbackMethod = ul.data('record').callbackDeleteFunction;

            if (typeof window.tfuseNameSpace[ callbackMethod ] === "undefined") {
                alert('Function ' + callbackMethod + " is not defined !");
                return false;
            }

            var close = (window.tfuseNameSpace[ callbackMethod ](jQuery(this), jQuery(this).prev().text(), select) !== false);

            if (close) {
                select.trigger("click");
            }

            return false;
        },
        mouseenter:function (e) {
            jQuery(this).prev().trigger('mouseover');
        }
    }, '.tfuse_selectsearch_delete_option_action');

    $wrappers.on('change', 'select.tfuse-select', function () {
        var self = jQuery(this);
        var length = self.find('option:selected').length;
        var toggle_container = self.closest('.tf_multicontrol_selectsearch').prev('.tf_selectsearch_control_show_hide');
        var single_span = toggle_container.find('.tf-selectseach-toggle-txt-single');
        var multiple_span = toggle_container.find('.tf-selectseach-toggle-txt-multiple');
        toggle_container.find(".tf_item_counter").text(length);

        if (length === 1 && single_span.css('display') === 'none') {
            single_span.show();
            multiple_span.hide();
        }
        else if (multiple_span.css('display') === 'none') {
            multiple_span.show();
            single_span.hide();
        }

        self.siblings('input[type=hidden]').val(self.val());
    });

    $wrappers.on('click', '.tfuse_selectsearch_create_option_action', function (event) {
        if (typeof window.tfuseNameSpace[ jQuery(this).data('record').callback ] === "undefined") {
            alert('Function ' + jQuery(this).data('record').callback + " is not defined !");
            return false;
        }

        event.preventDefault();

        var self = jQuery(this);
        var input_text = jQuery('input[type=text]', self.closest('.tf_selectsearch_create_options_content'));

        var close = (window.tfuseNameSpace[ self.data('record').callback ](self, input_text.val()) !== false );

        input_text.val('');

        if (close)
            jQuery(self.data('record').id).trigger("click");

        return false;
    });
});

(function () {
    var methods = {
        addInput: function (callback, id) {
            var main_id = '#' + id + '_chzn';
            var context = jQuery(main_id);
            var $select = context.parent().find('select:first');

            var $element = jQuery(
                '<div class="tf_selectsearch_create_options_wrapper">'+
                    '<div class="tf_selectsearch_create_options_content">'+
                        '<table width="100%" border="0" cellpadding="0" cellspacing="0">'+
                            '<tr class="tfuse-not-tr">'+
                                '<td>'+
                                    '<input type="text" class="tf_selectsearch_add_new_option_input" placeholder="Name of option"/>'+
                                    '<div style="clear: both;"></div>'+
                                '</td>'+
                                '<td width="1" class="tfuse_selectsearch_create_option_td">'+
                                    '<a class="add button tfuse_selectsearch_create_option_action">Add</a>'+
                                    '<div style="clear: both"></div>'+
                                '</td>'+
                            '</tr>'+
                        '</table>'+
                    '</div>'+
                '</div>'
            );

            context.find('.chzn-drop').prepend($element);

            $element.find('.tfuse_selectsearch_create_option_action').data('record', {'callback':callback, 'id':'#' + id});

            var addPlaceholder = $select.attr('data-add-placeholder');
            addPlaceholder = addPlaceholder || 'Name of option';
            $element.find('.tf_selectsearch_add_new_option_input').attr('placeholder', addPlaceholder);

            var searchPlaceholder = $select.attr('data-search-placeholder');
            searchPlaceholder = searchPlaceholder || 'Type to search';
            context.find('.chzn-search input').attr('placeholder', searchPlaceholder);

            $element = undefined;
        },
        addDeleteBtn:function (context, callback) {
            var id = '#' + context.attr('id') + '_chzn';
            var ul = jQuery(id).addClass('tfuse-selectsearch-enable-delete-btn');
            ul.data('record', {'callbackDeleteFunction':callback, 'select':context});
        },
        setIgnoredItemsData:function(context ,ignored_items ){
            var id = '#' + context.attr('id') + '_chzn';
            var tempArr = ignored_items.split(',');
            jQuery(tempArr).each(function(index, element){
               tempArr[index]=jQuery.trim(element);
            });
            jQuery(id).data('ignored_items',tempArr);
        }
    };

    jQuery.fn.extend({
        tfuse_chosen: function (opts) {
            opts = opts || {};

            jQuery(this).each(function () {
                var self = jQuery(this);
                var length = self.find('option:selected').length;

                self.chosen(
                    jQuery.extend({
                        'allow_single_deselect': jQuery(this).attr('single-deselect') === 'true'
                    }, opts)
                );

                if (self.attr('data-callback-delete-btn') !== undefined)
                    methods.addDeleteBtn(self, self.attr('data-callback-delete-btn'));

                if (self.attr('data-callback') !== undefined) {
                    methods.addInput(self.attr('data-callback'), self.attr('id'));
                    jQuery('#'+ self.attr('id') +'_chzn').addClass('chzn-with-add');
                } else {
                    jQuery('#'+ self.attr('id') +'_chzn').removeClass('chzn-with-add');
                }

                if (self.attr('data-ignored-items')!== undefined)
                    methods.setIgnoredItemsData(self, self.attr('data-ignored-items'));

                if (self.attr('data-toggle-btn') == true) {
                    var chosen_select    = jQuery('#' + self.attr('id') + '_chzn');
                    var selectsearch     = chosen_select.closest('.tf_multicontrol_selectsearch');
                    var toggle_container = selectsearch.prev(".tf_selectsearch_control_show_hide");
                    var toggle_str_spans = toggle_container.children('span').children();

                    selectsearch.hide();

                    if (length > 1) {
                        toggle_container.find('.tf-selectseach-toggle-txt-multiple').toggle();
                    } else {
                        toggle_container.find('.tf-selectseach-toggle-txt-single').toggle();
                    }

                    toggle_str_spans.each(function () {
                        var self = jQuery(this);
                        var text = self.text();
                        if(self.find('.tf_item_counter').length == 0)
                        jQuery(this).html(text.replace(/%%\w+%%/g, '<span class="tf_item_counter">' + length + '</span>'));
                    });
                }
            });
        }
    });

})();

//JS FOR GROUP ELEMENTS FROM SELECT SEARCH WHICH HAVE OPTGROUP AS SELECTED
jQuery(document).ready(function(){
    var active_class = 'tf_group_active';
    var $wrappers = jQuery('.tf_selectsearch_control_none').closest('.tf-interface-option');

    $wrappers.on('click', '.tf_selectsearch_control_none', function () {
        var wrapper = jQuery(this).closest('.tf_multicontrol_selectsearch');
        var selectsearch = wrapper.find('select');
        var group_links = wrapper.find('.tf_groups_controls a');

        wrapper.find('option').removeAttr("selected");
        group_links.removeClass(active_class);
        selectsearch.trigger("liszt:updated").trigger('change');

        return false;
    });

    $wrappers.on('click', '.tf_selectsearch_control_all', function(){
        var wrapper = jQuery(this).closest('.tf_multicontrol_selectsearch');
        var selectsearch = wrapper.find('select');
        var group_links = wrapper.find('.tf_groups_controls a');

        wrapper.find('option').attr("selected", "selected");
        group_links.addClass(active_class);
        selectsearch.trigger("liszt:updated");
        selectsearch.trigger('change');

        return false;
    });

    $wrappers.on('click', '.tf_selectsearch_toggle_a', function () {
        var self = jQuery(this);
        var switcher = self.find('.toggle_btn_off').css('display');
        var switch_on = self.find('.toggle_btn_off');
        var switch_off = self.find('.toggle_btn_on');

        self.parent().next('.tf_multicontrol_selectsearch').slideToggle(
            400, function(){
                if (switcher === 'none') {
                    switch_on.toggle();
                    switch_off.toggle();
                }
                else {
                    switch_on.toggle();
                    switch_off.toggle();
                }
            }
        );
        return false;
    });

    $wrappers.on('click', '.tf-groups-links', function () {
        var self = jQuery(this);
        var wrapper = self.closest('.tf_multicontrol_selectsearch');
        var selectsearch = wrapper.find('select');
        var placeholder = self.attr('data-placeholder');

        if (self.hasClass(active_class)) {
            self.removeClass(active_class);
            wrapper.find('optgroup[data-placeholder=' + placeholder + ']').children().removeAttr("selected");
        } else {
            self.addClass(active_class);
            wrapper.find('optgroup[data-placeholder=' + placeholder + ']').children().attr("selected", "selected");
        }

        wrapper.find('input[type=hidden]').val(selectsearch.val());
        selectsearch.trigger('change');
        selectsearch.trigger("liszt:updated");
        return false;
    });
});