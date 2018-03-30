<?php
/**
 * Visual Composer Row Configuration
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Global var for class
global $vcex_vc_row_config;

// Start Class
if ( ! class_exists( 'VCEX_VC_Row_Config' ) ) {
	
	class VCEX_VC_Row_Config {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {

			// Update default params on map
			if ( is_admin() ) {
				add_action( 'vc_after_init', array( $this, 'update_params' ) );
			}

			// Add new parameters to the row
			add_action( 'init', array( $this, 'add_remove_params' ) );

			// Edit row fields on open
			add_filter( 'vc_edit_form_fields_attributes_vc_row', array( $this, 'edit_form_fields') );

		}

		/**
		 * Used to update default parms
		 *
		 * @since 3.0.0
		 */
		public function update_params() {

			// Save re-usable strings in var
			$parallax_tab = esc_html__( 'Parallax', 'total' );
			$s_video      = esc_html__( 'Video', 'total' );

			// Set ID weight
			$param = WPBMap::getParam( 'vc_row', 'el_id' );
			if ( $param ) {
				$param['weight'] = 99;
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Set class weight
			$param = WPBMap::getParam( 'vc_row', 'el_class' );
			if ( $param ) {
				$param['weight'] = 98;
				$time_start = microtime( true );
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Move video parallax setting
			$param = WPBMap::getParam( 'vc_row', 'video_bg_parallax' );
			if ( $param ) {
				$param['group'] = $s_video;
				$param['dependency'] = array(
					'element' => 'video_bg',
					'value' => 'youtube',
				);
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Move youtube url
			$param = WPBMap::getParam( 'vc_row', 'video_bg_url' );
			if ( $param ) {
				$param['group'] = $s_video;
				$param['dependency'] = array(
					'element' => 'video_bg',
					'value' => 'youtube',
				);
				vc_update_shortcode_param( 'vc_row', $param );
			}
			$param = WPBMap::getParam( 'vc_row', 'parallax_speed_video' );
			if ( $param ) {
				$param['group'] = $s_video;
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Alter Parallax dropdown
			$param = WPBMap::getParam( 'vc_row', 'parallax' );
			if ( $param ) {
				$param['group'] = $parallax_tab;
				$param['value'][ esc_html__( 'Advanced Parallax', 'total' ) ] = 'vcex_parallax';
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Alter Parallax image location
			$param = WPBMap::getParam( 'vc_row', 'parallax_image' );
			if ( $param ) {
				$param['group'] = $parallax_tab;
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Alter Parallax speed location
			$param = WPBMap::getParam( 'vc_row', 'parallax_speed_bg' );
			if ( $param ) {
				$param['group'] = $parallax_tab;
				$param['dependency'] = array(
					'element' => 'parallax',
					'value' => array( 'content-moving', 'content-moving-fade' ),
				);
				vc_update_shortcode_param( 'vc_row', $param );
			}

			// Move design options
			$param = WPBMap::getParam( 'vc_row', 'css' );
			if ( $param ) {
				$param['weight'] = -1;
				vc_update_shortcode_param( 'vc_row', $param );
			}

		}

		/**
		 * Adds new params for the VC Rows
		 *
		 * @since 2.0.0
		 */
		public function add_remove_params() {

			// Save re-usable strings in var
			$s_video = esc_html__( 'Video', 'total' );
			$s_no    = esc_html__( 'No', 'total' );
			$s_yes   = esc_html__( 'Yes', 'total' );

			// Remove params that don't work because of the VC negative margin fix :(
			vc_remove_param( 'vc_row', 'gap' );
			vc_remove_param( 'vc_row', 'equal_height' );
			vc_remove_param( 'vc_row', 'content_placement' );

			vc_remove_param( 'vc_row_inner', 'gap' );
			vc_remove_param( 'vc_row_inner', 'equal_height' );
			vc_remove_param( 'vc_row_inner', 'content_placement' );

			// Array of params to add
			$add_params = array();

			$add_params['local_scroll_id'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Local Scroll ID', 'total' ),
				'param_name' => 'local_scroll_id',
				'description' => esc_html__( 'Unique identifier for local scrolling links.', 'total' ),
				'weight' => 99,
			);

			$add_params['min_height'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Minimum Height', 'total' ),
				'description' => esc_html__( 'Adds a minimum height to the row so you can have a row without any content but still display it at a certain height. Such as a background with a video or image background but without any content.', 'total' ),
				'param_name' => 'min_height',
			);

			$add_params['visibility'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Visibility', 'total' ),
				'param_name' => 'visibility',
				'value' => array_flip( wpex_visibility() ),
			);

			$add_params['center_row'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Center Row Content', 'total' ),
				'param_name' => 'center_row',
				'value' => array(
					$s_no => 'no',
					$s_yes => 'yes',
				),
				'dependency' => array( 'element' => 'full_width', 'is_empty' => true ),
				'description' => esc_html__( 'Use this option to center the inner content (Horizontally). Only used for "Full Screen" layouts.', 'total' ),
			);

			$add_params['match_column_height'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Equal Column Heights', 'total' ),
				'param_name' => 'match_column_height',
				'value' => array(
					$s_no => '',
					$s_yes => 'yes',
				),
			);

			$add_params['css_animation'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Animation', 'total' ),
				'param_name' => 'css_animation',
				'value' => array_flip( wpex_css_animations() ),
			);

			$add_params['typography_style'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Typography Style', 'total' ),
				'param_name' => 'typography_style',
				'value' => array_flip( wpex_typography_styles() ),
			);

			$add_params['max_width'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Max Width', 'total' ),
				'param_name' => 'max_width',
				'value' => array(
					esc_html__( 'None', 'total' ) => '',
					'10%' => '10',
					'20%' => '20',
					'30%' => '30',
					'40%' => '40',
					'50%' => '50',
					'60%' => '60',
					'70%' => '70',
					'80%' => '80',
				),
				'dependency' => array( 'element' => 'full_width', 'is_empty' => true ),
			);

			$add_params['column_spacing'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Spacing Between Columns', 'total' ),
				'param_name' => 'column_spacing',
				'value' => array(
					esc_html__( 'Default', 'total' ) => '',
					'0px' => '0px',
					'1px' => '1',
					'5px' => '5',
					'10px' => '10',
					'20px' => '20',
					'30px' => '30',
					'40px' => '40',
					'50px' => '50',
					'60px' => '60',
				),
			);
			$add_params['tablet_fullwidth_cols'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Full-Width Columns On Tablets', 'total' ),
				'param_name' => 'tablet_fullwidth_cols',
				'value' => array(
					$s_no => '',
					$s_yes => 'yes',
				),
				'description' => esc_html__( 'Check this box to make all columns inside this row full-width for tablets.', 'total' ),
			);

			// Parallax
			$add_params['parallax_mobile'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Enable parallax for mobile devices', 'total' ),
				'param_name' => 'parallax_mobile',
				'value' => array(
					$s_no => '',
					$s_yes => 'on',
				),
				'description' => esc_html__( 'Parallax effects would most probably cause slowdowns when your site is viewed in mobile devices. By default it is disabled.', 'total' ),
				'group' => esc_html__( 'Parallax', 'total' ),
				'dependency' => array(
					'element' => 'parallax',
					'value' => 'vcex_parallax',
				),
			);
			$add_params['parallax_style'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Parallax Style', 'total' ),
				'param_name' => 'parallax_style',
				'group' => esc_html__( 'Parallax', 'total' ),
				'value' => array(
					esc_html__( 'Cover', 'total' ) => '',
					esc_html__( 'Fixed and Repeat', 'total' ) => 'fixed-repeat',
					esc_html__( 'Fixed and No-Repeat', 'total' ) => 'fixed-no-repeat',
				),
				'dependency' => array(
					'element' => 'parallax',
					'value' => 'vcex_parallax',
				),
			);
			$add_params['parallax_direction'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Parallax Direction', 'total' ),
				'param_name' => 'parallax_direction',
				'value' => array(
					esc_html__( 'Up', 'total' ) => '',
					esc_html__( 'Down', 'total' ) => 'down',
					esc_html__( 'Left', 'total' ) => 'left',
					esc_html__( 'Right', 'total' ) => 'right',
				),
				'group' => esc_html__( 'Parallax', 'total' ),
				'dependency' => array(
					'element' => 'parallax',
					'value' => 'vcex_parallax',
				),
			);
			$add_params['parallax_speed'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Parallax Speed', 'total' ),
				'param_name' => 'parallax_speed',
				'description' => esc_html__( 'The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Be mindful of the background size and the dimensions of your background image when setting this value. Faster scrolling means that the image will move faster, make sure that your background image has enough width or height for the offset.', 'total' ),
				'group' => esc_html__( 'Parallax', 'total' ),
				'dependency' => array(
					'element' => 'parallax',
					'value' => 'vcex_parallax',
				),
			);

			// Video
			$add_params['video_bg'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Video Background?', 'total' ),
				'param_name' => 'video_bg',
				'description' => esc_html__( 'Check this box to enable the options for a self hosted video background.', 'total' ),
				'value' => array(
					esc_html__( 'None', 'total' ) => '',
					esc_html__( 'Youtube', 'total' ) => 'youtube',
					esc_html__( 'Self Hosted', 'total' ) => 'self_hosted',
				),
				'group' => $s_video,
			);
			$add_params['video_bg_mp4'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video URL: MP4 URL', 'total' ),
				'param_name' => 'video_bg_mp4',
				'dependency' => array(
					'element' => 'video_bg',
					'value' => 'self_hosted',
				),
				'group' => $s_video,
			);
			$add_params['video_bg_webm'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video URL: WEBM URL', 'total' ),
				'param_name' => 'video_bg_webm',
				'dependency' => array(
					'element' => 'video_bg',
					'value' => 'self_hosted',
				),
				'group' => $s_video,
			);
			$add_params['video_bg_ogv'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video URL: OGV URL', 'total' ),
				'param_name' => 'video_bg_ogv',
				'dependency' => array(
					'element' => 'video_bg',
					'value' => 'self_hosted',
				),
				'group' => $s_video,
			);
			$add_params['wpex_bg_overlay'] = array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Overlay', 'total' ),
				'param_name' => 'wpex_bg_overlay',
				'group' => esc_html__( 'Overlay', 'total' ),
				'value' => array(
					esc_html__( 'None', 'total' ) => '',
					esc_html__( 'Color', 'total' ) => 'color',
					esc_html__( 'Dark', 'total' ) => 'dark',
					esc_html__( 'Dotted', 'total' ) => 'dotted',
					esc_html__( 'Diagonal Lines', 'total' ) => 'dashed',
				),
			);
			$add_params['wpex_bg_overlay_color'] = array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Overlay Color', 'total' ),
				'param_name' => 'wpex_bg_overlay_color',
				'group' => esc_html__( 'Overlay', 'total' ),
				'dependency' => array( 'element' => 'wpex_bg_overlay', 'value' => array( 'color', 'dark', 'dotted', 'dashed' ) ),
			);
			$add_params['wpex_bg_overlay_opacity'] = array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Background Overlay Opacity', 'total' ),
				'param_name' => 'wpex_bg_overlay_opacity',
				'dependency' => array( 'element' => 'wpex_bg_overlay', 'value' => array( 'color', 'dark', 'dotted', 'dashed' ) ),
				'group' => esc_html__( 'Overlay', 'total' ),
				'description' => '0.65',
			);

			// Apply filters for child theming
			$add_params = apply_filters( 'wpex_vc_row_custom_params', $add_params );

			// Loop through array and add new params
			foreach( $add_params as $key => $val ) {
				vc_add_param( 'vc_row', $val );
			}

			// Hidden fields = Deprecated params, these should be removed on save
			$deprecated = array(
				'id',
				'style',
				'bg_color',
				'bg_image',
				'bg_style',
				'border_style',
				'border_color',
				'border_width',
				'margin_top',
				'margin_bottom',
				'margin_left',
				'padding_top',
				'padding_bottom',
				'padding_left',
				'padding_right',
				'no_margins',
				'video_bg_overlay',
			);
			foreach ( $deprecated as $key => $val ) {
				vc_add_param( 'vc_row', array(
					'type' => 'hidden',
					'param_name' => $val,
				) );
			}

		}

		/**
		 * Tweaks row attributes on edit
		 *
		 * @since 2.0.2
		 */
		public function edit_form_fields( $atts ) {

			// Parse ID
			if ( empty( $atts['el_id'] ) && ! empty( $atts['id'] ) ) {
				$atts['el_id'] = $atts['id'];
				unset( $atts['id'] );
			}

			// Parse $style into $typography_style
			if ( empty( $atts['typography_style'] ) && ! empty( $atts['style'] ) ) {
				if ( in_array( $atts['style'], array_flip( wpex_typography_styles() ) ) ) {
					$atts['typography_style'] = $atts['style'];
					unset( $atts['style'] );
				}
			}

			// Parse parallax
			if ( ! empty( $atts['parallax'] ) ) {
				if ( in_array( $atts['parallax'], array( 'simple', 'advanced', 'true' ) ) ) {
					$atts['parallax'] = 'vcex_parallax';
				}
			} elseif ( empty( $atts['parallax'] ) && ! empty( $atts['bg_style'] ) ) {
				if ( 'parallax' == $atts['bg_style'] || 'parallax-advanced' == $atts['bg_style'] ) {
					$atts['parallax'] = 'vcex_parallax';
					unset( $atts['bg_style'] );
				}
			}

			// Parse video background
			if ( ! empty( $atts['video_bg'] ) && 'yes' == $atts['video_bg'] ) {
				$atts['video_bg'] = 'self_hosted';
			}

			// Convert 'no-margins' to '0px' column_spacing
			if ( empty( $atts['column_spacing'] ) && ! empty( $atts['no_margins'] ) && 'true' == $atts['no_margins'] ) {
				$atts['column_spacing'] = '0px';
				unset( $atts['no_margins'] );
			}

			// Convert video overlay to just overlay
			if ( ! empty( $atts['video_bg_overlay'] ) && 'none' != $atts['video_bg_overlay'] ) {
				$atts['wpex_bg_overlay'] = $atts['video_bg_overlay'];
				unset( $atts['video_bg_overlay'] );
			}

			// Parse css
			if ( empty( $atts['css'] ) ) {

				// Convert deprecated fields to css field
				$atts['css'] = vcex_parse_deprecated_row_css( $atts );

				// Unset deprecated vars
				unset( $atts['bg_image'] );
				unset( $atts['bg_color'] );

				unset( $atts['margin_top'] );
				unset( $atts['margin_bottom'] );
				unset( $atts['margin_right'] );
				unset( $atts['margin_left'] );

				unset( $atts['padding_top'] );
				unset( $atts['padding_bottom'] );
				unset( $atts['padding_right'] );
				unset( $atts['padding_left'] );

				unset( $atts['border_width'] );
				unset( $atts['border_style'] );
				unset( $atts['border_color'] );

			}

			// Return $atts
			return $atts;

		}

	}

}
$vcex_vc_row_config = new VCEX_VC_Row_Config();