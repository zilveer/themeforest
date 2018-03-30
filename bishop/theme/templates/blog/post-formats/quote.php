<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$doing_ajax = ( defined( 'DOING_AJAX' )  && DOING_AJAX  ) ? true : false;

if ( yit_get_option('general-layout-type') == 'boxed' ){
    $color = yit_get_option('container-background-color');
    $background_color = $color['color'];
} else {
    $color =  yit_get_option('background-style');
    $background_color = $color['color'];
}
?>

<div class="yit_post_quote">
    <i class="fa fa-quote-left shade-1"></i>
    <?php if( $blog_type != 'big' ) {
        yit_string( "<h2  class='quote-title' style='background: $background_color'><a href='{$link}'>", $title, "</a></h2>" );
    } else {
        if( ! is_singular( 'post' ) && ! $doing_ajax ) {
            yit_string( "<h2  class='quote-title' style='background: $background_color'><a href='{$link}'>", $title, "</a></h2>" );
        }
    }?>
    <?php if( is_singular( 'post' ) || $doing_ajax ) : ?>
        <?php the_content() ?>
    <?php else: ?>
        <?php  true == $show_read_more ?  the_content( $read_more_text ) : the_excerpt(); ?>
    <?php endif; ?>
</div>