<?php

if (!function_exists('qode_startit_fullscreen_menu_general_styles')) {

	function qode_startit_fullscreen_menu_general_styles()
	{
		$fullscreen_menu_background_color = '';
		if (qode_startit_options()->getOptionValue('fullscreen_alignment') !== '') {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu ul li, .qodef-fullscreen-above-menu-widget-holder, .qodef-fullscreen-below-menu-widget-holder', array(
				'text-align' => qode_startit_options()->getOptionValue('fullscreen_alignment')
			));
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_background_color') !== '') {
			$fullscreen_menu_background_color = qode_startit_hex2rgb(qode_startit_options()->getOptionValue('fullscreen_menu_background_color'));
			if (qode_startit_options()->getOptionValue('fullscreen_menu_background_transparency') !== '') {
				$fullscreen_menu_background_transparency = qode_startit_options()->getOptionValue('fullscreen_menu_background_transparency');
			} else {
				$fullscreen_menu_background_transparency = 0.9;
			}
		}

		if ($fullscreen_menu_background_color !== '') {
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-color' => 'rgba(' . $fullscreen_menu_background_color[0] . ',' . $fullscreen_menu_background_color[1] . ',' . $fullscreen_menu_background_color[2] . ',' . $fullscreen_menu_background_transparency . ')'
			));
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_background_image') !== '') {
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-image' => 'url(' . qode_startit_options()->getOptionValue('fullscreen_menu_background_image') . ')',
				'background-position' => 'center 0',
				'background-repeat' => 'no-repeat'
			));
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_pattern_image') !== '') {
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-holder', array(
				'background-image' => 'url(' . qode_startit_options()->getOptionValue('fullscreen_menu_pattern_image') . ')',
				'background-repeat' => 'repeat',
				'background-position' => '0 0'
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_general_styles');

}

if (!function_exists('qode_startit_fullscreen_menu_first_level_style')) {

	function qode_startit_fullscreen_menu_first_level_style()
	{

		$first_menu_style = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_color') !== '') {
			$first_menu_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_color');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts') !== '-1') {
			$first_menu_style['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts')) . ',sans-serif';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontsize') !== '') {
			$first_menu_style['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_fontsize')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_lineheight') !== '') {
			$first_menu_style['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_lineheight')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle') !== '') {
			$first_menu_style['font-style'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontweight') !== '') {
			$first_menu_style['font-weight'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontweight');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing') !== '') {
			$first_menu_style['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_texttransform') !== '') {
			$first_menu_style['text-transform'] = qode_startit_options()->getOptionValue('fullscreen_menu_texttransform');
		}

		if (!empty($first_menu_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu > ul > li > a, nav.qodef-fullscreen-menu > ul > li > h6', $first_menu_style);
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener.opened .qodef-line:after, .qodef-fullscreen-menu-opener.opened .qodef-line:before', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_color')
			));
		}

		$first_menu_hover_style = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_color') !== '') {
			$first_menu_hover_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_color');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color') !== '') {
			$first_menu_hover_style['background-color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color');
		}

		if (!empty($first_menu_hover_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu > ul > li > a:hover, nav.qodef-fullscreen-menu > ul > li > h6:hover', $first_menu_hover_style);
		}

		$first_menu_active_style = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_active_color') !== '') {
			$first_menu_active_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_active_color');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_active_background_color') !== '') {
			$first_menu_active_style['background-color'] = qode_startit_options()->getOptionValue('fullscreen_menu_active_background_color');
		}

		if (!empty($first_menu_active_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu > ul > li > a.current', $first_menu_active_style);
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_first_level_style');

}

if (!function_exists('qode_startit_fullscreen_menu_second_level_style')) {

	function qode_startit_fullscreen_menu_second_level_style()
	{
		$second_menu_style = array();
		if (qode_startit_options()->getOptionValue('fullscreen_menu_color_2nd') !== '') {
			$second_menu_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_color_2nd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts_2nd') !== '-1') {
			$second_menu_style['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts_2nd')) . ',sans-serif';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontsize_2nd') !== '') {
			$second_menu_style['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_fontsize_2nd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_lineheight_2nd') !== '') {
			$second_menu_style['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_lineheight_2nd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle_2nd') !== '') {
			$second_menu_style['font-style'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle_2nd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontweight_2nd') !== '') {
			$second_menu_style['font-weight'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontweight_2nd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing_2nd') !== '') {
			$second_menu_style['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing_2nd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_texttransform_2nd') !== '') {
			$second_menu_style['text-transform'] = qode_startit_options()->getOptionValue('fullscreen_menu_texttransform_2nd');
		}

		if (!empty($second_menu_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu ul li ul li a, nav.qodef-fullscreen-menu ul li ul li h6', $second_menu_style);
		}

		$second_menu_hover_style = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_color_2nd') !== '') {
			$second_menu_hover_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_color_2nd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color_2nd') !== '') {
			$second_menu_hover_style['background-color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color_2nd');
		}

		if (!empty($second_menu_hover_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu ul li ul li a:hover, nav.qodef-fullscreen-menu ul li ul li h6:hover', $second_menu_hover_style);
		}
	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_second_level_style');

}

if (!function_exists('qode_startit_fullscreen_menu_third_level_style')) {

	function qode_startit_fullscreen_menu_third_level_style()
	{
		$third_menu_style = array();
		if (qode_startit_options()->getOptionValue('fullscreen_menu_color_3rd') !== '') {
			$third_menu_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_color_3rd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts_3rd') !== '-1') {
			$third_menu_style['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('fullscreen_menu_google_fonts_3rd')) . ',sans-serif';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontsize_3rd') !== '') {
			$third_menu_style['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_fontsize_3rd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_lineheight_3rd') !== '') {
			$third_menu_style['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_lineheight_3rd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle_3rd') !== '') {
			$third_menu_style['font-style'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontstyle_3rd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_fontweight_3rd') !== '') {
			$third_menu_style['font-weight'] = qode_startit_options()->getOptionValue('fullscreen_menu_fontweight_3rd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing_3rd') !== '') {
			$third_menu_style['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_letterspacing_3rd')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_texttransform_3rd') !== '') {
			$third_menu_style['text-transform'] = qode_startit_options()->getOptionValue('fullscreen_menu_texttransform_3rd');
		}

		if (!empty($third_menu_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu ul li ul li ul li a', $third_menu_style);
		}

		$third_menu_hover_style = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_color_3rd') !== '') {
			$third_menu_hover_style['color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_color_3rd');
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color_3rd') !== '') {
			$third_menu_hover_style['background-color'] = qode_startit_options()->getOptionValue('fullscreen_menu_hover_background_color_3rd');
		}

		if (!empty($third_menu_hover_style)) {
			echo qode_startit_dynamic_css('nav.qodef-fullscreen-menu ul li ul li ul li a:hover', $third_menu_hover_style);
		}
	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_third_level_style');

}

if (!function_exists('qode_startit_fullscreen_menu_icon_styles')) {

	function qode_startit_fullscreen_menu_icon_styles()
	{

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_icon_color')
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener:hover .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_icon_hover_color')
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_light_icon_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-fullscreen-menu-opener:not(.opened) .qodef-line,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-fullscreen-menu-opener:not(.opened) .qodef-line,
			.qodef-light-header .qodef-top-bar .qodef-fullscreen-menu-opener:not(.opened) .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_light_icon_color') . ' !important'
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_light_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line,
			.qodef-light-header .qodef-top-bar .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_light_icon_hover_color') . ' !important'
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_dark_icon_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-fullscreen-menu-opener:not(.opened) .qodef-line,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-fullscreen-menu-opener:not(.opened) .qodef-line,
			.qodef-dark-header .qodef-top-bar .qodef-fullscreen-menu-opener:not(.opened) .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_dark_icon_color') . ' !important'
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_dark_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line,
			.qodef-dark-header .qodef-top-bar .qodef-fullscreen-menu-opener:not(.opened):hover .qodef-line', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_dark_icon_hover_color') . ' !important'
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_background_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener', array(
				'-webkit-backface-visibility' => 'hidden',
				'display' => 'inline-block'
			));
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener.normal', array(
				'padding' => '10px 15px',
			));
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener.medium', array(
				'padding' => '10px 13px',
			));
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener.large', array(
				'padding' => '15px',
			));
			echo qode_startit_dynamic_css('.qodef-fullscreen-menu-opener:not(.opened)', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_icon_background_color')
			));

		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_background_hover_color') !== '') {

			qode_startit_dynamic_css('.qodef-fullscreen-menu-opener.normal:not(.opened):hover, .qodef-fullscreen-menu-opener.medium:not(.opened):hover, .qodef-fullscreen-menu-opener.large:not(.opened):hover', array(
				'background-color' => qode_startit_options()->getOptionValue('fullscreen_menu_icon_background_hover_color')
			));

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_icon_styles');

}

if (!function_exists('qode_startit_fullscreen_menu_icon_spacing')) {

	function qode_startit_fullscreen_menu_icon_spacing()
	{

		$fullscreen_menu_icon_spacing = array();

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_padding_left') !== '') {
			$fullscreen_menu_icon_spacing['padding-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_icon_padding_left')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_padding_right') !== '') {
			$fullscreen_menu_icon_spacing['padding-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_icon_padding_right')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_margin_left') !== '') {
			$fullscreen_menu_icon_spacing['margin-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_icon_margin_left')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('fullscreen_menu_icon_margin_right') !== '') {
			$fullscreen_menu_icon_spacing['margin-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('fullscreen_menu_icon_margin_right')) . 'px';
		}

		if (!empty($fullscreen_menu_icon_spacing)) {
			echo qode_startit_dynamic_css('a.qodef-fullscreen-menu-opener', $fullscreen_menu_icon_spacing);
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_fullscreen_menu_icon_spacing');

}