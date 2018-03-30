<?php
/**
 * Visual Composer Pricing
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Pricing_Shortcode' ) ) {

	class VCEX_Pricing_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_pricing', array( 'VCEX_Pricing_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_pricing', array( 'VCEX_Pricing_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Edit form fields
				add_filter( 'vc_edit_form_fields_attributes_vcex_pricing', array( 'VCEX_Pricing_Shortcode', 'edit_form_fields' ) );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_pricing.php' ) );
			return ob_get_clean();
		}

		/**
		 * Alter module fields on edit
		 *
		 * @since 3.5.0
		 */
		public static function edit_form_fields( $atts ) {
			// Convert textfield link to vc_link
			if ( ! empty( $atts['button_url'] ) && false === strpos( $atts['button_url'], 'url:' ) ) {
				$url = 'url:'. $atts['button_url'] .'|';
				$atts['button_url'] = $url;
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
			// Strings
			$s_yes = esc_html__( 'Yes', 'total' );
			$s_no  = esc_html__( 'No', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Pricing Table', 'total' ),
				'description' => esc_html__( 'Insert a pricing column', 'total' ),
				'base' => 'vcex_pricing',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-pricing vcex-icon fa fa-usd',
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
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Animation', 'total'),
						'param_name' => 'hover_animation',
						'value' => array_flip( wpex_hover_css_animations() ),
					),
					// Plan
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Featured', 'total' ),
						'param_name' => 'featured',
						'value' => array(
							$s_no => 'no',
							$s_yes => 'yes',
						),
						'group' => esc_html__( 'Plan', 'total' ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Plan', 'total' ),
						'param_name' => 'plan',
						'group' => esc_html__( 'Plan', 'total' ),
						'std' => esc_html__( 'Basic', 'total' ),
						'admin_label' => true,
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'plan_background',
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'plan_color',
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'plan_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'plan_text_transform',
						'std' => '',
						'value' => array_flip( wpex_text_transforms() ),
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'plan_size',
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'plan_letter_spacing',
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
						'description' => esc_html__( 'Please enter a px value.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'plan_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'plan_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border', 'total' ),
						'param_name' => 'plan_border',
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'group' => esc_html__( 'Plan', 'total' ),
						'dependency' => array( 'element' => 'plan', 'not_empty' => true ),
					),
					// Cost
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Cost', 'total' ),
						'param_name' => 'cost',
						'group' => esc_html__( 'Cost', 'total' ),
						'std' => '$20',
						'admin_label' => true,
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'cost_background',
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'cost_color',
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'cost_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'cost_size',
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'cost_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border', 'total' ),
						'param_name' => 'cost_border',
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'group' => esc_html__( 'Cost', 'total' ),
						'dependency' => array( 'element' => 'cost', 'not_empty' => true ),
					),
					// Per
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per', 'total' ),
						'param_name' => 'per',
						'group' => esc_html__( 'Per', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display', 'total' ),
						'param_name' => 'per_display',
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'Inline', 'total' ) => 'inline',
							__( 'Block', 'total' ) => 'block',
							__( 'Inline-Block', 'total' ) => 'inline-block',
						),
						'group' => esc_html__( 'Per', 'total' ),
						'dependency' => array(
							'element' => 'per',
							'not_empty' => true,
						),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'per_color',
						'group' => esc_html__( 'Per', 'total' ),
						'dependency' => array(
							'element' => 'per',
							'not_empty' => true,
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'per_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Per', 'total' ),
						'dependency' => array(
							'element' => 'per',
							'not_empty' => true,
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'per_transform',
						'group' => esc_html__( 'Per', 'total' ),
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array(
							'element' => 'per',
							'not_empty' => true,
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'per_size',
						'group' => esc_html__( 'Per', 'total' ),
						'dependency' => array(
							'element' => 'per',
							'not_empty' => true,
						),
					),
					// Features
					array(
						'type' => 'textarea_html',
						'heading' => esc_html__( 'Features', 'total' ),
						'param_name' => 'content',
						'value' => '<ul>
												<li>30GB Storage</li>
												<li>512MB Ram</li>
												<li>10 databases</li>
												<li>1,000 Emails</li>
												<li>25GB Bandwidth</li>
											</ul>',
						'description' => esc_html__('Enter your pricing content. You can use a UL list as shown by default but anything would really work!','total'),
						'group' => esc_html__( 'Features', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'font_color',
						'group' => esc_html__( 'Features', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'features_bg',
						'group' => esc_html__( 'Features', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' => esc_html__( 'Features', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'features_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Features', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border', 'total' ),
						'param_name' => 'features_border',
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'group' => esc_html__( 'Features', 'total' ),
					),
					// Button
					array(
						'type' => 'textarea_raw_html',
						'heading' => esc_html__( 'Custom Button HTML', 'total' ),
						'param_name' => 'custom_button',
						'description' => esc_html__( 'Enter your custom button HTML, such as your paypal button code.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'URL', 'total' ),
						'param_name' => 'button_url',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Local Scroll?', 'total' ),
						'param_name' => 'button_local_scroll',
						'group' => esc_html__( 'Button', 'total' ),
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text', 'total' ),
						'param_name' => 'button_text',
						'value' => esc_html__( 'Text', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Area Background', 'total' ),
						'param_name' => 'button_wrap_bg',
						'group' => esc_html__( 'Button', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Area Padding', 'total' ),
						'param_name' => 'button_wrap_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Area Border', 'total' ),
						'param_name' => 'button_wrap_border',
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'button_style',
						'value' => array_flip( wpex_button_styles() ),
						'group' => esc_html__( 'Button', 'total' ),
							'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'button_style_color',
						'value' => array_flip( wpex_button_colors() ),
						'group' => esc_html__( 'Button', 'total' ),
							'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'button_bg_color',
						'group' => esc_html__( 'Button', 'total' ),
							'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background: Hover', 'total' ),
						'param_name' => 'button_hover_bg_color',
						'group' => esc_html__( 'Button', 'total' ),
							'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'button_color',
						'group' => esc_html__( 'Button', 'total' ),
							'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color: Hover', 'total' ),
						'param_name' => 'button_hover_color',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'button_size',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'button_border_radius',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'button_letter_spacing',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'button_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'button_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'button_transform',
						'group' => esc_html__( 'Button', 'total' ),
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					//Icons
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon library', 'total' ),
						'param_name' => 'icon_type',
						'description' => esc_html__( 'Select icon library.', 'total' ),
						'std' => 'fontawesome',
						'value' => array(
							__( 'Font Awesome', 'total' ) => 'fontawesome',
							__( 'Open Iconic', 'total' ) => 'openiconic',
							__( 'Typicons', 'total' ) => 'typicons',
							__( 'Entypo', 'total' ) => 'entypo',
							__( 'Linecons', 'total' ) => 'linecons',
							__( 'Pixel', 'total' ) => 'pixelicons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
						'dependency' => array( 'element' => 'custom_button', 'is_empty' => true ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left',
						'admin_label' => true,
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'openiconic',
							'iconsPerPage' => 200,
						),
						'dependency' => array( 'element' => 'icon_type', 'value' => 'openiconic' ),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'typicons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left_entypo',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'linecons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'button_icon_left_pixelicons',
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right',
						'admin_label' => true,
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'openiconic',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'openiconic',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'typicons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right_entypo',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'linecons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'button_icon_right_pixelicons',
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Button Icons', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Pricing_Shortcode;