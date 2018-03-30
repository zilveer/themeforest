<?php

add_action('after_setup_theme', 'qode_startit_meta_boxes_map_init', 1);
function qode_startit_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('qode_startit_before_meta_boxes_map');

	global $qode_startit_options;
	global $qode_startit_Framework;
	global $qode_startit_options_fontstyle;
	global $qode_startit_options_fontweight;
	global $qode_startit_options_texttransform;
	global $qode_startit_options_fontdecoration;
	global $qode_startit_options_arrows_type;

    foreach(glob(QODE_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('qode_startit_meta_boxes_map');

	do_action('qode_startit_after_meta_boxes_map');
}