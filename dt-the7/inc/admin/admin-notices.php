<?php
/**
 * Admin notices hooks.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Return object that handle admin notices.
 *
 * @return Presscore_Admin_Notices
 */
function presscore_admin_notices() {
	static $admin_notices = null;
	if ( is_null( $admin_notices ) ) {
		$admin_notices = new Presscore_Admin_Notices( 'admin_notices' );
	}

	return $admin_notices;
}

/**
 * Enqueue admin notices scripts.
 */
function presscore_admin_enqueue_scripts() {
	$notices = presscore_admin_notices();

	wp_enqueue_script( 'presscore-admin-notices', trailingslashit( PRESSCORE_ADMIN_URI ) . 'assets/presscore-admin-notices.js', array( 'jquery' ), false, true );
	wp_localize_script( 'presscore-admin-notices', 'presscoreNotices', array( '_ajax_nonce' => $notices->get_nonce() ) );
}

/**
 * Main function to handle custom admin notices. Adds action handlers.
 */
function presscore_admin_handle_notices() {
	$notices = presscore_admin_notices();

	add_action( 'admin_enqueue_scripts', 'presscore_admin_enqueue_scripts', 9999 );
	add_action( 'wp_ajax_presscore-admin-notice', array( $notices, 'dismiss_notices' ) );
	add_action( 'admin_notices', array( $notices, 'print_admin_notices' ), 40 );
}
add_action( 'admin_init', 'presscore_admin_handle_notices' );
