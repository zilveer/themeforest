<?php
/**
 * Visual Composer Divider
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

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_divider_dots', $atts ) );

// Sanitize vars
$count = $count ? $count : '3';

// Wrap classes
$wrap_classes = array( 'vcex-divider-dots', 'vcex-clr' );
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $el_class ) {
	$wrap_classes[] = vcex_get_extra_class( $el_class );
}
if ( $align ) {
	$wrap_classes[] = 'text'. $align;
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
$wrap_classes = implode( ' ', $wrap_classes );

// Define output var
$output = '';

// Wrap style
$wrap_style = vcex_inline_style( array(
	'padding_top'    => $margin_top,
	'padding_bottom' => $margin_bottom,
) );

// Span style
$span_style = vcex_inline_style( array(
	'height'     => $size,
	'width'      => $size,
	'background' => $color,
) );

// Return output
$output .= '<div class="'. $wrap_classes .'"'. $wrap_style .'>';
	for ( $k = 0; $k < $count; $k++ ) {
		$output .= '<span'. $span_style .'></span>';
	}
$output .= '</div>';

// Echo output
echo $output;