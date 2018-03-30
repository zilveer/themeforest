<?php

if(!function_exists('hue_mikado_boxed_class')) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function hue_mikado_boxed_class($classes) {

		//is boxed layout turned on?
		if(hue_mikado_options()->getOptionValue('boxed') == 'yes' && hue_mikado_get_meta_field_intersect('header_type') !== 'header-vertical') {
			$classes[] = 'mkd-boxed';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_boxed_class');
}

if(!function_exists('hue_mikado_theme_version_class')) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function hue_mikado_theme_version_class($classes) {
		$current_theme = wp_get_theme();

		//is child theme activated?
		if($current_theme->parent()) {
			//add child theme version
			$classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

			//get parent theme
			$current_theme = $current_theme->parent();
		}

		if($current_theme->exists() && $current_theme->get('Version') != '') {
			$classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_theme_version_class');
}

if(!function_exists('hue_mikado_smooth_scroll_class')) {
	/**
	 * Function that adds classes on body for smooth scroll
	 */
	function hue_mikado_smooth_scroll_class($classes) {
		//is smooth scroll enabled enabled and not Mac device?
		if(hue_mikado_options()->getOptionValue('smooth_scroll') == 'yes') {
			$classes[] = 'mkd-smooth-scroll';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_smooth_scroll_class');
}

if(!function_exists('hue_mikado_smooth_page_transitions_class')) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function hue_mikado_smooth_page_transitions_class($classes) {

		if(hue_mikado_options()->getOptionValue('smooth_page_transitions') == 'yes') {
			$classes[] = 'mkd-smooth-page-transitions';
		} else {
			$classes[] = '';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_smooth_page_transitions_class');
}

if(!function_exists('hue_mikado_smooth_ajax_class')) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function hue_mikado_smooth_ajax_class($classes) {
        if(hue_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
            $classes[] = hue_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'yes' ? 'mkd-ajax' : 'mkd-mimic-ajax';
        }

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_smooth_ajax_class');
}

if(!function_exists('hue_mikado_content_initial_width_body_class')) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function hue_mikado_content_initial_width_body_class($classes) {

		if(hue_mikado_options()->getOptionValue('initial_content_width')) {
			$classes[] = 'mkd-'.hue_mikado_options()->getOptionValue('initial_content_width');
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_content_initial_width_body_class');
}

if(!function_exists('hue_mikado_set_blog_body_class')) {
	/**
	 * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with blog body class added
	 */
	function hue_mikado_set_blog_body_class($classes) {

		if(hue_mikado_load_blog_assets()) {
			$classes[] = 'mkd-blog-installed';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_set_blog_body_class');
}


if(!function_exists('hue_mikado_set_portfolio_single_info_follow_body_class')) {
	/**
	 * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single small images or small slider
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with follow portfolio info class body class added
	 */

	function hue_mikado_set_portfolio_single_info_follow_body_class($classes) {

		if(is_singular('portfolio-item')) {
			if(hue_mikado_options()->getOptionValue('portfolio_single_sticky_sidebar') == 'yes') {
				$classes[] = 'mkd-follow-portfolio-info';
			}
		}


		return $classes;
	}

	add_filter('body_class', 'hue_mikado_set_portfolio_single_info_follow_body_class');
}