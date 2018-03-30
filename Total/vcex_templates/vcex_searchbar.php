<?php
/**
 * Visual Composer Searchbar
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
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_searchbar', $atts ) );

// Define output var
$output = '';

// Sanitize
$placeholder = $placeholder ? $placeholder : esc_html__( 'Keywords...', 'total' );
$button_text = $button_text ? $button_text : esc_html__( 'Search', 'total' );

// Wrap Classes
$wrap_classes = array( 'vcex-searchbar clr' );
if ( 'true' == $fullwidth_mobile ) {
	$wrap_classes[] = 'vcex-fullwidth-mobile';
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
if ( $classes ) {
	$wrap_classes[] = vcex_get_extra_class( $classes );
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}

// Form classes
$input_classes = 'vcex-searchbar-input';
$input_classes .= ' '. vc_shortcode_custom_css_class( $css );

// Wrap style
$wrap_style = vcex_inline_style( array(
	'width' => $wrap_width,
	'float' => $wrap_float,
) );

// Input style
$input_style = vcex_inline_style( array(
	'color'          => $input_color,
	'font_size'      => $input_font_size,
	'text_transform' => $input_text_transform,
	'letter_spacing' => $input_letter_spacing,
	'font_weight'    => $input_font_weight,
) );

// Button style
$button_style = vcex_inline_style( array(
	'width'          => $button_width,
	'background'     => $button_bg,
	'color'          => $button_color,
	'font_size'      => $button_font_size,
	'text_transform' => $button_text_transform,
	'letter_spacing' => $button_letter_spacing,
	'font_weight'    => $button_font_weight,
	'border_radius'  => $button_border_radius,
) );

// Button classes and data
$button_classes = 'vcex-searchbar-button';
$button_data = '';
if ( $button_bg_hover ) {
	$button_data .= ' data-hover-background="'. $button_bg_hover .'"';
}
if ( $button_color_hover ) {
	$button_data .= ' data-hover-color="'. $button_color_hover .'"';
}
if ( $button_bg_hover || $button_color_hover ) {
	$button_classes .= ' wpex-data-hover';
	vcex_inline_js( 'data_hover' );
}

$output .= '<div class="'. implode( ' ', $wrap_classes ) .'"'. vcex_get_unique_id( $unique_id ) . $wrap_style .'>';

	$output .= '<form method="get" class="vcex-searchbar-form" action="'. esc_url( home_url( '/' ) ) .'"'. $input_style .'>';

		$output .= '<input type="search" class="'. $input_classes .'" name="s" placeholder="'. $placeholder .'"'. vcex_inline_style( array( 'width' => $input_width ) ) .' />';
		
		if ( $advanced_query ) :

			// Sanitize
			$advanced_query = trim( $advanced_query );
			$advanced_query = html_entity_decode( $advanced_query );

			// Convert to array
			$advanced_query = parse_str( $advanced_query, $advanced_query_array );

			// If array is valid loop through params
			if ( $advanced_query_array ) :

				foreach( $advanced_query_array as $key => $val ) :

					$output .= '<input type="hidden" name="'. $key .'" value="'. $val .'">';

				endforeach;

			endif;

		endif;

		$output .= '<button type="submit" class="'. $button_classes .'"'. $button_data . $button_style .'>';
			$output .= str_replace( '``', '"', $button_text );
		$output .= '</button>';

	$output .= '</form>';

$output .= '</div>';

echo $output;