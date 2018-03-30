<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$blog_type          = is_singular( 'post' )  ? 'single_' . $blog_type : $blog_type;
?>

<div class="<?php echo $show_thumbnail ? 'thumbnail' : 'no-thumbnail' ?> <?php echo $blog_type ?>">
    <?php if( $show_thumbnail ) : ?>
        <?php if( ! is_singular( 'post' ) ) : ?>
            <a href="<?php echo isset( $link ) ? $link : get_the_permalink(); ?>">
        <?php endif; ?>
            <?php yit_image( 'size=blog_' . $blog_type . '&class=img-responsive&alt='.get_the_title() ); ?>
            <?php if( ! is_singular('post') && $show_post_format_icon ) : ?>
                <div class="yit_post_format_icon"><?php echo isset( $post_format ) ? $post_format : '' ?></div>
            <?php endif; ?>
        <?php if( ! is_singular( 'post' ) ) : ?>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if( $show_date && ! is_singular( 'post' ) ) : ?>
        <div class="yit_post_meta_date">
            <span class="day">
                <?php echo get_the_date( 'd' ) ?>
            </span>

            <span class="month">
                <?php echo get_the_date( 'M' ) ?>
            </span>
        </div>
    <?php endif; ?>
</div>
