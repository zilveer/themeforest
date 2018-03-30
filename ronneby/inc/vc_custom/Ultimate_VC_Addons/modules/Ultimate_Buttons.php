<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Module - Buttons
*/
if(!class_exists("Ultimate_Buttons")){
	class Ultimate_Buttons{
		function __construct(){
			add_action( 'init', array($this, 'init_buttons') );
			add_shortcode( 'ult_buttons',array($this,'ult_buttons_shortcode'));
			add_action( 'admin_enqueue_scripts', array( $this, 'button_admin_scripts') );
		}
		function button_admin_scripts($hook){
			if($hook == "post.php" || $hook == "post-new.php"){
				wp_enqueue_style( 'ult-button', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/css/btn-min.css' );
			}
		}
		function ult_buttons_shortcode($atts){
			
			$output = $module_animation = $btn_title = $btn_link = $btn_size = $btn_width = $btn_height = $btn_hover = $btn_bg_color = $btn_radius = $btn_shadow = '';
			$btn_shadow_color = $btn_bg_color_hover = $btn_border_style = $btn_color_border = $btn_border_size = $btn_shadow_size = $el_class = '';
			$btn_font_family = $btn_font_style = $btn_title_color = $btn_font_size = $icon = $icon_size = $icon_color = $btn_icon_pos = $btn_anim_effect = '';
			$btn_padding_left = $btn_padding_top = $button_bg_img = $btn_title_color_hover = $btn_align = $btn_color_border_hover = $btn_shadow_color_hover = '';
			$btn_shadow_click = $enable_tooltip = $tooltip_text = $tooltip_pos = '';
			extract(shortcode_atts(array(
				'btn_title' => '',
				'btn_link' => '',
				'btn_size' => 'ubtn-normal',
				'btn_width' => '',
				'btn_height' => '',
				'btn_padding_left' => '',
				'btn_padding_top' => '',
				'btn_hover' => 'ubtn-no-hover-bg',
				'btn_bg_color' => '',
				'btn_radius' => '',
				'btn_shadow' => '',
				'btn_shadow_color' => '',
				'btn_shadow_size' => '',
				'btn_bg_color_hover' => '',
				'btn_title_color_hover' => '',
				'btn_border_style' => '',
				'btn_color_border' => '',
				'btn_color_border_hover' => '',
				'btn_border_size' => '',
				'btn_font_family' => '',
				'btn_font_style' => '',
				'btn_title_color' => '',
				'btn_font_size' => '',
				'icon' => '',
				'icon_size' => '',
				'icon_color' => '',
				'btn_icon_pos' => '',
				'btn_anim_effect' => '',
				'button_bg_img' => '',
				'btn_align' => 'ubtn-left',
				'btn_shadow_color_hover' => '',
				'btn_shadow_click' => '',
				'enable_tooltip' => '',
				'tooltip_text' => '',
				'tooltip_pos' => 'left',
				'module_animation' => '',
				'el_class' => '',
			),$atts));
			
			$style = $hover_style = $btn_style_inline = $link_sufix = $link_prefix = $img = $shadow_hover = $shadow_click = $shadow_color = $box_shadow = '';
			$tooltip = $tooltip_class = '';
			$el_class .= ' '.$btn_anim_effect.' ';
			$uniqid = uniqid();
			$tooltip_class = 'tooltip-'.$uniqid;
			
			if($enable_tooltip == "yes"){
				wp_enqueue_script('aio-tooltip',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/'.'tooltip.min.js',array('jquery'));
				wp_enqueue_style('aio-tooltip',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/'.'tooltip.min.css');
				$tooltip .= 'data-toggle="tooltip" data-placement="'.esc_attr($tooltip_pos).'" title="'.esc_attr($tooltip_text).'"';
				$tooltip_class .= " ubtn-tooltip ".$tooltip_pos;
			}
			
			if($btn_shadow_click !== "enable"){
				$shadow_click = 'none';
			}
			if($btn_shadow_color_hover == "")
				$shadow_color = $btn_shadow_color;
			else
				$shadow_color = $btn_shadow_color_hover;
			
			if($button_bg_img !== ''){
				$img = wp_get_attachment_image_src( $button_bg_img, 'large');
				$img = $img[0];
			}
			if($btn_link !== ''){
				$href = vc_build_link($btn_link);
				if($href['url'] !== ""){
					$target = (isset($href['target']) && !empty($href['target'])) ? "target='".esc_attr($href['target'])."'" : 'target="_self"';
					if($btn_size == "ubtn-block"){
						$tooltip_class .= ' ubtn-block';
					}
					$link_prefix .= '<a class="ubtn-link '.esc_attr($btn_align).' '.esc_attr($tooltip_class).'" '.$tooltip.' href = "'.esc_url($href['url']).'" '.$target.'>';
					$link_sufix .= '</a>';
				}
			} else {
				if($enable_tooltip !== ""){
					$link_prefix .= '<span class="'.esc_attr($btn_align).' '.esc_attr($tooltip_class).'" '.$tooltip.'>';
					$link_sufix .= '</span>';
				}
			}
			if($btn_icon_pos !== '' && $icon !== 'none' && $icon !== '')
				$el_class .= ' ubtn-sep-icon '.esc_attr($btn_icon_pos).' ';
			
			if($btn_font_family != '')
			{
				$mhfont_family = get_ultimate_font_family($btn_font_family);
				$btn_style_inline .= 'font-family:\''.$mhfont_family.'\';';
				
				//enqueue google font
				$args = array(
					$mhfont_family
				);
				enquque_ultimate_google_fonts($args);
			}
			$btn_style_inline .= get_ultimate_font_style($btn_font_style);
			if($btn_font_size !== ''){
				$btn_style_inline .= 'font-size:'.esc_attr($btn_font_size).'px;';
			}
			$style .= $btn_style_inline;
			if($btn_size == 'ubtn-custom'){
				$style .= 'width:'.esc_attr($btn_width).'px;';
				$style .= 'min-height:'.esc_attr($btn_height).'px;';
				$style .= 'line-height:'.esc_attr($btn_height).'px;';
				$style .= 'padding:'.esc_attr($btn_padding_top).'px '.esc_attr($btn_padding_left).'px;';
			}
			if($btn_border_style !== ''){
				$style .= 'border-radius:'.esc_attr($btn_radius).'px;';
				$style .= 'border-width:'.esc_attr($btn_border_size).'px;';
				$style .= 'border-color:'.esc_attr($btn_color_border).';';
				$style .= 'border-style:'.esc_attr($btn_border_style).';';
			} else {
				$style .= 'border:none;';
			}
			if($btn_shadow !== ''){
				switch($btn_shadow){
					case 'shd-top':
						$style .= 'box-shadow: 0 -'.esc_attr($btn_shadow_size).'px '.esc_attr($btn_shadow_color).';';
						// $style .= 'bottom: '.($btn_shadow_size-3).'px;';
						$box_shadow .= '0 -'.esc_attr($btn_shadow_size).'px '.esc_attr($btn_shadow_color).';';
						if($shadow_click !== "none")
							$shadow_hover .= '0 -3px '.esc_attr($shadow_color).';';
						else
							$shadow_hover .= '0 -'.esc_attr($btn_shadow_size).'px '.esc_attr($shadow_color).';';
						break;
					case 'shd-bottom':
						$style .= 'box-shadow: 0 '.esc_attr($btn_shadow_size).'px '.esc_attr($btn_shadow_color).';';
						// $style .= 'top: '.($btn_shadow_size-3).'px;';
						$box_shadow .= '0 '.esc_attr($btn_shadow_size).'px '.esc_attr($btn_shadow_color).';';
						if($shadow_click !== "none")
							$shadow_hover .= '0 3px '.esc_attr($shadow_color).';';	
						else
							$shadow_hover .= '0 '.$btn_shadow_size.'px '.$shadow_color.';';
						break;
					case 'shd-left':
						$style .= 'box-shadow: -'.esc_attr($btn_shadow_size).'px 0 '.esc_attr($btn_shadow_color).';';
						// $style .= 'right: '.($btn_shadow_size-3).'px;';
						$box_shadow .= '-'.esc_attr($btn_shadow_size).'px 0 '.esc_attr($btn_shadow_color).';';
						if($shadow_click !== "none")
							$shadow_hover .= '-3px 0 '.esc_attr($shadow_color).';';
						else
							$shadow_hover .= '-'.esc_attr($btn_shadow_size).'px 0 '.esc_attr($shadow_color).';';	
						break;
					case 'shd-right':
						$style .= 'box-shadow: '.esc_attr($btn_shadow_size).'px 0 '.esc_attr($btn_shadow_color).';';
						// $style .= 'left: '.($btn_shadow_size-3).'px;';
						$box_shadow .= esc_attr($btn_shadow_size).'px 0 '.esc_attr($btn_shadow_color).';';
						if($shadow_click !== "none")
							$shadow_hover .= '3px 0 '.esc_attr($shadow_color).';';
						else
							$shadow_hover .= esc_attr($btn_shadow_size).'px 0 '.esc_attr($shadow_color).';';
						break;
				}
			}
			if($btn_bg_color !== ''){
				$style .= 'background: '.esc_attr($btn_bg_color).';';
			}
			if($btn_title_color !== ''){
				$style .= 'color: '.esc_attr($btn_title_color).';';
			}
			
			if($btn_shadow){
				$el_class .= ' ubtn-shd ';
			}
			if($btn_align){
				$el_class .= ' '.esc_attr($btn_align).' ';
			}
			if($btn_title == "" && $icon !== ""){
				$el_class .= ' ubtn-only-icon ';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			$output .= '<span class="'.esc_attr($animate).' ubtn '.esc_attr($btn_size.' '.$btn_hover.' '.$el_class.' '.$btn_shadow).'" '.$animation_data.' data-hover="'.esc_attr($btn_title_color_hover).'" data-border-color="'.esc_attr($btn_color_border).'" data-hover-bg="'.$btn_bg_color_hover.'" data-border-hover="'.$btn_color_border_hover.'" data-shadow-hover="'.$shadow_hover.'" data-shadow-click="'.$shadow_click.'" data-shadow="'.$box_shadow.'" data-shd-shadow="'.esc_attr($btn_shadow_size).'" style="'.$style.'">';
			if($icon !== ''){
				$output .= '<span class="ubtn-data ubtn-icon"><i class="'.esc_attr($icon).'" style="font-size:'.esc_attr($icon_size).'px;color:'.esc_attr($icon_color).';"></i></span>';
			}
			$output .= '<span class="ubtn-hover"></span>';
			$output .= '<span class="ubtn-data ubtn-text" data-lang="en">'.$btn_title.'</span>';
			$output .= '</span>';
			
			$output = $link_prefix.$output.$link_sufix;
			
			if($btn_align == "ubtn-center"){
				$output = '<div class="ubtn-ctn-center">'.$output.'</div>';
			}
			if($img !== ''){
				$html = '<div class="ubtn-img-container">';
				$html .= '<img src="'.esc_url($img).'"/>';
				$html .= $output;
				$html .= '</div>';
				$output = $html;
			}
			
			if($enable_tooltip !== ""){
				$output .= '<script>
					jQuery(function () {
						jQuery(".tooltip-'.esc_js($uniqid).'").bsf_tooltip();
					})
				</script>';
			}
			return $output;
		}
		function init_buttons(){
			if(function_exists("vc_map"))
			{
				$json = ultimate_get_icon_position_json();
				vc_map(
					array(
						"name" => __("Advanced Button", "js_composer"),
						"base" => "ult_buttons",
						"icon" => "ult_buttons",
						"class" => "ult_buttons",
						"content_element" => true,
						"controls" => "full",
						"category" => __('Ronneby 1.0','dfd'),
						"description" => "Create creative buttons.",
						"params" => array(
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Button Title",'dfd'),
								"param_name" => "btn_title",
								"value" => "",
								"description" => "",
								"group" => "General",
								"admin_label" => true
						  	),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Button Link",'dfd'),
								"param_name" => "btn_link",
								"value" => "",
								"description" => "",
								"group" => "General"
						  	),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Alignment",'dfd'),
								"param_name" => "btn_align",
								"value" => array(
										__('Left Align','dfd') => "ubtn-left",
										__('Center Align','dfd') => "ubtn-center",
										__('Right Align','dfd') => "ubtn-right",
									),
								"description" => "",
								"group" => "General"
						  	),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Size",'dfd'),
								"param_name" => "btn_size",
								"value" => array(
										__('Normal Button', 'dfd') => "ubtn-normal",
										__('Mini Button', 'dfd') => "ubtn-mini",
										__('Small Button', 'dfd') => "ubtn-small",
										__('Large Button', 'dfd') => "ubtn-large",
										__('Button Block', 'dfd') => "ubtn-block",
										__('Custom Size', 'dfd') => "ubtn-custom",
									),
								"description" => "",
								"group" => "General"
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Button Width",'dfd'),
								"param_name" => "btn_width",
								"value" => "",
								"min" => 10,
								"max" => 1000,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_size", "value" => "ubtn-custom" ),
								"group" => "General"
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Button Height",'dfd'),
								"param_name" => "btn_height",
								"value" => "",
								"min" => 10,
								"max" => 1000,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_size", "value" => "ubtn-custom" ),
								"group" => "General"
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Button Left / Right Padding",'dfd'),
								"param_name" => "btn_padding_left",
								"value" => "",
								"min" => 10,
								"max" => 1000,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_size", "value" => "ubtn-custom" ),
								"group" => "General"
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Button Top / Bottom Padding",'dfd'),
								"param_name" => "btn_padding_top",
								"value" => "",
								"min" => 10,
								"max" => 1000,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_size", "value" => "ubtn-custom" ),
								"group" => "General"
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Button Title Color",'dfd'),
								"param_name" => "btn_title_color",
								"value" => "",
								"description" => "",
								"group" => "General"
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Background Color",'dfd'),
								"param_name" => "btn_bg_color",
								"value" => "",
								"description" => "",
								"group" => "General"
						  	),
							array(
								"type" => "textfield",
								"heading" => __("Extra class name", "js_composer"),
								"param_name" => "el_class",
								"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
								"group" => "General"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Hover Background Effect",'dfd'),
								"param_name" => "btn_hover",
								"value" => array(
										__('No Effect','dfd') => "ubtn-no-hover-bg",
										__('Fade Background','dfd') => "ubtn-fade-bg",
										__('Fill Background from Top','dfd') => "ubtn-top-bg",
										__('Fill Background from Bottom','dfd') => "ubtn-bottom-bg",
										__('Fill Background from Left','dfd') => "ubtn-left-bg",
										__('Fill Background from Right','dfd') => "ubtn-right-bg",
										__('Fill Background from Center Horizontally','dfd') => "ubtn-center-hz-bg",
										__('Fill Background from Center Vertically','dfd') => "ubtn-center-vt-bg",
										__('Fill Background from Center Diagonal','dfd') => "ubtn-center-dg-bg",
									),
								"description" => "",
								"group" => "Background"
						  	),
							array(
								"type" => "dropdown",
								"class" => "no-ult-effect",
								'edit_field_class' => 'ult-no-effect vc_column vc_col-sm-12',
								"heading" => __("Button Hover Animation Effects",'dfd'),
								"param_name" => "btn_anim_effect",
								"value" => array(
										__('No Effect', 'dfd') 			   => "none",
										__('Grow', 'dfd') 					=> "ulta-grow",
										__('Shrink', 'dfd') 			  	  => "ulta-shrink",
										__('Pulse', 'dfd') 			   	   => "ulta-pulse",
										__('Pulse Grow', 'dfd') 		  	  => "ulta-pulse-grow",
										__('Pulse Shrink', 'dfd') 			=> "ulta-pulse-shrink",
										__('Push', 'dfd') 					=> "ulta-push",
										__('Pop', 'dfd') 				 	 => "ulta-pop",
										__('Rotate', 'dfd') 			  	  => "ulta-rotate",
										__('Grow Rotate', 'dfd') 		 	 => "ulta-grow-rotate",
										__('Float', 'dfd') 			   	   => "ulta-float",
										__('Sink', 'dfd') 					=> "ulta-sink",
										__('Hover', 'dfd') 			   	   => "ulta-hover",
										__('Hang', 'dfd') 					=> "ulta-hang",
										__('Skew', 'dfd') 					=> "ulta-skew",
										__('Skew Forward', 'dfd') 			=> "ulta-skew-forward",
										__('Skew Backward', 'dfd') 	   	   => "ulta-skew-backward",
										__('Wobble Horizontal', 'dfd')   	   => "ulta-wobble-horizontal",
										__('Wobble Vertical', 'dfd') 	 	 => "ulta-wobble-vertical",
										__('Wobble to Bottom Right', 'dfd')  => "ulta-wobble-to-bottom-right",
										__('Wobble to Top Right', 'dfd') 	 => "ulta-wobble-to-top-right",
										__('Wobble Top', 'dfd') 		  	  => "ulta-wobble-top",
										__('Wobble Bottom', 'dfd') 	   	   => "ulta-wobble-bottom",
										__('Wobble Skew', 'dfd') 		 	 => "ulta-wobble-skew",
										__('Buzz', 'dfd') 					=> "ulta-buzz",
										__('Buzz Out', 'dfd') 				=> "ulta-buzz-out",
									//	__('Random text', 'dfd') 				=> "chaffle",
									),
								"description" => "",
								"group" => "Background"
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Hover Background Color",'dfd'),
								"param_name" => "btn_bg_color_hover",
								"value" => "",
								"description" => "",
								"group" => "Background"
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Hover Text Color",'dfd'),
								"param_name" => "btn_title_color_hover",
								"value" => "",
								"description" => "",
								"group" => "Background"
						  	),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Button Background Image",'dfd'),
								"param_name" => "button_bg_img",
								"value" => "",
								"description" => __("Upload the image on which you want to place the button.",'dfd'),
								"group" => "Background"
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("Select Icon ",'dfd'),
								"param_name" => "icon",
								"value" => "",
								"description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", 'dfd'),
								"group" => "Icon"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Size of Icon", 'dfd'),
								"param_name" => "icon_size",
								"value" => '',
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"description" => __("How big would you like it?", 'dfd'),
								"group" => "Icon"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Color", 'dfd'),
								"param_name" => "icon_color",
								"value" => "",
								"description" => __("Give it a nice paint!", 'dfd'),
								"group" => "Icon"
							),
							/*
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon Position", 'dfd'),
								"param_name" => "btn_icon_pos",
								"value" => array(
									"Icon pull from left" => "ubtn-sep-icon-left",
									"Icon push to left" => "ubtn-sep-icon-left-rev",
									"Icon pull from right" => "ubtn-sep-icon-right",
									"Icon push to right" => "ubtn-sep-icon-right-rev",
									"Icon push from top" => "ubtn-sep-icon-top-push",
									"Icon push from bottom" => "ubtn-sep-icon-bottom-push",
									"Icon push from left" => "ubtn-sep-icon-left-push",
									"Icon push from right" => "ubtn-sep-icon-right-push",
								),
								"description" => "",
								"group" => "Icon"
							),
							*/
							array(
								"type" => "ult_button",
								"class" => "",
								"heading" => __("Icon Position ",'dfd'),
								"param_name" => "btn_icon_pos",
								"value" => "",
								"json" => $json,
								"description" => "",
								"group" => "Icon"
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Border Style", 'dfd'),
								"param_name" => "btn_border_style",
								"value" => array(
									__('None', 'dfd') => "",
									__('Solid', 'dfd') => "solid",
									__('Dashed', 'dfd') => "dashed",
									__('Dotted', 'dfd') => "dotted",
									__('Double', 'dfd') => "double",
									__('Inset', 'dfd') => "inset",
									__('Outset', 'dfd') => "outset",
								),
								"description" => "",
								"group" => "Border"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color", 'dfd'),
								"param_name" => "btn_color_border",
								"value" => "",
								"description" => "",
								"dependency" => Array("element" => "btn_border_style", "not_empty" => true),
								"group" => "Border"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Border Color on Hover", 'dfd'),
								"param_name" => "btn_color_border_hover",
								"value" => "",
								"description" => "",
								"dependency" => Array("element" => "btn_border_style", "not_empty" => true),
								"group" => "Border"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Width", 'dfd'),
								"param_name" => "btn_border_size",
								"value" => '',
								"min" => 1,
								"max" => 10,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_border_style", "not_empty" => true),
								"group" => "Border"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Border Radius",'dfd'),
								"param_name" => "btn_radius",
								"value" => '',
								"min" => 0,
								"max" => 500,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_border_style", "not_empty" => true),
								"group" => "Border"
						  	),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Button Shadow", 'dfd'),
								"param_name" => "btn_shadow",
								"value" => array(
										__('No Shadow', 'dfd') => '',
										__('Shadow at Top', 'dfd') => 'shd-top',
										__('Shadow at Bottom', 'dfd') => 'shd-bottom',
										__('Shadow at Left', 'dfd') => 'shd-left',
										__('Shadow at Right', 'dfd') => 'shd-right',
									),
								"description" => __("", 'dfd'),
								"group" => "Shadow"
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Shadow Color",'dfd'),
								"param_name" => "btn_shadow_color",
								"value" => "",
								"description" => "",
								"dependency" => Array("element" => "btn_shadow", "not_empty" => true),
								"group" => "Shadow"
						  	),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Shadow Color on Hover",'dfd'),
								"param_name" => "btn_shadow_color_hover",
								"value" => "",
								"description" => "",
								"dependency" => Array("element" => "btn_shadow", "not_empty" => true),
								"group" => "Shadow"
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Shadow Size",'dfd'),
								"param_name" => "btn_shadow_size",
								"value" => '',
								"min" => 0,
								"max" => 100,
								"suffix" => "px",
								"description" => "",
								"dependency" => Array("element" => "btn_shadow", "not_empty" => true),
								"group" => "Shadow"
						  	),
							array(
								"type" => "chk-switch",
								"class" => "",
								"heading" => __("Button Click Effect", 'dfd'),
								"param_name" => "btn_shadow_click",
								"value" => "",
								"options" => array(
										"enable" => array(
											"label" => "",
											"on" => "Yes",
											"off" => "No",
										)
									),
								"description" => __("Enable Click effect on hover", 'dfd'),
								"dependency" => Array("element" => "btn_shadow", "not_empty" => true),
								"group" => "Shadow"
						),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("Font Family", 'dfd'),
								"param_name" => "btn_font_family",
								"description" => __("Select the font of your choice. You can <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", 'dfd'),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("Font Style", 'dfd'),
								"param_name"	=>	"btn_font_style",
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "font-size",
								"heading" => __("Font Size", 'dfd'),
								"param_name" => "btn_font_size",
								"min" => 14,
								"suffix" => "px",
								"group" => "Typography"
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Tooltip Options", 'dfd'),
								"param_name" => "enable_tooltip",
								"value" => array("Enable tooltip on button" => "yes"),
								"group" => "Tooltip"
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Text", 'dfd'),
								"param_name" => "tooltip_text",
								"value" => "",
								"dependency" => Array("element" => "enable_tooltip", "value" => "yes"),
								"group" => "Tooltip",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Position", 'dfd'),
								"param_name" => "tooltip_pos",
								"value" => array(
									__('Tooltip from Left', 'dfd') => "left",
									__('Tooltip from Right', 'dfd') => "right",
									__('Tooltip from Top', 'dfd') => "top",
									__('Tooltip from Bottom', 'dfd') => "bottom",
								),
								"description" => __("Select the tooltip position",'dfd'),
								"dependency" => Array("element" => "enable_tooltip", "value" => "yes"),
								"group" => "Tooltip",
							),
							array(
								"type" => "heading",
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/0n-7p' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
								"group" => "General"
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
			}
		}
	}
	new Ultimate_Buttons;
}