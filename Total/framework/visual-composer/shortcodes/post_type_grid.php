<?php
/**
 * Post Type Grid
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Post_Type_Grid_Shortcode' ) ) {

	class VCEX_Post_Type_Grid_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_post_type_grid', array( 'VCEX_Post_Type_Grid_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_post_type_grid', array( 'VCEX_Post_Type_Grid_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_post_type_grid_tax_query_taxonomy_callback', 'vcex_suggest_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_filter_taxonomy_callback', 'vcex_suggest_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_tax_query_terms_callback', 'vcex_suggest_terms', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_author_in_callback', 'vcex_suggest_users', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_categories_taxonomy_callback', 'vcex_suggest_taxonomies', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_post_type_grid_filter_taxonomy_render', 'vcex_render_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_tax_query_taxonomy_render', 'vcex_render_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_categories_taxonomy_render', 'vcex_render_taxonomies', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_tax_query_terms_render', 'vcex_render_terms', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_post_type_grid_author_in_render', 'vcex_render_users', 10, 1 );

				// Move content design elements into new entry CSS field
				add_filter( 'vc_edit_form_fields_attributes_vcex_post_type_grid', 'vcex_parse_deprecated_grid_entry_content_css' );

				// Set image height to full if crop/width are empty
				add_filter( 'vc_edit_form_fields_attributes_vcex_post_type_grid', 'vcex_parse_image_size' );
				
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_post_type_grid.php' ) );
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
				'name' => esc_html__( 'Post Types Grid', 'total' ),
				'description' => esc_html__( 'Posts grid', 'total' ),
				'base' => 'vcex_post_type_grid',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-post-type-grid vcex-icon fa fa-files-o',
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
						'description' => esc_html__( 'Add additonal classes to the main element.', 'total' ),
						'param_name' => 'classes',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
						'description' => esc_html__( 'Choose when this module should display.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
						'description' => esc_html__( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Grid Style', 'total' ),
						'param_name' => 'grid_style',
						'value' => array(
							__( 'Fit Columns', 'total' ) => 'fit_columns',
							__( 'Masonry', 'total' ) => 'masonry',
							__( 'No Margins', 'total' ) => 'no_margins',
						),
						'edit_field_class' => 'vc_col-sm-3 vc_column clear',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Columns', 'total' ),
						'param_name' => 'columns',
						'std' => '3',
						'value' => wpex_grid_columns(),
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Gap', 'total' ),
						'param_name' => 'columns_gap',
						'value' => array_flip( wpex_column_gaps() ),
						'std' => '20',
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Responsive', 'total' ),
						'param_name' => 'columns_responsive',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( '1 Column Style', 'total' ),
						'param_name' => 'single_column_style',
						'value' => array(
							__( 'Default', 'total') => '',
							__( 'Left Image And Right Content', 'total' ) => 'left_thumbs',
						),
						'dependency' => array( 'element' => 'columns', 'value' => '1' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Equal Heights?', 'total' ),
						'param_name' => 'equal_heights_grid',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'description' => esc_html__( 'Enable so the content area for each entry is the same height.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Post Link Target', 'total' ),
						'param_name' => 'url_target',
						 'value' => array(
							__( 'Self', 'total') => 'self',
							__( 'Blank', 'total') => '_blank',
						),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts Per Page', 'total' ),
						'param_name' => 'posts_per_page',
						'value' => '12',
						'description' => esc_html__( 'You can enter "-1" to display all posts.', 'total' ),
						'group' => esc_html__( 'Query', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'total' ),
						'param_name' => 'pagination',
						'value' => array(
							__( 'False', 'total') => 'false',
							__( 'True', 'total' ) => 'true',
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
						'type' => 'posttypes',
						'heading' => esc_html__( 'Post types', 'total' ),
						'param_name' => 'post_types',
						'std' => 'post',
						'group' => esc_html__( 'Query', 'total' ),
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
						'dependency' => array(
							'element' => 'tax_query',
							'value' => 'true',
						),
						'settings' => array(
							'multiple' => false,
							'min_length' => 1,
							'groups' => false,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'group' => esc_html__( 'Query', 'total' ),
						'description' => esc_html__( 'If you do not see your taxonomy in the dropdown you can still enter the taxonomy name manually.', 'total' ),
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
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'group' => esc_html__( 'Query', 'total' ),
						'description' => esc_html__( 'If you do not see your terms in the dropdown you can still enter the term slugs manually seperated by a space.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'total' ),
						'param_name' => 'order',
						'group' => esc_html__( 'Query', 'total' ),
						'value' => array(
							__( 'Default', 'total' ) => 'default',
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
						'dependency' => array( 'element' => 'orderby', 'value' => array( 'meta_value_num', 'meta_value' ) ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Post With Thumbnails Only', 'total' ),
						'param_name' => 'thumbnail_query',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Query', 'total' ),
					),
					// Filter
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'filter',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'description' => esc_html__( 'If more then one post type is selected it will display a post type filter, otherwise it will display the categories for the current post type.', 'total' ),
						'group' => esc_html__( 'Filter', 'total' ),
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
						'heading' => esc_html__( 'Filter What?', 'total' ),
						'param_name' => 'filter_type',
						'value' => array(
							__( 'Post Types', 'total' ) => 'post_types',
							__( 'Custom Taxonomy', 'total') => 'taxonomy',
						),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Filter Taxonomy Name', 'total' ),
						'param_name' => 'filter_taxonomy',
						'dependency' => array( 'element' => 'filter_type', 'value' => array( 'taxonomy' ) ),
						'settings' => array(
							'multiple' => false,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
						'description' => esc_html__( 'Enter the taxonomy name for the filter links.', 'total' ),
						'group' => esc_html__( 'Filter', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter "All" Text', 'total' ),
						'param_name' => 'all_text',
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout Mode', 'total' ),
						'param_name' => 'masonry_layout_mode',
						'value' => array(
							__( 'Masonry', 'total' ) => 'masonry',
							__( 'Fit Rows', 'total' ) => 'fitRows',
						),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter Speed', 'total' ),
						'param_name' => 'filter_speed',
						'description' => esc_html__( 'Default is 0.4 seconds. Enter 0.0 to disable.', 'total' ),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Center Filter Links', 'total' ),
						'param_name' => 'center_filter',
						'value' => array(
							$s_no => 'no',
							$s_yes => 'yes',
						),
						'group' => esc_html__( 'Filter', 'total' ),
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
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
							__( 'Post', 'total' ) => 'post',
							__( 'Lightbox', 'total' ) => 'lightbox',
							__( 'Nowhere', 'total' ) => 'nowhere',
						),
						'group' => esc_html__( 'Media', 'total' ),
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
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
						'heading' => esc_html__( 'Tag', 'total' ),
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
						'heading' => esc_html__(  'Font Size', 'total' ),
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
					// Categories
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'show_categories',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Categories', 'total' ),
					),
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Taxonomy', 'total' ),
						'param_name' => 'categories_taxonomy',
						'group' => esc_html__( 'Categories', 'total' ),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
						'settings' => array(
							'multiple' => false,
							'min_length' => 1,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 0,
							'auto_focus' => true,
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Show Only The First Category', 'total' ),
						'param_name' => 'show_first_category_only',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => esc_html__( 'Categories', 'total' ),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'categories_font_size',
						'group' => esc_html__( 'Categories', 'total' ),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'categories_margin',
						'group' => esc_html__( 'Categories', 'total' ),
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'categories_color',
						'group' => esc_html__( 'Categories', 'total' ),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
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
						'group' => esc_html__( 'Excerpt', 'total' ),
						'value' => '20',
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
							__( 'Default', 'total' ) => '',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
							__( 'Center', 'total' ) => 'center',
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
new VCEX_Post_Type_Grid_Shortcode;