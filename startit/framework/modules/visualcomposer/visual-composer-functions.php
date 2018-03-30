<?php

if(!function_exists('qode_startit_vc_grid_elements_enabled')) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function qode_startit_vc_grid_elements_enabled() {

		return (qode_startit_options()->getOptionValue('enable_grid_elements') == 'yes') ? true : false;

	}
}

if(!function_exists('qode_startit_visual_composer_grid_elements')) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function qode_startit_visual_composer_grid_elements() {

		if(!qode_startit_vc_grid_elements_enabled()) {
			remove_action('init', 'vc_grid_item_editor_create_post_type');
		}
	}

	add_action('vc_after_init', 'qode_startit_visual_composer_grid_elements', 12);
}

if(!function_exists('qode_startit_grid_elements_ajax_disable')) {
	/**
	 * Function that disables ajax transitions if grid elements are enabled in theme options
	 */
	function qode_startit_grid_elements_ajax_disable() {
		global $qode_startit_options;

		if(qode_startit_vc_grid_elements_enabled()) {
			$qode_startit_options['page_transitions'] = '0';
		}
	}

	add_action('wp', 'qode_startit_grid_elements_ajax_disable');
}


if(!function_exists('qode_startit_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function qode_startit_get_vc_version() {
		if(qode_startit_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}