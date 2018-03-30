<?php
/**
 * Visual Composer WooCommerce Carousel
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
* @version 3.5.3
 */

if ( ! class_exists( 'VCEX_Woocommerce_Carousel_Shortcode' ) ) {

	class VCEX_Woocommerce_Carousel_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_woocommerce_carousel', array( 'VCEX_Woocommerce_Carousel_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_woocommerce_carousel', array( 'VCEX_Woocommerce_Carousel_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_woocommerce_carousel_include_categories_callback', 'vcex_suggest_product_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_woocommerce_carousel_exclude_categories_callback', 'vcex_suggest_product_categories', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_woocommerce_carousel_include_categories_render', 'vcex_render_product_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_woocommerce_carousel_exclude_categories_render', 'vcex_render_product_categories', 10, 1 );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_woocommerce_carousel.php' ) );
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
				'name' => esc_html__( 'WooCommerce Carousel', 'total' ),
				'description' => esc_html__( 'Recent woocommerce posts carousel', 'total' ),
				'base' => 'vcex_woocommerce_carousel',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-woocommerce-carousel vcex-icon fa fa-shopping-cart',
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'description' => esc_html__( 'Give your main element a unique ID.', 'total' ),
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
						'heading' => esc_html__( 'Arrows?', 'total' ),
						'param_name' => 'arrows',
						'value' => array(
							__( 'True', 'total' ) => 'true',
							__( 'False', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows Style', 'total' ),
						'param_name' => 'arrows_style',
						'value' => array_flip( wpex_carousel_arrow_styles() ),
						'dependency' => array( 'element' => 'arrows', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows Position', 'total' ),
						'param_name' => 'arrows_position',
						'value' => array_flip( wpex_carousel_arrow_positions() ),
						'dependency' => array( 'element' => 'arrows', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Dots?', 'total' ),
						'param_name' => 'dots',
						'value' => array(
							__( 'False', 'total' ) => 'false',
							__( 'True', 'total' ) => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Items To Display', 'total' ),
						'param_name' => 'items',
						'value' => '4',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Items To Scrollby', 'total' ),
						'param_name' => 'items_scroll',
						'value' => '1',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin Between Items', 'total' ),
						'param_name' => 'items_margin',
						'value' => '15',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Auto Play', 'total' ),
						'param_name' => 'auto_play',
						'value' => array(
							__( 'True', 'total' ) => 'true',
							__( 'False', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout Duration in milliseconds', 'total' ),
						'param_name' => 'timeout_duration',
						'value' => '5000',
						'dependency' => array( 'element' => 'auto_play', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Infinite Loop', 'total' ),
						'param_name' => 'infinite_loop',
						'value' => array(
							__( 'True', 'total' ) => 'true',
							__( 'False', 'total' ) => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Center Item', 'total' ),
						'param_name' => 'center',
						'value' => array(
							__( 'False', 'total' ) => 'false',
							__( 'True', 'total' ) => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Speed', 'total' ),
						'param_name' => 'animation_speed',
						'value' => '150',
						'description' => esc_html__( 'Default is 150 milliseconds. Enter 0.0 to disable.', 'total' ),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'total' ),
						'param_name' => 'count',
						'value' => '8',
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Featured Products Only', 'total' ),
						'param_name' => 'featured_products_only',
						'group' => esc_html__( 'Query', 'total' ),
						'value' => array(
							__( 'False', 'total' ) => '',
							__( 'True', 'total' ) => true,
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Exclude Out of Stock Products', 'total' ),
						'param_name' => 'exclude_products_out_of_stock',
						'group' => esc_html__( 'Query', 'total' ),
						'value' => array(
							__( 'False', 'total' ) => '',
							__( 'True', 'total' ) => true,
						),
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
							'groups' => true,
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
						'heading' => esc_html__( 'Image Links To', 'total' ),
						'param_name' => 'thumbnail_link',
						'value' => array(
							__( 'Default', 'total') => '',
							__( 'Post', 'total') => 'post',
							__( 'Lightbox', 'total' ) => 'lightbox',
							__( 'None', 'total' ) => 'none',
						),
						'group' => esc_html__( 'Image', 'total' ),
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
						'dependency' => array(
							'element' => 'img_size',
							'value' => 'wpex_custom',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Width', 'total' ),
						'param_name' => 'img_width',
						'description' => esc_html__( 'Enter a width in pixels.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array(
							'element' => 'img_size',
							'value' => 'wpex_custom',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Height', 'total' ),
						'param_name' => 'img_height',
						'dependency' => array(
							'element' => 'img_size',
							'value' => 'wpex_custom',
						),
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Filter', 'total' ),
						'param_name' => 'img_filter',
						'value' => array_flip( wpex_image_filters() ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'CSS3 Image Hover', 'total' ),
						'param_name' => 'img_hover_style',
						'value' => array_flip( wpex_image_hovers() ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					// Title
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Title', 'total' ),
						'param_name' => 'title',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_heading_color',
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_heading_size',
						'description' => esc_html__( 'You can use em or px values, but you must define them.', 'total' ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'content_heading_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'content_heading_line_height',
						'description' => esc_html__( 'Enter a numerical, pixel or percentage value.', 'total' ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'content_heading_weight',
						'description' => esc_html__( 'Note: Not all font families support every font weight.', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'content_heading_transform',
						'value' => array_flip( wpex_text_transforms() ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					// Price
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Price', 'total' ),
						'param_name' => 'price',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Price', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_color',
						'group' => esc_html__( 'Price', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_font_size',
						'group' => esc_html__( 'Price', 'total' ),
						'description' => esc_html__( 'You can use em or px values, but you must define them.', 'total' ),
					),
					// Design
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => array(
							__( 'Default', 'total') => 'default',
							__( 'No Margins', 'total' ) => 'no-margins',
						),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Content Background', 'total' ),
						'param_name' => 'content_background',
						'group' => esc_html__( 'Design', 'total' ),
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Content Alignment', 'total' ),
						'param_name' => 'content_alignment',
						'value' => array_flip( wpex_alignments() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Margin', 'total' ),
						'param_name' => 'content_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Padding', 'total' ),
						'param_name' => 'content_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Border', 'total' ),
						'param_name' => 'content_border',
						'description' => esc_html__( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					// Responsive
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Tablet: Items To Display', 'total' ),
						'param_name' => 'tablet_items',
						'value' => '3',
						'group' => esc_html__( 'Mobile', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Mobile Landscape: Items To Display', 'total' ),
						'param_name' => 'mobile_landscape_items',
						'value' => '2',
						 'group' => esc_html__( 'Mobile', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Mobile Portrait: Items To Display', 'total' ),
						'param_name' => 'mobile_portrait_items',
						'value' => '1',
						 'group' => esc_html__( 'Mobile', 'total' ),
					),
					// HIDDEN
					array(
						'type' => 'hidden',
						'param_name' => 'entry_output',
					),
				),
			);
		}

	}
}
new VCEX_Woocommerce_Carousel_Shortcode;