<?php
/**
 * Visual Composer Heading
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.3
 */

if ( ! class_exists( 'VCEX_Heading_Shortcode' ) ) {

	class VCEX_Heading_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_heading', array( 'VCEX_Heading_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_heading', array( 'VCEX_Heading_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_heading.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			// Strings
			$s_yes = esc_html__( 'Yes', 'total' );
			$s_no = esc_html__( 'No', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Heading', 'total' ),
				'description' => esc_html__( 'A better heading module', 'total' ),
				'base' => 'vcex_heading',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-heading vcex-icon fa fa-font',
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => array(
							__( 'Plain', 'total' ) => 'plain',
							__( 'Bottom Border With Color', 'total' ) => 'bottom-border-w-color',
							__( 'Graphical', 'total' ) => 'graphical',
						),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Accent Border Color', 'total' ),
						'param_name' => 'inner_bottom_border_color',
						'dependency' => array( 'element' => 'style', 'value' => 'bottom-border-w-color' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Border Color', 'total' ),
						'param_name' => 'inner_bottom_border_color_main',
						'dependency' => array( 'element' => 'style', 'value' => 'bottom-border-w-color' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Source', 'total' ),
						'param_name' => 'source',
						'value' => array(
							__( 'Custom Text', 'total' ) => '',
							__( 'Post or Page Title', 'total' ) => 'post_title',
							__( 'Custom Field', 'total' ) => 'custom_field',
						),
					),
					array(
						'type' => 'textarea_safe',
						'heading' => esc_html__( 'Text', 'total' ),
						'param_name' => 'text',
						'value' => esc_html__( 'Heading', 'total' ),
						'admin_label' => true, // Bad when user uses html.. ??
						'vcex_rows' => 2,
						'description' => esc_html__( 'HTML Supported', 'total' ),
						'dependency' => array( 'element' => 'source', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Field', 'total' ),
						'param_name' => 'custom_field',
						'dependency' => array( 'element' => 'source', 'value' => 'custom_field' ),
					),
					array(
						'type' => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'font_family',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Tag', 'total' ),
						'param_name' => 'tag',
						'value' => array(
							__( 'Default', 'total' ) => '',
							'h1' => 'h1',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'div' => 'div',
							'span' => 'span',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Responsive Font Size', 'total' ),
						'param_name' => 'responsive_text',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'dependency' => array( 'element' => 'font_size', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Minimum Font Size', 'total' ),
						'param_name' => 'min_font_size',
						'dependency' => array( 'element' => 'responsive_text', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'line_height',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'letter_spacing',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Italic', 'total' ),
						'param_name' => 'italic',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'font_weight',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Align', 'total' ),
						'param_name' => 'text_align',
						'value' => array_flip( wpex_alignments() ),
						'std' => '',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
					),
					// Link
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'URL', 'total' ),
						'param_name' => 'link',
						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link: Local Scroll', 'total' ),
						'param_name' => 'link_local_scroll',
						'value' => array(
							__( 'No', 'total' ) => 'false',
							__( 'Yes', 'total' ) => 'true',
						),
						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color: Hover', 'total' ),
						'param_name' => 'color_hover',
					),
					// Icon
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon library', 'total' ),
						'param_name' => 'icon_type',
						'description' => esc_html__( 'Select icon library.', 'total' ),
						'value' => array(
							__( 'Font Awesome', 'total' ) => 'fontawesome',
							__( 'Open Iconic', 'total' ) => 'openiconic',
							__( 'Typicons', 'total' ) => 'typicons',
							__( 'Entypo', 'total' ) => 'entypo',
							__( 'Linecons', 'total' ) => 'linecons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon',
						'value' => '',
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'openiconic',
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'openiconic' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'typicons',
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'typicons' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_entypo',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'entypo' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'linecons',
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'linecons' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Position', 'total' ),
						'param_name' => 'icon_position',
						'value' => array(
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' )  => 'right',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'icon_color',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					// CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'Design', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'CSS', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background: Hover', 'total' ),
						'param_name' => 'background_hover',
						'group' => esc_html__( 'CSS', 'total' ),
						'dependency' => array( 'element' => 'style', 'value' => 'plain' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'White Text On Hover', 'total' ),
						'param_name' => 'hover_white_text',
						'value' => array(
							__( 'No', 'total' ) => 'false',
							__( 'Yes', 'total' ) => 'true',
						),
						'group' => esc_html__( 'CSS', 'total' ),
						'dependency' => array( 'element' => 'style', 'value' => 'plain' ),
					),
				)
			);
		}

	}
}
new VCEX_Heading_Shortcode;