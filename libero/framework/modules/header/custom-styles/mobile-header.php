<?php

if(!function_exists('libero_mikado_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function libero_mikado_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(libero_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(libero_mikado_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = libero_mikado_options()->getOptionValue('mobile_header_background_color');
        }

        echo libero_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-header-inner', $mobile_header_styles);
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_mobile_header_general_styles');
}

if(!function_exists('libero_mikado_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function libero_mikado_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(libero_mikado_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = libero_mikado_options()->getOptionValue('mobile_menu_background_color');
        }

        echo libero_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(libero_mikado_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = libero_mikado_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(libero_mikado_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = libero_mikado_options()->getOptionValue('mobile_text_color');
            echo libero_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-nav .mobile_arrow',array('color' => libero_mikado_options()->getOptionValue('mobile_text_color')));
        }

        if(libero_mikado_is_font_option_valid(libero_mikado_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('mobile_font_family'));
        }

        if(libero_mikado_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(libero_mikado_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(libero_mikado_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = libero_mikado_options()->getOptionValue('mobile_text_transform');
        }

        if(libero_mikado_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = libero_mikado_options()->getOptionValue('mobile_font_style');
        }

        if(libero_mikado_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = libero_mikado_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.mkd-mobile-header .mkd-mobile-nav a',
            '.mkd-mobile-header .mkd-mobile-nav h4'
        );

        echo libero_mikado_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(libero_mikado_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = libero_mikado_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.mkd-mobile-header .mkd-mobile-nav a:hover',
            '.mkd-mobile-header .mkd-mobile-nav h4:hover'
        );

        echo libero_mikado_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_mobile_navigation_styles');
}

if(!function_exists('libero_mikado_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function libero_mikado_mobile_logo_styles() {
        if(libero_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo libero_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(libero_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo libero_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(libero_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(libero_mikado_filter_px(libero_mikado_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo libero_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_mobile_logo_styles');
}

if(!function_exists('libero_mikado_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function libero_mikado_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(libero_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['background-color'] = libero_mikado_options()->getOptionValue('mobile_icon_color');
        }

        echo libero_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-menu-opener .mkd-lines', $mobile_icon_styles);

        if(libero_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo libero_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-menu-opener:hover .mkd-lines',
                array('background-color' => libero_mikado_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_mobile_icon_styles');
}