<?php

add_action('after_setup_theme', 'qode_meta_boxes_map_init', 1);
function qode_meta_boxes_map_init() {
	global $qode_options;
	global $qodeFramework;
	global $qode_options_fontstyle;
	global $qode_options_fontweight;
	global $qode_options_texttransform;
	global $qode_options_fontdecoration;
	global $qode_options_arrows_type;
	require_once("page/map.inc");
	require_once("portfolio/map.inc");
	require_once("slides/map.inc");
	require_once("post/map.inc");
	require_once("testimonials/map.inc");
	require_once("carousels/map.inc");
}