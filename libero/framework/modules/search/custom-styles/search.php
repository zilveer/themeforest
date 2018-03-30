<?php

if (!function_exists('libero_mikado_search_covers_header_style')) {

	function libero_mikado_search_covers_header_style()
	{

		if (libero_mikado_options()->getOptionValue('search_height') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-animated .mkd-form-holder-outer, .mkd-search-slide-header-bottom .mkd-form-holder-outer, .mkd-search-slide-header-bottom', array(
				'height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_covers_header_style');

}

if (!function_exists('libero_mikado_search_opener_icon_size')) {

	function libero_mikado_search_opener_icon_size()
	{

		if (libero_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo libero_mikado_dynamic_css('.mkd-search-opener', array(
				'font-size' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_opener_icon_size');

}

if (!function_exists('libero_mikado_search_opener_icon_colors')) {

	function libero_mikado_search_opener_icon_colors()
	{

		if (libero_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-opener', array(
				'color' => libero_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (libero_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-opener:hover', array(
				'color' => libero_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_opener_icon_colors');

}

if (!function_exists('libero_mikado_search_opener_text_styles')) {

	function libero_mikado_search_opener_text_styles()
	{
		$text_styles = array();

		if (libero_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = libero_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_icon_text_letterspacing')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = libero_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = libero_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = libero_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo libero_mikado_dynamic_css('.mkd-search-icon-text', $text_styles);
		}
		if (libero_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-opener:hover .mkd-search-icon-text', array(
				'color' => libero_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_opener_text_styles');
}

if (!function_exists('libero_mikado_search_opener_spacing')) {

	function libero_mikado_search_opener_spacing()
	{
		$spacing_styles = array();

		if (libero_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo libero_mikado_dynamic_css('.mkd-search-opener', $spacing_styles);
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_opener_spacing');
}

if (!function_exists('libero_mikado_search_bar_background')) {

	function libero_mikado_search_bar_background()
	{

		if (libero_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-header-bottom,body .mkd-search-cover, .mkd-search-fade .mkd-fullscreen-search-holder .mkd-fullscreen-search-table, .mkd-fullscreen-search-overlay, .mkd-search-slide-window-top, .mkd-search-slide-window-top input[type="text"]', array(
				'background-color' => libero_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_bar_background');
}

if (!function_exists('libero_mikado_search_text_styles')) {

	function libero_mikado_search_text_styles()
	{
		$text_styles = array();

		if (libero_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = libero_mikado_options()->getOptionValue('search_text_color');
		}
		if (libero_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = libero_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if (libero_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (libero_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = libero_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if (libero_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = libero_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if (libero_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo libero_mikado_dynamic_css(array(
				'.mkd-search-slide-header-bottom input[type="text"]',
				'body .mkd-search-cover input[type="text"]',
				'.mkd-fullscreen-search-opened .mkd-form-holder .mkd-search-field',
				'.mkd-search-slide-window-top input[type="text"]'), $text_styles);
		}
		if (libero_mikado_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-disabled input[type="text"]::-webkit-input-placeholder, .mkd-search-slide-header-bottom.mkd-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => libero_mikado_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_text_styles');
}

if (!function_exists('libero_mikado_search_label_styles')) {

	function libero_mikado_search_label_styles()
	{
		$text_styles = array();

		if (libero_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = libero_mikado_options()->getOptionValue('search_label_text_color');
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = libero_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = libero_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = libero_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if (libero_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo libero_mikado_dynamic_css('.mkd-fullscreen-search-holder .mkd-search-label', $text_styles);
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_label_styles');
}

if (!function_exists('libero_mikado_search_icon_styles')) {

	function libero_mikado_search_icon_styles()
	{

		if (libero_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top > i, .mkd-search-slide-header-bottom .mkd-search-submit i, .mkd-fullscreen-search-holder .mkd-search-submit', array(
				'color' => libero_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if (libero_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top > i:hover, .mkd-search-slide-header-bottom .mkd-search-submit i:hover, .mkd-fullscreen-search-holder .mkd-search-submit:hover', array(
				'color' => libero_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (libero_mikado_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-header-bottom.mkd-disabled .mkd-search-submit i, .mkd-search-slide-header-bottom.mkd-disabled .mkd-search-submit i:hover', array(
				'color' => libero_mikado_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if (libero_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top > i, .mkd-search-slide-header-bottom .mkd-search-submit i, .mkd-fullscreen-search-holder .mkd-search-submit', array(
				'font-size' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_icon_styles');
}

if (!function_exists('libero_mikado_search_close_icon_styles')) {

	function libero_mikado_search_close_icon_styles()
	{

		if (libero_mikado_options()->getOptionValue('search_close_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i, body .mkd-search-cover .mkd-search-close i, .mkd-fullscreen-search-close i', array(
				'color' => libero_mikado_options()->getOptionValue('search_close_color')
			));
		}
		if (libero_mikado_options()->getOptionValue('search_close_hover_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i:hover, body .mkd-search-cover .mkd-search-close i:hover, .mkd-fullscreen-search-close i:hover', array(
				'color' => libero_mikado_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (libero_mikado_options()->getOptionValue('search_close_size') !== '') {
			echo libero_mikado_dynamic_css('.mkd-search-slide-window-top .mkd-search-close i, body .mkd-search-cover .mkd-search-close i, .mkd-fullscreen-search-close i', array(
				'font-size' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_search_close_icon_styles');
}

?>
