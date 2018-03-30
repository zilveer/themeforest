<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Just Icon for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Old_Dfd_Just_Icon')) 
{
	class Old_Dfd_Just_Icon
	{
		function __construct()
		{
			add_action('init',array($this,'just_icon_init'));
			add_shortcode('just_icon',array($this,'just_icon_shortcode'));
		}
		function just_icon_init()
		{
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("Just Icon", 'dfd'),
					   "base" => "just_icon",
					   "class" => "vc_simple_icon",
					   "icon" => "vc_just_icon",
					   "category" => __('Ronneby 1.0','dfd'),
					   "description" => __("Add a simple icon and give some custom style.",'dfd'),
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
								"description" => __("Use <a href='admin.php?page=font-icon-Manager' target='_blank'>existing font icon</a> or upload a custom image.", 'dfd')
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
								"admin_label" => true,
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
								"value" => "#333333",
								"description" => __("Give it a nice paint!", 'dfd'),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),						
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon or Image Style", 'dfd'),
								"param_name" => "icon_style",
								"value" => array(
									__('Simple','dfd') => "none",
									__('Circle Background','dfd') => "circle",
									__('Square Background','dfd') => "square",
									__('Design your own','dfd') => "advanced",
								),
								"description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", 'dfd'),
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
									__('None','dfd')=> "",
									__('Solid','dfd')=> "solid",
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
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Link ",'dfd'),
								"param_name" => "icon_link",
								"value" => "",
								"description" => __("Add a custom link or select existing page. You can remove existing link as well.",'dfd')
							),

							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Tooltip", 'dfd'),
								"param_name" => "tooltip_disp",
								"value" => array(
									__('None','dfd')=> "",
									__('Tooltip from Left','dfd') => "left",
									__('Tooltip from Right','dfd') => "right",
									__('Tooltip from Top','dfd') => "top",
									__('Tooltip from Bottom','dfd') => "bottom",
								),
								"description" => __("Select the tooltip position",'dfd'),
							),							
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Tooltip Text", 'dfd'),
								"param_name" => "tooltip_text",
								"value" => "",
								"description" => __("Enter your tooltip text here.", 'dfd'),
								"dependency" => Array("element" => "tooltip_disp", "not_empty" => true),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Alignment", 'dfd'),
								"param_name" => "icon_align",
								"value" => array(
									__('Center','dfd')	=>	"center",
									__('Left','dfd')		=>	"left",
									__('Right','dfd')		=>	"right"
								)
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Custom CSS Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Ran out of options? Need more styles? Write your own CSS and mention the class name here.", 'dfd'),
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
		// Shortcode handler function for stats Icon
		function just_icon_shortcode($atts)
		{
			$icon_type = $module_animation = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation =  $tooltip_disp = $tooltip_text = $icon_align = '';
			extract(shortcode_atts( array(				
				'icon_type' => 'selector',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '48',
				'icon_size' => '32',				
				'icon_color' => '#333333',
				'icon_style' => 'none',
				'icon_color_bg' => '#ffffff',
				'icon_color_border' => '#333333',			
				'icon_border_style' => '',
				'icon_border_size' => '1',
				'icon_border_radius' => '50',
				'icon_border_spacing' => '50',
				'icon_link' => '',
				'icon_animation' => '',
				'tooltip_disp' => '',
				'tooltip_text' => '',
				'module_animation' => '',
				'el_class'=>'',
				'icon_align' => 'center'
			),$atts));
			/*
			$ultimate_js = get_option('ultimate_js');
			if($tooltip_text != '' && $ultimate_js == 'disable')
				wp_enqueue_script('aio-tooltip',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/assets/min-js/tooltip.min.js',array('jquery'));
			*/


			$output = $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = '';
			$uniqid = uniqid();
			if($icon_link !== ''){
				$href = vc_build_link($icon_link);
				$target = (isset($href['target'])) ? "target='".esc_attr(preg_replace('/\s+/', '', $href['target']))."'" : '';
				$link_prefix .= '<a class="aio-tooltip '.esc_attr($uniqid).'" href = "'.esc_url($href['url']).'" '.$target.' data-toggle="tooltip" data-placement="'.esc_attr($tooltip_disp).'" title="'.esc_attr($tooltip_text).'">';
				$link_sufix .= '</a>';
			} else {
				if($tooltip_disp !== ""){
					$link_prefix .= '<div class="aio-tooltip '.esc_attr($uniqid).'" href = "'.esc_url($href).'" '.$target.' data-toggle="tooltip" data-placement="'.esc_attr($tooltip_disp).'" title="'.esc_attr($tooltip_text).'">';
					$link_sufix .= '</div>';
				}
			}
			
			/* position fix */
			if($icon_align == 'right') {
				$icon_align_style .= 'text-align: right;';
			} elseif($icon_align == 'center') {
				$icon_align_style .= 'text-align: center;';
			} elseif($icon_align == 'left') {
				$icon_align_style .= 'text-align: left;';
			}
			
			if($icon_type == 'custom'){
				$img = wp_get_attachment_image_src( $icon_img, 'large');
				$alt = get_post_meta($icon_img, '_wp_attachment_image_alt', true);

				$animate = $animation_data = '';

				if ( ! ( $module_animation == '' ) ) {
					$animate        = ' cr-animate-gen';
					$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
				}

				if($icon_style !== 'none'){
					if($icon_color_bg !== '')
						$style .= 'background:'.esc_attr($icon_color_bg).';';
				}
				if($icon_style == 'circle'){
					$el_class.= ' uavc-circle ';
				}
				if($icon_style == 'square'){
					$el_class.= ' uavc-square ';
				}
				if($icon_style == 'advanced' && $icon_border_style !== '' ){
					$style .= 'border-style:'.esc_attr($icon_border_style).';';
					$style .= 'border-color:'.esc_attr($icon_color_border).';';
					$style .= 'border-width:'.esc_attr($icon_border_size).'px;';
					$style .= 'padding:'.esc_attr($icon_border_spacing).'px;';
					$style .= 'border-radius:'.esc_attr($icon_border_radius).'px;';
				}
				if(!empty($img[0])){
					if($icon_link == '' || $icon_align == 'center') {
						$style .= 'display:inline-block !important;';
					}
					$output .= "\n".$link_prefix.'<div class="aio-icon-img '.esc_attr($el_class).' '.esc_attr($animate).'" style="font-size:'.esc_attr($img_width).'px;'.$style.'" '.$animation_data.'>';
					$output .= "\n\t".'<img class="img-icon" alt="'.esc_attr($alt).'" src="'.esc_url($img[0]).'"/>';	
					$output .= "\n".'</div>'.$link_sufix;
				}
				$output = $output;
			} else {

				$animate = $animation_data = '';

				if ( ! ( $module_animation == '' ) ) {
					$animate        = ' cr-animate-gen';
					$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
				}

				if($icon_color !== '')
					$style .= 'color:'.esc_attr($icon_color).';';
				if($icon_style !== 'none'){
					if($icon_color_bg !== '')
						$style .= 'background:'.esc_attr($icon_color_bg).';';
				}
				if($icon_style == 'advanced'){
					$style .= 'border-style:'.esc_attr($icon_border_style).';';
					$style .= 'border-color:'.esc_attr($icon_color_border).';';
					$style .= 'border-width:'.esc_attr($icon_border_size).'px;';
					$style .= 'width:'.esc_attr($icon_border_spacing).'px;';
					$style .= 'height:'.esc_attr($icon_border_spacing).'px;';
					$style .= 'line-height:'.esc_attr($icon_border_spacing).'px;';
					$style .= 'border-radius:'.esc_attr($icon_border_radius).'px;';
				}
				if($icon_size !== '') {
					$style .='font-size:'.esc_attr($icon_size).'px;';
				}
				
				if($icon_align !== 'left'){
					$style .= 'display:inline-block !important;';
				}



				if($icon !== ""){
					$output .= "\n".$link_prefix.'<div class="aio-icon '.esc_attr($icon_style).' '.esc_attr($el_class).' '.esc_attr($animate).'" style="'.$style.'" '.$animation_data.'>';
					$output .= "\n\t".'<i class="'.esc_attr($icon).'"></i>';	
					$output .= "\n".'</div>'.$link_sufix;
				}
				$output = $output;
			}
			if($tooltip_disp !== ""){
				$output .= '<script>
					jQuery(function () {
						jQuery(".'.$uniqid.'").bsf_tooltip("hide");
					})
				</script>';
			}
			/* alignment fix */
			if($icon_align_style !== ''){
				$output = '<div class="align-icon" style="'.$icon_align_style.'">'.$output.'</div>';
			}
			
			return $output;
		}
	}
}
if(class_exists('Old_Dfd_Just_Icon'))
{
	$Old_Dfd_Just_Icon = new Old_Dfd_Just_Icon;
}