<?php
/**
 * Visual Composer Icon
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) ) {
	vcex_function_needed_notice();
	return;
}

// FALLBACK VARS => NEVER REMOVE !!!
$padding     = isset( $atts['padding'] ) ? $atts['padding'] : '';
$style       = isset( $atts['style'] ) ? $atts['style'] : '';
$link_title  = isset( $atts['link_title'] ) ? $atts['link_title'] : '';
$link_target = isset( $atts['link_target'] ) ? $atts['link_target'] : '';

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_icon', $atts );
extract( $atts );

// Sanitize data & declare vars
$output = '';
$icon = vcex_get_icon_class( $atts, 'icon' );
$data_attributes = '';

// Enqueue needed icon font
if ( $icon && 'fontawesome' != $icon_type ) {
	vcex_enqueue_icon_font( $icon_type );
}

// Link attributes and wrap_classes
if ( $link_url ) {

	// Generate link
	$link_url_temp = $link_url;
	$link_url = vcex_get_link_data( 'url', $link_url_temp );

	if ( $link_url ) {

		// Link attributes
		$link_title  = vcex_get_link_data( 'title', $link_url_temp, $link_title );
		$link_title  = vcex_html( 'title_attr', $link_title );
		$link_target = vcex_get_link_data( 'target', $link_url_temp, $link_target );

		// Link wrap_classes
		$link_wrap_classes = array( 'vcex-icon-link' );

		// Local links
		if ( 'true' == $link_local_scroll || 'local' == $link_target ) {
			$link_target = '';
			$link_wrap_classes[] = 'local-scroll-link';
		}

		// Generate link target HTMl
		else {
			$link_target = vcex_html( 'target_attr', $link_target );
		}

	}

}

// Add styling
$icon_style = vcex_inline_style( array(
	'font_size'        => $custom_size,
	'color'            => $color,
	'padding'          => $padding,
	'background_color' => $background,
	'border_radius'    => $border_radius,
	'height'           => $height,
	'line_height'      => wpex_sanitize_data( $height, 'px' ),
	'width'            => $width,
	'border'           => $border,
) );

// Icon Classes 
$wrap_classes = array( 'vcex-icon', 'clr' );
if ( $style ) {
	$wrap_classes[] = 'vcex-icon-'. $style;
}
if ( $size ) {
	$wrap_classes[] = 'vcex-icon-'. $size;
}
if ( $float ) {
	$wrap_classes[] = 'vcex-icon-float-'. $float;
}
if ( $custom_size ) {
	$wrap_classes[] = 'custom-size';
}
if ( $background ) {
	$wrap_classes[] = 'has-bg';
}
if ( ! $background ) {
	$wrap_classes[] = 'remove-dimensions';
}
if ( $height || $width ) {
	$wrap_classes[] = 'remove-padding';
	$wrap_classes[] = 'remove-dimensions';
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $el_class ) {
	$wrap_classes[] = vcex_get_extra_class( $el_class );
}
$wrap_classes = implode( ' ', $wrap_classes );

// Icon classes
$icon_classes = 'vcex-icon-wrap';
if ( $hover_animation ) {
	$icon_classes .= ' '. wpex_hover_animation_class( $hover_animation );
	vcex_enque_style( 'hover-animations' );
}

// Icon hovers
if ( $color_hover || $background_hover ) {

	// Add hover background data attribute
	if ( $background_hover ) {
		$data_attributes .= ' data-hover-background="'. $background_hover .'"';
	}

	// Add hover color data
	if ( $color_hover ) {
		$data_attributes .= ' data-hover-color="'. $color_hover .'"';
	}

	// Check for data attributes
	if ( $data_attributes ) {

		// Add hover class to wrap classes
		$icon_classes .= ' wpex-data-hover';

	}

	// Load js for front end composer
	vcex_inline_js( 'data_hover' );

}

$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .'>';

	// Open link tag
	if ( $link_url ) :

		// Turn link wrap_classes into string
		$link_wrap_classes = implode( ' ', $link_wrap_classes );

		$output .= '<a href="'. $link_url .'" class="'. $link_wrap_classes .'"'. $link_title . $link_target .'>';

	endif;

	$output .= '<div class="'. $icon_classes .'"'. $icon_style .''. $data_attributes .'>';
		$output .= '<span class="'. $icon .'"></span>';
	$output .= '</div>';

	// Close link tag
	if ( $link_url ) {
		$output .= '</a>';
	}

$output .= '</div>';

echo $output;