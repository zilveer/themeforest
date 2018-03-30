<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 5:03 PM
 * Since v1.4.0
 */
global $prop_video_img, $prop_video_url;

if( !empty( $prop_video_url ) ) {

    if ( empty( $prop_video_img ) ) :

        $prop_video_img = wp_get_attachment_url( get_post_thumbnail_id( $post ) );

    endif;
    ?>
    <div id="video" class="property-video detail-block">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( 'Video', 'houzez' ); ?></h2>
        </div>
        <div class="video-block">
            <?php $embed_code = wp_oembed_get($prop_video_url); echo $embed_code; ?>
        </div>
    </div>
<?php } ?>