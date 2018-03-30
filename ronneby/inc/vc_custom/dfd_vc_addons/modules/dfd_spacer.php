<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Spacer
*/

if(!class_exists('Dfd_Spacer')) {

	class Dfd_Spacer {
		
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_spacer_init' ) );
			add_shortcode( 'dfd_spacer', array( &$this, 'dfd_spacer_shortcode' ) );
		}

		function dfd_spacer_init() {
			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => esc_html__( 'Spacer', 'dfd' ),
						'base'        => 'dfd_spacer',
						'class'		  => 'vc_ultimate_spacer',
						'icon'		  => 'vc_ultimate_spacer',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Spacer module', 'dfd' ),
						'params'      => array(
							array(
								'type' => 'ult_param_heading',
								'text' => __('Units', 'dfd'),
								'param_name' => 'sizing',
								'class' => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Spacer units','dfd'),
								'param_name' => 'units',
								'value' => array(
										__('Pixel', 'dfd') => 'px',
										__('Percent', 'dfd') => '%',
									),
								//'description' => __('','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-12'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Wide desktop', 'dfd'),
								'param_name' => 'sizing_wide',
								'class' => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Screen resolution', 'dfd'),
								'param_name' => 'screen_wide_resolution',
								'value' => 1280,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Spacer size (large)', 'dfd'),
								'param_name' => 'screen_wide_spacer_size',
								'value' => 10,
								'admin_label' => true,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Medium desktop', 'dfd'),
								'param_name' => 'sizing_normal',
								'class' => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Screen resolution', 'dfd'),
								'param_name' => 'screen_normal_resolution',
								'value' => 1024,
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Spacer size (medium)', 'dfd'),
								'admin_label' => true,
								'param_name' => 'screen_normal_spacer_size',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Tablets', 'dfd'),
								'param_name' => 'sizing_tablet',
								'class' => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Screen resolution', 'dfd'),
								'param_name' => 'screen_tablet_resolution',
								'value' => 800,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Spacer size (tabs)', 'dfd'),
								'admin_label' => true,
								'param_name' => 'screen_tablet_spacer_size',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Mobile phones', 'dfd'),
								'param_name' => 'sizing_mobile',
								'class' => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Screen resolution', 'dfd'),
								'param_name' => 'screen_mobile_resolution',
								'value' => 480,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Spacer size (mobiles)', 'dfd'),
								'admin_label' => true,
								'param_name' => 'screen_mobile_spacer_size',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc '
							),
						)
					)
				);
			}
		}

		function dfd_spacer_shortcode( $atts, $content = null ) {
			$output = $data_atts = $units = $screen_wide_resolution = $screen_wide_spacer_size = $screen_normal_resolution = $screen_normal_spacer_size = $screen_tablet_resolution = $screen_tablet_spacer_size = $screen_mobile_resolution = $screen_mobile_spacer_size = '';

			/*
			extract( shortcode_atts( array(
				'units'						=> 'px',
				'screen_wide_resolution'	=> 1280,
				'screen_wide_spacer_size'	=> 10,
				'screen_normal_resolution'	=> 1024,
				'screen_normal_spacer_size'	=> '',
				'screen_tablet_resolution'	=> 800,
				'screen_tablet_spacer_size'	=> '',
				'screen_mobile_resolution'	=> 480,
				'screen_mobile_spacer_size'	=> '',
			), $atts ) );
			*/
			
			$atts = vc_map_get_attributes( 'dfd_spacer', $atts );
			extract( $atts );
			
			// =  =  =  =  =  =  = $screen_mobile_resolution
			$data_atts .= ' data-units="'.esc_attr($units).'"';
			
			$data_atts .= ' data-wide_resolution="'.esc_attr($screen_wide_resolution).'"';
			
			$data_atts .= ' data-wide_size="'.esc_attr($screen_wide_spacer_size).'"';
			
			$data_atts .= ' data-normal_resolution="'.esc_attr($screen_normal_resolution).'"';
			
			$data_atts .= ' data-normal_size="'.esc_attr($screen_normal_spacer_size).'"';
			
			$data_atts .= ' data-tablet_resolution="'.esc_attr($screen_tablet_resolution).'"';
			
			$data_atts .= ' data-tablet_size="'.esc_attr($screen_tablet_spacer_size).'"';
			
			$data_atts .= ' data-mobile_resolution="'.esc_attr($screen_mobile_resolution).'"';
			
			$data_atts .= ' data-mobile_size="'.esc_attr($screen_mobile_spacer_size).'"';
			
			$output .= '<div class="dfd-spacer-module" '.$data_atts.' style="height: '.esc_attr($screen_wide_spacer_size).'px;"></div>';
						
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Spacer' ) ) {
	$Dfd_Spacer = new Dfd_Spacer;
}