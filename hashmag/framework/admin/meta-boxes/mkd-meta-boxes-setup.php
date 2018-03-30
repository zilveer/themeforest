<?php

add_action('after_setup_theme', 'hashmag_mikado_meta_boxes_map_init', 1);
function hashmag_mikado_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('hashmag_mikado_before_meta_boxes_map');

	global $hashmag_options;
	global $hashmag_Framework;
	global $hashmag_options_fontstyle;
	global $hashmag_options_fontweight;
	global $hashmag_options_texttransform;
	global $hashmag_options_fontdecoration;
	global $hashmag_options_arrows_type;

    foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('hashmag_mikado_meta_boxes_map');

	do_action('hashmag_mikado_after_meta_boxes_map');
}