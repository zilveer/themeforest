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

$thumbnails_class = ( is_singular( 'post' ) && $blog_type == 'blog_single_big' || ( isset($doing_ajax) && $doing_ajax ) ) ? 'thumbnail  big-image' : 'thumbnail';
$blog_type = is_singular( 'post' )  || ( isset($doing_ajax) && $doing_ajax ) ? 'single_' . $blog_type : $blog_type;
?>
<div class="<?php echo $thumbnails_class?>">
    <a href="<?php echo isset( $link ) ? $link : get_the_permalink(); ?>">
        <?php yit_image( 'size=blog_' . $blog_type . '&class=img-responsive' ); ?>
    </a>
    <?php if( $show_date && $blog_type != 'big' && $blog_type != 'single_big' ) : ?>
        <?php if( has_post_thumbnail() ) : ?>
            <div class="yit_post_meta_date">
                <span class="day">
                    <?php echo get_the_date( 'd' ) ?>
                </span>

                <span class="month">
                    <?php echo get_the_date( 'M' ) ?>
                </span>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if( isset( $show_post_format_icon ) && $show_post_format_icon ) : ?>
        <?php if( has_post_thumbnail() ) : ?>
            <div class="yit_post_format_icon"><?php echo isset( $post_format ) ? $post_format : '' ?></div>
        <?php endif; ?>
    <?php endif; ?>

</div>