<?php

function wpv_shortcode_dropcap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 1,
		'color' => ''
	), $atts));

	$code .= $type;
	
	return "<span class='$code $color'>" . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'wpv_shortcode_dropcap');