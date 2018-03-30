<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Icons Block for Visual Composer
*/
if(!class_exists('Ultimate_List_Icon')) 
{
	class Ultimate_List_Icon {
		
		var $icon_font;
		var $icon_margin;
		var $icon_bottom_margin;
		
		function __construct() {
			$this->icon_font = '';
			$this->icon_margin = '';
			$this->icon_bottom_margin = '';
			add_action('init',array($this,'list_icon_init'));
			add_shortcode('ultimate_icon_list',array($this,'ultimate_icon_list_shortcode'));
			add_shortcode('ultimate_icon_list_item',array($this,'icon_list_item_shortcode'));
		}
		function list_icon_init() {
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
						'name' => __('List Icon', 'dfd'),
						'base' => 'ultimate_icon_list',
						'class' => 'ultimate_icon_list',
						'icon' => 'ultimate_icon_list',
						'category' => __('Ronneby 1.0','dfd'),
						'description' => __('Add a set of multiple icons and give some custom style.','dfd'),
						'as_parent' => array('only' => 'ultimate_icon_list_item'), 
						'content_element' => true,
						'show_settings_on_create' => true,
						'js_view' => 'VcColumnView',
						'params' => array(							
							// Play with icon selector
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
								
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Space under list item', 'dfd'),
								'param_name' => 'icon_bottom_margin',
								'value' => 20,
								'min' => 0,
								'max' => 100,
								'suffix' => 'px',
								'description' => __('Space under list item', 'dfd'),
								
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Write your own CSS and mention the class name here.', 'flip-box'),
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
						)
					)
				);
				vc_map(
					array(
					   "name" => __("List Icon Item", 'dfd'),
					   "base" => "ultimate_icon_list_item",
					   "class" => "icon_list_item",
					   "icon" => "icon_list_item",
					   "category" => __('DFD VC Addons','dfd'),
					   "description" => __("Add a list of icons with some content and give some custom style.",'dfd'),
					   "as_child" => array('only' => 'ultimate_icon_list'), 
					   "show_settings_on_create" => true,
					   "params" => array(
							// Play with icon selector
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", 'dfd'),
								"param_name" => "icon_type",
								"value" => array(
									__('Font Icon Manager','dfd') => "selector",
									__('Custom Image Icon','dfd') => "custom",
								),
								"description" => __("Use an existing font icon</a> or upload a custom image.", 'dfd')
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ",'dfd'),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "flip-box"),
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
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color", 'dfd'),
								"param_name" => "icon_color",
								"value" => "#333333",
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
								"value" => "#ffffff",
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
								"value" => "#333333",
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
								"value" => 50,
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
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("List content", 'dfd'),
								"param_name" => "content",
								"value" => "",
								"description" => __("Enter the list content here.", 'dfd'),
								"group"=> "List Content"
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Custom CSS Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Ran out of options? Need more styles? Write your own CSS and mention the class name here.", 'dfd'),
								
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for list Icon
		function ultimate_icon_list_shortcode($atts,$content = null)
		{
			$el_class = $icon_size = $icon_margin = $icon_bottom_margin = $module_animation = $animate = $animation_data = '';
			extract(shortcode_atts(array(
				"icon_size" => "32",
				"icon_margin" => "5",
				"icon_bottom_margin" => "20",
				"module_animation" => "",
				"el_class" => ""
			),$atts));
			
			$this->icon_font = $icon_size;
			$this->icon_margin = $icon_margin;
			$this->icon_bottom_margin = $icon_bottom_margin;
			
			// enqueue js
			//wp_enqueue_script('aio-tooltip',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/tooltip.min.js',array('jquery'));

			$animate = $animation_data = '';
			if ( ! ($module_animation == '')){
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-item=".uavc-list-content" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			$output = '<div class="uavc-list-icon '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
			$output .= '<ul class="uavc-list">';
			$output .= do_shortcode($content);
			$output .= '</ul>';
			$output .= '</div>';
			
			return $output;
		}
		
		function icon_list_item_shortcode($atts, $content = null){
			
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation =  $tooltip_disp = $tooltip_text = $icon_margin = $icon_bottom_margin = '';
			$output = $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = $list_ictem_style = '';
			extract(shortcode_atts( array(
				'icon_type' => 'selector',
				'icon'=> '',
				'icon_img' => '',						
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_color_border' => '#333333',			
				'icon_border_style' => '',
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				//"icon_size" => "",
				//"icon_margin" => "",
				'el_class'=>'',
			),$atts));

			if(empty($icon_size)) {
				$icon_size = $this->icon_font;
			}
			
			if(empty($icon_margin)) {
				$icon_margin = $this->icon_margin;
			}
			
			if(empty($icon_bottom_margin)) {
				$icon_bottom_margin = $this->icon_bottom_margin;
			}
			
			if($icon_margin !== '') {
				if(is_rtl()) {
					$style .= 'margin-left:'.esc_attr($icon_margin).'px;';
				} else {
					$style .= 'margin-right:'.esc_attr($icon_margin).'px;';
				}	
			}
			
			if($icon_bottom_margin !== '') {
				$list_ictem_style .= 'margin-bottom:'.esc_attr($icon_bottom_margin).'px;';
			}
				
			$icon_animation = $icon_link = '';
			
			$output .= '<div class="uavc-list-content" style="'.$list_ictem_style.'">';
			
			if($icon !== "" || $icon_img !== ''){
				if($icon_type == 'custom'){
					$icon_style = 'none';
				}
				$main_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$icon_size.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_link="'.$icon_link.'" icon_animation="'.$icon_animation.'"]');
				$output .= "\n".'<div class="uavc-list-icon '.esc_attr($el_class).'" style="'.$style.'">';
				$output .= $main_icon;				
				$output .= "\n".'</div>';
			}
			$output .= '<div class="uavc-list-desc">'.wpb_js_remove_wpautop($content, true).'</div>';
			$output .= '</div>';
			
			$output = '<li>'.$output.'</li>';
			return $output;
		}
	}
}
if(class_exists('Ultimate_List_Icon')){
	$Ultimate_List_Icon = new Ultimate_List_Icon;
}
//Extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_ultimate_icon_list') ) {
    class WPBakeryShortCode_ultimate_icon_list extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) && !class_exists('WPBakeryShortCode_ultimate_icon_list_item') ) {
    class WPBakeryShortCode_ultimate_icon_list_item extends WPBakeryShortCode {
    }
}