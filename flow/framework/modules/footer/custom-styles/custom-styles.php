<?php

if(!function_exists('flow_elated_set_footer_top_styles')) {
    /**
     * Generates styles for footer top
     */
    function flow_elated_set_footer_top_styles() {
		
        $selector = 'footer .eltd-footer-top-holder';
        $styles = array();

        if(flow_elated_options()->getOptionValue('footer_top_background_color')) {
            $styles['background-color'] = flow_elated_options()->getOptionValue('footer_top_background_color');
        }

        echo flow_elated_dynamic_css($selector, $styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_set_footer_top_styles');
}

if(!function_exists('flow_elated_set_footer_top_padding_styles')) {
    /**
     * Generates styles for footer top
     */
    function flow_elated_set_footer_top_padding_styles() {
		
        $selector = 'footer .eltd-footer-top:not(.eltd-footer-top-full) .eltd-container-inner';
        $styles = array();

        if(flow_elated_options()->getOptionValue('footer_top_padding')) {
            $styles['padding'] = flow_elated_options()->getOptionValue('footer_top_padding');
        }

        echo flow_elated_dynamic_css($selector, $styles);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_set_footer_top_padding_styles');
}