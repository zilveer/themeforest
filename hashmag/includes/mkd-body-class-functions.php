<?php

if(!function_exists('hashmag_mikado_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function hashmag_mikado_boxed_class($classes) {
        $id = hashmag_mikado_get_page_id();
        //is boxed layout turned on?
        if(hashmag_mikado_get_meta_field_intersect('boxed',$id) == 'yes') {
            $classes[] = 'mkdf-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_boxed_class');
}

if(!function_exists('hashmag_mikado_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function hashmag_mikado_theme_version_class($classes) {
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

    add_filter('body_class', 'hashmag_mikado_theme_version_class');
}

if(!function_exists('hashmag_mikado_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function hashmag_mikado_smooth_scroll_class($classes) {

        //is smooth scroll enabled enabled and not Mac device?
        if(hashmag_mikado_options()->getOptionValue('smooth_scroll') == 'yes') {
            $classes[] = 'mkdf-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_smooth_scroll_class');
}

if(!function_exists('hashmag_mikado_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function hashmag_mikado_set_blog_body_class($classes) {

        if(hashmag_mikado_load_blog_assets()) {
            $classes[] = 'mkdf-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_set_blog_body_class');
}

if(!function_exists('hashmag_mikado_set_category_template_body_class')) {
    /**
     * Function that adds class to body if unique category template layout is used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function hashmag_mikado_set_category_template_body_class($classes) {

        if(hashmag_mikado_options()->getOptionValue('unigue_category_layout') === 'yes'){
            $classes[] = 'mkdf-unique-category-layout';
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_set_category_template_body_class');
}

if(!function_exists('hashmag_mikado_set_title_body_class')) {
    /**
     * Function that adds class to body if unique category template layout is used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function hashmag_mikado_set_title_body_class($classes) {
        $id = hashmag_mikado_get_page_id();

        if(hashmag_mikado_get_meta_field_intersect('show_title_area',$id) == 'no'){
            $classes[] = 'mkdf-no-title-area';
        }

        return $classes;
    }

    add_filter('body_class', 'hashmag_mikado_set_title_body_class');
}