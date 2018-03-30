<?php
/**
 * Visual Composer Single Image Configuration
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Global var for class
global $vcex_single_image_config;

// Start Class
if ( ! class_exists( 'VCEX_Single_Image_Config' ) ) {
	
	class VCEX_Single_Image_Config {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {
			add_filter( 'init', array( $this, 'add_params') );
			add_action( 'vc_after_init', array( $this, 'update_params' ) );
			add_filter( 'vc_edit_form_fields_attributes_vc_single_image', array( $this, 'edit_form_fields') );
		}

		/**
		 * Used to update default parms
		 *
		 * @since 3.0.0
		 * @access public
		 */
		public function update_params() {

			$param = WPBMap::getParam( 'vc_single_image', 'img_size' );
			if ( $param ) {
				$param['value'] = 'full';
				vc_update_shortcode_param( 'vc_single_image', $param );
			}

			$param = WPBMap::getParam( 'vc_single_image', 'img_link_target' );
			if ( $param ) {
				$param['value'][esc_html__( 'Local', 'total' )] = 'local';
				vc_update_shortcode_param( 'vc_single_image', $param );
			}

		}

		/**
		 * Adds new params for the VC Single_Images
		 *
		 * @since 2.0.0
		 */
		public static function add_params() {

			vc_add_param( 'vc_single_image', array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Image alignment', 'total' ),
				'param_name' => 'alignment',
				'value' => array(
					esc_html__( 'Default', 'total' ) => '',
					esc_html__( 'Left', 'total' ) => 'left',
					esc_html__( 'Right', 'total' ) => 'right',
					esc_html__( 'Center', 'total' ) => 'center',
				),
				'description' => esc_html__( 'Select image alignment.', 'total' )
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Image Filter', 'total' ),
				'param_name' => 'img_filter',
				'value' => array_flip( wpex_image_filters() ),
				'description' => esc_html__( 'Select an image filter style.', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Over Image Caption', 'total' ),
				'param_name' => 'img_caption',
				'description' => esc_html__( 'Use this field to add a caption to any single image with a link.', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Image Hover', 'total' ),
				'param_name' => 'img_hover',
				'std' => '',
				'value' => array_flip( wpex_image_hovers() ),
				'description' => esc_html__( 'Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video, SWF, Flash, URL Lightbox', 'total' ),
				'param_name' => 'lightbox_video',
				'description' => esc_html__( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Lightbox Type', 'total' ),
				'param_name' => 'lightbox_iframe_type',
				'value' => array(
					esc_html__( 'Auto Detect', 'total' ) => '',
					esc_html__( 'URL', 'total' ) => 'url',
					esc_html__( 'Youtube, Vimeo, Embed or Iframe', 'total' ) => 'video_embed',
					esc_html__( 'HTML5', 'total' ) => 'html5',
					esc_html__( 'Quicktime', 'total' ) => 'quicktime',
				),
				'description' => esc_html__( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
				'dependency' => array( 'element' => 'lightbox_video', 'not_empty' => true ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'textfield',
				'heading' => esc_html__( 'HTML5 Webm URL', 'total' ),
				'param_name' => 'lightbox_video_html5_webm',
				'description' => esc_html__( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
				'dependency' => array( 'element' => 'lightbox_iframe_type', 'value' => 'html5' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Lightbox Dimensions', 'total' ),
				'param_name' => 'lightbox_dimensions',
				'description' => esc_html__( 'Enter a custom width and height for your lightbox pop-up window. Use format widthxheight. Example: 900x600.', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'attach_image',
				'admin_label' => false,
				'heading' => esc_html__( 'Custom Image Lightbox', 'total' ),
				'param_name' => 'lightbox_custom_img',
				'description' => esc_html__( 'Select a custom image to open in lightbox format', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
			) );

			vc_add_param( 'vc_single_image', array(
				'type' => 'attach_images',
				'admin_label' => false,
				'heading' => esc_html__( 'Gallery Lightbox', 'total' ),
				'param_name' => 'lightbox_gallery',
				'description' => esc_html__( 'Select images to create a lightbox Gallery.', 'total' ),
				'group' => esc_html__( 'Custom Lightbox', 'total' ),
			) );

			// Hidden fields for parsing
			vc_add_param( 'vc_single_image', array(
				'type' => 'hidden',
				'param_name' => 'rounded_image',
			) );

		}

		/**
		 * Alter fields on edit
		 *
		 * @since 2.0.0
		 */
		public static function edit_form_fields( $atts ) {
			if ( ! empty( $atts['rounded_image'] )
				&& 'yes' == $atts['rounded_image']
				&& empty( $atts['style'] )
			) {
				$atts['style'] = 'vc_box_circle';
				unset( $atts['rounded_image'] );
			}
			if ( ! empty( $atts['link'] ) && empty( $atts['onclick'] ) ) {
				$atts['onclick'] = 'custom_link';
			}
			return $atts;
		}

	}

}
$vcex_single_image_config = new VCEX_Single_Image_Config();