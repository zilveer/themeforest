<?php

if (!function_exists('qode_startit_search_covers_header_style')) {

	function qode_startit_search_covers_header_style()
	{

		if (qode_startit_options()->getOptionValue('search_height') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-header-bottom.qodef-animated .qodef-form-holder-outer, .qodef-search-slide-header-bottom .qodef-form-holder-outer, .qodef-search-slide-header-bottom', array(
				'height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_covers_header_style');

}

if (!function_exists('qode_startit_search_opener_icon_size')) {

	function qode_startit_search_opener_icon_size()
	{

		if (qode_startit_options()->getOptionValue('header_search_icon_size')) {
			echo qode_startit_dynamic_css('.qodef-search-opener', array(
				'font-size' => qode_startit_filter_px(qode_startit_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_opener_icon_size');

}

if (!function_exists('qode_startit_search_opener_icon_colors')) {

	function qode_startit_search_opener_icon_colors()
	{

		if (qode_startit_options()->getOptionValue('header_search_icon_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-opener', array(
				'color' => qode_startit_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (qode_startit_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (qode_startit_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-light-header .qodef-top-bar .qodef-search-opener', array(
				'color' => qode_startit_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (qode_startit_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-light-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (qode_startit_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener', array(
				'color' => qode_startit_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (qode_startit_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_opener_icon_colors');

}

if (!function_exists('qode_startit_search_opener_icon_background_colors')) {

	function qode_startit_search_opener_icon_background_colors()
	{

		if (qode_startit_options()->getOptionValue('search_icon_background_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-opener', array(
				'background-color' => qode_startit_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (qode_startit_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-opener:hover', array(
				'background-color' => qode_startit_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_opener_icon_background_colors');
}

if (!function_exists('qode_startit_search_opener_text_styles')) {

	function qode_startit_search_opener_text_styles()
	{
		$text_styles = array();

		if (qode_startit_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = qode_startit_options()->getOptionValue('search_icon_text_color');
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = qode_startit_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = qode_startit_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = qode_startit_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo qode_startit_dynamic_css('.qodef-search-icon-text', $text_styles);
		}
		if (qode_startit_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => qode_startit_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_opener_text_styles');
}

if (!function_exists('qode_startit_search_opener_spacing')) {

	function qode_startit_search_opener_spacing()
	{
		$spacing_styles = array();

		if (qode_startit_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo qode_startit_dynamic_css('.qodef-search-opener', $spacing_styles);
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_opener_spacing');
}

if (!function_exists('qode_startit_search_bar_background')) {

	function qode_startit_search_bar_background()
	{

		if (qode_startit_options()->getOptionValue('search_background_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-header-bottom, .qodef-search-cover,.qodef-header-overlapping .qodef-search-cover .qodef-form-holder-outer, .qodef-search-fade .qodef-fullscreen-search-holder .qodef-fullscreen-search-table, .qodef-fullscreen-search-overlay, .qodef-search-slide-window-top, .qodef-search-slide-window-top input[type="text"]', array(
				'background-color' => qode_startit_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_bar_background');
}

if (!function_exists('qode_startit_search_text_styles')) {

	function qode_startit_search_text_styles()
	{
		$text_styles = array();

		if (qode_startit_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = qode_startit_options()->getOptionValue('search_text_color');
		}
		if (qode_startit_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = qode_startit_options()->getOptionValue('search_text_texttransform');
		}
		if (qode_startit_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (qode_startit_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = qode_startit_options()->getOptionValue('search_text_fontstyle');
		}
		if (qode_startit_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = qode_startit_options()->getOptionValue('search_text_fontweight');
		}
		if (qode_startit_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo qode_startit_dynamic_css('.qodef-search-slide-header-bottom input[type="text"], .qodef-search-cover input[type="text"], .qodef-fullscreen-search-holder .qodef-search-field, .qodef-search-slide-window-top input[type="text"]', $text_styles);
		}
		if (qode_startit_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-header-bottom.qodef-disabled input[type="text"]::-webkit-input-placeholder, .qodef-search-slide-header-bottom.qodef-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => qode_startit_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_text_styles');
}

if (!function_exists('qode_startit_search_label_styles')) {

	function qode_startit_search_label_styles()
	{
		$text_styles = array();

		if (qode_startit_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = qode_startit_options()->getOptionValue('search_label_text_color');
		}
		if (qode_startit_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (qode_startit_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = qode_startit_options()->getOptionValue('search_label_text_texttransform');
		}
		if (qode_startit_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (qode_startit_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = qode_startit_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (qode_startit_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = qode_startit_options()->getOptionValue('search_label_text_fontweight');
		}
		if (qode_startit_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo qode_startit_dynamic_css('.qodef-fullscreen-search-holder .qodef-search-label', $text_styles);
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_label_styles');
}

if (!function_exists('qode_startit_search_icon_styles')) {

	function qode_startit_search_icon_styles()
	{

		if (qode_startit_options()->getOptionValue('search_icon_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'color' => qode_startit_options()->getOptionValue('search_icon_color')
			));
		}
		if (qode_startit_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top > i:hover, .qodef-search-slide-header-bottom .qodef-search-submit i:hover, .qodef-fullscreen-search-holder .qodef-search-submit:hover', array(
				'color' => qode_startit_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (qode_startit_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i, .qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i:hover', array(
				'color' => qode_startit_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if (qode_startit_options()->getOptionValue('search_icon_size') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'font-size' => qode_startit_filter_px(qode_startit_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_icon_styles');
}

if (!function_exists('qode_startit_search_close_icon_styles')) {

	function qode_startit_search_close_icon_styles()
	{

		if (qode_startit_options()->getOptionValue('search_close_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i, .qodef-search-cover .qodef-search-close i, .qodef-fullscreen-search-close i', array(
				'color' => qode_startit_options()->getOptionValue('search_close_color')
			));
		}
		if (qode_startit_options()->getOptionValue('search_close_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i:hover, .qodef-search-cover .qodef-search-close i:hover, .qodef-fullscreen-search-close i:hover', array(
				'color' => qode_startit_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (qode_startit_options()->getOptionValue('search_close_size') !== '') {
			echo qode_startit_dynamic_css('.qodef-search-slide-window-top .qodef-search-close i, .qodef-search-cover .qodef-search-close i, .qodef-fullscreen-search-close i', array(
				'font-size' => qode_startit_filter_px(qode_startit_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_search_close_icon_styles');
}

?>
