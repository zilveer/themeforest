/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
*/


//upload
jQuery(document).ready(function($){

    //upload
    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    $('#layout-panel-frame').on('click', '.yit-options', function(e) {

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('-button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                console.log(id);
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
    });

});