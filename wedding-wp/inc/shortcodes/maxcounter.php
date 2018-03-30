<?php

function webnus_maxcounter( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"type"      => '1',
	"icon" => '',
	"color" =>'',
	"count" =>'',
	"prefix" => '',
	"suffix" => '',
	"title" =>'',
	
	
		), $attributes));


	$out= '';
	switch($type){
		case 1:
		 	$out = '<div class="m-counter ';
		break;
		case 2:
			$out = '<div class="s-counter ';			
		break;
	}
	$out  .= 'max-counter" data-effecttype="counter" data-counter="' . $count . '">';
	$out  .= '<i class="icon-counter '. $icon .'" ';
	if(!empty($color))
		$out .= 'style="color:'. $color. '"';
	$out .= '></i>';
	if(!empty($prefix))
		$out  .= '<span class="pre-counter">'. $prefix .'</span>';
	$out .= '<span class="max-count">'. $count .'</span>';
	if(!empty($suffix))
		$out .= '<span class="suf-counter">'. $suffix .'</span>';
	$out .= '<h5>'. $title .'</h5>';
	$out .= '</div>';
	return $out;

}

add_shortcode('maxcounter', 'webnus_maxcounter');		
?>