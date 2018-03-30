<?php

if(!function_exists('flow_elated_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function flow_elated_header_top_bar_styles() {
        global $flow_elated_options;

        if(flow_elated_options()->getOptionValue('top_bar_height') !== '') {
            echo flow_elated_dynamic_css('.eltd-top-bar', array('height' => flow_elated_options()->getOptionValue('top_bar_height').'px'));
            echo flow_elated_dynamic_css('.eltd-top-bar .eltd-logo-wrapper a', array('max-height' => flow_elated_options()->getOptionValue('top_bar_height').'px'));
        }

        if($flow_elated_options['top_bar_in_grid'] == 'yes') {
            $top_bar_grid_selector = '.eltd-top-bar .eltd-grid .eltd-vertical-align-containers';
            $top_bar_grid_styles = array();
            if($flow_elated_options['top_bar_grid_background_color'] !== '') {
                $grid_background_color    = $flow_elated_options['top_bar_grid_background_color'];
                $grid_background_transparency = 1;

                if(flow_elated_options()->getOptionValue('top_bar_grid_background_transparency')) {
                    $grid_background_transparency = flow_elated_options()->getOptionValue('top_bar_grid_background_transparency');
                }

                $grid_background_color = flow_elated_rgba_color($grid_background_color, $grid_background_transparency);
                $top_bar_grid_styles['background-color'] = $grid_background_color;
            }

            echo flow_elated_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
        }

        $background_color = flow_elated_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(flow_elated_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = flow_elated_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = flow_elated_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo flow_elated_dynamic_css('.eltd-top-bar', $top_bar_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_header_top_bar_styles');
}

if(!function_exists('flow_elated_header_type2_logo_styles')) {
    /**
     * Generates styles for header type 2 logo
     */
    function flow_elated_header_type2_logo_styles() {
        global $flow_elated_options;

        $logo_area_type_2_styles = array();
        if($flow_elated_options['logo_area_background_color_header_type2'] !== '') {
            $background_transparency = 1;
            if($flow_elated_options['logo_area_background_transparency_header_type2'] !== '') {
                $background_transparency = $flow_elated_options['logo_area_background_transparency_header_type2'];
            }

            $logo_area_background_color                  = $flow_elated_options['logo_area_background_color_header_type2'];
            $logo_area_type_2_styles['background-color'] = flow_elated_rgba_color($logo_area_background_color, $background_transparency);
        }

        if($flow_elated_options['logo_area_height_header_type2'] !== '') {
            $logo_area_type_2_styles['height'] = flow_elated_filter_px($flow_elated_options['logo_area_height_header_type2']).'px';
        }

        $logo_area_selector = '.eltd-header-type2 .eltd-page-header .eltd-logo-area';
        echo flow_elated_dynamic_css($logo_area_selector, $logo_area_type_2_styles);

        $logo_area_type2_link_styles = array();
        if($flow_elated_options['logo_area_height_header_type2'] !== '') {
            $logo_area_type2_link_styles['max-height'] = flow_elated_filter_px($flow_elated_options['logo_area_height_header_type2'], $logo_area_type2_link_styles) * 0.9 .'px';
        }

        $logo_area_link_selector = '.eltd-header-type2 .eltd-page-header .eltd-logo-area .eltd-logo-wrapper a';
        echo flow_elated_dynamic_css($logo_area_link_selector, $logo_area_type2_link_styles);

        $logo_area_grid_styles = array();
        if($flow_elated_options['logo_area_in_grid_header_type2'] == 'yes' && $flow_elated_options['logo_area_grid_background_color_header_type2'] !== '') {
            $background_grid_transparency = 1;
            if($flow_elated_options['logo_area_grid_background_transparency_header_type2'] !== '') {
                $background_grid_transparency =     $flow_elated_options['logo_area_grid_background_transparency_header_type2'];
            }

            $background_grid_color                     = $flow_elated_options['logo_area_grid_background_color_header_type2'];
            $logo_area_grid_styles['background-color'] = flow_elated_rgba_color($background_grid_color, $background_grid_transparency);
        }

        $logo_area_grid_selector = '.eltd-header-type2 .eltd-page-header .eltd-logo-area .eltd-grid .eltd-vertical-align-containers';
        echo flow_elated_dynamic_css($logo_area_grid_selector, $logo_area_grid_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_header_type2_logo_styles');
}

if(!function_exists('flow_elated_header_type2_menu_area_styles')) {
    /**
     * Generates styles for header type 2 menu area
     */
    function flow_elated_header_type2_menu_area_styles() {
        global $flow_elated_options;

        $menu_area_styles = array();

        if($flow_elated_options['menu_area_background_color_header_type2'] !== '') {
            $background_transparency = 1;
            if($flow_elated_options['menu_area_background_transparency_header_type2'] !== '') {
                $background_transparency = $flow_elated_options['menu_area_background_transparency_header_type2'];
            }

            $menu_area_styles['background-color'] = flow_elated_rgba_color($flow_elated_options['menu_area_background_color_header_type2'], $background_transparency);
        }

        if($flow_elated_options['menu_area_height_header_type2'] !== '') {
            $menu_area_styles['height'] = flow_elated_filter_px($flow_elated_options['menu_area_height_header_type2']).'px';
        }

        $menu_area_selector = '.eltd-header-type2 .eltd-page-header .eltd-menu-area';
        echo flow_elated_dynamic_css($menu_area_selector, $menu_area_styles);

        $menu_area_grid_styles = array();

        if($flow_elated_options['menu_area_in_grid_header_type2'] == 'yes' && $flow_elated_options['menu_area_grid_background_color_header_type2'] !== '') {
            $background_grid_transparency = 1;
            if($flow_elated_options['menu_area_grid_background_transparency_header_type2'] !== '') {
                $background_grid_transparency = $flow_elated_options['menu_area_grid_background_transparency_header_type2'];
            }

            $menu_area_grid_styles['background-color'] = flow_elated_rgba_color($flow_elated_options['menu_area_grid_background_color_header_type2'], $background_grid_transparency);
        }

        $menu_area_grid_selector = '.eltd-header-type2 .eltd-page-header .eltd-menu-area .eltd-grid .eltd-vertical-align-containers';
        echo flow_elated_dynamic_css($menu_area_grid_selector, $menu_area_grid_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_header_type2_menu_area_styles');
}

if(!function_exists('flow_elated_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function flow_elated_header_standard_menu_area_styles() {
        global $flow_elated_options;

        $menu_area_header_standard_styles = array();

        if($flow_elated_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $flow_elated_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($flow_elated_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $flow_elated_options['menu_area_background_transparency_header_standard'];
            }

            $menu_area_header_standard_styles['background-color'] = flow_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($flow_elated_options['menu_area_height_header_standard'] !== '') {
            $max_height = intval(flow_elated_filter_px($flow_elated_options['menu_area_height_header_standard']) * 0.9).'px';
            echo flow_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_standard_styles['height'] = flow_elated_filter_px($flow_elated_options['menu_area_height_header_standard']).'px';

        }

        echo flow_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area', $menu_area_header_standard_styles);

        $menu_area_grid_header_standard_styles = array();

        if($flow_elated_options['menu_area_in_grid_header_standard'] == 'yes' && $flow_elated_options['menu_area_grid_background_color_header_standard'] !== '') {
            $menu_area_grid_background_color        = $flow_elated_options['menu_area_grid_background_color_header_standard'];
            $menu_area_grid_background_transparency = 1;

            if($flow_elated_options['menu_area_grid_background_transparency_header_standard'] !== '') {
                $menu_area_grid_background_transparency = $flow_elated_options['menu_area_grid_background_transparency_header_standard'];
            }

            $menu_area_grid_header_standard_styles['background-color'] = flow_elated_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
        }

        echo flow_elated_dynamic_css('.eltd-header-standard .eltd-page-header .eltd-menu-area .eltd-grid .eltd-vertical-align-containers', $menu_area_grid_header_standard_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_header_standard_menu_area_styles');
}

if(!function_exists('flow_elated_vertical_menu_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function flow_elated_vertical_menu_styles() {

        $vertical_header_styles = array();

        $vertical_header_selectors = array(
            '.eltd-header-vertical .eltd-vertical-area-background'
        );

        if(flow_elated_options()->getOptionValue('vertical_header_background_color') !== '') {
            $vertical_header_styles['background-color'] = flow_elated_options()->getOptionValue('vertical_header_background_color');
        }

        if(flow_elated_options()->getOptionValue('vertical_header_transparency') !== '') {
            $vertical_header_styles['opacity'] = flow_elated_options()->getOptionValue('vertical_header_transparency');
        }

        if(flow_elated_options()->getOptionValue('vertical_header_background_image') !== '') {
            $vertical_header_styles['background-image'] = 'url('.flow_elated_options()->getOptionValue('vertical_header_background_image').')';
        }


        echo flow_elated_dynamic_css($vertical_header_selectors, $vertical_header_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_vertical_menu_styles');
}

if(!function_exists('flow_elated_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function flow_elated_sticky_header_styles() {
        global $flow_elated_options;

        if($flow_elated_options['sticky_header_in_grid'] == 'yes' && $flow_elated_options['sticky_header_grid_background_color'] !== '') {
            $sticky_header_grid_background_color        = $flow_elated_options['sticky_header_grid_background_color'];
            $sticky_header_grid_background_transparency = 1;

            if($flow_elated_options['sticky_header_grid_transparency'] !== '') {
                $sticky_header_grid_background_transparency = $flow_elated_options['sticky_header_grid_transparency'];
            }

            echo flow_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-grid .eltd-vertical-align-containers', array('background-color' => flow_elated_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
        }

        if($flow_elated_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $flow_elated_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($flow_elated_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $flow_elated_options['sticky_header_transparency'];
            }

            echo flow_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-sticky-holder', array('background-color' => flow_elated_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($flow_elated_options['sticky_header_height'] !== '') {
            $max_height = intval(flow_elated_filter_px($flow_elated_options['sticky_header_height']) * 0.9).'px';

            echo flow_elated_dynamic_css('.eltd-page-header .eltd-sticky-header', array('height' => $flow_elated_options['sticky_header_height'].'px'));
            echo flow_elated_dynamic_css('.eltd-page-header .eltd-sticky-header .eltd-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($flow_elated_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $flow_elated_options['sticky_color'];
        }
        if($flow_elated_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = flow_elated_get_formatted_font_family($flow_elated_options['sticky_google_fonts']);
        }
        if($flow_elated_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $flow_elated_options['sticky_fontsize'].'px';
        }
        if($flow_elated_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $flow_elated_options['sticky_lineheight'].'px';
        }
        if($flow_elated_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $flow_elated_options['sticky_texttransform'];
        }
        if($flow_elated_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $flow_elated_options['sticky_fontstyle'];
        }
        if($flow_elated_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $flow_elated_options['sticky_fontweight'];
        }
        if($flow_elated_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $flow_elated_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.eltd-main-menu.eltd-sticky-nav > ul > li > a'
        );

        echo flow_elated_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($flow_elated_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $flow_elated_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.eltd-main-menu.eltd-sticky-nav > ul > li:hover > a',
            '.eltd-main-menu.eltd-sticky-nav > ul > li.eltd-active-item:hover > a',
            'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu.eltd-sticky-nav > ul > li:hover > a',
            'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu.eltd-sticky-nav > ul > li.eltd-active-item:hover > a'
        );

        echo flow_elated_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_sticky_header_styles');
}

if(!function_exists('flow_elated_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function flow_elated_fixed_header_styles() {
        global $flow_elated_options;

        if($flow_elated_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $flow_elated_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($flow_elated_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $flow_elated_options['fixed_header_grid_transparency'];
            }

            echo flow_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-grid .eltd-vertical-align-containers',
                array('background-color' => flow_elated_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($flow_elated_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $flow_elated_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($flow_elated_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $flow_elated_options['fixed_header_transparency'];
            }

            echo flow_elated_dynamic_css('.eltd-header-type1 .eltd-fixed-wrapper.fixed .eltd-menu-area,
                                    .eltd-header-type3 .eltd-fixed-wrapper.fixed .eltd-menu-area',
                array('background-color' => flow_elated_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

    }

    add_action('flow_elated_style_dynamic', 'flow_elated_fixed_header_styles');
}