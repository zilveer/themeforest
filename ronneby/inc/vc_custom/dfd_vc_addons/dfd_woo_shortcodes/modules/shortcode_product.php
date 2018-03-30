<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
@Module: Single Product view
@Since: 1.0
@Package: WooComposer
*/
if(!class_exists('Dfd_Woo_Sinle_Product')){
	class Dfd_Woo_Sinle_Product
	{
		function __construct(){
			add_action('init',array($this,'WooComposer_Init_Product'));
			add_shortcode('woocomposer_product',array($this,'WooComposer_Product'));
		} 
		function WooComposer_Init_Product(){
			if(function_exists('vc_map')){
				global $dfd_ronneby;
				$params =
					array(
						'name'		=> __('Single Product', 'dfd'),
						'base'		=> 'woocomposer_product',
						'icon'		=> 'woo_product',
						'class'	   => 'woo_product',
						'category'  => __('WooComposer', 'dfd'),
						'description' => 'Display single product from list',
						'controls' => 'full',
						'show_settings_on_create' => true,
						'params' => array(
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'General settings', 'dfd' ),
								'param_name'       => 'general_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('General','dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'class' => '',
								'heading' => __('Select Product Style', 'dfd'),
								'param_name' => 'product_style',
								'admin_label' => true,
								'simple_mode' => false,
								'options'     => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Simple product','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_single/style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Full width image hover description','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_single/style-2.png'
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'description' => '',
								'group' => esc_html__('General','dfd'),
							),
							array(
								'type' => 'product_search',
								'class' => '',
								'heading' => __('Select Product', 'dfd'),
								'param_name' => 'product_id',
								'admin_label' => true,
								'value' => '',
								'description' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('General','dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer'),
								'group' => esc_html__('General','dfd'),
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => __( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'description' => __( '', 'dfd' ),
								'group'       => esc_html__('General','dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Image settings', 'dfd' ),
								'param_name'       => 'image_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Enable product image', 'dfd'),
								'param_name' => 'enable_product_image',
								'value' => array(
									__('No', 'dfd') => '',
									__('Yes', 'dfd') => 'yes',
								),
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Select Product Image', 'dfd'),
								'param_name' => 'image_selector',
								'admin_label' => true,
								'value' => array(
										__('Product thumbnail','dfd') => 'thumb',
										__('Custom uploaded image','dfd') => 'custom_image',
									),
								'description' => __('', 'dfd'),
								'dependency' => Array('element' => 'enable_product_image', 'value' => array('yes')),
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Custom product image','dfd'),
								'param_name' => 'custom_image',
								'value' => '',
								'description' => __('Upload the custom product image','dfd'),
								'dependency' => Array('element' => 'image_selector', 'value' => array('custom_image')),
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => '',
								'min' => 0,
								'max' => 1920,
								'suffix' => 'px',
								'description' => __('', 'dfd'),
								'dependency' => Array('element' => 'enable_product_image', 'value' => array('yes')),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => '',
								'min' => 0,
								'max' => 1920,
								'suffix' => 'px',
								'description' => __('', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'enable_product_image', 'value' => array('yes')),
								'group' => esc_html__('Image Settings','dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content settings', 'dfd' ),
								'param_name'       => 'content_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Product Title','dfd'),
								'param_name' => 'enable_title',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Subtitle','dfd'),
								'param_name' => 'enable_cat_tag',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Rating','dfd'),
								'param_name' => 'enable_rating',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Price','dfd'),
								'param_name' => 'enable_price',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Description','dfd'),
								'param_name' => 'enable_description',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Add to Cart','dfd'),
								'param_name' => 'enable_add_to_cart',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Wishlist','dfd'),
								'param_name' => 'enable_wishlist',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Enable Lightbox','dfd'),
								'param_name' => 'enable_quick_view',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Show Add to cart without hover','dfd'),
								'param_name' => 'enable_button_default',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								//'value' => array('Yes, please' => 'yes'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'product_style', 'value' => array('style-1')),
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Description limit (words)', 'dfd'),
								'param_name' => 'desc_limit',
								'value' => '',
								'min' => 0,
								'max' => 55,
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'enable_description', 'value' => array('yes')),
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Information Alignment', 'dfd'),
								'param_name' => 'info_alignment',
								'value' => array(
									__('Left', 'dfd') => 'text-left',
									__('Center', 'dfd') => 'text-center',
									__('Right', 'dfd') => 'text-right'
								),
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Price position', 'dfd'),
								'param_name' => 'price_position',
								'value' => array(
									__('In heading', 'dfd') => 'top',
									__('In description', 'dfd') => 'bottom',
								),
								'dependency' => Array('element' => 'product_style', 'value' => array('style-1')),
								'group' => esc_html__('Content','dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title typography settings', 'dfd' ),
								'param_name'       => 'title_typography_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'dependency' => Array('element' => 'enable_title', 'value' => array('yes')),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Subtitle typography settings', 'dfd' ),
								'param_name'       => 'subtitle_typography_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'subtitle_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'dependency' => Array('element' => 'enable_cat_tag', 'value' => array('yes')),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Custom style settings', 'dfd' ),
								'param_name'       => 'style_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Style Settings','dfd'),
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
								'dependency' => Array('element' => 'product_style', 'value' => array('style-2')),
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
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Background', 'dfd'),
								'param_name' => 'background_color',
								'value' => '',
								'dependency' => Array('element' => 'product_style', 'value' => array('style-1')),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Product Description Text Color', 'dfd'),
								'param_name' => 'color_product_desc',
								'value' => '',
								'description' => __('', 'dfd'),
								'dependency' => Array('element' => 'enable_description', 'value' => array('yes')),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
							),							
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Price', 'dfd'),
								'param_name' => 'size_price',
								'value' => '',
								'min' => 10,
								'max' => 72,
								'suffix' => 'px',
								'group' => esc_html__('Style Settings','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'enable_price', 'value' => array('yes')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Price Color', 'dfd'),
								'param_name' => 'color_price',
								'value' => '',
								'group' => esc_html__('Style Settings','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'enable_price', 'value' => array('yes')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Star Ratings Color', 'dfd'),
								'param_name' => 'color_rating',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
								'dependency' => Array('element' => 'enable_rating', 'value' => array('yes')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Star Rating Background Color', 'dfd'),
								'param_name' => 'color_rating_bg',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
								'dependency' => Array('element' => 'enable_rating', 'value' => array('yes')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Sale Notification Text Color', 'dfd'),
								'param_name' => 'color_on_sale',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Sale Notification Background Color', 'dfd'),
								'param_name' => 'color_on_sale_bg',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Style Settings','dfd'),
							),
						)
					);
				
				vc_map($params);
				
				if(!isset($dfd_ronneby['dfd_woocommerce_templates_path']) || $dfd_ronneby['dfd_woocommerce_templates_path'] != '_old' && function_exists('vc_add_param')) {
					vc_add_param('woocomposer_product',array(
						'type' => 'dropdown',
						'class' => '',
						'heading' => __('Buttons color scheme', 'dfd'),
						'param_name' => 'buttons_color_scheme',
						'admin_label' => true,
						'value' => array(
								__('Dark','dfd') => 'dfd-buttons-dark',
								__('Light','dfd') => 'dfd-buttons-light',
							),
						'description' => __('Defines buttons color scheme if buttons are enabled', 'dfd'),
						'group' => 'Style Settings',
					));
				}
			}
		} 
		function WooComposer_Product($atts){
			extract($atts);
			
			$output = '';
			
			/*ob_start();
			$output .= '<div class="woocommerce woo-msg">';
			wc_print_notices();
			$output .= ob_get_clean();
			$output .= '</div>';*/
			
			require_once('design-single.php');
			$output .= Dfd_WooComposer_Single($atts);
			
			return $output;
						
		} 
	}
	new Dfd_Woo_Sinle_Product;
}