<?php
/**
 * Visual Composer Row Configuration
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Global var for class
global $vcex_column_config;

// Start Class
if ( ! class_exists( 'VCEX_VC_Column_Config' ) ) {
	
	class VCEX_VC_Column_Config {

		/**
		 * Main constructor
		 *
		 * @since 2.0.0
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'add_params' ) );
			add_filter( 'vc_edit_form_fields_attributes_vc_column', array( $this, 'edit_form_fields') );
			add_filter( 'vc_edit_form_fields_attributes_vc_column_inner', array( $this, 'edit_form_fields') );
		}

		/**
		 * Adds new params for the VC Rows
		 *
		 * @since 2.0.0
		 */
		public function add_params() {

			/*-----------------------------------------------------------------------------------*/
			/*  - Columns
			/*-----------------------------------------------------------------------------------*/
			vc_add_param( 'vc_column', array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Visibility', 'total' ),
				'param_name' => 'visibility',
				'std'        => '',
				'value'      => array_flip( wpex_visibility() ),
			) );

			vc_add_param( 'vc_column', array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Animation', 'total' ),
				'param_name' => 'css_animation',
				'value'      => array_flip( wpex_css_animations() ),
			) );

			vc_add_param( 'vc_column', array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Typography Style', 'total' ),
				'param_name' => 'typography_style',
				'value'      => array_flip( wpex_typography_styles() ),
			) );

			vc_add_param( 'vc_column', array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Minimum Height', 'total' ),
				'param_name'  => 'min_height',
				'description' => esc_html__( 'You can enter a minimum height for this row.', 'total' ),
			) );

			// Hidden fields = Deprecated params, these should be removed on save
			$deprecated = array(
				'id',
				'style',
				'typo_style',
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
				'drop_shadow',
			);
			foreach ( $deprecated as $key => $val ) {
				vc_add_param( 'vc_column', array(
					'type'       => 'hidden',
					'param_name' => $val,
				) );
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Inner Columns
			/*-----------------------------------------------------------------------------------*/
			vc_add_param( 'vc_column_inner', array(
				'type'       => 'hidden',
				'param_name' => 'style',
			) );

			// Hidden fields = Deprecated params, these should be removed on save
			$deprecated = array(
				'id',
				'typo_style',
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
			);
			foreach ( $deprecated as $key => $val ) {
				vc_add_param( 'vc_column_inner', array(
					'type'       => 'hidden',
					'param_name' => $val,
				) );
			}

		}

		/**
		 * Tweaks row attributes on edit
		 *
		 * @since 3.0.0
		 */
		public function edit_form_fields( $atts ) {

			// Parse ID
			if ( empty( $atts['el_id'] ) && ! empty( $atts['id'] ) ) {
				$atts['el_id'] = $atts['id'];
				unset( $atts['id'] );
			}

			// Parse $typo_style into $typography_style
			if ( empty( $atts['typography_style'] ) && ! empty( $atts['typo_style'] ) ) {
				if ( in_array( $atts['typo_style'], array_flip( wpex_typography_styles() ) ) ) {
					$atts['typography_style'] = $atts['typo_style'];
					unset( $atts['typo_style'] );
				}
			}

			// Remove old style param and add it to the classes field
			$style = isset( $atts['style'] ) ? $atts['style'] : '';
			if ( $style && ( 'bordered' == $style || 'boxed' == $style ) ) {
				if ( ! empty( $atts['el_class'] ) ) {
					$atts['el_class'] .= ' '. $style .'-column';
				} else {
					$atts['el_class'] = $style .'-column';
				}
				unset( $atts['style'] );
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
$vcex_column_config = new VCEX_VC_Column_Config();