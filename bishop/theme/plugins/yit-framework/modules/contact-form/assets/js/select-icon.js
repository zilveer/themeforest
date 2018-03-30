/**
 * Created with JetBrains PhpStorm.
 * User: Your Inspiration
 * Date: 15/04/14
 * Time: 11.45
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(function($){

    //select-icon
    update_selectors();
    $('body').on( 'yit_contact_form_added_item yit_contact_form_removed_item', update_selectors );

    function update_selectors(){
        $('.contactform_items .icon_type').off( 'change' );
        $('.contactform_items .icon_type').on( 'change', icon_select_handler );

        $('.input_wrapper.custom_icon .upload_button').off( 'click' );
        $('.input_wrapper.custom_icon .upload_button').on( 'click', upload_handler );

        $('.icon_type').trigger('change');
    }

    function icon_select_handler(){
        var t       = $(this);
        var parents = t.parents('div.option');

        var option  = $('option:selected', this).val();

        var to_show = option == 'none' ? '' : option == 'icon'  ? '.awesome_icon' : '.custom_icon';

        var objToHide = parents.find('div:not(.icon_type)')
        objToHide.removeClass("show").addClass('hidden');

        var objToShow =  parents.find( to_show )
        objToShow.removeClass( 'hidden' ).addClass( 'show' );
    }

    //upload

    function upload_handler(){
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('-button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){

            if ( _custom_media ) {
                id = id.replace('[', '\\[').replace(']', '\\]');
                if( $("#"+id).is('input[type=text]') ) {
                    $("#"+id).val(attachment.url);
                } else {
                    $("#"+id + '_custom').val(attachment.url);
                }

            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    }

    $('.add_media').on('click', function(){
        _custom_media = false;
    });



});




