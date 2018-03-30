(function($) {
    jQuery(document).ready(function() {
        // UPLOAD FORM CONTROL
        $('.g1-option-view-upload').each(function() {
            var $option = $(this);
            var $clearButton = $('.g1-clear-button', $option);
            var $value = $('input.g1-media-upload-input', $option);
            var $preview = $('.g1-media-upload-preview', $option);

            $value.val() ? $clearButton.show() : $clearButton.hide();

            $('.g1-clear-button', $option).click(function() {
                $value.val('');
                $preview.empty();
                $clearButton.hide();

                return false;
            });
        });

        $('.g1-media-upload-button').click(function() {
            var $field_wrapper = $(this).parents('.g1-media-upload');
            var $input = $field_wrapper.find('.g1-media-upload-input');
            var $preview = $field_wrapper.find('.g1-media-upload-preview');
            var $clearButton = $field_wrapper.find('.g1-clear-button');

            var frame = wp.media.frames.file_frame = wp.media(
                {
                    title: g1_form_controls_i18n.set_background_image_label,
                    button: {
                        text: g1_form_controls_i18n.set_background_image_label
                    },
                    multiple: false
                }
            );

            frame.on( 'open', function() {
                var id = $input.val();

                if (id) {
                    var selection = frame.state().get('selection');
                    var attachment = wp.media.attachment(id);

                    if (attachment) {
                        attachment.fetch();
                    }

                    if (selection) {
                        selection.add( attachment ? [ attachment ] : [] );
                    }
                }
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();

                var $img = $('<img>');

                if ( typeof attachment != 'undefined' ) {
                    if (typeof attachment.sizes !== 'undefined' && typeof attachment.sizes.thumbnail !== 'undefined') {
                        $img.attr( 'src', attachment.sizes.thumbnail.url );
                    } else {
                        $img.attr( 'src', attachment.url );
                    }
                }

                $input.val(attachment.id);
                $preview.html($img);
                $clearButton.show();
            });

            frame.open();

            return false;
        });

        // COLOR FORM CONTROL
        if ($().wpColorPicker) {
            $('.wp-color-picker').wpColorPicker();
        }
    });
})(jQuery);