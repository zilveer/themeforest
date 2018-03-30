<?php 

if(!function_exists('suprema_qodef_accordions_typography_styles')){
	function suprema_qodef_accordions_typography_styles(){
		$selector = '.qodef-accordion-holder .qodef-title-holder';		
		$styles = array();
		
		$font_family = suprema_qodef_options()->getOptionValue('accordions_font_family');
		if(suprema_qodef_is_font_option_valid($font_family)){
			$styles['font-family'] = suprema_qodef_get_font_option_val($font_family);
		}
		
		$text_transform = suprema_qodef_options()->getOptionValue('accordions_text_transform');
       if(!empty($text_transform)) {
           $styles['text-transform'] = $text_transform;
       }

       $font_style = suprema_qodef_options()->getOptionValue('accordions_font_style');
       if(!empty($font_style)) {
           $styles['font-style'] = $font_style;
       }

       $letter_spacing = suprema_qodef_options()->getOptionValue('accordions_letter_spacing');
       if($letter_spacing !== '') {
           $styles['letter-spacing'] = suprema_qodef_filter_px($letter_spacing).'px';
       }

       $font_weight = suprema_qodef_options()->getOptionValue('accordions_font_weight');
       if(!empty($font_weight)) {
           $styles['font-weight'] = $font_weight;
       }

       echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_accordions_typography_styles');
}

if(!function_exists('suprema_qodef_accordions_inital_title_color_styles')){
	function suprema_qodef_accordions_inital_title_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-initial .qodef-title-holder';
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('accordions_title_color')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('accordions_title_color');
       }
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_accordions_inital_title_color_styles');
}

if(!function_exists('suprema_qodef_accordions_active_title_color_styles')){
	
	function suprema_qodef_accordions_active_title_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-active',
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-hover'
		);
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('accordions_title_color_active')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('accordions_title_color_active');
       }
		
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_accordions_active_title_color_styles');
}
if(!function_exists('suprema_qodef_accordions_inital_icon_color_styles')){
	
	function suprema_qodef_accordions_inital_icon_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-initial .qodef-title-holder .qodef-accordion-mark';
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('accordions_icon_color')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('accordions_icon_color');
       }
		if(suprema_qodef_options()->getOptionValue('accordions_icon_back_color')) {
           $styles['background-color'] = suprema_qodef_options()->getOptionValue('accordions_icon_back_color');
       }
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_accordions_inital_icon_color_styles');
}
if(!function_exists('suprema_qodef_accordions_active_icon_color_styles')){
	
	function suprema_qodef_accordions_active_icon_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-active  .qodef-accordion-mark',
			'.qodef-accordion-holder.qodef-initial .qodef-title-holder.ui-state-hover  .qodef-accordion-mark'
		);
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('accordions_icon_color_active')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('accordions_icon_color_active');
       }
		if(suprema_qodef_options()->getOptionValue('accordions_icon_back_color_active')) {
           $styles['background-color'] = suprema_qodef_options()->getOptionValue('accordions_icon_back_color_active');
       }
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_accordions_active_icon_color_styles');
}

if(!function_exists('suprema_qodef_boxed_accordions_inital_color_styles')){
	function suprema_qodef_boxed_accordions_inital_color_styles(){
		$selector = '.qodef-accordion-holder.qodef-boxed .qodef-title-holder';
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_color')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_color');
           echo suprema_qodef_dynamic_css('.qodef-accordion-holder.qodef-boxed .qodef-title-holder .qodef-accordion-mark', array('color' => suprema_qodef_options()->getOptionValue('boxed_accordions_color')));
       }
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_back_color')) {
           $styles['background-color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_back_color');
       }
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_border_color')) {
           $styles['border-color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_border_color');
       }
		
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_boxed_accordions_inital_color_styles');
}
if(!function_exists('suprema_qodef_boxed_accordions_active_color_styles')){

	function suprema_qodef_boxed_accordions_active_color_styles(){
		$selector = array(
			'.qodef-accordion-holder.qodef-boxed.ui-accordion .qodef-title-holder.ui-state-active',
			'.qodef-accordion-holder.qodef-boxed.ui-accordion .qodef-title-holder.ui-state-hover'
		);
		$selector_icons = array(
			'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-active .qodef-accordion-mark',
			'.qodef-accordion-holder.qodef-boxed .qodef-title-holder.ui-state-hover .qodef-accordion-mark'
		);
		$styles = array();
		
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_color_active')) {
           $styles['color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_color_active');
           echo suprema_qodef_dynamic_css($selector_icons, array('color' => suprema_qodef_options()->getOptionValue('boxed_accordions_color_active')));
       }
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_back_color_active')) {
           $styles['background-color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_back_color_active');
       }
		if(suprema_qodef_options()->getOptionValue('boxed_accordions_border_color_active')) {
           $styles['border-color'] = suprema_qodef_options()->getOptionValue('boxed_accordions_border_color_active');
       }
		
		echo suprema_qodef_dynamic_css($selector, $styles);
	}
	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_boxed_accordions_active_color_styles');
}