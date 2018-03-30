<?php

if(!function_exists('hashmag_mikado_vc_grid_elements_enabled')) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function hashmag_mikado_vc_grid_elements_enabled() {

		return (hashmag_mikado_options()->getOptionValue('enable_grid_elements') == 'yes') ? true : false;
	}
}

if(!function_exists('hashmag_mikado_visual_composer_grid_elements')) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function hashmag_mikado_visual_composer_grid_elements() {

		if(!hashmag_mikado_vc_grid_elements_enabled()) {
			remove_action('init', 'vc_grid_item_editor_create_post_type');
		}
	}

	add_action('vc_after_init', 'hashmag_mikado_visual_composer_grid_elements', 12);
}

if(!function_exists('hashmag_mikado_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function hashmag_mikado_get_vc_version() {
		if(hashmag_mikado_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}