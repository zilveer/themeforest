<?php
/*
 * Headings shortcodes
 */


// Basic shortcodes
function ch_h1($atts, $content = null) {
	return '<h1>' . do_shortcode($content) . '</h1>';
}
add_shortcode('h1', 'ch_h1');

function ch_h2($atts, $content = null) {
	return '<h2>' . do_shortcode($content) . '</h2>';
}
add_shortcode('h2', 'ch_h2');

function ch_h3($atts, $content = null) {
	return '<h3>' . do_shortcode($content) . '</h3>';
}
add_shortcode('h3', 'ch_h3');

function ch_h4($atts, $content = null) {
	return '<h4>' . do_shortcode($content) . '</h4>';
}
add_shortcode('h4', 'ch_h4');

function ch_h5($atts, $content = null) {
	return '<h5>' . do_shortcode($content) . '</h5>';
}
add_shortcode('h5', 'ch_h5');

function ch_h6($atts, $content = null) {
	return '<h6>' . do_shortcode($content) . '</h6>';
}
add_shortcode('h6', 'ch_h6');