<?php

if(!function_exists('flow_elated_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function flow_elated_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(flow_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(flow_elated_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = flow_elated_options()->getOptionValue('mobile_header_background_color');
        }

        echo flow_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-header-inner', $mobile_header_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_mobile_header_general_styles');
}

if(!function_exists('flow_elated_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function flow_elated_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(flow_elated_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = flow_elated_options()->getOptionValue('mobile_menu_background_color');
        }

        echo flow_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(flow_elated_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = flow_elated_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(flow_elated_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = flow_elated_options()->getOptionValue('mobile_text_color');
        }

        if(flow_elated_is_font_option_valid(flow_elated_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('mobile_font_family'));
        }

        if(flow_elated_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(flow_elated_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(flow_elated_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = flow_elated_options()->getOptionValue('mobile_text_transform');
        }

        if(flow_elated_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = flow_elated_options()->getOptionValue('mobile_font_style');
        }

        if(flow_elated_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = flow_elated_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.eltd-mobile-header .eltd-mobile-nav a',
            '.eltd-mobile-header .eltd-mobile-nav h4'
        );

        echo flow_elated_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(flow_elated_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = flow_elated_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.eltd-mobile-header .eltd-mobile-nav a:hover',
            '.eltd-mobile-header .eltd-mobile-nav h4:hover'
        );

        echo flow_elated_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_mobile_navigation_styles');
}

if(!function_exists('flow_elated_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function flow_elated_mobile_logo_styles() {
        if(flow_elated_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo flow_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(flow_elated_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo flow_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-logo-wrapper a',
                array('height' => flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(flow_elated_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo flow_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_mobile_logo_styles');
}

if(!function_exists('flow_elated_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function flow_elated_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(flow_elated_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = flow_elated_options()->getOptionValue('mobile_icon_color');
        }

        if(flow_elated_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo flow_elated_dynamic_css('.eltd-mobile-header .eltd-mobile-menu-opener a', $mobile_icon_styles);

        if(flow_elated_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo flow_elated_dynamic_css(
                '.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
                array('color' => flow_elated_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_mobile_icon_styles');
}