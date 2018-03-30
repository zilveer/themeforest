<?php
/**
 * Visual Composer Countdown
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.3
 */

if ( ! class_exists( 'VCEX_Countdown_Shortcode' ) ) {

	class VCEX_Countdown_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.3
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_countdown', array( 'VCEX_Countdown_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_countdown', array( 'VCEX_Countdown_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.3
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_countdown.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.3
		 */
		public static function map() {
			// Strings
			$s_yes = esc_html__( 'Yes', 'total' );
			$s_no = esc_html__( 'No', 'total' );
			// Array
			return array(
				'name' => esc_html__( 'Countdown', 'total' ),
				'description' => esc_html__( 'Animated countdown clock', 'total' ),
				'base' => 'vcex_countdown',
				'icon' => 'vcex-countdown vcex-icon fa fa-clock-o',
				'category' => wpex_get_theme_branding(),
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
						'param_name' => 'el_class',
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
						'type' => 'textfield',
						'heading' => esc_html__( 'End Year', 'total' ),
						'param_name' => 'end_year',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'End Month', 'total' ),
						'param_name' => 'end_month',
						'value' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'End Day', 'total' ),
						'param_name' => 'end_day',
						'value' => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31' ),
					),
					// Design
					array(
						'type' => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'font_family',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'line_height',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'letter_spacing',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Italic', 'total' ),
						'param_name' => 'italic',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'font_weight',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Align', 'total' ),
						'param_name' => 'text_align',
						'value' => array_flip( wpex_alignments() ),
						'std' => '',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
						'group' =>  esc_html__( 'Design', 'total' ),
					),
					// Translations
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Days', 'total' ),
						'param_name' => 'days',
						'group' =>  esc_html__( 'Strings', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Hours', 'total' ),
						'param_name' => 'hours',
						'group' =>  esc_html__( 'Strings', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Minutes', 'total' ),
						'param_name' => 'minutes',
						'group' =>  esc_html__( 'Strings', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Seconds', 'total' ),
						'param_name' => 'seconds',
						'group' =>  esc_html__( 'Strings', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Countdown_Shortcode;