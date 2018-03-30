<?php
/**
 * Visual Composer Image Carousel
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
* @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Image_Carousel' ) ) {

	class VCEX_Image_Carousel {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_image_carousel', array( 'VCEX_Image_Carousel', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_image_carousel', array( 'VCEX_Image_Carousel', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Move content design elements into new entry CSS field
				add_filter( 'vc_edit_form_fields_attributes_vcex_image_carousel', 'vcex_parse_deprecated_grid_entry_content_css' );
				
				// Set image height to full if crop/width are empty
				add_filter( 'vc_edit_form_fields_attributes_vcex_image_carousel', 'vcex_parse_image_size' );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_image_carousel.php' ) );
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
				'name' => esc_html__( 'Image Carousel', 'total' ),
				'description' => esc_html__( 'Image based jQuery carousel', 'total' ),
				'base' => 'vcex_image_carousel',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-image-carousel vcex-icon fa fa-picture-o',
				'params' => array(
					// Gallery
					array(
						'type' => 'attach_images',
						'admin_label' => true,
						'heading'  => esc_html__( 'Attach Images', 'total' ),
						'param_name' => 'image_ids',
						'group' => esc_html__( 'Gallery', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading'  => esc_html__( 'Post Gallery', 'total' ),
						'param_name' => 'post_gallery',
						'group' => esc_html__( 'Gallery', 'total' ),
						'description' => esc_html__( 'Enable to display images from the current post "Image Gallery".', 'total' ),
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'admin_label' => true,
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading'  => esc_html__( 'Randomize Images', 'total' ),
						'param_name' => 'randomize_images',
						'group' => esc_html__( 'Gallery', 'total' ),
						'value' => array( $s_no => '', $s_yes => 'true' ),
					),
					// General
					array(
						'type' => 'textfield',
						'heading'  => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'param_name' => 'classes',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'value' => array(
							__( 'Default', 'total' ) => 'default',
							__( 'No Margins', 'total' ) => 'no-margins',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows?', 'total' ),
						'param_name' => 'arrows',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
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
							$s_no => 'false',
							$s_yes => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Items To Display', 'total' ),
						'param_name' => 'items',
						'value' => '4',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Auto Height?', 'total' ),
						'param_name' => 'auto_height',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'dependency' => array( 'element' => 'items', 'value' => '1' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Tablet: Items To Display', 'total' ),
						'param_name' => 'tablet_items',
						'value' => '3',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Mobile Landscape: Items To Display', 'total' ),
						'param_name' => 'mobile_landscape_items',
						'value' => '2',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Mobile Portrait: Items To Display', 'total' ),
						'param_name' => 'mobile_portrait_items',
						'value' => '1',
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
						'std' => 'true',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
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
						'std' => 'true',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Center Item', 'total' ),
						'param_name' => 'center',
						'value' => array(
							$s_no => 'false',
							$s_yes => 'true',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Speed', 'total' ),
						'param_name' => 'animation_speed',
						'value' => '150',
						'description' => esc_html__( 'Default is 150 milliseconds. Enter 0.0 to disable.', 'total' ),
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
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'img_size', 'value' => 'wpex_custom' ),
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
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Rounded Image?', 'total' ),
						'param_name' => 'rounded_image',
						'group' => esc_html__( 'Image', 'total' ),
						'value' => array(
							$s_no => 'no',
							$s_yes => 'yes'
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Overlay', 'total' ),
						'param_name' => 'overlay_style',
						'value' => array_flip( wpex_overlay_styles_array() ),
						'group' => esc_html__( 'Image', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Overlay Button Text', 'total' ),
						'param_name' => 'overlay_button_text',
						'group' => esc_html__( 'Image', 'total' ),
						'dependency' => array( 'element' => 'overlay_style', 'value' => 'hover-button' ),
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
					// Links
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Link', 'total' ),
						'param_name' => 'thumbnail_link',
						'std' => 'none',
						'value' => array(
							esc_html__( 'None', 'total' ) => 'none',
							esc_html__( 'Lightbox', 'total' )  => 'lightbox',
							esc_html__( 'Custom Links', 'total' ) => 'custom_link',
						),
						'group' => esc_html__( 'Links', 'total' ),
					),
					array(
						'type' => 'exploded_textarea',
						'heading'  => esc_html__( 'Custom links', 'total' ),
						'param_name' => 'custom_links',
						'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'total'),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'custom_link' ),
					),
					array(
						'type' => 'dropdown',
						'heading'  => esc_html__( 'Custom link target', 'total' ),
						'param_name' => 'custom_links_target',
						'description' => esc_html__( 'Select where to open custom links.', 'total'),
						'group' => esc_html__( 'Links', 'total' ),
						'value' => array(
							esc_html__( 'Same window', 'total' ) => 'self',
							esc_html__( 'New window', 'total' ) => '_blank'
						),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'custom_link' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Skin', 'total' ),
						'param_name' => 'lightbox_skin',
						'std' => '',
						'value' => vcex_ilightbox_skins(),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Title', 'total' ),
						'param_name' => 'lightbox_title',
						'value' => array(
							esc_html__( 'Alt', 'total' ) => 'alt',
							esc_html__( 'Title', 'total' ) => 'title',
							esc_html__( 'None', 'total' ) => 'false',
						),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Caption', 'total' ),
						'param_name' => 'lightbox_caption',
						'value' => array(
							$s_yes => 'true',
							$s_no => 'false',
						),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					// Title
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Title', 'total' ),
						'param_name' => 'title',
						'std' => 'no',
						'group' => esc_html__( 'Title', 'total' ),
						'value' => array(
							$s_no => 'no',
							$s_yes => 'yes',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Title Based On Image', 'total' ),
						'param_name' => 'title_type',
						'value' => array(
							esc_html__( 'Default', 'total' ) => 'default',
							esc_html__( 'Title', 'total' ) => 'title',
							esc_html__( 'Alt', 'total' )  => 'alt',
						),
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_heading_color',
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'content_heading_weight',
						'std' => '',
						'value' => array_flip( wpex_font_weights() ),
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'content_heading_transform',
						'value' => array_flip( wpex_text_transforms() ),
						'group' => esc_html__( 'Title', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_heading_size',
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
						'group' => esc_html__( 'Title', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'content_heading_margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'dependency' => array( 'element' => 'title', 'value' => 'yes' ),
					),
					// Caption
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Caption', 'total' ),
						'param_name' => 'caption',
						'group' => esc_html__( 'Caption', 'total' ),
						'value' => array(
							$s_no => 'no',
							$s_yes => 'yes',
						),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'content_color',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'yes' ),
					),
					array(
						'type' => 'textfield',
						'heading'  => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'content_font_size',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'yes' ),
					),
					// Design
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
						'group' => esc_html__( 'Content CSS', 'total' ),
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
							__( 'Center', 'total') => 'center',
						),
					),
					// Entry CSS
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'Entry CSS', 'total' ),
						'param_name' => 'entry_css',
						'group' => esc_html__( 'Entry CSS', 'total' ),
					),
				),
			);
		}

	}
}
new VCEX_Image_Carousel;