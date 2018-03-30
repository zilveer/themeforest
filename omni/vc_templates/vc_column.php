<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $parallax
 * @var $enable_video_bg
 * @var $self_hosted_video_poster
 * @var $hosted_video_bg_mp4
 * @var $hosted_video_bg_webm
 * @var $video_bg_loop
 * @var $video_bg_mute
 * @var $enable_overlay
 * @var $overlay_image
 * @var $overlay_color
 * @var $font_color
 * @var $animated
 * @var $animation_delay
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Column
 */
$el_class = $width = $css = $offset = $overlay_style = '';
$output   = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

if ( $enable_video_bg == '1' ) {
	$el_class .= ' enable-video-bg';
}
if ( isset( $font_color ) && ! ( $font_color == '' ) ) {
	$el_class .= ' color-changed ';
	$style = 'style="color:' . $font_color . '"';
} else {
	$style = '';
}

if ( isset( $animated ) && ! ( 'none' === $animated ) ) {
	$animation_class = 'wow ' . $animated;
} else {
	$animation_class = '';
}

if(isset($animation_delay) && !empty($animation_delay)){
	$delay = 'data-wow-delay="'.$animation_delay . 's"';
}else{
	$delay = '';
}

if ( 'bg_fix' === $parallax ) {
	$parallax_class = 'column-fixed-wrapper';
} else {
	$parallax_class = '';
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
	vc_shortcode_custom_css_class( $css ),
	$animation_class,
	$parallax_class,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

if ( ! empty( $parallax ) && ( 'bg_fix' !== $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[]        = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
		$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
		$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
	} elseif ( 'bg_fix' === $parallax ) {
		$data_vc_parallax = array_search( 'data-vc-parallax="1.5"', $wrapper_attributes );
		unset( $wrapper_attributes[ $data_vc_parallax ] );
		$css_classes[] = 'fixed-bg';
	}

}

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

$wrapper_attributes = array();

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . $video_bg_output . ' ' . $style . ' '.$delay.'>';
if ( isset( $self_hosted_video_poster ) && ! ( $self_hosted_video_poster == '' ) ) {
	$img     = wp_get_attachment_image_src( $self_hosted_video_poster, 'full' );
	$img_url = $img[0];

	if ( isset( $img_url ) && ! ( $img_url == '' ) ) {
		echo '<div class="video-poster" style="background: url(' . esc_url( $img_url ) . ') center no-repeat;"></div>';
	}
}
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
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
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
