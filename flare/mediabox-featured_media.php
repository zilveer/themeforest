<?php
/**
 * The Template Part for displaying a featured media in the Media box.
 *
 * @package BTP_Flare_Theme
 */
?>

<?php
	global $post;
	extract( btp_part_get_vars() );

    $attachment_id = get_post_thumbnail_id( $post->ID );

    if ( $attachment_id ) {
        $attachment = get_post( $attachment_id );
    }
?>

<?php if ( isset($attachment) ) : ?>
<figure class="media">
    <ul class="attachments">
        <?php
        $title = esc_html( $attachment->post_title );
        $caption = esc_html( $attachment->post_excerpt );
        $description = esc_html( $attachment->post_content );
        ?>
        <li>
            <?php
            $mime_type = substr( $attachment->post_mime_type, 0, strpos( $attachment->post_mime_type, "/") );
            $alt_url = get_post_meta( $attachment_id, '_btp_alt_link', true );

            if ( strlen( $alt_url ) ) {
                $mime_type = 'embed';
            }

            switch ( $mime_type ) {
                case 'embed':
                    if ( str_endswith( $alt_url, '.mp3' ) ) {
                        echo do_shortcode( '[audio mp3="' . esc_url( $alt_url ) . '"]');
                    } else {
                        global $_wp_additional_image_sizes;
                        $width = $_wp_additional_image_sizes[ $size ][ 'width' ];

                        global $wp_embed;
                        $embed = $wp_embed->run_shortcode( '[embed width="' . $width . '"]' . esc_url( $alt_url ) . '[/embed]') ;

                        $no_embed = '<a href="'. esc_url( $alt_url ) .'">' . esc_url( $alt_url ) . '</a>';
                        if ( $embed === $no_embed ) {
                            $embed = '<img src="' . esc_url( $alt_url) . '" alt="'. esc_url( $alt_url) .'"/>';
                        }
                        ?>
                        <figure class="media-embed">
                            <?php echo do_shortcode( '[frame]' . $embed . '[/frame]' ); ?>
                        </figure>
                        <?php
                    }
                    break;

                case 'image':
                    ?>
                        <figure class="media-image">
                            <?php echo do_shortcode( '[frame]' . wp_get_attachment_image( $attachment_id, $size ) . '[/frame]' ); ?>
                        </figure>
                        <?php
                    break;

                case 'audio':
                    echo do_shortcode( '[frame][audio title="' . $caption .'" mp3="' . wp_get_attachment_url( $attachment_id )  . '"][/frame]' );
            }
            ?>

        </li>
    </ul>
</figure><!-- .media-box -->
<?php endif; ?>