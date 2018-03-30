<?php

if(!function_exists('qode_startit_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function qode_startit_boxed_class($classes) {

        //is boxed layout turned on?
        if(qode_startit_options()->getOptionValue('boxed') == 'yes') {
            $classes[] = 'qodef-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_boxed_class');
}

if(!function_exists('qode_startit_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function qode_startit_theme_version_class($classes) {
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

    add_filter('body_class', 'qode_startit_theme_version_class');
}

if(!function_exists('qode_startit_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function qode_startit_smooth_scroll_class($classes) {

		$mac_os = strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh; Intel Mac OS X');

        //is smooth scroll enabled enabled and not Mac device?
        if(qode_startit_options()->getOptionValue('smooth_scroll') == 'yes' && $mac_os == false) {
            $classes[] = 'qodef-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_smooth_scroll_class');
}

if(!function_exists('qode_startit_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function qode_startit_smooth_page_transitions_class($classes) {

        if(qode_startit_options()->getOptionValue('smooth_page_transitions') == 'yes') {
            $classes[] = 'qodef-smooth-page-transitions';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_smooth_page_transitions_class');
}

if(!function_exists('qode_startit_elements_animation_on_touch_class')) {
    /**
     * Function that adds classes on body when touch is disabled on touch devices
     *
     * @param $classes array classes array
     *
     * @return array array with added classes
     */
    function qode_startit_elements_animation_on_touch_class($classes) {

        //check if current client is on mobile
        $isMobile = (bool) preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                                      '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                                      '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT']);

        //are animations turned off on touch and client is on mobile?
        if(qode_startit_options()->getOptionValue('elements_animation_on_touch') == "no" && $isMobile == true) {
            $classes[] = 'qodef-no-animations-on-touch';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_elements_animation_on_touch_class');
}

if(!function_exists('qode_startit_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function qode_startit_content_initial_width_body_class($classes) {

        if(qode_startit_options()->getOptionValue('initial_content_width')) {
            $classes[] = 'qodef-'.qode_startit_options()->getOptionValue('initial_content_width');
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_content_initial_width_body_class');
}

if(!function_exists('qode_startit_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function qode_startit_set_blog_body_class($classes) {

        if(qode_startit_load_blog_assets()) {
            $classes[] = 'qodef-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_set_blog_body_class');
}

if(!function_exists('qode_startit_set_portfolio_single_info_follow_body_class')) {
    /**
     * Function that adds follow portfolio info class to body if sticky sidebar is enabled on portfolio single small images or small slider
     *
     * @param $classes array of body classes
     *
     * @return array with follow portfolio info class body class added
     */

    function qode_startit_set_portfolio_single_info_follow_body_class($classes) {

        if(is_singular('portfolio-item')){
            if(qode_startit_options()->getOptionValue('portfolio_single_sticky_sidebar') == 'yes'){
                $classes[] = 'qodef-follow-portfolio-info';
            }
        }


        return $classes;
    }

    add_filter('body_class', 'qode_startit_set_portfolio_single_info_follow_body_class');
}


if(!function_exists('qode_startit_top_bar_responsive_class')) {
    /**
     * Function that adds classes on body for top bar
     */
    function qode_startit_top_bar_responsive_class($classes) {

        if(qode_startit_options()->getOptionValue('show_top_bar_mobile_header') == 'no') {
            $classes[] = 'qodef-top-bar-mobile-hide';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'qode_startit_top_bar_responsive_class');
}
