<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_maintenance' ) ) {
	/**
	 * Redirect visitors to a maintenance/coming soon page
	 *
	 * @access public
	 * @return void
	 */
	function wolf_maintenance() {

		if ( ! is_user_logged_in() && wolf_get_theme_option( 'maintenance_page_id' ) && ! is_page( wolf_get_theme_option( 'maintenance_page_id' ) ) ) {
			wp_safe_redirect( get_permalink( wolf_get_theme_option( 'maintenance_page_id' ) ), 302 );
			exit;
		}
	}
	add_action( 'template_redirect', 'wolf_maintenance', 5 );
}