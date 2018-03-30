<?php
/**
 * Property Video
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 4:26 PM
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
        <a data-fancy="property_video" href="<?php echo esc_url( $prop_video_url ); ?>">
            <span class="play-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/video-play-icon.png" alt="" width="70" height="50"></span>
            <?php echo wp_get_attachment_image( $prop_video_img, 'houzez-property-detail-gallery' ); ?>
        </a>
    </div>
</div>
<?php } ?>
