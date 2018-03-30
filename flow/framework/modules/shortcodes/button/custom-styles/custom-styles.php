<?php

if(!function_exists('flow_elated_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function flow_elated_button_typography_styles() {
        $selector = '.eltd-btn';
        $styles = array();

        $font_family = flow_elated_options()->getOptionValue('button_font_family');
        if(flow_elated_is_font_option_valid($font_family)) {
            $styles['font-family'] = flow_elated_get_font_option_val($font_family);
        }

        $text_transform = flow_elated_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = flow_elated_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = flow_elated_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = flow_elated_filter_px($letter_spacing).'px';
        }

        $font_weight = flow_elated_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo flow_elated_dynamic_css($selector, $styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_button_typography_styles');
}

if(!function_exists('flow_elated_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function flow_elated_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.eltd-btn.eltd-btn-outline';

        if(flow_elated_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = flow_elated_options()->getOptionValue('btn_outline_text_color');
        }

        if(flow_elated_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = flow_elated_options()->getOptionValue('btn_outline_border_color');
        }

        echo flow_elated_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(flow_elated_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-hover-color):hover',
                array('color' => flow_elated_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(flow_elated_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-hover-bg):hover',
                array('background-color' => flow_elated_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(flow_elated_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-border-hover):hover',
                array('border-color' => flow_elated_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_button_outline_styles');
}

if(!function_exists('flow_elated_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function flow_elated_button_solid_styles() {
        //solid styles
        $solid_selector = '.eltd-btn.eltd-btn-solid';
        $solid_styles = array();

        if(flow_elated_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = flow_elated_options()->getOptionValue('btn_solid_text_color');
        }

        if(flow_elated_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = flow_elated_options()->getOptionValue('btn_solid_border_color');
        }

        if(flow_elated_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = flow_elated_options()->getOptionValue('btn_solid_bg_color');
        }

        echo flow_elated_dynamic_css($solid_selector, $solid_styles);

        //solid hover styles
        if(flow_elated_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-color):hover',
                array('color' => flow_elated_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(flow_elated_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-bg):hover',
                array('background-color' => flow_elated_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(flow_elated_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo flow_elated_dynamic_css(
                '.eltd-btn.eltd-btn-solid:not(.eltd-btn-custom-hover-bg):hover',
                array('border-color' => flow_elated_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_button_solid_styles');
}