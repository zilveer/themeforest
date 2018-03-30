<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Interactive Banners for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('AIO_Interactive_Banners')) {
	class AIO_Interactive_Banners {
		function __construct() {
			add_action('init',array($this,'banner_init'));
			add_shortcode('interactive_banner',array($this,'banner_shortcode'));
		}
		function banner_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name" => __("Interactive Banner",'dfd'),
					   "base" => "interactive_banner",
					   "class" => "vc_interactive_icon",
					   "icon" => "vc_icon_interactive",
					   "category" => __('Ronneby 1.0','dfd'),
					   "description" => __("Displays the banner image with Information",'dfd'),
					   "params" => array(
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Interactive Banner Title ",'dfd'),
								"param_name" => "banner_title",
								"admin_label" => true,
								"value" => "",
								"description" => __("Give a title to this banner",'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Banner Title Location ",'dfd'),
								"param_name" => "banner_title_location",
								"value" => array(
									__("Title on Center",'dfd')=>'center',
									__("Title on Left",'dfd')=>'left',
								),
								"description" => __("Alignment of the title.",'dfd')
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("Banner Description",'dfd'),
								"param_name" => "banner_desc",
								"value" => "",
								"description" => __("Text that comes on mouse hover.",'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Use Icon", 'dfd'),
								"param_name" => "icon_disp",
								"value" => array(
									__('None','dfd') => "none",
									__('Icon with Heading','dfd') => "with_heading",
									__('Icon with Description','dfd') => "with_description",
									__('Both','dfd') => "both",
								),
								"description" => __("Icon can be displayed with title and description.", 'dfd'),
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon",'dfd'),
								"param_name" => "banner_icon",
								"admin_label" => true,
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=AIO_Icon_Manager' target='_blank'>add new here</a>.", 'dfd'),
								"dependency" => Array("element" => "icon_disp","value" => array("with_heading","with_description","both")),
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Banner Image",'dfd'),
								"param_name" => "banner_image",
								"value" => "",
								"description" => __("Upload the image for this banner",'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Banner height Type",'dfd'),
								"param_name" => "banner_height",
								"value" => array(
										__('Auto Height','dfd')=>'',
										__('Custom Height','dfd')=>'banner-block-custom-height'
									),
								"description" => __("Selct between Auto or Custom height for Banner.",'dfd')
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Banner height Value",'dfd'),
								"param_name" => "banner_height_val",
								"value" => '',
								"suffix"=>'px',
								"description" => __("Give height in pixels for interactive banner.",'dfd'),
								"dependency" => Array("element"=>"banner_height","value"=>array("banner-block-custom-height"))
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Apply link to:", 'dfd'),
								"param_name" => "link_opts",
								"value" => array(
									__('No Link','dfd') => "none",
									__('Complete Box','dfd') => "box",
									__('Display Read More','dfd') => "more",
								),
								"description" => __("Select whether to use color for icon or not.", 'dfd'),
							),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Banner Link ",'dfd'),
								"param_name" => "banner_link",
								"value" => "",
								"description" => __("Add link / select existing page to link to this banner",'dfd'),
								"dependency" => Array("element" => "link_opts", "value" => array("box","more")),
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Link Text",'dfd'),
								"param_name" => "banner_link_text",
								"value" => "",
								"description" => __("Enter text for button",'dfd'),
								"dependency" => Array("element" => "link_opts","value" => array("more")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Box Hover Effects",'dfd'),
								"param_name" => "banner_style",
								"value" => array(
									__("Appear From Bottom",'dfd') => "style01",
									__("Appear From Top",'dfd') => "style02",
									__("Appear From Left",'dfd') => "style03",
									__("Appear From Right",'dfd') => "style04",
									__("Zoom In",'dfd') => "style11",
									__("Zoom Out",'dfd') => "style12",
									__("Zoom In-Out",'dfd') => "style13",
									__("Jump From Left",'dfd') => "style21",
									__("Jump From Right",'dfd') => "style22",
									__("Pull From Bottom",'dfd') => "style31",
									__("Pull From Top",'dfd') => "style32",
									__("Pull From Left",'dfd') => "style33",
									__("Pull From Right",'dfd') => "style34",
								),
								"description" => __("Select animation effect style for this block.",'dfd')
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Heading Background Color",'dfd'),
								"param_name" => "banner_bg_color",
								"value" => "transparent",
								"description" => __("Select the background color for banner heading",'dfd')
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Background Color Opacity",'dfd'),
								"param_name" => "banner_opacity",
								"value" => array(
									__('Transparent Background','dfd')=>'opaque',
									__('Solid Background','dfd')=>'solid'
								),
								"description" => __("Select the background opacity for content overlay",'dfd')
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Add extra class name that will be applied to the icon process, and you can use this class for your customizations.", 'dfd'),
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Banner Title Settings", 'dfd'),
								"param_name" => "banner_title_typograpy",
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "banner_title_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"banner_title_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "banner_title_font_size",
								"min" => 12,
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter Spacing", 'dfd'),
								"param_name" => "banner_title_letter_spacing",
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "ult_param_heading",
								"text" => __("Banner Description Settings", 'dfd'),
								"param_name" => "banner_desc_typograpy",
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "banner_desc_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"banner_desc_style",
								//"description"	=>	__("Main heading font style", 'dfd'),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "banner_desc_font_size",
								"min" => 12,
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Letter Spacing", 'dfd'),
								"param_name" => "banner_desc_letter_spacing",
								"min" => 12,
								"suffix" => "px",
								//"description" => __("Sub heading font size", 'dfd'),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
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
		// Shortcode handler function for stats banner
		function banner_shortcode($atts)
		{
			$banner_title = $module_animation = $banner_desc = $banner_icon = $banner_image = $banner_link = $banner_link_text = $banner_style = $banner_bg_color = $banner_title_font_size = $banner_title_letter_spacing = $banner_desc_letter_spacing = $el_class = $animation = $icon_disp = $link_opts = $banner_title_location = $banner_title_style_inline = $banner_desc_style_inline = '';
			extract(shortcode_atts( array(
				'module_animation' => '',
				'banner_title' => '',
				'banner_desc' => '',
				'banner_title_location' => 'center',
				'icon_disp' => 'none',
				'banner_icon' => '',
				'banner_image' => '',
				'banner_height'=>'',
				'banner_height_val'=>'',
				'link_opts' => 'none',
				'banner_link' => '',
				'banner_link_text' => '',
				'banner_style' => 'style01',
				'banner_bg_color' => 'transparent',
				'banner_opacity' => 'opaque',
				'el_class' =>'',
				'animation' => '',
				'banner_title_font_family' => '',
				'banner_title_style' => '',
				'banner_title_font_size' => '',
				'banner_title_letter_spacing' => '',
				'banner_desc_font_family' => '',
				'banner_desc_style' => '',
				'banner_desc_font_size' => '',
				'banner_desc_letter_spacing' => ''
			),$atts));
			$output = $icon = $style = $target = '';
			//$banner_style = 'style01';
			
			if($banner_title_font_family != '')
			{
				$bfamily = get_ultimate_font_family($banner_title_font_family);
				$banner_title_style_inline = 'font-family:\''.esc_attr($bfamily).'\';';
			}
			$banner_title_style_inline .= get_ultimate_font_style($banner_title_style);
			if($banner_title_font_size != '')
				$banner_title_style_inline .= 'font-size:'.esc_attr($banner_title_font_size).'px;';
			if($banner_title_letter_spacing != '')
				$banner_title_style_inline .= 'letter-spacing:'.esc_attr($banner_title_letter_spacing).'px;';
			if($banner_bg_color != '')
				$banner_title_style_inline .= 'background:'.esc_attr($banner_bg_color).';';
				
			if($banner_desc_font_family != '')
			{
				$bdfamily = get_ultimate_font_family($banner_desc_font_family);
				$banner_desc_style_inline = 'font-family:\''.esc_attr($bdfamily).'\';';
			}
			$banner_desc_style .= get_ultimate_font_style($banner_desc_style);
			if($banner_desc_font_size != '')
				$banner_desc_style_inline .= 'font-size:'.esc_attr($banner_desc_font_size).'px;';
			if($banner_desc_letter_spacing != '')
				$banner_desc_style_inline .= 'letter-spacing:'.esc_attr($banner_desc_letter_spacing).'px;';
			
			//enqueue google font
			$args = array(
				$banner_title_font_family, $banner_desc_font_family
			);
			enquque_ultimate_google_fonts($args);
			

			if($banner_icon !== '')
				$icon = '<i class="'.esc_attr($banner_icon).'"></i>';
			$img = wp_get_attachment_image_src( $banner_image, 'large');
			$href = vc_build_link($banner_link);
			if(isset($href['target']) && $href['target'] != ''){
				$target = 'target="'.esc_attr(preg_replace('/\s+/', '', $href['target'])).'"';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$banner_top_style='';
			if($banner_height!='' && $banner_height_val!=''){
				$banner_top_style = 'height:'.esc_attr($banner_height_val).'px;';
			}
			$output .= "\n".'<div class="banner-block '.esc_attr($banner_height).' banner-'.esc_attr($banner_style).' '.esc_attr($el_class).' '.esc_attr($animate).'"   style="'.$banner_top_style.'" '.$animation_data.'>';
			$output .= "\n\t".'<img src="'.esc_attr($img[0]).'" alt="'.esc_attr($banner_title).'">';
			if($banner_title !== ''){
				$output .= "\n\t".'<div class="block-title title-'.esc_attr($banner_title_location).' bb-top-title" style="'.$banner_title_style_inline.'">'.$banner_title;
				if($icon_disp == "with_heading" || $icon_disp == "both")
					$output .= $icon;
				$output .= '</div>';
			}
			$output .= "\n\t".'<div class="mask '.esc_attr($banner_opacity).'-background">';
			if($icon_disp == "with_description" || $icon_disp == "both"){
				if($banner_icon !== ''){
					$output .= "\n\t\t".'<div class="bb-back-icon">'.$icon.'</div>';
					$output .= "\n\t\t".'<p>'.$banner_desc.'</p>';
				}
			} else {
				$output .= "\n\t\t".'<p class="bb-description" style="'.$banner_desc_style_inline.'">'.$banner_desc.'</p>';
			}
			if($link_opts == "more")
				$output .= "\n\t\t".'<a class="bb-link" href="'.esc_url($href['url']).'" '.$target.'>'.$banner_link_text.'</a>';
			$output .= "\n\t".'</div>';
			$output .= "\n".'</div>';
			if($link_opts == "box"){
				$banner_with_link = '<a class="bb-link" href="'.esc_url($href['url']).'" '.$target.'>'.$output.'</a>';
				return $banner_with_link;
			} else {
				return $output;
			}
		}
	}
}
if(class_exists('AIO_Interactive_Banners'))
{
	$AIO_Interactive_Banners = new AIO_Interactive_Banners;
}
