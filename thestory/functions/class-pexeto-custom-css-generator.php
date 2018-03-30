<?php

class PexetoCustomCssGenerator{

	public static $align_options = array(
		array('id'=>'cc', 'css_val'=>'center center', 'name' => 'Center'),
		array('id'=>'ct', 'css_val'=>'center top', 'name' => 'Center - Top'),
		array('id'=>'cb', 'css_val'=>'center bottom', 'name' => 'Center - Bottom'),
		array('id'=>'lt', 'css_val'=>'left top', 'name' => 'Left - Top'),
		array('id'=>'lc', 'css_val'=>'left center', 'name' => 'Left - Center'),
		array('id'=>'lb', 'css_val'=>'left bottom', 'name' => 'Left - Bottom'),
		array('id'=>'rt', 'css_val'=>'right top', 'name' => 'Right - Top'),
		array('id'=>'rc', 'css_val'=>'right center', 'name' => 'Right - Center'),
		array('id'=>'rb', 'css_val'=>'right bottom', 'name' => 'Right - Bottom')
	);

	public static function get_colors_css(){
		global $pexeto;

		return $pexeto->customizer->get_options_css();
	}

	public static function get_logo_css(){
		$width = pexeto_get_saved_option('logo_width');
		$height = pexeto_get_saved_option('logo_height');
		$css = '';

		if(!empty($width)){
			$css.= '#logo-container img{width:'.$width.'px; }';
		}

		if(!empty($height)){
			$css.= '#logo-container img{height:'.$height.'px;}';
		}
		return $css;
	}

	public static function get_fonts_css(){
		$css = '';

		//headings font
		$headings_font_family = pexeto_get_saved_option('headings_font_family');
		if(!empty($headings_font_family)){
			$css.= self::get_font_style('h1,h2,h3,h4,h5,h6,.pt-price', array('family'=>$headings_font_family));
		}
		
		//body font
		$body_font = pexeto_get_saved_option('body_font');
		$css.= self::get_font_style('body', $body_font);

		//body font size
		if(!empty($body_font['size'])){
			$css.= 'body, #footer, .sidebar-box, .services-box, .ps-content, .page-masonry .post, .services-title-box{font-size:'.$body_font['size'].'px;}';
		}

		//menu font
		$menu_font = pexeto_get_saved_option('menu_font');
		if($menu_font['size']=='13'){
			//fix the bug with the default menu size that is set to 13 being applied
			unset($menu_font['size']);
		}
		$css.= self::get_font_style('#menu ul li a', $menu_font, array('uppercase'));

		//header title font
		$header_title_font = pexeto_get_saved_option('header_title_font');
		$css.= self::get_font_style('.page-title h1', $header_title_font, array('uppercase', 'bold'));

		//widgets title font
		$widget_title_font = pexeto_get_saved_option('widget_title_font');
		$css.= self::get_font_style('.sidebar-box .title, .footer-box .title', $widget_title_font, array('uppercase', 'bold'));
	
		return $css;
	}


	protected static function get_font_style($selector, $styles, $def_styles=array()){
		$props = '';
		$css = '';

		
		if(!empty($styles['family']) && $styles['family']!='default'){
			//set the font family
			$font_name = pexeto_get_font_name_by_key($styles['family']);
			if(!empty($font_name)){
				$props.= 'font-family:'.$font_name.';';
			}
		}

		if(!empty($styles['size'])){
			//set the font family
			$props.= 'font-size:'.$styles['size'].'px;';
		}
	
		if(isset($styles['style'])){
			//set the style
			$font_style = $styles['style'];

			//set font weight
			if(in_array('bold', $font_style) && !in_array('bold', $def_styles)){
				$props.='font-weight:bold;';
			}elseif(!in_array('bold', $font_style) && in_array('bold', $def_styles)){
				$props.='font-weight:normal;';
			}

			//set font style
			if(in_array('italic', $font_style) && !in_array('italic', $def_styles)){
				$props.='font-style:italic;';
			}elseif(!in_array('italic', $font_style) && in_array('italic', $def_styles)){
				$props.='font-style:normal;';
			}

			//set text transform
			if(in_array('uppercase', $font_style) && !in_array('uppercase', $def_styles)){
				$props.='text-transform:uppercase;';
			}elseif(!in_array('uppercase', $font_style) && in_array('uppercase', $def_styles)){
				$props.='text-transform:none;';
			}
		}

		if(!empty($props)){
			$css = sprintf('%s{%s}', $selector, $props);
		}

		return $css;
	}

	public static function get_header_size_css(){
		$css='';

		$header_height = pexeto_get_saved_option('header_height');
		if(!empty($header_height)){
			$css.='.page-title-wrapper{min-height:'.$header_height.'px; height:'.$header_height.'px;}';
		}

		$large_header_height = pexeto_get_saved_option('large_header_height');
		if(!empty($large_header_height)){
			$css.='.large-header .page-title-wrapper{min-height:'.$large_header_height.'px; height:'.$large_header_height.'px;}';
		}

		return $css;
	}

	public static function get_bg_image_css(){
		$css = '';
		$bg = pexeto_option('bg_image');

		if(!empty($bg['url'])){
			$css.=sprintf('body{background-image:url("%s"); background-attachment:fixed;', $bg['url']);

			if($bg['style']=='repeat'){
				$css.='background-repeat:repeat;';
			}else{
				$css.='background-size:cover;';
			}

			$css.='}';
		}

		return $css;
	}

	public static function get_additional_css(){
		return pexeto_option('additional_styles');
	}

	public static function build_property_style($value, $prop_string){
		$properties = explode(',', $prop_string);
		$css = '';

		if(empty($value) && !in_array('textstyle', $properties)){
			return '';
		}

		foreach ($properties as $prop) {
			switch ($prop) {
				case 'color':
				case 'border-color':
				case 'background-color':
					$css.=$prop.':#'.$value.';';
					break;
				case 'background-image':
					$css.='background-image:url('.$value.');';
					break;
				case 'font-family':
					if($value!='default'){
						$css.='font-family:'.pexeto_get_font_name_by_key($value).';';
					}
					break;
				case 'font-size':
					$css.='font-size:'.$value.'px;';
					break;
				case 'textstyle':
					$styles = explode(',', $value);
					//font weight
					$font_weight = in_array('bold', $styles) ? 'bold' : 'normal';
					$css.='font-weight:'.$font_weight.';';

					//font style
					$font_style = in_array('italic', $styles) ? 'italic' : 'normal';
					$css.='font-style:'.$font_style.';';
					
					//text transform
					$text_transform = in_array('uppercase', $styles) ? 'uppercase' : 'none';
					$css.='text-transform:'.$text_transform.';';
					break;
			}
		}

		return $css;
	}

	public static function get_align_value_by_id($id){
		foreach (self::$align_options as $key => $option) {
			if($option['id']==$id){
				return $option['css_val'];
			}
		}
		return 'center center';
	}

	public static function get_general_css(){
		$css = '';
		//content slider: custom slider padding
		$cs_padding = pexeto_get_saved_option('content_padding');
		if((!empty($cs_padding) || $cs_padding=="0") && is_numeric($cs_padding)){
			$cs_padding_top = intval($cs_padding)+50;
			$cs_padding_bottom = max($cs_padding_top/1.38, 36);
			$cs_padding_bottom = intval($cs_padding_bottom);

			$css.=sprintf('.content-slider{padding-top:%spx; padding-bottom:%spx;}', $cs_padding_top, $cs_padding_bottom);

			$cs_mob_padding_top = max($cs_padding_top/1.2, 100);
			$cs_mob_padding_bottom = max($cs_padding_bottom/1.2, 75);
			$css.=sprintf('@media screen and (max-width: 1000px){.content-slider{padding-top:%spx; padding-bottom:%spx;}}', intval($cs_mob_padding_top), intval($cs_mob_padding_bottom) );

		}

		return $css;
	}

}