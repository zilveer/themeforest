<?php
function theme_shortcode_table($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'width' => false,
	), $atts));
	
	
	if($width){
		$width = ' style="width:'.$width.'"';
	}else{
		$width = '';
	}
	
	$id = $id?' id="'.$id.'"':'';
	
	return '<div'.$id.$width.' class="table_style">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('styled_table','theme_shortcode_table');