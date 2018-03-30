<?php
/**
 * Visual Composer Leader
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.3
 */

if ( ! class_exists( 'VCEX_Leader_Shortcode' ) ) {

	class VCEX_Leader_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_leader', array( 'VCEX_Leader_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_leader', array( 'VCEX_Leader_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_leader.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Leader (Menu Items)', 'total' ),
				'description' => esc_html__( 'CSS dot or line leader (menu item)', 'total' ),
				'base' => 'vcex_leader',
				'icon' => 'vcex-leader vcex-icon fa fa-long-arrow-right',
				'category' => wpex_get_theme_branding(),
				'params' => array(
					// Leaders
					array(
						'type' => 'param_group',
						'param_name' => 'leaders',
						'group' => esc_html__( 'Leaders', 'total' ),
						'value' => urlencode( json_encode( array(
							array(
								'label' => esc_html__( 'One', 'total' ),
								'value' => '$10',
							),
							array(
								'label' => esc_html__( 'Two', 'total' ),
								'value' => '$20',
							),
						) ) ),
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Label', 'total' ),
								'param_name' => 'label',
								'admin_label' => true,
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Value', 'total' ),
								'param_name' => 'value',
								'admin_label' => true,
							),
						),
					),
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Classes', 'total' ),
						'param_name' => 'el_class',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Responsive', 'total' ),
						'param_name' => 'responsive',
						'value' => array(
							__( 'Yes', 'total' ) => 'true',
							__( 'No', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Appear Animation', 'total' ),
						'param_name' => 'css_animation',
						'value' => array(
							__( 'No', 'total' ) => '',
							__( 'Top to bottom', 'total' ) => 'top-to-bottom',
							__( 'Bottom to top', 'total' ) => 'bottom-to-top',
							__( 'Left to right', 'total' ) => 'left-to-right',
							__( 'Right to left', 'total' ) => 'right-to-left',
							__( 'Appear from center', 'total' ) => 'appear'
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => array(
							__( 'Dots', 'total' ) => 'dots',
							__( 'Dashes', 'total' ) => 'dashes',
						),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'background',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
					),
					// Label
					array(
						'type' => 'colorpicker',
						'param_name' => 'label_color',
						'heading' => esc_html__( 'Color', 'total' ),
						'group' => esc_html__( 'Label', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'label_font_weight',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'group' => esc_html__( 'Label', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Style', 'total' ),
						'param_name' => 'label_font_style',
						'value' => array(
							esc_html__( 'Normal', 'total' ) => '',
							esc_html__( 'Italic', 'total' ) => 'italic',
						),
						'group' => esc_html__( 'Label', 'total' ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'label_font_family',
						'group' => esc_html__( 'Label', 'total' ),
					),
					// Color
					array(
						'type' => 'colorpicker',
						'param_name' => 'value_color',
						'heading' => esc_html__( 'Color', 'total' ),
						'group' => esc_html__( 'Value', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'value_font_weight',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'group' => esc_html__( 'Value', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'font Style', 'total' ),
						'param_name' => 'value_font_style',
						'value' => array(
							esc_html__( 'Normal', 'total' ) => '',
							esc_html__( 'Italic', 'total' ) => 'italic',
						),
						'group' => esc_html__( 'Value', 'total' ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'value_font_family',
						'group' => esc_html__( 'Value', 'total' ),
					),
				)
			);
		}

	}

}
new VCEX_Leader_Shortcode;