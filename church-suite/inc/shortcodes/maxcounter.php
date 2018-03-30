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
	$out = '<div class="';
	switch($type){
		case 1:
		 	$out .= 'm-counter';
		break;
		case 2:
			$out .= 's-counter';			
		break;
		case 3:
		 	$out .= 't-counter';
		break;
		case 4:
		 	$out .= 'f-counter';
		break;			
	}
	$out  .= ' max-counter" data-effecttype="counter" data-counter="' . $count . '">';
	if($type== 2 OR $type== 3){
	$out  .= '<i class="icon-counter '. $icon .'" ';
	if(!empty($color))
	$out .= 'style="color:'. $color. '"';
	$out .= '></i>';
	}
	if(!empty($prefix))
		$out  .= '<span class="pre-counter">'. $prefix .'</span>';
		$out .= '<span class="max-count">'. $count .'</span>';
	if(!empty($suffix))
		$out .= '<span class="suf-counter">'. $suffix .'</span>';
	if($type== 4){
		$out  .= '<i class="icon-counter '. $icon .'" ';
		if(!empty($color))
		$out .= 'style="color:'. $color. '"';
		$out .= '></i>';
	}
	$out .= '<h5>'. $title .'</h5>';
	$out .= '</div>';
	return $out;
}
add_shortcode('maxcounter', 'webnus_maxcounter');		
?>