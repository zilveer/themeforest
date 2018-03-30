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
 * @var $enable_video_bg
 * @var $self_hosted_video_poster
 * @var $hosted_video_bg_mp4
 * @var $hosted_video_bg_webm
 * @var $video_bg_loop
 * @var $video_bg_mute
 * @var $enable_overlay
 * @var $overlay_image
 * @var $overlay_color
 * @var $overlay_opacity
 * @var $enable_poster
 * @var $poster_image
 * @var $poster_text
 * @var $poster_text_color
 * @var $poster_row_id
 * @var $font_color
 * @var $enable_mouse_scroll_button
 * @var $enable_moving_bg
 * @var $moving_bg_direction
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = $fixed_parallax = $style = $overlay_style = '';
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

if ( $enable_video_bg == '1' ) {
	$el_class .= ' enable-video-bg';
}

if ( isset( $font_color ) && ! ( $font_color == '' ) ) {
	$el_class .= ' color-changed ';
	$style = ' style="color:'.$font_color.'" ';
}

$css_classes        = array(
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
	$wrapper_attributes[] = 'data-id="' . esc_attr( $el_id ) . '"';
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( isset( $enable_moving_bg ) && ( $enable_moving_bg === '1' ) ) {
	if ( isset( $moving_bg_direction ) && ( $moving_bg_direction === 'right' ) ) {
		$css_classes[] = ' to-right-animate-bg';
	} else {
		$css_classes[] = ' to-left-animate-bg';
	}
}

if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[]        = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = ' vc_row-o-columns-' . $columns_placement;
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = ' vc_row-flex';
}

// use default video if user checked video, but didn't chose url
if ( ! empty( $video_bg ) && empty( $video_bg_url ) ) {
	$video_bg_url = 'https://www.youtube.com/watch?v=lMJXxhRFO1k';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax       = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[]  = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
		$css_classes[]        = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
		$css_classes[] = 'js-vc_parallax-o-fixed';
	} elseif( 'bg_fix' === $parallax){
		$data_vc_parallax = array_search('data-vc-parallax="1.5"',$wrapper_attributes);
		unset($wrapper_attributes[$data_vc_parallax]);
		$css_classes[] = 'fixed-bg';
	}

}

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id  = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	if('bg_fix' === $parallax){
		$fixed_parallax = '<div class="fixed-wrapper"><div class="fixed-inner" style="background: url('.$parallax_image_src.') no-repeat;"></div></div>';

	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if ( $enable_video_bg == '1' ) {

	wp_enqueue_script( 'vide-js', get_template_directory_uri() . '/js/jquery.vide.min.js' );

	if ( ( isset( $hosted_video_bg_mp4 ) && ! ( $hosted_video_bg_mp4 == '' ) ) || ( isset( $hosted_video_bg_webm ) && ! ( $hosted_video_bg_webm == '' ) ) ) {

		$video_bg_output = 'data-vide-bg="';

		if ( isset( $hosted_video_bg_mp4 ) && ! ( $hosted_video_bg_mp4 == '' ) ) {
			$video_bg_output .= 'mp4: ' . $hosted_video_bg_mp4 . ', ';
		}

		if ( isset( $hosted_video_bg_webm ) && ! ( $hosted_video_bg_webm == '' ) ) {
			$video_bg_output .= ' webm:' . $hosted_video_bg_webm . ' ';
		}
		$video_bg_output .= '"';

		$video_bg_output .= ' data-vide-options="posterType: \'none\'';

		if ( $video_bg_mute == '1' ) {
			$video_bg_output .= 'muted:true, ';
		} else {
			$video_bg_output .= 'muted:false, ';
		}

		if ( $video_bg_loop == '1' ) {
			$video_bg_output .= 'loop: true, ';
		} else {
			$video_bg_output .= 'loop: false, ';
		}

		$video_bg_output .= ' position: 50% 50%"';

	}
} else {
	$video_bg_output = '';
}

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . $video_bg_output . ' ' . $style . ' >';

if ( isset( $self_hosted_video_poster ) && ! ( $self_hosted_video_poster == '' ) ) {
	$img     = wp_get_attachment_image_src( $self_hosted_video_poster, 'full' );
	$img_url = $img[0];

	if ( ! empty ( $img_url  ) ) {
		$output .= '<div class="video-poster" style="position: absolute; z-index: -2; top: 0px; left: 0px; bottom: 0px; right: 0px; overflow: hidden; background-image: url(' . esc_url( $img_url ) . '); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></div>';
	}
}


if ( $enable_overlay == '1' ) {
	$overlay_output = '';
	if ( ( isset( $overlay_image ) && ! ( $overlay_image == '' ) ) || ( isset( $overlay_color ) && ! ( $overlay_color == '' ) ) ) {
		$overlay_style = 'style="';

		if ( isset( $overlay_image ) && ! ( $overlay_image == '' ) ) {

			$img     = wp_get_attachment_image_src( $overlay_image, 'large' );
			$img_url = $img[0];

			if ( isset( $img_url ) && ! ( $img_url == '' ) ) {
				$overlay_style .= 'background-image:url(' . $img_url . '); ';
			}

		}

		if ( isset( $overlay_color ) && ! ( $overlay_color == '' ) ) {

			$overlay_style .= 'background-color:' . $overlay_color . '; ';

		}

		$overlay_style .= '"';
	}

	$overlay_output .= '<div class="bg-span" ' . $overlay_style . '></div>';

	$output .= $overlay_output;

}
$output .= wpb_js_remove_wpautop( $content );

if ( '1' === $enable_mouse_scroll_button ) {
	$output .= '<div class="mouse-icon"></div>';
}
$output .= $fixed_parallax;
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo( $output );