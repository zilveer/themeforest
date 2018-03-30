<?php

if(!function_exists('hashmag_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function hashmag_mikado_header_class($classes) {
        $header_type = 'header-type3';

        $classes[] = 'mkdf-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_header_class');
}

if(!function_exists('hashmag_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function hashmag_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkdf-'.hashmag_mikado_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_header_behaviour_class');
}

if(!function_exists('hashmag_mikado_header_style_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function hashmag_mikado_header_style_class($classes) {

        $id = hashmag_mikado_get_page_id();

        if(hashmag_mikado_get_meta_field_intersect('header_style', $id) !== '') {
            $classes[] = 'mkdf-' . hashmag_mikado_get_meta_field_intersect('header_style', $id);
        }
        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_header_style_class');
}

if(!function_exists('hashmag_mikado_mobile_header_class')) {
    function hashmag_mikado_mobile_header_class($classes) {
        $classes[] = 'mkdf-default-mobile-header';

        $classes[] = 'mkdf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_mobile_header_class');
}

if(!function_exists('hashmag_mikado_header_global_js_var')) {
    function hashmag_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdfTopBarHeight'] = hashmag_mikado_get_top_bar_height();
        $global_variables['mkdfStickyHeaderHeight'] = hashmag_mikado_get_sticky_header_height();
        $global_variables['mkdfStickyHeaderTransparencyHeight'] = hashmag_mikado_get_sticky_header_height_of_complete_transparency();
        $global_variables['mkdfMobileHeaderHeight'] = hashmag_mikado_get_mobile_header_height();

        return $global_variables;
    }

    add_filter('hashmag_mikado_js_global_variables', 'hashmag_mikado_header_global_js_var');
}

if(!function_exists('hashmag_mikado_header_per_page_js_var')) {
    function hashmag_mikado_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdfStickyScrollAmount'] = hashmag_mikado_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('hashmag_mikado_per_page_js_vars', 'hashmag_mikado_header_per_page_js_var');
}

if(!function_exists('hashmag_mikado_aps_custom_style_class')) {
    function hashmag_mikado_aps_custom_style_class($classes) {

        if(hashmag_mikado_options()->getOptionValue('aps_custom_style') !== ''){
            $classes[] = 'mkdf-'.hashmag_mikado_options()->getOptionValue('aps_custom_style');
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_aps_custom_style_class');
}