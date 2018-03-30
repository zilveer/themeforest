<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wpex_tgmpa_register() {

	// Get array of recommended plugins
	// See framework/core-functions.php
	$plugins = wpex_recommended_plugins();

	// Prevent dismiss
	if ( WPEX_VC_ACTIVE ) {
		$dismissable = wpex_vc_is_supported() ? true : false;
	} else {
		$dismissable = true; // VC not active
	}

	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'wpex_theme',
		'domain'       => 'total',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => $dismissable,
	) );

}
add_action( 'tgmpa_register', 'wpex_tgmpa_register' );