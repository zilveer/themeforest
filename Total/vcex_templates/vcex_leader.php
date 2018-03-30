<?php
/**
 * Visual Composer Leader
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.3
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
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_param_group_parse_atts' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_leader', $atts ) );

$leaders = (array) vc_param_group_parse_atts( $leaders );

if ( $leaders ) {

	$responsive = ( wpex_global_obj( 'responsive' ) && 'true' == $responsive ) ? true : false;

	$inline_style = vcex_inline_style( array(
		'color'      => $color,
		'font_size'  => $font_size,
	) );

	$classes = 'vcex-leader vcex-leader-'. $style .' vcex-clr';
	if ( $responsive ) {
		$classes .= ' vcex-responsive';
	}
	if ( $el_class ) {
		$classes .= ' '. vcex_get_extra_class( $el_class );
	}

	$output = '<ul class="'. $classes .'"'. $inline_style .'>';

	$label_typo = vcex_inline_style( array(
		'color'       => $label_color,
		'font_weight' => $label_font_weight,
		'font_style'  => $label_font_style,
		'font_family' => $label_font_family,
		'background'  => $background,
	) );

	if ( $label_font_family ) {
		wpex_enqueue_google_font( $label_font_family );
	}

	$value_typo = vcex_inline_style( array(
		'color'       => $value_color,
		'font_weight' => $value_font_weight,
		'font_style'  => $value_font_style,
		'font_family' => $value_font_family,
		'background'  => $background,
	) );

	if ( $value_font_family ) {
		wpex_enqueue_google_font( $value_font_family );
	}

	foreach ( $leaders as $leader ) {

		$label = isset( $leader['label'] ) ? $leader['label'] : esc_html__( 'Label', 'total' );
		$value = isset( $leader['value'] ) ? $leader['value'] : esc_html__( 'Value', 'total' );

		$output .= '<li>';
			$output .= '<span class="vcex-first"'. $label_typo .'>'. esc_html( $label ) .'</span>';
			if ( $responsive ) {
				$output .= '<span class="vcex-inner">...</span>';
			}
			$output .= '<span class="vcex-last"'. $value_typo .'>'. esc_html( $value ) .'</span>';
		$output .= '</li>';

	}

	$output .= '</ul>';

	echo $output;

}