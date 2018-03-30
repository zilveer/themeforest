<?php
/**
 * JetPack Configuration Class
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.3.5
 */

if ( ! class_exists( 'WPEX_Jetpack_Config' ) ) {

	class WPEX_Jetpack_Config extends Jetpack {

		/**
		 * Start things up
		 *
		 * @version 3.3.5
		 */
		public function __construct() {

			// Social share
			if ( $this->is_module_active( 'sharedaddy' ) ) {

				// Remove default filters
				add_action( 'loop_start', array( $this, 'wpex_remove_share' ) );

				// Social share should always be enabled & disabled via blocks/theme filter
				add_filter( 'sharing_show', '__return_true' );

				// Enqueue scripts if social share is enabled
				add_action( 'wp_enqueue_scripts', array( $this, 'wpex_load_share_scripts' ) );

				// Replace social share
				add_filter( 'wpex_custom_social_share', array( $this, 'wpex_custom_social' ) );

				// Remove Customizer settings
				add_filter( 'wpex_customizer_sections', array( $this, 'wpex_remove_social_settings' ), 40 );

			}

			// Carousel
			if ( $this->is_module_active( 'carousel' ) || $this->is_module_active( 'tiled-gallery' ) ) {

				// Disable built-in custom gallery
				add_filter( 'wpex_custom_wp_gallery', '__return_false' );

			}

		}

		/*-------------------------------------------------------------------------------*/
		/* -  Sharedaddy Social Sharing
		/*-------------------------------------------------------------------------------*/

			/**
			 * Removes jetpack default loop filters
			 *
			 * @version 3.3.5
			 */
			public static function wpex_remove_share() {
				remove_filter( 'the_content', 'sharing_display', 19 );
				remove_filter( 'the_excerpt', 'sharing_display', 19 );
			}

			/**
			 * Enqueue scripts if social share is enabled
			 *
			 * @version 3.3.5
			 */
			public static function wpex_load_share_scripts() {
				if ( wpex_global_obj( 'has_social_share' ) ) {
					add_filter( 'sharing_enqueue_scripts', '__return_true' );
				}
			}

			/**
			 * Replace Total social share with sharedaddy
			 *
			 * @version 3.3.5
			 */
			public static function wpex_custom_social() {
				if ( function_exists( 'sharing_display' ) ) {
					$text = '';
					$echo = false;
					$classes = 'wpex-social-share position-horizontal clr';
					if ( 'full-screen' == wpex_global_obj( 'post_layout' ) ) {
						$classes .= ' container';
					}
					return '<div class="'. esc_attr( $classes ) .'">'. sharing_display( $text, $echo ) .'</div>';
				}
			}

			/**
			 * Remove Customizer settings
			 *
			 * @version 3.3.5
			 */
			public static function wpex_remove_social_settings( $array ) {
				unset( $array['wpex_social_sharing'] );
				return $array;
			}

	}
	
}
new WPEX_Jetpack_Config();