<?php 

if(!function_exists('qode_startit_accordions_typography_styles')){
	function qode_startit_accordions_typography_styles(){
		$selector = '.qodef-accordion-holder .qodef-title-holder';		
		$styles = array();
		
		$font_family = qode_startit_options()->getOptionValue('accordions_font_family');
		if(qode_startit_is_font_option_valid($font_family)){
			$styles['font-family'] = qode_startit_get_font_option_val($font_family);
		}
		
		$text_transform = qode_startit_options()->getOptionValue('accordions_text_transform');
       if(!empty($text_transform)) {
           $styles['text-transform'] = $text_transform;
       }

       $font_style = qode_startit_options()->getOptionValue('accordions_font_style');
       if(!empty($font_style)) {
           $styles['font-style'] = $font_style;
       }

       $letter_spacing = qode_startit_options()->getOptionValue('accordions_letter_spacing');
       if($letter_spacing !== '') {
           $styles['letter-spacing'] = qode_startit_filter_px($letter_spacing).'px';
       }

       $font_weight = qode_startit_options()->getOptionValue('accordions_font_weight');
       if(!empty($font_weight)) {
           $styles['font-weight'] = $font_weight;
       }

       echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_accordions_typography_styles');
}

if(!function_exists('qode_startit_accordions_inital_title_color_styles')){
	function qode_startit_accordions_inital_title_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-initial .qodef-title-holder';
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('accordions_title_color')) {
           $styles['color'] = qode_startit_options()->getOptionValue('accordions_title_color');
       }
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_accordions_inital_title_color_styles');
}

if(!function_exists('qode_startit_accordions_active_title_color_styles')){
	
	function qode_startit_accordions_active_title_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-active',
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-hover'
		);
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('accordions_title_color_active')) {
           $styles['color'] = qode_startit_options()->getOptionValue('accordions_title_color_active');
       }
		
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_accordions_active_title_color_styles');
}
if(!function_exists('qode_startit_accordions_inital_icon_color_styles')){
	
	function qode_startit_accordions_inital_icon_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-initial .qodef-title-holder .qodef-accordion-mark';
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('accordions_icon_color')) {
           $styles['color'] = qode_startit_options()->getOptionValue('accordions_icon_color');
       }
		if(qode_startit_options()->getOptionValue('accordions_icon_back_color')) {
           $styles['background-color'] = qode_startit_options()->getOptionValue('accordions_icon_back_color');
       }
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_accordions_inital_icon_color_styles');
}
if(!function_exists('qode_startit_accordions_active_icon_color_styles')){
	
	function qode_startit_accordions_active_icon_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-active  .qodef-accordion-mark',
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-hover  .qodef-accordion-mark'
		);
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('accordions_icon_color_active')) {
           $styles['color'] = qode_startit_options()->getOptionValue('accordions_icon_color_active');
       }
		if(qode_startit_options()->getOptionValue('accordions_icon_back_color_active')) {
           $styles['background-color'] = qode_startit_options()->getOptionValue('accordions_icon_back_color_active');
       }
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_accordions_active_icon_color_styles');
}

if(!function_exists('qode_startit_boxed_accordions_inital_color_styles')){
	function qode_startit_boxed_accordions_inital_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-boxed .qodef-title-holder';
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('boxed_accordions_color')) {
           $styles['color'] = qode_startit_options()->getOptionValue('boxed_accordions_color');
           echo qode_startit_dynamic_css('.qodef-accordion-holder.qodef-boxed .qodef-title-holder .qodef-accordion-mark', array('color' => qode_startit_options()->getOptionValue('boxed_accordions_color')));
       }
		if(qode_startit_options()->getOptionValue('boxed_accordions_back_color')) {
           $styles['background-color'] = qode_startit_options()->getOptionValue('boxed_accordions_back_color');
       }
		if(qode_startit_options()->getOptionValue('boxed_accordions_border_color')) {
           $styles['border-color'] = qode_startit_options()->getOptionValue('boxed_accordions_border_color');
       }
		
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_boxed_accordions_inital_color_styles');
}
if(!function_exists('qode_startit_boxed_accordions_active_color_styles')){

	function qode_startit_boxed_accordions_active_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-boxed.ui-accordion .qodef-title-holder.ui-state-active',
			'.qodef-accordion-holder.qodef-boxed.ui-accordion .qodef-title-holder.ui-state-hover'
		);
		$selector_icons = array(
			'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-active .qodef-accordion-mark',
			'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-hover .qodef-accordion-mark'
		);
		$styles = array();
		
		if(qode_startit_options()->getOptionValue('boxed_accordions_color_active')) {
           $styles['color'] = qode_startit_options()->getOptionValue('boxed_accordions_color_active');
           echo qode_startit_dynamic_css($selector_icons, array('color' => qode_startit_options()->getOptionValue('boxed_accordions_color_active')));
       }
		if(qode_startit_options()->getOptionValue('boxed_accordions_back_color_active')) {
           $styles['background-color'] = qode_startit_options()->getOptionValue('boxed_accordions_back_color_active');
       }
		if(qode_startit_options()->getOptionValue('boxed_accordions_border_color_active')) {
           $styles['border-color'] = qode_startit_options()->getOptionValue('boxed_accordions_border_color_active');
       }
		
		echo qode_startit_dynamic_css($selector, $styles);
	}
	add_action('qode_startit_style_dynamic', 'qode_startit_boxed_accordions_active_color_styles');
}