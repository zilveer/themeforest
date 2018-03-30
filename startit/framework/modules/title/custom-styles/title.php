<?php

if (!function_exists('qode_startit_title_area_typography_style')) {

    function qode_startit_title_area_typography_style(){

        $title_styles = array();

        if(qode_startit_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = qode_startit_options()->getOptionValue('page_title_color');
        }
        if(qode_startit_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('page_title_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = qode_startit_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = qode_startit_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = qode_startit_options()->getOptionValue('page_title_texttransform');
        }
        if(qode_startit_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = qode_startit_options()->getOptionValue('page_title_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = qode_startit_options()->getOptionValue('page_title_fontweight');
        }
        if(qode_startit_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = qode_startit_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.qodef-title .qodef-title-holder h1'
        );

        echo qode_startit_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(qode_startit_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = qode_startit_options()->getOptionValue('page_subtitle_color');
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = qode_startit_options()->getOptionValue('page_subtitle_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = qode_startit_options()->getOptionValue('page_subtitle_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = qode_startit_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = qode_startit_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = qode_startit_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(qode_startit_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = qode_startit_options()->getOptionValue('page_subtitle_letter_spacing').'px';
        }

        $subtitle_selector = array(
            '.qodef-title .qodef-title-holder .qodef-subtitle'
        );

        echo qode_startit_dynamic_css($subtitle_selector, $subtitle_styles);


        $breadcrumb_styles = array();

        if(qode_startit_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = qode_startit_options()->getOptionValue('page_breadcrumb_color');
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = qode_startit_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = qode_startit_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = qode_startit_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = qode_startit_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = qode_startit_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(qode_startit_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = qode_startit_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.qodef-title .qodef-title-holder .qodef-breadcrumbs a, .qodef-title .qodef-title-holder .qodef-breadcrumbs span'
        );

        echo qode_startit_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(qode_startit_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = qode_startit_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.qodef-title .qodef-title-holder .qodef-breadcrumbs a:hover'
        );

        echo qode_startit_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('qode_startit_style_dynamic', 'qode_startit_title_area_typography_style');

}


