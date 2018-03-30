<?php

if (!function_exists('libero_mikado_title_area_typography_style')) {

    function libero_mikado_title_area_typography_style(){

        $title_styles = array();

        if(libero_mikado_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = libero_mikado_options()->getOptionValue('page_title_color');
        }
        if(libero_mikado_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('page_title_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = libero_mikado_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = libero_mikado_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = libero_mikado_options()->getOptionValue('page_title_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = libero_mikado_options()->getOptionValue('page_title_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = libero_mikado_options()->getOptionValue('page_title_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = libero_mikado_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.mkd-title .mkd-title-holder h1',
            '.mkd-title.mkd-standard-type.mkd-title-enabled-breadcrumbs .mkd-title-holder h1'
        );

        echo libero_mikado_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(libero_mikado_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = libero_mikado_options()->getOptionValue('page_subtitle_color');
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = libero_mikado_options()->getOptionValue('page_subtitle_fontsize').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = libero_mikado_options()->getOptionValue('page_subtitle_lineheight').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = libero_mikado_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = libero_mikado_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = libero_mikado_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = libero_mikado_options()->getOptionValue('page_subtitle_letter_spacing').'px';
        }

        $subtitle_selector = array(
            '.mkd-title .mkd-title-holder .mkd-subtitle'
        );

        echo libero_mikado_dynamic_css($subtitle_selector, $subtitle_styles);


        $breadcrumb_styles = array();

        if(libero_mikado_options()->getOptionValue('page_breadcrumb_color') !== '') {
            echo libero_mikado_dynamic_css('.mkd-title .mkd-title-holder .mkd-breadcrumbs-inner',
            	array('color' => libero_mikado_options()->getOptionValue('page_breadcrumb_color')));
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = libero_mikado_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = libero_mikado_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = libero_mikado_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = libero_mikado_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = libero_mikado_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = libero_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a, .mkd-title .mkd-title-holder .mkd-breadcrumbs span'
        );

        echo libero_mikado_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(libero_mikado_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = libero_mikado_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.mkd-title .mkd-title-holder .mkd-breadcrumbs a:hover'
        );

        echo libero_mikado_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_title_area_typography_style');

}


