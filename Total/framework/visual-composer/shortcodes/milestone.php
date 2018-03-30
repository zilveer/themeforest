<?php
/**
 * Visual Composer Milestone
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Milestone_Shortcode' ) ) {

	class VCEX_Milestone_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_milestone', array( 'VCEX_Milestone_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_milestone', array( 'VCEX_Milestone_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_milestone.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Milestone', 'total' ),
				'description' => esc_html__( 'Animated counter', 'total' ),
				'base' => 'vcex_milestone',
				'icon' => 'vcex-milestone vcex-icon fa fa-medium',
				'category' => wpex_get_theme_branding(),
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
						'param_name' => 'classes',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Appear Animation', 'total' ),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Animation', 'total'),
						'param_name' => 'hover_animation',
						'value' => array_flip( wpex_hover_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animated', 'total' ),
						'param_name' => 'animated',
						'std' => 'true',
						'value' => array(
							__( 'Yes', 'total') => 'true',
							__( 'No', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Speed', 'total' ),
						'param_name' => 'speed',
						'value' => '2500',
						'description' => esc_html__('The number of milliseconds it should take to finish counting.','total'),
					),
					// Number
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Number', 'total' ),
						'param_name' => 'number',
						'std' => '45',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Decimal Places', 'total' ),
						'param_name' => 'decimals',
						'value' => '0',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Before', 'total' ),
						'param_name' => 'before',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'After', 'total' ),
						'param_name' => 'after',
						'default' => '%',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'number_font_family',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'number_color',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'number_size',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'number_weight',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
						'group' => esc_html__( 'Number', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Bottom Margin', 'total' ),
						'param_name' => 'number_bottom_margin',
						'group' => esc_html__( 'Number', 'total' ),
					),
					// caption
					array(
						'type' => 'textfield',
						'class' => 'vcex-animated-counter-caption',
						'heading' => esc_html__( 'Caption', 'total' ),
						'param_name' => 'caption',
						'value' => 'Awards Won',
						'admin_label' => true,
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'caption_font_family',
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__(  'Color', 'total' ),
						'param_name' => 'caption_color',
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'caption_size',
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'caption_font',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
						'group' => esc_html__( 'Caption', 'total' ),
					),
					// Link
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'URL', 'total' ),
						'param_name' => 'url',
						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'URL Target', 'total' ),
						'param_name' => 'url_target',
						'value' => array(
							__( 'Self', 'total') => 'self',
							__( 'Blank', 'total' ) => 'blank',
						),
						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'URl Rel', 'total' ),
						'param_name' => 'url_rel',
						'value' => array(
							__( 'None', 'total') => '',
							__( 'Nofollow', 'total' ) => 'nofollow',
						),

						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Container Wrap', 'total' ),
						'param_name' => 'url_wrap',
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'No', 'total' ) => 'false',
							__( 'Yes', 'total' ) => 'true',
						),
						'group' => esc_html__( 'Link', 'total' ),
						'description' => esc_html__( 'Apply the link to the entire wrapper?', 'total' ),
					),
					
					// CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'Design', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'Design options', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'total' ),
						'param_name' => 'width',
						'group' => esc_html__( 'Design options', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'border_radius',
						'group' => esc_html__( 'Design options', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Milestone_Shortcode;