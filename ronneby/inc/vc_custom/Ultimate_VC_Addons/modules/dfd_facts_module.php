<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Facts Module
*/
if(!class_exists('Dfd_Old_Facts')) 
{
	class Dfd_Old_Facts{
		function __construct(){
			add_action('init',array($this,'dfd_facts_init'));
			add_shortcode('dfd_facts',array($this,'dfd_facts_shortcode'));
		}
		function dfd_facts_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Facts box','dfd'),
						'base' => 'dfd_facts',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						//'deprecated' => '4.6',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Displays some interesting facts information','dfd'),
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => __('Facts style', 'dfd'),
								'param_name' => 'facts_style',
								'value' => array(
									__('Simple number', 'dfd') => 'simple',
									__('Circle', 'dfd') => 'circle'
								)
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Fact number', 'dfd'),
								'param_name' => 'fact_number_simple',
								'value' => 500,
								'dependency' => Array('element' => 'facts_style', 'value' => array('simple')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Fact number', 'dfd'),
								'param_name' => 'fact_number_circle',
								'value' => 80,
								'min' => 0,
								'max' => 100,
								'dependency' => Array('element' => 'facts_style', 'value' => array('circle')),
							),
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Title','dfd'),
								'param_name' => 'fact_title',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Subtitle','dfd'),
								'param_name' => 'fact_subtitle',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Animate facts','dfd'),
								'param_name' => 'animate_facts',
								'value' => array('Animate facts' => 'yes'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Information Alignment', 'dfd'),
								'param_name' => 'info_alignment',
								'value' => array(
									__('Center', 'dfd') => 'text-center',
									__('Left', 'dfd') => 'text-left',
									__('Right', 'dfd') => 'text-right'
								),
								//'dependency' => Array('element' => 'facts_style', 'value' => array('simple')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon to display:', 'dfd'),
								'param_name' => 'icon_type',
								'value' => array(
									__('Font Icon Manager','dfd') => 'selector',
									__('Custom Image Icon','dfd') => 'custom',
								),
								'description' => __('Use an existing font icon</a> or upload a custom image.', 'dfd'),
								'dependency' => Array('element' => 'facts_style', 'value' => array('simple')),
							),
							array(
								'type' => 'icon_manager',
								'class' => '',
								'heading' => __('Select Icon ','dfd'),
								'param_name' => 'icon',
								'value' => '',
								'description' => __('Click and select icon of your choice. If you can&apos;t find the one that suits for your purpose, you can <a href="admin.php?page=font-icon-Manager" target="_blank">add new here</a>.', 'flip-box'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
							),
							 array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Size of Icon', 'dfd'),
								'param_name' => 'icon_size',
								'value' => 32,
								'min' => 12,
								'max' => 72,
								'suffix' => 'px',
								'description' => __('How big would you like it?', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Space after Icon', 'dfd'),
								'param_name' => 'icon_margin',
								'value' => 5,
								'min' => 0,
								'max' => 100,
								'suffix' => 'px',
								'description' => __('How much distance would you like in two icons?', 'dfd'),
								'dependency' => Array('element' => 'facts_style', 'value' => array('simple')),
								
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Upload Image Icon:', 'dfd'),
								'param_name' => 'icon_img',
								'value' => '',
								'description' => __('Upload the custom image icon.', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('custom')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Color', 'dfd'),
								'param_name' => 'icon_color',
								'value' => '#333333',
								'description' => __('Give it a nice paint!', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon Style', 'dfd'),
								'param_name' => 'icon_style',
								'value' => array(
									__('Simple', 'dfd') => 'none',
									__('Circle Background', 'dfd') => 'circle',
									__('Square Background', 'dfd') => 'square',
									__('Design your own', 'dfd') => 'advanced',
								),
								'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Background Color', 'dfd'),
								'param_name' => 'icon_color_bg',
								'value' => '#ffffff',
								'description' => __('Select background color for icon.', 'dfd'),	
								'dependency' => Array('element' => "icon_style", 'value' => array("circle","square","advanced")),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon Border Style', 'dfd'),
								'param_name' => 'icon_border_style',
								'value' => array(
									__('None', 'dfd') => '',
									__('Solid', 'dfd') => 'solid',
									__('Dashed', 'dfd') => 'dashed',
									__('Dotted', 'dfd') => 'dotted',
									__('Double', 'dfd') => 'double',
									__('Inset', 'dfd') => 'inset',
									__('Outset', 'dfd') => 'outset',
								),
								'description' => __('Select the border style for icon.','dfd'),
								'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Border Color', 'dfd'),
								'param_name' => 'icon_color_border',
								'value' => '#333333',
								'description' => __('Select border color for icon.', 'dfd'),	
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Border Width', 'dfd'),
								'param_name' => 'icon_border_size',
								'value' => 1,
								'min' => 1,
								'max' => 10,
								'suffix' => 'px',
								'description' => __('Thickness of the border.', 'dfd'),
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Border Radius', 'dfd'),
								'param_name' => 'icon_border_radius',
								'value' => 50,
								'min' => 1,
								'max' => 500,
								'suffix' => 'px',
								'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
							),
							array(
								'type' => "number",
								'class' => '',
								'heading' => __("Background Size", 'dfd'),
								'param_name' => "icon_border_spacing",
								'value' => 50,
								'min' => 30,
								'max' => 500,
								'suffix' => 'px',
								'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
								'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Ran out of options? Need more styles? Write your own CSS and mention the class name here.', 'dfd'),
								
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Fact number Settings', 'dfd'),
								'param_name' => 'main_fact_number_typograpy',
								'group' => 'Typography',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								//'dependency' => Array('element' => 'fact_number_type', 'value' => array('customizable')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Fact number type', 'dfd'),
								'param_name' => 'fact_number_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								//"dependency" => Array("element" => "fact_number_type", "value" => array('customizable')),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "main_fact_number_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "fact_number_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_fact_number_custom_family',
								'holder' => 'div',
								'value' => '',
								"group" => "Typography",
								"dependency" => Array("element" => "fact_number_typography_type", "value" => array('default')),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_fact_number_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "fact_number_typography_type", "value" => array('google_fonts')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_fact_number_default_style",
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "fact_number_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"main_fact_number_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "fact_number_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "main_fact_number_font_size",
								"min" => 10,
								"suffix" => "px",
								//"description" => __("Main heading font size", 'dfd'),
								//"dependency" => Array("element" => "fact_number_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "main_fact_number_color",
								"value" => "",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "fact_number_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "main_fact_number_line_height",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "fact_number_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "main_fact_number_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "fact_number_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Heading Settings", 'dfd'),
								"param_name" => "main_heading_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'heading_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								//"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "main_heading_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								"group" => "Typography",
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('google_fonts')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"main_heading_default_style",
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"main_heading_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "heading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "main_heading_font_size",
								"min" => 10,
								"suffix" => "px",
								//"description" => __("Main heading font size", 'dfd'),
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "main_heading_color",
								"value" => "",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "main_heading_line_height",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "main_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"description" => __("Main heading color", 'dfd'),	
								//"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Sub Heading Settings", 'dfd'),
								"param_name" => "sub_heading_typograpy",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'subheading_typography_type',
								'value' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								"group" => "Typography",
								//"dependency" => Array("element" => "content", "not_empty" => true),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "sub_heading_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography",
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder' => 'div',
								'value' => '',
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography",
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"sub_heading_style",
								//"description"	=>	__("Sub heading font style", 'dfd'),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('google_fonts')),
								"group" => "Typography",
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"sub_heading_default_style",
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "dropdown",
								"heading" 		=>	__("Font Weight", 'dfd'),
								"param_name"	=>	"sub_heading_default_weight",
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								"dependency" => Array("element" => "subheading_typography_type", "value" => array('default')),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "sub_heading_font_size",
								"min" => 14,
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "sub_heading_color",
								"value" => "",
								//"description" => __("Sub heading color", 'dfd'),	
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "sub_heading_line_height",
								"value" => "",
								"suffix" => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "sub_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								//"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
							   "type"        => "dropdown",
							   "class"       => "",
							   "heading"     => __( "Animation", 'dfd' ),
							   "param_name"  => "module_animation",
							   "value"       => dfd_module_animation_styles(),
							   "description" => __( "", 'dfd' ),
							   "group"       => "Animation Settings",
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_facts_shortcode($atts){
			global $dfd_ronneby;
			$output = $animate_facts = $fact_number_simple = $fact_number_circle = $fact_title = $fact_subtitle = $info_alignment = $facts_style = $facts_class = $icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $module_animation =  $tooltip_disp = $tooltip_text = $icon_margin = $style = '';
			$fact_number_typography_type = $main_fact_number_font_size = $main_fact_number_font_family = $main_fact_number_custom_family = $main_fact_number_style = $main_fact_number_default_style = $main_fact_number_default_weight = $main_fact_number_color = $main_fact_number_line_height = $main_fact_number_letter_spacing = $heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = $subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			$main_fact_number_style_inline = $main_heading_style_inline = $sub_heading_style_inline = '';
			extract(shortcode_atts( array(
				'facts_style' => 'simple',
				'fact_number_simple' => '500',
				'fact_number_circle' => '80',
				'fact_title' => '',
				'fact_subtitle' => '',
				'animate_facts' => '',
				'info_alignment' => 'text-center',
				'icon_type' => 'selector',
				'icon'=> '',
				'icon_size' => '32',
				'icon_margin' => '5',
				'icon_img' => '',
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_border_style' => '',
				'icon_color_border' => '#333333',			
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				'module_animation' => '',
				'el_class'=>'',
				'fact_number_typography_type'	=> 	'default',
				'main_fact_number_font_size'	=> 	'',
				'main_fact_number_font_family' => '',
				'main_fact_number_custom_family' => '',
				'main_fact_number_style'		=>	'',
				'main_fact_number_default_style'		=>	'',
				'main_fact_number_default_weight'		=>	'',
				'main_fact_number_color'		=>	'',
				'main_fact_number_line_height' => '',
				'main_fact_number_letter_spacing' => '',
				'heading_typography_type'	=> 	'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'',
				'main_heading_default_weight'		=>	'',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'subheading_typography_type'	=> 	'default',
				'sub_heading_font_size'	=> 	'',
				'sub_heading_font_family' => '',
				'main_subheading_custom_family' => '',
				'sub_heading_style'		=>	'',
				'sub_heading_default_style'		=>	'',
				'sub_heading_default_weight'		=>	'',
				'sub_heading_color'		=>	'',
				'sub_heading_line_height' => '',
				'sub_heading_letter_spacing' => '',
			),$atts));
			
			if(!empty($facts_style)) {
				$facts_class .= $facts_style;
			}
			
			if($animate_facts != '') {
				$facts_class .= ' call-on-waypoint';
			}
			
			if(empty($icon_size)) {
				$icon_size = 32;
			}
			
			if(empty($icon_margin)) {
				$icon_margin = 5;
			}
			
			if($main_fact_number_font_family != '' && strcmp($fact_number_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_fact_number_font_family);
				$main_fact_number_style_inline .= 'font-family:\''.$mhfont_family.'\';';
			} elseif(!empty($main_fact_number_custom_family) && strcmp($fact_number_typography_type, 'default') === 0) {
				$main_fact_number_style_inline .= 'font-family:\''.$main_fact_number_custom_family.'\';';
			}
			// main heading font style
			if(strcmp($fact_number_typography_type, 'google_fonts') === 0) {
				$main_fact_number_style_inline .= get_ultimate_font_style($main_fact_number_style);
			}elseif(!empty($main_fact_number_default_style) && strcmp($fact_number_typography_type, 'default') === 0) {
				$main_fact_number_style_inline .= 'font-style:'.esc_attr($main_fact_number_default_style).';';
			}
			if(!empty($main_fact_number_default_weight) && strcmp($fact_number_typography_type, 'default') === 0) {
				$main_fact_number_style_inline .= 'font-weight:'.esc_attr($main_fact_number_default_weight).';';
			}
			//attach font size if set
			if($main_fact_number_font_size != '') {
				$main_fact_number_style_inline .= 'font-size:'.esc_attr($main_fact_number_font_size).'px;';
			}
			//attach font color if set	
			if($main_fact_number_color != '') {
				$main_fact_number_style_inline .= 'color:'.esc_attr($main_fact_number_color).';';
			}
			//line height
			if($main_fact_number_line_height != '') {
				$main_fact_number_style_inline .= 'line-height:'.esc_attr($main_fact_number_line_height).'px;';
			}
			//letter spacing
			if($main_fact_number_letter_spacing != '') {
				$main_fact_number_style_inline .= 'letter-spacing:'.esc_attr($main_fact_number_letter_spacing).'px;';
			}
			
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.$mhfont_family.'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.$main_heading_custom_family.'\';';
			}
			// main heading font style
			if(strcmp($heading_typography_type, 'google_fonts') === 0) {
				$main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
			}elseif(!empty($main_heading_default_style) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-style:'.esc_attr($main_heading_default_style).';';
			}
			if(!empty($main_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-weight:'.esc_attr($main_heading_default_weight).';';
			}
			//attach font size if set
			if($main_heading_font_size != '') {
				$main_heading_style_inline .= 'font-size:'.esc_attr($main_heading_font_size).'px;';
			}
			//attach font color if set	
			if($main_heading_color != '') {
				$main_heading_style_inline .= 'color:'.esc_attr($main_heading_color).';';
			}
			//line height
			if($main_heading_line_height != '') {
				$main_heading_style_inline .= 'line-height:'.esc_attr($main_heading_line_height).'px;';
			}
			//letter spacing
			if($main_heading_letter_spacing != '') {
				$main_heading_style_inline .= 'letter-spacing:'.esc_attr($main_heading_letter_spacing).'px;';
			}
				
			/* ----- sub heading styles ----- */
			if($sub_heading_font_family != '' && strcmp($subheading_typography_type, 'google_fonts') === 0)
			{
				$shfont_family = get_ultimate_font_family($sub_heading_font_family);
				$sub_heading_style_inline .= 'font-family:\''.$shfont_family.'\';';
			}elseif(!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-family:\''.$main_subheading_custom_family.'\';';
			}
			//sub heaing font style
			if(strcmp($subheading_typography_type, 'google_fonts') === 0) {
				$sub_heading_style_inline .= get_ultimate_font_style($sub_heading_style);
			}elseif(!empty($sub_heading_default_style) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-style:'.esc_attr($sub_heading_default_style).';';
			}
			if(!empty($sub_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-weight:'.esc_attr($sub_heading_default_weight).';';
			}
			//attach font size if set
			if($sub_heading_font_size != '') {
				$sub_heading_style_inline .= 'font-size:'.esc_attr($sub_heading_font_size).'px;';
			}
			//attach font color if set	
			if($sub_heading_color != '') {
				$sub_heading_style_inline .= 'color:'.esc_attr($sub_heading_color).';';	
			}
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}

			if($icon_margin !== '') {
				$style .= 'margin-right:'.esc_attr($icon_margin).'px;';
			}


			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$module_animation = $icon_link = $circle_color = '';
			$circle_color .= isset($dfd_ronneby['main_site_color']) && !empty($dfd_ronneby['main_site_color']) ? $dfd_ronneby['main_site_color'] : '#8a8f6a';
			
			$output .= '<div class="dfd-facts '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				
				$output .= '<div class="dfd-fact-item '.esc_attr($info_alignment).'">';
					if(($icon != 'none' && $icon !== "") || ($icon_img != 'none' && $icon_img !== '')) {
						$output .= '<div class="icon-wrap">';
							//if($icon !== "" || $icon_img !== ''){
								if($icon_type == 'custom'){
									$icon_style = 'none';
								}
								$main_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$icon_size.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_link="'.$icon_link.'" icon_align="'.$info_alignment.'" module_animation="'.$module_animation.'"]');
								$output .= "\n".'<div class="uavc-list-icon '.esc_attr($el_class).'" style="'.$style.'">';
								$output .= $main_icon;				
								$output .= "\n".'</div>';
							//}
						$output .= '</div>';
					}
					
					$unique_id = uniqid('fact-num-');
					
					$fact_number = '';
					
					if(strcmp($facts_style, 'simple') === 0 && $fact_number_simple != '') {
						$fact_number = $fact_number_simple;
					}
					
					if(strcmp($facts_style, 'circle') === 0 && $fact_number_circle != '') {
						$fact_number = $fact_number_circle;
					}
					
					if($fact_number != '') {
						$fact_number_attributes = ' data-end="'. esc_attr($fact_number) .'" data-start="0" data-speed="3000" ';
						
						$after_fact_num = $after_fact_block = '';
						
						if(strcmp($facts_style, 'circle') === 0) {
							wp_enqueue_script('jquery.knob');
							$fact_number_attributes .= ' data-knob="#'. esc_attr($unique_id) .'" ';
							$after_fact_num .= '<input id="'. esc_attr($unique_id) .'" type="text" value="'. esc_attr($fact_number) .'">';
							$after_fact_block .= '<script type="text/javascript">
										jQuery(function() {
											jQuery("#'. esc_js($unique_id) .'").knob({
												width: 120,
												height: 120,
												fgColor: "'.esc_js($circle_color).'",
												bgColor: "transparent",
												readOnly: true,
												lineWidth: 14,
												displayInput: false,
											});
										});
									</script>';
						}
						
						$output .= '<div class="fact-number" style="'.$main_fact_number_style_inline.'"><span class="number '. esc_attr($facts_class) .'" '. $fact_number_attributes .' >'. $fact_number .'</span>'. $after_fact_num .'</div>';
						$output .= $after_fact_block;
					}
					
					if($fact_title != '') {
						$output .= '<div class="feature-title" style="'.$main_heading_style_inline.'">'.$fact_title.'</div>';
					}
					
					if($fact_subtitle != '') {
						$output .= '<div class="subtitle" style="'.$sub_heading_style_inline.'">'.$fact_subtitle.'</div>';
					}
				
				$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Old_Facts'))
{
	$Dfd_Old_Facts = new Dfd_Old_Facts;
}
