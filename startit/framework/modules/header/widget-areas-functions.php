<?php

if(!function_exists('qode_startit_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function qode_startit_register_top_header_areas() {
        $top_bar_layout  = qode_startit_options()->getOptionValue('top_bar_layout');

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'startit'),
                'id'            => 'qodef-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            //register this widget area only if top bar layout is three columns
            if($top_bar_layout === 'three-columns') {
                register_sidebar(array(
                    'name'          => esc_html__('Top Bar Center', 'startit'),
                    'id'            => 'qodef-top-bar-center',
                    'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
                    'after_widget'  => '</div>'
                ));
            }

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'startit'),
                'id'            => 'qodef-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

    }

    add_action('widgets_init', 'qode_startit_register_top_header_areas');
}

if(!function_exists('qode_startit_header_standard_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function qode_startit_header_standard_widget_areas() {
            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'startit'),
                'id'            => 'qodef-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'startit')
            ));

    }

    add_action('widgets_init', 'qode_startit_header_standard_widget_areas');
}

if(!function_exists('qode_startit_header_overlapped_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function qode_startit_header_overlapped_widget_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Overlapping Heder Top Right', 'startit'),
            'id'            => 'qodef-overlapping-header-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s qodef-overlapping-header-top">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear ih top right of Overlapping Header', 'startit')
        ));

    }

    add_action('widgets_init', 'qode_startit_header_overlapped_widget_areas');
}

if(!function_exists('qode_startit_header_vertical_widget_areas')) {
    /**
     * Registers widget areas for vertical header
     */
    function qode_startit_header_vertical_widget_areas() {
            register_sidebar(array(
                'name'          => esc_html__('Vertical Area', 'startit'),
                'id'            => 'qodef-vertical-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-vertical-area-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'startit')
            ));
    }

    add_action('widgets_init', 'qode_startit_header_vertical_widget_areas');
}


if(!function_exists('qode_startit_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function qode_startit_register_mobile_header_areas() {
        if(qode_startit_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'startit'),
                'id'            => 'qodef-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'startit')
            ));
        }
    }

    add_action('widgets_init', 'qode_startit_register_mobile_header_areas');
}

if(!function_exists('qode_startit_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function qode_startit_register_sticky_header_areas() {
        if(in_array(qode_startit_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'startit'),
                'id'            => 'qodef-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s qodef-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'startit')
            ));
        }
    }

    add_action('widgets_init', 'qode_startit_register_sticky_header_areas');
}