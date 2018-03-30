<?php
/**
 * Visual Composer List Item
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
$atts = vc_map_get_attributes( 'vcex_list_item', $atts );
extract( $atts );

// Output var
$output = '';

// Get icon classes
$icon = vcex_get_icon_class( $atts, 'icon' );

// Enqueue needed icon font
if ( $icon && 'fontawesome' != $icon_type ) {
	vcex_enqueue_icon_font( $icon_type );
}

// Load custom font
if ( $font_family ) {
	wpex_enqueue_google_font( $font_family );
}

// Get link
$url = isset( $atts['url'] ) ? $atts['url'] : '';
if ( $link ) {
	$link_url_temp  = $link;
	$link_url       = vcex_get_link_data( 'url', $link_url_temp );
	if ( $link_url ) {
		$url         = $link_url;
		$link_title  = isset( $atts['link_title'] ) ? $atts['link_title'] : '';
		$link_target = isset( $atts['link_target'] ) ? $atts['link_target'] : '';
		$url_title   = vcex_get_link_data( 'title', $link_url_temp, $link_title );
		$url_target  = vcex_get_link_data( 'target', $link_url_temp, $link_target );
		$url_target  = vcex_html( 'target_attr', $url_target );
	}
}

// Classes & data
$wrap_classes = array( 'vcex-list_item' );
$wrap_data    = array();
if ( $classes ) {
	$wrap_classes[] = vcex_get_extra_class( $classes );
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
if ( $css ) {
	$wrap_classes[] = vc_shortcode_custom_css_class( $css );
}
$wrap_classes = implode( ' ', $wrap_classes );

// Main Styles
$wrap_style = vcex_inline_style( array(
	'font_family' => $font_family,
	'font_size'   => $font_size,
	'color'       => $font_color,
	'text_align'  => $text_align
) );

$output .= '<div class="'. $wrap_classes .'"'. $wrap_style . vcex_get_unique_id( $unique_id ) .'>';

	// Open link tag
	if ( $url ) :

		// Inline sytle for the link
		$link_style = vcex_inline_style( array(
			'color' => $font_color,
		) );

		$output .= '<a href="'. esc_url( $url ) .'"'. vcex_html( 'title_attr', $url_title ) .''. $url_target .''. $link_style .'>';

	endif; // End link check

	// Add icon if defined
	if ( $icon ) {

		// Icon classes
		$icon_wrap_classes = 'vcex-icon-wrap';

		// Icon inline style
		$icon_style = vcex_inline_style( array(
			'background'    => $icon_background,
			'width'         => $icon_width,
			'border_radius' => $icon_border_radius,
			'height'        => $icon_height,
			'line_height'   => wpex_sanitize_data( $icon_height, 'px' ),
			'margin_right'  => $margin_right,
			'font_size'     => $icon_size,
			'color'         => $color,
		) );
		
		// Add icon to output
		$output .= '<div class="'. $icon_wrap_classes .'"'. $icon_style .'><span class="'. $icon .'"></span></div>';

	}

	// Add content to output
	if ( $content ) {
		$output .= do_shortcode( $content );
	}
	
	// Close link tag
	if ( $url ) {
		$output .= '</a>';
	}

$output .= '</div>';

echo $output;