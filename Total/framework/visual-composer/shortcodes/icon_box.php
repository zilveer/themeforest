<?php
/**
 * Visual Composer Icon Box
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Icon_Box_Shortcode' ) ) {

	class VCEX_Icon_Box_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_icon_box', array( 'VCEX_Icon_Box_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_icon_box', array( 'VCEX_Icon_Box_Shortcode', 'map' ) );
			}

			// Edit fields
			if ( is_admin() ) {
				add_filter( 'vc_edit_form_fields_attributes_vcex_icon_box', array( 'VCEX_Icon_Box_Shortcode', 'edit_fields' ), 10 );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_icon_box.php' ) );
			return ob_get_clean();
		}

		/**
		 * Edit form fields
		 *
		 * @since 3.5.0
		 */
		public static function edit_fields( $atts ) {

			// Set font family if icon is defined
			if ( isset( $atts['icon'] ) && empty( $atts['icon_type'] ) ) {
				$atts['icon_type'] = 'fontawesome';
				if ( strpos( $atts['icon'], 'fa' ) === false ) {
					$atts['icon'] = 'fa fa-'. $atts['icon'];
				}
			}

			// Return $atts
			return $atts;
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Icon Box', 'total' ),
				'base' => 'vcex_icon_box',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-icon-box vcex-icon fa fa-star',
				'description' => esc_html__( 'Content box with icon', 'total' ),
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'param_name' => 'classes',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Animation', 'total'),
						'param_name' => 'hover_animation',
						'value' => array_flip( wpex_hover_css_animations() ),
						'std' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => vcex_icon_box_styles(),
						'description' => esc_html__( 'For greater control select left, right or top icon styles then go to the "Design" tab to modify the icon box design.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Alignment', 'total' ),
						'param_name' => 'alignment',
						'dependency' => array(
							'element' => 'style',
							'value' => array( 'two' ),
						),
						'value' => array(
							__( 'Default', 'total') => '',
							__( 'Center', 'total') => 'center',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Icon Bottom Margin', 'total' ),
						'param_name' => 'icon_bottom_margin',
						'dependency' => array(
							'element' => 'style',
							'value' => array( 'two', 'three', 'four', 'five', 'six' ),
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Container Left Padding', 'total' ),
						'param_name' => 'container_left_padding',
						'dependency' => array( 'element' => 'style', 'value' => array( 'one' ) ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Container Right Padding', 'total' ),
						'param_name' => 'container_right_padding',
						'description' => esc_html__( 'Please enter a px value.', 'total' ),
						'dependency' => array(
							'element' => 'style',
							'value' => array( 'seven' )
						),
					),
					// Content
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'heading' => esc_html__( 'Content', 'total' ),
						'param_name' => 'content',
						'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'group' => esc_html__( 'Content', 'total' ),
						'admin_label' => false,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' => esc_html__( 'Content', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'font_color',
						'group' => esc_html__( 'Content', 'total' ),
					),
					// Heading
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Heading', 'total' ),
						'param_name' => 'heading',
						'std' => 'Sample Heading',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'heading_color',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Type', 'total' ),
						'param_name' => 'heading_type',
						'value' => array(
							__( 'Default', 'total' ) => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'div' => 'div',
							'span' => 'span',
						),
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'heading_font_family',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'heading_weight',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'heading_transform',
						'std' => '',
						'group' => esc_html__( 'Heading', 'total' ),
						'value' => array_flip( wpex_text_transforms() ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'heading_size',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'heading_letter_spacing',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Bottom Margin', 'total' ),
						'param_name' => 'heading_bottom_margin',
						'group' => esc_html__( 'Heading', 'total' ),
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
							__( 'Pixel', 'total' ) => 'pixelicons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'total' ),
						'param_name' => 'icon',
						'value' => 'fa fa-info-circle',
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
							'type' => 'openiconic',
							'iconsPerPage' => 200,
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
							'type' => 'typicons',
							'iconsPerPage' => 200,
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
							'emptyIcon' => true,
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
							'type' => 'linecons',
							'iconsPerPage' => 200,
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
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Icon Font Alternative Classes', 'total' ),
						'param_name' => 'icon_alternative_classes',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'icon_color',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'icon_background',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'icon_size',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'icon_border_radius',
						'description' => esc_html__( 'For a circle enter 50%.', 'total' ),
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'total' ),
						'param_name' => 'icon_width',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Height', 'total' ),
						'param_name' => 'icon_height',
						'group' => esc_html__( 'Icon', 'total' ),
					),
					// Icon
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Icon Image Alternative', 'total' ),
						'param_name' => 'image',
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Bottom Margin', 'total' ),
						'param_name' => 'image_bottom_margin',
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'style', 'value' => array( 'two' ) ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'total' ),
						'param_name' => 'image_width',
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Height', 'total' ),
						'param_name' => 'image_height',
						'group' => esc_html__( 'Image', 'total' ),
					),
					// URL
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'URL', 'total' ),
						'param_name' => 'url',
						'group' => esc_html__( 'URL', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'URL Target', 'total' ),
						'param_name' => 'url_target',
						 'value' => array(
							__( 'Self', 'total' ) => 'self',
							__( 'Blank', 'total' ) => '_blank',
							__( 'Local', 'total' ) => 'local',
						),
						'group' => esc_html__( 'URL', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'URL Rel', 'total' ),
						'param_name' => 'url_rel',
						'value' => array(
							__( 'None', 'total' ) => '',
							__( 'Nofollow', 'total' ) => 'nofollow',
						),
						'group' => esc_html__( 'URL', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Container Wrap', 'total' ),
						'param_name' => 'url_wrap',
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'Yes', 'total' ) => 'true',
							__( 'No', 'total' ) => 'false',
						),
						'group' => esc_html__( 'URL', 'total' ),
						'description' => esc_html__( 'Apply the link to the entire wrapper?', 'total' ),
					),
					// Design
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'description' => esc_html__( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'total' ),
						'group' => esc_html__( 'CSS', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'border_radius',
						'group' => esc_html__( 'CSS', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background: Hover', 'total' ),
						'param_name' => 'hover_background',
						'description' => esc_html__( 'Will add a hover background color to your entire icon box or replace the current hover color for specific icon box styles.', 'total' ),
						'group' => esc_html__( 'CSS', 'total' ),
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
					),
				)
			);
		}
	}
}
new VCEX_Icon_Box_Shortcode;