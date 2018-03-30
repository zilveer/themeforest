<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Pricing Tables for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Ultimate_Pricing_Table')){
	class Ultimate_Pricing_Table{
		function __construct(){
			add_action('init',array($this,'ultimate_pricing_init'));
			add_shortcode('ultimate_pricing',array($this,'ultimate_pricing_shortcode'));
		}
		function ultimate_pricing_init(){
			if(function_exists('vc_map')){
				vc_map(
				array(
				   'name' => __('Price Box','dfd'),
				   'base' => 'ultimate_pricing',
				   'class' => 'vc_ultimate_pricing',
				   'icon' => 'vc_ultimate_pricing',
				   'category' => __('Ronneby 1.0','dfd'),
				   'description' => __('Create nice looking pricing tables.','dfd'),
				   'params' => array(
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Select Design Style', 'dfd'),
							'param_name' => 'design_style',
							'value' => array(
								__('Design 01','dfd') => 'design01',
								__('Design 02','dfd') => 'design02',
							),
							'description' => __('Select Pricing table design you would like to use', 'dfd')
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Package Name / Title', 'dfd'),
							'param_name' => 'package_heading',
							'admin_label' => true,
							'value' => '',
							'description' => __('Enter the package name or table heading', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Sub Heading', 'dfd'),
							'param_name' => 'package_sub_heading',
							'value' => '',
							'description' => __('Enter short description for this package', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Price Value', 'dfd'),
							'param_name' => 'price_value',
							'value' => '',
							'description' => __('Currency or other value prices', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Package Price', 'dfd'),
							'param_name' => 'package_price',
							'value' => '',
							'description' => __('Enter the price for this package. e.g. $157', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Price Unit', 'dfd'),
							'param_name' => 'package_unit',
							'value' => '',
							'description' => __('Enter the price unit for this package. e.g. per month', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Price Sub Heading', 'dfd'),
							'param_name' => 'price_sub_heading',
							'value' => '',
							'description' => __('Enter short description for the price', 'dfd'),
						),
						array(
							'type' => 'textarea_html',
							'class' => '',
							'heading' => __('Features', 'dfd'),
							'param_name' => 'content',
							'value' => '',
							'description' => __('Create the features list using un-ordered list elements.', 'dfd'),
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Button Text', 'dfd'),
							'param_name' => 'package_btn_text',
							'value' => '',
							'description' => __('Enter call to action button text', 'dfd'),
						),
						array(
							'type' => 'vc_link',
							'class' => '',
							'heading' => __('Button Link', 'dfd'),
							'param_name' => 'package_link',
							'value' => '',
							'description' => __('Select / enter the link for call to action button', 'dfd'),
						),
						array(
							'type' => 'checkbox',
							'class' => '',
							'heading' => __("", 'dfd'),
							'param_name' => "package_featured",
							'value' => array("Make this pricing box as featured" => 'enable'),
							'dependency' => array('element' => 'design_style','value' => array('design02')),
						),
						array(
							'type' => 'checkbox',
							'class' => '',
							'heading' => __('', 'dfd'),
							'param_name' => 'package_hot',
							'value' => array('Note field as hot' => 'enable'),
						),
						array(
								'type' => 'textfield',
								'heading' => __('Extra class name', "js_composer"),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
						),
						/* typoraphy - package */
						array(
							'type' => 'ult_param_heading',
							'text' => __('Package Name/Title Settings','dfd'),
							'param_name' => 'package_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'package_name_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'package_name_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'package_name_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'package_name_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'package_name_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - sub heading */
						array(
							'type' => 'ult_param_heading',
							'text' => __('Sub-Heading Settings', 'dfd'),
							'param_name' => 'subheading_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'subheading_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'subheading_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'subheading_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'subheading_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'subheading_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - price */
						array(
							'type' => 'ult_param_heading',
							'text' => __('Price Value Settings','dfd'),
							'param_name' => 'price_value_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'price_value_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'price_value_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'price_value_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'price_value_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'price_value_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - price */
						array(
							'type' => 'ult_param_heading',
							'text' => __('Price Settings','dfd'),
							'param_name' => 'price_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'price_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'price_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'price_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'price_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'price_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - price unit*/
						array(
							'type' => 'ult_param_heading',
							'text' => __('Price Unit Settings','dfd'),
							'param_name' => 'price_unit_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'price_unit_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'price_unit_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'price_unit_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'price_unit_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'price_unit_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
					   /* typoraphy - price unit*/
						array(
							'type' => 'ult_param_heading',
							'text' => __('Price Sub Heading Settings','dfd'),
							'param_name' => 'price_sub_heading_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'price_sub_heading_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'price_sub_heading_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'price_sub_heading_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'price_sub_heading_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'price_sub_heading_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - feature*/
						array(
							'type' => 'ult_param_heading',
							'text' => __('Features Settings','dfd'),
							'param_name' => 'features_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'features_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'features_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'features_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'features_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'features_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),
						/* typoraphy - button */
						array(
							'type' => 'ult_param_heading',
							'text' => __('Button Settings','dfd'),
							'param_name' => 'button_typograpy',
							'group' => 'Typography',
							'class' => 'ult-param-heading',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_google_fonts',
							'heading' => __('Font Family', 'dfd'),
							'param_name' => 'button_font_family',
							'description' => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
							'group' => 'Typography'
						),
						array(
							'type' => 'ultimate_google_fonts_style',
							'heading' 		=>	__('Font Style', 'dfd'),
							'param_name'	=>	'button_font_style',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => 'font-size',
							'heading' => __('Font Size', 'dfd'),
							'param_name' => 'button_font_size',
							'min' => 10,
							'suffix' => 'px',
							'group' => 'Typography'
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Font Color', 'dfd'),
							'param_name' => 'button_font_color',
							'value' => '',
							'group' => 'Typography'
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Line Height', 'dfd'),
							'param_name' => 'button_line_height',
							'value' => '',
							'suffix' => 'px',
							'group' => 'Typography'
						),

					   array(
						   'type'        => 'dropdown',
						   'class'       => '',
						   'heading'     => __( 'Animation', 'dfd' ),
						   'param_name'  => 'module_animation',
						   'value'       => dfd_module_animation_styles(),
						   'description' => __( '', 'dfd' ),
						   'group'       => 'Animation Settings',
					   ),

					)// params
				));// vc_map
			}
		}
		function ultimate_pricing_shortcode($atts,$content = null){
			$design_style = '';
			extract(shortcode_atts(array(
				'design_style' => 'design01',
			),$atts));
			$output = '';
			require_once(__ULTIMATE_ROOT__.'/templates/pricing/pricing-'.$design_style.'.php');
			$design_func = 'generate_'.$design_style;
			$design_cls = 'Pricing_'.ucfirst($design_style);
			$class = new $design_cls;
			$output .= $class->generate_design($atts,$content);
			return $output;
		}
	} // class Ultimate_Pricing_Table
	new Ultimate_Pricing_Table;
}