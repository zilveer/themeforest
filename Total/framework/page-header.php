<?php
/**
 * All page header functions
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 *
 */

/**
 * Adds correct classes to the page header
 *
 * @since 2.0.0
 */
function wpex_page_header_classes() {

	// Define main class
	$classes = array( 'page-header' );

	// Get header style
	$style = wpex_global_obj( 'page_header_style' );

	// Add classes for title style
	if ( $style ) {
		$classes[$style .'-page-header'] = $style .'-page-header';
	}

	// Check if current page title supports mods
	if ( ! in_array( $style, array( 'background-image', 'solid-color' ) ) ) {
		$classes['wpex-supports-mods'] = 'wpex-supports-mods';
	}

	// Add global background
	if ( wpex_global_obj( 'page_header_bg_image' ) ) {
		$classes['has-bg-image'] = 'has-bg-image';
		$bg_style = get_theme_mod( 'page_header_background_img_style' );
		$bg_style =  $bg_style ? $bg_style : 'fixed';
		$bg_style = apply_filters( 'wpex_page_header_background_img_style', $bg_style );
		$classes['bg-'. $bg_style] = 'bg-'. $bg_style;
	}

	// Apply filters
	$classes = apply_filters( 'wpex_page_header_classes', $classes );

	// Turn into comma seperated list
	$classes = implode( ' ', $classes );

	// Return classes
	return $classes;
	

}

/**
 * Get page header background image URL
 *
 * @since 1.5.4
 */
function wpex_page_header_background_image( $post_id = '' ) {

	// Return NULL by default
	$image = null;

	// Get page header background from meta
	if ( $post_id ) {

		if ( $new_meta = get_post_meta( $post_id, 'wpex_post_title_background_redux', true ) ) {
			if ( is_array( $new_meta ) && ! empty( $new_meta['url'] ) ) {
				$image = $new_meta['url'];
			} else {
				$image = $new_meta;
			}
		} else {
			$image = get_post_meta( $post_id, 'wpex_post_title_background', true ); // Fallback
		}

	}

	// Apply filters
	$image = apply_filters( 'wpex_page_header_background_image', $image );

	// Generate image URL if using ID
	if ( is_numeric( $image ) ) {
		$image = wp_get_attachment_image_src( $image, 'full' );
		$image = $image[0];
	}

	// Return URL
	return esc_url( $image );
}

/**
 * Outputs Custom CSS for the page title
 *
 * @since 1.5.3
 */
function wpex_page_header_overlay() {

	// Only needed for the background-image style so return otherwise
	if ( 'background-image' != wpex_global_obj( 'page_header_style' ) ) {
		return;
	}

	// Define vars
	$return  = '';

	// Set default overlay styles for tax archives since we don't have meta settings
	if ( is_tax() || is_tag() || is_category() ) {
		$overlay       = 1;
		$opacity       = '';
		$overlay_style = 'solid';
	}

	// Get options from post meta
	else {
		$post_id       = wpex_global_obj( 'post_id' );
		$overlay       = get_post_meta( $post_id, 'wpex_post_title_background_overlay', true );
		$opacity       = get_post_meta( $post_id, 'wpex_post_title_background_overlay_opacity', true );
		$overlay_style = get_post_meta( $post_id, 'wpex_post_title_background_overlay', true );
	}

	// Apply filters
	$overlay       = apply_filters( 'wpex_page_header_overlay_enabled', $overlay );
	$overlay_style = apply_filters( 'wpex_page_header_overlay_style', $overlay_style );
	$opacity       = apply_filters( 'wpex_page_header_overlay_opacity', $opacity );

	// Sanitize
	$overlay = 'none' == $overlay ? false : $overlay;

	// Check that overlay style isn't set to none
	if ( $overlay && $overlay_style ) {

		// Add opacity style if opacity is defined
		if ( $opacity ) {
			$opacity = 'style="opacity:'. $opacity .'"';
		}

		// Return overlay element
		$return = '<span class="background-image-page-header-overlay style-'. $overlay_style .'" '. $opacity .'></span>';
		
	}

	// Apply filters and echo
	echo apply_filters( 'wpex_page_header_overlay', $return );
}

/**
 * Outputs Custom CSS for the page title
 *
 * @since 1.5.3
 */
function wpex_page_header_css( $output ) {

	// Make sure page header is enabled so we don't run unnedded checks or add useless CSS
	if ( wpex_global_obj( 'has_page_header' ) ) {

		// Get post ID
		$post_id = wpex_global_obj( 'post_id' );

		// Get header style
		$page_header_style = wpex_global_obj( 'page_header_style' );

		// Define var
		$css = '';
		$page_header_css = '';

		// Check if a header style is defined and make header style dependent tweaks
		if ( $page_header_style ) {

			// Customize background color
			if ( 'solid-color' == $page_header_style || 'background-image' == $page_header_style ) {
				$bg_color = get_post_meta( $post_id, 'wpex_post_title_background_color', true );
				if ( $bg_color ) {
					$page_header_css .='background-color: '. $bg_color .' !important;';
				}
			}

			// Background image Style
			if ( 'background-image' == $page_header_style ) {

				// Get background image
				$bg_img = wpex_page_header_background_image( $post_id );

				// Add CSS for background image
				if ( $bg_img ) {

					// Add css for background image
					$page_header_css .= 'background-image: url('. $bg_img .' ) !important;
							background-position: 50% 0;
							-webkit-background-size: cover;
							-moz-background-size: cover;
							-o-background-size: cover;
							background-size: cover;';

				}

				// Custom height => Added to inner table NOT page header
				$title_height = get_post_meta( $post_id, 'wpex_post_title_height', true );
				$title_height = apply_filters( 'wpex_post_title_height', $title_height );
				if ( $title_height ) {
					$css .= '.page-header-table { height:'. wpex_sanitize_data( $title_height, 'px' ) .'; }';
				}

			}

			// Apply all css to the page-header class
			if ( ! empty( $page_header_css ) ) {
				$css .= '.page-header { '. $page_header_css .' }';
			}

			// Overlay Color
			if ( ! empty( $bg_img ) ) {
				if ( 'bg_color' == get_post_meta( $post_id, 'wpex_post_title_background_overlay', true )
					&& 'background-image' == $page_header_style
					&& isset( $bg_color )
				) {
					$css .= '.background-image-page-header-overlay { background-color: '. $bg_color .' !important; }';
				}
			}

			// If css var isn't empty add to custom css output
			if ( ! empty( $css ) ) {
				$output .= $css;
			}

		}

	}

	// Return output
	return $output;

}
add_filter( 'wpex_head_css', 'wpex_page_header_css' );