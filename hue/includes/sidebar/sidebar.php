<?php

if(!function_exists('hue_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function hue_mikado_register_sidebars() {

        register_sidebar(array(
            'name'          => esc_html__('Sidebar', 'hue'),
            'id'            => 'sidebar',
            'description'   => esc_html__('Default Sidebar', 'hue'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5><span class="mkd-sidearea-title">',
            'after_title'   => '</span></h5>'
        ));

    }

    add_action('widgets_init', 'hue_mikado_register_sidebars');
}

if(!function_exists('hue_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates HueMikadoSidebar object
     */
    function hue_mikado_add_support_custom_sidebar() {
        add_theme_support('HueMikadoSidebar');
        if(get_theme_support('HueMikadoSidebar')) {
            new HueMikadoSidebar();
        }
    }

    add_action('after_setup_theme', 'hue_mikado_add_support_custom_sidebar');
}
