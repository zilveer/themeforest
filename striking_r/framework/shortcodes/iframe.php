<?php
if(!function_exists('theme_shortcode_iframe')){
function theme_shortcode_iframe($atts, $content = null) {
	extract(shortcode_atts(array(
		'width' => false,
		'height' => false,
		'src' => '',
		'class'=>''
	), $atts));
	
	$style = array();

	if(is_numeric($width)){
		$width = $width.'px';
	}
	if(is_numeric($height)){
		$height = $height.'px';
	}
	if($width){
		$style[] = 'width:'.$width;
	}
	if($height){
		$style[] = 'height:'.$height;
	}
	if(!empty($style)){
		$styles = ' style="'.implode(';',$style).'"';
	}else{
		$styles = '';
	}
	
	$width = $width?' width="'.$width.'"':'';
	$height = $height?' height="'.$height.'"':'';

	return '<iframe class="'.$class.'" src="'.$src.'"'.$width.$height.$styles.' seamless="seamless" frameborder="0"></iframe>';
}
}

add_shortcode('iframe','theme_shortcode_iframe');