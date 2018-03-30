<?php


function webnus_flexslider($attributes, $content){

$out = '<div class="flexslider"><ul class="slides">'. do_shortcode($content) .'</ul></div>';

return $out;
}

add_shortcode("flexslider", "webnus_flexslider");

function webnus_flexslideritem($attributes, $content){

	extract(shortcode_atts(array(
	
	"img" => '',
	"alt"=>''
	), $attributes));

$out = ' <li><img src="'.$img.'" alt="'.$alt.'"></li>';

return $out;
}

add_shortcode("flexitem", "webnus_flexslideritem");
?>