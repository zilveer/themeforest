<?php
/**
 * Visual Composer Pricing
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
extract( vc_map_get_attributes( 'vcex_pricing', $atts ) );

// Define output var
$output = '';

// Sanitize vars
$inline_js  = array();
$button_url = $custom_button ? false : $button_url;

// Wrapper classes
$time_start = microtime( true );
$wrapper_classes = array( 'vcex-pricing' );
if ( 'yes' == $featured ) {
	$wrapper_classes[] = 'featured';
}
if ( $css_animation ) {
	$wrapper_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $el_class ) {
	$wrapper_classes[] = vcex_get_extra_class( $el_class );
}
if ( $visibility ) {
	$wrapper_classes[] = $visibility;
}
if ( $hover_animation ) {
	$wrapper_classes[] = wpex_hover_animation_class( $hover_animation );
	vcex_enque_style( 'hover-animations' );
}
$wrapper_classes = implode( ' ', $wrapper_classes );

// Plan style
if ( $plan ) {
	$plan_style = vcex_inline_style( array(
		'margin'         => $plan_margin,
		'padding'        => $plan_padding,
		'background'     => $plan_background,
		'color'          => $plan_color,
		'font_size'      => $plan_size,
		'font_weight'    => $plan_weight,
		'letter_spacing' => $plan_letter_spacing,
		'border'         => $plan_border,
		'text_transform' => $plan_text_transform,
	) );
}

// Cost Wrap style
if ( $cost ) {
	$cost_wrap_style = vcex_inline_style( array(
		'background' => $cost_background,
		'padding'    => $cost_padding,
		'border'    => $cost_border,
	) );
	$cost_style = vcex_inline_style( array(
		'color'       => $cost_color,
		'font_size'   => $cost_size,
		'font_weight' => $cost_weight,
	) );
}

// Per style
if ( $per ) {
	$per_style = vcex_inline_style( array(
		'display'        => $per_display,
		'font_size'      => $per_size,
		'color'          => $per_color,
		'font_weight'    => $per_weight,
		'text_transform' => $per_transform,
	) );
}

// Features Style
if ( $content ) {
	 $features_style = vcex_inline_style( array(
		'padding'    => $features_padding,
		'background' => $features_bg,
		'border'     => $features_border,
		'color'      => $font_color,
		'font_size'  => $font_size,
	) );
}

// Button URL & attributes
if ( $button_url ) {

	$button_url_temp = $button_url;
	$button_url      = vcex_get_link_data( 'url', $button_url_temp );

	if ( $button_url ) {

		$button_title  = vcex_get_link_data( 'title', $button_url_temp );
		$button_target = vcex_get_link_data( 'target', $button_url_temp );
		$button_target = vcex_html( 'target_attr', $button_target );

	}

}

// Button Icons, Classes & Style
if ( $button_url || $custom_button ) {

	// Button Wrap Style
	$button_wrap_style = vcex_inline_style( array(
		'padding'    => $button_wrap_padding,
		'border'     => $button_wrap_border,
		'background' => $button_wrap_bg,
	) );

	// VCEX button styles
	if ( $button_url ) {

		// Get correct icon classes
		$button_icon_left  = vcex_get_icon_class( $atts, 'button_icon_left' );
		$button_icon_right = vcex_get_icon_class( $atts, 'button_icon_right' );

		if ( $button_icon_left || $button_icon_right ) {
			vcex_enqueue_icon_font( $icon_type );
		}

		// Button Classes
		$button_classes = wpex_get_button_classes( $button_style, $button_style_color );
		if ( 'true' == $button_local_scroll ) {
			$button_classes .= ' local-scroll-link'; 
		}
		if ( $button_transform ) {
			$button_classes .= ' text-transform-'. $button_transform;
		}
		if ( $button_hover_bg_color || $button_hover_color ) {
			$button_classes .= ' wpex-data-hover';
			$inline_js[] = 'data_hover';
		}

		// Button Data attributes
		$button_data = array();
		if ( $button_hover_bg_color ) {
			$button_data[] = 'data-hover-background="'. $button_hover_bg_color .'"';
		}
		if ( $button_hover_color ) {
			$button_data[] = 'data-hover-color="'. $button_hover_color .'"';
		}
		$button_data = $button_data ? ' '. implode( ' ', $button_data ) : '';

		// Button Style
		$border_color = ( 'outline' == $button_style ) ? $button_color : '';
		$button_style = vcex_inline_style( array(
			'background'     => $button_bg_color,
			'color'          => $button_color,
			'letter_spacing' => $button_letter_spacing,
			'font_size'      => $button_size,
			'padding'        => $button_padding,
			'border_radius'  => $button_border_radius,
			'font_weight'    => $button_weight,
			'border_color'   => $border_color,
		) );

	}

}

// Load inline js for the front-end composer
if ( ! empty( $inline_js ) ) {
	vcex_inline_js( $inline_js );
}

// Start output
$output .='<div class="'. $wrapper_classes .'"'. vcex_get_unique_id( $unique_id ) .'>';

	// Display plan
	if ( $plan ) :

		$output .= '<div class="vcex-pricing-header clr"'. $plan_style .'>';
			$output .= $plan;
		$output .= '</div>';

	endif;

	// Display cost
	if ( $cost ) :

		$output .= '<div class="vcex-pricing-cost clr"'. $cost_wrap_style .'>';
			$output .= '<div class="vcex-pricing-ammount" '. $cost_style .'>';
				$output .= $cost;
			$output .= '</div>';
			if ( $per ) {
				$output .= '<div class="vcex-pricing-per"'. $per_style .'>';
					$output .= $per;
				$output .= '</div>';
			}
		$output .= '</div>';

	endif;

	// Display content
	if ( $content ) :

		$output .= '<div class="vcex-pricing-content"'. $features_style .'>';
			$output .= do_shortcode( $content );
		$output .= '</div>';

	endif;
	
	// Display button
	if ( $button_url || $custom_button ) :

		$output .= '<div class="vcex-pricing-button"'. $button_wrap_style .'>';

			if ( $custom_button = vcex_parse_textarea_html( $custom_button ) ) :

				$output .= do_shortcode( $custom_button );

			elseif ( $button_url ) :

				$output .= '<a href="'. esc_url( $button_url ) .'" title="'. esc_attr( $button_title ) .'" class="'. $button_classes .'"'. $button_target .''. $button_style .''. $button_data .'>';
					
					if ( $button_icon_left ) {
						$output .= '<span class="vcex-icon-wrap left"><span class="'. $button_icon_left .'"></span></span>';
					}

					$output .= $button_text;

					if ( $button_icon_right ) {
						$output .= '<span class="vcex-icon-wrap right"><span class="'. $button_icon_right .'"></span></span>';
					}
				$output .= '</a>';
				
			endif;

		$output .= '</div>';

	endif;

$output .= '</div>';

echo $output;