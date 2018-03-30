<?php
/**
 * Registers the button shortcode and adds it to the Visual Composer
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

if ( ! class_exists( 'VCEX_Button_Shortcode' ) ) {

	class VCEX_Button_Shortcode {

		/**
		 * Main constructor
		 *
		 * @since 3.5.0
		 */
		public function __construct() {
			
			// Add shortcode
			add_shortcode( 'vcex_button', array( 'VCEX_Button_Shortcode', 'output' ) );

			// Map to VC
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'vcex_button', array( 'VCEX_Button_Shortcode', 'map' ) );
			}

			// Parse attributes
			if ( is_admin() ) {
				add_filter( 'vc_edit_form_fields_attributes_vcex_button', array( 'VCEX_Button_Shortcode', 'edit_form_fields' ) );
			}

		}

		/**
		 * Shortcode output => Get template file and display shortcode
		 *
		 * @since 3.5.0
		 */
		public static function output( $atts, $content = null ) {
			ob_start();
			include( locate_template( 'vcex_templates/vcex_button.php' ) );
			return ob_get_clean();
		}

		/**
		 * Map shortcode to VC
		 *
		 * @since 3.5.0
		 */
		public static function map() {
			return array(
				'name' => esc_html__( 'Total Button', 'total' ),
				'description' => esc_html__( 'Eye catching button', 'total' ),
				'base' => 'vcex_button',
				'category' => wpex_get_theme_branding(),
				'icon' => 'vcex-total-button vcex-icon fa fa-external-link-square',
				'params' => array(
					// General
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Unique Id', 'total' ),
						'param_name' => 'unique_id',
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
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
						'heading' => esc_html__( 'Appear Animation', 'total'),
						'param_name' => 'css_animation',
						'value' => array_flip( wpex_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Hover Animation', 'total'),
						'param_name' => 'hover_animation',
						'value' => array_flip( wpex_hover_css_animations() ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'On click action', 'total' ),
						'param_name' => 'onclick',
						'value' => array(
							__( 'Open custom link', 'total' ) => 'custom_link',
							__( 'Open image', 'total' ) => 'image',
							__( 'Open lightbox', 'total' ) => 'lightbox',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'URL', 'total' ),
						'param_name' => 'url',
						'value' => 'https://www.google.com/',
						'dependency' => array( 'element' => 'onclick', 'value' => array( 'custom_link', 'lightbox' ) ),
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Image', 'total' ),
						'param_name' => 'image_attachment',
						'dependency' => array( 'element' => 'onclick', 'value' => array( 'image', 'lightbox' ) ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text', 'total' ),
						'param_name' => 'content',
						'admin_label' => true,
						'std' => 'Button Text',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Link Title', 'total' ),
						'param_name' => 'title',
						'value' => 'Visit Site',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Target', 'total' ),
						'param_name' => 'target',
						'value' => array(
							__( 'Self', 'total' ) => '',
							__( 'Blank', 'total' ) => 'blank',
							__( 'Local', 'total' ) => 'local',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Link Rel', 'total' ),
						'param_name' => 'rel',
						'value' => array(
							__( 'None', 'total' ) => '',
							__( 'Nofollow', 'total' ) => 'nofollow',
						),
					),
					// Design
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'total' ),
						'param_name' => 'style',
						'std' => '',
						'value' => array_flip( wpex_button_styles() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout', 'total' ),
						'param_name' => 'layout',
						'value' => array(
							__( 'Inline', 'total' ) => '',
							__( 'Block', 'total' ) => 'block',
							__( 'Expanded (fit container)', 'total' ) => 'expanded',
						),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Align', 'total' ),
						'param_name' => 'align',
						'value' => array_flip( wpex_alignments() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Size', 'total' ),
						'param_name' => 'size',
						'std' => '',
						'value' => array(
							__( 'Default', 'total' ) => '',
							__( 'Small', 'total' ) => 'small',
							__( 'Medium', 'total' ) => 'medium',
							__( 'Large', 'total' ) => 'large',
						),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'vcex_font_family_select',
						'heading' => esc_html__( 'Font Family', 'total' ),
						'param_name' => 'font_family',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'color',
						'std' => '',
						'value' => array_flip( wpex_button_colors() ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background', 'total' ),
						'param_name' => 'custom_background',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background: Hover', 'total' ),
						'param_name' => 'custom_hover_background',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color', 'total' ),
						'param_name' => 'custom_color',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Color: Hover', 'total' ),
						'param_name' => 'custom_hover_color',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Font Size', 'total' ),
						'param_name' => 'font_size',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Letter Spacing', 'total' ),
						'param_name' => 'letter_spacing',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Text Transform', 'total' ),
						'param_name' => 'text_transform',
						'group' => esc_html__( 'Design', 'total' ),
						'value' => array_flip( wpex_text_transforms() ),
						'std' => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Font Weight', 'total' ),
						'param_name' => 'font_weight',
						'value' => array_flip( wpex_font_weights() ),
						'std' => '',
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Width', 'total' ),
						'param_name' => 'width',
						'description' => esc_html__( 'Please use a pixel or percentage value.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Border Radius', 'total' ),
						'param_name' => 'border_radius',
						'description' => esc_html__( 'Please enter a px value.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'total' ),
						'param_name' => 'font_padding',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Margin', 'total' ),
						'param_name' => 'margin',
						'description' => esc_html__( 'Please use the following format: top right bottom left.', 'total' ),
						'group' => esc_html__( 'Design', 'total' ),
					),
					// Lightbox
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Type', 'total' ),
						'param_name' => 'lightbox_type',
						'value' => array(
							__( 'Auto Detect - slow', 'total' ) => '',
							__( 'iFrame', 'total' ) => 'iframe',
							__( 'Image', 'total' ) => 'image',
							__( 'Video', 'total' ) => 'video_embed',
							__( 'HTML5', 'total' ) => 'html5',
							__( 'Quicktime', 'total' ) => 'quicktime',
						),
						'description' => esc_html__( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'total' ),
						'group' => esc_html__( 'Lightbox', 'total' ),
						'dependency' => array( 'element' => 'onclick', 'value' => 'lightbox' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'HTML5 Webm URL', 'total' ),
						'param_name' => 'lightbox_video_html5_webm',
						'description' => esc_html__( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'total' ),
						'group' => esc_html__( 'Lightbox', 'total' ),
						'dependency' => array( 'element' => 'lightbox_type', 'value' => 'html5' ),
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Lightbox HTML5 Poster Image', 'total' ),
						'param_name' => 'lightbox_poster_image',
						'dependency' => array( 'element' => 'lightbox_type', 'value' => 'html5' ),
						'group' => esc_html__( 'Lightbox', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Lightbox Dimensions', 'total' ),
						'param_name' => 'lightbox_dimensions',
						'description' => esc_html__( 'Enter a custom width and height for your lightbox pop-up window. Use format widthxheight. Example: 900x600.', 'total' ),
						'group' => esc_html__( 'Lightbox', 'total' ),
						'dependency' => array( 'element' => 'onclick', 'value' => 'lightbox' ),
					),
					//Icons
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Icon library', 'total' ),
						'param_name' => 'icon_type',
						'description' => esc_html__( 'Select icon library.', 'total' ),
						'std' => 'fontawesome',
						'value' => array(
							__( 'Font Awesome', 'total' ) => 'fontawesome',
							__( 'Open Iconic', 'total' ) => 'openiconic',
							__( 'Typicons', 'total' ) => 'typicons',
							__( 'Entypo', 'total' ) => 'entypo',
							__( 'Linecons', 'total' ) => 'linecons',
							__( 'Pixel', 'total' ) => 'pixelicons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left',
						'admin_label' => true,
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'openiconic',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'openiconic',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'typicons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left_entypo',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'linecons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Left', 'total' ),
						'param_name' => 'icon_left_pixelicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right',
						'admin_label' => true,
						'settings' => array(
							'emptyIcon' => true,
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right_openiconic',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'openiconic',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'openiconic',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right_typicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'typicons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'typicons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right_entypo',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'entypo',
							'iconsPerPage' => 300,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'entypo',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right_linecons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'linecons',
							'iconsPerPage' => 200,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'linecons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon Right', 'total' ),
						'param_name' => 'icon_right_pixelicons',
						'settings' => array(
							'emptyIcon' => true,
							'type' => 'pixelicons',
							'source' => vcex_pixel_icons(),
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'pixelicons',
						),
						'group' => esc_html__( 'Icons', 'total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Left Icon: Right Padding', 'total' ),
						'param_name' => 'icon_left_padding',
						'group' => esc_html__( 'Icons', 'total' ),
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Right Icon: Left Padding', 'total' ),
						'param_name' => 'icon_right_padding',
						'group' => esc_html__( 'Icons', 'total' ),
					),
					// Design options
					array(
						'type' => 'css_editor',
						'heading' => esc_html__( 'CSS', 'total' ),
						'param_name' => 'css_wrap',
						'group' => esc_html__( 'CSS', 'total' ),
					),
					// Deprecated
					array( 'type' => 'hidden', 'param_name' => 'lightbox' ),
					array( 'type' => 'hidden', 'param_name' => 'lightbox_image' ),
				)
			);
		}

		/**
		 * Update fields on edit
		 *
		 * @since 3.5.0
		 */
		public function edit_form_fields( $atts ) {
			if ( ! empty( $atts['lightbox_image'] ) ) {
				$atts['image_attachment'] = $atts['lightbox_image'];
				unset( $atts['lightbox_image'] );
			}
			if ( isset( $atts['lightbox'] ) && 'true' == $atts['lightbox'] ) {
				$atts['onclick'] = 'lightbox';
			}
			return $atts;
		}


	}

}
new VCEX_Button_Shortcode;