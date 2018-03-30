<?php

if(!function_exists('flow_elated_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function flow_elated_register_top_header_areas() {
        $top_bar_layout  = flow_elated_options()->getOptionValue('top_bar_layout');
        $top_bar_enabled = flow_elated_options()->getOptionValue('top_bar');

        if($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name'          => esc_html__('Top Bar Left', 'flow'),
                'id'            => 'eltd-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));

            //register this widget area only if top bar layout is three columns
            if($top_bar_layout === 'three-columns') {
                register_sidebar(array(
                    'name'          => esc_html__('Top Bar Center', 'flow'),
                    'id'            => 'eltd-top-bar-center',
                    'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                    'after_widget'  => '</div>'
                ));
            }

            register_sidebar(array(
                'name'          => esc_html__('Top Bar Right', 'flow'),
                'id'            => 'eltd-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-top-bar-widget">',
                'after_widget'  => '</div>'
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_register_top_header_areas');
}

if(!function_exists('flow_elated_header_standard_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function flow_elated_header_standard_widget_areas() {
        if(flow_elated_options()->getOptionValue('header_type') == 'header-standard') {
            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'flow'),
                'id'            => 'eltd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_header_standard_widget_areas');
}

if(!function_exists('flow_elated_header_vertical_widget_areas')) {
    /**
     * Registers widget areas for vertical header
     */
    function flow_elated_header_vertical_widget_areas() {
        if(flow_elated_options()->getOptionValue('header_type') == 'header-vertical') {
            register_sidebar(array(
                'name'          => esc_html__('Vertical Area', 'flow'),
                'id'            => 'eltd-vertical-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-vertical-area-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_header_vertical_widget_areas');
}

if(!function_exists('flow_elated_header_type1_widget_areas')) {
    /**
     * Registers widget areas for header type 1
     */
    function flow_elated_header_type1_widget_areas() {
        if(flow_elated_options()->getOptionValue('header_type') == 'header-type1') {
            register_sidebar(array(
                'name'          => esc_html__('Right From Logo', 'flow'),
                'id'            => 'eltd-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-logo-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the logo', 'flow')
            ));

            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'flow'),
                'id'            => 'eltd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_header_type1_widget_areas');
}

if(!function_exists('flow_elated_header_type2_widget_areas')) {
    /**
     * Registers widget areas for header type 2
     */
    function flow_elated_header_type2_widget_areas() {
        if(flow_elated_options()->getOptionValue('header_type') == 'header-type2') {
            register_sidebar(array(
                'name'          => esc_html__('Left From Main Menu', 'flow'),
                'id'            => 'eltd-left-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-left-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the left hand side from the main menu', 'flow')
            ));

            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'flow'),
                'id'            => 'eltd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_header_type2_widget_areas');
}

if(!function_exists('flow_elated_header_type3_widget_areas')) {
    /**
     * Registers widget areas for header type 3
     */
    function flow_elated_header_type3_widget_areas() {
        if(flow_elated_options()->getOptionValue('header_type') == 'header-type3') {
            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'flow'),
                'id'            => 'eltd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_header_type3_widget_areas');
}

if(!function_exists('flow_elated_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function flow_elated_register_mobile_header_areas() {
        if(flow_elated_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'flow'),
                'id'            => 'eltd-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_register_mobile_header_areas');
}

if(!function_exists('flow_elated_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function flow_elated_register_sticky_header_areas() {
        if(in_array(flow_elated_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'flow'),
                'id'            => 'eltd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s eltd-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'flow')
            ));
        }
    }

    add_action('widgets_init', 'flow_elated_register_sticky_header_areas');
}