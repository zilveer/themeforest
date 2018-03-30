<?php
/**
 * Provides updates for plugins included with the theme.
 *
 * This class does NOT technically provide auto updates, but rather
 * alerts the admin of updated plugins inside the theme so
 * they can be updated just like any other plugin.
 *
 * The theme must be updated before any plugins can be updated due
 * to Envato rules 3rd party plugins must be included with the theme
 * and not provided via 3rd party methods.
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Plugin_Updater' ) ) {
	
	class WPEX_Plugin_Updater {

		/**
		 * Main constructor
		 *
		 * @since 3.3.3
		 */
		public function __construct() {
			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_for_updates' ) );
			//set_site_transient( 'update_plugins', null ); // For testing only
		}

		/**
		 * Check transients
		 *
		 * @since 3.3.3
		 */
		public function check_for_updates( $transient ) {

			// Transient already checked
			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			// Return array of installed plugins
			$installed_plugins = $this->get_plugins();

			// No plugins installed
			if ( empty( $installed_plugins ) || ! is_array( $installed_plugins ) ) {
				return $transient;
			}

			// Get recommended plugins
			$recommended_plugins = wpex_recommended_plugins();

			// List of plugins to provide auto updates for
			$plugins_to_check = $this->plugins_to_check( $installed_plugins );

			// Loop through plugins and check if an update is available
			foreach ( $recommended_plugins as $plugin ) {
				if ( 'js_composer' == $plugin && is_multisite() ) {
					continue;
				}
				if ( in_array( $plugin['slug'], $plugins_to_check ) ) {
					$has_update = $this->has_update( $plugin, $installed_plugins );
					if ( $has_update ) {
						$response = array(
							'new_version' => $plugin['version'],
							'package'     => $plugin['source'],
							'slug'        => $plugin['slug']
						);
						$base = $this->get_plugin_base( $plugin['slug'] );
						$transient->response[$base] = (object) $response;
					}
				}
			}

			//var_dump( $transient );

			// Return transient
			return $transient;

		}

		/**
		 * Get list of plugins.
		 *
		 * @since 3.3.0
		 */
		public function get_plugins( $plugin_folder = '' ) {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			return get_plugins( $plugin_folder );
		}

		/**
		 * List of plugins to check for updates
		 *
		 * @since 3.3.3
		 */
		private function get_plugin_base( $plugin ) {
			if ( 'js_composer' == $plugin ) {
				return 'js_composer/js_composer.php';
			} elseif ( 'revslider' == $plugin ) {
				return 'revslider/revslider.php';
			} elseif ( 'templatera' == $plugin ) {
				return 'templatera/templatera.php';
			}
		}

		/**
		 * List of plugins to check for updates
		 * Only check active plugins
		 *
		 * @since 3.3.3
		 */
		private function plugins_to_check( $installed_plugins ) {
			$plugins_to_check = array();
			if ( array_key_exists( 'js_composer/js_composer.php', $installed_plugins ) ) {
				$plugins_to_check['js_composer'] = 'js_composer';
			}
			if ( array_key_exists( 'revslider/revslider.php', $installed_plugins ) ) {
				$plugins_to_check['revslider'] = 'revslider';
			}
			if ( array_key_exists( 'templatera/templatera.php', $installed_plugins ) ) {
				$plugins_to_check['templatera'] = 'templatera';
			}
			return $plugins_to_check;
		}

		/**
		 * Check if a plugin has an update available
		 *
		 * @since 3.3.3
		 */
		private function has_update( $plugin, $plugins ) {
			$base                = $this->get_plugin_base( $plugin['slug'] );
			$installed_version   = isset( $plugins[$base]['Version'] ) ? $plugins[$base]['Version'] : '';
			$recommended_version = $plugin['version'];
			if ( $installed_version ) {
				return version_compare( $recommended_version, $installed_version, '>' );
			}
		}

	}

}
new WPEX_Plugin_Updater();