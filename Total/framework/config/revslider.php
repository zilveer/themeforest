<?php
/**
 * RevSlider Config
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.5.3
 */

// Start Class
if ( ! class_exists( 'WPEX_RevSlider_Config' ) ) {

	class WPEX_RevSlider_Config {

		/**
		 * Start things up
		 *
		 * @since 3.4.0
		 */
		public function __construct() {

			// Admin functions
			if ( is_admin() ) {

				// Remove notices
				global $pagenow;
				if ( $pagenow == 'plugins.php' ) {
					add_action( 'admin_notices', array( $this, 'remove_plugins_page_notices' ), 9999 );
				}

				// Remove activation notice
				wpex_remove_class_filter( 'admin_notices', 'RevSliderAdmin', 'addActivateNotification', 10 );

			}

			// Front end functions
			else {

				// Remove front-end meta generator
				add_filter( 'revslider_meta_generator', '__return_false' );

			}

		}

		/**
		 * Remove Revolution Slider plugin notices
		 *
		 * @since 3.4.0
		 */
		public function remove_plugins_page_notices() {
			$plugin_id = 'revslider/revslider.php';

			// Remove plugin page purchase notice
			remove_action( 'after_plugin_row_'. $plugin_id, array( 'RevSliderAdmin', 'show_purchase_notice' ), 10, 3 );

			// Hide update notice if not valid
			if ( 'false' == get_option( 'revslider-valid', 'false' ) ) {

				remove_action( 'after_plugin_row_' . $plugin_id, array( 'RevSliderAdmin', 'show_update_notice' ), 10, 3 );

			}

		}


	}

}
new WPEX_RevSlider_Config();