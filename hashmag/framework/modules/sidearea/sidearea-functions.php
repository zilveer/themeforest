<?php
if (!function_exists('hashmag_mikado_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function hashmag_mikado_register_side_area_sidebar() {

        register_sidebar(array(
            'name' => 'Side Area',
            'id' => 'sidearea',
            'description' => 'Side Area',
            'before_widget' => '<div id="%1$s" class="widget mkdf-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="mkdf-sidearea-widget-title">',
            'after_title' => '</h6>'
        ));

    }

    add_action('widgets_init', 'hashmag_mikado_register_side_area_sidebar');

}

if (!function_exists('hashmag_mikado_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function hashmag_mikado_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'mkdf_side_area_opener')) {

            if (hashmag_mikado_options()->getOptionValue('side_area_type')) {

                $classes[] = 'mkdf-' . hashmag_mikado_options()->getOptionValue('side_area_type');

                if (hashmag_mikado_options()->getOptionValue('side_area_type') === 'side-menu-slide-with-content') {

                    $classes[] = 'mkdf-' . hashmag_mikado_options()->getOptionValue('side_area_slide_with_content_width');

                }

                if (hashmag_mikado_options()->getOptionValue('side_area_type') === 'side-menu-slide-over-content') {

                    $classes[] = 'mkdf-' . hashmag_mikado_options()->getOptionValue('side_area_slide_over_content_width');

                }

            }

        }

        return $classes;

    }

    add_filter('body_class', 'hashmag_mikado_side_menu_body_class');
}


if (!function_exists('hashmag_mikado_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function hashmag_mikado_get_side_area() {

        if (is_active_widget(false, false, 'mkdf_side_area_opener')) {

            $parameters = array(
                'show_side_area_title' => hashmag_mikado_options()->getOptionValue('side_area_title') !== '' ? true : false, //Dont show title if empty
            );

            hashmag_mikado_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

        }

    }

}

if (!function_exists('hashmag_mikado_get_side_area_title')) {
    /**
     * Loads side area title HTML
     */
    function hashmag_mikado_get_side_area_title() {

        $parameters = array(
            'side_area_title' => hashmag_mikado_options()->getOptionValue('side_area_title')
        );

        hashmag_mikado_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

    }

}

if (!function_exists('hashmag_mikado_get_side_menu_icon_html')) {
    /**
     * Function that outputs html for side area icon opener.
     * Uses $hashmag_IconCollections global variable
     * @return string generated html
     */
    function hashmag_mikado_get_side_menu_icon_html() {

        $icon_html = '';

        if (hashmag_mikado_options()->getOptionValue('side_area_button_icon_pack') !== '') {
            $icon_pack = hashmag_mikado_options()->getOptionValue('side_area_button_icon_pack');

            $icons = hashmag_mikado_icon_collections()->getIconCollection($icon_pack);
            $icon_options_field = 'side_area_icon_' . $icons->param;

            if (hashmag_mikado_options()->getOptionValue($icon_options_field) !== '') {

                $icon = hashmag_mikado_options()->getOptionValue($icon_options_field);
                $icon_html = hashmag_mikado_icon_collections()->renderIcon($icon, $icon_pack);

            }

        }

        return $icon_html;
    }
}