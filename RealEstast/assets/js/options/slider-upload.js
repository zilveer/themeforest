jQuery(function () {
    var pgl_upload_frame, custom_file_frame;
    var image_list = jQuery('.slide-image-list');

    function trigger_option_changed() {
        jQuery('#redux-opts-form-wrapper :input').change();
    }

    image_list.sortable({
        placeholder: 'pgl-state-highlight',
        scroll     : true,
        update     : function(){trigger_option_changed();}
    }).disableSelection();
		image_list.find('input[type=text],textarea').mousedown(function(e){
			e.stopPropagation();
		});
    image_list.find('.pgl-slider-thumb')
            .on('mouseenter', function () {
                jQuery(this).find('.slide-remove').fadeIn();
            })
            .on('mouseleave', function () {
                jQuery(this).find('.slide-remove').fadeOut();
            })
            .find('.slide-remove').on('click', function (event) {
                event.preventDefault();
                if (confirm('Are you sure you want to remove this item ?')) {
                    jQuery(this).parent().remove();
                    trigger_option_changed();
                } else {
                }
            });

    jQuery(document).on('click', '.slide_button_trigger', function (event) {
        event.preventDefault();
        var container = jQuery(this).parents('.pgl-slider-uploader ');
        var option_id = container.find('.slide_option_id').val();
        var slide_count = container.find('.slider_count');

        if (typeof(custom_file_frame) !== 'undefined') {
            custom_file_frame.close();
        }
        //Create WP media frame.
        custom_file_frame = wp.media.frames.customHeader = wp.media({
            // Title of media manager frame
            title   : "Sample title of WP Media Uploader Frame",
            library : {
                type: 'image'
            },
            button  : {
                //Button text
                text: "Select image"
            },
            //Do not allow multiple files, if you want multiple, set true
            multiple: false
        });

        //callback for selected image
        custom_file_frame.on('select', function () {
            var attachment = custom_file_frame.state().get('selection').first().toJSON();
            //build thumbnail
            var li = jQuery("<li class=\"pgl-slider-thumb\"></li>");
            var image = jQuery('<img src="' + attachment.url + '" /><input type="hidden" name="' + option_id + '[url][]" value="' + attachment.url + '" />');
            var meta_title = jQuery('<input type="text" name="' + option_id + '[title][]" placeholder="Title ..." />');
            var meta_desc = jQuery('<textarea name="' + option_id + '[desc][]" placeholder=""></textarea>');
            var meta_container = jQuery('<div class="info-container"></div>').append(meta_title).append(meta_desc);
            var attachment_id = jQuery('<input type="hidden" name="' + option_id + '[id][]" value="' + attachment.id + '" />');
            li.append(image);
            li.append(meta_container);
            li.append(attachment_id);
            container.find('.image-container ul').append(li);
            slide_count.val(slide_count.val() + 1);
            trigger_option_changed();
        });
        //Open modal
        custom_file_frame.open();
    });
});