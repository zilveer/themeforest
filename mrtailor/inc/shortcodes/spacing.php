<?php

// [spacing]
function shortcode_spacing($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'height' => '30px'
	), $params));
	$spacing = '<div class="shortcode_spacing" style="height:'.$height.'"></div>';
	return $spacing;
}
add_shortcode("spacing", "shortcode_spacing");