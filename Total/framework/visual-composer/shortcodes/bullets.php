<?php
/**
 * Visual Composer Bullets
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Bullets_Shortcode' ) ) {

	class VCEX_Bullets_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_bullets', array( 'VCEX_Bullets_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_bullets', array( 'VCEX_Bullets_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_bullets.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Bullets', 'total' ),
				'description' => esc_html__( 'Styled bulleted lists', 'total' ),
				'base' => 'vcex_bullets',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-bullets vcex-icon fa fa-dot-circle-o',
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'admin_label' => true,
						'value' => array(
							__( 'Check', 'total') => 'check',
							__( 'Blue', 'total' ) => 'blue',
							__( 'Gray', 'total' ) => 'gray',
							__( 'Purple', 'total' ) => 'purple',
							__( 'Red', 'total' ) => 'red',
						),
					),
					array(
						'type' => 'textarea_html',
						'heading' => esc_html__( 'Insert Unordered List', 'total' ),
						'param_name' => 'content',
						'value' => '<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>',
					),
				)
			);
		}

	}
}
new VCEX_Bullets_Shortcode;