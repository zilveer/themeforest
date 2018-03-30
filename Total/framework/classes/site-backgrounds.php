<?php
/**
 * Used for custom site backgrounds
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
if ( ! class_exists( 'WPEX_Site_Backgrounds' ) ) {
	
	class WPEX_Site_Backgrounds {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		function __construct() {
			add_filter( 'wpex_head_css', array( 'WPEX_Site_Backgrounds', 'get_css' ), 999 );
		}

		/**
		 * Generates the CSS output
		 *
		 * @since 2.0.0
		 */
		public static function get_css( $output ) {

			// Vars
			$css = $add_css = '';

			// Global vars
			$css     = '';
			$color   = wpex_get_mod( 'background_color' );
			$image   = wpex_get_mod( 'background_image' );
			$style   = wpex_get_mod( 'background_style' );
			$pattern = wpex_get_mod( 'background_pattern' );
			$post_id = wpex_global_obj( 'post_id' );

			// Single post vars
			if ( $post_id ) {

				// Color
				$single_color = get_post_meta( $post_id, 'wpex_page_background_color', true );
				$single_color = str_replace( '#', '', $single_color );

				// Image
				$single_image = get_post_meta( $post_id, 'wpex_page_background_image_redux', true );
				if ( $single_image ) {
					if ( is_array( $single_image ) ) {
						$single_image = ( ! empty( $single_image['url'] ) ) ? $single_image['url'] : '';
					} else {
						$single_image = $single_image;
					}
				} else {
					$single_image = get_post_meta( $post_id, 'wpex_page_background_image', true );
				}

				// Background style
				$single_style = get_post_meta( $post_id, 'wpex_page_background_image_style', true );

			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Sanitize Data
			/*-----------------------------------------------------------------------------------*/

			// Color
			$color = ! empty( $single_color ) ? $single_color : $color;
			$color = str_replace( '#', '', $color );

			// Image
			$image = ! empty( $single_image ) ? $single_image : $image;

			// Check if image is a URL or an ID
			if ( is_numeric( $image ) ) {
				$image = wp_get_attachment_image_src( $image, 'full' );
				$image = $image[0];
			}

			// Style
			$style = ( ! empty( $single_image ) && ! empty( $single_style ) ) ? $single_style : $style;
			$style = $style ? $style : 'stretched';

			/*-----------------------------------------------------------------------------------*/
			/*  - Generate CSS
			/*-----------------------------------------------------------------------------------*/

			// Color
			if ( $color ) {
				
				$css .= 'background-color:#'. $color .'!important;';

				// Footer reveal fix
				if ( wpex_global_obj( 'has_footer_reveal' ) ) {
					$output .= '.footer-has-reveal #main{ background-color:#'. $color .'!important;}';
				}

			}
			
			// Image
			if ( $image && ! $pattern ) {
				$css .= 'background-image:url('. $image .') !important;';
				$css .= wpex_sanitize_data( $style, 'background_style_css' );
			}
			
			// Pattern
			if ( $pattern ) {
				$css .= 'background-image:url('. $pattern .'); background-repeat:repeat;';
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Return $css
			/*-----------------------------------------------------------------------------------*/
			if ( ! empty( $css ) ) {
				$css = '/*SITE BACKGROUND*/body{'. $css .'}';
				$output .= $css;
			}

			// Return output css
			return $output;

		}

	}
}
new WPEX_Site_Backgrounds();