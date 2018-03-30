<?php
/**
 * Skin loader function & helpers
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @version 3.3.0
 *
 * @deprecated Since 3.0.0
 */

if ( ! class_exists( 'WPEX_Skin_Loader' ) ) {
	class WPEX_Skin_Loader {
		public static $current_skin;
		private $enabled;

		/**
		 * Start things up
		 *
		 * @since 1.6.3
		 */
		public function __construct() {

			// Get current skin
			self::$current_skin = $this->get_current_skin();
			$current_skin = self::$current_skin;

			// Enabled - need to check if a user had a skin set before
			$this->enabled = ( $current_skin && 'base' != $current_skin ) ? true : false;
			$this->enabled = apply_filters( 'wpex_enable_skins', $this->enabled );

			// Return if disabled
			if ( ! $this->enabled ) {
				return;
			}

			// Skins Paths
			define( 'WPEX_SKIN_DIR', WPEX_THEME_DIR .'/skins/' );
			define( 'WPEX_SKIN_DIR_URI', WPEX_THEME_URI .'/skins/' );

			// Admin
			if ( is_admin() ) {
				require_once( WPEX_SKIN_DIR .'skins-admin.php' );
			}

			// Load skin if needed
			if ( $current_skin && 'base' != $current_skin ) {
				$this->load_skin();
			}

		}

		/**
		 * Array of available skins
		 *
		 * @since 1.6.3
		 */
		public static function skins_array() {
			$github_repo = 'https://raw.githubusercontent.com/wpexplorer/total-sample-data/master/';
			return apply_filters( 'wpex_skins', array(
				'base'  => array (
					'core' => true,
					'name' => 'Base',
					'screenshot' => $github_repo .'Base/screenshot.jpg',
				),
				'agent' => array(
					'core'  => true,
					'name'  => 'Agent',
					'class' => WPEX_SKIN_DIR .'classes/agent/agent-skin.php',
					'screenshot' => $github_repo .'Agent/screenshot.jpg',
				),
				'neat'  => array(
					'core'  => true,
					'name'  => 'Neat',
					'class' => WPEX_SKIN_DIR .'classes/neat/neat-skin.php',
					'screenshot' => $github_repo .'Health-Care/screenshot.jpg',
				),
				'flat'  => array(
					'core'  => true,
					'name'  => 'Flat',
					'class' => WPEX_SKIN_DIR .'classes/flat/flat-skin.php',
					'screenshot' => WPEX_SKIN_DIR_URI .'classes/flat/screenshot.jpg',
				),
				'gaps'  => array(
					'core'  => true,
					'name'  => 'Gaps',
					'class' => WPEX_SKIN_DIR .'classes/gaps/gaps-skin.php',
					'screenshot' => WPEX_SKIN_DIR_URI .'classes/gaps/screenshot.jpg',
				),
				/* Removed in version 2.0.0
				'minimal-graphical' => array(
					'core'  => true,
					'name'  => Minimal Graphical',
					'class' => WPEX_SKIN_DIR .'classes/minimal-graphical/minimal-graphical-skin.php',
				),*/
			) );
		}

		/**
		 * Returns the current skin
		 *
		 * @since 1.6.3
		 */
		public function get_current_skin() {

			// Check URL
			if ( ! empty( $_GET['theme_skin'] ) ) {
				return esc_html( $_GET['theme_skin'] );
			}

			// Apply filters
			$skin = apply_filters( 'wpex_active_skin', wpex_get_mod( 'theme_skin', 'base' ) );

			// Sanitize and return
			return $skin ? $skin : 'base';
			
		}

		/**
		 * Returns the correct class file for the current skin
		 *
		 * @since 1.6.3
		 */
		public function current_skin_file( $active_skin ) {

			// Nothing needed for the base skin or an empty skin
			if ( 'base' == $active_skin || ! $active_skin ) {
				return;
			}

			// Get currect skin class to load later
			$skins = $this->skins_array();
			$active_skin_array = wp_array_slice_assoc( $skins, array( $active_skin ) );
			if ( is_array( $active_skin_array ) ) {
				$class_file = ! empty( $active_skin_array[$active_skin]['class'] ) ? $active_skin_array[$active_skin]['class'] : false;
			}

			// Return class file if one exists
			if ( file_exists( $class_file ) ) {
				return $class_file;
			}
			
		}

		/**
		 * Load the active skin
		 *
		 * @since 1.6.3
		 */
		public function load_skin() {

			// Get skin file
			$file = $this->current_skin_file( self::$current_skin );

			// Load the file if it exists
			if ( $file ) {
				require_once( $file );
			}
			
		}

		/**
		 * Returns the current skin
		 *
		 * @since 1.6.3
		 */
		public static function return_current_skin() {
			return self::$current_skin;
		}

	}
}
new WPEX_Skin_Loader();

/**
 * Helper function that returns active skin name
 *
 * @since 1.6.3
 */
function wpex_active_skin() {
	if ( class_exists( 'WPEX_Skin_Loader' ) ) {
		return WPEX_Skin_Loader::return_current_skin();
	}
}