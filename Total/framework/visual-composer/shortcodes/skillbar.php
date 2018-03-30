<?php
/**
 * Visual Composer Skillbar
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Skillbar_Shortcode' ) ) {

	class VCEX_Skillbar_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_skillbar', array( 'VCEX_Skillbar_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_skillbar', array( 'VCEX_Skillbar_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_skillbar.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Skill Bar', 'total' ),
				'description' => esc_html__( 'Animated skill bar', 'total' ),
				'base' => 'vcex_skillbar',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-skill-bar vcex-icon fa fa-server',
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Classes', 'total' ),
						'param_name' => 'classes',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'CSS Animation', 'total' ),
						'param_name' => 'css_animation',
						'value' => array(
							__( 'No', 'total' ) => '',
							__( 'Top to bottom', 'total' ) => 'top-to-bottom',
							__( 'Bottom to top', 'total' ) => 'bottom-to-top',
							__( 'Left to right', 'total' ) => 'left-to-right',
							__( 'Right to left', 'total' ) => 'right-to-left',
							__( 'Appear from center', 'total' ) => 'appear' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'total' ),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => 'Web Design',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Percentage', 'total' ),
						'param_name' => 'percentage',
						'value' => 70,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display % Number', 'total' ),
						'param_name' => 'show_percent',
						'value' => array(
							__( 'Yes', 'total' ) => 'true',
							__( 'No', 'total' ) => 'false',
						),
					),
					// Icon
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Icon', 'total' ),
						'param_name' => 'show_icon',
						'value' => array(
							__( 'No', 'total' ) => 'false',
							__( 'Yes', 'total' ) => 'true',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon library', 'total' ),
						'param_name' => 'icon_type',
						'value' => array(
							__( 'Font Awesome', 'total' ) => 'fontawesome',
							__( 'Open Iconic', 'total' ) => 'openiconic',
							__( 'Typicons', 'total' ) => 'typicons',
							__( 'Entypo', 'total' ) => 'entypo',
							__( 'Linecons', 'total' ) => 'linecons',
							__( 'Pixel', 'total' ) => 'pixelicons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
						'dependency' => array(
							'element' => 'show_icon',
							'value' => 'true',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
							'type' => 'openiconic',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'openiconic',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
							'type' => 'typicons',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_entypo',
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
							'type' => 'linecons',
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_pixelicons',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					// Design
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Container Background', 'total' ),
						'param_name' => 'background',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Container Inset Shadow', 'total' ),
						'param_name' => 'box_shadow',
						'value' => array(
							__( 'Yes', 'total' ) => 'true',
							__( 'No', 'total' ) => 'false',
						),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Skill Bar Color', 'total' ),
						'param_name' => 'color',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Container Height', 'total' ),
						'param_name' => 'container_height',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Container Left Padding', 'total' ),
						'param_name' => 'container_padding_left',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' => esc_html__( 'Design', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Skillbar_Shortcode;