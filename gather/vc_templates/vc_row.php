<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 *
 * @var $cth_layout
 * @var $slideshow_imgs
 * @var $usevideobg
 * @var $mp4video
 * @var $webmvideo
 * @var $oggvideo
 * @var $youtubevideo
 * @var $videobgimg
 * @var $ytvideobgimg
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
$cth_layout = 'default';
$slideshow_imgs = $usevideobg = $mp4video = $webmvideo = $oggvideo = $videobgimg = '';
// for youtube video background
$youtubevideo = $ytvideobgimg = $yt_controls = $yt_autoplay = $yt_loop = $yt_mute = $yt_opacity = $yt_quality = $yt_raster =  '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if($cth_layout === 'gather_header') :?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gather_sec',
        'header',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="background-opacity"></div>
<?php 
    if ( ! empty( $full_width ) ) { ?>
    <div class="container-fluid">
<?php }else { ?>
    <div class="container">
<?php
}    ?>
        <div class="row no-margin vc_row wpb_row <?php //echo esc_attr($el_class );?>">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
</section>
<?php elseif($cth_layout == 'gather_slideshow_sec') : ?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gather_sec',
        'header header_slideshow',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    
    <?php 
    if (!empty($slideshow_imgs)) {
        $slideshow_imgs_arrs = explode(",", $slideshow_imgs);
        ?>
        <div class="bg-slideshow-wrap">
            <div class="flexslider bg-slideshow-slider">
                <ul class="slides">
                    <?php foreach ($slideshow_imgs_arrs as $key => $sli) {?>
                    <li>
                        <div class="bg" style="background-image: url(<?php echo esc_url( gather_get_attachment_thumb_link($sli, 'gatherheader-thumb') );?>);"></div>
                    </li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
    <?php
    } ?>

    <div class="background-opacity"></div>
<?php 
    if ( ! empty( $full_width ) ) { ?>
    <div class="container-fluid">
<?php }else { ?>
    <div class="container">
<?php
}    ?>
        <div class="row no-margin vc_row wpb_row  <?php //echo esc_attr($el_class );?>">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
</section>

<?php
elseif($cth_layout === 'gather_header_video') :?>
<?php
    /**
    * @var $usevideobg
    * @var $mp4video
    * @var $webmvideo
    * @var $videobgimg
    **/
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gather_sec',
        'header-video-module',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="video-container">
        <div class="header">
        <?php 
            if ( ! empty( $full_width ) ) { ?>
            <div class="container-fluid">
        <?php }else { ?>
            <div class="container">
        <?php
        }    ?>
                <div class="row no-margin  vc_row wpb_row <?php //echo esc_attr($el_class );?>">
                    <?php echo wpb_js_remove_wpautop($content); ?>
                </div>
            </div>
        </div>
        <?php if($usevideobg == 'yes') :?>
        <div class="filter"></div>
        <video autoplay loop class="fillWidth video-header">
        <?php if(!empty($mp4video)) :?>
            <source src="<?php echo esc_url($mp4video );?>" type="video/mp4" />
        <?php endif;?>
        <?php if(!empty($webmvideo)) :?>
            <source src="<?php echo esc_url($webmvideo );?>" type="video/webm" />
        <?php endif;?>
        <?php if(!empty($oggvideo)) :?>
            <source src="<?php echo esc_url($oggvideo );?>" type="video/ogg" />
        <?php endif;?>
            <?php esc_html_e('Your browser does not support the video tag.','gather');?>
        </video>
        <?php if(!empty($videobgimg)) :?>
        <div class="poster hidden">
            <?php echo wp_get_attachment_image( $videobgimg, 'gatherheader-thumb' );?>
        </div>
        <?php endif;?>
        <?php endif;?>
    </div>
</section>
<?php
elseif($cth_layout === 'gather_header_yt_video') :?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gather_sec',
        'header-video-module youtube-video-bg',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <div class="video-container">
        <div class="header header-video">
        <?php 
            if ( ! empty( $full_width ) ) { ?>
            <div class="container-fluid">
        <?php }else { ?>
            <div class="container">
        <?php
        }    ?>
                <div class="row no-margin vc_row wpb_row <?php //echo esc_attr($el_class );?>">
                    <?php echo wpb_js_remove_wpautop($content); ?>
                </div>
            </div>
        </div>

        <?php 
        $video_datas = array();

        $video_datas['videoURL'] = !empty($youtubevideo) ? $youtubevideo: 'e8DFN3m8XGQ';
        $video_datas['containment'] = '.header-video';
        
        if($yt_controls == 'yes') {
            $video_datas['showControls'] = true;
        }else{
            $video_datas['showControls'] = false;
        }
        if($yt_autoplay == 'yes') {
            $video_datas['autoPlay'] = true;
        }else{
            $video_datas['autoPlay'] = true;
        }
        
        if($yt_loop == 'yes') {
            $video_datas['loop'] = true;
        }else{
            $video_datas['loop'] = false;
        }
        if($yt_mute == 'yes') {
            $video_datas['mute'] = true;
        }else{
            $video_datas['mute'] = false;
        }
        $video_datas['startAt'] = 0;
        if($yt_raster == 'yes') {
            $video_datas['addRaster'] = true;
        }else{
            $video_datas['addRaster'] = false;
        }
        
        $video_datas['opacity'] = !empty($yt_opacity) ? floatval($yt_opacity): 1;
        $video_datas['quality'] = !empty($yt_quality) ? $yt_quality: 'default';
        ?>
        <div class="player" data-property='<?php echo json_encode($video_datas);?>'></div>
    </div>
</section>
<?php
elseif ($cth_layout === 'gather_sec'): ?>
<?php
    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'gather_sec',
        vc_shortcode_custom_css_class( $css ),
    );
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    ?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
<?php 
    if ( ! empty( $full_width ) ) { ?>
    <div class="container-fluid">
<?php }else { ?>
    <div class="container">
<?php
}    ?>
        <div class="row no-margin vc_row wpb_row <?php echo esc_attr($el_class );?>">
            <?php echo wpb_js_remove_wpautop($content); ?>
        </div>
    </div>
    <!-- end .container -->
</section>
<?php

else :
    //for default layout;

    wp_enqueue_script( 'wpb_composer_front_js' );

    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
        $css_classes[]='vc_row-has-fill';
    }

    if (!empty($atts['gap'])) {
        $css_classes[] = 'vc_column-gap-'.$atts['gap'];
    }

    $wrapper_attributes = array();
    // build attributes for wrapper
    if ( ! empty( $el_id ) ) {
        $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
    }
    if ( ! empty( $full_width ) ) {
        $wrapper_attributes[] = 'data-vc-full-width="true"';
        $wrapper_attributes[] = 'data-vc-full-width-init="false"';
        if ( 'stretch_row_content' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
            $css_classes[] = 'vc_row-no-padding';
        }
        $after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
    }

    if ( ! empty( $full_height ) ) {
        $css_classes[] = 'vc_row-o-full-height';
        if ( ! empty( $columns_placement ) ) {
            $flex_row = true;
            $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
            if ( 'stretch' === $columns_placement ) {
                $css_classes[] = 'vc_row-o-equal-height';
            }
        }
    }

    if ( ! empty( $equal_height ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-equal-height';
    }

    if ( ! empty( $content_placement ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-content-' . $content_placement;
    }

    if ( ! empty( $flex_row ) ) {
        $css_classes[] = 'vc_row-flex';
    }

    $has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

    $parallax_speed = $parallax_speed_bg;
    if ( $has_video_bg ) {
        $parallax = $video_bg_parallax;
        $parallax_speed = $parallax_speed_video;
        $parallax_image = $video_bg_url;
        $css_classes[] = 'vc_video-bg-container';
        wp_enqueue_script( 'vc_youtube_iframe_api_js' );
    }

    if ( ! empty( $parallax ) ) {
        wp_enqueue_script( 'vc_jquery_skrollr_js' );
        $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
        $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
        if ( false !== strpos( $parallax, 'fade' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fade';
            $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
        } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fixed';
        }
    }

    if ( ! empty( $parallax_image ) ) {
        if ( $has_video_bg ) {
            $parallax_image_src = $parallax_image;
        } else {
            $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
            $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
            if ( ! empty( $parallax_image_src[0] ) ) {
                $parallax_image_src = $parallax_image_src[0];
            }
        }
        $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
    }
    if ( ! $parallax && $has_video_bg ) {
        $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

    $output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>';
    $output .= $after_output;

    echo $output;   

    // end default layout

endif; ?>