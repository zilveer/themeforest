<?php
/**
 * iLightbox class
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
if ( ! class_exists( 'WPEX_iLightbox' ) ) {

	class WPEX_iLightbox {

		/**
		 * Main constructor
		 *
		 * @since 2.1.0
		 */
		public function __construct() {

			// Define lightbox stylesheets
			add_action( 'wp_enqueue_scripts', array( 'WPEX_iLightbox', 'register_style_sheets' ), 20 );

			// Load scripts
			if ( wpex_get_mod( 'lightbox_auto' ) ) {
				add_action( 'wp_enqueue_scripts', array( 'WPEX_iLightbox', 'load_stylesheet_always' ), 40 );
			}

			// Add to localize array
			add_filter( 'wpex_localize_array', array( 'WPEX_iLightbox', 'localize' ) );

			// Add customizer settings
			add_filter( 'wpex_customizer_sections', array( 'WPEX_iLightbox', 'customizer_settings' ) );

		}

		/**
		 * Localize scripts
		 *
		 * @since 2.1.0
		 */
		public static function active_skin() {
			$skin = wpex_get_mod( 'lightbox_skin' );
			$skin = $skin ? $skin : 'minimal';
			return apply_filters( 'wpex_lightbox_skin', $skin );
		}

		/**
		 * Localize scripts
		 *
		 * @since 2.1.0
		 */
		public static function localize( $array ) {
			$array['iLightbox'] = array(
				'auto' => wpex_get_mod( 'lightbox_auto', false ),
				'skin' => wpex_global_obj( 'lightbox_skin' ),
				'path' => 'horizontal',
				'infinite' => true,
				'controls' => array(
					'arrows' => wpex_get_mod( 'lightbox_arrows', true ),
					'thumbnail' => wpex_get_mod( 'lightbox_thumbnails', true ),
					'fullscreen' => wpex_get_mod( 'lightbox_fullscreen', true ),
					'mousewheel' => wpex_get_mod( 'lightbox_mousewheel', false ),
				),
				'effects' => array(
					'loadedFadeSpeed' => 50,
					'fadeSpeed' => 500,
				),
				'show' => array(
					'title' => wpex_get_mod( 'lightbox_titles', true ),
					'speed' => 200,
				),
				'hide' => array(
					'speed' => 200,
				),
				'overlay' => array(
					'blur' => true,
					'opacity' => 0.9,
				),
				'social' => array(
					'start' => true,
					'show' => 'mouseenter',
					'hide' => 'mouseleave',
					'buttons' => false,
				),
			);
			return $array;
		}

		/**
		 * Holds an array of lightbox skins
		 *
		 * @since 2.1.0
		 */
		public static function skins() {
			return apply_filters( 'wpex_ilightbox_skins', array(
				'minimal'     => esc_html__( 'Minimal', 'total' ),
				'white'       => esc_html__( 'White', 'total' ),
				'dark'        => esc_html__( 'Dark', 'total' ),
				'light'       => esc_html__( 'Light', 'total' ),
				'mac'         => esc_html__( 'Mac', 'total' ),
				'metro-black' => esc_html__( 'Metro Black', 'total' ),
				'metro-white' => esc_html__( 'Metro White', 'total' ),
				'parade'      => esc_html__( 'Parade', 'total' ),
				'smooth'      => esc_html__( 'Smooth', 'total' ),
			) );
		}

		/**
		 * Returns correct skin stylesheet
		 *
		 * @since 2.1.0
		 */
		public static function skin_style( $skin = null ) {

			// Sanitize skin
			$skin = $skin ? $skin : wpex_ilightbox_skin();

			// Loop through skins
			$stylesheet = WPEX_CSS_DIR_URI .'ilightbox/'. $skin .'/ilightbox-'. $skin .'-skin.css';

			// Apply filters and return
			return apply_filters( 'wpex_ilightbox_stylesheet', $stylesheet );

		}

		/**
		 * Enqueues iLightbox skin stylesheet
		 *
		 * @since 2.1.0
		 */
		public static function enqueue_style( $skin = null ) {

			// Get default skin if custom skin not defined
			$skin = ( $skin && 'default' != $skin ) ? $skin : wpex_ilightbox_skin();

			// Enqueue stylesheet
			wp_enqueue_style( 'wpex-ilightbox-'. $skin );

		}

		/**
		 * Registers all stylesheets for quick usage and enqueues default skin for the whole site
		 *
		 * @since 2.1.0
		 */
		public static function register_style_sheets() {
			foreach( self::skins() as $key => $val ) {
				wp_register_style( 'wpex-ilightbox-'. $key, self::skin_style( $key ), false, WPEX_THEME_VERSION );
			}
		}

		/**
		 * Will load the lightbox main stylesheet everywhere
		 *
		 * @since 2.1.0
		 */
		public static function load_stylesheet_always() {
			wp_enqueue_style( 'wpex-ilightbox-'. self::active_skin(), false, WPEX_THEME_VERSION );
		}

		/**
		 * Loads the stylesheet
		 *
		 * @since 2.1.0
		 */
		public static function load_css() {
			self::enqueue_style();
		}

		/**
		 * Adds lightbox customizer settings
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 */
		public static function customizer_settings( $sections ) {
			$sections['wpex_lightbox'] = array(
				'title' => esc_html__( 'Lightbox', 'total' ),
				'panel' => 'wpex_general',
				'settings' => array(
					array(
						'id' => 'lightbox_skin',
						'transport' => 'postMessage',
						'control' => array (
							'label' => esc_html__( 'Skin', 'total' ),
							'type' => 'select',
							'choices' => wpex_ilightbox_skins(),
							'desc'  => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
						),
					),
					array(
						'id' => 'lightbox_auto',
						'control' => array (
							'label' => esc_html__( 'Auto Lightbox', 'total' ),
							'type' => 'checkbox',
							'desc' => esc_html__( 'Automatically add Lightbox to images inserted into the post editor.', 'total' ),
						),
					),
					array(
						'id' => 'lightbox_thumbnails',
						'default' => true,
						'control' => array (
							'label' => esc_html__( 'Gallery Thumbnails', 'total' ),
							'type' => 'checkbox',
						),
					),
					array(
						'id' => 'lightbox_arrows',
						'default' => true,
						'control' => array (
							'label' => esc_html__( 'Gallery Arrows', 'total' ),
							'type' => 'checkbox',
						),
					),
					array(
						'id' => 'lightbox_mousewheel',
						'default' => false,
						'control' => array (
							'label' => esc_html__( 'Gallery Mousewheel Scroll', 'total' ),
							'type' => 'checkbox',
						),
					),
					array(
						'id' => 'lightbox_titles',
						'default' => true,
						'control' => array (
							'label' => esc_html__( 'Titles', 'total' ),
							'type' => 'checkbox',
						),
					),
					array(
						'id' => 'lightbox_fullscreen',
						'default' => true,
						'control' => array (
							'label' => esc_html__( 'Fullscreen Button', 'total' ),
							'type' => 'checkbox',
						),
					),
				),
			);
			return $sections;
		}

	}

}
new WPEX_iLightbox();


/* Helper functions
-------------------------------------------------------------------------------*/

/**
 * Returns array of ilightbox Skins
 *
 * @since 2.0.0
 */
function wpex_ilightbox_skins() {
	return WPEX_iLightbox::skins();
}

/**
 * Returns lightbox skin
 *
 * @since 1.3.3
 */
function wpex_ilightbox_skin() {
	return WPEX_iLightbox::active_skin();
}

/**
 * Enqueues lightbox stylesheet
 *
 * @since 1.3.3
 */
function wpex_enqueue_ilightbox_skin( $skin = null ) {
	return WPEX_iLightbox::enqueue_style( $skin );
}

// Deprecated functions
function wpex_ilightbox_stylesheet( $skin = null ) {
	return; // This function is no longer needed and shouldn't be used
}