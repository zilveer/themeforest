<?php

if (!function_exists('suprema_qodef_search_covers_header_style')) {

	function suprema_qodef_search_covers_header_style()
	{

		if (suprema_qodef_options()->getOptionValue('search_height') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-header-bottom.qodef-animated .qodef-form-holder-outer, .qodef-search-slide-header-bottom .qodef-form-holder-outer, .qodef-search-slide-header-bottom', array(
				'height' => suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_covers_header_style');

}

if (!function_exists('suprema_qodef_search_opener_icon_size')) {

	function suprema_qodef_search_opener_icon_size()
	{

		if (suprema_qodef_options()->getOptionValue('header_search_icon_size')) {
			echo suprema_qodef_dynamic_css('.qodef-search-opener', array(
				'font-size' => suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_opener_icon_size');

}

if (!function_exists('suprema_qodef_search_opener_icon_colors')) {

	function suprema_qodef_search_opener_icon_colors()
	{

		if (suprema_qodef_options()->getOptionValue('header_search_icon_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-opener', array(
				'color' => suprema_qodef_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-opener:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-light-header .qodef-top-bar .qodef-search-opener', array(
				'color' => suprema_qodef_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (suprema_qodef_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-light-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (suprema_qodef_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener', array(
				'color' => suprema_qodef_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (suprema_qodef_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-search-opener:hover,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-search-opener:hover,
			.qodef-dark-header .qodef-top-bar .qodef-search-opener:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_opener_icon_colors');

}

if (!function_exists('suprema_qodef_search_opener_icon_background_colors')) {

	function suprema_qodef_search_opener_icon_background_colors()
	{

		if (suprema_qodef_options()->getOptionValue('search_icon_background_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-opener', array(
				'background-color' => suprema_qodef_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-opener:hover', array(
				'background-color' => suprema_qodef_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_opener_icon_background_colors');
}

if (!function_exists('suprema_qodef_search_opener_text_styles')) {

	function suprema_qodef_search_opener_text_styles()
	{
		$text_styles = array();

		if (suprema_qodef_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = suprema_qodef_options()->getOptionValue('search_icon_text_color');
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = suprema_qodef_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo suprema_qodef_dynamic_css('.qodef-search-icon-text', $text_styles);
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-opener:hover .qodef-search-icon-text', array(
				'color' => suprema_qodef_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_opener_text_styles');
}

if (!function_exists('suprema_qodef_search_opener_spacing')) {

	function suprema_qodef_search_opener_spacing()
	{
		$spacing_styles = array();

		if (suprema_qodef_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo suprema_qodef_dynamic_css('.qodef-search-opener', $spacing_styles);
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_opener_spacing');
}

if (!function_exists('suprema_qodef_search_bar_background')) {

	function suprema_qodef_search_bar_background()
	{

		if (suprema_qodef_options()->getOptionValue('search_background_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-header-bottom, .qodef-search-cover, .qodef-search-cover .qodef-container, .qodef-search-fade .qodef-fullscreen-search-holder .qodef-fullscreen-search-table, .qodef-fullscreen-search-overlay, .qodef-search-slide-window-top, .qodef-search-slide-window-top input[type="text"]', array(
				'background-color' => suprema_qodef_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_bar_background');
}

if (!function_exists('suprema_qodef_search_text_styles')) {

	function suprema_qodef_search_text_styles()
	{
		$text_styles = array();

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = suprema_qodef_options()->getOptionValue('search_text_color');
		}
		if (suprema_qodef_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('search_text_texttransform');
		}
		if (suprema_qodef_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (suprema_qodef_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = suprema_qodef_options()->getOptionValue('search_text_fontstyle');
		}
		if (suprema_qodef_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('search_text_fontweight');
		}
		if (suprema_qodef_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-header-bottom input[type="text"], .qodef-search-cover input[type="text"], .qodef-fullscreen-search-holder .qodef-search-field, .qodef-search-slide-window-top input[type="text"], .qodef-fullscreen-search-opened .qodef-form-holder .qodef-search-field, .qodef-fullscreen-search-holder .qodef-search-field', $text_styles);
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qode_search_field::-webkit-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qode_search_field::-moz-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qode_search_field:-ms-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-field::-webkit-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-field::-moz-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

		if (suprema_qodef_options()->getOptionValue('search_text_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-field:-ms-input-placeholder', array(
				'color' => suprema_qodef_options()->getOptionValue('search_text_color')
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_text_styles');
}

if (!function_exists('suprema_qodef_search_label_styles')) {

	function suprema_qodef_search_label_styles()
	{
		$text_styles = array();

		if (suprema_qodef_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = suprema_qodef_options()->getOptionValue('search_label_text_color');
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('search_label_text_texttransform');
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = suprema_qodef_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('search_label_text_fontweight');
		}
		if (suprema_qodef_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo suprema_qodef_dynamic_css('.qodef-fullscreen-search-holder .qodef-search-label', $text_styles);
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_label_styles');
}

if (!function_exists('suprema_qodef_search_icon_styles')) {

	function suprema_qodef_search_icon_styles()
	{

		if (suprema_qodef_options()->getOptionValue('search_icon_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'color' => suprema_qodef_options()->getOptionValue('search_icon_color')
			));
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-window-top > i:hover, .qodef-search-slide-header-bottom .qodef-search-submit i:hover, .qodef-fullscreen-search-holder .qodef-search-submit:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i, .qodef-search-slide-header-bottom.qodef-disabled .qodef-search-submit i:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if (suprema_qodef_options()->getOptionValue('search_icon_size') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-slide-window-top > i, .qodef-search-slide-header-bottom .qodef-search-submit i, .qodef-fullscreen-search-holder .qodef-search-submit', array(
				'font-size' => suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_icon_styles');
}

if (!function_exists('suprema_qodef_search_close_icon_styles')) {

	function suprema_qodef_search_close_icon_styles()
	{

		if (suprema_qodef_options()->getOptionValue('search_close_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-cover .qodef-search-close a, .qodef-search-fade .qodef-fullscreen-search-close', array(
				'color' => suprema_qodef_options()->getOptionValue('search_close_color')
			));
		}
		if (suprema_qodef_options()->getOptionValue('search_close_hover_color') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-cover .qodef-search-close a:hover, .qodef-search-fade .qodef-fullscreen-search-close:hover', array(
				'color' => suprema_qodef_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (suprema_qodef_options()->getOptionValue('search_close_size') !== '') {
			echo suprema_qodef_dynamic_css('.qodef-search-cover .qodef-search-close a, .qodef-search-fade .qodef-fullscreen-search-close', array(
				'font-size' => suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('suprema_qodef_style_dynamic', 'suprema_qodef_search_close_icon_styles', 13);
}

?>
