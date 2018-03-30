<?php
/**
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


$slider = YIT_Layout()->slider_name;

$static_image = YIT_Layout()->static_image;


if ( $static_image == 'yes' ) :

    $image_upload = YIT_Layout()->image_upload;
    $image_link   = YIT_Layout()->image_link;
    $image_target = YIT_Layout()->image_target;

    $image_size = yit_getimagesize( $image_upload );
    $image_id   = yit_get_attachment_id( $image_upload );
    list( $thumb_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id );

    //check if parallax effects is enabled
    $parallax = YIT_Layout()->parallax;
    if ( $parallax == 'yes' ):
        $height          = YIT_Layout()->parallax_height;
        $color           = YIT_Layout()->parallax_text_color;
        $hover_color     = YIT_Layout()->parallax_link_color;
        $valign          = YIT_Layout()->parallax_vertical_align;
        $halign          = YIT_Layout()->parallax_horizontal_align;
        $effect          = YIT_Layout()->parallax_effect;
        $content         = YIT_Layout()->parallax_content;
        $overlay_opacity = YIT_Layout()->parallax_overlay_opacity;

        $parallax = "[parallax ";
        $parallax .= " image='{$image_upload}' ";
        if( $height ) $parallax .= " height='{$height}' ";
        if( $color ) $parallax .= " color='{$color}' ";
        if( $hover_color ) $parallax .= " hover_color='{$hover_color}' ";

        if( $overlay_opacity ) $parallax .= " overlay_opacity='{$overlay_opacity}' ";

        if( $valign ) $parallax .= " valign='{$valign}' ";
        if( $halign ) $parallax .= " halign='{$halign}' ";
        if( $effect ) $parallax .= " effect='{$effect}' ";
        $parallax .= "]";

        if( $content ) $parallax .= $content;
        $parallax .= '[/parallax]';

        echo '<div class="header-parallax">' . do_shortcode($parallax) . '</div>';

    else: ?>

        <div class="slider fixed-image inner group">

            <div class="fixed-image-wrapper" style="max-width: <?php echo $image_size[0] ?>px;">
                <?php if( !empty( $image_link ) ) : ?><a href="<?php echo $image_link ?>" title="" target="<?php echo $image_target ?>"><?php endif ?>
                    <img src="<?php echo $image_upload ?>" alt="<?php bloginfo('name') ?> Header" />
                    <?php if( !empty( $image_link ) ) : ?></a><?php endif ?>
            </div>
        </div>
    <?php
    endif;
    elseif ( get_header_image() != '' ) :

    ?> <div class="slider fixed-image inner group">
        <div class="fixed-image-wrapper" style="max-width: <?php echo get_custom_header()->width ?>px;">
            <img src="<?php header_image() ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name') ?> Header" />
        </div>
    </div>
        <?php

        define( 'YIT_SLIDER_USED', true );

        // use the slider
        elseif ( ! empty( $slider ) ):
    ?>
    <?php echo do_shortcode( '[slider name="' . $slider . '"]' ); ?>
    <!-- END SLIDER -->
<?php endif;