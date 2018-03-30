<?php



if(!function_exists('libero_mikado_header_standard_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function libero_mikado_header_standard_widget_areas() {
        if(libero_mikado_options()->getOptionValue('header_type') == 'header-standard') {

            register_sidebar(array(
                'name'          => esc_html__('Right From Logo', 'libero'),
                'id'            => 'mkd-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from logo', 'libero')
            ));

            register_sidebar(array(
                'name'          => esc_html__('Right From Main Menu', 'libero'),
                'id'            => 'mkd-right-from-main-menu',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-main-menu-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'libero')
            ));
        }
    }

    add_action('widgets_init', 'libero_mikado_header_standard_widget_areas');
}

if(!function_exists('libero_mikado_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function libero_mikado_register_mobile_header_areas() {
        if(libero_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Right From Mobile Logo', 'libero'),
                'id'            => 'mkd-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-mobile-logo">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'libero')
            ));
        }
    }

    add_action('widgets_init', 'libero_mikado_register_mobile_header_areas');
}

if(!function_exists('libero_mikado_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function libero_mikado_register_sticky_header_areas() {
        if(in_array(libero_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Right', 'libero'),
                'id'            => 'mkd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'libero')
            ));
        }
    }

    add_action('widgets_init', 'libero_mikado_register_sticky_header_areas');
}