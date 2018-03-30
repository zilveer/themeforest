<?php

if (!function_exists('hashmag_mikado_title_area_typography_style')) {

    function hashmag_mikado_title_area_typography_style(){

        $title_styles = array();

        if(hashmag_mikado_options()->getOptionValue('page_title_color') !== '') {
            $title_styles['color'] = hashmag_mikado_options()->getOptionValue('page_title_color');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('page_title_google_fonts'));
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_fontsize') !== '') {
            $title_styles['font-size'] = hashmag_mikado_options()->getOptionValue('page_title_fontsize').'px';
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_lineheight') !== '') {
            $title_styles['line-height'] = hashmag_mikado_options()->getOptionValue('page_title_lineheight').'px';
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_texttransform') !== '') {
            $title_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('page_title_texttransform');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_fontstyle') !== '') {
            $title_styles['font-style'] = hashmag_mikado_options()->getOptionValue('page_title_fontstyle');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_fontweight') !== '') {
            $title_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('page_title_fontweight');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_letter_spacing') !== '') {
            $title_styles['letter-spacing'] = hashmag_mikado_options()->getOptionValue('page_title_letter_spacing').'px';
        }

        $title_selector = array(
            '.mkdf-title .mkdf-title-holder .mkdf-title-text',
            '.single-post.single-format-standard .mkdf-title .mkdf-title-holder .mkdf-title-text'
        );

        echo hashmag_mikado_dynamic_css($title_selector, $title_styles);


        $breadcrumb_styles = array();

        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_color') !== '') {
            $breadcrumb_styles['color'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_color');
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_google_fonts') !== '-1') {
            $breadcrumb_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('page_breadcrumb_google_fonts'));
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontsize') !== '') {
            $breadcrumb_styles['font-size'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontsize').'px';
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_lineheight') !== '') {
            $breadcrumb_styles['line-height'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_lineheight').'px';
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_texttransform') !== '') {
            $breadcrumb_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_texttransform');
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontstyle') !== '') {
            $breadcrumb_styles['font-style'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontstyle');
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontweight') !== '') {
            $breadcrumb_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_fontweight');
        }
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing') !== '') {
            $breadcrumb_styles['letter-spacing'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_letter_spacing').'px';
        }

        $breadcrumb_selector = array(
            '.mkdf-title .mkdf-title-holder .mkdf-breadcrumbs a, .mkdf-title .mkdf-title-holder .mkdf-breadcrumbs span'
        );

        echo hashmag_mikado_dynamic_css($breadcrumb_selector, $breadcrumb_styles);

        $breadcrumb_selector_styles = array();
        if(hashmag_mikado_options()->getOptionValue('page_breadcrumb_hovercolor') !== '') {
            $breadcrumb_selector_styles['color'] = hashmag_mikado_options()->getOptionValue('page_breadcrumb_hovercolor').' !important';
        }

        $breadcrumb_hover_selector = array(
            '.mkdf-title .mkdf-title-holder .mkdf-breadcrumbs a:hover'
        );

        echo hashmag_mikado_dynamic_css($breadcrumb_hover_selector, $breadcrumb_selector_styles);


        $title_info_styles = array();

        if(hashmag_mikado_options()->getOptionValue('page_title_info_color') !== '') {
            $title_color['color'] = hashmag_mikado_options()->getOptionValue('page_title_info_color');
			$title_color_selector = array(
			'.single-post .mkdf-title .mkdf-title-cat, .single-post .mkdf-title .mkdf-pt-info-section'
			);

			echo hashmag_mikado_dynamic_css($title_color_selector, $title_color);
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_google_fonts') !== '-1') {
            $title_info_styles['font-family'] = hashmag_mikado_get_formatted_font_family(hashmag_mikado_options()->getOptionValue('page_title_info_google_fonts'));
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_fontsize') !== '') {
            $title_info_styles['font-size'] = hashmag_mikado_options()->getOptionValue('page_title_info_fontsize').'px';
            echo hashmag_mikado_dynamic_css('.single-post .mkdf-title .mkdf-pt-info-section > div', array('font-size' => ($title_info_styles['font-size'] - 3).'px' ));
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_lineheight') !== '') {
            $title_info_styles['line-height'] = hashmag_mikado_options()->getOptionValue('page_title_info_lineheight').'px';
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_texttransform') !== '') {
            $title_info_styles['text-transform'] = hashmag_mikado_options()->getOptionValue('page_title_info_texttransform');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_fontstyle') !== '') {
            $title_info_styles['font-style'] = hashmag_mikado_options()->getOptionValue('page_title_info_fontstyle');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_fontweight') !== '') {
            $title_info_styles['font-weight'] = hashmag_mikado_options()->getOptionValue('page_title_info_fontweight');
        }
        if(hashmag_mikado_options()->getOptionValue('page_title_info_letter_spacing') !== '') {
            $title_info_styles['letter-spacing'] = hashmag_mikado_options()->getOptionValue('page_title_info_letter_spacing').'px';
        }

        $title_info_selector = array(
            '.single-post .mkdf-title .mkdf-post-info-category,.single-post.single-format-standard .mkdf-title .mkdf-title-post-author, .single-post .mkdf-title .mkdf-pt-info-section > div'
        );

        echo hashmag_mikado_dynamic_css($title_info_selector, $title_info_styles);

        $title_info_selector_styles = array();
        if(hashmag_mikado_options()->getOptionValue('page_title_info_hover_color') !== '') {
            $title_info_selector_styles['color'] = hashmag_mikado_options()->getOptionValue('page_title_info_hover_color').' !important';
        }

        $title_info_hover_selector = array(
            '.single-post .mkdf-title .mkdf-post-info-category a:hover',
            '.single-post.single-format-standard .mkdf-title .mkdf-title-post-author a:hover',
            '.single-post .mkdf-title .mkdf-pt-info-section > div a:hover'
        );

        echo hashmag_mikado_dynamic_css($title_info_hover_selector, $title_info_selector_styles);

        if(hashmag_mikado_options()->getOptionValue('page_title_info_author_color') !== '') {
            $title_info_author['color'] = hashmag_mikado_options()->getOptionValue('page_title_info_author_color');

			echo hashmag_mikado_dynamic_css('.single-post.single-format-standard .mkdf-title .mkdf-title-post-author', $title_info_author);
        }

    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_title_area_typography_style');

}


