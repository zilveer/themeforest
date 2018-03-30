<?php

if(!function_exists('flow_elated_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function flow_elated_boxed_class($classes) {

        //is boxed layout turned on?
        if(flow_elated_options()->getOptionValue('boxed') == 'yes' && flow_elated_get_meta_field_intersect('header_type') !== 'header-vertical') {
            $classes[] = 'eltd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_boxed_class');
}

if(!function_exists('flow_elated_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function flow_elated_theme_version_class($classes) {
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

    add_filter('body_class', 'flow_elated_theme_version_class');
}

if(!function_exists('flow_elated_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function flow_elated_smooth_scroll_class($classes) {

        //is smooth scroll enabled enabled?
        if(flow_elated_options()->getOptionValue('smooth_scroll') == 'yes') {
            $classes[] = 'eltd-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_smooth_scroll_class');
}

if(!function_exists('flow_elated_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function flow_elated_smooth_page_transitions_class($classes) {

        if(flow_elated_options()->getOptionValue('smooth_page_transitions') == 'yes') {
            $classes[] = 'eltd-smooth-page-transitions';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_smooth_page_transitions_class');
}

if(!function_exists('flow_elated_smooth_pt_true_ajax_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function flow_elated_smooth_pt_true_ajax_class($classes) {

        if(flow_elated_options()->getOptionValue('smooth_pt_true_ajax') !== '') {
            $classes[] = flow_elated_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'mimic-ajax' : 'ajax';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_smooth_pt_true_ajax_class');
}

if(!function_exists('flow_elated_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function flow_elated_content_initial_width_body_class($classes) {

        if(flow_elated_options()->getOptionValue('initial_content_width')) {
            $classes[] = 'eltd-'.flow_elated_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_content_initial_width_body_class');
}

if(!function_exists('flow_elated_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function flow_elated_set_blog_body_class($classes) {

        if(flow_elated_load_blog_assets()) {
            $classes[] = 'eltd-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'flow_elated_set_blog_body_class');
}

if(!function_exists('flow_elated_set_blog_template_body_class')) {
    /**
     * Function that body class for selected blog type
     *
     * @param $classes array of body classes
     *
     * @return array with blog template body class added
     */

    function flow_elated_set_blog_template_body_class($classes) {
        
        $classes[] = 'page-template-blog-'. flow_elated_options()->getOption('blog_list_type');
        return $classes;
    }
	add_filter('body_class', 'flow_elated_set_blog_template_body_class');
}
   
if ( !function_exists( 'flow_elated_ajax_search' ) ) {

    function flow_elated_ajax_search( $classes ) {

        if ( is_page_template( 'blog-expanding-tiles.php' ) ) {
            $classes[] = 'eltd-ajax-search';
        }

        return $classes;

    }

    add_filter( 'body_class', 'flow_elated_ajax_search' );

}