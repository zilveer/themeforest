<?php
if(!function_exists('theme_shortcode_divider')){
function theme_shortcode_divider() {
	return '<div class="divider"></div>';
}
}
add_shortcode('divider', 'theme_shortcode_divider');

if(!function_exists('theme_shortcode_divider_top')){
function theme_shortcode_divider_top() {
	return '<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div>';
}
}
add_shortcode('divider_top', 'theme_shortcode_divider_top');

if(!function_exists('theme_shortcode_divider_padding')){
function theme_shortcode_divider_padding() {
	return '<div class="divider_padding"></div>';
}
}
add_shortcode('divider_padding', 'theme_shortcode_divider_padding');

if(!function_exists('theme_shortcode_divider_line')){
function theme_shortcode_divider_line() {
	return '<div class="divider_line"></div>';
}
}
add_shortcode('divider_line', 'theme_shortcode_divider_line');

if(!function_exists('theme_shortcode_clearboth')){
function theme_shortcode_clearboth() {
   return '<div class="clearboth"></div>';
}
}
add_shortcode('clearboth', 'theme_shortcode_clearboth');

if(!function_exists('theme_shortcode_advanced_divider')){
function theme_shortcode_advanced_divider($atts) {
	extract(shortcode_atts(array(
		'color' => '',
		'paddingtop' => '20',
		'paddingbottom'=> 'false',
		'thickness'=> 'false',
		'width' => 'false',
		'top' => 'false',
	), $atts));
	$styles = array();
	if($color !== ''){
		$styles[] = 'border-color:'.$color;
	}
	if($paddingtop!== '20'){
		$styles[] = 'padding-top:'.$paddingtop.'px';
	}
	if($paddingbottom!== 'false'){
		$styles[] = 'margin-bottom:'.$paddingbottom.'px';
	}
	if($thickness!== 'false'){
		$styles[] = 'border-bottom-width:'.$thickness.'px';
	}
	if($width!== 'false'){
		$styles[] = 'margin-right:auto; margin-left:auto; width:'.$width;
	}
	if(!empty($styles)){
		$style = ' style="'.implode(';', $styles).'"';
	}else{
		$style = '';
	}
	if($top !== 'false'){
		$top = ' top';
		$top_text = '<a href="#">'.__('Top','striking-r').'</a>';
	}else{
		$top = '';
		$top_text = '';
	}
	return '<div class="divider'.$top.'"'.$style.'>'.$top_text.'</div>';
}
}
add_shortcode('divider_advanced', 'theme_shortcode_advanced_divider');