<?php
/**
 * Registers the testimonials slider shortcode and adds it to the Visual Composer
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.3
 */

if ( ! class_exists( 'VCEX_Testimonials_Slider_Shortcode' ) ) {

	class VCEX_Testimonials_Slider_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_testimonials_slider', array( 'VCEX_Testimonials_Slider_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_testimonials_slider', array( 'VCEX_Testimonials_Slider_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Alter fields on edit
				add_filter( 'vc_edit_form_fields_attributes_vcex_testimonials_slider', array( 'VCEX_Testimonials_Slider_Shortcode', 'edit_form_fields' ) );

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_testimonials_slider_include_categories_callback', 'vcex_suggest_testimonials_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_testimonials_slider_exclude_categories_callback', 'vcex_suggest_testimonials_categories', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_testimonials_slider_include_categories_render', 'vcex_render_testimonials_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_testimonials_slider_exclude_categories_render', 'vcex_render_testimonials_categories', 10, 1 );

			}

		}

		/**
		 * Parse old shortcode attributes
		 *
		 * @since 2.0.0
		 */
		public static function edit_form_fields( $atts ) {
			if ( ! empty( $atts['animation'] ) && 'fade' == $atts['animation'] ) {
				$atts['animation'] = 'fade_slides';
			}
			return $atts;
		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_testimonials_slider.php' ) );
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
			$s_no  = esc_html__( 'No', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Testimonials Slider', 'total' ),
				'description' => esc_html__( 'Recent testimonials slider', 'total' ),
				'base' => 'vcex_testimonials_slider',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-testimonials-slider vcex-icon fa fa-comments-o',
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Classes', 'total' ),
						'param_name' => 'classes',
						'admin_label' => true,
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
						'heading' => esc_html__( 'Author', 'total' ),
						'param_name' => 'display_author_name',
						'value' => array( $s_yes => 'yes', $s_no => 'no' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Company', 'total' ),
						'param_name' => 'display_author_company',
						'value' => array( $s_no  => 'no', $s_yes => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Rating', 'total' ),
						'param_name' => 'rating',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
					),
					// Slider Settings
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation', 'total' ),
						'param_name' => 'animation',
						'std' => 'fade_slides',
						'value' => array(
							__( 'Fade', 'total' ) => 'fade_slides',
							__( 'Slide', 'total' ) => 'slide',
						),
						'group' => esc_html__( 'Slider Settings', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Loop', 'total' ),
						'param_name' => 'loop',
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'group' => esc_html__( 'Slider Settings', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Height Animation', 'total' ),
						'std' => 400,
						'param_name' => 'height_animation',
						'group' => esc_html__( 'Slider Settings', 'total' ),
						'description' => esc_html__( 'You can enter "0.0" to disable the animation completely.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Speed', 'total' ),
						'param_name' => 'animation_speed',
						'std' => 600,
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
						'group' => esc_html__( 'Slider Settings', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Auto Play', 'total' ),
						'param_name' => 'slideshow',
						'description' => esc_html__( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'total' ),
						'group' => esc_html__( 'Slider Settings', 'total' ),
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Play Delay', 'total' ),
						'param_name' => 'slideshow_speed',
						'std' => 5000,
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
						'group' => esc_html__( 'Slider Settings', 'total' ),
						'dependency' => array( 'element' => 'slideshow', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Dot Navigation', 'total' ),
						'param_name' => 'control_nav',
						'group' => esc_html__( 'Slider Settings', 'total' ),
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows', 'total' ),
						'param_name' => 'direction_nav',
						'group' => esc_html__( 'Slider Settings', 'total' ),
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts Count', 'total' ),
						'param_name' => 'count',
						'value' => 3,
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Include Categories', 'total' ),
						'param_name' => 'include_categories',
						'param_holder_class' => 'vc_not-for-custom',
						'admin_label' => true,
						'settings' => array(
							'multiple' => true,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Exclude Categories', 'total' ),
						'param_name' => 'exclude_categories',
						'param_holder_class' => 'vc_not-for-custom',
						'admin_label' => true,
						'settings' => array(
							'multiple' => true,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'total' ),
						'param_name' => 'order',
						'group' => esc_html__( 'Query', 'total' ),
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'DESC', 'total' ) => 'DESC',
							__( 'ASC', 'total' ) => 'ASC',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order By', 'total' ),
						'param_name' => 'orderby',
						'value' => vcex_orderby_array(),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Orderby: Meta Key', 'total' ),
						'param_name' => 'orderby_meta_key',
						'group' => esc_html__( 'Query', 'total' ),
						'dependency' => array(
							'element' => 'orderby',
							'value' => array( 'meta_value_num', 'meta_value' ),
						),
					),
					// Image
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Enable', 'total' ),
						'param_name' => 'display_author_avatar',
						'group' => esc_html__( 'Image', 'total' ),
						'value' => array(
							$s_yes => 'yes',
							$s_no => 'no',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'img_border_radius',
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'display_author_avatar', 'value' => 'yes' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
						'std' => 'wpex_custom',
						'value' => vcex_image_sizes(),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'display_author_avatar', 'value' => 'yes' ),
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
						'heading' => esc_html__( 'Image Crop Width', 'total' ),
						'param_name' => 'img_width',
						'description' => esc_html__( 'Enter a width in pixels.', 'total' ),
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
					// Thumbnails
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnails', 'total' ),
						'param_name' => 'control_thumbs',
						'group' => esc_html__( 'Thumbnails', 'total' ),
						'value' => array(
							$s_no => 'no',
							$s_yes => 'true'
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Height', 'total' ),
						'param_name' => 'control_thumbs_height',
						'std' => 50,
						'group' => esc_html__( 'Thumbnails', 'total' ),
						'dependency' => array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Width', 'total' ),
						'param_name' => 'control_thumbs_width',
						'std' => 50,
						'group' => esc_html__( 'Thumbnails', 'total' ),
						'dependency' => array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					// Excerpts
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Excerpt', 'total' ),
						'param_name' => 'excerpt',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'value' => array(
							$s_no => 'no',
							$s_yes => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Excerpt Length', 'total' ),
						'param_name' => 'excerpt_length',
						'value' => 20,
						'description' => esc_html__( 'Enter a custom excerpt length. Will trim the excerpt by this number of words. Enter "-1" to display the_content instead of the auto excerpt.', 'total' ),
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Read More', 'total' ),
						'param_name' => 'read_more',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Read More Text', 'total' ),
						'param_name' => 'read_more_text',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'value' => esc_html__( 'read more', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					// CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Skin', 'total' ),
						'param_name' => 'skin',
						'group' => esc_html__( 'Design', 'total' ),
						'value' => array(
							__( 'Dark Text', 'total' ) => 'dark',
							__( 'Light Text', 'total' ) => 'light',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'font_weight',
						'group' => esc_html__( 'Design', 'total' ),
						'description' => esc_html__( 'Note: Not all font families support every font weight.', 'total' ),
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
					),

				),
			);
		}

	}
}
new VCEX_Testimonials_Slider_Shortcode;