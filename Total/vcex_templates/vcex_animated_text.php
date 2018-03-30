<?php
/**
 * Visual Composer Animated Text
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.1
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
	|| ! function_exists( 'vc_param_group_parse_atts' )
	|| ! function_exists( 'vc_shortcode_custom_css_class' )
) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_animated_text', $atts ) );

// Convert strings
$strings = (array) vc_param_group_parse_atts( $strings );

// Display shortcode
if ( $strings ) {

	vcex_inline_js( 'typed_text' );

	$data = array();
	foreach ( $strings as $string ) {
		if ( isset( $string['text'] ) ) {
			$data[] = $string['text'];
		}
	}

	$settings = array(
		'typeSpeed'  => $speed ? intval( $speed ) : '0',
		'loop'       => wpex_sanitize_data( $loop, 'boolean' ),
		'showCursor' => wpex_sanitize_data( $type_cursor, 'boolean' ),
		'backDelay'  => $back_delay ? intval( $back_delay ) : '0',
		'backSpeed'  => $back_speed ? intval( $back_speed ) : '0',
		'startDelay' => $start_delay ? intval( $start_delay ) : '0',
	);

	if ( $css ) {
		$css = ' '. vc_shortcode_custom_css_class( $css );
	}

	$inline_style = vcex_inline_style( array(
		'color'       => $color,
		'font_size'   => $font_size,
		'font_weight' => $font_weight,
		'font_style'  => $font_style,
		'font_family' => $font_family,
		'text_align'  => $text_align,
	) );

	if ( 'true' == $static_text ) {
		$typed_inline_style = vcex_inline_style( array(
			'color'           => $animated_color,
			'font_weight'     => $animated_font_weight,
			'font_style'      => $animated_font_style,
			'font_family'     => $animated_font_family,
			'text_decoration' => $animated_text_decoration,
		) );
	} else {
		$typed_inline_style = null;
	}

	$output = '<div class="vcex-typed-text-wrap vcex-clr vcex-module'. $css .'"'. $inline_style .'>';

		if ( 'true' == $static_text && $static_before ) {
			$output .= '<span class="vcex-before">'. $static_before .'</span> ';
		}

		if ( $animated_css || $typed_inline_style ) {
			$animated_css = $animated_css ? ' '. vc_shortcode_custom_css_class( $animated_css ) : '';
			$output .= '<span class="vcex-typed-text-css'. $animated_css .'"'. $typed_inline_style .'>';
		}

		$output .= '<span class="vcex-typed-text" data-settings="'. htmlentities( json_encode( $settings ) ) .'" data-strings="'. htmlentities( json_encode( $data ) ) .'"></span>';

		if ( $animated_css ) {
			$output .= '</span>';
		}

		if ( 'true' == $static_text && $static_after ) {
			$output .= ' <span class="vcex-after">'. $static_after .'</span>';
		}

	$output .= '</div>';

	echo $output;

}