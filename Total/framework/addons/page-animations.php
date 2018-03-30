<?php
/**
 * Page Animation Functions
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
if ( ! class_exists( 'WPEX_Page_Animations' ) ) {

	class WPEX_Page_Animations {

		// Define vars
		private $has_animations;
		private $animate_in;
		private $animate_out;

		/**
		 * Main constructor
		 *
		 * @since 2.1.0
		 */
		public function __construct() {

			// Add customizer settings
			add_filter( 'wpex_customizer_sections', array( $this, 'customizer_settings' ) );

			// Animations disabled by default
			$this->has_animations = false;

			// Get animations
			$this->animate_in  = apply_filters( 'wpex_page_animation_in', wpex_get_mod( 'page_animation_in' ) );
			$this->animate_out = apply_filters( 'wpex_page_animation_out', wpex_get_mod( 'page_animation_out' ) );

			// Set enabled to true
			if ( $this->animate_in || $this->animate_out ) {
				$this->has_animations = true;
			}

			// If page animations is enabled lets do things
			if ( $this->has_animations ) {

				// Front-end stuff
				if ( ! is_admin() ) {
					add_filter( 'wp_enqueue_scripts', array( 'WPEX_Page_Animations', 'load_scripts' ) );
					add_action( 'wpex_outer_wrap_before', array( 'WPEX_Page_Animations', 'open_wrapper' ) );
					add_action( 'wpex_outer_wrap_after', array( 'WPEX_Page_Animations', 'close_wrapper' ) );
					add_action( 'wpex_localize_array', array( $this, 'localize' ) );
					add_action( 'wpex_head_css', array( 'WPEX_Page_Animations', 'loading_text' ) );
				}

				// Translations
				add_filter( 'wpex_register_theme_mod_strings', array( 'WPEX_Page_Animations', 'register_strings' ) );

			}

		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @since 2.1.0
		 */
		public static function load_scripts() {
			wp_enqueue_style( 'animsition', WPEX_CSS_DIR_URI .'lib/animsition.css' );
			wp_enqueue_script( 'animsition', WPEX_JS_DIR_URI .'dynamic/animsition.js', array( 'jquery', 'wpex-core' ), '4.0.2', true );
			wp_enqueue_script( 'wpex-animsition-init', WPEX_JS_DIR_URI .'dynamic/animsition-init.js', array( 'jquery', 'animsition' ), '1.0.0', true );
		}

		/**
		 * Localize script
		 *
		 * @since 2.1.0
		 */
		public function localize( $array ) {

			// Set animation to true
			$array['animsition'] = array();

			// Animate In
			if ( $this->animate_in && array_key_exists( $this->animate_in, self::in_transitions() ) ) {
				$array['animsition']['inClass'] = $this->animate_in;
			}

			// Animate out
			if ( $this->animate_out && array_key_exists( $this->animate_out, self::out_transitions() ) ) {
				$array['animsition']['outClass'] = $this->animate_out;
			}

			// Animation Speeds
			$speed = wpex_get_mod( 'page_animation_speed' );
			$speed = $speed ? $speed : 400;
			$array['animsition']['inDuration']  = $speed;
			$array['animsition']['outDuration'] = $speed;

			// Link Elements
			$array['animsition']['linkElement'] = 'a[href]:not([target="_blank"]):not([href^="#"]):not([href*="javascript"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".gif"]):not([href*=".png"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".mp4"]):not([href*=".flv"]):not([href*=".avi"]):not([href*=".mp3"]):not([href^="mailto:"]):not([href*="?"]):not([href*="#localscroll"]):not([class="wcmenucart"]):not([class="local-scroll"]):not([class="local-scroll-link"])';
	
			// Output opening div
			return $array;

		}

		/**
		 * Open wrapper
		 *
		 * @since 2.1.0
		 *
		 */
		public static function open_wrapper() {
			echo '<div class="wpex-page-animation-wrap animsition clr">';
		}

		/**
		 * Close Wrapper
		 *
		 * @since 2.1.0
		 *
		 */
		public static function close_wrapper() {
			echo '</div><!-- .animsition -->';
		}

		/**
		 * In Transitions
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 *
		 */
		public static function in_transitions() {
			return array(
				''              => esc_html__( 'None', 'total' ),
				'fade-in'       => esc_html__( 'Fade In', 'total' ),
				'fade-in-up'    => esc_html__( 'Fade In Up', 'total' ),
				'fade-in-down'  => esc_html__( 'Fade In Down', 'total' ),
				'fade-in-left'  => esc_html__( 'Fade In Left', 'total' ),
				'fade-in-right' => esc_html__( 'Fade In Right', 'total' ),
				'rotate-in'     => esc_html__( 'Rotate In', 'total' ),
				'flip-in-x'     => esc_html__( 'Flip In X', 'total' ),
				'flip-in-y'     => esc_html__( 'Flip In Y', 'total' ),
				'zoom-in'       => esc_html__( 'Zoom In', 'total' ),
			);
		}

		/**
		 * Out Transitions
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 */
		public static function out_transitions() {
			return array(
				''               => esc_html__( 'None', 'total' ),
				'fade-out'       => esc_html__( 'Fade Out', 'total' ),
				'fade-out-up'    => esc_html__( 'Fade Out Up', 'total' ),
				'fade-out-down'  => esc_html__( 'Fade Out Down', 'total' ),
				'fade-out-left'  => esc_html__( 'Fade Out Left', 'total' ),
				'fade-out-right' => esc_html__( 'Fade Out Right', 'total' ),
				'rotate-out'     => esc_html__( 'Rotate Out', 'total' ),
				'flip-out-x'     => esc_html__( 'Flip Out X', 'total' ),
				'flip-out-y'     => esc_html__( 'Flip Out Y', 'total' ),
				'zoom-out'       => esc_html__( 'Zoom Out', 'total' ),
			);
		}

		/**
		 * Add strings for WPML
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 */
		public static function register_strings( $strings ) {
			$strings['page_animation_loading'] = esc_html__( 'Loading...', 'total' );
			return $strings;
		}

		/**
		 * Adds customizer settings for the animations
		 *
		 * @return array
		 *
		 * @since 2.1.0
		 */
		public static function customizer_settings( $sections ) {
			$sections['wpex_page_animations'] = array(
				'title' => esc_html__( 'Page Animations', 'total' ),
				'panel' => 'wpex_general',
				'desc'  => esc_html__( 'You must save your options and refresh your live site to preview changes to this setting.', 'total' ),
				'settings' => array(
					array(
						'id' => 'page_animation_in',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'In Animation', 'total' ),
							'type' => 'select',
							'choices' => self::in_transitions(),
						),
					),
					array(
						'id' => 'page_animation_out',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'Out Animation', 'total' ),
							'type' => 'select',
							'choices' => self::out_transitions(),
						),
					),
					array(
						'id' => 'page_animation_loading',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'Loading Text', 'total' ),
							'type' => 'text',
						),
					),
					array(
						'id' => 'page_animation_speed',
						'transport' => 'postMessage',
						'default' => 400,
						'control' => array(
							'label' => esc_html__( 'Speed', 'total' ),
							'type' => 'number',
						),
					),
				)
			);
			return $sections;
		}

		/**
		 * Add loading text
		 *
		 * @since 2.0.0
		 */
		public static function loading_text( $css ) {
			$text = wpex_get_mod( 'page_animation_loading' );
			$text = $text ? $text : esc_html__( 'Loading...', 'total' );
			$css .= '/*PAGE ANIMATIONS*/.animsition-loading{content:"'. $text .'";}';
			return $css;
		}

	}

	new WPEX_Page_Animations();

}