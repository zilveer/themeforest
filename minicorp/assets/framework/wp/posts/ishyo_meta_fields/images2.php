<input type="hidden" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo esc_attr( $value ); ?>" />
<?php
$postid = get_the_ID();
$wp_3_5 = function_exists( 'wp_enqueue_media' );

if ( $wp_3_5 ){
    // WORDPRESS 3.5.0+
    ?>
    <div id="portfolio_images_container">
        <ul class="portfolio_images">
            <?php
            $attachments = array_filter( explode( ',', $value ) );
            if ( $attachments )
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment-id="' . $attachment_id . '">
							' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
							<ul class="actions"><li><a href="#" class="delete" title="' . __( 'Delete image', 'ishyoboy' ) . '">' . __( 'Delete', 'ishyoboy' ) . '</a></li></ul>
						</li>';
                }
            ?>
        </ul>
    </div>

    <?php if ( isset($value) && '' != $value ) { ?>
        <a href="#" class="add_portfolio_images button-secondary"><?php _e( 'Add images', 'ishyoboy' ); ?></a>
        <p class="additional_description"><?php _e( 'Use <strong>[portfolio_gallery]</strong> shortcode in content to display the gallery.', 'ishyoboy' ); ?></p>
    <?php } else { ?>
        <a href="#" class="add_portfolio_images button-secondary"><?php _e( 'Create Gallery', 'ishyoboy' ); ?></a>
        <p class="additional_description"><?php _e( 'Use <strong>[portfolio_gallery]</strong> shortcode in content to display the gallery.', 'ishyoboy' ); ?></p>
    <?php } ?>

    <script type="text/javascript">
        jQuery(document).ready(function($){

            var portfolio_frame;
            var $image_gallery_ids = $('#<?php echo $id; ?>');
            var $portfolio_images = $('#portfolio_images_container ul.portfolio_images');

            /*
             * Delete hover
             */
            var portfolio_images = jQuery('#portfolio_images_container').find('li.image');
            if ( portfolio_images.length > 0 ){
                portfolio_images.hover( function(){
                        me = jQuery(this);
                        me.find('ul.actions li').stop( true, true ).animate({
                            'bottom' : '0px'
                        }, 200);
                    },
                    function(){
                        me = jQuery(this);
                        me.find('ul.actions li').stop( true, true ).animate({
                            'bottom' : '-16px'
                        }, 200);
                    });
            }

            jQuery('.add_portfolio_images').click(function( e ) {

                e.preventDefault();

                var attachment_ids = $image_gallery_ids.val();

                // If the media frame already exists, reopen it.
                if ( portfolio_frame ) {
                    portfolio_frame.open();
                    return;
                }

                // Create the media frame.
                portfolio_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Portfolio images', 'ishyoboy' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'ishyoboy' ); ?>'
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                portfolio_frame.on( 'select', function() {

                    var selection = portfolio_frame.state().get('selection');

                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $portfolio_images.append(
                                '<li class="image" data-attachment-id="' + attachment.id + '">' +
                                    '<img src="' + attachment.url + '" />' +
                                    '<ul class="actions">' +
                                    '<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'ishyoboy' ); ?>"><?php _e( 'Delete', 'ishyoboy' ); ?></a></li>' +
                                    '</ul>' +
                                    '</li>'
                            );
                        }

                        /*
                         * Delete hover
                         */
                        var portfolio_images = jQuery('#portfolio_images_container').find('li.image');
                        if ( portfolio_images.length > 0 ){
                            portfolio_images.unbind('hover');
                            portfolio_images.hover( function(){
                                    me = jQuery(this);
                                    me.find('ul.actions li').stop( true, true ).animate({
                                        'bottom' : '0px'
                                    }, 200);
                                },
                                function(){
                                    me = jQuery(this);
                                    me.find('ul.actions li').stop( true, true ).animate({
                                        'bottom' : '-16px'
                                    }, 200);
                                });
                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );


                });

                // Finally, open the modal.
                portfolio_frame.open();
            });

            $portfolio_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 20,
                forceHelperSize: false,
                forcePlaceholderSize: true,
                helper: 'clone',
                placeholder: 'ishyoboy-sortable-placeholder',
                start: function( e, ui ){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop: function( e, ui ){
                    ui.item.removeAttr('style');
                },
                update: function( e, ui ) {
                    var attachment_ids = '';

                    $('#portfolio_images_container ul li.image').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment-id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Delete
            $('#portfolio_images_container a.delete').click( function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#portfolio_images_container ul li.image').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment-id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>
<?php
} else {
    // WORDPRESS < 3.5.0
    echo '<a href="#" id="ishyoboy_images_upload" class="button-secondary upload-' . $postid . '">' . __( 'Create Gallery', 'ishyoboy' ) . '</a>';
    echo '<p class="additional_description">' . __('After setting the gallery images up, use <strong>[portfolio_gallery]</strong> in content to display them.', 'ishyoboy' ) . '</p>';
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            // Images upload button
            var button = $('#ishyoboy_images_upload');
            var restore_send_to_editor;

            if ( button.length > 0){

                button.click( function(e) {
                    e.preventDefault();
                    // tb_show('Upload Images', 'media-upload.php?type=image&TB_iframe=true' );

                    var id = $(this).attr('class');
                    id = id.match(/upload-(\d+)/);

                    tb_show('', 'media-upload.php?post_id=' + id[1] + '&amp;type=image&amp;TB_iframe=true');

                    restore_send_to_editor = window.send_to_editor;

                    window.send_to_editor = function(html)
                        tb_remove();
                        window.send_to_editor = restore_send_to_editor;
                    };

                    return false;
                });
            }
        });
    </script>

<?php
}