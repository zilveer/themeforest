<?php
/**
 * Visual Composer Feature Box
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Feature_Box_Shortcode' ) ) {

	class VCEX_Feature_Box_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_feature_box', array( 'VCEX_Feature_Box_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_feature_box', array( 'VCEX_Feature_Box_Shortcode', 'map' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_feature_box.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Feature Box', 'total' ),
				'description' => esc_html__( 'A feature content box', 'total' ),
				'base' => 'vcex_feature_box',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-feature-box vcex-icon fa fa-trophy',
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
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => array(
							__( 'Left Content - Right Image', 'total' ) => 'left-content-right-image',
							__( 'Left Image - Right Content', 'total' ) => 'left-image-right-content',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Alignment', 'total' ),
						'param_name' => 'text_align',
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'Center', 'total' ) => 'center',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border', 'total' ),
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'param_name' => 'border',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'background',
					),
					// Heading
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Heading', 'total' ),
						'param_name' => 'heading',
						'value' => 'Sample Heading',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'HTML Tag', 'total' ),
						'param_name' => 'heading_type',
						'group' => esc_html__( 'Heading', 'total' ),
						'value' => array(
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							__( 'h5', 'total' ) => 'h5',
							'div' => 'div',
						),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'Link', 'total' ),
						'param_name' => 'heading_url',
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type'  => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'heading_font_family',
						'value' => '',
						'group' => esc_html__( 'Heading', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Heading Color', 'total' ),
						'param_name' => 'heading_color',
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'heading_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Heading Text Transform', 'total' ),
						'param_name' => 'heading_transform',
						'group' => esc_html__( 'Heading', 'total' ),
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'heading_size',
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'heading_letter_spacing',
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'heading_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Heading', 'total' ),
						'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					),
					// Content
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'heading' => esc_html__( 'Content', 'total' ),
						'param_name' => 'content',
						'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						'group' => esc_html__( 'Content', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'content_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Content', 'total' ),
						'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_font_size',
						'group' => esc_html__( 'Content', 'total' ),
						'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'content_font_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Content', 'total' ),
						'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'content_background',
						'group' => esc_html__( 'Content', 'total' ),
						'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_color',
						'group' => esc_html__( 'Content', 'total' ),
						'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					),
					// Image
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Image', 'total' ),
						'param_name' => 'image',
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Equal Heights?', 'total' ),
						'param_name' => 'equal_heights',
						'value' => array(
							__( 'No', 'total' ) => 'false',
							__( 'Yes', 'total' ) => 'true',
						),
						'description' => esc_html__( 'Keeps the image column the same height as your content.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__( 'Image URL', 'total' ),
						'param_name' => 'image_url',
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Type', 'total' ),
						'param_name' => 'image_lightbox',
						'group' => esc_html__( 'Image', 'total' ),
						'value' => array(
							__( 'None', 'total' ) => '',
							__( 'Self', 'total' ) => 'image',
							__( 'URL', 'total' ) => 'url',
							__( 'Auto Detect - slow', 'total' ) => 'auto-detect',
							__( 'Video', 'total' ) => 'video_embed',
							__( 'HTML5', 'total' ) => 'html5',
							__( 'Quicktime', 'total' ) => 'quicktime',
						),
					),
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
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Width', 'total' ),
						'param_name' => 'img_width',
						'description' => esc_html__( 'Enter a width in pixels.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Height', 'total' ),
						'param_name' => 'img_height',
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'img_border_radius',
						'description' => esc_html__( 'Please enter a px value.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'equal_heights', 'value' => 'false' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'CSS3 Image Hover', 'total' ),
						'param_name' => 'img_hover_style',
						'value' => array_flip( wpex_image_hovers() ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Filter', 'total' ),
						'param_name' => 'img_filter',
						'value' => array_flip( wpex_image_filters() ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					// Video
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Video link', 'total' ),
						'param_name' => 'video',
						'description' => esc_html__('Enter a URL that is compatible with WP\'s built-in oEmbed feature. ', 'total' ),
						'group' => esc_html__( 'Video', 'total' ),
					),
					// Widths
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Width', 'total' ),
						'param_name' => 'content_width',
						'value' => '50%',
						'group' => esc_html__( 'Widths', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Width', 'total' ),
						'param_name' => 'media_width',
						'value' => '50%',
						'group' => esc_html__( 'Widths', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Tablet Widths', 'total' ),
						'param_name' => 'tablet_widths',
						'group' => esc_html__( 'Widths', 'total' ),
						'value' => array(
							esc_html__( 'Inherit', 'total' ) => '',
							esc_html__( 'Full-Width', 'total' ) => 'fullwidth',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Phone Widths', 'total' ),
						'param_name' => 'phone_widths',
						'group' => esc_html__( 'Widths', 'total' ),
						'value' => array(
							esc_html__( 'Inherit', 'total' ) => '',
							esc_html__( 'Full-Width', 'total' ) => 'fullwidth',
						),
					),

				)
			);
		}

	}

}
new VCEX_Feature_Box_Shortcode;