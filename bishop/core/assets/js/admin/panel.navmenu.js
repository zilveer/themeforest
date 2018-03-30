/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

jQuery(document).ready(function($){
    "use strict";
    if( typeof wp === 'undefined' || typeof wp.media === 'undefined' ){
        return false;
    }

    //upload
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    $(document).on('click', 'input.upload_button', function(e) {
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('-button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {

            if (_custom_media) {

                if ($("#" + id).is('input[type=text]')) {
                    $("#" + id).val(attachment.url);
                } else {
                    $("#" + id + '_custom').val(attachment.url);
                }


                var description = $("#" + id).parents('.menu-item-settings').find('.edit-menu-item-description');
                var sfx = $("#" + id).data('sfx');
                var text = description.val();
                var regex = new RegExp("\\[" + sfx + " [a-zA-Z0-9-:/%_.]+\\]");
                if (typeof text != 'undefined') {
                    text = text.replace(regex, '');
                    description.val(text + "[" + sfx + " " + attachment.url + "]");
                }


            } else {
                return _orig_send_attachment.apply(this, [props, attachment]);
            }
        };

        wp.media.editor.open(button);

        return false;
    });

    $('.yit-options .add_media').on('click', function(){
        _custom_media = false;
    });


    $(document).on('change','.icon-text', function(){
        var input = $(this),
            description = input.parents('.menu-item-settings').find('.edit-menu-item-description'),
            input_val = input.val(),
            sfx = input.data('sfx'),
            text  = description.val(),
            regex = new RegExp("\\["+sfx+" [a-zA-Z0-9-:]+\\]");
        if( typeof text != 'undefined'  ){
            text = text.replace(regex,'');
            description.val( text + "["+sfx+" "+input_val+"]");
        }
    });


    // icon-list
    $(document).on('change', '.widget_icon_type', function(){
        var t       = $(this),
            parents = t.closest('div.widget-content'),
            option  = $('option:selected', this).val(),
            to_show = option == 'none' ? '' : option == 'icon'  ? '.widget-icon-manager' : '.widget_custom_icon';

        parents.find('.widget-icon-manager, .widget_custom_icon').addClass('hidden');
        parents.find( to_show ).removeClass( 'hidden' ).addClass( 'show' );
    });

    $('.widget_icon_type').trigger('change');



    $(document).on('click', 'ul.icon-list-wrapper li', function() {
        var $t = $(this),
            $icon_list = $t.closest('ul.icon-list-wrapper'),
            $preview = $icon_list.closest('.icon-manager-wrapper').find('.icon-preview'),
            $element_list = $icon_list.find('li'),
            $icon_text = $icon_list.closest('.icon-manager-wrapper').find('.icon-text');

        $element_list.removeClass('active');
        $t.addClass('active');

        $preview.attr('data-font', $t.data('font'));
        $preview.attr('data-icon', $t.data('icon'));
        $preview.attr('data-name', $t.data('name'));
        $preview.attr('data-key', $t.data('key'));

        $icon_text.val( $t.data('font')+':'+$t.data('name')).trigger('change');

    });



});