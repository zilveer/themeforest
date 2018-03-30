<?php 

if(!function_exists('libero_mikado_accordions_typography_styles')){
	function libero_mikado_accordions_typography_styles(){
		$selector = '.mkd-accordion-holder .mkd-title-holder';
		$styles = array();
		
		$font_family = libero_mikado_options()->getOptionValue('accordions_font_family');
		if(libero_mikado_is_font_option_valid($font_family)){
			$styles['font-family'] = libero_mikado_get_font_option_val($font_family);
		}
		
		$text_transform = libero_mikado_options()->getOptionValue('accordions_text_transform');
       if(!empty($text_transform)) {
           $styles['text-transform'] = $text_transform;
       }

       $font_style = libero_mikado_options()->getOptionValue('accordions_font_style');
       if(!empty($font_style)) {
           $styles['font-style'] = $font_style;
       }

       $letter_spacing = libero_mikado_options()->getOptionValue('accordions_letter_spacing');
       if($letter_spacing !== '') {
           $styles['letter-spacing'] = libero_mikado_filter_px($letter_spacing).'px';
       }

       $font_weight = libero_mikado_options()->getOptionValue('accordions_font_weight');
       if(!empty($font_weight)) {
           $styles['font-weight'] = $font_weight;
       }

       echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_typography_styles');
}

if(!function_exists('libero_mikado_accordions_general_color_styles')){
    function libero_mikado_accordions_general_color_styles(){
        $selector1 = '.mkd-accordion-holder';
        $styles1 = array();

        if(libero_mikado_options()->getOptionValue('accordions_background_color')) {
            $styles1['background-color'] = libero_mikado_options()->getOptionValue('accordions_background_color');
        }
        echo libero_mikado_dynamic_css($selector1, $styles1);

        $selector2 = '.mkd-accordion-holder, .mkd-accordion-holder .mkd-title-holder, .mkd-accordion-holder .ui-accordion-content-active';
        $styles2 = array();

        if(libero_mikado_options()->getOptionValue('accordions_border_color')) {
            $styles2['border-color'] = libero_mikado_options()->getOptionValue('accordions_border_color');
        }
        echo libero_mikado_dynamic_css($selector2, $styles2);
    }
    add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_general_color_styles');
}

if(!function_exists('libero_mikado_accordions_inital_title_color_styles')){
	function libero_mikado_accordions_inital_title_color_styles(){
		$selector = '.mkd-accordion-holder.mkd-initial .mkd-title-holder';
		$styles = array();

		if(libero_mikado_options()->getOptionValue('accordions_title_color')) {
           $styles['color'] = libero_mikado_options()->getOptionValue('accordions_title_color');
       }
		echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_inital_title_color_styles');
}

if(!function_exists('libero_mikado_accordions_active_title_color_styles')){
	
	function libero_mikado_accordions_active_title_color_styles(){
		$selector = array(
			'.mkd-accordion-holder.mkd-initial .mkd-title-holder.ui-state-active',
			'.mkd-accordion-holder.mkd-initial .mkd-title-holder.ui-state-hover'
		);
		$styles = array();
		
		if(libero_mikado_options()->getOptionValue('accordions_title_color_active')) {
           $styles['color'] = libero_mikado_options()->getOptionValue('accordions_title_color_active');
       }
		
		echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_active_title_color_styles');
}
if(!function_exists('libero_mikado_accordions_inital_icon_color_styles')){
	
	function libero_mikado_accordions_inital_icon_color_styles(){
		$selector = '.mkd-accordion-holder.mkd-initial .mkd-title-holder .mkd-accordion-mark';
		$styles = array();
		
		if(libero_mikado_options()->getOptionValue('accordions_icon_color')) {
           $styles['color'] = libero_mikado_options()->getOptionValue('accordions_icon_color');
       }

        echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_inital_icon_color_styles');
}
if(!function_exists('libero_mikado_accordions_active_icon_color_styles')){
	
	function libero_mikado_accordions_active_icon_color_styles(){
		$selector = array(
			'.mkd-accordion-holder.mkd-initial .mkd-title-holder.ui-state-active  .mkd-accordion-mark',
			'.mkd-accordion-holder.mkd-initial .mkd-title-holder.ui-state-hover  .mkd-accordion-mark'
		);
		$styles = array();
		
		if(libero_mikado_options()->getOptionValue('accordions_icon_color_active')) {
           $styles['color'] = libero_mikado_options()->getOptionValue('accordions_icon_color_active');
       }

		echo libero_mikado_dynamic_css($selector, $styles);
	}
	add_action('libero_mikado_style_dynamic', 'libero_mikado_accordions_active_icon_color_styles');
}
