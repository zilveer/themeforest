<?php

if(!function_exists('libero_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function libero_mikado_header_class($classes) {
        $header_type = libero_mikado_get_meta_field_intersect('header_type', libero_mikado_get_page_id());

        $classes[] = 'mkd-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'libero_mikado_header_class');
}

if(!function_exists('libero_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function libero_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkd-'.libero_mikado_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'libero_mikado_header_behaviour_class');
}

if(!function_exists('libero_mikado_mobile_header_class')) {
    function libero_mikado_mobile_header_class($classes) {
        $classes[] = 'mkd-default-mobile-header';

        $classes[] = 'mkd-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'libero_mikado_mobile_header_class');
}

if(!function_exists('libero_mikado_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function libero_mikado_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(libero_mikado_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'mkd-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'libero_mikado_header_class_first_level_bg_color');
}

if(!function_exists('libero_mikado_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function libero_mikado_menu_dropdown_appearance($classes) {

        if(libero_mikado_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'mkd-'.libero_mikado_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'libero_mikado_menu_dropdown_appearance');
}

if (!function_exists('libero_mikado_header_skin_class')) {

    function libero_mikado_header_skin_class( $classes ) {

        $id = libero_mikado_get_page_id();

		if(get_post_meta($id, 'mkd_header_style_meta', true) !== ''){
			$classes[] = 'mkd-' . get_post_meta($id, 'mkd_header_style_meta', true);
		} else if ( libero_mikado_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'mkd-' . libero_mikado_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'libero_mikado_header_skin_class');

}

if (!function_exists('libero_mikado_header_scroll_style_class')) {

	function libero_mikado_header_scroll_style_class( $classes ) {

		if (libero_mikado_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes' ) {
			$classes[] = 'mkd-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'libero_mikado_header_scroll_style_class');

}

if(!function_exists('libero_mikado_header_global_js_var')) {
    function libero_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdTopBarHeight'] = 0; //beacuse there is no top header on this theme
        $global_variables['mkdStickyHeaderHeight'] = libero_mikado_get_sticky_header_height();
        $global_variables['mkdStickyHeaderTransparencyHeight'] = libero_mikado_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('libero_mikado_js_global_variables', 'libero_mikado_header_global_js_var');
}

if(!function_exists('libero_mikado_header_per_page_js_var')) {
    function libero_mikado_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdStickyScrollAmount'] = libero_mikado_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('libero_mikado_per_page_js_vars', 'libero_mikado_header_per_page_js_var');
}