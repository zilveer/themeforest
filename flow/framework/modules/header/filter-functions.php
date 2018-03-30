<?php

if(!function_exists('flow_elated_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function flow_elated_header_class($classes) {
        $header_type = flow_elated_get_meta_field_intersect('header_type', flow_elated_get_page_id());

        $classes[] = 'eltd-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'flow_elated_header_class');
}

if(!function_exists('flow_elated_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function flow_elated_header_behaviour_class($classes) {

        $classes[] = 'eltd-'.flow_elated_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'flow_elated_header_behaviour_class');
}

if(!function_exists('flow_elated_menu_item_icon_position_class')) {
    /**
     * Function that adds menu item icon position class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added menu item icon position class
     */
    function flow_elated_menu_item_icon_position_class($classes) {

        if(flow_elated_options()->getOptionValue('menu_item_icon_position') == 'top'){
            $classes[] = 'eltd-menu-with-large-icons';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_menu_item_icon_position_class');
}

if(!function_exists('flow_elated_mobile_header_class')) {
    function flow_elated_mobile_header_class($classes) {
        $classes[] = 'eltd-default-mobile-header';

        $classes[] = 'eltd-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'flow_elated_mobile_header_class');
}

if(!function_exists('flow_elated_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function flow_elated_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(flow_elated_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'eltd-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_header_class_first_level_bg_color');
}

if(!function_exists('flow_elated_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function flow_elated_menu_dropdown_appearance($classes) {

        if(flow_elated_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'eltd-'.flow_elated_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_menu_dropdown_appearance');
}

if (!function_exists('flow_elated_header_skin_class')) {

    function flow_elated_header_skin_class( $classes ) {

        $id = flow_elated_get_page_id();

		if(($meta_temp = get_post_meta($id, 'eltd_header_style_meta', true)) !== ''){
			$classes[] = 'eltd-' . $meta_temp;
		} else if ( flow_elated_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'eltd-' . flow_elated_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'flow_elated_header_skin_class');

}

if (!function_exists('flow_elated_header_scroll_style_class')) {

	function flow_elated_header_scroll_style_class( $classes ) {

		if (flow_elated_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes' ) {
			$classes[] = 'eltd-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'flow_elated_header_scroll_style_class');

}

if(!function_exists('flow_elated_header_global_js_var')) {
    function flow_elated_header_global_js_var($global_variables) {

        $global_variables['eltdTopBarHeight'] = flow_elated_get_top_bar_height();
        $global_variables['eltdStickyHeaderHeight'] = flow_elated_get_sticky_header_height();
        $global_variables['eltdStickyHeaderTransparencyHeight'] = flow_elated_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('flow_elated_js_global_variables', 'flow_elated_header_global_js_var');
}

if(!function_exists('flow_elated_header_per_page_js_var')) {
    function flow_elated_header_per_page_js_var($perPageVars) {

        $perPageVars['eltdStickyScrollAmount'] = flow_elated_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('flow_elated_per_page_js_vars', 'flow_elated_header_per_page_js_var');
}