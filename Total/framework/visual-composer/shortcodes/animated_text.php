<?php
/**
 * Visual Composer Animated Text Shortcode
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.1
 */

if ( ! class_exists( 'VCEX_Animated_Text_Shortcode' ) ) {

	class VCEX_Animated_Text_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_animated_text', array( 'VCEX_Animated_Text_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_animated_text', array( 'VCEX_Animated_Text_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_animated_text.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Animated Text', 'total' ),
				'description' => esc_html__( 'Animated text', 'total' ),
				'base' => 'vcex_animated_text',
				'icon' => 'vcex-animated-text vcex-icon fa fa-text-width',
				'category' => wpex_get_theme_branding(),
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
						'dependency' => array( 'element' => 'advanced_settings', 'value' => true )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Align', 'total' ),
						'param_name' => 'text_align',
						'value' => array_flip( wpex_alignments() ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Speed', 'total' ),
						'param_name' => 'speed',
						'std' => '0',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Back Delay', 'total' ),
						'param_name' => 'back_delay',
						'std' => '500',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Back Speed', 'total' ),
						'param_name' => 'back_speed',
						'std' => '0',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Start Delay', 'total' ),
						'param_name' => 'start_delay',
						'std' => '0',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Loop', 'total' ),
						'param_name' => 'loop',
						'value' => array(
							esc_html__( 'Yes', 'total' ) => 'true',
							esc_html__( 'No', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Cursor', 'total' ),
						'param_name' => 'type_cursor',
						'value' => array(
							esc_html__( 'No', 'total' ) => 'false',
							esc_html__( 'Yes', 'total' ) => 'true',
						),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'font_weight',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Style', 'total' ),
						'param_name' => 'font_style',
						'value' => array(
							esc_html__( 'Normal', 'total' ) => '',
							esc_html__( 'Italic', 'total' ) => 'italic',
						),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'font_family',
					),
					// Animated Text
					array(
						'type' => 'param_group',
						'param_name' => 'strings',
						'group' => esc_html__( 'Animated Text', 'total' ),
						'value' => urlencode( json_encode( array(
							array(
								'text' => esc_html__( 'Welcome', 'total' ),
							),
							array(
								'text' => esc_html__( 'Bienvenido', 'total' ),
							),
							array(
								'text' => esc_html__( 'Welkom', 'total' ),
							),
							array(
								'text' => esc_html__( 'Bienvenue', 'total' ),
							),
						) ) ),
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Text', 'total' ),
								'param_name' => 'text',
								'admin_label' => true,
							),
						),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'animated_font_family',
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'animated_color',
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'animated_font_weight',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Style', 'total' ),
						'param_name' => 'animated_font_style',
						'value' => array(
							esc_html__( 'Normal', 'total' ) => '',
							esc_html__( 'Italic', 'total' ) => 'italic',
						),
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Decoration', 'total' ),
						'param_name' => 'animated_text_decoration',
						'value' => array_flip( wpex_text_decorations() ),
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'animated_css',
						'group' => esc_html__( 'Animated Text', 'total' ),
					),
					
					// Static Text
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Enable', 'total' ),
						'param_name' => 'static_text',
						'group' => esc_html__( 'Static Text', 'total' ),
						'value' => array(
							esc_html__( 'No', 'total' ) => 'false',
							esc_html__( 'Yes', 'total' ) => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Before', 'total' ),
						'param_name' => 'static_before',
						'group' => esc_html__( 'Static Text', 'total' ),
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'After', 'total' ),
						'param_name' => 'static_after',
						'group' => esc_html__( 'Static Text', 'total' ),
						'dependency' => array( 'element' => 'static_text', 'value' => 'true' ),
					),
					// CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'CSS', 'total' ),
					),
				),
			);
		}
		

	}

}
new VCEX_Animated_Text_Shortcode;