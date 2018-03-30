<?php
/**
 * Visual Composer Milestone
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
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Define vars
$output = '';

// Milestone default args
extract( apply_filters( 'vcex_milestone_settings', array(
	'separator' => ',',
	'decimal'   => '.',
) ) );

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_milestone', $atts ) );

// Sanitize data
$number = isset( $number ) ? $number : '45';
$number = str_replace( ',', '', $number );
//$number = str_replace( '.', '', $number );

// Turn duration into seconds
$speed = $speed/1000;

// Inline js
vcex_inline_js( 'milestone' );

// Wrapper Classes
$wrap_classes = array( 'vcex-milestone', 'clr' );
if ( 'true' == $animated || 'yes' == $animated ) {
	$wrap_classes[] = 'vcex-animated-milestone';
}
if ( $classes ) {
	$wrap_classes[] = vcex_get_extra_class( $classes );
}
if ( $visibility ) {
	$wrap_classes[] = $visibility;
}
if ( $css_animation ) {
	$wrap_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $hover_animation ) {
	$wrap_classes[] = wpex_hover_animation_class( $hover_animation );
	vcex_enque_style( 'hover-animations' );
}
$wrap_classes[] = vc_shortcode_custom_css_class( $css );
$wrap_classes = implode( ' ', $wrap_classes );

// Wrap style
$wrap_style = vcex_inline_style( array(
	'width'         => $width,
	'border_radius' => $border_radius,
) );

if ( 'true' == $url_wrap && $url ) :

	$output .= '<a href="'. esc_url( $url ) .'" class="'. $wrap_classes .'"'
			. vcex_get_unique_id( $unique_id )
			. $wrap_style
			. vcex_html( 'rel_attr', $url_rel )
			. vcex_html( 'target_attr', $url_target );
	$output .= '>';

else :

	$output .= '<div class="'. $wrap_classes .'"'
			. vcex_get_unique_id( $unique_id )
			. $wrap_style;
	$output .= '>';

endif;

	// Load custom font
	if ( $number_font_family ) {
		wpex_enqueue_google_font( $number_font_family );
	}

	// Number Style
	$number_style = vcex_inline_style( array(
		'color'         => $number_color,
		'font_size'     => $number_size,
		'margin_bottom' => $number_bottom_margin,
		'font_weight'   => $number_weight,
		'font_family'   => $number_font_family,
	) );

	$output .= '<div class="vcex-milestone-number"'. $number_style .'>';

		if ( $before ) {

			$output .= '<span class="vcex-milestone-before">'. esc_html( $before ) .'</span>';

		}

		$output .= '<span class="vcex-milestone-time" data-start-val="0" data-end-val="'. floatval( $number ) .'" data-duration="'. intval( $speed ) .'" data-decimals="'. intval( $decimals ) .'" data-separator="'. esc_attr( $separator ) .'" data-decimal="'. esc_attr( $decimal ) .'">0</span>';

		if ( $after ) {

			$output .= '<span class="vcex-milestone-after">'. esc_html( $after ) .'</span>';

		}

	$output .= '</div>';

	if ( ! empty( $caption ) ) :

		// Load custom font
		if ( $caption_font_family ) {
			wpex_enqueue_google_font( $caption_font_family );
		}

		// Caption Style
		$caption_style = vcex_inline_style( array(
			'font_family' => $caption_font_family,
			'color'       => $caption_color,
			'font_size'   => $caption_size,
			'font_weight' => $caption_font,
		) );
		
		if ( $url && ! $url_wrap ) :

			$output .= '<a href="'. esc_url( $url ) .'" class="vcex-milestone-caption"'. vcex_html( 'rel_attr', $url_rel ) .''. vcex_html( 'target_attr', $url_target ) .''. $caption_style .'>'. $caption .'</a>';

		else :

			$output .= '<div class="vcex-milestone-caption"'. $caption_style .'>'. $caption .'</div>';

		endif;
		
	endif;

// Close wrap
if ( 'true' == $url_wrap && $url ) :

	$output .= '</a>';

else :

	$output .= '</div>';

endif;

echo $output;