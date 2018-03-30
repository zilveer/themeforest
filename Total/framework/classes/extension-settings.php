<?php
/**
 * Creates admin panel for 3rd party extension settings and
 * saves them in the theme_mods
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Extensions_Admin' ) ) {

	class WPEX_Extensions_Admin {

		/**
		 * Main constructor
		 *
		 * @since 1.6.3
		 */
		public function __construct() {
			
		}

		/**
		 * Returns settings
		 *
		 * @since 1.6.0
		 */
		public static function get_settings() {
			return apply_filters( 'total_extension_settings', array() );
		}

	}
}
new WPEX_Extensions_Admin();