<?php
/**
 * Disable Google Searvices
 *
 * @package Total WordPress Theme
 * @subpackage 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class WPEX_Disable_Google_Services {

	/**
	 * Main constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		// Remove Google Fonts from theme fonts array
		add_filter( 'wpex_google_fonts_array', '__return_false' );

		// Remove Google Fonts from Visual Composer
		add_filter( 'vc_google_fonts_render_filter', '__return_false' );
		add_filter( 'vc_google_fonts_get_fonts_filter', '__return_false' );

		// Remove scripts
		add_action( 'wp_print_scripts', array( 'WPEX_Disable_Google_Services', 'remove_scripts' ), 10 );

		// Remove inline scripts
		add_action( 'wp_footer', array( 'WPEX_Disable_Google_Services', 'remove_inline_scripts' ), 10 );

	}

	/**
	 * Remove scripts
	 *
	 * @since 2.1.0
	 */
	public static function remove_scripts() {
		wp_dequeue_script( 'webfont' );
	}

	/**
	 * Remove footer scripts
	 *
	 * @since 2.1.0
	 */
	public static function remove_inline_scripts() {

		// Get global styles
		global $wp_styles;

		// Loop through and remove VC fonts
		if ( $wp_styles ) {
			foreach ( $wp_styles->registered as $handle => $data ) {
				if ( false !== strpos( $handle, 'vc_google_fonts_' ) ) {
					wp_deregister_style( $handle );
					wp_dequeue_style( $handle );
				}
			}
		}

	}

}
new WPEX_Disable_Google_Services();