
            <script>
            var image_custom_uploader;
            jQuery('#your_image_url_button').click(function(e) {
                e.preventDefault();

                //If the uploader object has already been created, reopen the dialog
                if (image_custom_uploader) {
                    image_custom_uploader.open();
                    return;
                }

                //Extend the wp.media object
                image_custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                //When a file is selected, grab the URL and set it as the text field's value
                image_custom_uploader.on('select', function() {
                    attachment = image_custom_uploader.state().get('selection').first().toJSON();
                    var url = '';
                    url = attachment['url'];
                    jQuery('#your_image_url').val(url);
                    jQuery( "img#your_image_url_img" ).attr({
                        src: url
                    });
                    jQuery("#your_image_url_button").css("display", "none");
                    jQuery("#your_image_url_button_remove").css("display", "block");
                });

                //Open the uploader dialog
                image_custom_uploader.open();
             });

             jQuery('#your_image_url_button_remove').click(function(e) {
                jQuery('#your_image_url').val('');
                jQuery( "img#your_image_url_img" ).attr({
                    src: ''
                });
                jQuery("#your_image_url_button").css("display", "block");
                jQuery("#your_image_url_button_remove").css("display", "none");
             });
            </script>



            