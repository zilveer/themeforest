<?php
/**
 * Your Inspiration Themes
 *
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $post;

$post_id = yit_post_id();

// use static header image
if ( isset( $post_id ) &&  ( yit_get_post_meta( $post_id, '_use_static_image' ) ||  apply_filters( 'is_category_shop_page', true)  ) ) {
    $image_url  = apply_filters( 'yit_static_image', yit_get_post_meta( $post_id, '_static_image' ) );
    $image_size = yit_getimagesize( $image_url );
    $image_id   = yit_get_attachment_id( $image_url );
    $image      = wp_get_attachment_image_src( $image_id, 'full' );

    if ( count( $image ) != 3 ) {
        list( $thumb_url, $image_width, $image_height ) = $image;
    }
    else {
        $thumb_url = $image_width = $image_height = '';
    }

    $static_image_link = apply_filters( 'yit_static_image_link', yit_get_post_meta( $post_id, '_static_image_link' ) );

    if(isset($thumb_url)) :

    ?>
    <div class="slider fixed-image inner group">
        <div class="fixed-image-wrapper" <?php if ( ! empty( $image_size ) ): ?>style="max-width: <?php echo $image_size[0] ?>px;"<?php endif ?>>
            <?php if( ! empty( $static_image_link ) ) : ?>
            <a href="<?php echo $static_image_link ?>" title="" target="<?php echo yit_get_post_meta( $post_id, '_static_image_target' ) ?>"><?php endif ?>
                <img src="<?php echo $thumb_url ?>" alt="<?php bloginfo( 'name' ) ?> Header" />
                <?php if( ! empty( $static_image_link ) ) : ?></a><?php endif ?>
        </div>
    </div>
    <?php

    endif;

    add_action( 'yit_after_header', 'yit_slider_space' );

// use static header of Appearance -> Header
}
elseif ( get_header_image() != '' ) {
    ?>
    <div class="slider fixed-image inner group">
        <div class="fixed-image-wrapper" style="max-width: <?php echo get_custom_header()->width ?>px;">
            <img src="<?php header_image() ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ) ?> Header" />
        </div>
    </div>
<?php


// use the slider
}
else {
    yit_slider();
}