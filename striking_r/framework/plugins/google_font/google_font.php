<?php
class Theme_google_fonts {
	public $api_key = 'AIzaSyCgEsDL4OM-MGK7PvtC5TgB3uewYNBS1hE';
	public $api_url = 'https://www.googleapis.com/webfonts/v1/webfonts';
	public $list_file = 'list.php';
	public $fonts;
	
	function __construct(){
		$this->fonts = $this->fonts();
	}

	function fonts(){
		$fonts = $this->fonts_from_cache();
		if(empty($fonts)){
			$fonts = $this->update_fonts_cache();
		}
		return $fonts;
	}

	function update_fonts_cache(){
		$json = $this->list_from_remote();
		if(!$json){
			$json = $this->list_from_local();
		}
		$raw_fonts = json_decode($json);
		$fonts = array();
		foreach ($raw_fonts->items as $font) {
			unset($font->kind);
			$fonts[$font->family] = $font;
		}

		$fonts = $this->fonts_with_variant($fonts);
		update_option('theme_google_fonts',$fonts);
		return $fonts;
	}

	function remote_url(){
		if($this->api_key){
			return $this->api_url . '?key=' . $this->api_key;
		}else{
			return $this->api_url;
		}
	}

	function list_from_remote(){
		$json = false;
		
		if(function_exists('wp_remote_get')){
			$url = $this->remote_url();
			$response = wp_remote_get($url, array('sslverify' => false));
			if(!is_wp_error($response) && isset($response['body']) && $response['body']){
				if(strpos($response['body'], 'error') === false){
					$json = $response['body'];
				}
			}
		}
		
		return $json;
	}

	function list_from_local(){
		include($this->list_file);
		return $json;
	}

	function fonts_from_cache(){
		$fonts = get_option('theme_google_fonts');
		if($fonts){
			return $fonts;
		}
	}

	function familys(){
		$familys = $this->familys_from_cache();

		if(empty($familys)){
			$familys = $this->update_familys_cache();
		}
		return $familys;
	}

	function update_familys_cache(){
		$familys = array();
		foreach ($this->fonts as $font) {
			$familys[$font->family] = $font->name;
		}

		update_option('theme_google_fonts_familys',$familys);
		return $familys;
	}

	function familys_from_cache(){
		$familys = get_option('theme_google_fonts_familys');
		if($familys){
			return $familys;
		}
	}


	function font($family){
		if(array_key_exists($family, $this->fonts)){
			return $this->fonts[$family];
		}else{
			return null;
		}
	}

	function fonts_with_variant($webfonts){
		$fonts = array();
		foreach($webfonts as $font){
			foreach($font->variants as $variant){
				$font_array = array();
				$font_array['_family'] = $font->family;
				$font_array['family'] = $this->variantize_font_family($font->family, $variant);
				$font_array['name'] = $this->variantize_font_name($font->family, $variant);
				$font_array['subsets'] = $font->subsets;
				$font_array['weight'] = $this->font_weight_from_variant($variant);

				if(stripos($variant,'italic') !== false){
					$font_array['italic'] = true;
				}else{
					$font_array['italic'] = false;
				}

				$fonts[$font_array['family']] = (object) $font_array;
			}
		}
		return $fonts;
	}

	function font_weight_from_variant($variant){
		switch ($variant) {
			case 'regular':
			case 'italic':
				return '400';
			default:
				return str_replace('italic', '', $variant);
		}
	}

	function variantize_font_family($family, $variant){
		switch ($variant) {
			case 'regular':
				return $family;
			case 'italic':
				return $family.':400italic';
			default:
				return $family.':'.$variant;
		}
	}

	function unvariantize_font_family($family){
		if($pos = stripos($family,':') !== false){
			$family = substr($family, 0, $pos);
		}
		return $family;
	}

	function variantize_font_name($family,$variant){
		$name = $this->variant_to_name($variant);
		if($name){
			return $family.' '.$name;
		}else{
			return $family;
		}
	}

	function variant_to_name($variant){
		$variant_mapping = array(
			'100' => 'Ultra-Light 100',
			'200' => 'Light 200',
			'300' => 'Book 300',
			'400' => 'Normal 400',
			'500' => 'Medium 500',
			'600' => 'Semi-Bold 600',
			'700' => 'Bold 700',
			'800' => 'Extra-Bold 800',
			'900' => 'Ultra-Bold 900',
			'regular' => 'Normal 400'
		);

		$italic = false; 
		if(stripos($variant,'italic') !== false){
			$italic = true;
		}
		switch ($variant) {
			case 'regular':
				return 'Normal 400';
			case 'italic':
				return 'Normal 400 Italic';
			default:
				if($italic){
					$variant = str_replace('italic','',$variant);
				}
				if(array_key_exists($variant, $variant_mapping)){
					$name = $variant_mapping[$variant];
					if($italic){
						return $name.' Italic';
					}else{
						return $name;
					}
				} else {
					return false;
				}
		}
	}
}


function theme_set_google_font_subsets($font, $subsets){
	$fonts_subsets = get_option('theme_google_fonts_subsets');
	if(empty($fonts_subsets) && !is_array($fonts_subsets)){
		$fonts_subsets = array();
	}
	if(is_array($subsets) && !empty($subsets)){
		$fonts_subsets[$font] = $subsets;
	}else{
		unset($fonts_subsets[$font]);
	}


	update_option('theme_google_fonts_subsets', $fonts_subsets);
}

function theme_get_google_font_subsets($font){

	$fonts_subsets = get_option('theme_google_fonts_subsets');
	if(is_array($fonts_subsets) && array_key_exists($font, $fonts_subsets) && !empty($fonts_subsets[$font])){
		return $fonts_subsets[$font];
	} else {
		global $google_fonts;
		if(empty($google_fonts)){
			$google_fonts = new Theme_google_fonts();
		}
		$font_obj = $google_fonts->font($font);
		if(!empty($font_obj) && isset($font_obj->subsets) && is_array($font_obj->subsets)){
			if(in_array('latin', $font_obj->subsets)){
				return array('latin');
			}else{
				return array_slice($font_obj->subsets, 0, 1);
			}
		}else{
			return array();
		}
	}
}

if(is_admin()){
	global $google_fonts;
	$google_fonts = new Theme_google_fonts();
}