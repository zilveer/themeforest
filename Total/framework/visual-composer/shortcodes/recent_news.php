<?php
/**
 * Visual Composer Recent News
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Recent_News_Shortcode' ) ) {

	class VCEX_Recent_News_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_recent_news', array( 'VCEX_Recent_News_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_recent_news', array( 'VCEX_Recent_News_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_recent_news_include_categories_callback', 'vcex_suggest_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_recent_news_exclude_categories_callback', 'vcex_suggest_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_recent_news_author_in_callback', 'vcex_suggest_users', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_recent_news_include_categories_render', 'vcex_render_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_recent_news_exclude_categories_render', 'vcex_render_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_recent_news_author_in_render', 'vcex_render_users', 10, 1 );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_recent_news.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			// Strings
			$s_enable = esc_html__( 'Enable', 'total' );
			$s_yes    = esc_html__( 'Yes', 'total' );
			$s_no     = esc_html__( 'No', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Recent News', 'total' ),
				'description' => esc_html__( 'Recent blog posts', 'total' ),
				'base' => 'vcex_recent_news',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-recent-news vcex-icon fa fa-newspaper-o',
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
						'param_name' => 'classes',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Heading', 'total' ),
						'param_name' => 'header',
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
						'heading' => esc_html__( 'Columns', 'total' ),
						'param_name' => 'grid_columns',
						'std' => '1',
						'value' => array_flip( wpex_grid_columns() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Gap', 'total' ),
						'param_name' => 'columns_gap',
						'value' => array_flip( wpex_column_gaps() ),
						'dependency' => array( 'element' => 'grid_columns', 'value' => array( '2', '3', '4', '5', '6', '7', '8', '9', '10' ) ),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'total' ),
						'param_name' => 'count',
						'value' => '3',
						'description' => esc_html__( 'How many posts do you wish to show.', 'total' ),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'total' ),
						'param_name' => 'pagination',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Offset', 'total' ),
						'param_name' => 'offset',
						'group' => esc_html__( 'Query', 'total' ),
						'description' => esc_html__( 'Number of post to displace or pass over. Warning: Setting the offset parameter overrides/ignores the paged parameter and breaks pagination. The offset parameter is ignored when posts per page is set to -1.', 'total' ),
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
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Get Posts From', 'total' ),
						'param_name' => 'get_posts',
						'group' => esc_html__( 'Query', 'total' ),
						'std' => 'standard_post_types',
						'value' => array(
							__( 'Standard Posts','total' ) => 'standard_post_types',
							__( 'Custom Post types','total' ) => 'custom_post_types',
						),
					),
					array(
						'type' => 'posttypes',
						'heading' => esc_html__( 'Post types', 'total' ),
						'param_name' => 'post_types',
						'std' => 'post',
						'group' => esc_html__( 'Query', 'total' ),
						'dependency' => array( 'element' => 'get_posts', 'value' => 'custom_post_types' ),
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
						'dependency' => array( 'element' => 'get_posts', 'value' => 'standard_post_types' ),
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
						'dependency' => array(
							'element' => 'get_posts',
							'value' => 'standard_post_types'
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
						'type' => 'dropdown',
						'heading' => esc_html__( 'Ignore Sticky Posts', 'total' ),
						'param_name' => 'ignore_sticky_posts',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Orderby: Meta Key', 'total' ),
						'param_name' => 'orderby_meta_key',
						'group' => esc_html__( 'Query', 'total' ),
						'dependency' => array( 'element' => 'orderby', 'value' => array( 'meta_value_num', 'meta_value' ) ),
					),
					// Media
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Featured Media?', 'total' ),
						'param_name' => 'featured_image',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Media', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Featured Videos?', 'total' ),
						'param_name' => 'featured_video',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'featured_image', 'value' => array( 'true' ) ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
						'std' => 'wpex_custom',
						'value' => vcex_image_sizes(),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'featured_image', 'value' => array( 'true' ) ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Crop Location', 'total' ),
						'param_name' => 'img_crop',
						'std' => 'center-center',
						'value' => array_flip( wpex_image_crop_locations() ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => esc_html__( 'Media', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Width', 'total' ),
						'param_name' => 'img_width',
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => esc_html__( 'Media', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Height', 'total' ),
						'param_name' => 'img_height',
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'group' => esc_html__( 'Media', 'total' ),
					),
					// Title
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'title',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'HTML Tag', 'total' ),
						'param_name' => 'title_tag',
						'value' => array(
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
							'div' => 'div',
						),
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'title_weight',
						'group' => esc_html__( 'Title', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'title_transform',
						'group' => esc_html__( 'Title', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'title_size',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'title_line_height',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'title_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'title_color',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					// Date
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'date',
						'value' => array(
							__( 'True','total' ) => 'true',
							__( 'False','total' ) => 'false',
						),
						'group' => esc_html__( 'Date', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Month Background', 'total' ),
						'param_name' => 'month_background',
						'group' => esc_html__( 'Date', 'total' ),
						'dependency' => array( 'element' => 'date', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Month Color', 'total' ),
						'param_name' => 'month_color',
						'group' => esc_html__( 'Date', 'total' ),
						'dependency' => array( 'element' => 'date', 'value' => 'true' ),
					),
					// Excerpt
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Excerpt', 'total' ),
						'param_name' => 'excerpt',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Excerpt', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Length', 'total' ),
						'param_name' => 'excerpt_length',
						'value' => '30',
						'description' => esc_html__( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'total' ),
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'excerpt_font_size',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'excerpt_color',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'read_more',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Button', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text', 'total' ),
						'param_name' => 'read_more_text',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'readmore_style',
						'value' => array_flip( wpex_button_styles() ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'readmore_style_color',
						'std' => '',
						'value' => array_flip( wpex_button_colors() ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrow', 'total' ),
						'param_name' => 'readmore_rarr',
						'value' => array(
							$s_no => '',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'readmore_size',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'readmore_border_radius',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'readmore_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'readmore_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'readmore_background',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'readmore_color',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background: Hover', 'total' ),
						'param_name' => 'readmore_hover_background',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color: Hover', 'total' ),
						'param_name' => 'readmore_hover_color',
						'group' => esc_html__( 'Button', 'total' ),
						'dependency' => array( 'element' => 'read_more', 'value' => 'true' ),
					),
					// Design options
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'CSS', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Article Bottom Border Color', 'total' ),
						'param_name' => 'entry_bottom_border_color',
						'group' => esc_html__( 'CSS', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Recent_News_Shortcode;