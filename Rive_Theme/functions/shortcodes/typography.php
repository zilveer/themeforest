<?php

/*
* Typography shortcodes
*/

// Label
function ch_label($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => '' // label-important, label-success, label-warning, label-info, label-inverse
	), $atts));

	return '<span class="label ' . $type . '">' . do_shortcode($content) . '</span>';
}
add_shortcode('label', 'ch_label');

// Badge
function ch_badge($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => '' // badge-important, badge-success, badge-warning, badge-info, badge-inverse
	), $atts));

	return '<span class="badge ' . $type . '">' . do_shortcode($content) . '</span>';
}
add_shortcode('badge', 'ch_badge');

// Dropcaps
function ch_dropcap($atts, $content = null, $code) {
	extract(shortcode_atts(array(), $atts));

	return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'ch_dropcap');

// Lists
function ch_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => false
	), $atts));

	return str_replace(array( '<ul>', '<li>' ), array( '<ul class="the-icons clearfix">', '<li><i class="' . $type . '"></i>' ), do_shortcode($content));
}
add_shortcode('list', 'ch_list');