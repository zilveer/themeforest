<?php

add_action('after_setup_theme', 'edgt_meta_boxes_map_init', 1);
function edgt_meta_boxes_map_init() {
	global $edgt_options;
	global $edgtFramework;
	global $options_fontstyle;
	global $options_fontweight;
	global $options_texttransform;
	global $options_fontdecoration;
	global $options_arrows_type;
	require_once("page/map.inc");
	require_once("portfolio/map.inc");
	require_once("slides/map.inc");
	require_once("post/map.inc");
	require_once("testimonials/map.inc");
	require_once("carousels/map.inc");
	require_once("masonry_gallery/map.inc");
}