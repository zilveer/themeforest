/**
 * Created by Administrator on 5/29/2015.
 */
(function($){
    "use strict";
    var AdminAPP = {
        initialize: function() {
            AdminAPP.meta_box_tab();
            AdminAPP.process_post_format();
            AdminAPP.required_field();
            AdminAPP.widget_select2_process();
        },
        meta_box_tab: function() {
            //var tabBoxes = jQuery('#masonry_thumbnail_meta_box,#masonry_thumbnail_meta_box1');
            var tabBoxes = jQuery(meta_box_ids);
            jQuery('#normal-sortables').after('<div class="g5plus-meta-tabs-wrap postbox"><div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Meta Options</span></h3><div id="g5plus-tabbed-meta-boxes"></div></div>');

            jQuery(tabBoxes).appendTo('#g5plus-tabbed-meta-boxes');
            jQuery(tabBoxes).hide().removeClass('hide-if-no-js');

            for (var a = 0, b = tabBoxes.length; a < b; a++ ) {
                var newClass = 'editor-tab' + a;
                jQuery(tabBoxes[a]).addClass(newClass);
            }

            var menu_html = '<ul id="g5plus-meta-box-tabs" class="clearfix">\n';
            var total_hidden = 0;
            for (var i = 0, n = tabBoxes.length; i < n; i++ ) {
                var target_id = jQuery(tabBoxes[i]).attr('id');
                var tab_name = jQuery(tabBoxes[i]).find('.hndle > span').text();
                var tab_class = "";

                if (jQuery(tabBoxes[i]).hasClass('hide-if-js')) {
                    total_hidden++;
                }

                menu_html = menu_html + '\n<li id="li-'+ target_id +'" class="'+tab_class+'"><a href="#" rel="editor-tab' + i + '">' + tab_name + '</a></li>';
            }
            menu_html = menu_html + '\n</ul>';

            jQuery('#g5plus-tabbed-meta-boxes').before(menu_html);
            jQuery('#g5plus-meta-box-tabs a:first').addClass('active');

            jQuery('.editor-tab0').addClass('active').show();

            jQuery('.g5plus-meta-tabs-wrap').on('click', '.handlediv', function() {
                var metaBoxWrap = jQuery(this).parent();
                if (metaBoxWrap.hasClass('closed')) {
                    metaBoxWrap.removeClass('closed');
                } else {
                    metaBoxWrap.addClass('closed');
                }
            });

            jQuery('#g5plus-meta-box-tabs li').on('click', 'a', function() {
                jQuery(tabBoxes).removeClass('active').hide();
                jQuery('#g5plus-meta-box-tabs a').removeClass('active');

                var target = jQuery(this).attr('rel');

                jQuery(this).addClass('active');
                jQuery('.' + target).addClass('active').show();

                return false;
            });
        },
        process_post_format: function () {
            var prefix  = 'g5plus_';
            var $cbxPostFormats = $( 'input[name=post_format]', '#post-formats-select' );
            var $meta_boxes = $('[id^="'+ prefix +'meta_box_post_format_"]').hide();
            $cbxPostFormats.change(function(){
                $meta_boxes.hide();
                $('#' + prefix +  'meta_box_post_format_' + $( this ).val()).show();
            });

            $cbxPostFormats.filter( ':checked' ).trigger( 'change' );

            $( 'body' ).on( 'change', '.checkbox-toggle input', function()
            {
                var $this = $( this ),
                    $toggle = $this.closest( '.checkbox-toggle' ),
                    action;
                if ( !$toggle.hasClass( 'reverse' ) )
                    action = $this.is( ':checked' ) ? 'slideDown' : 'slideUp';
                else
                    action = $this.is( ':checked' ) ? 'slideUp' : 'slideDown';

                $toggle.next()[action]();
            } );
            $( '.checkbox-toggle input' ).trigger( 'change' );
        },
        required_field: function() {
            var ref_arr = [];
            $('[data-required-ref]').each(function () {
                var $this = $(this);
                var data_ref = $this.attr('data-required-ref');
                var data_op = $this.attr('data-required-operator');
                var data_val = $this.attr('data-required-value');
                var data_val_arr = data_val.split(',');
                if ($('#' + data_ref).is(':checkbox')) {
                    if ($('#' + data_ref).prop('checked')) {
                        ref_arr[data_ref] = $('#' + data_ref).val();
                    }
                    else {
                        ref_arr[data_ref] = '0';
                    }
                }
                else {
                    ref_arr[data_ref] = $('#' + data_ref).val();
                }



                if (((data_val_arr.indexOf(ref_arr[data_ref]) != -1) && (data_op == '='))
                    || ((data_val_arr.indexOf(ref_arr[data_ref]) == -1) && (data_op == '<>'))) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
            for (var field_ref in ref_arr) {
                $('#' + field_ref).change(function() {
                    var $this_ref = $(this);
                    var this_field_ref = $(this).attr('id');
                    var ref_val = '';
                    if ($this_ref.is(':checkbox')) {
                        if ($this_ref.prop('checked')) {
                            ref_val = $this_ref.val();
                        }
                        else {
                            ref_val = '0';
                        }
                    }
                    else {
                        ref_val = $this_ref.val();
                    }

                    $('[data-required-ref="' + this_field_ref + '"]').each(function(){
                        var $this = $(this);
                        var data_op = $this.attr('data-required-operator');
                        var data_val = $this.attr('data-required-value');
                        var data_val_arr = data_val.split(',');

                        if (((data_val_arr.indexOf(ref_val) != -1) && (data_op == '='))
                            || ((data_val_arr.indexOf(ref_val) == -1) && (data_op == '<>'))) {
                            $(this).slideDown();
                        }
                        else {
                            $(this).slideUp();
                        }
                    });
                });
            }
        },
        widget_select2: function(event, widget) {
            if (typeof (widget) == "undefined") {
                $('#widgets-right select.widget-select2:not(.select2-ready)').each(function(){
                    AdminAPP.widget_select2_item(this);
                });
            }
            else {
                $('select.widget-select2:not(.select2-ready)', widget).each(function(){
                    AdminAPP.widget_select2_item(this);
                });
            }
        },
        widget_select2_item: function(target){
            $(target).addClass('select2-ready');

            var data_value = $(target).attr('data-value');

            var choices = [];

            if (data_value != '') {
                var arr_data_value = data_value.split('||');

                for (var i = 0; i < arr_data_value.length; i++) {
                    var option = $('option[value='+ arr_data_value[i]  + ']', target);
                    choices[i] = { 'id':arr_data_value[i], 'text':option.text()};
                }

            }
            $(target).select2().select2('data', choices);
            $(target).on("select2-selecting", function(e) {
                var ids = $('input',$(this).parent()).val();
                if (ids != "") {
                    ids +="||";
                }
                ids += e.val;
                $('input',$(this).parent()).val(ids);
            }).on("select2-removed", function(e) {
                    var ids = $('input',$(this).parent()).val();
                    var arr_ids = ids.split("||");
                    var newIds = "";
                    for(var i = 0 ; i < arr_ids.length; i++) {
                        if (arr_ids[i] != e.val){
                            if (newIds != "") {
                                newIds +="||";
                            }
                            newIds += arr_ids[i];
                        }
                    }
                    $('input',$(this).parent()).val(newIds);
                });
        },
        widget_select2_process: function() {
            $(document).on('widget-added', AdminAPP.widget_select2);
            $(document).on('widget-updated', AdminAPP.widget_select2);
            AdminAPP.widget_select2();
        }
    };
    $(document).ready(function(){
        AdminAPP.initialize();
    });
})(jQuery);