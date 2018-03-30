<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info Box
* Add-on URI: https://www.brainstormforce.com
*/
if(!class_exists('Old_Info_Box')) {
	class Old_Info_Box {
		function __construct() {
			// Add shortcode for icon box
			add_shortcode('bsf-info-box', array(&$this, 'icon_boxes' ) );
			// Initialize the icon box component for Visual Composer
			add_action('init', array( &$this, 'icon_box_init' ) );
		}
		// Add shortcode for icon-box
		function icon_boxes($atts, $content = null) {
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $el_class = $icon_animation = $title = $subtitle = $enable_custom_title_typography = $enable_custom_subtitle_typography = $link = $hover_effect = $pos = $read_more = $read_more_style = $read_text = $box_border_style = $box_border_width =$box_border_color = $box_bg_color = $pos = $css_class = $desc_font_line_height = $title_font_line_height = $title_font_letter_spacing = $icon_hover_color = $icon_hover_background = $icon_hover_border_color = $title_hover_color = $read_more_class = $read_text_html = '';
			$title_font = $title_font_style = $title_font_size = $title_font_color = $subtitle_font = $subtitle_font_style = $subtitle_font_size = $subtitle_font_color = $desc_font = $desc_font_style = $desc_font_size = $desc_font_color = $module_animation = '';
			extract(shortcode_atts(array(
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
				'icon_animation' => '',
				'title'	  => '',
				'subtitle'	  => '',
				'enable_custom_title_typography'	  => 'no',
				'enable_custom_subtitle_typography'	  => 'no',
				'link'	   => '',
				'hover_effect' => 'style_1',
				'icon_hover_color' => '',
				'icon_hover_background' => '',
				'icon_hover_border_color' => '',
				'title_hover_color' => '',
				'pos'	    => 'default',
				'rebuild_mobile'=>'',
				'box_border_style'=>'',
				'box_border_width'=>'',
				'box_border_color'=>'',
				'box_bg_color'=>"",
				'read_more'  => 'none',
				'read_more_style'  => 'dots',
				'read_text'  => __('Read More', 'dfd'),
				'title_font' => '',
				'title_font_style' => '',
				'title_font_size' => '',
				'title_font_line_height'=> '',
				'title_font_letter_spacing'=> '',
				'title_font_color' => '',
				'subtitle_font' => '',
				'subtitle_font_style' => '',
				'subtitle_font_size' => '',
				'subtitle_font_line_height'=> '',
				'subtitle_font_letter_spacing'=> '',
				'subtitle_font_color' => '',
				'desc_font' => '',
				'desc_font_style' => '',
				'desc_font_size' => '',
				'desc_font_color' => '',
				'desc_font_line_height'=> '',
				'module_animation' => '',
				'el_class'	  => '',
				),$atts,'bsf-info-box'));
			$unique_id = uniqid('info-box-');
			$html = $target = $suffix = $prefix = $title_style = $subtitle_style =	 $desc_style = '';
			$font_args = array();
			$box_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
			$prefix .= '<div id="'. esc_attr($unique_id) .'" class="aio-icon-component '.esc_attr($css_class).' '.esc_attr($el_class).' '.esc_attr($hover_effect).'">';
			$suffix .= '</div> <!-- aio-icon-component -->';
			$ex_class = $ic_class = $css = '';
			if($pos != ''){
				$ex_class .= $pos.'-icon';
				$ic_class = 'aio-icon-'.$pos;
			}
			
			if($rebuild_mobile) {
				$ex_class .= ' dfd-mobile-rebuild';
			}
			
			if(strcmp($read_more_style, 'dots') === 0) {
				$read_text_html .= '<span class="dfd-left-line"></span><span></span><span class="dfd-right-line"></span>';
				$read_more_class .= ' dfd-dotted-link';
			} else if (strcmp($read_more_style, 'slide_up') === 0) {
				if($read_text != '') {
					$read_text_html .= '<span>'.$read_text.'</span>';
				}
				$read_more_class .= 'more-button slide-up';
			} else {
				if($read_text != '') {
					$read_text_html .= '<span class="chaffle" data-lang="en">'.$read_text.'</span>';
				}
				$read_more_class .= 'more-button dfd-animate-first-last';
			}
			
			/* title */
			if(strcmp($enable_custom_title_typography, 'yes') === 0) {
				if($title_font != ''){
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
				if($title_font_letter_spacing != '')
					$title_style .= 'letter-spacing:'.esc_attr($title_font_letter_spacing).'px;';
				if($title_font_color != '')
					$title_style .= 'color:'.esc_attr($title_font_color).';';
			}
			
			/* subtitle */
			if(strcmp($enable_custom_subtitle_typography, 'yes') === 0) {
				if($subtitle_font != ''){
					$font_family = get_ultimate_font_family($subtitle_font);
					$subtitle_style .= 'font-family:'.esc_attr($font_family).';';
					array_push($font_args, $subtitle_font);
				}
				if($subtitle_font_style != '')
					$subtitle_style .= get_ultimate_font_style($title_font_style);
				if($subtitle_font_size != '')
					$subtitle_style .= 'font-size:'.esc_attr($subtitle_font_size).'px;';
				if($subtitle_font_line_height != '')
					$subtitle_style .= 'line-height:'.esc_attr($subtitle_font_line_height).'px;';
				if($subtitle_font_letter_spacing != '')
					$subtitle_style .= 'letter-spacing:'.esc_attr($subtitle_font_letter_spacing).'px;';
				if($subtitle_font_color != '')
					$subtitle_style .= 'color:'.esc_attr($subtitle_font_color).';';
			}
				
			/* description */
			if($desc_font != '') {
				$font_family = get_ultimate_font_family($desc_font);
				$desc_style .= 'font-family:'.esc_attr($font_family).';';
				array_push($font_args, $desc_font);
			}
			if($desc_font_style != '')
				$desc_style .= get_ultimate_font_style($desc_font_style);
			if($desc_font_size != '')
				$desc_style .= 'font-size:'.esc_attr($desc_font_size).'px;';
			if($desc_font_line_height != '')
				$desc_style .= 'line-height:'.esc_attr($desc_font_line_height).'px;';
			if($desc_font_color != '')
				$desc_style .= 'color:'.esc_attr($desc_font_color).';';
			enquque_ultimate_google_fonts($font_args);
			
			$box_style='';
			if($pos=='square_box'){
				if($box_border_color!=''){
					$box_style .="border-color:".esc_attr($box_border_color).";";
				}
				if($box_border_style!=''){
					$box_style .="border-style:".esc_attr($box_border_style).";";
				}
				if($box_border_width!=''){
					$box_style .="border-width:".esc_attr($box_border_width)."px;";
				}
				if($box_bg_color!=''){
					$box_style .="background-color:".esc_attr($box_bg_color).";";
				}
			}
			
			if($icon_hover_color != '' || $icon_hover_background != '' || $title_hover_color != '' || $icon_hover_border_color != '') {
				$css .= '<style type="text/css">';
				if($icon_hover_color != '') {
					$css .= '#'.esc_attr($unique_id).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {color: '. esc_attr($icon_hover_color) .' !important;}';
				}
				if($icon_hover_background != '') {
					$css .= '#'.esc_attr($unique_id).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {background: '. esc_attr($icon_hover_background) .' !important;}';
				}
				if($icon_hover_border_color != '') {
					if($box_border_color == '' || $box_border_color == '' || $box_border_width == ''){
						$css .= '#'.esc_attr($unique_id).'.aio-icon-component.'.esc_attr($hover_effect).' .aio-icon {';
					}
					if($box_border_color == ''){
						$css .="border-color: transparent;";
					}
					if($box_border_style == '') {
						$css .="border-style: solid;";
					}
					if($box_border_width == ''){
						$css .="border-width: 1px;";
					}
					$css .= '}';
					$css .= '#'.esc_attr($unique_id).'.aio-icon-component.'.esc_attr($hover_effect).':hover .aio-icon {border-color: '. esc_attr($icon_hover_border_color) .' !important;}';
				}
				if($title_hover_color != '') {
					$css .= '#'.esc_attr($unique_id).'.aio-icon-component.'.esc_attr($hover_effect).':hover .feature-title {color: '. esc_attr($title_hover_color) .' !important;}';
				}
				$css .= '</style>';
			}


			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . $module_animation . '" ';
			}
			
			$html .= '<div class="aio-icon-box '.esc_attr($ex_class) .' '. esc_attr($animate) . '" ' . $animation_data . ' style="'.$box_style.'">';
			
			if($pos == "heading-right" || $pos == "right"){
				if($pos == "right"){
					$html .= '<div class="aio-ibd-block">';
				}
				if($title !== ''){
					$html .= '<div class="aio-icon-header">';
					$link_prefix = $link_sufix = '';
					if($link !== 'none'){
						if($read_more == 'title')
						{
							$href = vc_build_link($link);
							if(isset($href['target']) && !empty($href['target'])){
								$target = 'target="'.esc_attr($href['target']).'"';
							}
							$link_prefix = '<a class="aio-icon-box-link" href="'.esc_url($href['url']).'" '.$target.'>';
							$link_sufix = '</a>';
						}
					}
					$html .= $link_prefix.'<div class="feature-title" style="'.$title_style.'">'.$title.'</div>'.$link_sufix;
					if($subtitle !== ''){
						$html .= '<div class="subtitle" style="'.$subtitle_style.'">'.$subtitle.'</div>';
					}
					$html .= '</div><!-- header -->';
				}
				if($pos !== "right"){
					$html .= '<div class="'.esc_attr($ic_class).'">';
					if($icon !== 'none') {
						$html .= $box_icon;
					}
					$html .= '</div>';
				}
				if($content !== ''){
					$html .= '<div class="aio-icon-description" style="'.$desc_style.'">';
					$html .= wpb_js_remove_wpautop( $content , true );
					if($link !== 'none'){
						if($read_more == 'more') {
							$href = vc_build_link($link);
							if(isset($href['target']) && !empty($href['target'])){
								$target = 'target="'.$href['target'].'"';
							}
							$more_link = '<a class="'.$read_more_class.'" href="'.esc_url($href['url']).'" '.$target.'>';
							$more_link .= $read_text_html;
							$more_link .= '</a>';
							$html .= '<div class="read-more-wrap">'.$more_link.'</div>';
						}
					}
					$html .= '</div> <!-- description -->';
				}
				if($pos == "right"){
					$html .= '</div> <!-- aio-ibd-block -->';
					$html .= '<div class="'.esc_attr($ic_class).'">';
					if($icon !== 'none') {
						$html .= $box_icon;
					}
					$html .= '</div>';
				}

			} else{
				$html .= '<div class="'.esc_attr($ic_class).'">';
				if($icon !== 'none') {
					$html .= $box_icon;
				}
				$html .= '</div>';
				if($pos == "left")
					$html .= '<div class="aio-ibd-block">';
				if($title !== ''){
					$html .= '<div class="aio-icon-header">';
					$link_prefix = $link_sufix = '';
					if($link !== 'none'){
						if($read_more == 'title') {
							$href = vc_build_link($link);
							if(isset($href['target']) && !empty($href['target'])){
								$target = 'target="'.esc_attr($href['target']).'"';
							}
							$link_prefix = '<a class="aio-icon-box-link" href="'.esc_url($href['url']).'" '.$target.'>';
							$link_sufix = '</a>';
						}
					}
					$html .= $link_prefix.'<div class="feature-title" style="'.$title_style.'">'.$title.'</div>'.$link_sufix;
					if($subtitle !== ''){
						$html .= '<div class="subtitle" style="'.$subtitle_style.'">'.$subtitle.'</div>';
					}
					$html .= '</div><!-- header -->';
				}
				if($content !== ''){
					$html .= '<div class="aio-icon-description" style="'.$desc_style.'">';
					$html .= wpb_js_remove_wpautop( $content , true );
					if($link !== 'none'){
						if($read_more == 'more') {
							$href = vc_build_link($link);
							if(isset($href['target']) && !empty($href['target'])){
								$target = 'target="'.esc_attr($href['target']).'"';
							}
							$more_link = '<a class="'.esc_attr($read_more_class).'" href="'.esc_url($href['url']).'" '.$target.'>';
							$more_link .= $read_text_html;
							$more_link .= '</a>';
							$html .= '<div class="read-more-wrap">'.$more_link.'</div>';
						}
					}
					$html .= '</div> <!-- description -->';
				}
				if($pos == "left")
					$html .= '</div> <!-- aio-ibd-block -->';
			}
			
			
			$html .= '</div> <!-- aio-icon-box -->';
			if($link !== 'none'){
				if($read_more == 'box')
				{
					$href = vc_build_link($link);
					if(isset($href['target']) && !empty($href['target'])){
						$target = 'target="'.$href['target'].'"';
					}
					$output = $prefix.'<a class="aio-icon-box-link" href="'.$href['url'].'" '.$target.'>'.$html.'</a>'.$suffix;
				} else {
					$output = $prefix.$html.$suffix;
				}
			} else {
				$output = $prefix.$html.$suffix;
			}
			if($css != '') {
				$output .= "<script type=\"text/javascript\">"
						. "jQuery(document).ready(function() {"
							."jQuery('head').append('".$css."');"
						. "});"
						."</script>";
			}
			return $output;
		}
		// Function generate param type "number"
		function number_settings_field($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		/* Add icon box Component*/
		function icon_box_init()
		{
			if ( function_exists('vc_map'))
			{
				vc_map( 
					array(
						"name"		=> __("Info Box", 'dfd'),
						"base"		=> "bsf-info-box",
						"icon"		=> "vc_info_box",
						"class"	   => "info_box",
						"category"  => __("Ronneby 1.0", 'dfd'),
						"description" => "Adds icon box with custom font icon",
						"controls" => "full",
						"show_settings_on_create" => true,
						"params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Icon to display:", 'dfd'),
								"param_name" => "icon_type",
								"value" => array(
									"Font Icon Manager" => "selector",
									"Custom Image Icon" => "custom",
								),
								"description" => __("Use an existing font icon</a> or upload a custom image.", 'dfd')
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
								"heading" => __("Icon Style", 'dfd'),
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
									__('None','dfd') => "",
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
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Animation",'dfd'),
								"param_name" => "icon_animation",
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
								"description" => __("Like CSS3 Animations? We have several options for you!",'dfd')
						  	),
							// Icon Box Heading
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Enable custom title typography", 'dfd'),
								"param_name" => "enable_custom_title_typography",
								"value" => array(
									__('No', 'dfd') => 'no',
									__('Yes', 'dfd') => 'yes',
								),
								"description" => __("This option gives possibility to change title typography manually.", 'dfd')
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("Title", 'dfd'),
								"param_name" => "title",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide the title for this icon box.", 'dfd'),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Enable custom subtitle typography", 'dfd'),
								"param_name" => "enable_custom_subtitle_typography",
								"value" => array(
									__('No', 'dfd') => 'no',
									__('Yes', 'dfd') => 'yes',
								),
								"description" => __("This option gives possibility to change subtitle typography manually.", 'dfd')
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Subtitle", 'dfd'),
								"param_name" => "subtitle",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide the subtitle for this icon box.", 'dfd'),
							),
							// Add some description
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description", 'dfd'),
								"param_name" => "content",
								"value" => "",
								"description" => __("Provide the description for this icon box.", 'dfd')
							),
							// Select link option - to box or with read more text
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Apply link to:", 'dfd'),
								"param_name" => "read_more",
								"value" => array(
									__('No Link', 'dfd') => "none",
									__('Complete Box', 'dfd') => "box",
									__('Box Title', 'dfd') => "title",
									__('Display Read More', 'dfd') => "more",
								),
								"description" => __("Select whether to use color for icon or not.", 'dfd')
							),
							// Add link to existing content or to another resource
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Add Link", 'dfd'),
								"param_name" => "link",
								"value" => "",
								"description" => __("Add a custom link or select existing page. You can remove existing link as well.", 'dfd'),
								"dependency" => Array("element" => "read_more", "value" => array("box","title","more")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __('Read more style', 'dfd'),
								"param_name" => "read_more_style",
								"value" => array(
									__('Dashes', 'dfd') => 'dots',
									__('Custom text', 'dfd') => 'custom_text',
									__('Slide up', 'dfd') => 'slide_up',
								),
								"dependency" => Array("element" => "read_more","value" => array("more")),
								//"description" => __("This option gives possibility to change title typography manually.", 'dfd')
							),
							// Link to traditional read more
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Read More Text", 'dfd'),
								"param_name" => "read_text",
								"value" => "Read More",
								"description" => __("Customize the read more text.", 'dfd'),
								"dependency" => Array("element" => 'read_more_style',"value" => array('custom_text', 'slide_up')),
							),
							// Hover Effect type
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Select Hover Effect type", 'dfd'),
								"param_name" => "hover_effect",
								"value" => array(
									__('No Effect', 'dfd') => "style_1",
									__('Icon Zoom', 'dfd') => "style_2",
									__('Icon Bounce Up', 'dfd') => "style_3",
									__('Icon color change', 'dfd') => "style_4",
									__('Icon background color change', 'dfd') => "style_5",
									__('Icon background change with bounce up', 'dfd') => "style_6",
									__('Icon border change with bounce up', 'dfd') => "style_7",
									__('Title color change', 'dfd') => "style_8",
									__('All box bounce up', 'dfd') => "style_9",
								),
								"description" => __("Select the type of effct you want on hover", 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Icon Color on Hover', 'dfd'),
								'param_name' => 'icon_hover_color',
								'value' => '',
								'dependency' => Array('element' => 'hover_effect','value' => array('style_4', 'style_5', 'style_6')),
								'description' => __('Select Icon color on hover.', 'dfd')
							),	
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Icon Background Color on Hover', 'dfd'),
								'param_name' => 'icon_hover_background',
								'value' => '',
								'dependency' => Array('element' => 'hover_effect','value' => array('style_5', 'style_6')),
								'description' => __('Select Icon background color on hover.', 'dfd')
							),	
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Icon Border Color on Hover', 'dfd'),
								'param_name' => 'icon_hover_border_color',
								'value' => '',
								'dependency' => Array('element' => 'hover_effect','value' => array('style_7')),
								'description' => __('Select Icon Border color on hover.', 'dfd')
							),	
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Title Color on Hover', 'dfd'),
								'param_name' => 'title_hover_color',
								'value' => '',
								'dependency' => Array('element' => 'hover_effect','value' => array('style_8')),
								'description' => __('Select title color on hover.', 'dfd')
							),
							// Position the icon box
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Box Style", 'dfd'),
								"param_name" => "pos",
								"value" => array(
									__('Icon at Left with heading','dfd') => "default",
									__('Icon at Right with heading','dfd') => "heading-right",
									__('Icon at Left','dfd') => "left",
									__('Icon at Right','dfd') => "right",
									__('Icon at Top','dfd') => "top",
									__('Boxed Style','dfd') => "square_box",
								),
								"description" => __("Select icon position. Icon box style will be changed according to the icon position.", 'dfd')
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Rebuild block on small devices", 'dfd'),
								"param_name" => "rebuild_mobile",
								'value' => array('Yes, please' => 'yes'),
								'dependency' => Array('element' => 'pos','value' => array('left','right')),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Box Border Style", 'dfd'),
								"param_name" => "box_border_style",
								"value" => array(
									__('None','dfd') => "",
									__('Solid','dfd')=> "solid",
									__('Dashed','dfd') => "dashed",
									__('Dotted','dfd') => "dotted",
									__('Double','dfd') => "double",
									__('Inset','dfd') => "inset",
									__('Outset','dfd') => "outset",
								),
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Border Style for box border.", 'dfd')
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("Box Border Width", 'dfd'),
								"param_name" => "box_border_width",
								"value" => "",
								"suffix" =>"",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Width for Box Border.", 'dfd')
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Box Border Color", 'dfd'),
								"param_name" => "box_border_color",
								"value" => "",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Border color for border box.", 'dfd')
							),	
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Box Background Color", 'dfd'),
								"param_name" => "box_bg_color",
								"value" => "",
								"dependency" => Array("element" => "pos","value" => array("square_box")),
								"description" => __("Select Box background color.", 'dfd')
							),
							// Customize everything
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class", 'dfd'),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Add extra class name that will be applied to the icon box, and you can use this class for your customizations.", 'dfd'),
							),
							array(
								"type" => "ult_param_heading",
								"param_name" => "title_text_typography",
								"heading" => __("Title settings", 'dfd'),
								"value" => "",
								"group" => "Typography",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "title_font",
								"value" => "",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "title_font_style",
								"value" => "",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "title_font_size",
								"heading" => "Font size",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "title_font_line_height",
								"heading" => "Font Line Height",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "title_font_letter_spacing",
								"heading" => "Font Letter Spacing",
								"value" => "",
								"suffix" => "px",
								"min" => -10,
								"max" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "colorpicker",
								"param_name" => "title_font_color",
								"heading" => "Color",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_title_typography","value" => array("yes")),
							),
							array(
								"type" => "ult_param_heading",
								"param_name" => "subtitle_text_typography",
								"heading" => __("Subtitle settings", 'dfd'),
								"value" => "",
								"group" => "Typography",
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => "Font Family",
								"param_name" => "subtitle_font",
								"value" => "",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" => "Font Style",
								"param_name" => "subtitle_font_style",
								"value" => "",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "subtitle_font_size",
								"heading" => "Font size",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "subtitle_font_line_height",
								"heading" => "Font Line Height",
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "number",
								"param_name" => "subtitle_font_letter_spacing",
								"heading" => "Font Letter Spacing",
								"value" => "",
								"suffix" => "px",
								"min" => -10,
								"max" => 10,
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							array(
								"type" => "colorpicker",
								"param_name" => "subtitle_font_color",
								"heading" => "Color",
								"group" => "Typography",
								"dependency" => Array("element" => "enable_custom_subtitle_typography","value" => array("yes")),
							),
							/*
							array(
								"type" => "textarea_html",
								"class" => "",
								"heading" => __("Description", 'dfd'),
								"param_name" => "content",
								"admin_label" => true,
								"value" => "",
								"description" => __("Provide some description.", 'dfd'),
							),
							*/
							array(
								"type" => "ult_param_heading",
								"param_name" => "desc_text_typography",
								"heading" => __("Description settings", 'dfd'),
								"value" => "",
								"group" => "Typography",
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
								"value" => "",
								"suffix" => "px",
								"min" => 10,
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"param_name" => "desc_font_line_height",
								"heading" => "Font Line Height",
								"value" => "",
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
								"sub_heading" => "<span style='display: block;'><a href='http://bsf.io/kqzzi' target='_blank'>Watch Video Tutorial &nbsp; <span class='dashicons dashicons-video-alt3' style='font-size:30px;vertical-align: middle;color: #e52d27;'></span></a></span>",
								"param_name" => "notification",
								'edit_field_class' => 'ult-param-important-wrapper ult-dashicon ult-align-right ult-bold-font ult-blue-font vc_column vc_col-sm-12',
							),*/
						) // end params array
					) // end vc_map array
				); // end vc_map
			} // end function check 'vc_map'
		}// end function icon_box_init
	}//Class end
}
if(class_exists('Old_Info_Box'))
{
	$Old_Info_Box = new Old_Info_Box;
}