<?php

/**
 *  WPML init
 */
if ( !function_exists('tmm_wpml_init') ) {
	function tmm_wpml_init() {
		add_filter('tmm_custom_sidebar_page', 'tmm_wpml_custom_sidebar_page', 1000);
	}
}

add_action('init', 'tmm_wpml_init', 1);

/**
 * 	Custom sidebar page id
 */
if ( !function_exists('tmm_wpml_custom_sidebar_page') ) {
	function tmm_wpml_custom_sidebar_page( $id ) {

		if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){

			if (is_tax()) {
				//$type = 'category';
			} else if (is_category()) {
				$type = 'category';
			} else {
				$type = get_post_type();
			}

			global $sitepress;
			$id =  icl_object_id($id, $type, true, $sitepress->get_default_language());
		}

		return $id;
	}
}

