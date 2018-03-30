<?php
/**
 * Visual Composer Social Links
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Social_Links_Shortcode' ) ) {

	class VCEX_Social_Links_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_social_links', array( 'VCEX_Social_Links_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_social_links', array( 'VCEX_Social_Links_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {
				add_filter( 'vc_edit_form_fields_attributes_vcex_social_links', array( 'VCEX_Social_Links_Shortcode', 'edit_form_fields' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_social_links.php' ) );
			return ob_get_clean();
		}

		/**
		 * Parse attributes on edit
		 *
		 * @since 3.5.0
		 */
		public static function edit_form_fields( $atts ) {

			// Get array of social links to loop through
			$social_profiles = vcex_social_links_profiles();

			// Social links list required
			if ( empty( $social_profiles ) )  {
				return $atts;
			}

			// Loop through old options and move to new ones + delete old settings?
			if ( empty( $atts['social_links'] ) ) {
				$social_links = array();
				foreach ( $social_profiles  as $key => $val ) {
					if ( ! empty( $atts[$key] ) ) {
						$social_links[] = array(
							'site' => $key,
							'link' => $atts[$key],
						);
					}
					unset( $atts[$key] );
				}
				if ( $social_links ) {
					$atts['social_links'] = urlencode( json_encode( $social_links ) );
				}
			}

			// Return attributes
			return $atts;
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			// Get array of social links to loop through
			$social_links = vcex_social_links_profiles();
			// Social links list required
			if ( empty( $social_links ) )  {
				return;
			}
			// Create dropdown of social sites
			$social_link_select = array();
			foreach ( $social_links as $key => $val ) {
				$social_link_select[$val['label']] = $key;
			}
			// Return array
			return array(
				'name' => esc_html__( 'Social Links', 'total' ),
				'description' => esc_html__( 'Display social links using icon fonts', 'total' ),
				'base' => 'vcex_social_links',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-social-links vcex-icon fa fa-user-plus',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
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
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Target', 'total'),
						'param_name' => 'link_target',
						'value' => array(
							__( 'Self', 'total' ) => '',
							__( 'Blank', 'total' ) => 'blank',
						),
					),
					// Social Links
					array(
						'type' => 'param_group',
						'param_name' => 'social_links',
						'group' => esc_html__( 'Profiles', 'total' ),
						'value' => urlencode( json_encode( array( ) ) ),
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Site', 'total' ),
								'param_name' => 'site',
								'admin_label' => true,
								'value' => $social_link_select,
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Link', 'total' ),
								'param_name' => 'link',
							),
						),
					),
					// Style
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total'),
						'param_name' => 'style',
						'value' => array_flip( wpex_social_button_styles() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Align', 'total' ),
						'param_name' => 'align',
						'value' => array_flip( wpex_alignments() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'size',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'total' ),
						'param_name' => 'width',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Height', 'total' ),
						'param_name' => 'height',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'border_radius',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
						'group' => esc_html__( 'Design', 'total' ),
						'dependency' => array( 'element' => 'style', 'value' => array( 'none', '' ) ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Background', 'total' ),
						'param_name' => 'hover_bg',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Color', 'total' ),
						'param_name' => 'hover_color',
						'group' => esc_html__( 'Design', 'total' ),
					),
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
new VCEX_Social_Links_Shortcode;