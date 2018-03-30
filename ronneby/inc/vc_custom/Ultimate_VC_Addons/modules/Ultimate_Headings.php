<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Ultimate Headings
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists("Ultimate_Headings")){
	class Ultimate_Headings{
		static $add_plugin_script;
		function __construct(){
			add_action("init",array($this,"ultimate_headings_init"));
			add_shortcode("ultimate_heading",array($this,"ultimate_headings_shortcode"));
			add_action("wp_enqueue_scripts", array($this, "register_headings_assets"),1);
			if(function_exists('vc_add_shortcode_param'))
			{
				vc_add_shortcode_param('ultimate_margins', array($this, 'ultimate_margins_param'), get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/admin/vc_extend/js/vc-headings-param.js');
			}
		}
		function register_headings_assets()
		{
			wp_register_style("ultimate-headings-style",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/headings.min.css',array(),null);
			wp_register_script("ultimate-headings-script",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/headings.min.js',array('jquery'),null);
		}
		function ultimate_margins_param($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$positions = $settings['positions'];
			$html = '<div class="ultimate-margins">
						<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value ultimate-margin-value '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" />';
					foreach($positions as $key => $position)
						$html .= $key.' <input type="text" style="width:50px;padding:3px" data-hmargin="'.$position.'" class="ultimate-margin-inputs" id="margin-'.$key.'" /> &nbsp;&nbsp;';
			$html .= '</div>';
			return $html;
		}
		function ultimate_headings_init(){
			if(function_exists("vc_map")){
				vc_map(
					array(
						'name' => __('Headings', 'dfd'),
						'base' => 'ultimate_heading',
						'class' => 'vc_ultimate_heading',
						'icon' => 'vc_ultimate_heading',
						'category' => __('Ronneby 1.0','dfd'),
						//'deprecated' => '4.6',
						'description' => __('Awesome heading styles.','dfd'),
						'params' => array(
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading type', 'dfd'),
								'param_name' => 'heading_type',
								'value' => array(
									__('Standard', 'dfd')	=>	'default',
									__('Customizable','dfd')		=>	'customizable',
								),
								//"description" => __("Text alignment", 'dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Title', 'js_composer' ),
								'param_name' => 'main_heading',
								'holder' => 'div',
								'value' => '',
								"dependency" => Array("element" => "heading_type", "value" => array('default')),
							),
							array(
								"type" => "dropdown",
								"heading" => __("Tag",'dfd'),
								"param_name" => "heading_tag",
								"value" => array(
									__("Default",'dfd') => "h5",
									__("H1",'dfd') => "h1",
									__("H2",'dfd') => "h2",
									__("H3",'dfd') => "h3",
									__("H4",'dfd') => "h4",
									__("H6",'dfd') => "h6",
								),
								"description" => __("Default is H5", 'dfd'),
								//"dependency" => Array("element" => "heading_type", "value" => array('default')),
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("Custom Heading (Optional)", "dfd"),
								"param_name" => "heading_content",
								"value" => "",
								"description" => __("Custom font settings for typography section will work here", "dfd"),
								"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Heading Settings", 'dfd'),
								"param_name" => "main_heading_typograpy",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
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
								"dependency" => Array("element" => "heading_type", "value" => array('customizable')),
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
									__('Default', 'dfd')	=>	'400',
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
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "main_heading_color",
								"value" => "",
								//"description" => __("Main heading color", 'dfd'),	
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
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
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
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
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "text",
								"heading" => __("<h4>Enter values with respective unites. Example - 10px, 10em, 10%, etc.</h4>", 'dfd'),
								"param_name" => "margin_design_tab_text",
								"group" => "Design",
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
							),
							array(
								"type" => "ultimate_margins",
								"heading" => "Heading Margins",
								"param_name" => "main_heading_margin",
								"positions" => array(
									__('Top','dfd') => "top",
									__('Bottom','dfd') => "bottom"
								),
								"dependency" => Array("element" => "heading_content", "not_empty" => true),
								"group" => "Design"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __('Subheading type', 'dfd'),
								"param_name" => "subheading_type",
								"value" => array(
									__('Standard', 'dfd')	=>	'default',
									__('Customizable','dfd')		=>	'customizable',
								),
								//"description" => __("Text alignment", 'dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Subtitle', 'dfd' ),
								'param_name' => 'default_sub_heading',
								'holder' => 'div',
								"dependency" => Array("element" => "subheading_type", "value" => array('default')),
								'value' => ''
							),
							array(
								"type" => "dropdown",
								"heading" => __("Subtitle Tag","dfd"),
								"param_name" => "subheading_tag",
								"value" => array(
									__("Default","dfd") => "h3",
									__("H1","dfd") => "h1",
									__("H2","dfd") => "h2",
									__("H4","dfd") => "h4",
									__("H5","dfd") => "h5",
									__("H6","dfd") => "h6",
								),
								"description" => __("Default is H3", "dfd"),
								//"dependency" => Array("element" => "subheading_type", "value" => array('default')),
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("Sub Heading (Optional)", 'dfd'),
								"param_name" => "content",
								"value" => "",
								"description" => __("Custom font settings fro typography section will work here", "dfd"),
								"dependency" => Array("element" => "subheading_type", "value" => array('customizable')),
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Sub Heading Settings", 'dfd'),
								"param_name" => "sub_heading_typograpy",
								"dependency" => Array("element" => "content", "not_empty" => true),
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
								"dependency" => Array("element" => "content", "not_empty" => true),
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
									__('Default', 'dfd')	=>	'400',
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
								"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Font Color", 'dfd'),
								"param_name" => "sub_heading_color",
								"value" => "",
								//"description" => __("Sub heading color", 'dfd'),	
								"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "sub_heading_line_height",
								"value" => "",
								"suffix" => "px",
								"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter spacing", 'dfd'),
								"param_name" => "sub_heading_letter_spacing",
								"value" => "",
								"suffix" => "px",
								"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_margins",
								"heading" => "Sub Heading Margins",
								"param_name" => "sub_heading_margin",
								"positions" => array(
									__('Top','dfd') => "top",
									__('Bottom','dfd') => "bottom"
								),
								"dependency" => Array("element" => "content", "not_empty" => true),
								"group" => "Design"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Alignment", 'dfd'),
								"param_name" => "alignment",
								"value" => array(
									__('Center', 'dfd')	=>	"center",
									__('Left', 'dfd')		=>	"left",
									__('Right', 'dfd')		=>	"right"
								),
								//"description" => __("Text alignment", 'dfd'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Heading configuration', 'dfd'),
								'param_name' => 'heading_configuration',
								'value' => array(
									__('Subtitle under the title', 'dfd')	=>	'top',
									__('Title under the subtitle', 'dfd')		=>	'bottom',
									__('Title behind the subtitle', 'dfd')		=>	'behind'
								),
								//"description" => __("Text alignment", 'dfd'),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Separator", 'dfd'),
								"param_name" => "spacer",
								"value" => array(
									__('No Separator', 'dfd')			=>	'no_spacer',
									__('Line', 'dfd')					=>	'line_only',
									__('Icon', 'dfd')					=>	'icon_only',
									__('Image', 'dfd')					=> 'image_only',
									__('Line with icon/image', 'dfd')	=>	'line_with_icon',
								),
								"description" => __("Horizontal line, icon or image to divide sections", 'dfd'),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Separator Position", 'dfd'),
								"param_name" => "spacer_position",
								"value" => array(
									__('Top', 'dfd')		=>	"top",
									__('Between Heading & Sub-Heading', 'dfd')	=>	"middle",
									__('Bottom', 'dfd')	=>	"bottom",
									__('To the left from title', 'dfd')		=>	"left",
									__('To the right from title', 'dfd')		=>	"right",
									__('Both left and right from title', 'dfd')		=>	"both-left-right"
								),
								//"description" => __("Alignment of seperator", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only","icon_only","image_only")),
							),
							array(
								"type" => "attach_image",
								"heading" => __("Select Image", 'dfd'),
								"param_name" => "spacer_img",
								//"description" => __("Alignment of spacer", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("image_only")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Image Width", 'dfd'),
								"param_name" => "spacer_img_width",
								"value" => 48,
								"suffix" => "px",
								"description" => __("Provide image width (optional)", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("image_only")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Line Style", 'dfd'),
								"param_name" => "line_style",
								"value" => array(
									__('Solid','dfd')=> "solid",
									__('Dashed', 'dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Double', 'dfd') => "double",
									__('Inset','dfd') => "inset",
									__('Outset','dfd') => "outset",
								),
								//"description" => __("Select the line style.",'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Width (optional)", 'dfd'),
								"param_name" => "line_width",
								//"value" => 250,
								//"min" => 150,
								//"max" => 500,
								"suffix" => "px",
								//"description" => __("Set line width", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Line Height", 'dfd'),
								"param_name" => "line_height",
								"value" => 1,
								"min" => 1,
								"max" => 500,
								"suffix" => "px",
								//"description" => __("Set line height", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Line Color", 'dfd'),
								"param_name" => "line_color",
								"value" => "#cccccc",
								//"description" => __("Select color for line.", 'dfd'),	
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", 'dfd'),
								"param_name" => "icon_type",
								"value" => array(
									__('Font Icon Manager', 'dfd') => "selector",
									__('Custom Image Icon','dfd') => "custom",
								),
								"description" => __("Use an existing font icon or upload a custom image.", 'dfd'),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","icon_only")),
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ",'dfd'),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Size of Icon", 'dfd'),
								"param_name" => "icon_size",
								"value" => 32,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"description" => __("How big would you like it?", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color", 'dfd'),
								"param_name" => "icon_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),						
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Style", 'dfd'),
								"param_name" => "icon_style",
								"value" => array(
									__('Simple','dfd') => "none",
									__('Circle Background','dfd') => "circle",
									__('Square Background','dfd') => "square",
									__('Design your own','dfd') => "advanced",
								),
								"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Background Color", 'dfd'),
								"param_name" => "icon_color_bg",
								"value" => "",
								"description" => __("Select background color for icon.", 'dfd'),	
								"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Border Style", 'dfd'),
								"param_name" => "icon_border_style",
								"value" => array(
									__('None','dfd') => "",
									__('Solid','dfd') => "solid",
									__('Dashed','dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Double','dfd') => "double",
									__('Inset','dfd') => "inset",
									__('Outset','dfd') => "outset",
								),
								"description" => __("Select the border style for icon.",'dfd'),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color", 'dfd'),
								"param_name" => "icon_color_border",
								"value" => "#cccccc",
								"description" => __("Select border color for icon.", 'dfd'),	
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Width", 'dfd'),
								"param_name" => "icon_border_size",
								"value" => 1,
								"min" => 1,
								"max" => 10,
								"suffix" => "px",
								"description" => __("Thickness of the border.", 'dfd'),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Radius", 'dfd'),
								"param_name" => "icon_border_radius",
								"value" => '',
								"min" => 1,
								"max" => 500,
								"suffix" => "px",
								"description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", 'dfd'),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Background Size", 'dfd'),
								"param_name" => "icon_border_spacing",
								"value" => 50,
								"min" => 30,
								"max" => 500,
								"suffix" => "px",
								"description" => __("Spacing from center of the icon till the boundary of border / background", 'dfd'),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Upload Image Icon:", 'dfd'),
								"param_name" => "icon_img",
								"value" => "",
								"description" => __("Upload the custom image icon.", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Image Width", 'dfd'),
								"param_name" => "img_width",
								"value" => 48,
								"min" => 16,
								"max" => 512,
								"suffix" => "px",
								"description" => __("Provide image width", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
							),
							array(
								"type" => "ultimate_margins",
								"heading" => "Separator Margins",
								"param_name" => "spacer_margin",
								"positions" => array(
									__('Top','dfd') => "top",
									__('Bottom','dfd') => "bottom"
								),
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon","line_only","icon_only","image_only")),
								"group" => "Design"
							),
							array(
								"type" => "number",
								"heading" => "Space between Line & Icon/Image",
								"param_name" => "line_icon_fixer",
								"value" => "",
								"suffix" => "px",
								"dependency" => Array("element" => "spacer", "value" => array("line_with_icon")),
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
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
							/*array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/8v9sy' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),*/
						)
					)
				);
			}
		}
		function ultimate_headings_shortcode($atts, $content = null){
			$wrapper_style = $main_heading_style_inline = $sub_heading_style_inline = $line_style_inline = $icon_inline = $output = $el_class = $heading_content = $heading_html = $subheading_html = $heading_configuration  = $module_animation = $main_heading_letter_spacing = $sub_heading_letter_spacing = $spacer_img = $spacer = '';
			$heading_tag = $subheading_tag = $heading_type = $subheading_type = $heading_typography_type = $main_heading_custom_family = $main_heading_default_style = $main_heading_default_weight = $subheading_typography_type = $main_subheading_custom_family = $sub_heading_default_style = $sub_heading_default_weight = '';
			extract(shortcode_atts(array(
				'heading_type' => 'default',
				'subheading_type' => 'default',
				'main_heading' => '',
				'heading_content' => '',
				'heading_typography_type' => 'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'normal',
				'main_heading_default_weight'		=>	'400',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'main_heading_margin' => '',
				'default_sub_heading' => '',
				'sub_heading'				=>	'',
				'subheading_typography_type'	=> 	'default',
				'sub_heading_font_size'	=> 	'',
				'sub_heading_font_family' => '',
				'main_subheading_custom_family' => '',
				'sub_heading_style'		=>	'',
				'sub_heading_default_style'		=>	'normal',
				'sub_heading_default_weight'		=>	'400',
				'sub_heading_color'		=>	'',
				'sub_heading_line_height' => '',
				'sub_heading_letter_spacing' => '',
				'sub_heading_margin' => '',
				'spacer'					=>	'no_spacer',
				'spacer_position'			=>	'top',
				'spacer_img'				=>	'',
				'spacer_img_width'				=>	'48',
				'line_style'				=>	'solid',
				'line_width'				=>	'auto',
				'line_height'				=>	'1',
				'line_color'				=>	'#ccc',
				'icon_type'					=>	'selector',
				'icon'						=>	'',
				'icon_color'				=>	'',
				'icon_style'				=>	'none',
				'icon_color_bg'				=>	'',
				'icon_border_style'			=>	'',
				'icon_color_border'			=>	'#cccccc',
				'icon_border_size'			=>	'1',
				'icon_border_radius'		=>	'',
				'icon_border_spacing'		=>	'50',
				'icon_img'					=>	'',
				'img_width'					=>	'48',
				'icon_size'					=>	'32',
				'alignment'					=>	'center',
				'spacer_margin' 			=> '',
				'line_icon_fixer' 			=> '',
				'heading_tag' 				=> 'h5',
				'subheading_tag' 				=> 'h3',
				'heading_configuration' 				=> 'top',
				'module_animation' => '',
				'el_class' => '',
			),$atts));
			
			global $dfd_ronneby;
			$wrapper_class = $responsive_class = '';
			
			if(isset($dfd_ronneby['disable_typography_responsive']) && $dfd_ronneby['disable_typography_responsive']) {
				$responsive_class .= 'dfd-disable-resposive-headings';
			} else {
				$responsive_class .= 'dfd-enable-resposive-headings';
			}
			
			if($heading_tag == '') {
				$heading_tag = 'h5';
			}
			
			if($subheading_tag == '') {
				$subheading_tag = 'h3';
			}
			
			/* ---- main heading styles ---- */
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.esc_attr($mhfont_family).'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.esc_attr($main_heading_custom_family).'\';';
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
			//attach margins for main heading
			if($main_heading_margin != '') {
				$main_heading_style_inline .= $main_heading_margin;
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
			if($sub_heading_font_family != '' && strcmp($subheading_typography_type, 'google_fonts') === 0) {
				$shfont_family = get_ultimate_font_family($sub_heading_font_family);
				$sub_heading_style_inline .= 'font-family:\''.esc_attr($shfont_family).'\';';
			} elseif (!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-family:\''.esc_attr($main_subheading_custom_family).'\';';
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
			//attach margins for sub heading
			if($sub_heading_margin != '') {
				$sub_heading_style_inline .= $sub_heading_margin;
			}
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}
				
			if($spacer != '') {
				$wrapper_style .= $spacer_margin;
			}
			if($spacer == 'line_with_icon') {
				if($line_width < $icon_size) {
					$wrap_width = $icon_size;
					
				} else {
					$wrap_width = $line_width;
				}
				if($icon_type == 'selector') {
					if($icon_style == 'advanced') {
						//if($icon_border_spacing != '')
							//$wrapper_style .= 'padding:'.$icon_border_spacing.'px 0;';
					} else {
						$wrapper_style .= 'height:'.esc_attr($icon_size).'px;';
					}
				}
				$icon_style_inline = 'font-size:'.esc_attr($icon_size).'px;';
			} else if($spacer == 'line_only') {
				$wrap_width = $line_width;
				$line_style_inline = 'border-style:'.esc_attr($line_style).';';
				$line_style_inline .= 'border-bottom-width:'.esc_attr($line_height).'px;';
				$line_style_inline .= 'border-color:'.esc_attr($line_color).';';
				$line_style_inline .= 'width:'.esc_attr($wrap_width).'px;';
				$wrapper_style .= 'height:'.esc_attr($line_height).'px;';
				$line = '<span class="uvc-headings-line" style="'.$line_style_inline.'"></span>';
				$icon_inline = $line;
			} else if($spacer == 'icon_only') {
				$icon_style_inline = 'font-size:'.esc_attr($icon_size).'px;';
			} else if($spacer == 'image_only') {
				if(!empty($spacer_img_width)) {
					$siwidth = array($spacer_img_width, $spacer_img_width);
				} else {
					$siwidth = 'full';
				}
				$icon_inline = wp_get_attachment_image( $spacer_img, $siwidth, false, array("class"=>"ultimate-headings-icon-image") );
			}
			//if spacer type is line with icon or only icon show icon or image respectively
			if($spacer == 'line_with_icon' || $spacer == 'icon_only') {
				$icon_animation = '';
				$icon_inline = do_shortcode('[just_icon icon_align="'.$alignment.'" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
			}
			if($spacer == 'line_with_icon') {
				$data = 'data-hline_width="'.esc_attr($wrap_width).'" data-hicon_type="'.esc_attr($icon_type).'" data-hborder_style="'.esc_attr($line_style).'" data-hborder_height="'.esc_attr($line_height).'" data-hborder_color="'.esc_attr($line_color).'"';
				if($icon_type == 'selector') {
					$data .= ' data-icon_width="'.esc_attr($icon_size).'"';
				} else {
					$data .= ' data-icon_width="'.esc_attr($img_width).'"';
				}
				if($line_icon_fixer != '') {
					$data .= ' data-hfixer="'.esc_attr($line_icon_fixer).'" ';
				}
			} else {
				$data = '';
			}
			
			if($main_heading != '' && strcmp($heading_type, 'default') === 0) {
				$heading_html .= '<'.esc_attr($heading_tag).' class="widget-title">'.$main_heading.'</'.esc_attr($heading_tag).'>';
				
			}
			if($heading_content != '' && strcmp($heading_type, 'customizable') === 0) {
				$heading_html .= '<'.esc_attr($heading_tag).' class="widget-title uvc-main-heading" style="'.$main_heading_style_inline.'">'.do_shortcode($heading_content).'</'.esc_attr($heading_tag).'>';
			}
					
			if($default_sub_heading != '' && strcmp($subheading_type, 'default') === 0) {
				$subheading_html .= '<div class="uvc-sub-heading"><'.esc_attr($subheading_tag).' class="widget-sub-title">'.$default_sub_heading.'</'.esc_attr($subheading_tag).'></div>';
			}
			if($content != '' && strcmp($subheading_type, 'customizable') === 0) {
				$subheading_html .= '<'.esc_attr($subheading_tag).' class="widget-sub-title uvc-sub-heading" style="'.$sub_heading_style_inline.'">'.do_shortcode($content).'</'.esc_attr($subheading_tag).'>';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$id = uniqid('ultimate-heading');			
			$output = '<div id="'.esc_attr($id).'" class="uvc-heading dfd-delim-'.esc_attr($spacer_position).' '.esc_attr($el_class).' '. esc_attr($animate) . ' heading-config-'.esc_attr($heading_configuration).' '.esc_attr($responsive_class).'" ' . $animation_data . ' data-hspacer="'.esc_attr($spacer).'" '.$data.' data-halign="'.esc_attr($alignment).'" style="text-align:'.esc_attr($alignment).'">';
				if($spacer_position == 'top') {
					$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
				}
				if(strcmp($heading_configuration, 'bottom') === 0) {
					$output .= $subheading_html;
				} else {
					if($spacer_position == 'left' || $spacer_position == 'right' || $spacer_position == 'both-left-right') {
						$output .= '<div class="uvc-main-heading">';
					}
					if($spacer_position == 'left' || $spacer_position == 'both-left-right') {
						$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
					}
					$output .= $heading_html;
					if($spacer_position == 'both-left-right' || $spacer_position == 'right' ) {
						$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
					}
					if($spacer_position == 'left' || $spacer_position == 'right' || $spacer_position == 'both-left-right') {
						$output .= '</div>';
					}
				}
				if($spacer_position == 'middle')
					$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
				if(strcmp($heading_configuration, 'bottom') === 0) {
					if($spacer_position == 'left' || $spacer_position == 'right' || $spacer_position == 'both-left-right') {
						$output .= '<div class="uvc-main-heading">';
					}
					if($spacer_position == 'left' || $spacer_position == 'both-left-right') {
						$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
					}
					$output .= $heading_html;
					if($spacer_position == 'both-left-right' || $spacer_position == 'right' ) {
						$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
					}
					if($spacer_position == 'left' || $spacer_position == 'right' || $spacer_position == 'both-left-right') {
						$output .= '</div>';
					}
				} else {
					$output .= $subheading_html;
				}
				if($spacer_position == 'bottom') {
					$output .= $this->ultimate_heading_spacer($spacer, $wrapper_style, $icon_inline);
				}
			$output .= '</div>';
			//enqueue google font
			$args = array(
				$main_heading_font_family, $sub_heading_font_family
			);
			enquque_ultimate_google_fonts($args);
			return $output;
		}
		function ultimate_heading_spacer($wrapper_class, $wrapper_style, $icon_inline) {
			$spacer = '<div class="uvc-heading-spacer '.esc_attr($wrapper_class).'" style="'.$wrapper_style.'">'.$icon_inline.'</div>';
			return $spacer;
		}
	} // end class
	new Ultimate_Headings;
}