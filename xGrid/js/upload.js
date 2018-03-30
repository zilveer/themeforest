jQuery(document).ready(function($){
    if(jQuery('.bd_upload_button').length >= 1)
    {
        window.bd_uploadfield = '';
        jQuery('.bd_upload_button').live('click', function()
        {
            window.bd_uploadfield = jQuery('.upload_field', jQuery(this).parent());
            tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);
            return false;
        });

        window.bd_send_to_editor_backup = window.send_to_editor;
        window.send_to_editor = function(html)
        {
            if(window.bd_uploadfield) {
                var image_url = jQuery('img', html).attr('src');
                jQuery(window.bd_uploadfield).val(image_url);
                window.bd_uploadfield = '';

                tb_remove();
            } else {
                window.bd_send_to_editor_backup(html);
            }
        }
    }
});