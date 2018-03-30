<?php

if(!function_exists('qode_startit_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function qode_startit_header_class($classes) {
        $header_type = qode_startit_get_meta_field_intersect('header_type', qode_startit_get_page_id());

        $classes[] = 'qodef-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'qode_startit_header_class');
}

if(!function_exists('qode_startit_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function qode_startit_header_behaviour_class($classes) {

        $classes[] = 'qodef-'.qode_startit_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'qode_startit_header_behaviour_class');
}

if(!function_exists('qode_startit_menu_item_icon_position_class')) {
    /**
     * Function that adds menu item icon position class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added menu item icon position class
     */
    function qode_startit_menu_item_icon_position_class($classes) {

        if(qode_startit_options()->getOptionValue('menu_item_icon_position') == 'top'){
            $classes[] = 'qodef-menu-with-large-icons';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_menu_item_icon_position_class');
}

if(!function_exists('qode_startit_mobile_header_class')) {
    function qode_startit_mobile_header_class($classes) {
        $classes[] = 'qodef-default-mobile-header';

        $classes[] = 'qodef-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'qode_startit_mobile_header_class');
}

if(!function_exists('qode_startit_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function qode_startit_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(qode_startit_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'qodef-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_header_class_first_level_bg_color');
}

if(!function_exists('qode_startit_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function qode_startit_menu_dropdown_appearance($classes) {

        if(qode_startit_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'qodef-'.qode_startit_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_menu_dropdown_appearance');
}

if (!function_exists('qode_startit_header_skin_class')) {

    function qode_startit_header_skin_class( $classes ) {

        $id = qode_startit_get_page_id();

		if(get_post_meta($id, 'qodef_header_style_meta', true) !== ''){
			$classes[] = 'qodef-' . get_post_meta($id, 'qodef_header_style_meta', true);
		} else if ( qode_startit_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'qodef-' . qode_startit_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'qode_startit_header_skin_class');

}

if (!function_exists('qode_startit_header_scroll_style_class')) {

	function qode_startit_header_scroll_style_class( $classes ) {

		if (qode_startit_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes' ) {
			$classes[] = 'qodef-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'qode_startit_header_scroll_style_class');

}

if(!function_exists('qode_startit_header_global_js_var')) {
    function qode_startit_header_global_js_var($global_variables) {

        $global_variables['qodefTopBarHeight'] = qode_startit_get_top_bar_height();
        $global_variables['qodefStickyHeaderHeight'] = qode_startit_get_sticky_header_height();
        $global_variables['qodefStickyHeaderTransparencyHeight'] = qode_startit_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('qode_startit_js_global_variables', 'qode_startit_header_global_js_var');
}

if(!function_exists('qode_startit_header_per_page_js_var')) {
    function qode_startit_header_per_page_js_var($perPageVars) {

        $perPageVars['qodefStickyScrollAmount'] = qode_startit_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('qode_startit_per_page_js_vars', 'qode_startit_header_per_page_js_var');
}