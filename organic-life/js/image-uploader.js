jQuery(document).ready( function(){
    function media_upload( button_class) {
        var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
        jQuery('body').on('click',button_class, function(e) {
            var button_id ='#'+jQuery(this).attr('id');
            var button_class ='.'+jQuery(this).attr('id');
            var site_url = jQuery(this).data('url');
            /* console.log(button_id); */
            var self = jQuery(button_id);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = jQuery(button_id);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;
            
            wp.media.editor.send.attachment = function(props, attachment){
                if ( _custom_media  ) {
                    var attachment_url = attachment.url;
                    var attachment_url = attachment_url.replace(site_url,'');
                    // console.log(attachment_url);
                    jQuery('.upload_image_url').val(attachment_url);
                    jQuery('.image-view').attr('src',attachment.url).css('display','block');
                    jQuery(button_class).val(attachment_url); 
                    jQuery('img'+button_class).attr('src',attachment.url);
                } else {
                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                }
            }
            wp.media.editor.open(button);

            return false;
        });
    }
    media_upload('.custom-upload');
});