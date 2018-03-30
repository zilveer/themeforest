<?php

if(!function_exists('qode_startit_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function qode_startit_button_typography_styles() {
        $selector = '.qodef-btn';
        $styles = array();

        $font_family = qode_startit_options()->getOptionValue('button_font_family');
        if(qode_startit_is_font_option_valid($font_family)) {
            $styles['font-family'] = qode_startit_get_font_option_val($font_family);
        }

        $text_transform = qode_startit_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = qode_startit_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = qode_startit_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = qode_startit_filter_px($letter_spacing).'px';
        }

        $font_weight = qode_startit_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo qode_startit_dynamic_css($selector, $styles);
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_button_typography_styles');
}

if(!function_exists('qode_startit_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function qode_startit_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.qodef-btn.qodef-btn-outline';

        if(qode_startit_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = qode_startit_options()->getOptionValue('btn_outline_text_color');
        }

        if(qode_startit_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = qode_startit_options()->getOptionValue('btn_outline_border_color');
        }

        echo qode_startit_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(qode_startit_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-color):hover',
                array('color' => qode_startit_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(qode_startit_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-hover-bg):hover',
                array('background-color' => qode_startit_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(qode_startit_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-outline:not(.qodef-btn-custom-border-hover):hover',
                array('border-color' => qode_startit_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_button_outline_styles');
}

if(!function_exists('qode_startit_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function qode_startit_button_solid_styles() {
        //solid styles
        $solid_selector = '.qodef-btn.qodef-btn-solid';
        $solid_styles = array();

        if(qode_startit_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = qode_startit_options()->getOptionValue('btn_solid_text_color');
        }

        if(qode_startit_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = qode_startit_options()->getOptionValue('btn_solid_border_color');
        }

        if(qode_startit_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = qode_startit_options()->getOptionValue('btn_solid_bg_color');
        }

        echo qode_startit_dynamic_css($solid_selector, $solid_styles);



        if(qode_startit_options()->getOptionValue('btn_solid_bg_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-icon:not(.qodef-btn-custom-hover-bg).qodef-btn-solid .qodef-btn-text-icon,
                .qodef-btn.qodef-btn-hover-animation:not(.qodef-btn-outline):hover.qodef-btn-solid:not(.qodef-btn-custom-hover-bg)',
                array('background-color' => 'rgba(0,0,0,0.05) !important')
            );
        }

        //solid hover styles
        if(qode_startit_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-color):hover',
                array('color' => qode_startit_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(qode_startit_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover,
                .qodef-btn.qodef-btn-hover-animation:not(.qodef-btn-outline).qodef-btn-solid:not(.qodef-btn-custom-hover-bg) .qodef-animation-overlay,
                .qodef-btn.qodef-btn-icon:not(.qodef-btn-custom-hover-bg).qodef-btn-solid:hover',
                array('background-color' => qode_startit_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(qode_startit_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo qode_startit_dynamic_css(
                '.qodef-btn.qodef-btn-solid:not(.qodef-btn-custom-hover-bg):hover',
                array('border-color' => qode_startit_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('qode_startit_style_dynamic', 'qode_startit_button_solid_styles');
}