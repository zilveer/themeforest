<?php
/**
 * Gets and stores all theme mods for use with the theme.
 *
 * IMPORTANT: DO NOT EVER EDIT THESE CORE FUNCTIONS !!!
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.3.3
 */

/**
 * Returns global mods
 *
 * @since 2.1.0
 */
function wpex_get_mods() {
	global $wpex_theme_mods;
	return $wpex_theme_mods;
}

/**
 * Returns theme mod from global var
 *
 * @since 2.1.0
 */
function wpex_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview => IMPORTANT !!!
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $wpex_theme_mods;

	// Return data from global object
	if ( ! empty( $wpex_theme_mods ) ) {

		// Return value
		if ( isset( $wpex_theme_mods[$id] ) ) {
			return $wpex_theme_mods[$id];
		}

		// Return default
		else {
			return $default;
		}

	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}

}

/**
 * Check if a specific theme mod is disabled (for fallback conditionals)
 *
 * @since 3.3.3
 */
function wpex_is_mod_enabled( $mod ) {
	if ( $mod && 'off' !== $mod ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Creates a backup of your theme mods
 *
 * @since 3.0.0
 */
function wpex_backup_mods() {
	update_option( 'wpex_total_customizer_backup', wpex_get_mods() );
}