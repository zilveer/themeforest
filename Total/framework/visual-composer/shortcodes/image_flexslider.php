<?php
/**
 * Visual Composer Image Slider
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Image_Flexslider_Shortcode' ) ) {

	class VCEX_Image_Flexslider_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_image_flexslider', array( 'VCEX_Image_Flexslider_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_image_flexslider', array( 'VCEX_Image_Flexslider_Shortcode', 'map' ) );
			}

			// Admin filters
			if ( is_admin() ) {

				// Set image height to full if crop/width are empty
				add_filter( 'vc_edit_form_fields_attributes_vcex_image_flexslider', 'vcex_parse_image_size' );

			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_image_flexslider.php' ) );
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
				'name' => esc_html__( 'Image Slider', 'total' ),
				'description' => esc_html__( 'Custom image slider', 'total' ),
				'base' => 'vcex_image_flexslider',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-image-flexslider vcex-icon fa fa-picture-o',
				'params' => array(
					// Images
					array(
						'type' => 'attach_images',
						'admin_label' => true,
						'heading' => esc_html__( 'Attach Images', 'total' ),
						'param_name' => 'image_ids',
						'description' => esc_html__( 'You can display captions by giving your images a caption and you can also display videos by adding an image that has a Video URL defined for it.', 'total' ),
						'group' => esc_html__( 'Images', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Post Gallery', 'total' ),
						'param_name' => 'post_gallery',
						'group' => esc_html__( 'Images', 'total' ),
						'description' => esc_html__( 'Enable to display images from the current post "Image Gallery".', 'total' ),
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'admin_label' => true,
					),
					// General
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'total' ),
						'param_name' => 'classes',
						'group' => esc_html__( 'General', 'total' ),
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'visibility',
						'value' => array_flip( wpex_visibility() ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lazy Load', 'total' ),
						'param_name' => 'lazy_load',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'group' => esc_html__( 'General', 'total' ),
						'description' => esc_html__( 'Will enable by default if there are more than 10 images.', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Randomize', 'total' ),
						'param_name' => 'randomize',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation', 'total' ),
						'param_name' => 'animation',
						'value' => array(
							__( 'Slide', 'total' ) => 'slide',
							__( 'Fade', 'total' ) => 'fade_slides',
						),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Loop', 'total' ),
						'param_name' => 'loop',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Height Animation', 'total' ),
						'std' => '500',
						'param_name' => 'height_animation',
						'group' => esc_html__( 'General', 'total' ),
						'description' => esc_html__( 'You can enter "0.0" to disable the animation completely.', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Speed', 'total' ),
						'param_name' => 'animation_speed',
						'std' => '600',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Auto Play', 'total' ),
						'param_name' => 'slideshow',
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'description' => esc_html__( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'total' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Auto Play Delay', 'total' ),
						'param_name' => 'slideshow_speed',
						'std' => '5000',
						'description' => esc_html__( 'Enter a value in milliseconds.', 'total' ),
						'group' => esc_html__( 'General', 'total' ),
						'dependency' => array( 'element' => 'slideshow', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows', 'total' ),
						'param_name' => 'direction_nav',
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Arrows on Hover', 'total' ),
						'param_name' => 'direction_nav_hover',
						'value' => array( $s_yes => '', $s_no => 'false' ),
						'group' => esc_html__( 'General', 'total' ),
						'dependency' => array( 'element' => 'direction_nav', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Dot Navigation', 'total' ),
						'param_name' => 'control_nav',
						'value' => array( $s_yes => '', $s_no => 'false' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnails', 'total' ),
						'param_name' => 'control_thumbs',
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'group' => esc_html__( 'General', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Thumbnails Pointer', 'total' ),
						'param_name' => 'control_thumbs_pointer',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'group' => esc_html__( 'General', 'total' ),
						'dependency' => array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Height', 'total' ),
						'param_name' => 'control_thumbs_height',
						'std' => '70',
						'group' => esc_html__( 'General', 'total' ),
						'dependency' => array( 'element' => 'control_thumbs', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Navigation Thumbnails Width', 'total' ),
						'param_name' => 'control_thumbs_width',
						'std' => '70',
						'group' => esc_html__( 'General', 'total' ),
						'dependency' => array( 'element' => 'control_thumbs', 'value' => 'true' ),
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
						'heading' => esc_html__( 'Enable', 'total' ),
						'param_name' => 'caption',
						'std' => 'false',
						'value' => array( $s_no => 'false', $s_yes => 'true' ),
						'group' => esc_html__( 'Caption', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Based On', 'total' ),
						'param_name' => 'caption_type',
						'std' => 'caption',
						'value' => array(
							__( 'Title', 'total' ) => 'title',
							__( 'Caption', 'total' ) => 'caption',
							__( 'Description', 'total' ) => 'description',
							__( 'Alt', 'total' ) => 'alt',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Visibility', 'total' ),
						'param_name' => 'caption_visibility',
						'value' => array_flip( wpex_visibility() ),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'caption_style',
						'value' => array(
							__( 'Black', 'total' ) => 'black',
							__( 'White', 'total' ) => 'white',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Rounded', 'total' ),
						'param_name' => 'caption_rounded',
						'value' => array( $s_no => '', $s_yes => 'true' ),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Position', 'total' ),
						'param_name' => 'caption_position',
						'std' => 'bottomCenter',
						'value' => array(
							__( 'Bottom Center', 'total' ) => 'bottomCenter',
							__( 'Bottom Left', 'total' ) => 'bottomLeft',
							__( 'Bottom Right', 'total' ) => 'bottomRight',
							__( 'Top Center', 'total' ) => 'topCenter',
							__( 'Top Left', 'total' ) => 'topLeft',
							__( 'Top Right', 'total' ) => 'topRight',
							__( 'Center Center', 'total' ) => 'centerCenter',
							__( 'Center Left', 'total' ) => 'centerLeft',
							__( 'Center Right', 'total' ) => 'centerRight',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Show Transition', 'total' ),
						'param_name' => 'caption_show_transition',
						'std' => 'up',
						'value' => array(
							__( 'None', 'total' ) => 'false',
							__( 'Up', 'total' ) => 'up',
							__( 'Down', 'total' ) => 'down',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hide Transition', 'total' ),
						'param_name' => 'caption_hide_transition',
						'std' => 'down',
						'value' => array(
							__( 'None', 'total' ) => 'false',
							__( 'Up', 'total' ) => 'up',
							__( 'Down', 'total' ) => 'down',
							__( 'Left', 'total' ) => 'left',
							__( 'Right', 'total' ) => 'right',
						),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Width', 'total' ),
						'param_name' => 'caption_width',
						'value' => '100%',
						'description' => esc_html__( 'Enter a pixel or percentage value. You can also enter "auto" for content dependent width.', 'total' ),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font-Size', 'total' ),
						'param_name' => 'caption_font_size',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'caption_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Horizontal Offset', 'total' ),
						'param_name' => 'caption_horizontal',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Vertical Offset', 'total' ),
						'param_name' => 'caption_vertical',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Delay', 'total' ),
						'param_name' => 'caption_delay',
						'std' => '500',
						'group' => esc_html__( 'Caption', 'total' ),
						'dependency' => array( 'element' => 'caption', 'value' => 'true' ),
					),
					// Links
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Link', 'total' ),
						'param_name' => 'thumbnail_link',
						'value' => array(
							__( 'None', 'total' ) => 'none',
							__( 'Lightbox', 'total' ) => 'lightbox',
							__( 'Custom Links', 'total' ) => 'custom_link',
						),
						'group' => esc_html__( 'Links', 'total' ),
					),
					array(
						'type' => 'exploded_textarea',
						'heading' => esc_html__('Custom links', 'total' ),
						'param_name' => 'custom_links',
						'description' => esc_html__( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol.', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'custom_link' ),
						'group' => esc_html__( 'Links', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Custom link target', 'total' ),
						'param_name' => 'custom_links_target',
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'custom_link' ),
						'value' => array(
							__( 'Same window', 'total' ) => 'self',
							__( 'New window', 'total' ) => '_blank'
						),
						'group' => esc_html__( 'Links', 'total' ),
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
						'heading' => esc_html__( 'Lightbox Thumbnails Placement', 'total' ),
						'param_name' => 'lightbox_path',
						'value' => array(
							__( 'Horizontal', 'total' ) => 'horizontal',
							__( 'Vertical', 'total' ) => 'vertical',
						),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Title', 'total' ),
						'param_name' => 'lightbox_title',
						'value' => array(
							__( 'None', 'total' ) => 'none',
							__( 'Alt', 'total' ) => 'alt',
							__( 'Title', 'total' ) => 'title',
						),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Lightbox Caption', 'total' ),
						'param_name' => 'lightbox_caption',
						'value' => array( $s_yes => 'true', $s_no => 'false' ),
						'group' => esc_html__( 'Links', 'total' ),
						'dependency' => array( 'element' => 'thumbnail_link', 'value' => 'lightbox' ),
					),
					// Design options
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css',
						'group' => esc_html__( 'CSS', 'total' ),
					),
				)
			);
		}

	}
}
new VCEX_Image_Flexslider_Shortcode;