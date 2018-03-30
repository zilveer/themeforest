<?php
/**
 * Visual Composer Image Swap
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
	|| ! function_exists( 'vc_build_link' )
) {
	vcex_function_needed_notice();
	return;
}

// Fallbacks (old atts)
$link_title  = isset( $atts['link_title'] ) ? $atts['link_title'] : '';
$link_target = isset( $atts['link_target'] ) ? $atts['link_target'] : '';

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_image_swap', $atts ) );

// Output var
$output = '';

// Primary and secondary imags required
if ( ! $primary_image || ! $secondary_image ) {
	return;
}

// Add styles
$wrapper_inline_style = vcex_inline_style( array(
	'width' => $container_width,
) );
$image_style = vcex_inline_style( array(
	'border_radius' => $border_radius,
), false );

// Add classes
$wrapper_classes = array( 'vcex-image-swap', 'clr' );
if ( $classes ) {
	$wrapper_classes[] = vcex_get_extra_class( $classes );
}
if ( $css_animation ) {
	$wrapper_classes[] = vcex_get_css_animation( $css_animation );
}
$wrapper_classes = implode( ' ', $wrapper_classes );

if ( $primary_image && $secondary_image ) :

	if ( $css ) :
		$output .='<div class="'. vc_shortcode_custom_css_class( $css ) .'">';
	endif;

	$output .='<figure class="'. $wrapper_classes .'"'. $wrapper_inline_style . vcex_get_unique_id( $unique_id ) .'>';

		if ( $link ) {

			// Link attributes
			$link_atts = vc_build_link( $link );
			if ( ! empty( $link_atts['url'] ) ) {
				$link        = isset( $link_atts['url'] ) ? $link_atts['url'] : $link;
				$link_title  = isset( $link_atts['title'] ) ? $link_atts['title'] : '';
				$link_target = isset( $link_atts['target'] ) ? $link_atts['target'] : '';
			}

			// Sanitize link vars
			$link_classes = 'vcex-image-swap-link';
			if ( in_array( $link_tooltip, array( 'yes', 'true' ) ) ) {
				$link_classes .= ' tooltip-up';
			}

			// Display link
			if ( $link ) {

				$output .='<a href="'. esc_url( $link ) .'" class="'. $link_classes .'"'. vcex_html( 'title_attr', $link_title ) .''. vcex_html( 'target_attr', $link_target ) .'>';

			}

		}

		// Primary image
		$output .= wpex_get_post_thumbnail( array(
			'attachment' => $primary_image,
			'size'       => $img_size,
			'crop'       => $img_crop,
			'width'      => $img_width,
			'height'     => $img_height,
			'class'      => 'vcex-image-swap-primary',
			'style'      => $image_style,
		) );

		// Secondary image
		$output .= wpex_get_post_thumbnail( array(
			'attachment' => $secondary_image,
			'size'       => $img_size,
			'crop'       => $img_crop,
			'width'      => $img_width,
			'height'     => $img_height,
			'class'      => 'vcex-image-swap-secondary',
			'style'      => $image_style,
		) );

		// Close link wrapper
		if ( $link ) {
			$output .='</a>';
		}

	$output .='</figure>'; // Close main wrap

	// Close CSS wrapper
	if ( $css ) {
		$output .='</div>';
	}

	echo $output;

endif;