<?php
/**
 * Visual Composer Icon Box
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

// FALLBACK VARS => NEVER REMOVE!!
$padding          = isset( $atts['padding'] ) ? $atts['padding'] : '';
$background       = isset( $atts['background'] ) ? $atts['background'] : '';
$background_image = isset( $atts['background_image'] ) ? $atts['background_image'] : '';
$margin_bottom    = isset( $atts['margin_bottom'] ) ? $atts['margin_bottom'] : '';
$border_color     = isset( $atts['border_color'] ) ? $atts['border_color'] : '';

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_icon_box', $atts );
extract( $atts );

// Sanitize data & declare main vars
$output           = '';
$url              = esc_url( $url );
$inline_js        = array();
$css_wrap_classes = array( 'vcex-icon-box-css-wrap' );
$clickable_boxes  = array( 'four', 'five', 'six' );
$url_wrap         = in_array( $style, $clickable_boxes ) ? 'true' : $url_wrap;
$image            = $image ? wp_get_attachment_url( $image ) : '';
$icon             = $image ? '' : vcex_get_icon_class( $atts, 'icon' );
$heading_type     = $heading_type ? $heading_type : 'h2';

// Match Height Inline JS
if ( false !== strpos( $classes, 'equal-height-content' ) ) {
	$inline_js[] = 'equal_height_content';
}

// Icon functions
if ( $icon ) {

	// Load icon family CSS
	vcex_enqueue_icon_font( $icon_type );

	// Icon Style
	$icon_style = array();
	$icon_style['color']         = $icon_color;
	$icon_style['width']         = $icon_width;
	$icon_style['font_size']     = $icon_size;
	$icon_style['border_radius'] = $icon_border_radius;
	$icon_style['background']    = $icon_background;
	$icon_style['height']        = $icon_height;
	if ( $icon_height ) {
		$icon_style['line_height']   = intval( $icon_height ) .'px';
	}

	if ( $icon_bottom_margin && in_array( $style, array( 'two', 'three', 'four', 'five', 'six' ) ) ) {
		$icon_style['margin_bottom'] = $icon_bottom_margin;
	}

	// Convert icon style array to inline style
	$icon_style = vcex_inline_style( $icon_style );

	// Icon Classes
	$icon_classes = array( 'vcex-icon-box-icon' );
	if ( $icon_background ) {
		$icon_classes['vcex-icon-box-w-bg'] = 'vcex-icon-box-w-bg';
	}
	if ( $icon_width || $icon_height ) {
		if ( $icon_height ) {
			unset( $icon_classes['vcex-icon-box-w-bg'] );
		}
		$icon_classes[] = 'no-padding';
	}
	$icon_classes = implode( ' ', $icon_classes );

}

// Main Classes
$wrapper_classes = array( 'vcex-icon-box', 'clr' );
if ( $style ) {
	$wrapper_classes[] = 'vcex-icon-box-'. $style;
}
if ( empty( $icon ) && empty( $image ) ) {
	$wrapper_classes[] = 'vcex-icon-box-wo-icon';
}
if ( $url && 'true' == $url_wrap ) {
	$wrapper_classes[] = 'vcex-icon-box-link-wrap';
}
if ( $alignment ) {
	$wrapper_classes[] = 'align'. $alignment;
}
if ( $icon_background ) {
	$wrapper_classes[] = 'vcex-icon-box-w-bg';
}
if ( 'true' == $hover_white_text ) {
	$wrapper_classes['wpex-hover-white-text'] = 'wpex-hover-white-text';
	$css_wrap_classes[] = 'wpex-hover-white-text';
}
if ( $hover_animation ) {
	if ( $css && in_array( $style, array( 'one', 'seven' ) ) ) {
		$css_wrap_classes[] = wpex_hover_animation_class( $hover_animation );
	} else {
		$wrapper_classes[] = wpex_hover_animation_class( $hover_animation );
	}
	vcex_enque_style( 'hover-animations' );
}
if ( ! $hover_animation && $hover_background ) {
	$wrapper_classes[] = 'animate-all-hover';
	$css_wrap_classes[] = 'animate-bg-hover';
}
if ( $css_animation ) {
	$wrapper_classes[] = vcex_get_css_animation( $css_animation );
}
if ( $classes ) {
	$wrapper_classes[] = vcex_get_extra_class( $classes );
}
if ( $visibility ) {
	$wrapper_classes[] = $visibility;
}
if ( $css ) {
	$css_class = vc_shortcode_custom_css_class( $css );
	if ( in_array( $style, array( 'one', 'seven' ) ) ) {
		$css_wrap_classes[] = $css_class;
	} else {
		$wrapper_classes[] = $css_class;
	}
}

// Container Style
$wrapper_style = array();
if ( $border_radius ) {
	$wrapper_style['border_radius'] = $border_radius;
}
if ( 'six' == $style && $icon_color ) {
	$wrapper_style['color'] = $icon_color;
}
if ( 'one' == $style && $container_left_padding ) {
	$wrapper_style['padding_left'] = $container_left_padding;
}
if ( 'seven' == $style && $container_right_padding ) {
	$wrapper_style['padding_right'] = $container_right_padding;
}

// Fallback styles if $css is empty
if ( ! $css ) {
	if ( $padding ) {
		$wrapper_style['padding'] = $padding;
	}
	if ( 'four' == $style && $border_color ) {
		$wrapper_style['border_color'] = $border_color;
	}
	if ( 'six' == $style && $icon_background && '' === $background ) {
		$wrapper_style['background_color'] = $icon_background;
	}
	if ( $background && in_array( $style, $clickable_boxes ) ) {
		$wrapper_style['background_color'] = $background;
	}
	if ( $background_image && in_array( $style, $clickable_boxes ) ) {
		$background_image = wp_get_attachment_url( $background_image );
		$wrapper_style['background_image'] = $background_image;
		$wrapper_classes[] = 'vcex-background-'. $background_image_style;
	}
	if ( $margin_bottom ) {
		$wrapper_style['margin_bottom'] = $margin_bottom;
	}
}

// Wrapper data
$wrapper_data = array();
if ( $hover_background ) {
	$wrapper_data[] = 'data-hover-background="'. $hover_background .'"';
}
if ( $hover_background ) {
	$wrapper_classes['wpex-data-hover'] = 'wpex-data-hover';
	$css_wrap_classes[] = 'wpex-data-hover';
	$inline_js['data_hover'] = 'data_hover';
}

// Content style
$content_style = vcex_inline_style( array(
	'color'     => $font_color,
	'font_size' => $font_size,
) );

// Link data
if ( $url ) {

	$url_classes = '';
	if ( 'true' != $url_wrap ) {
		$url_classes = 'vcex-icon-box-link';
	}
	if ( 'local' == $url_target ) {
		$url_classes .= ' local-scroll-link';
	} elseif ( '_blank' == $url_target ) {
		$url_target = ' target="_blank"';
	} else {
		$url_target = '';
	}
	if ( $url_rel ) {
		$url_rel = ' rel="'. $url_rel .'"';
	}

}

// Heading style
if ( $heading ) {
	if ( $heading_font_family ) {
		wpex_enqueue_google_font( $heading_font_family );
	}
	$heading_style = vcex_inline_style( array(
		'font_family'    => $heading_font_family,
		'font_weight'    => $heading_weight,
		'color'          => $heading_color,
		'font_size'      => $heading_size,
		'letter_spacing' => $heading_letter_spacing,
		'margin_bottom'  => $heading_bottom_margin,
		'text_transform' => $heading_transform,
	) );
}

// Load inline js for front end editor
if ( ! empty( $inline_js ) ) {
	vcex_inline_js( $inline_js );
}

// Open new wrapper for icon style 1
if ( $css && in_array( $style, array( 'one', 'seven' ) ) ) :

	// Remove wrapper hover
	if ( isset( $wrapper_classes['wpex-data-hover'] ) ) {
		unset( $wrapper_classes['wpex-data-hover'] );
	}
	if ( isset( $wrapper_classes['wpex-hover-white-text'] ) ) {
		unset( $wrapper_classes['wpex-hover-white-text'] );
	}
	// Convert wrapper classes to string
	$css_wrap_classes = implode( ' ', $css_wrap_classes );

	// Add hover animations to css div
	$outer_wrap_data = '';
	if ( $hover_background ) {
		$outer_wrap_data = ' data-hover-background="'. $hover_background .'"';
	}

	$output .= '<div class="'. $css_wrap_classes .'"'. $outer_wrap_data .'>';

endif;

// Convert arrays to strings
$wrapper_classes = implode( ' ', $wrapper_classes );
$wrapper_data    = $wrapper_data ? ' '. implode( ' ', $wrapper_data ) : '';
$wrapper_style   = vcex_inline_style( $wrapper_style );

// Open link tag if url and url_wrap are defined
if ( $url && 'true' == $url_wrap ) :

	$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $heading ) .'" class="'. $wrapper_classes .'"'
		. vcex_get_unique_id( $unique_id )
		. $wrapper_style
		. $url_target
		. $url_rel
		. $wrapper_data;
	$output .= '>';

// Open icon box with standard div
else :

	$output .= '<div class="'. $wrapper_classes .'"'
		. vcex_get_unique_id( $unique_id )
		. $wrapper_style
		. $wrapper_data;
	$output .= '>';

endif;

	// Open link if url is defined and the entire wrapper isn't a link
	if ( $url && 'true' != $url_wrap ) :

		$output .= '<a href="'. esc_url( $url ) .'" title="'. esc_attr( $heading ) .'" class="'. $url_classes .'"'
			. $url_target
			. $url_rel;
		$output .= '>';

	endif;
	
	// Display Image Icon Alternative
	if ( $image ) :

		// Image style
		$image_style = vcex_inline_style( array(
			'width'         => $image_width,
			'height'        => $image_height,
			'margin_bottom' => $image_bottom_margin,
		) );

		$img_dims = '';
		if ( $image_width ) {
			$img_dims .= ' width="'. intval( $image_width ) .'"';
		}
		if ( $image_height ) {
			$img_dims .= ' height="'. intval( $image_height ) .'"';
		}

		$output .= '<img src="'. esc_url( $image ) .'" alt="'. esc_attr( $heading ) .'" class="vcex-icon-box-image"'
			. $img_dims
			. $image_style;
		$output .= '/>';

	// Display Icon
	elseif ( $icon ) :

		$output .= '<div class="'. $icon_classes .'"'. $icon_style .'>';

			// Display alternative icon
			if ( $icon_alternative_classes ) :

				$output .= '<span class="'. $icon_alternative_classes .'"></span>';

			// Display theme supported icon
			else :

				$output .= '<span class="'. $icon .'"></span>';

			endif;

		$output .= '</div>';

	endif;
	
	// Display heading if defined
	if ( $heading ) :

		$output .= '<'. $heading_type .' class="vcex-icon-box-heading"'. $heading_style .'>';
			$output .= $heading;
		$output .= '</'. $heading_type .'>';

	endif;

	// Close link around heading and icon
	if ( $url && 'true' != $url_wrap ) {
		$output .= '</a>';
	}

	// Display content if defined
	if ( $content ) :

		$output .= '<div class="vcex-icon-box-content clr"'. $content_style .'>';
			$output .= apply_filters( 'the_content', $content );
		$output .= '</div>';

	endif;

// Close outer link wrap
if ( $url && 'true' == $url_wrap ) :

	$output .= '</a>';

// Close outer div wrap
else :

	$output .= '</div>';

endif;

// Close css wrapper for icon style one
if ( $css && in_array( $style, array( 'one', 'seven' ) ) ) {
	$output .= '</div>';
}

echo $output;