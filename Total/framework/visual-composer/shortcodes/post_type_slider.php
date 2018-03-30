<?php
/**
 * Visual Composer Post Type Slider
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Post_Type_Flexslider_Shortcode' ) ) {

	class VCEX_Post_Type_Flexslider_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_post_type_flexslider', array( 'VCEX_Post_Type_Flexslider_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_post_type_flexslider', array( 'VCEX_Post_Type_Flexslider_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_tax_query_taxonomy_callback', 'vcex_suggest_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_tax_query_terms_callback', 'vcex_suggest_terms', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_author_in_callback', 'vcex_suggest_users', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_tax_query_taxonomy_render', 'vcex_render_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_tax_query_terms_render', 'vcex_render_terms', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_flexslider_author_in_render', 'vcex_render_users', 10, 1 );
				
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_post_type_flexslider.php' ) );
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
				'name' => esc_html__( 'Post Types Slider', 'total' ),
				'description' => esc_html__( 'Posts slider', 'total' ),
				'base' => 'vcex_post_type_flexslider',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-post-type-slider vcex-icon fa fa-files-o',
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
					// Slider Settings
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Randomize', 'total' ),
						'param_name' => 'randomize',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation', 'total' ),
						'param_name' => 'animation',
						'value' => array(
							__( 'Fade', 'total' ) => 'fade_slides',
							__( 'Slide', 'total' ) => 'slide',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Loop', 'total' ),
						'param_name' => 'loop',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Height Animation', 'total' ),
						'std' => '500',
						'param_name' => 'height_animation',
						'description' => esc_html__( 'You can enter "0.0" to disable the animation completely.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Speed', 'total' ),
						'param_name' => 'animation_speed',
						'std' => '600',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Auto Play', 'total' ),
						'param_name' => 'slideshow',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'description' => esc_html__( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Play Delay', 'total' ),
						'param_name' => 'slideshow_speed',
						'std' => '5000',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
						'dependency' => Array( 'element' => 'slideshow', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows', 'total' ),
						'param_name' => 'direction_nav',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows on Hover', 'total' ),
						'param_name' => 'direction_nav_hover',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'dependency' => Array( 'element' => 'arrows', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Dot Navigation', 'total' ),
						'param_name' => 'control_nav',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnails', 'total' ),
						'param_name' => 'control_thumbs',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnails Pointer', 'total' ),
						'param_name' => 'control_thumbs_pointer',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'dependency' => Array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Height', 'total' ),
						'param_name' => 'control_thumbs_height',
						'std' => '70',
						'dependency' => Array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Width', 'total' ),
						'param_name' => 'control_thumbs_width',
						'std' => '70',
						'dependency' => Array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Count', 'total' ),
						'param_name' => 'posts_per_page',
						'value' => '4',
						'description' => esc_html__( 'You can enter "-1" to display all posts.', 'total' ),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'posttypes',
						'heading' => esc_html__( 'Post types', 'total' ),
						'param_name' => 'post_types',
						'group' => esc_html__( 'Query', 'total' ),
						'std' => 'post',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Limit By Post ID\'s', 'total' ),
						'param_name' => 'posts_in',
						'group' => esc_html__( 'Query', 'total' ),
						'description' => esc_html__( 'Seperate by a comma.', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Limit By Author', 'total' ),
						'param_name' => 'author_in',
						'settings' => array(
							'multiple' => true,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
							//'values' => vcex_get_users(),
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Query by Taxonomy', 'total' ),
						'param_name' => 'tax_query',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Taxonomy Name', 'total' ),
						'param_name' => 'tax_query_taxonomy',
						'dependency' => array( 'element' => 'tax_query', 'value' => 'true' ),
						'settings' => array(
							'multiple' => false,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 500,
							'auto_focus' => true,
							//'values' => vcex_get_taxonomies(),
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Terms', 'total' ),
						'param_name' => 'tax_query_terms',
						'dependency' => array( 'element' => 'tax_query', 'value' => 'true' ),
						'settings' => array(
							'multiple' => true,
							'min_length' => 1,
							'groups' => true,
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
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Height', 'total' ),
						'param_name' => 'img_height',
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => esc_html__( 'Image', 'total' )
					),
					// Caption
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Caption', 'total' ),
						'param_name' => 'caption',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Caption Visibility', 'total' ),
						'param_name' => 'caption_visibility',
						'value' => array_flip( wpex_visibility() ),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Caption Location', 'total' ),
						'param_name' => 'caption_location',
						'value' => array(
							__( 'Over Image', 'total' ) => 'over-image',
							__( 'Under Image', 'total' ) => 'under-image',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Title', 'total' ),
						'param_name' => 'title',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Meta', 'total' ),
						'param_name' => 'meta',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Excerpt', 'total' ),
						'param_name' => 'excerpt',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Excerpt Length', 'total' ),
						'param_name' => 'excerpt_length',
						'value' => '40',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					// Design
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'Design', 'total' ),
					),

				),
				
			);
		}

	}
}
new VCEX_Post_Type_Flexslider_Shortcode;