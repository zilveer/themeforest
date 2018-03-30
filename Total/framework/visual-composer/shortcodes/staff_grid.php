<?php
/**
 * Visual Composer Staff Grid
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Staff_Grid_Shortcode' ) ) {

	class VCEX_Staff_Grid_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_staff_grid', array( 'VCEX_Staff_Grid_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_staff_grid', array( 'VCEX_Staff_Grid_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Get autocomplete suggestion
				add_filter( 'vc_autocomplete_vcex_staff_grid_include_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_staff_grid_exclude_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_staff_grid_filter_active_category_callback', 'vcex_suggest_staff_categories', 10, 1 );

				// Render autocomplete suggestions
				add_filter( 'vc_autocomplete_vcex_staff_grid_include_categories_render', 'vcex_render_staff_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_staff_grid_exclude_categories_render', 'vcex_render_staff_categories', 10, 1 );
				add_filter( 'vc_autocomplete_vcex_staff_grid_filter_active_category_render', 'vcex_render_staff_categories', 10, 1 );

				// Move content design elements into new entry CSS field
				add_filter( 'vc_edit_form_fields_attributes_vcex_staff_grid', 'vcex_parse_deprecated_grid_entry_content_css' );

				// Set image height to full if crop/width are empty
				add_filter( 'vc_edit_form_fields_attributes_vcex_staff_grid', 'vcex_parse_image_size' );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_staff_grid.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			// Strings
			$s_enable      = esc_html__( 'Enable', 'total' );
			$s_yes         = esc_html__( 'Yes', 'total' );
			$s_no          = esc_html__( 'No', 'total' );
			$s_query       = esc_html__( 'Query', 'total' );
			$s_filter      = esc_html__( 'Filter', 'total' );
			$s_image       = esc_html__( 'Image', 'total' );
			$s_title       = esc_html__( 'Title', 'total' );
			$s_position    = esc_html__( 'Position', 'total' );
			$s_social      = esc_html__( 'Social', 'total' );
			$s_excerpt     = esc_html__( 'Excerpt', 'total' );
			$s_content_css = esc_html__( 'Content CSS', 'total' );
			$s_entry_css   = esc_html__( 'Entry CSS', 'total' );
			$s_categories  = esc_html__( 'Categories', 'total' );
			// Return array
			return array(
				'name' => esc_html__( 'Staff Grid', 'total' ),
				'description' => esc_html__( 'Recent staff posts grid', 'total' ),
				'base' => 'vcex_staff_grid',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-staff-grid vcex-icon fa fa-users',
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
						'dependency' => array( 'element' => 'filter', 'value' => 'false' ),
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
						'value' => array_flip( wpex_grid_columns() ),
						'std' => '3',
						'edit_field_class' => 'vc_col-sm-3 vc_column',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Gap', 'total' ),
						'param_name' => 'columns_gap',
						'value' => array_flip( wpex_column_gaps() ),
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
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'description' => esc_html__( 'Enable so the content area for each entry is the same height.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Target', 'total' ),
						'param_name' => 'link_target',
						'value' => array(
							__( 'Default', 'total') => '',
							__( 'Blank', 'total' ) => 'blank',
						),
					),
					// Query
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts Per Page', 'total' ),
						'param_name' => 'posts_per_page',
						'value' => '9',
						'description' => esc_html__( 'When pagination is disabled this is also used for the post count.', 'total' ),
						'group' => $s_query,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'total' ),
						'param_name' => 'pagination',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_query,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Offset', 'total' ),
						'param_name' => 'offset',
						'group' => $s_query,
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
						'group' => $s_query,
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
						'group' => $s_query,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'total' ),
						'param_name' => 'order',
						'group' => $s_query,
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
						'group' => $s_query,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Orderby: Meta Key', 'total' ),
						'param_name' => 'orderby_meta_key',
						'group' => $s_query,
						'dependency' => array(
							'element' => 'orderby',
							'value' => array( 'meta_value_num', 'meta_value' ),
						),
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
						'description' => esc_html__( 'Enables a category filter to show and hide posts based on their categories. This does not load posts via AJAX, but rather filters items currently on the page.', 'total' ),
						'group' => $s_filter,
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
						'group' => $s_filter,
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
						'group' => $s_filter,
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter "All" Text', 'total' ),
						'param_name' => 'all_text',
						'group' => $s_filter,
						'dependency' => array( 'element' => 'filter_all_link', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Button Style', 'total' ),
						'param_name' => 'filter_button_style',
						'value' => array_flip( wpex_button_styles() ),
						'group' => $s_filter,
						'std' => 'minimal-border',
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Button Color', 'total' ),
						'param_name' => 'filter_button_color',
						'std' => '',
						'value' => array_flip( wpex_button_colors() ),
						'group' => $s_filter,
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
						'group' => $s_filter,
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Filter Speed', 'total' ),
						'param_name' => 'filter_speed',
						'description' => esc_html__( 'Default is 0.4 seconds. Enter 0.0 to disable.', 'total' ),
						'group' => $s_filter,
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
						'group' => $s_filter,
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'filter_font_size',
						'group' => $s_filter,
						'dependency' => array( 'element' => 'filter', 'value' => 'true' ),
					),
					// Image
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'entry_media',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => $s_image,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Links To', 'total' ),
						'param_name' => 'thumb_link',
						'value' => array(
							__( 'Post', 'total') => 'post',
							__( 'Lightbox', 'total' ) => 'lightbox',
							__( 'Nowhere', 'total' ) => 'nowhere',
						),
						'group' => $s_image,
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Size', 'total' ),
						'param_name' => 'img_size',
						'std' => 'wpex_custom',
						'value' => vcex_image_sizes(),
						'group' => $s_image,
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Crop Location', 'total' ),
						'param_name' => 'img_crop',
						'std' => 'center-center',
						'value' => array_flip( wpex_image_crop_locations() ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => $s_image,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Width', 'total' ),
						'param_name' => 'img_width',
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'group' => $s_image,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Image Crop Height', 'total' ),
						'param_name' => 'img_height',
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
						'description' => esc_html__( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'total' ),
						'group' => $s_image,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Overlay', 'total' ),
						'param_name' => 'overlay_style',
						'value' => array_flip( wpex_overlay_styles_array() ),
						'group' => $s_image,
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Overlay Button Text', 'total' ),
						'param_name' => 'overlay_button_text',
						'group' => $s_image,
						'dependency' => array( 'element' => 'overlay_style', 'value' => 'hover-button' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Overlay Excerpt Length', 'total' ),
						'param_name' => 'overlay_excerpt_length',
						'value' => '15',
						'group' => $s_image,
						'dependency' => array( 'element' => 'overlay_style', 'value' => 'title-excerpt-hover' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Hover', 'total' ),
						'param_name' => 'img_hover_style',
						'value' => array_flip( wpex_image_hovers() ),
						'group' => $s_image,
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Filter', 'total' ),
						'param_name' => 'img_filter',
						'value' => array_flip( wpex_image_filters() ),
						'group' => $s_image,
						'dependency' => array( 'element' => 'entry_media', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Skin', 'total' ),
						'param_name' => 'lightbox_skin',
						'value' => vcex_ilightbox_skins(),
						'group' => $s_image,
						'dependency' => array( 'element' => 'thumb_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Gallery', 'total' ),
						'param_name' => 'thumb_lightbox_gallery',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_image,
						'dependency' => array( 'element' => 'thumb_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Title', 'total' ),
						'param_name' => 'thumb_lightbox_title',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_image,
						'dependency' => array( 'element' => 'thumb_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Excerpt', 'total' ),
						'param_name' => 'thumb_lightbox_caption',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_image,
						'dependency' => array( 'element' => 'thumb_link', 'value' => 'lightbox' ),
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
						'group' => $s_title,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'HTML Tag', 'total' ),
						'param_name' => 'title_tag',
						'group' => $s_title,
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
						'type' => 'dropdown',
						'heading' => esc_html__( 'Links To', 'total' ),
						'param_name' => 'title_link',
						'value' => array(
							__( 'Post', 'total') => 'post',
							__( 'Lightbox', 'total') => 'lightbox',
							__( 'Nowhere', 'total' ) => 'nowhere',
						),
						'group' => $s_title,
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_heading_color',
						'group' => $s_title,
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_heading_size',
						'group' => $s_title,
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Line Height', 'total' ),
						'param_name' => 'content_heading_line_height',
						'group' => $s_title,
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'content_heading_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => $s_title,
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'content_heading_weight',
						'group' => $s_title,
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'content_heading_transform',
						'group' => $s_title,
						'std' => '',
						'value' => array_flip( wpex_text_transforms() ),
						'dependency' => array( 'element' => 'title', 'value' => 'true' ),
					),
					// Position
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'position',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_position,
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Position Font Color', 'total' ),
						'param_name' => 'position_color',
						'group' => $s_position,
						'dependency' => array( 'element' => 'position', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Position Font Size', 'total' ),
						'param_name' => 'position_size',
						'group' => $s_position,
						'dependency' => array( 'element' => 'position', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__(  'Font Weight', 'total' ),
						'param_name' => 'position_weight',
						'group' => $s_position,
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'dependency' => array( 'element' => 'position', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Position Margin', 'total' ),
						'param_name' => 'position_margin',
						'group' => $s_position,
						'dependency' => array( 'element' => 'position', 'value' => 'true' ),
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
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
						'group' => $s_categories,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Show Only The First Category?', 'total' ),
						'param_name' => 'show_first_category_only',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
						'group' => $s_categories,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'categories_font_size',
						'group' => $s_categories,
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'categories_margin',
						'group' => $s_categories,
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'categories_color',
						'group' => $s_categories,
						'dependency' => array( 'element' => 'show_categories', 'value' => 'true' ),
					),
					// Social
					array(
						'type' => 'dropdown',
						'heading' => $s_enable,
						'param_name' => 'social_links',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
						'group' => $s_social,
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'social_links_style',
						'std' => 'minimal-round',
						'value' => array_flip( wpex_social_button_styles() ),
						'group' => $s_social,
						'dependency' => array( 'element' => 'social_links', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'social_links_size',
						'group' => $s_social,
						'dependency' => array( 'element' => 'social_links', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'social_links_margin',
						'group' => $s_social,
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'dependency' => array( 'element' => 'social_links', 'value' => 'true' ),
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
						'group' => $s_excerpt,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Length', 'total' ),
						'param_name' => 'excerpt_length',
						'group' => $s_excerpt,
						'description' => esc_html__( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'total' ),
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_color',
						'group' => $s_excerpt,
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_font_size',
						'group' => $s_excerpt,
						'dependency' => array( 'element' => 'excerpt', 'value' => 'true' ),
					),
					// Button
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
						'value' => esc_html__( 'read more', 'total' ),
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
						'heading' => $s_content_css,
						'param_name' => 'content_css',
						'group' => $s_content_css,
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
						'group' => $s_content_css,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Content Opacity', 'total' ),
						'param_name' => 'content_opacity',
						'description' => esc_html__( 'Enter a value between "0" and "1".', 'total' ),
						'group' => $s_content_css,
					),
					// Entry CSS
					array(
						'type' => 'css_editor',
						'heading' => $s_entry_css,
						'param_name' => 'entry_css',
						'group' => $s_entry_css,
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
new VCEX_Staff_Grid_Shortcode;