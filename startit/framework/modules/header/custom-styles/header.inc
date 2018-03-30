<?php

if(!function_exists('qode_startit_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function qode_startit_header_top_bar_styles() {
        global $qode_startit_options;

        if($qode_startit_options['top_bar_height'] !== '') {
            echo qode_startit_dynamic_css('.qodef-top-bar', array('height' => $qode_startit_options['top_bar_height'].'px'));
            echo qode_startit_dynamic_css('.qodef-top-bar .qodef-logo-wrapper a', array('max-height' => $qode_startit_options['top_bar_height'].'px'));
        }

        if($qode_startit_options['top_bar_in_grid'] == 'yes') {
            $top_bar_grid_selector = '.qodef-top-bar .qodef-grid .qodef-vertical-align-containers';
            $top_bar_grid_styles = array();
            if($qode_startit_options['top_bar_grid_background_color'] !== '') {
                $grid_background_color    = $qode_startit_options['top_bar_grid_background_color'];
                $grid_background_transparency = 1;

                if(qode_startit_options()->getOptionValue('top_bar_grid_background_transparency')) {
                    $grid_background_transparency = qode_startit_options()->getOptionValue('top_bar_grid_background_transparency');
                }

                $grid_background_color = qode_startit_rgba_color($grid_background_color, $grid_background_transparency);
                $top_bar_grid_styles['background-color'] = $grid_background_color;
            }

            echo qode_startit_dynamic_css($top_bar_grid_selector, $top_bar_grid_styles);
        }

        $background_color = qode_startit_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();
        if($background_color !== '') {
            $background_transparency = 1;
            if(qode_startit_options()->getOptionValue('top_bar_background_transparency') !== '') {
               $background_transparency = qode_startit_options()->getOptionValue('top_bar_background_transparency');
            }

            $background_color = qode_startit_rgba_color($background_color, $background_transparency);
            $top_bar_styles['background-color'] = $background_color;
        }

        echo qode_startit_dynamic_css('.qodef-top-bar', $top_bar_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_header_top_bar_styles');
}


if(!function_exists('qode_startit_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function qode_startit_header_standard_menu_area_styles() {
        global $qode_startit_options;

        $menu_area_header_standard_styles = array();

        if($qode_startit_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $qode_startit_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

            if($qode_startit_options['menu_area_background_transparency_header_standard'] !== '') {
                $menu_area_background_transparency = $qode_startit_options['menu_area_background_transparency_header_standard'];
            }

            $menu_area_header_standard_styles['background-color'] = qode_startit_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($qode_startit_options['menu_area_height_header_standard'] !== '') {
            $max_height = intval(qode_startit_filter_px($qode_startit_options['menu_area_height_header_standard']) * 0.9).'px';
            echo qode_startit_dynamic_css('.qodef-header-standard .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_standard_styles['height'] = qode_startit_filter_px($qode_startit_options['menu_area_height_header_standard']).'px';
        }

        echo qode_startit_dynamic_css('.qodef-header-standard .qodef-page-header .qodef-menu-area', $menu_area_header_standard_styles);

        $menu_area_grid_header_standard_styles = array();

        if($qode_startit_options['menu_area_in_grid_header_standard'] == 'yes' && $qode_startit_options['menu_area_grid_background_color_header_standard'] !== '') {
            $menu_area_grid_background_color        = $qode_startit_options['menu_area_grid_background_color_header_standard'];
            $menu_area_grid_background_transparency = 1;

            if($qode_startit_options['menu_area_grid_background_transparency_header_standard'] !== '') {
                $menu_area_grid_background_transparency = $qode_startit_options['menu_area_grid_background_transparency_header_standard'];
            }

            $menu_area_grid_header_standard_styles['background-color'] = qode_startit_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);
        }

        echo qode_startit_dynamic_css('.qodef-header-standard .qodef-page-header .qodef-menu-area .qodef-grid .qodef-vertical-align-containers', $menu_area_grid_header_standard_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_header_standard_menu_area_styles');
}


if(!function_exists('qode_startit_header_overlapping_menu_area_styles')) {
    /**
     * Generates styles for header overlapping menu
     */
    function qode_startit_header_overlapping_menu_area_styles() {
        global $qode_startit_options;

        $menu_area_header_overlapping_styles = array();

        if($qode_startit_options['menu_area_background_color_header_overlapping'] !== '') {
            $menu_area_background_color        = $qode_startit_options['menu_area_background_color_header_overlapping'];
            $menu_area_background_transparency = 1;

            if($qode_startit_options['menu_area_background_transparency_header_overlapping'] !== '') {
                $menu_area_background_transparency = $qode_startit_options['menu_area_background_transparency_header_overlapping'];
            }

            $menu_area_header_overlapping_styles['background-color'] = qode_startit_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($qode_startit_options['menu_area_height_header_overlapping'] !== '') {
            $max_height = intval(qode_startit_filter_px($qode_startit_options['menu_area_height_header_overlapping']) * 0.9).'px';
            echo qode_startit_dynamic_css('.qodef-header-overlapping .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_overlapping_styles['height'] = qode_startit_filter_px($qode_startit_options['menu_area_height_header_overlapping']).'px';
        }


        echo qode_startit_dynamic_css('.qodef-header-overlapping .qodef-page-header .qodef-top-container', $menu_area_header_overlapping_styles);


        $menu_area_header_overlapping_bottom_styles = array();

        if($qode_startit_options['menu_area_background_color_bottom_header_overlapping'] !== '') {
            $menu_area_bottom_background_color        = $qode_startit_options['menu_area_background_color_bottom_header_overlapping'];
            $menu_area_bottom_background_transparency = 1;

            if($qode_startit_options['menu_area_background_transparency_bottom_header_overlapping'] !== '') {
                $menu_area_bottom_background_transparency = $qode_startit_options['menu_area_background_transparency_bottom_header_overlapping'];
            }

            $menu_area_header_overlapping_bottom_styles['background-color'] = qode_startit_rgba_color($menu_area_bottom_background_color, $menu_area_bottom_background_transparency);
        }


        echo qode_startit_dynamic_css('.qodef-header-overlapping .qodef-page-header .qodef-ovelapping-menu', $menu_area_header_overlapping_bottom_styles);


    }

    add_action('qode_startit_style_dynamic', 'qode_startit_header_overlapping_menu_area_styles');
}




if(!function_exists('qode_startit_vertical_menu_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function qode_startit_vertical_menu_styles() {

        $vertical_header_styles = array();

        $vertical_header_selectors = array(
            '.qodef-header-vertical .qodef-vertical-area-background'
        );

        if(qode_startit_options()->getOptionValue('vertical_header_background_color') !== '') {
            $vertical_header_styles['background-color'] = qode_startit_options()->getOptionValue('vertical_header_background_color');
        }

        if(qode_startit_options()->getOptionValue('vertical_header_transparency') !== '') {
            $vertical_header_styles['opacity'] = qode_startit_options()->getOptionValue('vertical_header_transparency');
        }

        if(qode_startit_options()->getOptionValue('vertical_header_background_image') !== '') {
            $vertical_header_styles['background-image'] = 'url('.qode_startit_options()->getOptionValue('vertical_header_background_image').')';
        }


        echo qode_startit_dynamic_css($vertical_header_selectors, $vertical_header_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_vertical_menu_styles');
}


if(!function_exists('qode_startit_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function qode_startit_sticky_header_styles() {
        global $qode_startit_options;

        if($qode_startit_options['sticky_header_in_grid'] == 'yes' && $qode_startit_options['sticky_header_grid_background_color'] !== '') {
            $sticky_header_grid_background_color        = $qode_startit_options['sticky_header_grid_background_color'];
            $sticky_header_grid_background_transparency = 1;

            if($qode_startit_options['sticky_header_grid_transparency'] !== '') {
                $sticky_header_grid_background_transparency = $qode_startit_options['sticky_header_grid_transparency'];
            }

            echo qode_startit_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-grid .qodef-vertical-align-containers', array('background-color' => qode_startit_rgba_color($sticky_header_grid_background_color, $sticky_header_grid_background_transparency)));
        }

        if($qode_startit_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $qode_startit_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($qode_startit_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $qode_startit_options['sticky_header_transparency'];
            }

            echo qode_startit_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-sticky-holder', array('background-color' => qode_startit_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($qode_startit_options['sticky_header_height'] !== '') {
            $max_height = intval(qode_startit_filter_px($qode_startit_options['sticky_header_height']) * 0.9).'px';

            echo qode_startit_dynamic_css('.qodef-page-header .qodef-sticky-header', array('height' => $qode_startit_options['sticky_header_height'].'px'));
            echo qode_startit_dynamic_css('.qodef-page-header .qodef-sticky-header .qodef-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($qode_startit_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $qode_startit_options['sticky_color'];
        }
        if($qode_startit_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = qode_startit_get_formatted_font_family($qode_startit_options['sticky_google_fonts']);
        }
        if($qode_startit_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $qode_startit_options['sticky_fontsize'].'px';
        }
        if($qode_startit_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $qode_startit_options['sticky_lineheight'].'px';
        }
        if($qode_startit_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $qode_startit_options['sticky_texttransform'];
        }
        if($qode_startit_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $qode_startit_options['sticky_fontstyle'];
        }
        if($qode_startit_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $qode_startit_options['sticky_fontweight'];
        }
        if($qode_startit_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $qode_startit_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.qodef-main-menu.qodef-sticky-nav > ul > li > a'
        );

        echo qode_startit_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($qode_startit_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $qode_startit_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.qodef-main-menu.qodef-sticky-nav > ul > li:hover > a',
            '.qodef-main-menu.qodef-sticky-nav > ul > li.qodef-active-item:hover > a',
            'body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-sticky-nav > ul > li:hover > a',
            'body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-sticky-nav > ul > li.qodef-active-item:hover > a'
        );

        echo qode_startit_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_sticky_header_styles');
}

if(!function_exists('qode_startit_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function qode_startit_fixed_header_styles() {
        global $qode_startit_options;

        if($qode_startit_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $qode_startit_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($qode_startit_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $qode_startit_options['fixed_header_grid_transparency'];
            }

            echo qode_startit_dynamic_css('.qodef-page-header .qodef-fixed-wrapper.fixed .qodef-grid .qodef-vertical-align-containers,
                                    .qodef-header-type3 .qodef-fixed-wrapper.fixed .qodef-grid .qodef-vertical-align-containers',
                array('background-color' => qode_startit_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($qode_startit_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $qode_startit_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($qode_startit_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $qode_startit_options['fixed_header_transparency'];
            }

            echo qode_startit_dynamic_css('.qodef-page-header .qodef-fixed-wrapper.fixed .qodef-menu-area,
                                    .qodef-header-type3 .qodef-fixed-wrapper.fixed .qodef-menu-area',
                array('background-color' => qode_startit_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

    }

    add_action('qode_startit_style_dynamic', 'qode_startit_fixed_header_styles');
}


if(!function_exists('qode_startit_header_full_screen_menu_area_styles')) {
    /**
     * Generates styles for header full-screen  menu
     */
    function qode_startit_header_full_screen_menu_area_styles() {

        $menu_area_header_full_screen_styles = array();

        if(qode_startit_options()->getOptionValue('menu_area_background_color_header_full_screen') !== '') {

            $menu_area_background_color        = qode_startit_options()->getOptionValue('menu_area_background_color_header_full_screen');
            $menu_area_background_transparency = 1;

            if(qode_startit_options()->getOptionValue('menu_area_background_transparency_header_full_screen') !== '') {
                $menu_area_background_transparency = qode_startit_options()->getOptionValue('menu_area_background_transparency_header_full_screen');
            }

            $menu_area_header_full_screen_styles['background-color'] = qode_startit_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if(qode_startit_options()->getOptionValue('menu_area_height_header_full_screen') !== '') {
            $max_height = intval(qode_startit_filter_px(qode_startit_options()->getOptionValue('menu_area_height_header_full_screen')) * 0.9).'px';
            echo qode_startit_dynamic_css('.qodef-header-full-screen .qodef-page-header .qodef-logo-wrapper a', array('max-height' => $max_height));

            $menu_area_header_full_screen_styles['height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('menu_area_height_header_full_screen')).'px';

        }

        echo qode_startit_dynamic_css('.qodef-header-full-screen .qodef-page-header .qodef-menu-area', $menu_area_header_full_screen_styles);


    }

    add_action('qode_startit_style_dynamic', 'qode_startit_header_full_screen_menu_area_styles');
}


if(!function_exists('qode_startit_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function qode_startit_main_menu_styles() {
        global $qode_startit_options;

        if($qode_startit_options['menu_color'] !== '' || $qode_startit_options['menu_fontsize'] != '' || $qode_startit_options['menu_fontstyle'] !== '' || $qode_startit_options['menu_fontweight'] !== '' || $qode_startit_options['menu_texttransform'] !== '' || $qode_startit_options['menu_letterspacing'] !== '' || $qode_startit_options['menu_google_fonts'] != "-1") { ?>
            .qodef-main-menu.qodef-default-nav > ul > li > a,
            .qodef-page-header #lang_sel > ul > li > a,
            .qodef-page-header #lang_sel_click > ul > li > a,
            .qodef-page-header #lang_sel ul > li:hover > a{
            <?php if($qode_startit_options['menu_color']) { ?> color: <?php echo esc_attr($qode_startit_options['menu_color']); ?>; <?php } ?>
            <?php if($qode_startit_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($qode_startit_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($qode_startit_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($qode_startit_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($qode_startit_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($qode_startit_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($qode_startit_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($qode_startit_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($qode_startit_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($qode_startit_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($qode_startit_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_google_fonts'] != "-1") { ?>
            .qodef-page-header #lang_sel_list{
            font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['menu_google_fonts'])); ?>', sans-serif !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_hovercolor'] !== '') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
            .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a,
            body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
            body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a,
            .qodef-page-header #lang_sel ul li a:hover,
            .qodef-page-header #lang_sel_click > ul > li a:hover{
            color: <?php echo esc_attr($qode_startit_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_activecolor'] !== '') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a,
            body:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
            color: <?php echo esc_attr($qode_startit_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_item_icon_position'] == "top" && $qode_startit_options['menu_item_icon_size'] !== "") { ?>
            body.qodef-menu-with-large-icons .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner i{
            font-size: <?php echo esc_attr($qode_startit_options['menu_item_icon_size']); ?>px !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_item_style'] == 'small_item' && ($qode_startit_options['menu_text_background_color'] !== '' || $qode_startit_options['enable_manu_item_border'] == 'yes')) { ?>
            .qodef-main-menu > ul > li > a span.item_outer{
            <?php if($qode_startit_options['menu_text_background_color'] !== '') { ?> background-color: <?php echo esc_attr($qode_startit_options['menu_text_background_color']); ?>; <?php } ?>

            <?php if($qode_startit_options['enable_manu_item_border'] == 'yes') { ?>

                <?php if($qode_startit_options['menu_item_border_radius'] !== '') { ?> border-radius: <?php echo esc_attr($qode_startit_options['menu_item_border_radius']); ?>px;<?php } ?>

                <?php if($qode_startit_options['menu_item_border_style_style'] !== '') { ?> border-style: <?php echo esc_attr($qode_startit_options['menu_item_border_style_style']); ?>; <?php } ?>


                <?php if($qode_startit_options['menu_item_border_width'] !== '') { ?> border-width: <?php echo esc_attr($qode_startit_options['menu_item_border_width']); ?>px; <?php } ?>
                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?> border-color: <?php echo esc_attr($qode_startit_options['menu_item_border_color']); ?>; <?php } ?>

                <?php if($qode_startit_options['menu_item_border_style'] !== '') { ?>

                    <?php if($qode_startit_options['menu_item_border_style'] == 'top_bottom_borders') { ?>
                        border-left: none;
                        border-right: none;
                    <?php } ?>

                    <?php if($qode_startit_options['menu_item_border_style'] == 'right_border') { ?>
                        border-left: none;
                        border-top: none;
                        border-bottom: none;
                    <?php } ?>

                    <?php if($qode_startit_options['menu_item_border_style'] == 'bottom_border') { ?>
                        border-left: none;
                        border-top: none;
                        border-right: none;
                    <?php } ?>

                <?php } ?>
            <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_item_border_style'] == 'right_border') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li:last-child > a span.item_inner{
            border-right: none;
            }

            .qodef-main-menu.qodef-default-nav > ul > li:last-child > a{
            border-right: none;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>

            .qodef-main-menu > ul > li > a .item_outer:before{
                display:none
            }

            .qodef-main-menu > ul > li > a{
            <?php if($qode_startit_options['menu_text_background_color'] !== '') { ?> background-color: <?php echo esc_attr($qode_startit_options['menu_text_background_color']); ?>; <?php } ?>

            <?php if($qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
                <?php if($qode_startit_options['menu_item_border_width'] !== '') { ?> border-width: <?php echo esc_attr($qode_startit_options['menu_item_border_width']); ?>px; <?php } ?>
                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?> border-color: <?php echo esc_attr($qode_startit_options['menu_item_border_color']); ?>; <?php } ?>
                <?php if($qode_startit_options['menu_item_border_radius'] !== '') { ?>border-radius: <?php echo esc_attr($qode_startit_options['menu_item_border_radius']); ?>px;<?php } ?>

                <?php if($qode_startit_options['menu_item_border_style_style'] !== '') { ?> border-style: <?php echo esc_attr($qode_startit_options['menu_item_border_style_style']); ?>; <?php } ?>

                <?php if($qode_startit_options['menu_item_border_style'] !== '') { ?>

                    <?php if(($qode_startit_options['menu_item_border_style'] == 'top_bottom_borders')) { ?>
                        border-left: none;
                        border-right: none;
                    <?php } ?>

                    <?php if(($qode_startit_options['menu_item_border_style'] == 'right_border')) { ?>
                        border-left: none;
                        border-top: none;
                        border-bottom: none;
                    <?php } ?>
                    <?php if(($qode_startit_options['menu_item_border_style'] == 'bottom_border')) { ?>
                        border-left: none;
                        border-top: none;
                        border-right: none;
                    <?php } ?>

                <?php } ?>
            <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_hover_background_color'] !== '') {
            $menu_hover_background_color = $qode_startit_options['menu_hover_background_color'];

            if($qode_startit_options['menu_hover_background_color_transparency'] !== '') {
                $menu_hover_background_color_rgb = qode_startit_hex2rgb($menu_hover_background_color);
                $menu_hover_background_color     = 'rgba('.$menu_hover_background_color_rgb[0].', '.$menu_hover_background_color_rgb[1].', '.$menu_hover_background_color_rgb[2].', '.$qode_startit_options['menu_hover_background_color_transparency'].')';
            } ?>

            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                .qodef-main-menu> ul > li:hover > a .item_outer:before,
                .qodef-main-menu> ul > li.qodef-active-item:hover > a .item_outer:before,
                .qodef-main-menu > ul > li > a .item_outer:before{
                background-color: <?php echo esc_attr($menu_hover_background_color); ?>;
                }
            <?php } elseif($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                .qodef-main-menu > ul > li:hover > a,
                .qodef-main-menu > ul > li.qodef-active-item:hover > a {
                background-color: <?php echo esc_attr($menu_hover_background_color); ?>;
                }
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_active_background_color'] !== '') {
            $menu_active_background_color = $qode_startit_options['menu_active_background_color'];

            if($qode_startit_options['menu_active_background_color_transparency'] !== '') {
                $menu_active_background_color_rgb = qode_startit_hex2rgb($menu_active_background_color);
                $menu_active_background_color     = 'rgba('.$menu_active_background_color_rgb[0].', '.$menu_active_background_color_rgb[1].', '.$menu_active_background_color_rgb[2].', '.$qode_startit_options['menu_active_background_color_transparency'].')';
            }
            ?>
            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                .qodef-main-menu > ul > li.qodef-active-item > a span.item_outer:before {
                background-color: <?php echo esc_attr($menu_active_background_color); ?>;
                }
            <?php } elseif($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                .qodef-main-menu > ul > li.qodef-active-item > a {
                background-color: <?php echo esc_attr($menu_active_background_color); ?>;
                }
            <?php } ?>
        <?php } ?>


        <?php if($qode_startit_options['menu_light_hovercolor'] !== '') { ?>
            .light .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
            .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a{
            color: <?php echo esc_attr($qode_startit_options['menu_light_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_light_activecolor'] !== '') { ?>
            .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
            color: <?php echo esc_attr($qode_startit_options['menu_light_activecolor']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_dark_hovercolor'] !== '') { ?>
            .dark .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
            .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a{
            color: <?php echo esc_attr($qode_startit_options['menu_dark_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_dark_activecolor'] !== '') { ?>
            .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
            color: <?php echo esc_attr($qode_startit_options['menu_dark_activecolor']); ?>;
            }
        <?php } ?>

        <?php if($qode_startit_options['enable_manu_item_border'] == 'yes') { ?>

            <?php if($qode_startit_options['menu_light_border_color'] !== '') { ?>
                <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                    .light .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                    .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                    border-color: <?php echo esc_attr($qode_startit_options['menu_light_border_color']); ?> !important;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                    .light .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
                    .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
                    border-color: <?php echo esc_attr($qode_startit_options['menu_light_border_color']); ?> !important;
                    }
                <?php } ?>
            <?php } ?>
            <?php if($qode_startit_options['menu_dark_border_color'] !== '') { ?>
                <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                    .dark .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                    .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                    border-color: <?php echo esc_attr($qode_startit_options['menu_dark_border_color']); ?>!important;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                    .dark .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
                    .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
                    border-color: <?php echo esc_attr($qode_startit_options['menu_dark_border_color']); ?>!important;
                    }
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_lineheight'] != "" || $qode_startit_options['menu_padding_left_right'] !== '') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner{
            <?php if($qode_startit_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($qode_startit_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($qode_startit_options['menu_padding_left_right']) { ?> padding: 0  <?php echo esc_attr($qode_startit_options['menu_padding_left_right']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_margin_left_right'] !== '') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li{
            margin: 0  <?php echo esc_attr($qode_startit_options['menu_margin_left_right']); ?>px;
            }
        <?php } ?>

        <?php if($qode_startit_options['menu_item_style'] == 'small_item' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?>
                .light .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner{
                border-color: #fff;
                }
                .dark .qodef-main-menu.qodef-default-nav > ul > li a span.item_inner{
                border-color: #000;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_hover_border_color'] !== '') { ?>
                .light .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner{
                border-color: #fff;
                }
                .dark .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner{
                border-color: #000;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_active_border_color']) { ?>
                .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                border-color: #fff;
                }
                .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                border-color: #000;
                }
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_item_style'] == 'large_item' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['header_style'] == 'light') { ?>

                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?>
                    .light .qodef-main-menu.qodef-default-nav > ul > li > a{
                    border-color: #fff;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_hover_border_color'] !== '') { ?>
                    .light .qodef-main-menu.qodef-default-nav > ul > li:hover > a{
                    border-color: #fff;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_active_border_color'] !== '') { ?>
                    .light .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
                    border-color: #fff;
                    }
                <?php } ?>
            <?php } ?>
            <?php if($qode_startit_options['header_style'] == 'dark') { ?>

                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?>
                    .dark .qodef-main-menu.qodef-default-nav > ul > li > a{
                    border-color: #000;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_hover_border_color'] !== '') { ?>
                    .dark .qodef-main-menu.qodef-default-nav > ul > li:hover > a{
                    border-color: #000;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_active_border_color'] !== '') { ?>
                    .dark .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
                    border-color: #000;
                    }
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_item_border_style'] == 'bottom_border_double' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner:before,
                    .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_border_color']); ?>;
                    display:block;
                    }
                    .qodef-main-menu.qodef-default-nav > ul > li > a span.item_inner{
                    border:none;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_active_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner:before,
                    .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_active_border_color']); ?>;
                    }
                    .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                    border:none;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_hover_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner:before,
                    .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_hover_border_color']); ?>;
                    }
                    .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner{
                    border:none;
                    }
                <?php } ?>
            <?php } ?>
            <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                <?php if($qode_startit_options['menu_item_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li > a:before,
                    .qodef-main-menu.qodef-default-nav > ul > li > a:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_border_color']); ?>;
                    display:block;
                    }
                    .qodef-main-menu.qodef-default-nav > ul > li > a{
                    border:none;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_active_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a:before,
                    .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_active_border_color']); ?>;
                    }
                    nav.main_menu > ul > li.qodef-active-item > a{
                    border:none;
                    }
                <?php } ?>
                <?php if($qode_startit_options['menu_item_hover_border_color'] !== '') { ?>
                    .qodef-main-menu.qodef-default-nav > ul > li:hover > a:before,
                    .qodef-main-menu.qodef-default-nav > ul > li:hover > a:after{
                    background-color: <?php echo esc_attr($qode_startit_options['menu_item_hover_border_color']); ?>;
                    }
                    .qodef-main-menu.qodef-default-nav > ul > li > a{
                    border:none;
                    }
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_item_border_style'] == 'right_border' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:last-child > a span.item_inner{
                border-right:none;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:last-child > a {
                border-right:none;
                }
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_item_hover_border_color'] !== '' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a span.item_inner,
                header:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li:hover a span.item_inner{
                border-color: <?php echo esc_attr($qode_startit_options['menu_item_hover_border_color']); ?>;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a,
                header:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li:hover > a{
                border-color: <?php echo esc_attr($qode_startit_options['menu_item_hover_border_color']); ?>;
                }
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['menu_item_active_border_color'] !== '' && $qode_startit_options['enable_manu_item_border'] == 'yes') { ?>
            <?php if($qode_startit_options['menu_item_style'] == 'small_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner,
                header:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                border-color: <?php echo esc_attr($qode_startit_options['menu_item_active_border_color']); ?>;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_style'] == 'large_item') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item a,
                header:not(.qodef-menu-item-first-level-bg-color) .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a{
                border-color: <?php echo esc_attr($qode_startit_options['menu_item_active_border_color']); ?>;
                }
            <?php } ?>
        <?php } ?>

        <?php if($qode_startit_options['enable_menu_item_separators'] == "yes" && $qode_startit_options['menu_item_separators_color'] !== '') { ?>
            .qodef-main-menu.qodef-default-nav > ul > li > a span.plus{
            display: block;
            background-color: <?php echo esc_attr($qode_startit_options['menu_item_separators_color']); ?>;
            }
        <?php } ?>


        <?php if($qode_startit_options['enable_menu_item_text_decoration'] == 'yes') { ?>

            <?php if($qode_startit_options['menu_item_text_decoration_style'] == 'none') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a span.item_inner{
                text-decoration: none;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_text_decoration_style'] == 'underline') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a span.item_inner{
                text-decoration: underline;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_text_decoration_style'] == 'line-through') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a span.item_inner{
                text-decoration: line-through;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_text_decoration_style'] == 'overline') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li:hover > a span.item_inner,
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item:hover > a span.item_inner{
                text-decoration: overline;
                }
            <?php } ?>


            <?php if($qode_startit_options['menu_item_active_text_decoration_style'] == 'none') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                text-decoration: none;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_active_text_decoration_style'] == 'underline') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                text-decoration: underline;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_active_text_decoration_style'] == 'line-through') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                text-decoration: line-through;
                }
            <?php } ?>
            <?php if($qode_startit_options['menu_item_active_text_decoration_style'] == 'overline') { ?>
                .qodef-main-menu.qodef-default-nav > ul > li.qodef-active-item > a span.item_inner{
                text-decoration: overline;
                }
            <?php } ?>

        <?php } ?>

        <?php
        if($qode_startit_options['dropdown_background_color'] != "" || $qode_startit_options['dropdown_background_transparency'] != "") {

            //dropdown background and transparency styles
            $dropdown_bg_color_initial        = '#ffffff';
            $dropdown_bg_transparency_initial = 1;

            $dropdown_bg_color        = $qode_startit_options['dropdown_background_color'] !== "" ? $qode_startit_options['dropdown_background_color'] : $dropdown_bg_color_initial;
            $dropdown_bg_transparency = $qode_startit_options['dropdown_background_transparency'] !== "" ? $qode_startit_options['dropdown_background_transparency'] : $dropdown_bg_transparency_initial;

            $dropdown_bg_color_rgb = qode_startit_hex2rgb($dropdown_bg_color);

            ?>

            .qodef-drop-down .second .inner ul,
            .qodef-drop-down .second .inner ul li ul,
            .shopping_cart_dropdown,
            li.narrow .second .inner ul,
            .qodef-main-menu.qodef-default-nav #lang_sel ul ul,
            .qodef-main-menu.qodef-default-nav #lang_sel_click  ul ul,
            .header-widget.widget_nav_menu ul ul,
            .qodef-drop-down .wide.wide_background .second{
            background-color: <?php echo esc_attr($dropdown_bg_color); ?>;
            background-color: rgba(<?php echo esc_attr($dropdown_bg_color_rgb[0]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[1]); ?>,<?php echo esc_attr($dropdown_bg_color_rgb[2]); ?>,<?php echo esc_attr($dropdown_bg_transparency); ?>);
            }

        <?php } //end dropdown background and transparency styles ?>

        <?php if($qode_startit_options['dropdown_top_separator_color'] !== '') { ?>
            .qodef-drop-down .second{
            border-top-color: <?php echo esc_attr($qode_startit_options['dropdown_top_separator_color']); ?>;
            }
        <?php } ?>

        <?php
        if($qode_startit_options['dropdown_top_padding'] !== '' || $qode_startit_options['dropdown_border_around'] == "no") {

            $menu_inner_ul_top = 15; //default value without border
            if($qode_startit_options['dropdown_top_padding'] !== '') {
                ?>
                li.narrow .second .inner ul,
                .qodef-drop-down .wide .second .inner > ul{
                padding-top: <?php echo esc_attr($qode_startit_options['dropdown_top_padding']); ?>px;
                }
                <?php
                $menu_inner_ul_top = $qode_startit_options['dropdown_top_padding']; //overwrite default value
            } ?>
            <?php if($qode_startit_options['dropdown_border_around'] == "yes") {
                $menu_inner_ul_top += 1; //top border is 1px
            }
            ?>
            .qodef-drop-down .narrow .second .inner ul li ul,
            body.qodef-slide-from-bottom .qodef-drop-down .narrow .second .inner ul li:hover ul,
            body.qodef-slide-from-top .narrow .second .inner ul li:hover ul{
            top:-<?php echo esc_attr($menu_inner_ul_top); ?>px;
            }

        <?php } ?>

        <?php if($qode_startit_options['dropdown_bottom_padding'] !== '') { ?>
            li.narrow .second .inner ul,
            .qodef-drop-down .wide .second .inner > ul{
            padding-bottom: <?php echo esc_attr($qode_startit_options['dropdown_bottom_padding']); ?>px;
            }
        <?php } ?>

        <?php if($qode_startit_options['enable_dropdown_top_separator'] == "no") { ?>
            .qodef-drop-down .second{
            border-top: 0 !important;
            }
        <?php } ?>

        <?php
        $dropdown_separator_full_width = 'no';
        if($qode_startit_options['enable_dropdown_separator_full_width'] == "yes") {
            $dropdown_separator_full_width = $qode_startit_options['enable_dropdown_separator_full_width']; ?>
            .qodef-drop-down .second .inner > ul > li:last-child > a,
            .qodef-drop-down .second .inner > ul > li > ul > li:last-child > a,
            .qodef-drop-down .second .inner > ul > li > ul > li > ul > li:last-child > a{
            border-bottom:1px solid transparent;
            }

        <?php }
        if($dropdown_separator_full_width !== 'yes') {
            if($qode_startit_options['dropdown_separator_color'] != '') {
            ?>
            .qodef-drop-down .second .inner ul li a,
            .header-widget.widget_nav_menu ul.menu li ul li a {
            border-color: <?php echo esc_attr($qode_startit_options['dropdown_separator_color']); ?>;
            }
        <?php }} ?>
        <?php
        if($dropdown_separator_full_width == 'yes') {
            ?>
            .qodef-drop-down .second .inner ul li,
            .header-widget.widget_nav_menu ul.menu li ul li{
            border-bottom: 1px solid <?php echo esc_attr($qode_startit_options['dropdown_separator_color']); ?>;
            }
        <?php } ?>

        <?php if(!empty($qode_startit_options['dropdown_vertical_separator_color'])) { ?>
            .qodef-drop-down .wide .second ul li{
            border-left-color: <?php echo esc_attr($qode_startit_options['dropdown_vertical_separator_color']); ?>;
            }
        <?php } ?>


        <?php if($qode_startit_options['dropdown_top_position'] !== '') { ?>
            header .qodef-drop-down .second {
            top: <?php echo esc_attr($qode_startit_options['dropdown_top_position']).'%;'; ?>
            }
        <?php } ?>


        <?php if($qode_startit_options['dropdown_border_around'] == "yes" && $qode_startit_options['dropdown_border_around_color'] !== '') { ?>
            .qodef-drop-down .second .inner > ul,
            li.narrow .second .inner ul,
            .qodef-drop-down .narrow .second .inner ul li ul,
            .shopping_cart_dropdown,
            .shopping_cart_dropdown ul li{
            border-color:  <?php echo esc_attr($qode_startit_options['dropdown_border_around_color']); ?>;
            }

        <?php } ?>

        <?php if($qode_startit_options['dropdown_border_around'] == "no") { ?>
            .qodef-drop-down .second .inner>ul,
            li.narrow .second .inner ul,
            .qodef-drop-down .narrow .second .inner ul li ul{
            border: none;
            }

            .qodef-drop-down .second .inner ul.right li ul{
            margin-left: 0;
            }

        <?php } ?>

        <?php if($qode_startit_options['dropdown_color'] !== '' || $qode_startit_options['dropdown_fontsize'] !== '' || $qode_startit_options['dropdown_lineheight'] !== '' || $qode_startit_options['dropdown_fontstyle'] !== '' || $qode_startit_options['dropdown_fontweight'] !== '' || $qode_startit_options['dropdown_google_fonts'] != "-1" || $qode_startit_options['dropdown_texttransform'] !== '' || $qode_startit_options['dropdown_letterspacing'] !== '') { ?>
            .qodef-drop-down .second .inner > ul > li > a,
            .qodef-drop-down .second .inner > ul > li > h4,
            .qodef-drop-down .wide .second .inner > ul > li > h4,
            .qodef-drop-down .wide .second .inner > ul > li > a,
            .qodef-drop-down .wide .second ul li ul li.menu-item-has-children > a,
            .qodef-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children > a,
            .qodef-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4 a,
            .qodef-drop-down .wide .second .inner > ul li .flexslider ul li  h4 a,
            .qodef-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4,
            .qodef-drop-down .wide .second .inner > ul li .flexslider ul li  h4,
            .qodef-main-menu.qodef-default-nav #lang_sel ul li li a,
            .qodef-main-menu.qodef-default-nav #lang_sel_click ul li ul li a,
            .qodef-main-menu.qodef-default-nav #lang_sel ul ul a,
            .qodef-main-menu.qodef-default-nav #lang_sel_click ul ul a{
            <?php if(!empty($qode_startit_options['dropdown_color'])) { ?> color: <?php echo esc_attr($qode_startit_options['dropdown_color']); ?>; <?php } ?>
            <?php if($qode_startit_options['dropdown_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['dropdown_google_fonts'])); ?>', sans-serif !important;
            <?php } ?>
            <?php if($qode_startit_options['dropdown_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($qode_startit_options['dropdown_fontsize']); ?>px; <?php } ?>
            <?php if($qode_startit_options['dropdown_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($qode_startit_options['dropdown_lineheight']); ?>px; <?php } ?>
            <?php if($qode_startit_options['dropdown_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($qode_startit_options['dropdown_fontstyle']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($qode_startit_options['dropdown_fontweight']); ?>; <?php } ?>
            <?php if($qode_startit_options['dropdown_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($qode_startit_options['dropdown_texttransform']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($qode_startit_options['dropdown_letterspacing']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_color'] !== '') { ?>
            .shopping_cart_dropdown ul li
            .item_info_holder .item_left a,
            .shopping_cart_dropdown ul li .item_info_holder .item_right .amount,
            .shopping_cart_dropdown .cart_bottom .subtotal_holder .total,
            .shopping_cart_dropdown .cart_bottom .subtotal_holder .total_amount{
            color: <?php echo esc_attr($qode_startit_options['dropdown_color']); ?>;
            }
        <?php } ?>

        <?php if(!empty($qode_startit_options['dropdown_hovercolor'])) { ?>
            .qodef-drop-down .second .inner > ul > li:hover > a,
            .qodef-drop-down .wide .second ul li ul li.menu-item-has-children:hover > a,
            .qodef-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children:hover > a,
            .qodef-main-menu.qodef-default-nav #lang_sel ul li li:hover a,
            .qodef-main-menu.qodef-default-nav #lang_sel_click ul li ul li:hover a,
            .qodef-main-menu.qodef-default-nav #lang_sel ul li:hover > a,
            .qodef-main-menu.qodef-default-nav #lang_sel_click ul li:hover > a{
            color: <?php echo esc_attr($qode_startit_options['dropdown_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if(!empty($qode_startit_options['dropdown_background_hovercolor'])) { ?>
            .qodef-drop-down li:not(.wide) .second .inner > ul > li:hover{
            background-color: <?php echo esc_attr($qode_startit_options['dropdown_background_hovercolor']); ?>;
            }
        <?php } ?>

        <?php if(!empty($qode_startit_options['dropdown_padding_top_bottom'])) { ?>
            .qodef-drop-down .wide .second>.inner>ul>li.sub>ul>li>a,
            .qodef-drop-down .second .inner ul li a,
            .qodef-drop-down .wide .second ul li a,
            .qodef-drop-down .second .inner ul.right li a{
            padding-top: <?php echo esc_attr($qode_startit_options['dropdown_padding_top_bottom']); ?>px;
            padding-bottom: <?php echo esc_attr($qode_startit_options['dropdown_padding_top_bottom']); ?>px;
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_wide_color'] !== '' || $qode_startit_options['dropdown_wide_fontsize'] !== '' || $qode_startit_options['dropdown_wide_lineheight'] !== '' || $qode_startit_options['dropdown_wide_fontstyle'] !== '' || $qode_startit_options['dropdown_wide_fontweight'] !== '' || $qode_startit_options['dropdown_wide_google_fonts'] !== "-1" || $qode_startit_options['dropdown_wide_texttransform'] !== '' || $qode_startit_options['dropdown_wide_letterspacing'] !== '') { ?>
            .qodef-drop-down .wide .second .inner > ul > li > a{
            <?php if($qode_startit_options['dropdown_wide_color'] !== '') { ?> color: <?php echo esc_attr($qode_startit_options['dropdown_wide_color']); ?>; <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['dropdown_wide_google_fonts'])); ?>', sans-serif !important;
            <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontsize']); ?>px; <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($qode_startit_options['dropdown_wide_lineheight']); ?>px; <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontstyle']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontweight'] !== '') { ?>font-weight: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontweight']); ?>; <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($qode_startit_options['dropdown_wide_texttransform']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($qode_startit_options['dropdown_wide_letterspacing']); ?>px;  <?php } ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_wide_hovercolor'] !== '') { ?>
            .qodef-drop-down .wide .second .inner > ul > li:hover > a {
            color: <?php echo esc_attr($qode_startit_options['dropdown_wide_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if(!empty($qode_startit_options['dropdown_wide_background_hovercolor'])) { ?>
            .qodef-drop-down .wide .second .inner > ul > li:hover > a{
            background-color: <?php echo esc_attr($qode_startit_options['dropdown_wide_background_hovercolor']); ?>
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_wide_padding_top_bottom'] !== '') { ?>
            .qodef-drop-down .wide .second>.inner > ul > li.sub > ul > li > a,
            .qodef-drop-down .wide .second .inner ul li a,
            .qodef-drop-down .wide .second ul li a,
            .qodef-drop-down .wide .second .inner ul.right li a{
            padding-top: <?php echo esc_attr($qode_startit_options['dropdown_wide_padding_top_bottom']); ?>px;
            padding-bottom: <?php echo esc_attr($qode_startit_options['dropdown_wide_padding_top_bottom']); ?>px;
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_color_thirdlvl'] !== '' || $qode_startit_options['dropdown_fontsize_thirdlvl'] !== '' || $qode_startit_options['dropdown_lineheight_thirdlvl'] !== '' || $qode_startit_options['dropdown_fontstyle_thirdlvl'] !== '' || $qode_startit_options['dropdown_fontweight_thirdlvl'] !== '' || $qode_startit_options['dropdown_google_fonts_thirdlvl'] != "-1" || $qode_startit_options['dropdown_texttransform_thirdlvl'] !== '' || $qode_startit_options['dropdown_letterspacing_thirdlvl'] !== '') { ?>
            .qodef-drop-down .second .inner ul li.sub ul li a{
            <?php if($qode_startit_options['dropdown_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($qode_startit_options['dropdown_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['dropdown_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($qode_startit_options['dropdown_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($qode_startit_options['dropdown_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($qode_startit_options['dropdown_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($qode_startit_options['dropdown_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($qode_startit_options['dropdown_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($qode_startit_options['dropdown_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($qode_startit_options['dropdown_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($qode_startit_options['dropdown_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($qode_startit_options['dropdown_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($qode_startit_options['dropdown_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>
        <?php if($qode_startit_options['dropdown_hovercolor_thirdlvl'] !== '') { ?>
            .qodef-drop-down .second .inner ul li.sub ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next),
            .qodef-drop-down .second .inner ul li ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next){
            color: <?php echo esc_attr($qode_startit_options['dropdown_hovercolor_thirdlvl']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_background_hovercolor_thirdlvl'] !== '') { ?>
            .qodef-drop-down .second .inner ul li.sub ul li:hover,
            .qodef-drop-down .second .inner ul li ul li:hover{
            background-color: <?php echo esc_attr($qode_startit_options['dropdown_background_hovercolor_thirdlvl']); ?>;
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_wide_color_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_fontsize_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_lineheight_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_fontstyle_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_fontweight_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_google_fonts_thirdlvl'] != "-1" || $qode_startit_options['dropdown_wide_texttransform_thirdlvl'] !== '' || $qode_startit_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?>
            .qodef-drop-down .wide .second .inner ul li.sub ul li a,
            .qodef-drop-down .wide .second ul li ul li a{
            <?php if($qode_startit_options['dropdown_wide_color_thirdlvl'] !== '') { ?> color: <?php echo esc_attr($qode_startit_options['dropdown_wide_color_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_google_fonts_thirdlvl'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $qode_startit_options['dropdown_wide_google_fonts_thirdlvl'])); ?>', sans-serif;
            <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontsize_thirdlvl'] !== '') { ?> font-size: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontsize_thirdlvl']); ?>px;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_lineheight_thirdlvl'] !== '') { ?> line-height: <?php echo esc_attr($qode_startit_options['dropdown_wide_lineheight_thirdlvl']); ?>px;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontstyle_thirdlvl'] !== '') { ?> font-style: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontstyle_thirdlvl']); ?>;   <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_fontweight_thirdlvl'] !== '') { ?> font-weight: <?php echo esc_attr($qode_startit_options['dropdown_wide_fontweight_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_texttransform_thirdlvl'] !== '') { ?> text-transform: <?php echo esc_attr($qode_startit_options['dropdown_wide_texttransform_thirdlvl']); ?>;  <?php } ?>
            <?php if($qode_startit_options['dropdown_wide_letterspacing_thirdlvl'] !== '') { ?> letter-spacing: <?php echo esc_attr($qode_startit_options['dropdown_wide_letterspacing_thirdlvl']); ?>px;  <?php } ?>
            }
        <?php } ?>
        <?php if($qode_startit_options['dropdown_wide_hovercolor_thirdlvl'] !== '') { ?>
            .qodef-drop-down .wide .second .inner ul li.sub ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover,
            .qodef-drop-down .wide .second .inner ul li ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover{
            color: <?php echo esc_attr($qode_startit_options['dropdown_wide_hovercolor_thirdlvl']); ?> !important;
            }
        <?php } ?>

        <?php if($qode_startit_options['dropdown_wide_background_hovercolor_thirdlvl'] !== '') { ?>
            .qodef-drop-down .wide .second .inner ul li.sub ul li:hover,
            .qodef-drop-down .wide .second .inner ul li ul li:hover{
            background-color: <?php echo esc_attr($qode_startit_options['dropdown_wide_background_hovercolor_thirdlvl']); ?>;
            }
        <?php }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_main_menu_styles');
}

if(!function_exists('qode_startit_vertical_main_menu_styles')) {
    /**
     * Generates styles for vertical main main menu
     */
    function qode_startit_vertical_main_menu_styles() {
        $dropdown_styles = array();

        if(qode_startit_options()->getOptionValue('vertical_dropdown_background_color') !== '') {
            $dropdown_styles['background-color'] = qode_startit_options()->getOptionValue('vertical_dropdown_background_color');
        }

        $dropdown_selector = array(
            '.qodef-header-vertical .qodef-vertical-dropdown-float .menu-item .second',
            '.qodef-header-vertical .qodef-vertical-dropdown-float .menu-item.narrow .second .inner ul',
            '.qodef-header-vertical .qodef-vertical-dropdown-float .second .inner ul ul'
        );

        echo qode_startit_dynamic_css($dropdown_selector, $dropdown_styles);

        $dropdown_selector_2 = array(
            '.qodef-header-vertical .qodef-vertical-dropdown-float .menu-item.narrow .second .inner ul',
            '.qodef-header-vertical .qodef-vertical-dropdown-float .second .inner ul ul',
            '.qodef-header-vertical .qodef-vertical-dropdown-float .second .inner ul'
        );

        $dropdown_styles_2 = array();

        if(qode_startit_options()->getOptionValue('vertical_dropdown_padding_tb') !== '') {
            $dropdown_styles_2['padding-top'] = qode_startit_options()->getOptionValue('vertical_dropdown_padding_tb') . 'px';
            $dropdown_styles_2['padding-bottom'] = qode_startit_options()->getOptionValue('vertical_dropdown_padding_tb') . 'px';
        }

        if(qode_startit_options()->getOptionValue('vertical_dropdown_padding_lr') !== '') {
            $dropdown_styles_2['padding-left'] = qode_startit_options()->getOptionValue('vertical_dropdown_padding_lr') . 'px';
            $dropdown_styles_2['padding-right'] = qode_startit_options()->getOptionValue('vertical_dropdown_padding_lr') . 'px';
        }

        echo qode_startit_dynamic_css($dropdown_selector_2, $dropdown_styles_2);

        $dropdown_navigation_styles = array();
        if(qode_startit_options()->getOptionValue('vertical_dropdown_disable_expanding_icons') === 'yes') {
            $dropdown_navigation_styles['display'] = 'none';
        }

        $dropdown_navigation_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu ul > li.menu-item-has-children a .plus'
        );

        echo qode_startit_dynamic_css($dropdown_navigation_selector, $dropdown_navigation_styles);

        $fist_level_styles = array();
        $fist_level_hover_styles = array();

        if(qode_startit_options()->getOptionValue('vertical_menu_1st_color') !== '') {
            $fist_level_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_1st_color');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_google_fonts') !== '-1') {
            $fist_level_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('vertical_menu_1st_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_fontsize') !== '') {
            $fist_level_styles['font-size'] = qode_startit_options()->getOptionValue('vertical_menu_1st_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_lineheight') !== '') {
            $fist_level_styles['line-height'] = qode_startit_options()->getOptionValue('vertical_menu_1st_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_texttransform') !== '') {
            $fist_level_styles['text-transform'] = qode_startit_options()->getOptionValue('vertical_menu_1st_texttransform');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_fontstyle') !== '') {
            $fist_level_styles['font-style'] = qode_startit_options()->getOptionValue('vertical_menu_1st_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_fontweight') !== '') {
            $fist_level_styles['font-weight'] = qode_startit_options()->getOptionValue('vertical_menu_1st_fontweight');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_1st_letter_spacing') !== '') {
            $fist_level_styles['letter-spacing'] = qode_startit_options()->getOptionValue('vertical_menu_1st_letter_spacing').'px';
        }

        if(qode_startit_options()->getOptionValue('vertical_menu_1st_hover_color') !== '') {
            $fist_level_hover_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_1st_hover_color');
        }

        $first_level_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu > ul > li > a'
        );
        $first_level_hover_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu > ul > li > a:hover',
            '.qodef-header-vertical .qodef-vertical-menu > ul > li > a.qodef-active-item'
        );

        echo qode_startit_dynamic_css($first_level_selector, $fist_level_styles);
        echo qode_startit_dynamic_css($first_level_hover_selector, $fist_level_hover_styles);

        $second_level_styles = array();
        $second_level_hover_styles = array();

        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_color') !== '') {
            $second_level_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_color');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_google_fonts') !== '-1') {
            $second_level_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('vertical_menu_2nd_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_fontsize') !== '') {
            $second_level_styles['font-size'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_lineheight') !== '') {
            $second_level_styles['line-height'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_texttransform') !== '') {
            $second_level_styles['text-transform'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_texttransform');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_fontstyle') !== '') {
            $second_level_styles['font-style'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_fontweight') !== '') {
            $second_level_styles['font-weight'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_fontweight');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_letter_spacing') !== '') {
            $second_level_styles['letter-spacing'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_letter_spacing').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_tb') !== '') {
            $second_level_styles['padding-top'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_tb').'px';
            $second_level_styles['padding-bottom'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_tb').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_lr') !== '') {
            $second_level_styles['padding-left'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_lr').'px';
            $second_level_styles['padding-right'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_padding_lr').'px';
        }

        if(qode_startit_options()->getOptionValue('vertical_menu_2nd_hover_color') !== '') {
            $second_level_hover_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_2nd_hover_color');
        }

        $second_level_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li > a'
        );

        $second_level_hover_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li > a:hover',
            '.qodef-header-vertical .qodef-vertical-menu .second .inner > ul > li > a.qodef-active-item'
        );

        echo qode_startit_dynamic_css($second_level_selector, $second_level_styles);
        echo qode_startit_dynamic_css($second_level_hover_selector, $second_level_hover_styles);

        $third_level_styles = array();
        $third_level_hover_styles = array();

        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_color') !== '') {
            $third_level_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_color');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_google_fonts') !== '-1') {
            $third_level_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('vertical_menu_3rd_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_fontsize') !== '') {
            $third_level_styles['font-size'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_lineheight') !== '') {
            $third_level_styles['line-height'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_texttransform') !== '') {
            $third_level_styles['text-transform'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_texttransform');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_fontstyle') !== '') {
            $third_level_styles['font-style'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_fontweight') !== '') {
            $third_level_styles['font-weight'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_fontweight');
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_letter_spacing') !== '') {
            $third_level_styles['letter-spacing'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_letter_spacing').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_tb') !== '') {
            $third_level_styles['padding-top'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_tb').'px';
            $third_level_styles['padding-bottom'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_tb').'px';
        }
        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_lr') !== '') {
            $third_level_styles['padding-left'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_lr').'px';
            $third_level_styles['padding-right'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_padding_lr').'px';
        }

        if(qode_startit_options()->getOptionValue('vertical_menu_3rd_hover_color') !== '') {
            $third_level_hover_styles['color'] = qode_startit_options()->getOptionValue('vertical_menu_3rd_hover_color');
        }

        $third_level_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a'
        );

        $third_level_hover_selector = array(
            '.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a:hover',
            '.qodef-header-vertical .qodef-vertical-menu .second .inner ul li ul li a.qodef-active-item'
        );

        echo qode_startit_dynamic_css($third_level_selector, $third_level_styles);
        echo qode_startit_dynamic_css($third_level_hover_selector, $third_level_hover_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_vertical_main_menu_styles');
}