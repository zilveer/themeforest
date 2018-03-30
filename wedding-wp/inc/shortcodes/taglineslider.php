<?php


function webnus_taglineslider($attributes, $content){

$out = '<div class="tagline-slider flexslider"><ul class="slides">'. do_shortcode($content) .'</ul></div>';

return $out;
}

add_shortcode("taglineslider", "webnus_taglineslider");


function webnus_tagline($attributes, $content){

	extract(shortcode_atts(array(
	
	), $attributes));

$out = ' <li>'. do_shortcode($content) .'</li>';

return $out;
}

add_shortcode("tagline", "webnus_tagline");
?>