<?php

if (!function_exists('hashmag_mikado_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function hashmag_mikado_register_top_header_areas() {
        $top_bar_enabled = hashmag_mikado_options()->getOptionValue('top_bar');

        if ($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name' => esc_html__('Top Bar Left', 'hashmag'),
                'id' => 'mkdf-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="mkdf-top-bar-heading">',
                'after_title' => '</h6>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Top Bar Center', 'hashmag'),
                'id' => 'mkdf-top-bar-center',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="mkdf-top-bar-heading">',
                'after_title' => '</h6>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Top Bar Right', 'hashmag'),
                'id' => 'mkdf-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-top-bar-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="mkdf-top-bar-heading">',
                'after_title' => '</h6>'
            ));
        }
    }

    add_action('widgets_init', 'hashmag_mikado_register_top_header_areas');
}

if (!function_exists('hashmag_mikado_register_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function hashmag_mikado_register_header_areas() {

        if (hashmag_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name' => esc_html__('Right From Main Menu', 'hashmag'),
                'id' => 'mkdf-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-main-menu">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'hashmag')
            ));
        }

        if (hashmag_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name' => esc_html__('Right From Logo', 'hashmag'),
                'id' => 'mkdf-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-logo">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the logo, only if position of logo is "left"', 'hashmag')
            ));
        }
    }

    add_action('widgets_init', 'hashmag_mikado_register_header_areas');
}

if (!function_exists('hashmag_mikado_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function hashmag_mikado_register_sticky_header_areas() {
        if (in_array(hashmag_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name' => esc_html__('Sticky Right', 'hashmag'),
                'id' => 'mkdf-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-sticky-right">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'hashmag')
            ));
        }
    }

    add_action('widgets_init', 'hashmag_mikado_register_sticky_header_areas');
}

if (!function_exists('hashmag_mikado_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function hashmag_mikado_register_mobile_header_areas() {
        if (hashmag_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name' => esc_html__('Right From Mobile Logo', 'hashmag'),
                'id' => 'mkdf-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-right-from-mobile-logo">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'hashmag')
            ));
        }
    }

    add_action('widgets_init', 'hashmag_mikado_register_mobile_header_areas');
}