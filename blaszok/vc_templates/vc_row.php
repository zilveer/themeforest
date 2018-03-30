<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
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
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
global $mpc_atts;
$output = $after_output = $before_content = $after_content = '';
$mpc_atts = shortcode_atts( array(
	'el_class'                => '',
    'bg_image'                => '',
    'bg_color'                => '',
    'bg_image_repeat'         => '',
    'font_color'              => '',
    'padding'                 => '',
    'margin_bottom'           => '',
    'overlay_color'           => '',
    'overlay_color_opacity'   => '',
    'overlay_pattern'         => '',
    'overlay_pattern_opacity' => '',
    'full_width'              => '',
    'full_page_width'         => '',
    'parallax'                => '',
    'bg_image_fb'             => '',
    'bg_image_repeat_fb'      => '',
    'toc_id'                  => '',
    'css_animation'           => '',
    'css'                     => ''
), $atts );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_script( 'wpb_composer_front_js' );

if( $mpc_atts[ 'full_width' ] == '1' || $mpc_atts[ 'parallax' ] == '1' || $mpc_atts[ 'full_page_width' ] == '1' || $mpc_atts[ 'bg_image' ] ) {
	include( 'mpc_vc_row.php' );
	return;
}

if( empty( $el_id ) && !empty( $mpc_atts[ 'toc_id' ] ) ) $el_id = $mpc_atts[ 'toc_id' ];

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	'mpcth-vc-row-wrap',
	( $mpc_atts[ 'bg_image' ] || $parallax_image || $video_bg_parallax ? ' mpcth-vc-row-wrap-image ' : ''),
	( $mpc_atts[ 'overlay_pattern' ] || $mpc_atts[ 'overlay_color' ] ? 'mpcth-vc-row-wrap-overlay' : '' ),
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
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty ( $parallax_image ) || ! empty( $mpc_atts[ 'bg_image' ] ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else if( $mpc_atts[ 'bg_image' ] ) { // Custom
		$parallax_image_src = wp_get_attachment_image_src( $mpc_atts[ 'bg_image' ], 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}

		if( ! empty( $mpc_atts[ 'bg_image_repeat' ] ) ) {
			$wrapper_attributes[] = ' style="background-repeat:' . $mpc_atts[ 'bg_image_repeat' ]. ';"';
		}
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

if( ! empty( $mpc_atts[ 'overlay_color' ] ) || !empty( $mpc_atts[ 'overlay_pattern' ] ) ) {
	if ((string)(int)$mpc_atts[ 'overlay_color_opacity' ] === $mpc_atts[ 'overlay_color_opacity' ])
		$overlay_color_opacity = max(min($mpc_atts[ 'overlay_color_opacity' ], 100), 0);
	else
		$overlay_color_opacity = 1;

	if ((string)(int)$mpc_atts[ 'overlay_pattern_opacity' ] === $mpc_atts[ 'overlay_pattern_opacity' ])
		$overlay_pattern_opacity = max(min($mpc_atts[ 'overlay_pattern_opacity' ], 100), 0);
	else
		$overlay_pattern_opacity = 1;

	$overlay_color = $mpc_atts[ 'overlay_color' ];
	$overlay_pattern = $mpc_atts[ 'overlay_pattern' ];

	if ( $overlay_pattern )
        $before_content .= '<div class="mpcth-overlay mpcth-overlay-pattern" style="background-image: url(' . wp_get_attachment_url($overlay_pattern) . '); opacity: ' . ($overlay_pattern_opacity / 100) . '; filter: alpha(opacity=' . $overlay_pattern_opacity . ');"></div>';
    if ( $overlay_color )
        $before_content .= '<div class="mpcth-overlay mpcth-overlay-color" style="background-color: ' . $overlay_color . '; opacity: ' . ($overlay_color_opacity / 100) . '; filter: alpha(opacity=' . $overlay_color_opacity . ');"></div>';
}

if( ! empty( $mpc_atts[ 'font_color' ] ) ) {
	$wrapper_attributes[] = ' style="color:' . $mpc_atts[ 'font_color' ] . ';"';
}

if ( ! empty( $full_width ) && $full_width != '1' ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	} else {
		$before_content .= '<div class="mpcth-stretch-row_content">';
		$after_content .= '</div>';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( $mpc_atts[ 'bg_image' ] || $parallax_image ) {
	$after_content .= '<div class="mpcth-vc-row-wrap-arrow"></div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_anim_class = isset( $css_animation) ? $this->getCSSAnimation($css_animation) : '';
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . $css_anim_class . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $before_content;
$output .= wpb_js_remove_wpautop( $content );
$output .= $after_content;
$output .= '</div>';
$output .= $after_output;

echo $output;