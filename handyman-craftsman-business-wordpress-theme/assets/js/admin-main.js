jQuery(function ($) {
    "use strict";

    // Metaboxes
    tl_load_meta_image();
    $(".tl-color-picker").wpColorPicker();

    /* --------------------------------------- Functions ----------------------------------- */

    /**
     * Create and handle AJAX select image request
     */
    function tl_load_meta_image(){

        var $rrr = null;
        var handler = function(media_attachment_obj, button){

            TL_AdminLib.do_admin_ajax({
                    id : media_attachment_obj.id,
                    sub_action: 'load_thumbnail_image',
                    size: "layers-landscape-medium"
                },
                'json',
                function(response){
                    if(response.success == true){
                        $rrr = response.data;
                        $('<div class="image" style="background-image: url('+response.data.url+');"><a data-attachment-id="'+response.data.id+'" class="remove"><i class="icon-ti-close"></i></a></span></div>').insertAfter(button);
                        $("#meta-image-button").hide();
                    }else{
                        alert("Error!, Unable to load an image!");
                    }
                });
        }
        tl_image_uploader(handler);

        //Hide upload button if image loaded

        if($("#tl_item_header_image_id").val() != ""){
            $("#meta-image-button").hide();
        }
    }


    /**
     * Bing all events
     *
     * @param callback
     */
    function tl_image_uploader(callback){

        // Instantiates the variable that holds the media library frame.
        var meta_image_frame;

        //Hide upload button if image already uploaded
        if($("#item_header_image_id").val() != '' && typeof $("#item_header_image_id").val() != 'undefined'){
            $("#meta-image-button").hide();
        }

        // Runs when the image button is clicked.
        $('#meta-image-button').click(function(e){

            var $that = $(this);

            // Prevents the default action from occuring.
            e.preventDefault();

            // If the frame already exists, re-open it.
            if ( meta_image_frame ) {
                meta_image_frame.open();
                return;
            }

            // Sets up the media library frame
            meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                title: "Select an image for page header",
                button: { text:  "Submit" },
                library: { type: 'image' }
            });

            // Runs when an image is selected.
            meta_image_frame.on('select', function(){

                // Grabs the attachment selection and creates a JSON representation of the model.
                var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

                // Sends the attachment URL to our custom image input field.
                $('#tl_item_header_image_id').val(media_attachment.id);

                callback(media_attachment, $that);
            });

            // Opens the media library frame.
            meta_image_frame.open();
        });

        // Remove image
        $("body").on("click", ".tl-control .image .remove", function(e){
             var $that = $(this);
             $that.parent().remove();
            $("#tl_item_header_image_id").val('');
            $("#meta-image-button").show();
        });
    }
}(jQuery));