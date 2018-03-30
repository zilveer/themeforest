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
				$type = 'category';
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

/**
 *  Retrieve original post id
 */
if ( !function_exists('tmm_wpml_get_original_postid') ) {
	function tmm_wpml_get_original_postid($post_id) {
		if(defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$post_id = icl_object_id( $post_id, get_post_type($post_id), true, $sitepress->get_default_language() );
		}
		return $post_id;
	}
}

add_filter( 'tmm_wpml_original_postid', 'tmm_wpml_get_original_postid', 10, 1 );

/**
 * Filter links in Language switcher widget
 */
if ( !function_exists('tmm_wpml_filter_link') ) {
	function tmm_wpml_filter_link($params) {
		$params[] = 'car_condition';
		$params[] = 'carlocation';
		$params[] = 'carproducer';
		$params[] = 'carmodels';
		$params[] = 'car_price_min';
		$params[] = 'car_price_max';
		$params[] = 'car_year_from';
		$params[] = 'car_year_to';
		$params[] = 'car_body';
		$params[] = 'car_doors_count';
		$params[] = 'car_interrior_color';
		$params[] = 'car_exterior_color';
		$params[] = 'car_transmission';
		$params[] = 'car_fuel_type';
		$params[] = 'car_mileage_from';
		$params[] = 'car_mileage_to';
		$params[] = 'adv_params';

		$params[] = 'order';
		$params[] = 'orderby';
		$params[] = 'per_page';
		$params[] = 'lost-password';
		$params[] = 'dealer_id';
		$params[] = 'car_id';
		return $params;
	}
}

add_filter( 'icl_lang_sel_copy_parameters', 'tmm_wpml_filter_link', 10, 2 );


/**
 *  Switch language to default
 */
if ( !function_exists('tmm_wpml_switch_lang_to_default') ) {
	function tmm_wpml_switch_lang_to_default() {
		global $sitepress;
		$default_language = $sitepress->get_default_language();
		$sitepress->switch_lang( $default_language, false );
	}
}

add_action('tmm_wpml_switch_lang_to_default', 'tmm_wpml_switch_lang_to_default');

/**
 *  Switch language to current
 */
if ( !function_exists('tmm_wpml_switch_lang_to_current') ) {
	function tmm_wpml_switch_lang_to_current() {
		global $sitepress;
		$current_language = $sitepress->get_current_language();
		$sitepress->switch_lang( $current_language, false );
	}
}

add_action('tmm_wpml_switch_lang_to_current', 'tmm_wpml_switch_lang_to_current');

/**
 *  Duplicate posts
 */
if ( !function_exists('tmm_wpml_duplicate_posts') ) {
	function tmm_wpml_duplicate_posts($post_id) {
		global $sitepress;
		$post_type = get_post_type($post_id);

		if($sitepress->is_translated_post_type( $post_type ) && class_exists('TranslationManagement')){
			$translation_management = new TranslationManagement();

			$language_details_original = $sitepress->get_element_language_details( $post_id, 'post_' . $post_type );
			$data[ 'iclpost' ] = array( $post_id );
			foreach ( $sitepress->get_active_languages() as $lang => $details ) {
				if ( $lang != $language_details_original->language_code ) {
					$data[ 'duplicate_to' ][ $lang ] = 1;
				}
			}

			$translation_management->make_duplicates( $data );
		}
	}
}

add_action('tmm_wpml_duplicate_posts', 'tmm_wpml_duplicate_posts', 10, 1);

/**
 * Get post ID related to current language
 */
if ( !function_exists('tmm_wpml_current_lang_postid') ) {
	function tmm_wpml_current_lang_postid($post_id) {
		global $sitepress;
		$current_language = $sitepress->get_current_language();
		$post_id = icl_object_id( $post_id, get_post_type($post_id), true, $current_language );
		return $post_id;
	}
}

add_filter( 'tmm_current_lang_postid', 'tmm_wpml_current_lang_postid', 10, 1 );