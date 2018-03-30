<?php
/*
* Show dividers
*/

function ch_divider ($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 'type_1' // type_1, type_2
	), $atts));

	return '<div class="divider ' . $type . '"></div>';
}
add_shortcode('divider', 'ch_divider');