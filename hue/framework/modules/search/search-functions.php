<?php

if(!function_exists('hue_mikado_search_body_class')) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function hue_mikado_search_body_class($classes) {

        if(is_active_widget(false, false, 'mkd_search_opener')) {

            $classes[] = 'mkd-'.hue_mikado_options()->getOptionValue('search_type');

            if(hue_mikado_options()->getOptionValue('search_type') == 'fullscreen-search') {

                $is_fullscreen_bg_image_set = hue_mikado_options()->getOptionValue('fullscreen_search_background_image') !== '';

                if($is_fullscreen_bg_image_set) {
                    $classes[] = 'mkd-fullscreen-search-with-bg-image';
                }

                $classes[] = 'mkd-search-fade';

            }

        }

        return $classes;

    }

    add_filter('body_class', 'hue_mikado_search_body_class');
}

if(!function_exists('hue_mikado_get_search')) {
    /**
     * Loads search HTML based on search type option.
     */
    function hue_mikado_get_search() {

        if(hue_mikado_active_widget(false, false, 'mkd_search_opener')) {

            $search_type = hue_mikado_options()->getOptionValue('search_type');

            if($search_type == 'search-covers-header') {
                hue_mikado_set_position_for_covering_search();

                return;
            } else if($search_type == 'search-slides-from-window-top') {
                hue_mikado_set_search_position_in_menu($search_type);
                if(hue_mikado_is_responsive_on()) {
                    hue_mikado_set_search_position_mobile();
                }

                return;
            } elseif($search_type === 'search-dropdown') {
                hue_mikado_set_dropdown_search_position();

                return;
            }

            hue_mikado_load_search_template();

        }
    }

}

if(!function_exists('hue_mikado_set_position_for_covering_search')) {
    /**
     * Finds part of header where search template will be loaded
     */
    function hue_mikado_set_position_for_covering_search() {

        $containing_sidebar = hue_mikado_active_widget(false, false, 'mkd_search_opener');

        foreach($containing_sidebar as $sidebar) {

            if(strpos($sidebar, 'top-bar') !== false) {
                add_action('hue_mikado_after_header_top_html_open', 'hue_mikado_load_search_template');
            } else if(strpos($sidebar, 'main-menu') !== false) {
                add_action('hue_mikado_after_header_menu_area_html_open', 'hue_mikado_load_search_template');
            } else if(strpos($sidebar, 'mobile-logo') !== false) {
                add_action('hue_mikado_after_mobile_header_html_open', 'hue_mikado_load_search_template');
            } else if(strpos($sidebar, 'logo') !== false) {
                add_action('hue_mikado_after_header_logo_area_html_open', 'hue_mikado_load_search_template');
            } else if(strpos($sidebar, 'sticky') !== false) {
                add_action('hue_mikado_after_sticky_menu_html_open', 'hue_mikado_load_search_template');
            }

        }

    }

}

if(!function_exists('hue_mikado_set_search_position_in_menu')) {
    /**
     * Finds part of header where search template will be loaded
     */
    function hue_mikado_set_search_position_in_menu($type) {

        add_action('hue_mikado_after_header_menu_area_html_open', 'hue_mikado_load_search_template');

    }
}

if(!function_exists('hue_mikado_set_search_position_mobile')) {
    /**
     * Hooks search template to mobile header
     */
    function hue_mikado_set_search_position_mobile() {

        add_action('hue_mikado_after_mobile_header_html_open', 'hue_mikado_load_search_template');

    }

}

if(!function_exists('hue_mikado_load_search_template')) {
    /**
     * Loads HTML template with parameters
     */
    function hue_mikado_load_search_template() {
        global $hue_IconCollections;

        $search_type = hue_mikado_options()->getOptionValue('search_type');

        $search_icon       = '';
        $search_icon_close = '';
        if(hue_mikado_options()->getOptionValue('search_icon_pack') !== '') {
            $search_icon       = $hue_IconCollections->getSearchIcon(hue_mikado_options()->getOptionValue('search_icon_pack'), true);
            $search_icon_close = $hue_IconCollections->getSearchClose(hue_mikado_options()->getOptionValue('search_icon_pack'), true);
        }

        $parameters = array(
            'search_in_grid'    => hue_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
            'search_icon'       => $search_icon,
            'search_icon_close' => $search_icon_close
        );

        hue_mikado_get_module_template_part('templates/types/'.$search_type, 'search', '', $parameters);

    }

}

if(!function_exists('hue_mikado_set_dropdown_search_position')) {
    function hue_mikado_set_dropdown_search_position() {
        add_action('hue_mikado_after_search_opener', 'hue_mikado_load_search_template');
    }
}