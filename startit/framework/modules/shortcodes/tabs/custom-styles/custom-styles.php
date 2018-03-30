<?php
if(!function_exists('qode_startit_tabs_typography_styles')){
	function qode_startit_tabs_typography_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$tabs_typography_array = array();

		$font_family = qode_startit_options()->getOptionValue('tabs_font_family');
		if(qode_startit_is_font_option_valid($font_family)){
            $tabs_typography_array['font-family'] = qode_startit_is_font_option_valid($font_family);
		}
		
		$text_transform = qode_startit_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_typography_array['text-transform'] = $text_transform;
        }

        $font_style = qode_startit_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_typography_array['font-style'] = $font_style;
        }

        $letter_spacing = qode_startit_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_typography_array['letter-spacing'] = qode_startit_filter_px($letter_spacing).'px';
        }

        $font_weight = qode_startit_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_typography_array['font-weight'] = $font_weight;
        }

        echo qode_startit_dynamic_css($selector, $tabs_typography_array);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_typography_styles');
}

if(!function_exists('qode_startit_tabs_inital_color_styles')){
	function qode_startit_tabs_inital_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('tabs_color')) {
            $styles['color'] = qode_startit_options()->getOptionValue('tabs_color');
        }
		if(qode_startit_options()->getOptionValue('tabs_back_color')) {
            $styles['background-color'] = qode_startit_options()->getOptionValue('tabs_back_color');
        }
		if(qode_startit_options()->getOptionValue('tabs_border_color')) {
            $styles['border-color'] = qode_startit_options()->getOptionValue('tabs_border_color');
        }
		
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_inital_color_styles');
}
if(!function_exists('qode_startit_tabs_active_color_styles')){
	function qode_startit_tabs_active_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li.ui-state-active a, .qodef-tabs .qodef-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = qode_startit_options()->getOptionValue('tabs_color_active');
        }
		if(qode_startit_options()->getOptionValue('tabs_back_color_active')) {
            $styles['background-color'] = qode_startit_options()->getOptionValue('tabs_back_color_active');
        }
		if(qode_startit_options()->getOptionValue('tabs_border_color_active')) {
            $styles['border-color'] = qode_startit_options()->getOptionValue('tabs_border_color_active');
        }
		
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_tabs_active_color_styles');
}