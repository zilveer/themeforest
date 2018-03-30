<?php
if(!function_exists('theme_shortcode_table')){
function theme_shortcode_table($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'width' => false,
		'class' => '',
	), $atts));
	
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = ' style="width:'.$width.'"';
	}else{
		$width = '';
	}
	
	$id = $id?' id="'.$id.'"':'';

	if($class){
		$class = ' '.$class;
	}
	
	return '<div'.$id.$width.' class="table_style'.$class.'">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('styled_table','theme_shortcode_table');