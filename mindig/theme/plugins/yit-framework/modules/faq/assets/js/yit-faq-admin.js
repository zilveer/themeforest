/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

(function($){

    if ( ! $('#faq_cat_thumbnail_id').val() ){
        $('.remove_image_button').hide();
    }

    // Uploading files
    var file_frame;

    $(document).on( 'click', '.upload_image_button', function( event ){

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.downloadable_file = wp.media({
            title: yit_faq_admin_l10n.choose_image,
            button: {
                text: yit_faq_admin_l10n.use_image
            },
            multiple: false
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#faq_cat_thumbnail_id').val( attachment.id );
            $('#faq_cat_thumbnail img').attr('src', attachment.url );
            $('.remove_image_button').show();
        });

        // Finally, open the modal.
        file_frame.open();
    });

    $(document).on( 'click', '.remove_image_button', function( event ){
        var placeholder = $('#faq_cat_thumbnail').data('placeholder');
        $('#faq_cat_thumbnail img').attr('src',placeholder);
        $('#faq_cat_thumbnail_id').val('');
        $('.remove_image_button').hide();
        return false;
    });


})(jQuery);