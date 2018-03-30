<?php

function wpv_shortcode_inline_divider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => '1',
	), $atts));

	if($type == '1')
		return '<div class="sep"></div>';

	if($type == '2')
		return '<div class="sep-2"></div>';

	if($type == '3')
		return '<div class="sep-3"></div>';

	if($type == 'clear')
		return '<div class="clearboth"></div>';
}
add_shortcode('inline_divider', 'wpv_shortcode_inline_divider');
