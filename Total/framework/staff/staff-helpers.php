<?php
/**
 * Useful global functions for the staff
 *
 * @package Total WordPress Theme
 * @subpackage Staff Functions
 * @version 3.5.3
 */

/**
 * Returns staff entry blocks
 *
 * @since 2.1.0
 */
function wpex_staff_entry_blocks() {

	// Defaults
	$defaults = array( 'media', 'title', 'content', 'read_more' );

	// Get layout blocks
	$blocks = wpex_get_mod( 'staff_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : $defaults;

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Apply filters to entry layout blocks
	$blocks = apply_filters( 'wpex_staff_entry_blocks', $blocks );

	// Return blocks
	return $blocks;

}

/**
 * Returns staff post blocks
 *
 * @since 2.1.0
 */
function wpex_staff_post_blocks() {

	// Defaults
	$defaults = array( 'content', 'related' );

	// Get layout blocks
	$blocks = wpex_get_mod( 'staff_post_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : $defaults;

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}
					
	// Apply filters to entry layout blocks
	$blocks = apply_filters( 'wpex_staff_single_blocks', $blocks );

	// Return blocks
	return $blocks;

}

/**
 * Returns staff single meta sections
 *
 * @since 3.5.0
 */
function wpex_staff_single_meta_sections() {

	// Default sections
	$sections = array( 'date', 'categories' );

	// Apply filters for easy modification
	$sections = apply_filters( 'wpex_staff_single_meta_sections', $sections );

	// Turn into array if string
	if ( $sections && ! is_array( $sections ) ) {
		$sections = explode( ',', $sections );
	}

	// Return sections
	return $sections;

}

/**
 * Returns correct thumbnail HTML for the staff entries
 *
 * @since 2.0.0
 */
function wpex_get_staff_entry_thumbnail( $loop = 'archive' ) {
	$size = 'archive' === $loop ? 'staff_entry' : 'staff_related';
	return wpex_get_post_thumbnail( apply_filters( 'wpex_get_staff_entry_thumbnail_args', array(
		'size'  => $size,
		'class' => 'staff-entry-img',
		'alt'   => wpex_get_esc_title(),
	) ) );
}

/**
 * Returns correct thumbnail HTML for the staff posts
 *
 * @since 2.0.0
 */
function wpex_get_staff_post_thumbnail( $args = '' ) {

	// Define thumbnail args
	$defaults = array(
		'size'          => 'staff_post',
		'class'         => 'staff-single-media-img',
		'alt'           => wpex_get_esc_title(),
		'schema_markup' => true,
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Return thumbanil
	return wpex_get_post_thumbnail( apply_filters( 'wpex_get_staff_post_thumbnail_args', $args ) );

}

/**
 * Returns correct classes for the staff wrap
 *
 * @since 1.5.3
 */
function wpex_get_staff_wrap_classes() {

	// Define main classes
	$classes = array( 'wpex-row', 'clr' );

	// Get grid style
	$grid_style = wpex_get_mod( 'staff_archive_grid_style' );
	$grid_style =  $grid_style ? $grid_style : 'fit-rows';

	// Add grid style
	$classes[] = 'staff-'. $grid_style;

	// Apply filters
	apply_filters( 'wpex_staff_wrap_classes', $classes );

	// Turninto space seperated string
	$classes = implode( " ", $classes );

	// Return
	return $classes;

}

/**
 * Returns staff archive columns
 *
 * @since 2.0.0
 */
function wpex_staff_archive_columns() {
	return wpex_get_mod( 'staff_entry_columns', '3' );
}

/**
 * Returns correct classes for the staff grid
 *
 * @since Total 1.5.2
 */
if ( ! function_exists( 'wpex_staff_column_class' ) ) {
	function wpex_staff_column_class( $query ) {
		if ( 'related' == $query ) {
			return wpex_grid_class( wpex_get_mod( 'staff_related_columns', '3' ) );
		} else {
			return wpex_grid_class( wpex_get_mod( 'staff_entry_columns', '3' ) );
		}
	}
}

/**
 * Checks if match heights are enabled for the staff
 *
 * @since 1.5.3
 */
if ( ! function_exists( 'wpex_staff_match_height' ) ) {
	function wpex_staff_match_height() {
		$grid_style = wpex_get_mod( 'staff_archive_grid_style', 'fit-rows' ) ? wpex_get_mod( 'staff_archive_grid_style', 'fit-rows' ) : 'fit-rows';
		$columns    = wpex_get_mod( 'staff_entry_columns', '4' ) ? wpex_get_mod( 'staff_entry_columns', '4' ) : '4';
		if ( 'fit-rows' == $grid_style && wpex_get_mod( 'staff_archive_grid_equal_heights' ) && $columns > '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Staff Overlay
 *
 * Function is deprecated and no longer used => Keep for fallback
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_get_staff_overlay' ) ) {
	function wpex_get_staff_overlay( $id = NULL ) {
		$post_id  = $id ? $id : get_the_ID();
		$position = get_post_meta( get_the_ID(), 'wpex_staff_position', true );
		if ( ! $position ) {
			return;
		} ?>
		<div class="staff-entry-position"><span><?php echo esc_html( $position ); ?></span></div>
		<?php
	}
}

/**
 * Outputs the staff social options
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_get_staff_social' ) ) {
	function wpex_get_staff_social( $atts = NULL ) {

		// Extract staff social args
		extract( shortcode_atts( array(
			'link_target' => 'blank',
			'post_id'     => '',
			'style'       => 'minimal-round',
			'font_size'   => '',
			'css'         => '',
		),
		$atts ) );

		// Define output
		$output = '';

		// Get social profiles array
		$profiles = wpex_staff_social_array();

		// Define post_id
		$post_id = $post_id ? $post_id : get_the_ID();

		// Parse style to return correct classname
		$style = wpex_get_social_button_class( $style );
		$style = $style ? ' '. $style : '';

		// Wrap classes
		$wrap_classes = 'staff-social wpex-social-btns clr';
		if ( $css ) {
			$wrap_classes .= ' '. vc_shortcode_custom_css_class( $css );
		}

		// Font size
		$font_size = $font_size ? wpex_sanitize_data( $font_size, 'font_size' ) : '';
		$font_size = $font_size ? 'style="font-size:'. $font_size .'"' : '';

		$tooltip = apply_filters( 'wpex_tooltips_enabled', false );
		$tooltip = $tooltip ? ' tooltip-up' : '';

		// Link target
		$link_target = 'blank' == $link_target ? ' target="_blank"' : '';

		// Start output
		$output .= '<div class="'. esc_attr( $wrap_classes ) .'"'. $font_size .'>';

			// Loop through social options
			foreach ( $profiles as $profile ) :

				// Get meta
				$meta = $profile['meta'];

				// Display link if one exists
				if ( $url = get_post_meta( $post_id, $meta, true ) ) :

					// Add "mailto" for emails
					if ( 'wpex_staff_email' == $meta && is_email( $url ) ) {
						$url = 'mailto:'. $url;
					}

					// Add "callto" to skype
					elseif ( 'wpex_staff_skype' == $meta ) {
						if ( strpos( $url, 'skype' ) === false ) {
							$url = str_replace( 'callto:', '', $url );
							$url = 'callto:'. $url;
						}
					}

					// Add "tel" for phones
					elseif ( 'wpex_staff_phone_number' === $meta ) {
						if ( strpos( $url, 'callto' ) === false ) {
							$url = str_replace( 'tel:', '', $url );
							$url = 'tel:'. $url;
						}
					} else {
						$url = esc_url( $url );
					}

					// Target
					$link_target_attr = ( 'wpex_staff_email' == $meta ) ? '' : $link_target;

					$output .= '<a href="'. $url .'" title="'. esc_attr( $profile['label'] ) .'" class="wpex-'. esc_attr( str_replace( '_', '-', $profile['key'] ) ) . $style . $tooltip .'"'. $link_target_attr .'>';

						$output .= '<span class="'. $profile['icon_class'] .'"></span>';

					$output .= '</a>';

				endif; // URL check
			
			endforeach; // End profiles loop

		// End output
		$output .= '</div>';

		// Return output
		return $output;

	}

}
add_shortcode( 'staff_social', 'wpex_get_staff_social' );