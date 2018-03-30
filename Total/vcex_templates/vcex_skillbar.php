<?php
/**
 * Visual Composer Skillbar
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
$atts = vc_map_get_attributes( 'vcex_skillbar', $atts );
extract( $atts );

// Define output var
$output = '';

// Load inline js
vcex_inline_js( array( 'skillbar' ) );

// Classes
$wrapper_classes = array( 'vcex-skillbar clr' );
if ( 'false' == $box_shadow ) {
   $wrapper_classes[] = ' disable-box-shadow';
}
if ( $visibility ) {
    $wrapper_classes[] = $visibility;
}
if ( $css_animation ) {
	$wrapper_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $classes ) {
	$wrapper_classes[] = vcex_get_extra_class( $classes );
}

// Set icon and enqueue font styles
if ( 'true' == $show_icon ) {
	$icon = vcex_get_icon_class( $atts, 'icon' );
	if ( $icon && 'fontawesome' != $icon_type ) {
		vcex_enqueue_icon_font( $icon_type );
	}
}

// Style
$wrapper_style = vcex_inline_style( array(
	'background' => $background,
	'font_size' => $font_size,
	'height_px' => $container_height,
	'line_height_px' => $container_height,
) );
$title_style = vcex_inline_style( array(
	'background' => $color,
	'padding_left' => $container_padding_left,
) );
$bar_style = vcex_inline_style( array(
	'background' => $color,
) );

// Start shortcode output
$output .= '<div class="'. implode( ' ', $wrapper_classes ) .'" data-percent="'. intval( $percentage ) .'&#37;"'. vcex_get_unique_id( $unique_id ) . $wrapper_style .'>';
	
	// Title
	$output .= '<div class="vcex-skillbar-title"'. $title_style .'>';

		$output .= '<div class="vcex-skillbar-title-inner">';

				// Display icon
				if ( 'true' == $show_icon && $icon ) :

					$output .= '<span class="vcex-icon-wrap"><span class="'. $icon .'"></span></span>';

				endif;

			$output .= $title;

		$output .= '</div>';

	$output .= '</div>';

	// Percentage
	if ( $percentage ) :

		$output .= '<div class="vcex-skillbar-bar"'. $bar_style .'>';

			// Display perfect value
			if ( 'true' == $show_percent ) :

				$output .= '<div class="vcex-skill-bar-percent">'. intval( $percentage ) .'&#37;</div>';

			endif;

		$output .= '</div>';

	endif;

$output .= '</div>';

echo $output;