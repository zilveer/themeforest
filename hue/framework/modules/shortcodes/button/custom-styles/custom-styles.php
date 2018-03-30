<?php

if(!function_exists('hue_mikado_button_typography_styles')) {
	/**
	 * Typography styles for all button types
	 */
	function hue_mikado_button_typography_styles() {
		$selector = '.mkd-btn';
		$styles   = array();

		$font_family = hue_mikado_options()->getOptionValue('button_font_family');
		if(hue_mikado_is_font_option_valid($font_family)) {
			$styles['font-family'] = hue_mikado_get_font_option_val($font_family);
		}

		$text_transform = hue_mikado_options()->getOptionValue('button_text_transform');
		if(!empty($text_transform)) {
			$styles['text-transform'] = $text_transform;
		}

		$font_style = hue_mikado_options()->getOptionValue('button_font_style');
		if(!empty($font_style)) {
			$styles['font-style'] = $font_style;
		}

		$letter_spacing = hue_mikado_options()->getOptionValue('button_letter_spacing');
		if($letter_spacing !== '') {
			$styles['letter-spacing'] = hue_mikado_filter_px($letter_spacing).'px';
		}

		$font_weight = hue_mikado_options()->getOptionValue('button_font_weight');
		if(!empty($font_weight)) {
			$styles['font-weight'] = $font_weight;
		}

		echo hue_mikado_dynamic_css($selector, $styles);
	}

	add_action('hue_mikado_style_dynamic', 'hue_mikado_button_typography_styles');
}

if(!function_exists('hue_mikado_button_outline_styles')) {
	/**
	 * Generate styles for outline button
	 */
	function hue_mikado_button_outline_styles() {
		//outline styles
		$outline_styles   = array();
		$outline_selector = '.mkd-btn.mkd-btn-outline';

		if(hue_mikado_options()->getOptionValue('btn_outline_text_color')) {
			$outline_styles['color'] = hue_mikado_options()->getOptionValue('btn_outline_text_color');
		}

		if(hue_mikado_options()->getOptionValue('btn_outline_border_color')) {
			$outline_styles['border-color'] = hue_mikado_options()->getOptionValue('btn_outline_border_color');
		}

		echo hue_mikado_dynamic_css($outline_selector, $outline_styles);

		//outline hover styles
		if(hue_mikado_options()->getOptionValue('btn_outline_hover_text_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-color):hover',
				array('color' => hue_mikado_options()->getOptionValue('btn_outline_hover_text_color').'!important')
			);
		}

		if(hue_mikado_options()->getOptionValue('btn_outline_hover_bg_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-bg):hover',
				array('background-color' => hue_mikado_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
			);
		}

		if(hue_mikado_options()->getOptionValue('btn_outline_hover_border_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover',
				array('border-color' => hue_mikado_options()->getOptionValue('btn_outline_hover_border_color').'!important')
			);
		}
	}

	add_action('hue_mikado_style_dynamic', 'hue_mikado_button_outline_styles');
}

if(!function_exists('hue_mikado_button_solid_styles')) {
	/**
	 * Generate styles for solid type buttons
	 */
	function hue_mikado_button_solid_styles() {
		//solid styles
		$solid_selector = '.mkd-btn.mkd-btn-solid';
		$solid_styles   = array();

		if(hue_mikado_options()->getOptionValue('btn_solid_text_color')) {
			$solid_styles['color'] = hue_mikado_options()->getOptionValue('btn_solid_text_color');
		}

		if(hue_mikado_options()->getOptionValue('btn_solid_border_color')) {
			$solid_styles['border-color'] = hue_mikado_options()->getOptionValue('btn_solid_border_color');
		}

		if(hue_mikado_options()->getOptionValue('btn_solid_bg_color')) {
			$solid_styles['background-color'] = hue_mikado_options()->getOptionValue('btn_solid_bg_color');
		}

		echo hue_mikado_dynamic_css($solid_selector, $solid_styles);

		//solid hover styles
		if(hue_mikado_options()->getOptionValue('btn_solid_hover_text_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-color):hover',
				array('color' => hue_mikado_options()->getOptionValue('btn_solid_hover_text_color').'!important')
			);
		}

		if(hue_mikado_options()->getOptionValue('btn_solid_hover_bg_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover',
				array('background-color' => hue_mikado_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
			);
		}

		if(hue_mikado_options()->getOptionValue('btn_solid_hover_border_color')) {
			echo hue_mikado_dynamic_css(
				'.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover',
				array('border-color' => hue_mikado_options()->getOptionValue('btn_solid_hover_border_color').'!important')
			);
		}
	}

	add_action('hue_mikado_style_dynamic', 'hue_mikado_button_solid_styles');
}