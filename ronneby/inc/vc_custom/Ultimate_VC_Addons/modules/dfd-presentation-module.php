<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Presentation Module
*/
if(!class_exists('Dfd_Presentation_Module')) 
{
	class Dfd_Presentation_Module{
		function __construct(){
			add_action('init',array($this,'dfd_presentation_module_init'));
			add_shortcode('dfd_presentation_module',array($this,'dfd_presentation_module_shortcode'));
		}
		function dfd_presentation_module_init(){
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   'name' => __('Presentation item','dfd'),
					   'base' => 'dfd_presentation_module',
					   'class' => 'vc_info_banner_icon',
					   "icon" => 'vc_icon_info_banner',
					   "category" => __("Ronneby 1.0","dfd"),
					   "description" => __("Displays short presentation information with banner","dfd"),
					   "params" => array(
					   		array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Title ","dfd"),
								"param_name" => "presentation_title",
								"admin_label" => true,
								"value" => "",
								"description" => ''
							),
					   		array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Subtitle ","dfd"),
								"param_name" => "presentation_subtitle",
								"admin_label" => true,
								"value" => "",
								"description" => ''
							),
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description","dfd"),
								"param_name" => "content",
								"value" => "",
								"description" => ''
							),
					   		array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Button text","dfd"),
								"param_name" => "button_title",
								"admin_label" => true,
								"value" => "",
								"description" => ''
							),
							array(
								'type' => 'vc_link',
								'class' => '',
								'heading' => __('Button link', 'dfd'),
								'value' => '',
								'param_name' => 'button_link',
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Presentation Image","dfd"),
								"param_name" => "presentation_image",
								"value" => "",
								"description" => __("Upload the presentation image","dfd"),
								"group" => "Image",
							),
							array(
								"type" => "ult_param_heading",
								"text" => "Image size",
								"param_name" => "image_height_typography",
								"class" => "ult-param-heading",
								"group" => "Image",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image width', 'dfd'),
								'param_name' => 'presentation_item_width',
								'value' => 354,
								"group" => "Image",
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image height', 'dfd'),
								'param_name' => 'presentation_item_height',
								'value' => 520,
								"group" => "Image",
							),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
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
		function dfd_presentation_module_shortcode($atts, $content = null)
		{
			$output = $el_class = $module_animation = '';
			$presentation_title = $presentation_subtitle = $button_title = $button_link = $presentation_image = $presentation_item_width = $presentation_item_height = '';
						
			$heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = '';
			$subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			$main_heading_style_inline = $sub_heading_style_inline = $button_html = '';
			
			extract(shortcode_atts( array(
				'module_animation' => '',
				'presentation_title' => '',
				'presentation_subtitle' => '',
				'button_title' => '',
				'button_link' => '',
				'info_alignment' => 'text-center',
				'presentation_image' => '',
				'presentation_item_width' => '354',
				'presentation_item_height' => '520',
				'el_class' => '',
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
				$sub_heading_style_inline .= 'font-family:\''.esc_attr($shfont_family).'\';';
			}elseif(!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
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
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}
			
			$presentation_src = wp_get_attachment_image_src($presentation_image,'full');
				
			$id = uniqid(rand());

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if(empty($presentation_item_width)) {
				$presentation_item_width = 354;
			}
			
			if(empty($presentation_item_height)) {
				$presentation_item_height = 520;
			}
			
			$link_html = $before_link = $after_link = '';
			if(!empty($button_title) && !empty($button_link)) {
				$button_url = vc_build_link($button_link);
				if(!filter_var( $button_url['url'], FILTER_VALIDATE_URL ) === false || $button_url['url'] == '#') {
					$target = !empty($button_url['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $button_url['target'])).'"' : 'target="_self"';
					$before_link .= '<a href="'.esc_url($button_url['url']).'" title="'.esc_attr($button_title).'" class="dfd-presentation-link" '.$target.'>';
					$after_link .= '</a>';
					$link_html .= $before_link . $after_link;
					$button_html .= '<a href="'.esc_url($button_url['url']).'" class="button" '.$target.'>'.esc_html($button_title).'</a>';
				}
			}
			
			$output .= '<div class="dfd-presentation-module-wrap">';
				$output .= '<div id="dfd-presentation-'.esc_attr($id).'" class="dfd-presentation-box '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';

					$output .= '<div class="dfd-presentation-front dfd-open-close-box">';

						if(isset($presentation_src[0]) && $presentation_src[0] != '') {
							$image_url = dfd_aq_resize($presentation_src[0], $presentation_item_width, $presentation_item_height, true, true, true);
							if(!$image_url) {
								$image_url = $presentation_src[0];
							}
							$output .= '<div class="image-wrap">';
								$output .= $before_link.'<img src="'.esc_url($image_url).'" class="clonable" alt="'.esc_attr($presentation_title).'"/>'.$after_link;
							$output .= '</div>';
						}

					$output .= '</div>';
					$output .= '<div class="dfd-presentation-back">';
					
						$output .=  '<a href="#" class="dfd-open-close-box" title=""></a>';
						$output .= $link_html;
						$output .= '<div class="dfd-presentation-content">';
							if($presentation_title != '' || $presentation_subtitle != '') {
								$output .= '<div class="dfd-presentation-heading">';
									if($presentation_title != '') {
										$output .= '<div class="block-title" style="'.$main_heading_style_inline.'">'.$presentation_title.'</div>';
									}
									if($presentation_subtitle != '') {
										$output .= '<div class="subtitle" style="'.$sub_heading_style_inline.'">'.$presentation_subtitle.'</div>';
									}
								$output .= '</div>';
							}

							if($content != '') {
								$output .= '<div class="content">'.wpb_js_remove_wpautop( $content , true ).'</div>';
							}
							$output .= $button_html;
						$output .= '</div>';
						$output .= '<div class="dfd-presentation-background"></div>';
						
					$output .= '</div>';
				$output .= '</div>';

				$output .= '<script type="text/javascript">';
					$output .= '(function($) {';
						$output .= '$(document).ready(function() {
									var wWidth, $window = $(window);
									var scrollbarWidth;
									var div = document.createElement("div");
									div.style.overflowY = "scroll";
									div.style.width =  "50px";
									div.style.height = "50px";
									div.style.visibility = "hidden";
									document.body.appendChild(div);
									scrollbarWidth = div.offsetWidth - div.clientWidth;
									document.body.removeChild(div);
									
									var offsetChecker = function() {
										var windowWidth = $window.width();
										wWidth = windowWidth;
										$(".dfd-presentation-box").each(function() {
											if($(this).offset().left + $(this).width() * 2 >= windowWidth) {
												$(this).addClass("active-left-info");
											} else {
												$(this).removeClass("active-left-info");
											}
										});
									};
									offsetChecker();
									$window.on("load resize", offsetChecker);
									$(".dfd-open-close-box").unbind("click").bind("click touchend", function(e) {
										if((wWidth + scrollbarWidth) > 1279) {
											e.preventDefault();
											var $self = $(this);
											var $presentationBox = $self.parents(".dfd-presentation-box");
											var backface = $presentationBox.find(".dfd-presentation-back .dfd-presentation-link");
											if($presentationBox.hasClass("active")) {
												$presentationBox.removeClass("active");
												backface.find("img").remove();
											} else {
												$(".dfd-presentation-box").removeClass("active").find(".dfd-presentation-back .clonable").remove();
												$presentationBox.addClass("active");
												$self.find(".clonable").clone().prependTo(backface);
											}
										}
									});
								});';
					$output .= '})(jQuery)';
				$output .= '</script>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Presentation_Module'))
{
	$Dfd_Presentation_Module = new Dfd_Presentation_Module;
}
