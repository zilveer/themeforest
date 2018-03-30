<?php
/**
 * Visual Composer Heading
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
if ( ! function_exists( 'vc_map_get_attributes' )
	|| ! function_exists( 'vc_shortcode_custom_css_class' )
	|| ! function_exists( 'vc_value_from_safe' )
) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_heading', $atts );
extract( $atts );

// Get text
if ( 'post_title' == $source ) {
	$text = wpex_title(); // Supports archives as well
} elseif( 'custom_field' == $source ) {
	$text = $custom_field ? get_post_meta( get_the_ID(), $custom_field, true ) : '';
} else {
	$text = trim( vc_value_from_safe( $text ) );
	$text = do_shortcode( $text );
}

// Apply filters
$text = apply_filters( 'vcex_heading_text', $text );

// Return if no heading
if ( empty( $text ) ) {
	return;
}

// Sanitize data
$tag = $tag ? $tag : 'div';

// Define vars
$output       = '';
$link_wrap    = ''; // Wrapper element for links only
$wrap_classes = array( 'vcex-heading' );
$link_html    = array();
$wrap_data    = array();
$icon_left    = $icon_right = '';

// Add classes to wrapper
if ( $style ) {
	$wrap_classes[] = 'vcex-heading-'. $style;
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
if ( $el_class ) {
	$wrap_classes[] = vcex_get_extra_class( $el_class );
}
if ( 'true' == $italic ) {
	$wrap_classes[] = 'wpex-italic';
}

// Load custom font
if ( $font_family ) {
	wpex_enqueue_google_font( $font_family );
}

// Add inline style
$heading_style_attr = vcex_inline_style( array(
	'color'               => $color,
	'font_family'         => $font_family,
	'font_size'           => $font_size,
	'letter_spacing'      => $letter_spacing,
	'font_weight'         => $font_weight,
	'text_align'          => $text_align,
	'line_height'         => $line_height,
	'border_bottom_color' => $inner_bottom_border_color_main,
) );

// Get link data
$link = vcex_build_link( $link );
if ( $link ) {
	$link_html[] = 'href="'. $link['url'] .'"';
	$link_html[] = 'title="'. $link['title'] .'"';
	$link_html[] = 'target="'. $link['target'] .'"';
	$link_wrap = $tag; // Add wrapper around link to keep tag
	$tag = 'a'; // Set tag to link
	if ( 'true' == $link_local_scroll ) {
		$wrap_classes[] = 'local-scroll-link';
	}
}

// Responsive Text
if ( 'true' == $responsive_text && $font_size ) {

	// Convert em font size to pixels
	if ( strpos( $font_size, 'em' ) !== false ) {
		$font_size = str_replace( 'em', '', $font_size );
		$font_size = $font_size * wpex_get_body_font_size();
	}

	// Convert em min-font size to pixels
	if ( strpos( $min_font_size, 'em' ) !== false ) {
		$min_font_size = str_replace( 'em', '', $min_font_size );
		$min_font_size = $min_font_size * wpex_get_body_font_size();
	}

	// Add inline Jsv
	vcex_inline_js( 'responsive_text' );

	// Add wrap classes and data
	$wrap_classes[] = 'wpex-responsive-txt';
	$wrap_data[]    = 'data-max-font-size="'. absint( $font_size ) .'"';
	$min_font_size  = $min_font_size ? $min_font_size : '21px'; // Default min equals font-size of vcex-heading
	$min_font_size  = apply_filters( 'wpex_vcex_heading_min_font_size', $min_font_size );
	$wrap_data[]    = 'data-min-font-size="'. absint( $min_font_size ) .'"';
}

// Color hover
if ( $color_hover ) {
	$wrap_classes[] = 'wpex-data-hover';
	$wrap_data[] = 'data-hover-color="'. $color_hover .'"';
}
if ( $background_hover ) {
	if ( ! isset( $wrap_classes['wpex-data-hover'] ) ) {
		$wrap_classes['wpex-data-hover'] = 'wpex-data-hover';
	}
	$wrap_classes[] = 'transition-all';
	$wrap_data[] = 'data-hover-background="'. $background_hover .'"';
}
if ( 'true' == $hover_white_text ) {
	$wrap_classes[] = 'wpex-hover-white-text';
}

// Inline js
if ( $color_hover || $background_hover ) {
	vcex_inline_js( 'data_hover' );
}

// Inner style
$inner_style_attr = vcex_inline_style( array(
	'border_color' => $inner_bottom_border_color,
) );

// Icon output
if ( $icon = vcex_get_icon_class( $atts, 'icon' ) ) {

	// Enqueue needed icon font
	if ( 'fontawesome' != $icon_type ) {
		vcex_enqueue_icon_font( $icon_type );
	}

	// Icon style
	$icon_style_attr = vcex_inline_style( array(
		'color' => $icon_color,
	) );
	
	// Icon output
	$icon_output = '<div class="vcex-icon-wrap vcex-icon-position-'. $icon_position .'"'. $icon_style_attr .'><span class="'. $icon .'"></span></div>';

	// Add icon to heading
	if ( 'left' == $icon_position ) {
		$icon_left = $icon_output;
	} else {
		$icon_right = $icon_output;
	}

}

// Implode data
$wrap_classes = implode( ' ', $wrap_classes );
$link_html    = $link_html ? ' '. implode( ' ', $link_html ) : '';
$wrap_data    = $wrap_data ? ' '. implode( ' ', $wrap_data ) : '';

// Heading output
if ( $link_wrap ) {
	$output .= '<'. $link_wrap .' class="vcex-heading-link-wrap vcex-clr">';
}

$output .= '<'. $tag .' class="'. $wrap_classes .'"'. $link_html . $heading_style_attr . $wrap_data .'>';

	$output .= '<span class="vcex-heading-inner clr"'. $inner_style_attr .'>';

		$output .= $icon_left;

			$output .= $text;

		$output .= $icon_right;

	$output .= '</span>';

$output .= '</'. $tag .'>';

if ( $link_wrap ) {
	$output .= '</'. $link_wrap .'>';
}

// Echo heading
echo $output;