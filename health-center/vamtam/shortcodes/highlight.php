<?php

function wpv_shortcode_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => false
	), $atts));

	return "<span class='highlight $type'>".do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'wpv_shortcode_highlight');