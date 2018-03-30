<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
global $post;

$min_height = $image_size['height'];

$blog_type = ( is_singular( 'post' ) || ( isset($doing_ajax) && $doing_ajax ) ) ? 'single_' . $blog_type : $blog_type;

$attachments = get_posts( array(
    	'post_type' 	=> 'attachment',
    	'numberposts' 	=> -1,
    	'post_status' 	=> null,
    	'post_parent' 	=> get_the_ID(),
    	'post_mime_type'=> 'image',
    	'orderby'		=> 'menu_order',
    	'order'			=> 'ASC'
    )
);

foreach ( $attachments as $key => $attachment ) {
    $image = yit_image( "id=$attachment->ID&size=blog_$blog_type&output=array&echo=0" );
    $min_height = ( $min_height < $image[2] ) ? $min_height : $image[2];
}
?>

<div class="gallery thumbnail">
    <div class="swiper-container swiper-<?php the_ID() ?>" data-postid="<?php the_ID() ?>" style="max-height: <?php echo $min_height ?>px;">
        <div class="swiper-wrapper">
            <?php foreach ( $attachments as $key => $attachment ) : ?>
                <div class="swiper-slide">
                    <?php yit_image( "id=$attachment->ID&size=blog_$blog_type&class=img-responsive" ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if( $show_date && $blog_type != 'single_big' ) : ?>
            <div class="yit_post_meta_date ">
                <span class="day">
                    <?php echo get_the_date( 'd' ) ?>
                </span>

                <span class="month">
                    <?php echo get_the_date( 'M' ) ?>
                </span>
            </div>
        <?php endif; ?>
        <div class="swiper-pagination pagination-post-<?php the_ID() ?>"></div>
        <div class="swiper-direction left"><i class="fa fa-chevron-left"></i></div>
        <div class="swiper-direction right"><i class="fa fa-chevron-right"></i></div>
    </div>
</div>

