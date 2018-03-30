<?php

if(!function_exists('hashmag_mikado_bbpress_disable_breadcrumbs')) {
    /**
     * This function disable breadcrumbs on BBPress
     * @return bool
     */
    function hashmag_mikado_bbpress_disable_breadcrumbs() {
        return true;
    }

	//add_filter('bbp_no_breadcrumb', 'hashmag_mikado_bbpress_disable_breadcrumbs');
}

if(!function_exists('hashmag_mikado_bbpress_remove_single_forum_description')) {
    /**
     * This function overwrite description from BBPress plugin
     * @return string
     */
    function hashmag_mikado_bbpress_remove_single_forum_description() {
		return '';
    }

	//add_filter('bbp_get_single_forum_description', 'hashmag_mikado_bbpress_remove_single_forum_description');
}

if(!function_exists('hashmag_mikado_bbpress_remove_single_forum_subscribe_link')) {
    function hashmag_mikado_bbpress_remove_single_forum_subscribe_link() {
        /**
         * This function overwrite subscribe link from BBPress plugin
         * @return string
         */
		return '';
    }

	add_filter('bbp_get_forum_subscribe_link', 'hashmag_mikado_bbpress_remove_single_forum_subscribe_link');
}

if(!function_exists('hashmag_mikado_bbpress_remove_single_user_subscribe_link')) {
    function hashmag_mikado_bbpress_remove_single_user_subscribe_link() {
        /**
         * This function overwrite subscribe link from BBPress plugin
         * @return string
         */
		return '';
    }

	add_filter('bbp_get_user_subscribe_link', 'hashmag_mikado_bbpress_remove_single_user_subscribe_link');
}

if(!function_exists('hashmag_mikado_bbpress_remove_single_user_favorites_link')) {
    function hashmag_mikado_bbpress_remove_single_user_favorites_link() {
        /**
         * This function overwrite favorites link from BBPress plugin
         * @return string
         */
		return '';
    }

	add_filter('bbp_get_user_favorites_link', 'hashmag_mikado_bbpress_remove_single_user_favorites_link');
}

if(!function_exists('hashmag_mikado_bbpress_bbp_get_breadcrumb')) {
    function hashmag_mikado_bbpress_bbp_get_breadcrumb() {
        /**
         * This function overwrite breadcrumbs separator from BBPress plugin
         *
         */

        return " / ";

    }

	add_filter('bbp_breadcrumb_separator', 'hashmag_mikado_bbpress_bbp_get_breadcrumb');
}

if(!function_exists('hashmag_mikado_bbpress_body_class')) {
    /**
     * This function add BBPress class if it is installed
     * @param $classes
     * @return array
     */
    function hashmag_mikado_bbpress_body_class($classes) {
        $classes[] = 'mkdf-bbpress-installed';

	    return $classes;
    }

	add_filter('body_class', 'hashmag_mikado_bbpress_body_class');
}