<?php

// [separator]
function shortcode_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '0px',
		'bottom_space' => '0px'
	), $params));
	$separator = '<div class="shortcode_separator" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div>';
	return $separator;
}
add_shortcode("separator", "shortcode_separator");