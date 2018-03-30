<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info List for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Dfd_Services_Module'))
{
	class Dfd_Services_Module
	{
		var $connect_color;
		var $connect_style;
		var $icon_font;
		//var $border_col;
		var $icon_style;
		
		function __construct()
		{
			$this->connect_color = '';
			$this->connect_style = '';
			$this->icon_font = '';
			//$this->border_col = '';
			$this->icon_style = '';
			add_action('init', array($this, 'add_dfd_service'));
			if(function_exists('vc_is_inline')){
				if(!vc_is_inline()){
					add_shortcode( 'dfd_service', array($this, 'dfd_service' ) );
					add_shortcode( 'dfd_service_item', array($this, 'dfd_service_item' ) );
				}
			} else {
				add_shortcode( 'dfd_service', array($this, 'dfd_service' ) );
				add_shortcode( 'dfd_service_item', array($this, 'dfd_service_item' ) );
			}
		}
		function dfd_service($atts, $content = null)
		{
			$position = $columns_width = $columns_offsets = $style = $icon_color = $icon_bg_color = $font_size_icon = $icon_border_style = $icon_border_size = $connector_color = $connector_style = $border_color = $el_class = $dfd_service_link_html = '';
			extract(shortcode_atts(array(
				'position' => 'icon-left',
				'columns_width' => 'full-width-elements',
				//'columns_offsets' => '',
				//'style' => '',
				'icon_color' =>'#333333',
				//'icon_bg_color' =>'',
				'connector_color' => '#333333',
				'connector_style' => 'none',
				//'border_color' => '',
				'font_size_icon' => '24',
				//'icon_border_style' => '',
				//'icon_border_size' => '',
				'el_class' => '',
			), $atts));
			
			$icon_css = '';
			
			$this->connect_color = $connector_color;
			$this->connect_style = $connector_style;
			$this->border_col = $border_color;
			/*if($style == 'square with_bg' || $style == 'circle with_bg' || $style == 'hexagon'){
				$this->icon_font = 'font-size:'.($font_size_icon*3).'px;';
				if($icon_border_size !== ''){
					if($font_size_icon != '') {
						$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
					}
					$icon_css .= 'border-width:0px;';
					$icon_css .= 'border-style:none;';
					if($icon_bg_color != '') {
						$icon_css .= 'background:'.esc_attr($icon_bg_color).';';
					}
					if($icon_color != '') {
						$icon_css .= 'color:'.esc_attr($icon_color).';';
					}
					if($style =="hexagon") {
						$icon_css .= 'border-color:'.esc_attr($icon_bg_color).';';
					} else {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}
					$this->icon_style = $icon_css;
				}
			} else {*/
				$big_size = ($font_size_icon*3)+($icon_border_size*2);
				//if($icon_border_size !== ''){
					$this->icon_font = 'font-size:'.esc_attr($big_size).'px;';
					if($font_size_icon != '') {
						$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
					}
					/*if($icon_border_size != '') {
						$icon_css .= 'border-width:'.esc_attr($icon_border_size).'px;';
					}
					if($icon_border_style != '') {
						$icon_css .= 'border-style:'.esc_attr($icon_border_style).';';
					}*/
					if($icon_color != '') {
						$icon_css .= 'color:'.esc_attr($icon_color).';';
					}
					/*if($border_color != '') {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}*/
					$this->icon_style = $icon_css;
				//}
			//}
			
			$list_class = '';
			$list_class .= $position;
			$list_class .= ' '.$columns_width;
			//$list_class .= ' '.$columns_offsets;
			
			$output = '<div class="dfd-service-module-wrap '.esc_attr($el_class).'">';
			$output .= '<ul class="dfd-service-list dfd-equal-height-children dfd-mobile-keep-height clearfix '.esc_attr($list_class).' '.esc_attr($style).'">';
			$output .= do_shortcode($content);
			$output .= '</ul>';
			$output .= '</div>';
			return $output;
		}
		function dfd_service_item($atts,$content = null) {
			// Do nothing
			$list_title = $list_subtitle = $block_min_height = $list_icon = $animation = $icon_color = $icon_bg_color = $icon_img = $icon_type = $desc_font_line_height = $title_font_line_height = $title_font_letter_spacing = $module_animation = '';
			$title_font = $title_font_style = $title_font_size = $title_font_color = $desc_font = $desc_font_style = $desc_font_size = $desc_font_color = $desc_background = '';
			$subtitle_font = $subtitle_font_style = $subtitle_font_size = $subtitle_font_line_height = $subtitle_font_letter_spacing = $subtitle_font_color = '';
			extract(shortcode_atts(array(
				'list_title' => '',
				'list_subtitle' => '',
				'block_min_height' => '',
				'animation' => '',
				'list_icon' => '',
				'icon_img' => '',
				'icon_type' => 'selector',
				'title_font' => '',
				'title_font_style' => '',
				'title_font_size' => '16',
				'title_font_line_height'=> '24',
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
				'desc_font_size' => '13',
				'desc_font_color' => '',
				'desc_background' => '',
				'desc_font_line_height'=> '18',
				'dfd_service_link' => '',
				'dfd_service_link_apply' => 'no-link',
				'module_animation' => '',
			), $atts));
			//$content =  wpb_js_remove_wpautop($content);
			$css_trans = $style = $ico_col = $connector_trans = $icon_html = $title_style = $subtitle_style= $desc_style = $desc_cover_style = $dfd_service_link_html = '';
			$font_args = array();
			
			$is_link = false;
			
			if($dfd_service_link != '') {
				$dfd_service_link_temp = vc_build_link($dfd_service_link);
				$url = $dfd_service_link_temp['url'];
				$title = $dfd_service_link_temp['title'];
				$target = $dfd_service_link_temp['target'];
				if($url != '')
				{
					if($target != '')
						$target = 'target="'.esc_attr($target).'"';
					$dfd_service_link_html = '<a href="'.esc_url($url).'" class="ulimate-info-list-link" '.$target.'></a>';
				}
				$is_link = true;
			}
			
			if($animation !== 'none') {
				$css_trans = 'data-animation="'.esc_attr($animation).'" data-animation-delay="03"';
			}
			
			/* title */
			if($title_font != '') {
				$font_family = get_ultimate_font_family($title_font);
				$title_style .= 'font-family:'.esc_attr($font_family).';';
				array_push($font_args, $title_font);
			}
			if($title_font_style != '') {
				$title_style .= get_ultimate_font_style($title_font_style);
			}
			if($title_font_size != '') {
				$title_style .= 'font-size:'.esc_attr($title_font_size).'px;';
			}
			if($title_font_line_height != '') {
				$title_style .= 'line-height:'.esc_attr($title_font_line_height).'px;';
			}
			if($title_font_letter_spacing != '') {
				$title_style .= 'letter-spacing:'.esc_attr($title_font_letter_spacing).'px;';
			}
			if($title_font_color != '') {
				$title_style .= 'color:'.esc_attr($title_font_color).';';
			}
			
			/* Subtitle */
			if($subtitle_font != '') {
				$font_family = get_ultimate_font_family($subtitle_font);
				$subtitle_style .= 'font-family:'.esc_attr($font_family).';';
				array_push($font_args, $subtitle_font);
			}
			if($subtitle_font_style != '') {
				$subtitle_style .= get_ultimate_font_style($subtitle_font_style);
			}
			if($subtitle_font_size != '') {
				$subtitle_style .= 'font-size:'.esc_attr($subtitle_font_size).'px;';
			}
			if($subtitle_font_line_height != '') {
				$subtitle_style .= 'line-height:'.esc_attr($subtitle_font_line_height).'px;';
			}
			if($subtitle_font_letter_spacing != '') {
				$subtitle_style .= 'letter-spacing:'.esc_attr($subtitle_font_letter_spacing).'px;';
			}
			if($subtitle_font_color != '') {
				$subtitle_style .= 'color:'.esc_attr($subtitle_font_color).';';
			}
			
			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . $module_animation . '" ';
			}
				
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
			if($desc_background != '') {
				$desc_cover_style .= 'background:'.esc_attr($desc_background).';';
			}
			enquque_ultimate_google_fonts($font_args);
			
			if($icon_color !=''){
				$ico_col = 'style="color:'.esc_attr($icon_color).'";';
			}
			/*if($icon_bg_color != ''){
				$style .= 'background:'.esc_attr($icon_bg_color).';  color:'.esc_attr($icon_bg_color).';';	
			}
			if($icon_bg_color != ''){
				$style .= 'border-color:'.esc_attr($this->border_col).';';
			}*/
			if($icon_type == "selector"){
				$icon_html .= '<div class="dfd-service-icon" '.$css_trans.' style="'.$this->icon_style.'">';
				$icon_html .= '<i class="'.esc_attr($list_icon).'" '.$ico_col.'></i>';
				if($is_link && $dfd_service_link_apply == 'icon')
					$icon_html .= $dfd_service_link_html;
				$icon_html .= '</div>';
			} else {
				$img = wp_get_attachment_image_src( $icon_img, 'large');
				$icon_html .= '<div class="dfd-service-icon" '.$css_trans.' style="'.$this->icon_style.'">';
				$icon_html .= '<img class="dfd-service-img-icon" alt="icon" src="'.esc_url($img[0]).'"/>';
				if($is_link && $dfd_service_link_apply == 'icon')
					$icon_html .= $dfd_service_link_html;
				$icon_html .= '</div>';
			}
			$front_css = '';
			if($block_min_height != '') {
				$front_css .= 'style="min-height: '.esc_attr($block_min_height).'px;"';
			}
			$output = '<li class="dfd-service-item dfd-eq-height '.esc_attr($animate).'" '.$animation_data.' style="border-style: '.esc_attr($this->connect_style).'; border-color: '.esc_attr($this->connect_color).';">';
			$output .= '<div class="dfd-service-front" '.$front_css.'>';
			$output .= '<div class="dfd-vertical-aligned">';
			$output .= '<div class="dfd-front-wrap">';
			$output .= $icon_html;
			if($list_title != '' || $list_subtitle != '') {
				$output .= '<div class="heading">';
				if($list_title != '') {
					$output .= '<div class="feature-title" style="'.$title_style.'">';
					if($is_link && $dfd_service_link_apply == 'title')
						$output .= '<a href="'.esc_url($url).'" target="'.esc_attr($target).'">'.$list_title.'</a>';
					else
						$output .= $list_title;
					$output .= '</div>';
				}
				if($list_subtitle != '') {
					$output .= '<div class="subtitle" style="'.$subtitle_style.'">'.$list_subtitle.'</div>';
				}
				$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="dfd-service-description dfd-service-back" style="'.$desc_cover_style.'">';
			$output .= '<div class="dfd-service-description-text dfd-vertical-aligned" style="'.$desc_style.'">'.wpb_js_remove_wpautop($content, true).'</div>';
			$output .= '</div>';
			//$output .= '<div class="dfd-service-connector" '.$connector_trans.' style="border-color:'.esc_attr($this->connect_color).';"></div>';
			if($is_link && $dfd_service_link_apply == 'container')
				$output .= $dfd_service_link_html;
			$output .= '</li>';
			return $output;
		}
	// Shortcode Functions for frontend editor
		function front_dfd_service($atts, $content = null)
		{
			// Do nothing
			$position = $columns_width = $columns_offsets = $style = $icon_color = $icon_bg_color = $font_size_icon = $icon_border_style = $icon_border_size = $connector_color = $connector_style = $border_color = $el_class = $icon_css = '';
			extract(shortcode_atts(array(
				'position' => 'icon-left',
				'columns_width' => 'full-width-elements',
				//'columns_offsets' => '',
				//'style' => '',
				'icon_color' =>'',
				//'icon_bg_color' =>'',
				'connector_color' => '',
				'connector_style' => 'none',
				//'border_color' => '',
				'font_size_icon' => '24',
				//'icon_border_style' => '',
				//'icon_border_size' => '',
				'el_class' => '',
			), $atts));
			$this->connect_color = $connector_color;
			$this->connect_style = $connector_style;
			//$this->border_col = $border_color;
			/*if($style == 'square with_bg' || $style == 'circle with_bg' || $style == 'hexagon'){
				$this->icon_font = 'font-size:'.($font_size_icon*3).'px;';
				if($icon_border_size !== ''){
					if($font_size_icon != '') {
						$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
					}
					$icon_css .= 'border-width:0px;';
					$icon_css .= 'border-style:none;';
					if($icon_bg_color != '') {
						$icon_css .= 'background:'.esc_attr($icon_bg_color).';';
					}
					if($icon_color != '') {
						$icon_css .= 'color:'.esc_attr($icon_color).';';
					}
					if($style =="hexagon") {
						$icon_css .= 'border-color:'.esc_attr($icon_bg_color).';';
					} else {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}
					$this->icon_style = $icon_css;
				}
			} else {*/
				$big_size = ($font_size_icon*3)+($icon_border_size*2);
				//if($icon_border_size !== ''){
					$this->icon_font = 'font-size:'.esc_attr($big_size).'px;';
					if($font_size_icon != '') {
						$icon_css .= 'font-size:'.esc_attr($font_size_icon).'px;';
					}
					/*if($icon_border_size != '') {
						$icon_css .= 'border-width:'.esc_attr($icon_border_size).'px;';
					}
					if($icon_border_style != '') {
						$icon_css .= 'border-style:'.esc_attr($icon_border_style).';';
					}*/
					if($icon_color != '') {
						$icon_css .= 'color:'.esc_attr($icon_color).';';
					}
					/*if($border_color != '') {
						$icon_css .= 'border-color:'.esc_attr($border_color).';';
					}*/
					$this->icon_style = $icon_css;
				//}
			//}
			
			$list_class = '';
			$list_class .= $position;
			$list_class .= ' '.$columns_width;
			//$list_class .= ' '.$columns_offsets;
			
			$output = '<div class="dfd-service-module-wrap '.esc_attr($el_class).'">';
			$output .= '<ul class="dfd-service-list dfd-equal-height-children clearfix '.esc_attr($list_class).' '.esc_attr($style).'">';
			$output .= do_shortcode($content);
			$output .= '</ul>';
			$output .= '</div>';
			return $output;
		}
		function front_dfd_service_item($atts,$content = null) {
			// Do nothing
			$list_title = $list_subtitle = $list_icon = $animation = $icon_color = $icon_bg_color = $icon_img = $icon_type = $module_animation = '';
			extract(shortcode_atts(array(
				'list_title' => '',
				'list_subtitle' => '',
				'animation' => '',
				'list_icon' => '',
				'icon_img' => '',
				'icon_type' => 'selector',
				'module_animation' => '',
			), $atts));
			//$content =  wpb_js_remove_wpautop($content);
			$css_trans = $style = $ico_col = $connector_trans = $icon_html = '';
			if($animation !== 'none')
			{
				$css_trans = 'data-animation="'.esc_attr($animation).'" data-animation-delay="03"';
			}
			if($icon_color !=''){
				$ico_col = 'style="color:'.esc_attr($icon_color).'";';
			}
			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . $module_animation . '" ';
			}
			/*if($icon_bg_color != ''){
				$style .= 'background:'.esc_attr($icon_bg_color).';  color:'.esc_attr($icon_bg_color).';';	
			}
			if($icon_bg_color != ''){
				$style .= 'border-color:'.esc_attr($this->border_col).';';
			}*/
			if($icon_type == "selector"){		
				$icon_html .= '<div class="dfd-service-icon" '.$css_trans.'>';
				$icon_html .= '<i class="'.esc_attr($list_icon).'" '.$ico_col.'></i>';
				$icon_html .= '</div>';
			} else {
				$img = wp_get_attachment_image_src( $icon_img, 'large');
				$icon_html .= '<div class="dfd-service-icon" '.$css_trans.'>';
				$icon_html .= '<img class="dfd-service-img-icon" alt="icon" src="'.esc_url($img[0]).'"/>';
				$icon_html .= '</div>';
			}
			$output = '<li class="dfd-service-item dfd-eq-height '.esc_attr($animate).'" '.$animation_data.' style="border-style: '.esc_attr($this->connect_style).'; border-color: '.esc_attr($this->connect_color).';">';
			$output .= '<div class="dfd-service-front dfd-eq-height">';
			$output .= '<div class="dfd-front-wrap">';
			$output .= $icon_html;
			$output .= '<div class="heading">';
			$output .= '<div class="feature-title">'.$list_title.'</div>';
			$output .= '<div class="subtitle">'.$list_subtitle.'</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="dfd-service-description dfd-service-back dfd-eq-height">';
			$output .= wpb_js_remove_wpautop($content, true);
			$output .= '</div>';
			// esc_attr($this->connect_color) - connector color
			$output .= '</li>';
			return $output;
		}
		function add_dfd_service()
		{
			if(function_exists('vc_map'))
			{
				vc_map(
				array(
					'name' => __('Services','dfd'),
					'base' => 'dfd_service',
					'class' => 'vc_info_list',
					'icon' => 'vc_icon_list',
					'category' => __('Ronneby 1.0','dfd'),
					'as_parent' => array('only' => 'dfd_service_item'),
					'description' => __('Text blocks connected together in one list.','dfd'),
					'content_element' => true,
					//'deprecated' => '4.6',
					'show_settings_on_create' => true,
					'params' => array(
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Icon or Image Position','dfd'),
							'param_name' => 'position',
							'value' => array(
								__('Icon to the Left', 'dfd') => 'icon-left',
								__('Icon to the Right', 'dfd') => 'icon-right',
								__('Icon at Top', 'dfd') => 'icon-top',
							),
							'description' => __('Select the icon position for icon list.','dfd')
						),
					   array(
							'type' => 'dropdown',
							'heading' => __('Columns width','dfd'),
							'param_name' => 'columns_width',
							'value' => array(
									__('Inherit from container', 'dfd') => 'full-width-elements',
									__('Half size', 'dfd') => 'half-size-elements',
									__('1/3 of container width', 'dfd') => 'one-third-width-elements',
									__('1/4 of container width', 'dfd') => 'quarter-width-elements',
									__('1/5 of container width', 'dfd') => 'fifth-width-elements',
									__('1/6 of container width', 'dfd') => 'sixth-width-elements',
								),
							'description' => __('Please select width of the elements','dfd'),
						),
						/*array(
							'type' => 'dropdown',
							'heading' => __('Columns offsets','dfd'),
							'param_name' => 'columns_offsets',
							'value' => array(
									__('No offset', 'dfd') => '',
									__('Small paddings', 'dfd') => 'dfd-small-paddings',
									__('Normal paddings', 'dfd') => 'dfd-normal-paddings',
								),
							'description' => __('Please select width of the elements','dfd'),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Style of Image or Icon + Color','dfd'),
							'param_name' => 'style',
							'value' => array(
								__('Square With Background', 'dfd') => 'square with_bg',
								__('Square Without Background', 'dfd') => 'square no_bg',
								__('Circle With Background', 'dfd') => 'circle with_bg',
								__('Circle Without Background', 'dfd') => 'circle no_bg',
								__('Hexagon With Background', 'dfd') => 'hexagon',
								),
							'description' => __('Select the icon style for icon list.','dfd')
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Border Style', 'dfd'),
							'param_name' => 'icon_border_style',
							'value' => array(
								__('None', 'dfd') => 'none',
								__('Solid', 'dfd')	=> 'solid',
								__('Dashed', 'dfd') => 'dashed',
								__('Dotted', 'dfd') => 'dotted',
								__('Double', 'dfd') => 'double',
								__('Inset', 'dfd') => 'inset',
								__('Outset', 'dfd') => 'outset',
							),
							'description' => __('Select the border style for icon.','dfd'),
							'dependency' => Array('element' => 'style', 'value' => array('square no_bg','circle no_bg')),
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Border Width', 'dfd'),
							'param_name' => 'icon_border_size',
							'value' => 1,
							'min' => 0,
							'max' => 10,
							'suffix' => 'px',
							'description' => __('Thickness of the border.', 'dfd'),
							'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Border Color:', 'dfd'),
							'param_name' => 'border_color',
							'value' => '#333333',
							'description' => __('Select the color border.', 'dfd'),
							'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),								
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Icon Background Color:', 'dfd'),
							'param_name' => 'icon_bg_color',
							'value' => '#ffffff',
							'description' => __('Select the color for icon background.', 'dfd'),								
						),*/
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Icon Color:', 'dfd'),
							'param_name' => 'icon_color',
							'value' => '#333333',
							'description' => __('Select the color for icon.', 'dfd'),								
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Icon Font Size', 'dfd'),
							'param_name' => 'font_size_icon',
							'value' => 24,
							'min' => 12,
							'max' => 72,
							'suffix' => 'px',
							'description' => __('Enter value in pixels.', 'dfd')
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('border Color:', 'dfd'),
							'param_name' => 'connector_color',
							'value' => '#333333',
							'description' => __('Select the color for connector line.', 'dfd'),
							'group' => 'Connector'							
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Border Style', 'dfd'),
							'param_name' => 'connector_style',
							'value' => array(
								__('None', 'dfd') => 'none',
								__('Solid', 'dfd')	=> 'solid',
								__('Dashed', 'dfd') => 'dashed',
								__('Dotted', 'dfd') => 'dotted',
								__('Double', 'dfd') => 'double',
								__('Inset', 'dfd') => 'inset',
								__('Outset', 'dfd') => 'outset',
							),
							'description' => __('Select the border style for icon.','dfd'),
							'group' => 'Connector'							
						),
						// Customize everything
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => __('Extra Class', 'dfd'),
							'param_name' => 'el_class',
							'value' => '',
							'description' => __('Add extra class name that will be applied to the info list, and you can use this class for your customizations.', 'dfd'),
						),
					),
					'js_view' => 'VcColumnView'
				));
				// Add list item
				vc_map(
					array(
						'name' => __('Services Item', 'dfd'),
						'base' => 'dfd_service_item',
						'class' => 'vc_info_list',
						'icon' => 'vc_icon_list',
						'category' => __('DFD VC Addons','dfd'),
						'content_element' => true,
						'as_child' => array('only' => 'dfd_service'),
						'params' => array(
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Title','dfd'),
								'admin_label' => true,
								'param_name' => 'list_title',
								'value' => '',
								'description' => __('Provide a title for this service.','dfd')
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Subtitle','dfd'),
								'admin_label' => true,
								'param_name' => 'list_subtitle',
								'value' => '',
								'description' => __('Provide a subtitle for this service.','dfd')
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
								'description' => __('Use <a href="admin.php?page=font-icon-Manager" target="_blank">existing font icon</a> or upload a custom image.', 'dfd')
							),
							array(
								'type' => 'icon_manager',
								'class' => '',
								'heading' => __('Select List Icon ','dfd'),
								'param_name' => 'list_icon',
								'value' => '',
								'description' => __('Click and select icon of your choice. If you cannot find the one that suits for your purpose, you can <a href="admin.php?page=font-icon-Manager" target="_blank">add new here</a>.', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
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
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Icon Animation','dfd'),
								'param_name' => 'animation',
								'value' => array(
									__('No Animation','dfd') => '',
									__('Swing','dfd') => 'swing',
									__('Pulse','dfd') => 'pulse',
									__('Fade In','dfd') => 'fadeIn',
									__('Fade In Up','dfd') => 'fadeInUp',
									__('Fade In Down','dfd') => 'fadeInDown',
									__('Fade In Left','dfd') => 'fadeInLeft',
									__('Fade In Right','dfd') => 'fadeInRight',
									__('Fade In Up Long','dfd') => 'fadeInUpBig',
									__('Fade In Down Long','dfd') => 'fadeInDownBig',
									__('Fade In Left Long','dfd') => 'fadeInLeftBig',
									__('Fade In Right Long','dfd') => 'fadeInRightBig',
									__('Slide In Down','dfd') => 'slideInDown',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Bounce In','dfd') => 'bounceIn',
									__('Bounce In Up','dfd') => 'bounceInUp',
									__('Bounce In Down','dfd') => 'bounceInDown',
									__('Bounce In Left','dfd') => 'bounceInLeft',
									__('Bounce In Right','dfd') => 'bounceInRight',
									__('Rotate In','dfd') => 'rotateIn',
									__('Light Speed In','dfd') => 'lightSpeedIn',
									__('Roll In','dfd') => 'rollIn',
								),
								'description' => __('Select the animation style for icon.','dfd')
							),
							array(
								'type' => 'textarea_html',
								'class' => '',
								'heading' => __('Description','dfd'),
								'param_name' => 'content',
								'value' => '',
								'description' => __('Description about this list item','dfd')
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Block min height', 'dfd'),
								'param_name' => 'block_min_height',
								'value' => '',
								'min' => 0,
								'max' => 700,
								'suffix' => 'px',
								'description' => __('Enter value in pixels.', 'dfd')
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Apply link To', 'dfd'),
								'param_name' => 'dfd_service_link_apply',
								'value' => array(
									__('No Link','dfd') => 'no-link',
									__('Complete Container','dfd') => 'container',
									__('List Title','dfd') => 'title',
									__('Icon','dfd') => 'icon'
								)
							),
							array(
								'type' => 'vc_link',
								'heading' => __('Link', 'dfd'),
								'param_name' => 'dfd_service_link',
								'dependency' => array('element' => 'dfd_service_link_apply', 'value' => array('container','title','icon'))
							),
							array(
								'type' => 'ult_param_heading',
								'param_name' => 'title_text_typography',
								'text' => __('Title settings', 'dfd'),
								'value' => '',
								'group' => 'Typography',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'title_font',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' => __('Font Style', 'dfd'),
								'param_name' => 'title_font_style',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'title_font_size',
								'heading' => __('Font size', 'dfd'),
								'value' => '16',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'title_font_line_height',
								'heading' => __('Font Line Height', 'dfd'),
								'value' => '',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'title_font_letter_spacing',
								'heading' => __('Font Letter Spacing', 'dfd'),
								'value' => '',
								'suffix' => 'px',
								'min' => -3,
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'title_font_color',
								'heading' => __('Color', 'dfd'),
								'group' => 'Typography'
							),
							array(
								'type' => 'ult_param_heading',
								'param_name' => 'subtitle_text_typography',
								'text' => __('Subtitle settings', 'dfd'),
								'value' => '',
								'group' => 'Typography',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'subtitle_font',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' => __('Font Style', 'dfd'),
								'param_name' => 'subtitle_font_style',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Font size', 'dfd'),
								'param_name' => 'subtitle_font_size',
								'value' => '',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'subtitle_font_letter_spacing',
								'heading' => __('Font Letter Spacing', 'dfd'),
								'value' => '',
								'suffix' => 'px',
								'min' => -3,
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Font Line Height', 'dfd'),
								'param_name' => 'subtitle_font_line_height',
								'value' => '',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'subtitle_font_color',
								'heading' => __('Color', 'dfd'),
								'group' => 'Typography'
							),
							array(
								'type' => 'ult_param_heading',
								'param_name' => 'desc_text_typography',
								'text' => __('Description settings', 'dfd'),
								'value' => '',
								'group' => 'Typography',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'desc_font',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' => __('Font Style', 'dfd'),
								'param_name' => 'desc_font_style',
								'value' => '',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'desc_font_size',
								'heading' => __('Font size', 'dfd'),
								'value' => '13',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'param_name' => 'desc_font_line_height',
								'heading' => __('Font Line Height', 'dfd'),
								'value' => '18',
								'suffix' => 'px',
								'min' => 10,
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'desc_background',
								'heading' => __('Description background', 'dfd'),
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'desc_font_color',
								'heading' => __('Color', 'dfd'),
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
						)
					) 
				);
			}//endif
		}
	}
}
global $Dfd_Services_Module;
if(class_exists('WPBakeryShortCodesContainer'))
{
	class WPBakeryShortCode_dfd_service extends WPBakeryShortCodesContainer {
        function content( $atts, $content = null ) {
            global $Dfd_Services_Module;
            return $Dfd_Services_Module->front_dfd_service($atts, $content);
        }
	}
	class WPBakeryShortCode_dfd_service_item extends WPBakeryShortCode {
        function content($atts, $content = null ) {
            global $Dfd_Services_Module;
            return $Dfd_Services_Module->front_dfd_service_item($atts, $content);
        }
	}
}
if(class_exists('Dfd_Services_Module'))
{
	$Dfd_Services_Module = new Dfd_Services_Module;
}