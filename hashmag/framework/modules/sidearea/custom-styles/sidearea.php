<?php

if (!function_exists('hashmag_mikado_side_area_over_content_style')) {

    function hashmag_mikado_side_area_over_content_style() {

        if (hashmag_mikado_options()->getOptionValue('side_area_type') == 'side-menu-slide-over-content') {


            $width = hashmag_mikado_options()->getOptionValue('side_area_slide_over_content_width');
            if ($width !== '') {

                if ($width == 'width-256') {
                    $width = '256px';
                } elseif ($width == 'width-290') {
                    $width = '290px';
                } else {
                    $width = '356px';
                }

                echo hashmag_mikado_dynamic_css('.mkdf-side-menu-slide-over-content .mkdf-side-menu', array(
                    'left' => '-' . $width,
                    'width' => $width
                ));
            }
        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_over_content_style');

}

if (!function_exists('hashmag_mikado_side_area_icon_color_styles')) {

    function hashmag_mikado_side_area_icon_color_styles() {

        if (hashmag_mikado_options()->getOptionValue('side_area_icon_font_size') !== '') {

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu-button-opener span', array(
                'font-size' => hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_icon_font_size')) . 'px'
            ));

            if (hashmag_mikado_options()->getOptionValue('side_area_icon_font_size') > 30) {
                echo '@media only screen and (max-width: 480px) {
						.mkdf-side-menu-button-opener span{
						font-size: 30px;
						}
					}';
            }

        }

        if (hashmag_mikado_options()->getOptionValue('side_area_icon_color') !== '') {

            echo hashmag_mikado_dynamic_css('a.mkdf-side-menu-button-opener', array(
                'color' => hashmag_mikado_options()->getOptionValue('side_area_icon_color')
            ));

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu-open .mkdf-side-menu .mkdf-side-menu-close .mkdf-close-1, 
                                             .mkdf-side-menu-open .mkdf-side-menu .mkdf-side-menu-close .mkdf-close-2', array(
                'border-color' => hashmag_mikado_options()->getOptionValue('side_area_icon_color')
            ));

        }
        if (hashmag_mikado_options()->getOptionValue('side_area_icon_hover_color') !== '') {

            echo hashmag_mikado_dynamic_css('a.mkdf-side-menu-button-opener:hover', array(
                'color' => hashmag_mikado_options()->getOptionValue('side_area_icon_hover_color')
            ));

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu-open .mkdf-side-menu .mkdf-side-menu-close:hover .mkdf-close-1,
                                            .mkdf-side-menu-open .mkdf-side-menu .mkdf-side-menu-close:hover .mkdf-close-2', array(
                'border-color' => hashmag_mikado_options()->getOptionValue('side_area_icon_hover_color')
            ));

        }


    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_icon_color_styles');

}

if (!function_exists('hashmag_mikado_side_area_alignment')) {

    function hashmag_mikado_side_area_alignment() {

        if (hashmag_mikado_options()->getOptionValue('side_area_aligment')) {

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu-slide-over-content .mkdf-side-menu', array(
                'text-align' => hashmag_mikado_options()->getOptionValue('side_area_aligment')
            ));

        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_alignment');

}

if (!function_exists('hashmag_mikado_side_area_styles')) {

    function hashmag_mikado_side_area_styles() {

        $side_area_styles = array();

        if (hashmag_mikado_options()->getOptionValue('side_area_background_color') !== '') {
            $side_area_styles['background-color'] = hashmag_mikado_options()->getOptionValue('side_area_background_color');
        }

        if (!empty($side_area_styles)) {
            echo hashmag_mikado_dynamic_css('.mkdf-side-menu', $side_area_styles);
        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_styles');

}

if (!function_exists('hashmag_mikado_side_area_title_styles')) {

    function hashmag_mikado_side_area_title_styles() {

        $title_styles = array();

        if (hashmag_mikado_options()->getOptionValue('side_area_title_color') !== '') {
            $title_styles['color'] = hashmag_mikado_options()->getOptionValue('side_area_title_color');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_fontsize') !== '') {
            $title_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_title_fontsize')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_lineheight') !== '') {
            $title_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_title_lineheight')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_texttransform') !== '') {
            $title_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('side_area_title_texttransform');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_fontstyle') !== '') {
            $title_styles['font-style'] = hashmag_mikado_options()->getOptionValue('side_area_title_fontstyle');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_fontweight') !== '') {
            $title_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('side_area_title_fontweight');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_title_letterspacing') !== '') {
            $title_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
        }

        if (!empty($title_styles)) {

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu-title h4, .mkdf-side-menu-title h5', $title_styles);

        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_title_styles');

}

if (!function_exists('hashmag_mikado_side_area_text_styles')) {

    function hashmag_mikado_side_area_text_styles() {
        $text_styles = array();

        if (hashmag_mikado_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_fontsize') !== '') {
            $text_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_text_fontsize')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_lineheight') !== '') {
            $text_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_text_lineheight')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_fontweight') !== '') {
            $text_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('side_area_text_fontweight');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_fontstyle') !== '') {
            $text_styles['font-style'] = hashmag_mikado_options()->getOptionValue('side_area_text_fontstyle');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_texttransform') !== '') {
            $text_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('side_area_text_texttransform');
        }

        if (hashmag_mikado_options()->getOptionValue('side_area_text_color') !== '') {
            $text_styles['color'] = hashmag_mikado_options()->getOptionValue('side_area_text_color');
        }

        if (!empty($text_styles)) {

            echo hashmag_mikado_dynamic_css(array(
                '.mkdf-side-menu .widget',
                '.mkdf-side-menu .widget.widget_search form',
                '.mkdf-side-menu .widget.widget_search form input[type="text"]',
                '.mkdf-side-menu .widget.widget_search form input[type="submit"]',
                '.mkdf-side-menu .widget h6',
                '.mkdf-side-menu .widget h6 a',
                '.mkdf-side-menu .widget p',
                '.mkdf-side-menu .widget li a',
                '.mkdf-side-menu #wp-calendar caption',
                '.mkdf-side-menu .widget li',
                '.mkdf-side-menu h3',
                '.mkdf-side-menu .widget.widget_archive select',
                '.mkdf-side-menu .widget.widget_categories select',
                '.mkdf-side-menu .widget.widget_text select',
                '.mkdf-side-menu .widget.widget_search form input[type="submit"]',
                '.mkdf-side-menu #wp-calendar th',
                '.mkdf-side-menu #wp-calendar td',
                '.mkdf-side-menu .q_social_icon_holder i.simple_social',
                '.mkdf-side-menu .widget .screen-reader-text',
                '.mkdf-side-menu span'
            ),
                $text_styles
            );
        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_text_styles');

}

if (!function_exists('hashmag_mikado_side_area_link_styles')) {

    function hashmag_mikado_side_area_link_styles() {
        $link_styles = array();

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
            $link_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_font_size') !== '') {
            $link_styles['font-size'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidearea_link_font_size')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_line_height') !== '') {
            $link_styles['line-height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidearea_link_line_height')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
            $link_styles['letter-spacing'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_font_weight') !== '') {
            $link_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('sidearea_link_font_weight');
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_font_style') !== '') {
            $link_styles['font-style'] = hashmag_mikado_options()->getOptionValue('sidearea_link_font_style');
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_text_transform') !== '') {
            $link_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('sidearea_link_text_transform');
        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_color') !== '') {
            $link_styles['color'] = hashmag_mikado_options()->getOptionValue('sidearea_link_color');
        }

        if (!empty($link_styles)) {

            echo hashmag_mikado_dynamic_css('.mkdf-side-menu .widget li a, .mkdf-side-menu .widget a:not(.qbutton),.mkdf-side-menu .widget.widget_rss li a.rsswidget', $link_styles);

        }

        if (hashmag_mikado_options()->getOptionValue('sidearea_link_hover_color') !== '') {
            echo hashmag_mikado_dynamic_css('.mkdf-side-menu .widget a:hover, .mkdf-side-menu .widget li:hover, .mkdf-side-menu .widget li:hover>a,.mkdf-side-menu .widget.widget_rss li a.rsswidget:hover', array(
                'color' => hashmag_mikado_options()->getOptionValue('sidearea_link_hover_color')
            ));
        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_side_area_link_styles');

}