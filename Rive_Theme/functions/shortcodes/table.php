<?php

/*
* Custom styled tables
*/

function ch_custom_table($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => '' // table-striped, table-bordered, table-hover
	), $atts));
	return "<div class='table " . $type . "'>" . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('custom_table','ch_custom_table');