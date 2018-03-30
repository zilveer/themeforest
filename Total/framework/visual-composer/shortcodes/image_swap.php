<?php
/**
 * Registers the image swap shortcode and adds it to the Visual Composer
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Image_Swap_Shortcode' ) ) {

	class VCEX_Image_Swap_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_image_swap', array( 'VCEX_Image_Swap_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_image_swap', array( 'VCEX_Image_Swap_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_image_swap.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Image Swap', 'total' ),
				'description' => esc_html__( 'Double Image Hover Effect', 'total' ),
				'base' => 'vcex_image_swap',
				'icon' => 'vcex-image-swap vcex-icon fa fa-picture-o',
				'category' => wpex_get_theme_branding(),
				'params' => array(
					// General
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Primary Image', 'total' ),
						'param_name' => 'primary_image',
						'admin_label' => true,
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Secondary Image', 'total' ),
						'param_name' => 'secondary_image',
						'admin_label' => true,
					),
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
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					// Image
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
						'std' => 'wpex_custom',
						'value' => vcex_image_sizes(),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Crop Location', 'total' ),
						'param_name' => 'img_crop',
						'std' => 'center-center',
						'value' => array_flip( wpex_image_crop_locations() ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Width', 'total' ),
						'param_name' => 'img_width',
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Height', 'total' ),
						'param_name' => 'img_height',
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
					),
					// Link
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'Link', 'total' ),
						'param_name' => 'link',
						'group' => esc_html__( 'Link', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Enable Tooltip?', 'total' ),
						'param_name' => 'link_tooltip',
						'value' => array(
							__( 'No', 'total' ) => '',
							__( 'Yes', 'total' ) => 'true'
						),
						'group' => esc_html__( 'Link', 'total' ),
					),
					// Design Options
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'description' => esc_html__( 'These settings are applied to the main wrapper and they will override any other styling options.', 'total' ),
						'group' => esc_html__( 'Design options', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Container Width', 'total' ),
						'param_name' => 'container_width',
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'border_radius',
						'group' => esc_html__( 'Image', 'total' ),
					),
					// Hidden
					array(
						'type' => 'hidden',
						'param_name' => 'link_title',
					),
					array(
						'type' => 'hidden',
						'param_name' => 'link_target',
					),
				)
			);
		}

	}
}
new VCEX_Image_Swap_Shortcode;