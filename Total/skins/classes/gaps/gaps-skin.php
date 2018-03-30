<?php
/**
 * Gaps Skin Class
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @deprecated Since 3.0.0
 */

if ( ! class_exists( 'Total_Gaps_Skin' ) ) {
	
	class Total_Gaps_Skin {

		/**
		 * Main constructor
		 *
		 * @since 1.3.0
		 */
		public function __construct() {

			// Actions
			add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 999 );
			add_action( 'wp_head', array( $this, 'remove_header_menu' ), 10 );

			// Filters
			add_filter( 'wpex_main_layout', array( $this, 'main_layout' ), 10 );

		}

		/**
		 * Load custom stylesheet for this skin
		 *
		 * @since 1.3.0
		 */
		public function load_styles() {
			wp_enqueue_style(
				'gaps-skin', WPEX_SKIN_DIR_URI .'classes/gaps/css/gaps-style.css',
				array( 'wpex-style' ),
				WPEX_THEME_VERSION,
				'all'
			);
		}

		/**
		 * Remove the menu from the header_bottom hook for header styles 2 and 3
		 *
		 * @since 2.0.0
		 */
		public function remove_header_menu() {
			if ( in_array( wpex_global_obj( 'header_style' ), array( 'two', 'three' ) ) ) {
				remove_action( 'wpex_hook_header_bottom', 'wpex_header_menu' );
				add_action( 'wpex_hook_main_before', array( $this, 'gaps_menu_two_three' ) );
			}
		}

		/**
		 * Custom function for displaying menu styles 2 and 3 required for this skin
		 *
		 * @since 2.0.2
		 */
		public function gaps_menu_two_three() {

			// Get current filter
			$filter = current_filter();

			// Set bool variable
			$get = false;

			// Check current filter against header style
			if ( in_array( wpex_global_obj( 'header_style' ), array( 'two', 'three' ) )
				&& 'wpex_hook_main_before' == $filter
			) {
				$get = true;
			}

			// Get menu template part
			if ( $get ) {
				get_template_part( 'partials/header/header-menu' );
			}
			
		}

		/**
		 * Set main layout to boxed
		 *
		 * @since 3.0.0
		 */
		public function main_layout( $layout ) {
			return 'boxed';
		}

	}

}
$wpex_gaps_skin = new Total_Gaps_Skin();