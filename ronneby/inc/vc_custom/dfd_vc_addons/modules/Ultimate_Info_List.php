<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info List for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Old_Dfd_Info_List'))
{
	class Old_Dfd_Info_List {
		var $connector_animate;
		var $connect_color;
		var $icon_font;
		var $border_col;
		var $icon_style;
		
		function __construct() {
			$this->connector_animate = '';
			$this->connect_color = '';
			$this->icon_font = '';
			$this->border_col = '';
			$this->icon_style = '';
			add_action('init', array($this, 'add_info_list'));
			add_shortcode( 'info_list', array($this, 'info_list' ) );
			add_shortcode( 'info_list_item', array($this, 'info_list_item' ) );
		}
		function info_list($atts, $content = null) {
			$position = $style = $icon_color = $icon_bg_color = $connector_animation = $font_size_icon = $icon_border_style = $icon_border_size = $connector_color = $border_color = $el_class = $info_list_link_html = '';
			extract(shortcode_atts(array(
				'position' => 'left', 
				'style' => 'square with_bg',
				'connector_animation' => '',
				'icon_color' =>'#333333',
				'icon_bg_color' =>'#ffffff',
				'connector_color' => '#333333',
				'border_color' => '#333333',
				'font_size_icon' => '24',
				'icon_border_style' => 'none',
				'icon_border_size' => '1',
				'el_class' => '',
			), $atts));
			
			$icon_css = '';
			$this->connect_color = $connector_color;
			$this->border_col = $border_color;
			if($style == 'square with_bg' || $style == 'circle with_bg' || $style == 'hexagon'){
				$this->icon_font = 'font-size:'.($font_size_icon*3).'px;';
				if($font_size_icon != '') {
					$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
				}
				if($icon_bg_color != '') {
					$icon_css .= 'background:'.esc_attr($icon_bg_color).';';
				}
				if($icon_color != '') {
					$icon_css .= 'color:'.esc_attr($icon_color).';';
				}
				if($icon_border_size !== ''){
					$icon_css .= 'border-width:0px;';
					$icon_css .= 'border-style:none;';
					if($style =="hexagon") {
						$icon_css .= 'border-color:'.esc_attr($icon_bg_color).';';
					} else {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}
				}
				$this->icon_style = $icon_css;
			} else {
				$big_size = ($font_size_icon*3)+($icon_border_size*2);
				if($icon_color != '') {
					$icon_css .= 'color:'.esc_attr($icon_color).';';
				}
				$this->icon_font = 'font-size:'.esc_attr($big_size).'px;';
				if($font_size_icon != '') {
					$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
				}
				if($icon_bg_color != '') {
					$icon_css .= 'background:'.esc_attr($icon_bg_color).';';
				}
				if($icon_border_size !== ''){
					if($icon_border_size != '') {
						$icon_css .= 'border-width:'.esc_attr($icon_border_size).'px;';
					}
					if($icon_border_style != '') {
						$icon_css .= 'border-style:'.esc_attr($icon_border_style).';';
					}
					if($border_color != '') {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}
				}
				$this->icon_style = $icon_css;
			}
			if($position == "top") {
				$this->connector_animate = "fadeInLeft";
			} else {
				$this->connector_animate = $connector_animation;
			}
			$output = '<div class="smile_icon_list_wrap '.esc_attr($el_class).'">';
			$output .= '<ul class="smile_icon_list '.esc_attr($position).' '.esc_attr($style).'">';
			$output .= do_shortcode($content);
			$output .= '</ul>';
			$output .= '</div>';
			return $output;
		}
		function info_list_item($atts,$content = null) {
			// Do nothing
			$list_title = $list_icon = $animation = $icon_color = $icon_bg_color = $icon_img = $icon_type = $desc_font_line_height = $title_font_line_height = '';
			$title_font = $title_font_style = $title_font_size = $title_font_color = $desc_font = $desc_font_style = $desc_font_size = $desc_font_color = '';
			extract(shortcode_atts(array(
				'list_title' => '',
				'icon_type' => 'selector',
				'list_icon' => '',
				'icon_img' => '',
				'animation' => '',
				'info_list_link_apply' => 'no-link', 
				'title_font' => '',
				'title_font_style' => '',
				'title_font_size' => '16',
				'title_font_line_height'=> '24',
				'title_font_color' => '',
				'desc_font' => '',
				'desc_font_style' => '',
				'desc_font_size' => '13',
				'desc_font_color' => '',
				'desc_font_line_height'=> '18',
				'info_list_link' => '',
				'module_animation' => '',
			), $atts));
			//$content =  wpb_js_remove_wpautop($content);
			$css_trans = $style = $ico_col = $connector_trans = $icon_html = $title_style = $desc_style = $info_list_link_html = '';
			$font_args = array();
			
			$is_link = false;
			
			$animate = $animation_data = '';

			if ( ! ($module_animation == '')){
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
			}
			
			if($info_list_link != '') {
				$info_list_link_temp = vc_build_link($info_list_link);
				$url = $info_list_link_temp['url'];
				$title = $info_list_link_temp['title'];
				$target = $info_list_link_temp['target'];
				if($url != '')
				{
					if($target != '')
						$target = 'target="'.esc_attr($target).'"';
					$info_list_link_html = '<a href="'.esc_url($url).'" class="ulimate-info-list-link" '.$target.'></a>';
				}
				$is_link = true;
			}
			
			/* title */
			if($title_font != '') {
				$font_family = get_ultimate_font_family($title_font);
				$title_style .= 'font-family:'.esc_attr($font_family).';';
				array_push($font_args, $title_font);
			}
			if($title_font_style != '')
				$title_style .= get_ultimate_font_style($title_font_style);
			if($title_font_size != '')
				$title_style .= 'font-size:'.esc_attr($title_font_size).'px;';
			if($title_font_line_height != '')
				$title_style .= 'line-height:'.esc_attr($title_font_line_height).'px;';
			if($title_font_color != '')
				$title_style .= 'color:'.esc_attr($title_font_color).';';
				
			/* description */
			if($desc_font != '') {
				$font_family = get_ultimate_font_family($desc_font);
				$desc_style .= 'font-family:'.esc_attr($font_family).';';
				array_push($font_args, $desc_font);
			}
			if($desc_font_style != '') {
				$desc_style .= get_ultimate_font_style($desc_font_style);
			}
			if($desc_font_size != '') {
				$desc_style .= 'font-size:'.esc_attr($desc_font_size).'px;';
			}
			if($desc_font_line_height != '') {
				$desc_style .= 'line-height:'.esc_attr($desc_font_line_height).'px;';
			}
			if($desc_font_color != '') {
				$desc_style .= 'color:'.esc_attr($desc_font_color).';';
			}
			enquque_ultimate_google_fonts($font_args);
			
			if($animation !== 'none') {
				$css_trans = 'data-animation="'.esc_attr($animation).'" data-animation-delay="03"';
			}
			if($this->connector_animate) {
				$connector_trans = 'data-animation="'.esc_attr($this->connector_animate).'" data-animation-delay="02"';
			}
			if($icon_color !=''){
				$ico_col = 'style="color:'.esc_attr($icon_color).'";';
			}
			if($icon_bg_color != ''){
				$style .= 'background:'.esc_attr($icon_bg_color).';  color:'.esc_attr($icon_bg_color).';';	
			}
			if($icon_bg_color != ''){
				$style .= 'border-color:'.esc_attr($this->border_col).';';
			}
			if($icon_type == "selector"){
				$icon_html .= '<div class="icon_list_icon" '.$css_trans.' style="'.$this->icon_style.'">';
				$icon_html .= '<i class="'.esc_attr($list_icon).'" '.$ico_col.'></i>';
				if($is_link && $info_list_link_apply == 'icon')
					$icon_html .= $info_list_link_html;
				$icon_html .= '</div>';
			} else {
				$img = wp_get_attachment_image_src( $icon_img, 'large');
				$icon_html .= '<div class="icon_list_icon" '.$css_trans.' style="'.$this->icon_style.'">';
				$icon_html .= '<img class="list-img-icon" alt="icon" src="'.esc_url($img[0]).'"/>';
				if($is_link && $info_list_link_apply == 'icon')
					$icon_html .= $info_list_link_html;
				$icon_html .= '</div>';
			}
			$output = '<li class="icon_list_item '.esc_attr($animate).'" '.$animation_data.'  style=" '.$this->icon_font.'">';
			$output .= $icon_html;
			$output .= '<div class="icon_description">';
			if($list_title != '')
			{
				$output .= '<div class="feature-title" style="'.$title_style.'">';
				if($is_link && $info_list_link_apply == 'title')
					$output .= '<a href="'.esc_url($url).'" target="'.esc_attr($target).'">'.$list_title.'</a>';
				else
					$output .= $list_title;
				$output .= '</div>';
			}
			$output .= '<div class="icon_description_text" style="'.$desc_style.'">'.wpb_js_remove_wpautop($content, true).'</div>';
			$output .= '</div>';
			$output .= '<div class="icon_list_connector" '.$connector_trans.' style="border-color:'.esc_attr($this->connect_color).';"></div>';
			if($is_link && $info_list_link_apply == 'container') {
				$output .= $info_list_link_html;
			}
			$output .= '</li>';
			return $output;
		}
		function add_info_list() {
			if(function_exists('vc_map'))
			{
				vc_map(
				array(
				   "name" => __("Info List",'dfd'),
				   "base" => "info_list",
				   "class" => "vc_info_list",
				   "icon" => "vc_icon_list",
				   "category" => __('Ronneby 1.0','dfd'),
				   "as_parent" => array('only' => 'info_list_item'),
				   "description" => __("Text blocks connected together in one list.",'dfd'),
				   "content_element" => true,
				   "show_settings_on_create" => true,
				   "params" => array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon or Image Position",'dfd'),
							"param_name" => "position",
							"value" => array(
								__('Icon to the Left','dfd') => 'left',
								__('Icon to the Right','dfd') => 'right',
								__('Icon at Top','dfd') => 'top',
								),
							"description" => __("Select the icon position for icon list.",'dfd')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Style of Image or Icon + Color",'dfd'),
							"param_name" => "style",
							"value" => array(
								__('Square With Background','dfd') => 'square with_bg',
								__('Square Without Background','dfd') => 'square no_bg',
								__('Circle With Background','dfd') => 'circle with_bg',
								__('Circle Without Background','dfd') => 'circle no_bg',
								__('Hexagon With Background','dfd') => 'hexagon',
								),
							"description" => __("Select the icon style for icon list.",'dfd')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Border Style", 'dfd'),
							"param_name" => "icon_border_style",
							"value" => array(
								__('None','dfd') => "none",
								__('Solid','dfd')	=> "solid",
								__('Dashed','dfd') => "dashed",
								__('Dotted','dfd') => "dotted",
								__('Double','dfd') => "double",
								__('Inset','dfd') => "inset",
								__('Outset','dfd') => "outset",
							),
							"description" => __("Select the border style for icon.",'dfd'),
							"dependency" => Array("element" => "style", "value" => array("square no_bg","circle no_bg")),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Border Width", 'dfd'),
							"param_name" => "icon_border_size",
							"value" => 1,
							"min" => 0,
							"max" => 10,
							"suffix" => "px",
							"description" => __("Thickness of the border.", 'dfd'),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Border Color:", 'dfd'),
							"param_name" => "border_color",
							"value" => "#333333",
							"description" => __("Select the color border.", 'dfd'),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),								
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Connector Line Color:", 'dfd'),
							"param_name" => "connector_color",
							"value" => "#333333",
							"description" => __("Select the color for connector line.", 'dfd'),
							"group" => "Connector"							
						),
						array(
							"type" => "checkbox",
							"class" => "",
							"heading" => __("Connector Line Animation: ",'dfd'),
							"param_name" => "connector_animation",
							"value" => array (
								__('Enabled','dfd') => 'fadeInUp',
							),
							"description" => __("Select wheather to animate connector or not",'dfd'),
							"group" => "Connector"
						),
						
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Icon Background Color:", 'dfd'),
							"param_name" => "icon_bg_color",
							"value" => "#ffffff",
							"description" => __("Select the color for icon background.", 'dfd'),								
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("Icon Color:", 'dfd'),
							"param_name" => "icon_color",
							"value" => "#333333",
							"description" => __("Select the color for icon.", 'dfd'),								
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("Icon Font Size", 'dfd'),
							"param_name" => "font_size_icon",
							"value" => 24,
							"min" => 12,
							"max" => 72,
							"suffix" => "px",
							"description" => __("Enter value in pixels.", 'dfd')
						),
						
						// Customize everything
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Extra Class", 'dfd'),
							"param_name" => "el_class",
							"value" => "",
							"description" => __("Add extra class name that will be applied to the info list, and you can use this class for your customizations.", 'dfd'),
						),
						/*array(
							"type" => "heading",
							"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/v9k0x' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
							"param_name" => "notification",
							'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
						),
						array(
							"type" => "heading",
							"sub_heading" => "<a href='https://www.youtube.com/watch?v=zCow1h_FDY4&index=27&list=UUtFCcrvupjyaq2lax_7OQQg' target='_blank'><span class='dashicons dashicons-video-alt3' style='font-size:30px;padding: 4px 0;'></span></a>",
							"param_name" => "notification",
							'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-center ult-bold-font ult-red-font vc_column vc_col-sm-1',
						),*/
					),
					"js_view" => 'VcColumnView'
				));
				// Add list item
				vc_map(
					array(
					   "name" => __("Info List Item", 'dfd'),
					   "base" => "info_list_item",
					   "class" => "vc_info_list",
					   "icon" => "vc_icon_list",
					   "category" => __('DFD VC Addons','dfd'),
					   "content_element" => true,
					   "as_child" => array('only' => 'info_list'),
					   "params" => array(
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("Title",'dfd'),
							"admin_label" => true,
							"param_name" => "list_title",
							"value" => "",
							"description" => __("Provide a title for this icon list item.",'dfd')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon to display:", 'dfd'),
							"param_name" => "icon_type",
							"value" => array(
								__('Font Icon Manager','dfd') => "selector",
								__('Custom Image Icon','dfd') => "custom",
							),
							"description" => __("Use <a href='admin.php?page=font-icon-Manager' target='_blank'>existing font icon</a> or upload a custom image.", 'dfd')
						),
						array(
							"type" => "icon_manager",
							"class" => "",
							"heading" => __("Select List Icon ",'dfd'),
							"param_name" => "list_icon",
							"value" => "",
							"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", 'dfd'),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),
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
							"type" => "dropdown",
							"class" => "",
							"heading" => __("Icon Animation",'dfd'),
							"param_name" => "animation",
							"value" => array(
								__("No Animation",'dfd') => "",
								__("Swing",'dfd') => "swing",
								__("Pulse",'dfd') => "pulse",
								__("Fade In",'dfd') => "fadeIn",
								__("Fade In Up",'dfd') => "fadeInUp",
								__("Fade In Down",'dfd') => "fadeInDown",
								__("Fade In Left",'dfd') => "fadeInLeft",
								__("Fade In Right",'dfd') => "fadeInRight",
								__("Fade In Up Long",'dfd') => "fadeInUpBig",
								__("Fade In Down Long",'dfd') => "fadeInDownBig",
								__("Fade In Left Long",'dfd') => "fadeInLeftBig",
								__("Fade In Right Long",'dfd') => "fadeInRightBig",
								__("Slide In Down",'dfd') => "slideInDown",
								__("Slide In Left",'dfd') => "slideInLeft",
								__("Slide In Left",'dfd') => "slideInLeft",
								__("Bounce In",'dfd') => "bounceIn",
								__("Bounce In Up",'dfd') => "bounceInUp",
								__("Bounce In Down",'dfd') => "bounceInDown",
								__("Bounce In Left",'dfd') => "bounceInLeft",
								__("Bounce In Right",'dfd') => "bounceInRight",
								__("Rotate In",'dfd') => "rotateIn",
								__("Light Speed In",'dfd') => "lightSpeedIn",
								__("Roll In",'dfd') => "rollIn",
							),
							"description" => __("Select the animation style for icon.",'dfd')
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("Description",'dfd'),
							"param_name" => "content",
							"value" => "",
							"description" => __("Description about this list item",'dfd')
						),
						array(
							"type" => "dropdown",
							"heading" => "Apply link To",
							"param_name" => "info_list_link_apply",
							"value" => array(
								__('No Link','dfd') => "no-link",
								__('Complete Container','dfd') => "container",
								__('List Title','dfd') => "title",
								__('Icon','dfd') => "icon"
							)
						),
						array(
							"type" => "vc_link",
							"heading" => "Link",
							"param_name" => "info_list_link",
							"dependency" => array("element" => "info_list_link_apply", "value" => array("container","title","icon"))
						),
						array(
								"type" => "ult_param_heading",
								"param_name" => "title_text_typography",
								"text" => __("Title settings", 'dfd'),
								"value" => "",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "title_font",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "title_font_style",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "title_font_size",
								"heading" => "Font size",
								"value" => "16",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "title_font_line_height",
								"heading" => "Font Line Height",
								"value" => "24",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"param_name" => "title_font_color",
								"heading" => "Color",
								"group" => "Typography"
							),
							array(
								"type" => "ult_param_heading",
								"param_name" => "desc_text_typography",
								"text" => __("Description settings", 'dfd'),
								"value" => "",
								"group" => "Typography",
								"class" => "ult-param-heading",
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "desc_font",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "desc_font_style",
								"value" => "",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "desc_font_size",
								"heading" => "Font size",
								"value" => "13",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "desc_font_line_height",
								"heading" => "Font Line Height",
								"value" => "18",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "colorpicker",
								"param_name" => "desc_font_color",
								"heading" => "Color",
								"group" => "Typography"
							),
							array(
							   'type'        => 'dropdown',
							   'class'       => '',
							   'heading'     => __( 'Animation', 'dfd' ),
							   'param_name'  => 'module_animation',
							   'value'       => dfd_module_animation_styles(),
							   'description' => __( '', 'dfd' ),
							   'group'       => 'Animation Settings',
							)
						)
					) 
				);
			}//endif
		}
	}
}
global $Old_Dfd_Info_List; // WPB: Beter to create singleton in Old_Dfd_Info_List I think, but it also work
if(class_exists('WPBakeryShortCodesContainer'))
{
	if(!class_exists('WPBakeryShortCode_info_list')){
		class WPBakeryShortCode_info_list extends WPBakeryShortCodesContainer {
			function content( $atts, $content = null ) {
				global $Old_Dfd_Info_List;
				return $Old_Dfd_Info_List->front_info_list($atts, $content);
			}
		}
	}
	if(!class_exists('WPBakeryShortCode_info_list_item')){
		class WPBakeryShortCode_info_list_item extends WPBakeryShortCode {
			function content($atts, $content = null ) {
				global $Old_Dfd_Info_List;
				return $Old_Dfd_Info_List->front_info_list_item($atts, $content);
			}
		}
	}
}
if(class_exists('Old_Dfd_Info_List'))
{
	$Old_Dfd_Info_List = new Old_Dfd_Info_List;
}