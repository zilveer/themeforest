<?php

if(!function_exists('flow_elated_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function flow_elated_register_sidebars() {

        register_sidebar(array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'description' => 'Default Sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="eltd-widget-title"><span></span>',
            'after_title' => '</h6>'
        ));

    }

    add_action('widgets_init', 'flow_elated_register_sidebars');
}

if(!function_exists('flow_elated_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates FlowSidebar object
     */
    function flow_elated_add_support_custom_sidebar() {
        add_theme_support('FlowSidebar');
        if (get_theme_support('FlowSidebar')) new FlowSidebar();
    }

    add_action('after_setup_theme', 'flow_elated_add_support_custom_sidebar');
}
