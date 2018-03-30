<?php

if (!function_exists('hashmag_mikado_register_footer_sidebar')) {

    function hashmag_mikado_register_footer_sidebar() {

        register_sidebar(array(
            'name' => 'Footer Column 1',
            'id' => 'footer_column_1',
            'description' => 'Footer Column 1',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-1 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Column 2',
            'id' => 'footer_column_2',
            'description' => 'Footer Column 2',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-2 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Column 3',
            'id' => 'footer_column_3',
            'description' => 'Footer Column 3',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-3 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Column 4',
            'id' => 'footer_column_4',
            'description' => 'Footer Column 4',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Text',
            'id' => 'footer_text',
            'description' => 'Footer Text',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-text %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Bottom Left',
            'id' => 'footer_bottom_left',
            'description' => 'Footer Bottom Left',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-left %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Bottom Right',
            'id' => 'footer_bottom_right',
            'description' => 'Footer Bottom Right',
            'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-left %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkdf-footer-widget-title-outer"><h5 class="mkdf-footer-widget-title mkdf-title-pattern-text">',
            'after_title' => '</h5><div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div></div>'
        ));

    }

    add_action('widgets_init', 'hashmag_mikado_register_footer_sidebar');

}

if (!function_exists('hashmag_mikado_get_footer')) {
    /**
     * Loads footer HTML
     */
    function hashmag_mikado_get_footer() {

        $parameters = array();
        $id = hashmag_mikado_get_page_id();
        $parameters['display_footer_top'] = (hashmag_mikado_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
        $parameters['display_footer_bottom'] = (hashmag_mikado_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

        hashmag_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
    }
}

if (!function_exists('hashmag_mikado_get_footer_top')) {
    /**
     * Return footer top HTML
     */
    function hashmag_mikado_get_footer_top() {

        $parameters = array();

        $parameters['footer_in_grid'] = (hashmag_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
        $parameters['footer_top_classes'] = (hashmag_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'mkdf-footer-top-full';
        $parameters['footer_top_columns'] = hashmag_mikado_options()->getOptionValue('footer_top_columns');

        hashmag_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
    }
}

if (!function_exists('hashmag_mikado_get_footer_bottom')) {
    /**
     * Return footer bottom HTML
     */
    function hashmag_mikado_get_footer_bottom() {

        $parameters = array();

        $parameters['footer_in_grid'] = (hashmag_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
        $parameters['footer_bottom_classes'] = (hashmag_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'mkdf-footer-top-full';
        $parameters['footer_bottom_columns'] = hashmag_mikado_options()->getOptionValue('footer_bottom_columns');

        hashmag_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
    }
}

//Functions for loading sidebars

if (!function_exists('hashmag_mikado_get_footer_sidebar_25_25_50')) {

    function hashmag_mikado_get_footer_sidebar_25_25_50() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_sidebar_50_25_25')) {

    function hashmag_mikado_get_footer_sidebar_50_25_25() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_sidebar_four_columns')) {

    function hashmag_mikado_get_footer_sidebar_four_columns() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_sidebar_three_columns')) {

    function hashmag_mikado_get_footer_sidebar_three_columns() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_sidebar_two_columns')) {

    function hashmag_mikado_get_footer_sidebar_two_columns() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_sidebar_one_column')) {

    function hashmag_mikado_get_footer_sidebar_one_column() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_bottom_sidebar_three_columns')) {

    function hashmag_mikado_get_footer_bottom_sidebar_three_columns() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_bottom_sidebar_two_columns')) {

    function hashmag_mikado_get_footer_bottom_sidebar_two_columns() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
    }
}

if (!function_exists('hashmag_mikado_get_footer_bottom_sidebar_one_column')) {

    function hashmag_mikado_get_footer_bottom_sidebar_one_column() {
        hashmag_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
    }
}