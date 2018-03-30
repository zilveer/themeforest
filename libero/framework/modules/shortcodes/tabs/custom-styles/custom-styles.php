<?php
if(!function_exists('libero_mikado_tabs_typography_styles')){
	function libero_mikado_tabs_typography_styles(){

        $styles = array();
        $selector = '.mkd-tabs .mkd-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family = libero_mikado_options()->getOptionValue('tabs_font_family');
		
		if(libero_mikado_is_font_option_valid($font_family)){
			$tabs_tipography_array['font-family'] = libero_mikado_is_font_option_valid($font_family);
		}
		
		$text_transform = libero_mikado_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = libero_mikado_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = libero_mikado_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = libero_mikado_filter_px($letter_spacing).'px';
        }

        $font_weight = libero_mikado_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_tabs_typography_styles');
}

if(!function_exists('libero_mikado_tabs_general_color_styles')){
    function libero_mikado_tabs_general_color_styles(){
        $selector1 = '.mkd-tabs .mkd-tabs-nav li a, .mkd-tabs .mkd-tab-container';
        $styles1 = array();

        if(libero_mikado_options()->getOptionValue('tabs_background_color')) {
            $styles1['background-color'] = libero_mikado_options()->getOptionValue('tabs_background_color');
        }
        echo libero_mikado_dynamic_css($selector1, $styles1);

        $selector2 = '.mkd-tabs .mkd-tabs-nav li a, .mkd-tabs .mkd-tab-container';
        $styles2 = array();

        if(libero_mikado_options()->getOptionValue('tabs_border_color')) {
            $styles2['border-color'] = libero_mikado_options()->getOptionValue('tabs_border_color');
        }
        echo libero_mikado_dynamic_css($selector2, $styles2);
    }
    add_action('libero_mikado_style_dynamic', 'libero_mikado_tabs_general_color_styles');
}

if(!function_exists('libero_mikado_tabs_inital_color_styles')){
	function libero_mikado_tabs_inital_color_styles(){
		$selector1 = '.mkd-tabs .mkd-tabs-nav li a';
		$styles1 = array();
		
		if(libero_mikado_options()->getOptionValue('tabs_color')) {
            $styles1['color'] = libero_mikado_options()->getOptionValue('tabs_color');
        }
        echo libero_mikado_dynamic_css($selector1, $styles1);

        $selector2 = '.mkd-tabs .mkd-tabs-nav li.ui-state-default a span.mkd-icon-frame';
        $styles2 = array();

		if(libero_mikado_options()->getOptionValue('tabs_icon_color')) {
            $styles2['color'] = libero_mikado_options()->getOptionValue('tabs_icon_color');
        }
		
		echo libero_mikado_dynamic_css($selector2, $styles2);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_tabs_inital_color_styles');
}
if(!function_exists('libero_mikado_tabs_active_color_styles')){
	function libero_mikado_tabs_active_color_styles(){
		$selector1 = '.mkd-tabs .mkd-tabs-nav li.ui-state-active a, .mkd-tabs .mkd-tabs-nav li.ui-state-hover a';
		$styles1 = array();
		
		if(libero_mikado_options()->getOptionValue('tabs_color_active')) {
            $styles1['color'] = libero_mikado_options()->getOptionValue('tabs_color_active');
        }

        echo libero_mikado_dynamic_css($selector1, $styles1);

        $selector2 = '.mkd-tabs .mkd-tabs-nav li.ui-state-active a span.mkd-icon-frame, .mkd-tabs .mkd-tabs-nav li.ui-state-hover a span.mkd-icon-frame';
        $styles2 = array();

        if(libero_mikado_options()->getOptionValue('tabs_icon_color_active')) {
            $styles2['color'] = libero_mikado_options()->getOptionValue('tabs_icon_color_active');
        }

        echo libero_mikado_dynamic_css($selector2, $styles2);
		

	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_tabs_active_color_styles');
}