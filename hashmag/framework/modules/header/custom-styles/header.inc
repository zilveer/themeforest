<?php

if(!function_exists('hashmag_mikado_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function hashmag_mikado_header_top_bar_styles() {
        global $hashmag_options;

        $background_color = hashmag_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();

        if($background_color !== '') {
            $top_bar_styles['background-color'] = $background_color;
        }

        if(hashmag_mikado_options()->getOptionValue('top_bar_bottom_border') == 'yes'){
            if(hashmag_mikado_options()->getOptionValue('top_bar_bottom_border_color') !== ""){
                $top_bar_styles['border-bottom'] = '1px solid '.hashmag_mikado_options()->getOptionValue('top_bar_bottom_border_color');
            }else{
                $top_bar_styles['border-bottom'] = '1px solid #e4e4e4';
            }
        }

        echo hashmag_mikado_dynamic_css('.mkdf-top-bar', $top_bar_styles);
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_header_top_bar_styles');
}

if(!function_exists('hashmag_mikado_header_top_bar_responsive_styles')) {
    /**
     * Generates styles for header top bar
     */
    function hashmag_mikado_header_top_bar_responsive_styles() {
        global $hashmag_options;

        $top_bar_responsive_styles = array();
        $hide_top_bar_on_mobile = hashmag_mikado_options()->getOptionValue('hide_top_bar_on_mobile');

        if($hide_top_bar_on_mobile === 'yes') { ?>
            @media only screen and (max-width: 700px) {
                .mkdf-top-bar {
                    height: 0;
                    display: none;
                }
            }
        <?php }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_header_top_bar_responsive_styles');
}

if(!function_exists('hashmag_mikado_header_type3_logo_styles')) {
    /**
     * Generates styles for header type 3 logo
     */
    function hashmag_mikado_header_type3_logo_styles() {
        global $hashmag_options;

        $logo_area_header_type3_styles = array();

        if($hashmag_options['logo_area_height_header_type3'] !== '') {
            $header_type3_height = hashmag_mikado_filter_px($hashmag_options['logo_area_height_header_type3']);

            $logo_area_header_type3_styles['height'] = $header_type3_height.'px';

            $max_height = intval($header_type3_height).'px';
            echo hashmag_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-logo-wrapper a', array('max-height' => $max_height));
        }

        if (hashmag_mikado_options()->getOptionValue('logo_area_pattern')) {
            $logo_area_header_type3_styles['background-image'] = 'url('.esc_url(hashmag_mikado_options()->getOptionValue('logo_area_pattern')).')';
            $logo_area_header_type3_styles['background-position'] = '0px 0px';
            $logo_area_header_type3_styles['background-repeat'] = 'repeat';
        }

        if (hashmag_mikado_options()->getOptionValue('logo_area_background_color')) {
            $logo_area_header_type3_styles['background-color'] = esc_url(hashmag_mikado_options()->getOptionValue('logo_area_background_color'));
        }

        echo hashmag_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-logo-area', $logo_area_header_type3_styles);
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_header_type3_logo_styles');
}

if(!function_exists('hashmag_mikado_header_type3_menu_area_styles')) {
    /**
     * Generates styles for header type 3 menu area
     */
    function hashmag_mikado_header_type3_menu_area_styles() {
        global $hashmag_options;

        $menu_area_header_type3_styles = array();

        if($hashmag_options['menu_area_height_header_type3'] !== '') {
            $menu_area_header_type3_styles['height'] = hashmag_mikado_filter_px($hashmag_options['menu_area_height_header_type3']).'px';
        }

        $menu_area_header_type3_color_styles = array();
        if($hashmag_options['menu_area_background_color'] !== '') {
            $menu_area_header_type3_color_styles['background-color'] = $hashmag_options['menu_area_background_color'];
        }

        if(hashmag_mikado_options()->getOptionValue('menu_area_border') == 'yes'){
            if(hashmag_mikado_options()->getOptionValue('menu_area_border_color') !== ""){
                $menu_area_header_type3_color_styles['border-top'] = '1px solid '.hashmag_mikado_options()->getOptionValue('menu_area_border_color');
                $menu_area_header_type3_color_styles['border-bottom'] = '1px solid '.hashmag_mikado_options()->getOptionValue('menu_area_border_color');

            }else{
                $menu_area_header_type3_color_styles['border-top'] = '1px solid #e4e4e4';
                $menu_area_header_type3_color_styles['border-bottom'] = '1px solid #e4e4e4';
            }
        }

        echo hashmag_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-menu-area', $menu_area_header_type3_styles);
        echo hashmag_mikado_dynamic_css('.mkdf-header-type3 .mkdf-page-header .mkdf-menu-area .mkdf-vertical-align-containers', $menu_area_header_type3_color_styles);
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_header_type3_menu_area_styles');
}

if(!function_exists('hashmag_mikado_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function hashmag_mikado_sticky_header_styles() {
        global $hashmag_options;

        if($hashmag_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $hashmag_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($hashmag_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $hashmag_options['sticky_header_transparency'];
            }

            echo hashmag_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-sticky-holder', array('background-color' => hashmag_mikado_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($hashmag_options['sticky_header_height'] !== '') {
            $sticky_header_height = hashmag_mikado_filter_px($hashmag_options['sticky_header_height']);
            $max_height = intval($sticky_header_height * 0.9).'px';

            echo hashmag_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header', array('height' => $sticky_header_height.'px'));
            echo hashmag_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li > a > span.item_outer', array('line-height' => ($sticky_header_height - 1).'px'));
            echo hashmag_mikado_dynamic_css('.mkdf-page-header .mkdf-sticky-header .mkdf-sticky-holder .mkdf-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if($hashmag_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $hashmag_options['sticky_color'];
        }
        if($hashmag_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = hashmag_mikado_get_formatted_font_family($hashmag_options['sticky_google_fonts']);
        }
        if($hashmag_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $hashmag_options['sticky_fontsize'].'px';
        }
        if($hashmag_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $hashmag_options['sticky_lineheight'].'px';
        }
        if($hashmag_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $hashmag_options['sticky_texttransform'];
        }
        if($hashmag_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $hashmag_options['sticky_fontstyle'];
        }
        if($hashmag_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $hashmag_options['sticky_fontweight'];
        }
        if($hashmag_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $hashmag_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu.mkdf-sticky-nav > ul > li > a'
        );

        echo hashmag_mikado_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($hashmag_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $hashmag_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu.mkdf-sticky-nav > ul > li:hover > a',
            '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu.mkdf-sticky-nav > ul > li.mkdf-active-item:hover > a'
        );

        echo hashmag_mikado_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_sticky_header_styles');
}

if(!function_exists('hashmag_mikado_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function hashmag_mikado_main_menu_styles() {
        global $hashmag_options;

        if($hashmag_options['menu_color'] !== '' || $hashmag_options['menu_fontsize'] != '' || $hashmag_options['menu_lineheight'] != '' || $hashmag_options['menu_fontstyle'] !== '' || $hashmag_options['menu_fontweight'] !== '' || $hashmag_options['menu_texttransform'] !== '' || $hashmag_options['menu_letterspacing'] !== '' || $hashmag_options['menu_google_fonts'] != "-1") { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li > a {
            <?php if($hashmag_options['menu_color']) { ?> color: <?php echo esc_attr($hashmag_options['menu_color']); ?>; <?php } ?>
            <?php if($hashmag_options['menu_google_fonts'] != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', $hashmag_options['menu_google_fonts'])); ?>', sans-serif;
            <?php } ?>
            <?php if($hashmag_options['menu_fontsize'] !== '') { ?> font-size: <?php echo esc_attr($hashmag_options['menu_fontsize']); ?>px; <?php } ?>
            <?php if($hashmag_options['menu_lineheight'] !== '') { ?> line-height: <?php echo esc_attr($hashmag_options['menu_lineheight']); ?>px; <?php } ?>
            <?php if($hashmag_options['menu_fontstyle'] !== '') { ?> font-style: <?php echo esc_attr($hashmag_options['menu_fontstyle']); ?>; <?php } ?>
            <?php if($hashmag_options['menu_fontweight'] !== '') { ?> font-weight: <?php echo esc_attr($hashmag_options['menu_fontweight']); ?>; <?php } ?>
            <?php if($hashmag_options['menu_texttransform'] !== '') { ?> text-transform: <?php echo esc_attr($hashmag_options['menu_texttransform']); ?>;  <?php } ?>
            <?php if($hashmag_options['menu_letterspacing'] !== '') { ?> letter-spacing: <?php echo esc_attr($hashmag_options['menu_letterspacing']); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if($hashmag_options['menu_hovercolor'] !== '') { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li:hover > a,
            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item:hover > a {
                color: <?php echo esc_attr($hashmag_options['menu_hovercolor']); ?> !important;
            }
        <?php } ?>

        <?php if($hashmag_options['menu_activecolor'] !== '') { ?>
            .mkdf-main-menu.mkdf-default-nav > ul > li.mkdf-active-item > a {
                color: <?php echo esc_attr($hashmag_options['menu_activecolor']); ?>;
            }
        <?php } ?>

        <?php

        $dropdown_styles = array();
        if($hashmag_options['dropdown_background_color'] !== '') {
            $dropdown_styles['background-color'] = $hashmag_options['dropdown_background_color'];
        }

        $dropdown_selector = array(
            '.mkdf-drop-down .mkdf-menu-second .mkdf-menu-inner > ul,
            li.mkdf-menu-narrow .mkdf-menu-second .mkdf-menu-inner ul,
            .mkdf-top-bar #lang_sel ul ul'
        );

        echo hashmag_mikado_dynamic_css($dropdown_selector, $dropdown_styles);


    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_main_menu_styles');
}