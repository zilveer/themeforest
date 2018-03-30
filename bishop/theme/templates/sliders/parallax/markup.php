<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Markup of frontend
 *
 * @use $slider \YIT_Slider_Object The object of portfolio
 */

global $is_primary, $yit_is_parallax_slider;

if( ! defined('YIT_SLIDER_USED') ){
    define( 'YIT_SLIDER_USED', true );
}

extract( array(
    'slider_id'      => 'slider-' . $this->index,
    'width'          => $slider->get( 'config-width' ),
    'height'         => $slider->get( 'config-height' ),

    'autoplay'       => $slider->get( 'config-autoplay' ),
    'autoplay_speed' => $slider->get( 'config-autoplay_speed' ) * 1000
) );

$width_inline = ( empty( $width ) ) ? ( ( $is_primary ) ? "width:100%;" : '' ) : "width:{$width}px;";
$height_inline = ( empty( $height ) ) ? '' : "height:{$height}px;";

$slider_class = 'slider-parallax';
if ( ! $is_primary ) {
    $slider_class = 'container slider-parallax';
}

$autoplay = ( $autoplay ) ? ( 'data-autoplay="' . esc_attr( $autoplay_speed ) . '"' ) : '';
?>
<!-- BEGIN PARALLAX SLIDER -->
<div id="<?php echo $slider_id ?>"<?php $slider->item_class( $slider_class ) ?> style="<?php echo $width_inline; ?>" <?php echo $autoplay; ?>>

    <?php while ( $slider->have_posts() ) : $slider->the_post() ?>

        <?php
        $parallax           = '';
        $image_url          = array('');
        $valign             = $slider->get( 'valign' );
        $halign             = $slider->get( 'halign' );
        $effect             = $slider->get( 'effect' );
        $color              = $slider->get( 'color_content' );
        $overlay_opacity    = $slider->get( 'overlay_opacity' );
        $font_p             = $slider->get( 'font_p' );
        $video_upload_mp4   = $slider->get( 'video_upload_mp4' );
        $video_upload_ogg   = $slider->get( 'video_upload_ogg' );
        $video_upload_webm  = $slider->get( 'video_upload_webm' );

        $video_button       = $slider->get( 'video_button' );
        $video_url          = $slider->get( 'video_url' );
        $label_button_video = $slider->get( 'label_button_video' );
        $video_button_style = $slider->get( 'video_button_style' );

        if ( has_post_thumbnail( get_the_ID() ) ) {
            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-thumbnail' );
        }
        $content = get_the_content();


        $parallax = "[parallax ";
        $parallax .= " image='{$image_url[0]}' ";
        if ( $height ) {
            $parallax .= " height='{$height}' ";
        }
        if ( $color ) {
            $parallax .= " color='{$color}' ";
        }

        if ( $overlay_opacity ) {
            $parallax .= " overlay_opacity='{$overlay_opacity}' ";
        }
        if ( $valign ) {
            $parallax .= " valign='{$valign}' ";
        }
        if ( $halign ) {
            $parallax .= " halign='{$halign}' ";
        }
        if ( $font_p ) {
            $parallax .= " font_p='{$font_p}' ";
        }

        if ( $effect ) {
            $parallax .= " effect='{$effect}' ";
        }
        if ( $video_upload_mp4 ) {
            $parallax .= " video_upload_mp4='{$video_upload_mp4}' ";
        }
        if ( $video_upload_ogg ) {
            $parallax .= " video_upload_ogg='{$video_upload_ogg}' ";
        }
        if ( $video_upload_webm ) {
            $parallax .= " video_upload_webm='{$video_upload_webm}' ";
        }
        if ( $video_button ) {
            $parallax .= " video_button='{$video_button}' ";
            if ( $video_url ) {
                $parallax .= " video_url='{$video_url}' ";
            }
            if ( $label_button_video ) {
                $parallax .= " label_button_video='{$label_button_video}' ";
            }

            if ( $video_button_style ) {
                $parallax .= " video_button_style='{$video_button_style}' ";
            }
        }

        $parallax .= "]";
        if ( $content ) {
            $parallax .= $content;
        }
        $parallax .= '[/parallax]';

        ?>
        <div class="slider-parallax-item" data-effect="<?php echo $effect ?>"><?php echo do_shortcode( $parallax ) ?></div>
    <?php endwhile; ?>
</div>
<?php

$slider->reset_query();
$yit_is_parallax_slider = false;
?>
