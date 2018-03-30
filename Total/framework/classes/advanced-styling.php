<?php
/**
 * Advanced inline CSS output - requires advanced checks
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Advanced_Styling' ) ) {
	
	class WPEX_Advanced_Styling {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {
			add_filter( 'wpex_head_css', array( 'WPEX_Advanced_Styling', 'generate' ), 999 );
		}

		/**
		 * Generates the CSS output
		 *
		 * @since 2.0.0
		 */
		public static function generate( $output ) {

			// Define main variables
			$css = '';

			// Sticky Header shrink height
			if ( wpex_global_obj( 'shrink_fixed_header' ) ) {
				$shrink_header_style = wpex_global_obj( 'fixed_header_style' );
				if ( 'shrink' == $shrink_header_style || 'shrink_animated' == $shrink_header_style ) {
					$height = intval( wpex_get_mod( 'fixed_header_shrink_end_height' ) );
					$height = $height ? $height : 50;
					$header_height = $height + 20;
					$output .= '/*Shrink Fixed header*/';
					$output .= '.sticky-header-shrunk #site-header-inner{height:'. $header_height .'px;}';
					$output .= '.shrink-sticky-header.sticky-header-shrunk .navbar-style-five .dropdown-menu > li > a{height:'. $height .'px;}';
					$output .= '.shrink-sticky-header.sticky-header-shrunk #site-logo img{max-height:'. $height .'px !important;}';
				}
			}

			// Mobile menu breakpoint
			if ( wpex_global_obj( 'has_mobile_menu' ) ) {
				if ( $mm_breakpoint = intval( wpex_get_mod( 'mobile_menu_breakpoint' ) ) ) {
					$output .= '/*Mobile Menu Breakpoint*/';
					// Show main nav always and hide mobile
					$output .= 'body.wpex-mobile-toggle-menu-icon_buttons #site-header-inner.container { padding-right: 0; }
								body.has-mobile-menu #site-navigation-wrap { display: block }
								body.has-mobile-menu .wpex-mobile-menu-toggle { display: none }';
					// New breakpoint
					$output .= '@media only screen and (max-width: '. $mm_breakpoint .'px) {';
						$output .= 'body.wpex-mobile-toggle-menu-icon_buttons #site-header-inner.container { padding-right: 80px; }
									body.has-mobile-menu #site-navigation-wrap { display: none }
									body.has-mobile-menu .wpex-mobile-menu-toggle { display: block }';
						if ( 'fixed_top' == wpex_global_obj( 'mobile_menu_toggle_style' ) ) {
							$output .= 'body.has-mobile-menu.wpex-mobile-toggle-menu-fixed_top {
							    padding-top: 50px;
							}';
						}
					$output .= '}';
				}
			}

			// Logo height
			if ( wpex_global_obj( 'has_header' )
				&& wpex_get_mod( 'apply_logo_height', false )
				&& $height = intval( wpex_get_mod( 'logo_height' ) )
			) {
				$output .= '/*Logo Height*/';
				$output .= '#site-logo img{max-height:'. $height .'px;}';

			}

			// Fix for Fonts In the Visual Composer
			if ( wpex_global_obj( 'vc_is_inline' ) ) {
				$css .= '.wpb_row .fa:before { box-sizing:content-box!important; -moz-box-sizing:content-box!important; -webkit-box-sizing:content-box!important; }';
			}

			// Fixes for full-width layout when custom background is added
			if ( 'full-width' == wpex_global_obj( 'main_layout' )
				&& ( wpex_get_mod( 'background_color' ) || wpex_get_mod( 'background_image' ) )
			) {
				$css .= '.wpex-sticky-header-holder{background:none;}';
			}

			// Remove header border if custom color is set
			if ( wpex_global_obj( 'has_header' ) && wpex_get_mod( 'header_background' ) ) {
				$css .= '.is-sticky #site-header{border-color:transparent;}';
			}

			// Overlay Header font size
			if ( wpex_global_obj( 'has_overlay_header' )
				&& $font_size = get_post_meta( wpex_global_obj( 'post_id' ), 'wpex_overlay_header_font_size', true ) 
			) {
				$css .= '#site-navigation, #site-navigation .dropdown-menu a{font-size:'. intval( $font_size ) .'px;}';
			}

			// Page Header title bg
			if ( $bg = wpex_global_obj( 'page_header_bg_image' ) ) {
				$css .= '.page-header.wpex-supports-mods{background-image:url('. $bg .');}';
			}
			
			/*-----------------------------------------------------------------------------------*/
			/*  - Return CSS
			/*-----------------------------------------------------------------------------------*/
			if ( ! empty( $css ) ) {
				$output .= '/*ADVANCED STYLING CSS*/'. $css;
			}

			// Return output css
			return $output;

		}

	}

}
new WPEX_Advanced_Styling();