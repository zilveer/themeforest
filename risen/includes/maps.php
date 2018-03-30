<?php
/**
 * Google Maps Helper Functions
 */

/**********************************
 * DATA
 **********************************/

/**
 * Zoom Levels Array
 */

if ( ! function_exists( 'risen_gmaps_zoom_levels' ) ) {

	function risen_gmaps_zoom_levels() {

		$zoom_levels = array();

		$zoom_min = 1; // 0 is actually lowest but then it's detected as not set and reverts to default
		$zoom_max = 21;

		for ( $z = $zoom_min; $z <= $zoom_max; $z++ ) {
			$zoom_levels[$z] = $z;
		}

		return $zoom_levels;

	}

}

/**
 * Map Types Array
 */

if ( ! function_exists( 'risen_gmaps_types' ) ) {

	function risen_gmaps_types() {

		$types = array(
			'ROADMAP'	=> _x( 'Road', 'map', 'risen' ),
			'SATELLITE'	=> _x( 'Satellite', 'map', 'risen' ),
			'HYBRID'	=> _x( 'Hybrid', 'map', 'risen' ),
			'TERRAIN'	=> _x( 'Terrain', 'map', 'risen' )
		);

		return apply_filters( 'risen_gmaps_types', $types );

	}

}

/**********************************
 * CONTENT OUTPUT
 **********************************/

/**
 * Zoom Level Select Options
 */

if ( ! function_exists( 'risen_gmaps_zoom_level_options' ) ) {

	function risen_gmaps_zoom_level_options( $selected = false ) {

		$zoom_levels = risen_gmaps_zoom_levels();

		$options = '';

		foreach( $zoom_levels as $zoom_level ) {
			$options .= '<option value="' . $zoom_level . '"' . ( $zoom_level == $selected ? ' selected="selected"' : '' ) . '>' . $zoom_level . '</option>';
		}

		return $options;

	}

}

/**
 * Zoom Level Select Options
 */

if ( ! function_exists( 'risen_gmaps_type_options' ) ) {

	function risen_gmaps_type_options( $selected = false ) {

		$types = risen_gmaps_types();

		$options = '';

		foreach( $types as $type_key => $type_name ) {
			$options .= '<option value="' . $type_key . '"' . ( $type_key == $selected ? ' selected="selected"' : '' ) . '>' . $type_name . '</option>';
		}

		return $options;

	}

}

/**
 * Display Google Map
 * Also available as shortcode
 * Only latitude and longitude are required
 */

if ( ! function_exists( 'risen_google_map' ) ) {

	function risen_google_map( $options = false ) {

		if ( ! empty( $options['latitude'] ) && ! empty( $options['longitude'] ) ) {

			// Type and zoom are optional
			$options['type'] = isset( $options['type'] ) ? strtoupper( $options['type'] ) : '';
			$options['zoom'] = isset( $options['zoom'] ) ? (int) $options['zoom'] : '';

			// Height percentage of width?
			$map_style = '';
			if ( ! empty( $options['height_percent'] ) ) {
				$options['height_percent'] = str_replace( '%', '', $options['height_percent'] );
			}

			// No border?
			$container_style = '';
			if ( ! empty( $options['border'] ) && 'no' == $options['border'] ) {
				$container_style = ' style="padding: 0px; border: 0px"';
			}

			// Unique ID for this map so can have multiple maps on a page
			$google_map_id = 'google-map-' . rand( 1000000, 9999999 );

return <<< HTML
<div class="google-map-container"$container_style>
	<div id="$google_map_id" class="google-map"$map_style></div>
	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function($) {
		var map = initMap('$google_map_id', '{$options['latitude']}', '{$options['longitude']}', '{$options['type']}', '{$options['zoom']}');
	});
	/* ]]> */
	</script>
</div>
HTML;

		} else if ( ! empty( $options['show_error'] ) ) {
			return __( '<p><b>Google Map Error:</b> <i>latitude</i> and <i>longitude</i> attributes are required. See documentation for help.</p>', 'risen' );
		}

	}

}

/**********************************
 * API KEY NOTICE
 **********************************/

// Show missing Google Maps API Key notice?
function risen_gmaps_api_key_show_notice() {

	$show = true;

	// Only on Add/Edit Location or Event
	$screen = get_current_screen();
	if ( ! ( $screen->base == 'post' && in_array( $screen->post_type, array( 'risen_event', 'risen_location' ) ) ) ) {
		$show = false;
	}

	// Only if user can edit theme options (Appearance menu)
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	// Only if key not set
	if ( risen_option( 'gmaps_api_key' ) ) {
		$show = false;
	}

	// Only if not already dismissed
	if ( get_option( 'risen_gmaps_api_key_notice_dismissed' ) ) {
		$show = false;
	}

	return $show;

}

// Show notice if Google Maps API Key missing
function risen_gmaps_api_key_notice() {

	// Only on Add/Edit Location or Event
	// Only if key not set
	// Only if not already dismissed
	if ( ! risen_gmaps_api_key_show_notice() ) {
		return;
	}

	// Show notice
	?>

	<div id="risen-gmaps-api-key-notice" class="notice notice-warning is-dismissible">
		<p>
			<?php
				printf(
					/* translators: %1$s is URL to guide showing how to get and set key */
					__( '<strong>Google Maps API Key Not Set.</strong> You must set it in <a href="%1$s">Theme Options</a> in order for maps to show.', 'risen' ),
					admin_url( 'themes.php?page=options-framework#options-group-10' )
				);
			?>
		</p>
	</div>

	<?php

}

add_action( 'admin_notices', 'risen_gmaps_api_key_notice' );

// JavaScript for remembering Google Maps API Key missing notice was dismissed
function risen_gmaps_api_key_notice_dismiss_js() {

	// Only on Add/Edit Location or Event
	// Only if key not set
	// Only if not already dismissed
	if ( ! risen_gmaps_api_key_show_notice() ) {
		return;
	}

	// Nonce
	$ajax_nonce = wp_create_nonce( 'risen_gmaps_api_key_notice_dismiss' );

	// JavaScript for detecting click on dismiss button
	?>

	<script type="text/javascript">

	jQuery( document ).ready( function( $ ) {

		$( document ).on( 'click', '#risen-gmaps-api-key-notice .notice-dismiss', function() {
			jQuery.ajax( {
				url: ajaxurl,
				data: {
					action: 'risen_gmaps_api_key_dismiss_notice',
					security: '<?php echo $ajax_nonce; ?>',
				},
			} );
		} );

	} );

	</script>

	<?php

}

add_action( 'admin_print_footer_scripts', 'risen_gmaps_api_key_notice_dismiss_js' );

// Set option to prevent notice from showing again
// This is called by AJAX in risen_gmaps_api_key_notice_dismiss_js()
function risen_gmaps_api_key_dismiss_notice() {

	// Only if is AJAX request
	if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		return;
	}

	// Check nonce
	check_ajax_referer( 'risen_gmaps_api_key_notice_dismiss', 'security' );

	// Only if user is privileged to use screen notice shown on and can edit theme options
	if ( ! ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_theme_options' ) ) ) {
		return;
	}

	// Update option so notice is not shown again
	update_option( 'risen_gmaps_api_key_notice_dismissed', '1' );

}

add_action( 'wp_ajax_risen_gmaps_api_key_dismiss_notice', 'risen_gmaps_api_key_dismiss_notice' );
