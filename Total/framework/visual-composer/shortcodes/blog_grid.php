<?php
/**
 * Visual Composer Blog Grid
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Blog_Grid_Shortcode' ) ) {

	class VCEX_Blog_Grid_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_blog_grid', array( 'VCEX_Blog_Grid_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_blog_grid', array( 'VCEX_Blog_Grid_Shortcode', 'map' ) );
			}

			// Filters needed in admin only while editing
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_blog_grid_include_categories_callback', 'vcex_suggest_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_exclude_categories_callback', 'vcex_suggest_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_filter_active_category_callback', 'vcex_suggest_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_author_in_callback', 'vcex_suggest_users', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_blog_grid_include_categories_render', 'vcex_render_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_exclude_categories_render', 'vcex_render_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_filter_active_category_render', 'vcex_render_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_blog_grid_author_in_render', 'vcex_render_users', 10, 1 );

				// Move content design elements into new entry CSS field
				add_filter( 'vc_edit_form_fields_attributes_vcex_blog_grid', 'vcex_parse_deprecated_grid_entry_content_css' );

				// Set image height to full if crop/width are empty
				add_filter( 'vc_edit_form_fields_attributes_vcex_blog_grid', 'vcex_parse_image_size' );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_blog_grid.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			// Strings
			$s_default = esc_html__( 'Default', 'total' );
			$s_enable  = esc_html__( 'Enable', 'total' );
			$s_yes     = esc_html__( 'Yes', 'total' );
			$s_no      = esc_html__( 'No', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Blog Grid', 'total' ),
				'description' => esc_html__( 'Recent blog posts grid', 'total' ),
				'base' => 'vcex_blog_grid',
				'icon' => 'vcex-blog-grid vcex-icon fa fa-pencil',
				'category' => wpex_get_theme_branding(),
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
						'heading' => esc_html__( 'Appear Animation', 'total' ),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
						'dependency' => array( 'element' => 'filter', 'value' => 'false' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Grid Style', 'total' ),
						'param_name' => 'grid_style',
						'edit_field_class' => 'vc_col-sm-3 vc_column clear',
						'value' => array(
							$s_default => 'default',
							esc_html__( 'Fit Columns', 'total' ) => 'fit_columns',
							esc_html__( 'Masonry', 'total' ) => 'masonry',
						),
						'admin_label' => true,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Columns', 'total' ),
						'param_name' => 'columns',
						'value' => array_flip( wpex_grid_columns() ),
						'std' => '4',
						'edit_field_class' => 'vc_col-sm-3 vc_column',
						'admin_label' => true,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Gap', 'total' ),
						'param_name' => 'columns_gap',
						'value' => array_flip( wpex_column_gaps() ),
						'std' => '',
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Responsive', 'total' ),
						'param_name' => 'columns_responsive',
						'value' => array(
							$s_yes => '',
							$s_no => 'false',
						),
						'std' => '',
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( '1 Column Style', 'total' ),
						'param_name' => 'single_column_style',
						'value' => array(
							$s_default => '',
							esc_html__( 'Left Image And Right Content', 'total' ) => 'left_thumbs',
						),
						'dependency' => array(
							'element' => 'columns',
							'value' => '1',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Equal Heights?', 'total' ),
						'param_name' => 'equal_heights_grid',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'description' => esc_html__( 'Enable so the content area for each entry is the same height.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Target', 'total' ),
						'param_name' => 'url_target',
						'value' => array(
							esc_html__( 'Self', 'total' ) => 'self',
							esc_html__( 'Blank', 'total' ) => '_blank',
						),
						'description' => esc_html__( 'This will apply to the image, title and readmore button', 'total' ),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts Per Page', 'total' ),
						'param_name' => 'posts_per_page',
						'value' => '4',
						'description' => esc_html__( 'You can enter "-1" to display all posts.', 'total' ),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'total' ),
						'param_name' => 'pagination',
						'value' => array(
							$s_no => '',
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
						'heading' => esc_html__( 'Order', 'total' ),
						'param_name' => 'order',
						'group' => esc_html__( 'Query', 'total' ),
						'value' => array(
							$s_default => '',
							esc_html__( 'DESC', 'total' ) => 'DESC',
							esc_html__( 'ASC', 'total' ) => 'ASC',
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
							$s_no => '',
							$s_yes => 'true',
						),
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
					// Filter
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category Filter', 'total' ),
						'param_name' => 'filter',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'description' => esc_html__( 'Enables a category filter to show and hide posts based on their categories. This does not load posts via AJAX, but rather filters items currently on the page.', 'total' ),
						'group' => esc_html__( 'Filter', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Default Active Category', 'total' ),
						'param_name' => 'filter_active_category',
						'param_holder_class' => 'vc_not-for-custom',
						'admin_label' => true,
						'settings' => array(
							'multiple' => false,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display All Link?', 'total' ),
						'param_name' => 'filter_all_link',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter "All" Text', 'total' ),
						'param_name' => 'all_text',
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter_all_link', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Button Style', 'total' ),
						'param_name' => 'filter_button_style',
						'value' => array_flip( wpex_button_styles() ),
						'group' => esc_html__( 'Filter', 'total' ),
						'std' => 'minimal-border',
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Button Color', 'total' ),
						'param_name' => 'filter_button_color',
						'std' => '',
						'value' => array_flip( wpex_button_colors() ),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Filter Layout', 'total' ),
						'param_name' => 'masonry_layout_mode',
						'value' => array(
							esc_html__( 'Masonry', 'total' ) => '',
							esc_html__( 'Fit Rows', 'total' ) => 'fitRows',
						),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
						'group' => esc_html__( 'Filter', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter Speed', 'total' ),
						'param_name' => 'filter_speed',
						'description' => esc_html__( 'Default is "0.4" seconds. Enter "0.0" to disable.', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
						'group' => esc_html__( 'Filter', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Center Filter Links', 'total' ),
						'param_name' => 'center_filter',
						'value' => array(
							$s_no => '',
							$s_yes => 'yes',
						),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
						'group' => esc_html__( 'Filter', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'filter_font_size',
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					// Media
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'entry_media',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
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
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Links To', 'total' ),
						'param_name' => 'thumb_link',
						'value' => array(
							$s_default => '',
							esc_html__( 'Post', 'total' ) => 'post',
							esc_html__( 'Lightbox', 'total' ) => 'lightbox',
							esc_html__( 'Nowhere', 'total' ) => 'nowhere',
						),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
						'std' => 'wpex_custom',
						'value' => vcex_image_sizes(),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
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
						'description' => esc_html__( 'Enter a width in pixels.', 'total' ),
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
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Overlay', 'total' ),
						'param_name' => 'overlay_style',
						'value' => array_flip( wpex_overlay_styles_array() ),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Overlay Button Text', 'total' ),
						'param_name' => 'overlay_button_text',
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'overlay_style', 'value' => 'hover-button' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Overlay Excerpt Length', 'total' ),
						'param_name' => 'overlay_excerpt_length',
						'value' => '15',
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'overlay_style', 'value' => 'title-excerpt-hover' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Hover', 'total' ),
						'param_name' => 'img_hover_style',
						'value' => array_flip( wpex_image_hovers() ),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Filter', 'total' ),
						'param_name' => 'img_filter',
						'value' => array_flip( wpex_image_filters() ),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					// Title
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Title', 'total' ),
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
						'group' => esc_html__( 'Title', 'total' ),
						'std' => 'h2',
						'value' => array(
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
							'div' => 'div',
						),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_heading_color',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_heading_size',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'content_heading_line_height',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'content_heading_margin',
						'group' => esc_html__( 'Title', 'total' ),
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'content_heading_weight',
						'group' => esc_html__( 'Title', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'content_heading_transform',
						'group' => esc_html__( 'Title', 'total' ),
						'std' => '',
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					// Date
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'date',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Date', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'date_color',
						'group' => esc_html__( 'Date', 'total' ),
						'dependency' => array( 'element' => 'date', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'date_font_size',
						'group' => esc_html__( 'Date', 'total' ),
						'dependency' => array( 'element' => 'date', 'value' => 'true' ),
					),
					// Excerpt
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
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
						'std' => '15',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'description' => esc_html__( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_font_size',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_color',
						'group' => esc_html__( 'Excerpt', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					// Readmore
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
						'std' => '',
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
							$s_no => 'false',
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
						'description' => esc_html__( 'Please enter a px value.', 'total' ),
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
					// Content CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'Content CSS', 'total' ),
						'param_name' => 'content_css',
						'group' => esc_html__( 'Content CSS', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Content Alignment', 'total' ),
						'param_name' => 'content_alignment',
						'value' => array(
							$s_default => '',
							esc_html__( 'Left', 'total' ) => 'left',
							esc_html__( 'Right', 'total' ) => 'right',
							esc_html__( 'Center', 'total' ) => 'center',
						),
						'group' => esc_html__( 'Content CSS', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Opacity', 'total' ),
						'param_name' => 'content_opacity',
						'description' => esc_html__( 'Enter a value between "0" and "1".', 'total' ),
						'group' => esc_html__( 'Content CSS', 'total' ),
					),
					// Entry CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'Entry CSS', 'total' ),
						'param_name' => 'entry_css',
						'group' => esc_html__( 'Entry CSS', 'total' ),
					),
					// Hidden fields
					array( 'type' => 'hidden', 'param_name' => 'content_background' ),
					array( 'type' => 'hidden', 'param_name' => 'content_border' ),
					array( 'type' => 'hidden', 'param_name' => 'content_margin' ),
					array( 'type' => 'hidden', 'param_name' => 'content_padding' ),
				)
			);
		}

	}

}
new VCEX_Blog_Grid_Shortcode;