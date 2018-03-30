<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Tiny_Mce_Shortcodes' ) ) {
	/**
	 * Main Wolf_Tiny_Mce_Shortcodes Class
	 *
	 * Contains the main functions for Wolf_Tiny_Mce_Shortcodes
	 *
	 * @class Wolf_Tiny_Mce_Shortcodes
	 * @since 1.0.0
	 * @package Decibel
	 * @author WolfThemes
	 */
	class Wolf_Tiny_Mce_Shortcodes {

		/**
		 * Wolf_Tiny_Mce_Shortcodes Constructor.
		 */
		public function __construct() {

			// Admin tinyMCE and styles
			add_action( 'admin_init', array( $this, 'mce_init' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}

		/**
		 * Registers TinyMCE rich editor buttons.
		 */
		public function mce_init() {

			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
				return;

			if ( get_user_option( 'rich_editing' ) == 'true' ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_button' ) );
				add_filter( 'tiny_mce_before_init', array( $this, 'google_font_list' ) );
			}
		}

		/**
		 * Defines TinyMCE rich editor js plugin.
		 *
		 * @param array $plugin_array
		 */
		public function add_plugin( $plugin_array ) {

			$plugin_array['WolfShortcodesTinyMce'] = WOLF_THEME_URI . '/includes/admin/tinymce/plugin.js';

			return $plugin_array;
		}

		/**
		 * Adds TinyMCE rich editor buttons.
		 *
		 * @param array $button
		 */
		public function register_button( $buttons ) {
			$buttons[] = 'wolf_shortcodes_tiny_mce_button';
			$buttons[] = 'fontselect';
			return $buttons;
		}

		/**
		 * Adds google font dropdown
		 *
		 * @param array $button
		 */
		public function google_font_list( $params ){
			global $wolf_fonts;

			$fonts = '';

			foreach ( $wolf_fonts as $key => $value ) {
				if ( '' != $value ) {
					$fonts .= "$key=$key;";
				}
			}

			$params['font_formats'] = $fonts;

			return $params;
		}

		/**
		 * Register/queue admin scripts.
		 */
		public function admin_scripts() {

			global $wolf_fonts;

			wp_enqueue_style( 'wolf-popup', WOLF_THEME_URI . '/includes/admin/tinymce/css/popup.css', false, '1.0', 'all' );
			wp_localize_script( 'jquery', 'Wolf_Shortcodes_Tiny_Mce', array( 'plugin_folder' => WOLF_THEME_URI . '/includes/admin/tinymce/' ) );

			wp_enqueue_script( 'wolf-tinymce', WOLF_THEME_URI . '/js/admin/tinymce.js', 'jquery', WOLF_THEME_VERSION, true );
			// Add JS global variables
			wp_localize_script(
				'wolf-tinymce', 'WolfTinyMceParams', array(
					'dropcap' => __( 'Dropcap', 'wolf' ),
					'button' => __( 'Button', 'wolf' ),
					'alert' => __( 'Alert', 'wolf' ),
					'highlight' => __( 'Highlight', 'wolf' ),
					'spacer' => __( 'Vertical Height', 'wolf' ),
					'mailchimp' => __( 'Newsletter sign up', 'wolf' ),
					'fittext' => __( 'Headline', 'wolf' ),
					'socials' => __( 'Socials', 'wolf' ),
					'fonts' => __( 'Fonts', 'wolf' ),
					'columns' => __( 'Columns', 'wolf' ),
					'fontList' => $wolf_fonts,
				)
			);
		}

	} // end class

	$GLOBALS['wolf_tiny_mce_shortce_shortcodes'] = new Wolf_Tiny_Mce_Shortcodes;
} // end class exist check