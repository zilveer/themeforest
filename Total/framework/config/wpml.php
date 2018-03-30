<?php
/**
 * WPML Configuration Class
 *
 * @package Total WordPress Theme
 * @subpackage Configs
 * @version 3.5.3
 */

if ( ! class_exists( 'WPEX_WPML_Config' ) ) {

	class WPEX_WPML_Config {

		/**
		 * Start things up
		 *
		 * @since 1.6.0
		 */
		public function __construct() {

			// Add Actions
			add_action( 'admin_init', array( 'WPEX_WPML_Config', 'register_strings' ) );
			add_filter( 'body_class', array( 'WPEX_WPML_Config', 'body_class' ) );

			// Add Filters
			add_filter( 'upload_dir', array( 'WPEX_WPML_Config', 'upload_dir' ) );

			// Register shortcodes
			add_shortcode( 'wpml_translate', array( 'WPEX_WPML_Config', 'translate_shortcode' ) );
			add_shortcode( 'wpml_lang_selector', array( 'WPEX_WPML_Config', 'switcher_shortcode' ) );

		}

		/**
		 * Registers theme_mod strings into WPML
		 *
		 * @since 1.6.0
		 */
		public static function register_strings() {
			if ( function_exists( 'icl_register_string' ) && $strings = wpex_register_theme_mod_strings() ) {
				foreach( $strings as $string => $default ) {
					icl_register_string( 'Theme Mod', $string, get_theme_mod( $string, $default ) );
				}
			}
		}

		/**
		 * Registers theme_mod strings into WPML
		 *
		 * @since 3.0.0
		 */
		public static function body_class( $classes ) {
			if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
				$classes[] = 'wpml-language-'. ICL_LANGUAGE_CODE;
			}
			return $classes;
		}

		/**
		 * Fix for when users have the Language URL Option on "different domains"
		 * which causes cropped images to fail.
		 *
		 * @since 1.6.0
		 */
		public static function upload_dir( $upload ) {

			// Check if WPML language_negociation type
			$language_negociation = apply_filters( 'wpml_setting', false, 'language_negotiation_type' );
			if ( $language_negociation !== false && $language_negociation == 2 ) {
				$upload['baseurl'] = apply_filters( 'wpml_permalink', $upload['baseurl'] );
			}

			// Return $upload var
			return $upload;

		}

		/**
		 * WPML Translation Shortcode
		 *
		 * [wpml_translate lang=es]Hola[/wpml_translate]
		 * [wpml_translate lang=en]Hello[/wpml_translate]
		 *
		 * @since 1.6.0
		 */
		public static function translate_shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'lang'	=> '',
			), $atts ) );
			$lang_active = ICL_LANGUAGE_CODE;
			if ( $lang == $lang_active ) {
				return do_shortcode( $content );
			}
		}

		/**
		 * Language switcher plugin
		 *
		 * @since 1.6.0
		 */
		public static function switcher_shortcode( $atts, $content = null ) {
			do_action( 'icl_language_selector' );
		}

	}
	
}
new WPEX_WPML_Config();