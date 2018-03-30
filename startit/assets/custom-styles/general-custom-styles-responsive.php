<?php
if(!function_exists('qode_startit_design_responsive_styles')) {
    /**
     * Generates general responsive custom styles
     */
    function qode_startit_design_responsive_styles() {

        $parallax_style = array();
        if (qode_startit_options()->getOptionValue('parallax_min_height') !== '') {
            $parallax_style['height'] = 'auto !important';
            $parallax_style['min-height'] = qode_startit_options()->getOptionValue('parallax_min_height');
			$parallax_style['min-height'] = qode_startit_filter_px($parallax_style['min-height']) . 'px';
        }

		echo qode_startit_dynamic_css('.qodef-section.qodef-parallax-section-holder', $parallax_style);
    }

    add_action('qode_startit_style_dynamic_responsive_480', 'qode_startit_design_responsive_styles');
    add_action('qode_startit_style_dynamic_responsive_480_768', 'qode_startit_design_responsive_styles');
}