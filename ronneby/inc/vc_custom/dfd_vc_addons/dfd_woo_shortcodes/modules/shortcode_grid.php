<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
@Module: Grid Layout view
@Since: 1.0
@Package: WooComposer
*/
if(!class_exists('Dfd_Woo_Products_Grid')){
	class Dfd_Woo_Products_Grid
	{
		function __construct(){
			add_action('init',array($this,'woocomposer_init_grid'));
			add_shortcode('woocomposer_grid',array($this,'woocomposer_grid_shortcode'));
		} /* end constructor */
		function woocomposer_init_grid(){
			global $dfd_ronneby;
			if(function_exists('vc_map')){
				vc_map(
					array(
						'name'		=> esc_html__('Products Grid', 'dfd'),
						'base'		=> 'woocomposer_grid',
						'icon'		=> 'woo_grid',
						'class'	   => 'woo_grid',
						'category'  => esc_html__('WooComposer', 'dfd'),
						'description' => 'Display products in grid view',
						'controls' => 'full',
						'wrapper_class' => 'clearfix',
						'show_settings_on_create' => true,
						'params' => array(
							array(
								'type' => 'woocomposer',
								'class' => '',
								'heading' => esc_html__('Query Builder', 'dfd'),
								'param_name' => 'shortcode',
								'value' => '',
								'module' => 'grid',
								'labels' => array(
										'products_from'		=> esc_attr__('Display:','dfd'),
										'per_page'			=> esc_attr__('How Many:','dfd'),
										'columns'			=> esc_attr__('Columns:','dfd'),
										'order_by'			=> esc_attr__('Order By:','dfd'),
										'order'				=> esc_attr__('Loop Order:','dfd'),
										'category'			=> esc_attr__('Category:','dfd'),
								),
							),
							array(
								'type' => 'radio_image_select',
								'class' => '',
								'heading' => esc_html__('Select Products Style', 'dfd'),
								'param_name' => 'products_style',
								'simple_mode' => false,
								'admin_label' => true,
								'options'     => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Simple','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_list/style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Advanced','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_list/style-2.png'
									),
									'style-3' => array(
										'tooltip' => esc_attr__('Full','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_list/style-3.png'
									),
								),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Excerpt length', 'dfd'),
								'param_name' => 'excerpt_length',
								'value' => '',
								//'edit_field_class' => 'vc_column vc_col-sm-12,'
								'dependency' => Array('element' => 'products_style', 'value' => array('style-2','style-3')),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Information Alignment', 'dfd'),
								'param_name' => 'content_alignment',
								'value' => array(
									esc_attr__('Center', 'dfd') => 'text-center',
									esc_attr__('Left', 'dfd') => 'text-left',
									esc_attr__('Right', 'dfd') => 'text-right'
								),
								'group' => esc_attr__('Style Settings','dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Mask style', 'dfd'),
								'param_name' => 'mask_style',
								'value' => array(
									__('Theme default', 'dfd') => '',
									__('Simple color', 'dfd') => 'color',
									__('Gradient', 'dfd') => 'gradient',
								),
								'dependency' => Array('element' => 'products_style', 'value' => array('style-2','style-3')),
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Mask color', 'dfd'),
								'param_name' => 'mask_color',
								'value' => '',
								'dependency' => Array('element' => 'mask_style', 'value' => array('color')),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type' => 'gradient',
								'param_name' => 'mask_gradient',
								'class' => '',
								'heading' => esc_html__('Mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'mask_style','value' => array('gradient')),
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Mask opacity', 'dfd'),
								'param_name' => 'mask_opacity',
								'value' => .8,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'mask_style','value' => array('gradient')),
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type'				=> 'dropdown',
								'class'				=> '',
								'heading'			=> esc_html__( 'Animation', 'dfd' ),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
								'description'		=> esc_html__( '', 'dfd' ),
							),
						)/* vc_map params array */
					)/* vc_map parent array */ 
				); /* vc_map call */ 
			} /* vc_map function check */
			if((!isset($dfd_ronneby['dfd_woocommerce_templates_path']) || $dfd_ronneby['dfd_woocommerce_templates_path'] != '_old') && function_exists('vc_add_param')) {
				vc_add_param('woocomposer_grid',array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => esc_html__('Buttons color scheme', 'dfd'),
					'param_name' => 'buttons_color_scheme',
					'admin_label' => true,
					'value' => array(
							esc_attr__('Inherit from theme options','dfd') => '',
							esc_attr__('Dark','dfd') => 'dfd-buttons-dark',
							esc_attr__('Light','dfd') => 'dfd-buttons-light',
						),
					'description' => __('Defines buttons color scheme if buttons are enabled', 'dfd'),
					'group' => esc_attr__('Style Settings','dfd'),
				));
			}
		} /* end woocomposer_init_grid */
		function woocomposer_grid_shortcode($atts){
			extract(shortcode_atts(array(
				'product_style' => '',
				'module_animation' => '',
			),$atts));
			$output = '';
			$uid = uniqid();
			
			$animate = $animation_data = '';
			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = ' data-animate-item=".prod-wrap" data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$output = '<div id="woo-grid-'.esc_attr($uid).'" class="woocomposer_grid '.esc_attr($animate).'" '.$animation_data.'>';
			
			require_once('design-loop.php');
			$output .= Dfd_Woocommerce_Loop_module($atts);
			$output .= '</div>';
			return $output;
		}/* end woocomposer_grid_shortcode */
	} /* end class GridView */
	new Dfd_Woo_Products_Grid;
}