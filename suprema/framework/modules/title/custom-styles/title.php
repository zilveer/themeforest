<?php

if (!function_exists('suprema_qodef_title_area_typography_style')) {

    function suprema_qodef_title_area_typography_style(){

        $title_styles = array();

        if(suprema_qodef_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = suprema_qodef_options()->getOptionValue('page_title_color');
        }
        if(suprema_qodef_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('page_title_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = suprema_qodef_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = suprema_qodef_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = suprema_qodef_options()->getOptionValue('page_title_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = suprema_qodef_options()->getOptionValue('page_title_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = suprema_qodef_options()->getOptionValue('page_title_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = suprema_qodef_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.qodef-title .qodef-title-holder h1, .qodef-title.qodef-breadcrumb-type .qodef-title-holder h1'
        );

        echo suprema_qodef_dynamic_css($title_selector, $title_styles);


        $subtitle_styles = array();

        if(suprema_qodef_options()->getOptionValue('page_subtitle_color') !== '') {
            $subtitle_styles['color'] = suprema_qodef_options()->getOptionValue('page_subtitle_color');
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_google_fonts') !== '-1') {
            $subtitle_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('page_subtitle_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_fontsize') !== '') {
            $subtitle_styles['font-size'] = suprema_qodef_options()->getOptionValue('page_subtitle_fontsize').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_lineheight') !== '') {
            $subtitle_styles['line-height'] = suprema_qodef_options()->getOptionValue('page_subtitle_lineheight').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_texttransform') !== '') {
            $subtitle_styles['text-transform'] = suprema_qodef_options()->getOptionValue('page_subtitle_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_fontstyle') !== '') {
            $subtitle_styles['font-style'] = suprema_qodef_options()->getOptionValue('page_subtitle_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_fontweight') !== '') {
            $subtitle_styles['font-weight'] = suprema_qodef_options()->getOptionValue('page_subtitle_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('page_subtitle_letter_spacing') !== '') {
            $subtitle_styles['letter-spacing'] = suprema_qodef_options()->getOptionValue('page_subtitle_letter_spacing').'px';
        }

        $subtitle_selector = array(
            '.qodef-title .qodef-title-holder .qodef-subtitle'
        );

        echo suprema_qodef_dynamic_css($subtitle_selector, $subtitle_styles);


        $breadcrumb_styles = array();

        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_color');
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.qodef-title .qodef-title-holder .qodef-breadcrumbs a, .qodef-title .qodef-title-holder .qodef-breadcrumbs span, .qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs a, .qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs span'
        );

        echo suprema_qodef_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(suprema_qodef_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = suprema_qodef_options()->getOptionValue('page_breadcrumb_hovercolor');
        }

        $breadcrumb_hover_selector = array(
            '.qodef-title .qodef-title-holder .qodef-breadcrumbs a:hover, .qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs a:hover, .qodef-title.qodef-breadcrumb-type .qodef-title-holder .qodef-breadcrumbs .qodef-current'
        );

        echo suprema_qodef_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);

    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_title_area_typography_style');

}


