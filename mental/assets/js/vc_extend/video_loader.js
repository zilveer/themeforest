!function($){
    $('.gallery_widget_add_video').each(function(){
        var $button = $(this),
            $val = $(this).parents(".edit_form_line").find(".wpb_vc_param_value"),
            file;
        $button.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            // If the frame already exists, reopen it
            if (typeof(file) !== "undefined") file.close();
            // Create WP media frame.
            file = wp.media.frames.cvm_media_frame = wp.media({
                    // Title of media manager frame
                    
                    // Do not allow multiple files, if you want multiple, set true
                    multiple: false
            });
            //callback for selected image
            file.on("select", function() {
                var attachment = file.state().get("selection").first().toJSON();
                $val.val(attachment.id).trigger("change");
                var $list = $button.parents('.edit_form_line').find('.gallery_widget_attached_images_list');
                $list.html('<li class="added" title="' + attachment.url + '" rel="' + attachment.id + '"><a title="Remove" class="vc_icon-remove" href="#"></a></li>');
            });
            // Open modal
            file.open();
        });
    });
}(window.jQuery);