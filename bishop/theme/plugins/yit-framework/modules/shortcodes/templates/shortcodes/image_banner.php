<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows a box with an banner, text and button
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

wp_enqueue_script( 'yit-shortcodes' );

$id_container = "image_banner_container" . $index;

$slogan = ( isset( $slogan ) ) ? $slogan : '';
$subslogan = ( isset( $subslogan ) ) ? $subslogan : '';
$image = ( isset( $background_image_url ) ) ? esc_url( $background_image_url ) : '';

$button = ( isset( $button ) && ($button == 'yes' || $button == '1' )) ? true : false;
$href = ( isset( $href ) ) ? esc_url( $href ) : '';
$nolink_class = ( $href == '' ? 'no-link' : '' );
$addedd_class = $nolink_class .' '.$box_horizontal_alignment.' '.$box_vertical_alignment;
$label_button = ( isset( $label_button ) ) ? $label_button : '';

$overlay_color = ( $overlay_color == 'black' ) ? 'rgba(0,0,0,0.3)' : 'rgba(255,255,255,0.4)';
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

$slogan_font_size = ( isset( $slogan_font_size ) &&  $slogan_font_size) ? $slogan_font_size."px" : "32px";
$subslogan_font_size = ( isset( $subslogan_font_size ) &&  $subslogan_font_size) ? $subslogan_font_size."px" : "24px";

?>

<style>

   #<?php echo $id_container;?> .banner-image{
        background-repeat: no-repeat;
   }

   #<?php echo $id_container;?> .banner-image .banner-image-slogan{
        font-size:   <?php echo $slogan_font_size ?>
    }

   #<?php echo $id_container;?> .banner-image .banner-image-subslogan{
        color: <?php echo $subslogan_color ?>;
        font-size:   <?php echo $subslogan_font_size ?>
    }

   #<?php echo $id_container;?> .banner-image:hover .banner-image-subslogan{
        color: <?php echo $subslogan_color_hover ?>;
        font-size:   <?php echo $subslogan_font_size ?>
    }

   #<?php echo $id_container;?> .banner-image a.button.image-banner{
        border-color: <?php echo $button_color; ?> !important;
        color: <?php echo $button_color; ?> !important;
    }

   #<?php echo $id_container;?> .banner-image a.button.image-banner:hover, #<?php echo $id_container;?> .banner-image:hover a.button.image-banner{
        background-color: <?php echo $button_color; ?> !important;
        color:<?php echo $button_text_hover; ?> !important;
    }
</style>


<div id="<?php echo $id_container;?>" class="banner-container <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>

    <div class="banner-image" <?php if ( $image != '' ) : ?>style="background-image: url(<?php echo $image ?>); <?php endif; ?>; height: <?php echo $banner_height ?>px">

        <div class="banner-image-content">
            <?php if ( $href != '' ) : ?>
                <a href="<?php echo $href ?>" class="banner-image-background" style="background-color:<?php echo $overlay_color ?>">
                </a>
            <?php endif; ?>
            <div class="<?php echo $addedd_class ?> banner-image-slogan-wrapper <?php echo $animate; ?>" <?php echo $animate_data ?>>
                    <span class="banner-image-slogan" style="color:<?php echo $slogan_color ?>"><?php echo $slogan ?></span>
                    <span class="banner-image-subslogan"><?php echo $subslogan ?></span>
            <?php if ( $button )  : ?>
                <a href="<?php echo $href ?>" class="button image-banner">
                    <?php echo $label_button; ?>
                </a>
            <?php endif; ?>
            </div>
        </div>
    </div>

</div>