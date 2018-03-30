<?php

if(!function_exists('qode_startit_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function qode_startit_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(qode_startit_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(qode_startit_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = qode_startit_options()->getOptionValue('mobile_header_background_color');
        }

        echo qode_startit_dynamic_css('.qodef-mobile-header .qodef-mobile-header-inner', $mobile_header_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_mobile_header_general_styles');
}

if(!function_exists('qode_startit_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function qode_startit_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(qode_startit_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = qode_startit_options()->getOptionValue('mobile_menu_background_color');
        }

        echo qode_startit_dynamic_css('.qodef-mobile-header .qodef-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(qode_startit_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = qode_startit_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(qode_startit_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = qode_startit_options()->getOptionValue('mobile_text_color');
        }

        if(qode_startit_is_font_option_valid(qode_startit_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('mobile_font_family'));
        }

        if(qode_startit_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(qode_startit_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(qode_startit_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = qode_startit_options()->getOptionValue('mobile_text_transform');
        }

        if(qode_startit_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = qode_startit_options()->getOptionValue('mobile_font_style');
        }

        if(qode_startit_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = qode_startit_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.qodef-mobile-header .qodef-mobile-nav a',
            '.qodef-mobile-header .qodef-mobile-nav h4'
        );

        echo qode_startit_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(qode_startit_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = qode_startit_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.qodef-mobile-header .qodef-mobile-nav a:hover',
            '.qodef-mobile-header .qodef-mobile-nav h4:hover'
        );

        echo qode_startit_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_mobile_navigation_styles');
}

if(!function_exists('qode_startit_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function qode_startit_mobile_logo_styles() {
        if(qode_startit_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo qode_startit_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-logo-wrapper a',
                array('height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(qode_startit_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo qode_startit_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-logo-wrapper a',
                array('height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(qode_startit_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo qode_startit_dynamic_css('.qodef-mobile-header .qodef-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_mobile_logo_styles');
}

if(!function_exists('qode_startit_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function qode_startit_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(qode_startit_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = qode_startit_options()->getOptionValue('mobile_icon_color');
        }

        if(qode_startit_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo qode_startit_dynamic_css('.qodef-mobile-header .qodef-mobile-menu-opener a', $mobile_icon_styles);

        if(qode_startit_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo qode_startit_dynamic_css(
                '.qodef-mobile-header .qodef-mobile-menu-opener a:hover',
                array('color' => qode_startit_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_mobile_icon_styles');
}