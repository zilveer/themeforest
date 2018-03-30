<?php

if (!function_exists('mkdf_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function mkdf_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-sidebar-widget-title-outer"><h5 class="mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));
    }

    add_action('widgets_init', 'mkdf_register_sidebars');
}

if (!function_exists('mkd_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates HashmagMikadoSidebar object
     */
    function mkd_add_support_custom_sidebar() {
        add_theme_support('HashmagMikadoSidebar');
        if (get_theme_support('HashmagMikadoSidebar')) new HashmagMikadoSidebar();
    }

    add_action('after_setup_theme', 'mkd_add_support_custom_sidebar');
}
