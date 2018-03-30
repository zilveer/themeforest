<?php
if(!function_exists('suprema_qodef_tabs_typography_styles')){
	function suprema_qodef_tabs_typography_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family = suprema_qodef_options()->getOptionValue('tabs_font_family');
		
		if(suprema_qodef_is_font_option_valid($font_family)){
			$tabs_tipography_array['font-family'] = suprema_qodef_is_font_option_valid($font_family);
		}
		
		$text_transform = suprema_qodef_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_tipography_array['text-transform'] = $text_transform;
        }

        $font_style = suprema_qodef_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_tipography_array['font-style'] = $font_style;
        }

        $letter_spacing = suprema_qodef_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_tipography_array['letter-spacing'] = suprema_qodef_filter_px($letter_spacing).'px';
        }

        $font_weight = suprema_qodef_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_tipography_array['font-weight'] = $font_weight;
        }

        echo suprema_qodef_dynamic_css($selector, $tabs_tipography_array);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_tabs_typography_styles');
}

if(!function_exists('suprema_qodef_tabs_inital_color_styles')){
	function suprema_qodef_tabs_inital_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li a';
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('tabs_color')) {
            $styles['color'] = suprema_qodef_options()->getOptionValue('tabs_color');
        }
		if(suprema_qodef_options()->getOptionValue('tabs_back_color')) {
            $styles['background-color'] = suprema_qodef_options()->getOptionValue('tabs_back_color');
        }
		if(suprema_qodef_options()->getOptionValue('tabs_border_color')) {
            $styles['border-color'] = suprema_qodef_options()->getOptionValue('tabs_border_color');
        }
		
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_tabs_inital_color_styles');
}
if(!function_exists('suprema_qodef_tabs_active_color_styles')){
	function suprema_qodef_tabs_active_color_styles(){
		$selector = '.qodef-tabs .qodef-tabs-nav li.ui-state-active a, .qodef-tabs .qodef-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = suprema_qodef_options()->getOptionValue('tabs_color_active');
        }
		if(suprema_qodef_options()->getOptionValue('tabs_back_color_active')) {
            $styles['background-color'] = suprema_qodef_options()->getOptionValue('tabs_back_color_active');
        }
		if(suprema_qodef_options()->getOptionValue('tabs_border_color_active')) {
            $styles['border-color'] = suprema_qodef_options()->getOptionValue('tabs_border_color_active');
        }
		
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_tabs_active_color_styles');
}