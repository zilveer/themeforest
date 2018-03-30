<?php

if (!function_exists('qode_startit_side_area_slide_from_right_type_style')) {

	function qode_startit_side_area_slide_from_right_type_style()
	{

		if (qode_startit_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if (qode_startit_options()->getOptionValue('side_area_width') !== '' && qode_startit_options()->getOptionValue('side_area_width') >= 30) {
				echo qode_startit_dynamic_css('.qodef-side-menu-slide-from-right .qodef-side-menu', array(
					'right' => qode_startit_options()->getOptionValue('side_area_width') . '%',
					'width' => qode_startit_options()->getOptionValue('side_area_width') . '%'
				));
			}

			if (qode_startit_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo qode_startit_dynamic_css('.qodef-side-menu-slide-from-right .qodef-wrapper .qodef-cover', array(
					'background-color' => qode_startit_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if (qode_startit_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo qode_startit_dynamic_css('.qodef-side-menu-slide-from-right.qodef-right-side-menu-opened .qodef-wrapper .qodef-cover', array(
					'opacity' => qode_startit_options()->getOptionValue('side_area_content_overlay_opacity')
				));

			}
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_slide_from_right_type_style');

}

if (!function_exists('qode_startit_side_area_icon_color_styles')) {

	function qode_startit_side_area_icon_color_styles()
	{

		if (qode_startit_options()->getOptionValue('side_area_icon_font_size') !== '') {

			echo qode_startit_dynamic_css('a.qodef-side-menu-button-opener', array(
				'font-size' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_font_size')) . 'px'
			));

			if (qode_startit_options()->getOptionValue('side_area_icon_font_size') > 30) {
				echo '@media only screen and (max-width: 480px) {
						a.qodef-side-menu-button-opener {
						font-size: 30px;
						}
					}';
			}

		}

		if (qode_startit_options()->getOptionValue('side_area_icon_color') !== '') {

			echo qode_startit_dynamic_css('a.qodef-side-menu-button-opener', array(
				'color' => qode_startit_options()->getOptionValue('side_area_icon_color')
			));

		}
		if (qode_startit_options()->getOptionValue('side_area_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('a.qodef-side-menu-button-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('side_area_icon_hover_color')
			));

		}
		if (qode_startit_options()->getOptionValue('side_area_light_icon_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-side-menu-button-opener,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-side-menu-button-opener,
			.qodef-light-header .qodef-top-bar .qodef-side-menu-button-opener', array(
				'color' => qode_startit_options()->getOptionValue('side_area_light_icon_color') . ' !important'
			));

		}
		if (qode_startit_options()->getOptionValue('side_area_light_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-light-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-side-menu-button-opener:hover,
			.qodef-light-header.qodef-header-style-on-scroll .qodef-page-header .qodef-side-menu-button-opener:hover,
			.qodef-light-header .qodef-top-bar .qodef-side-menu-button-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('side_area_light_icon_hover_color') . ' !important'
			));

		}
		if (qode_startit_options()->getOptionValue('side_area_dark_icon_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-side-menu-button-opener,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-side-menu-button-opener,
			.qodef-dark-header .qodef-top-bar .qodef-side-menu-button-opener', array(
				'color' => qode_startit_options()->getOptionValue('side_area_dark_icon_color') . ' !important'
			));

		}
		if (qode_startit_options()->getOptionValue('side_area_dark_icon_hover_color') !== '') {

			echo qode_startit_dynamic_css('.qodef-dark-header .qodef-page-header > div:not(.qodef-sticky-header) .qodef-side-menu-button-opener:hover,
			.qodef-dark-header.qodef-header-style-on-scroll .qodef-page-header .qodef-side-menu-button-opener:hover,
			.qodef-dark-header .qodef-top-bar .qodef-side-menu-button-opener:hover', array(
				'color' => qode_startit_options()->getOptionValue('side_area_dark_icon_hover_color') . ' !important'
			));

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_icon_color_styles');

}

if (!function_exists('qode_startit_side_area_icon_spacing_styles')) {

	function qode_startit_side_area_icon_spacing_styles()
	{
		$icon_spacing = array();

		if (qode_startit_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_padding_left')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_padding_right')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_margin_left')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_margin_right')) . 'px';
		}

		if (!empty($icon_spacing)) {

			echo qode_startit_dynamic_css('a.qodef-side-menu-button-opener', $icon_spacing);

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_icon_spacing_styles');
}

if (!function_exists('qode_startit_side_area_icon_border_styles')) {

	function qode_startit_side_area_icon_border_styles()
	{
		if (qode_startit_options()->getOptionValue('side_area_icon_border_yesno') == 'yes') {

			$side_area_icon_border = array();

			if (qode_startit_options()->getOptionValue('side_area_icon_border_color') !== '') {
				$side_area_icon_border['border-color'] = qode_startit_options()->getOptionValue('side_area_icon_border_color');
			}

			if (qode_startit_options()->getOptionValue('side_area_icon_border_width') !== '') {
				$side_area_icon_border['border-width'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_border_width')) . 'px';
			} else {
				$side_area_icon_border['border-width'] = '1px';
			}

			if (qode_startit_options()->getOptionValue('side_area_icon_border_radius') !== '') {
				$side_area_icon_border['border-radius'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_icon_border_radius')) . 'px';
			}

			if (qode_startit_options()->getOptionValue('side_area_icon_border_style') !== '') {
				$side_area_icon_border['border-style'] = qode_startit_options()->getOptionValue('side_area_icon_border_style');
			} else {
				$side_area_icon_border['border-style'] = 'solid';
			}

			if (!empty($side_area_icon_border)) {
				$side_area_icon_border['-webkit-transition'] = 'all 0.15s ease-out';
				$side_area_icon_border['transition'] = 'all 0.15s ease-out';
				echo qode_startit_dynamic_css('a.qodef-side-menu-button-opener', $side_area_icon_border);
			}

			if (qode_startit_options()->getOptionValue('a.qodef-side-menu-button-opener:hover') !== '') {
				$side_area_icon_border['border-color'] = qode_startit_options()->getOptionValue('side_area_icon_border_hover_color');
			}


		}
	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_icon_border_styles');

}

if (!function_exists('qode_startit_side_area_alignment')) {

	function qode_startit_side_area_alignment()
	{

		if (qode_startit_options()->getOptionValue('side_area_aligment')) {

			echo qode_startit_dynamic_css('.qodef-side-menu-slide-from-right .qodef-side-menu, .qodef-side-menu-slide-with-content .qodef-side-menu, .qodef-side-area-uncovered-from-content .qodef-side-menu', array(
				'text-align' => qode_startit_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_alignment');

}

if (!function_exists('qode_startit_side_area_styles')) {

	function qode_startit_side_area_styles()
	{

		$side_area_styles = array();

		if (qode_startit_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = qode_startit_options()->getOptionValue('side_area_background_color');
		}

		if (qode_startit_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_padding_top')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_padding_right')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_padding_bottom')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_padding_left')) . 'px';
		}

		if (!empty($side_area_styles)) {
			echo qode_startit_dynamic_css('.qodef-side-menu', $side_area_styles);
		}

		if (qode_startit_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo qode_startit_dynamic_css('.qodef-side-menu a.qodef-close-side-menu span, .qodef-side-menu a.qodef-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if (qode_startit_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo qode_startit_dynamic_css('.qodef-side-menu a.qodef-close-side-menu', array(
				'height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'padding' => 0,
			));
			echo qode_startit_dynamic_css('.qodef-side-menu a.qodef-close-side-menu span, .qodef-side-menu a.qodef-close-side-menu i', array(
				'font-size' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_close_icon_size')) . 'px',
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_styles');

}

if (!function_exists('qode_startit_side_area_title_styles')) {

	function qode_startit_side_area_title_styles()
	{

		$title_styles = array();

		if (qode_startit_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = qode_startit_options()->getOptionValue('side_area_title_color');
		}

		if (qode_startit_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_title_fontsize')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_title_lineheight')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = qode_startit_options()->getOptionValue('side_area_title_texttransform');
		}

		if (qode_startit_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
		}

		if (qode_startit_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = qode_startit_options()->getOptionValue('side_area_title_fontstyle');
		}

		if (qode_startit_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = qode_startit_options()->getOptionValue('side_area_title_fontweight');
		}

		if (qode_startit_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
		}

		if (!empty($title_styles)) {

			echo qode_startit_dynamic_css('.qodef-side-menu-title h4, .qodef-side-menu-title h5', $title_styles);

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_title_styles');

}

if (!function_exists('qode_startit_side_area_text_styles')) {

	function qode_startit_side_area_text_styles()
	{
		$text_styles = array();

		if (qode_startit_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
		}

		if (qode_startit_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_text_fontsize')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_text_lineheight')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = qode_startit_options()->getOptionValue('side_area_text_fontweight');
		}

		if (qode_startit_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = qode_startit_options()->getOptionValue('side_area_text_fontstyle');
		}

		if (qode_startit_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = qode_startit_options()->getOptionValue('side_area_text_texttransform');
		}

		if (qode_startit_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = qode_startit_options()->getOptionValue('side_area_text_color');
		}

		if (!empty($text_styles)) {

			echo qode_startit_dynamic_css('.qodef-side-menu .widget, .qodef-side-menu .widget.widget_search form, .qodef-side-menu .widget.widget_search form input[type="text"], .qodef-side-menu .widget.widget_search form input[type="submit"], .qodef-side-menu .widget h6, .qodef-side-menu .widget h6 a, .qodef-side-menu .widget p, .qodef-side-menu .widget li a, .qodef-side-menu .widget.widget_rss li a.rsswidget, .qodef-side-menu #wp-calendar caption,.qodef-side-menu .widget li, .qodef-side-menu h3, .qodef-side-menu .widget.widget_archive select, .qodef-side-menu .widget.widget_categories select, .qodef-side-menu .widget.widget_text select, .qodef-side-menu .widget.widget_search form input[type="submit"], .qodef-side-menu #wp-calendar th, .qodef-side-menu #wp-calendar td, .qodef-side-menu .q_social_icon_holder i.simple_social', $text_styles);

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_text_styles');

}

if (!function_exists('qode_startit_side_area_link_styles')) {

	function qode_startit_side_area_link_styles()
	{
		$link_styles = array();

		if (qode_startit_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = qode_startit_get_formatted_font_family(qode_startit_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('sidearea_link_font_size')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('sidearea_link_line_height')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = qode_startit_filter_px(qode_startit_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = qode_startit_options()->getOptionValue('sidearea_link_font_weight');
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = qode_startit_options()->getOptionValue('sidearea_link_font_style');
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = qode_startit_options()->getOptionValue('sidearea_link_text_transform');
		}

		if (qode_startit_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = qode_startit_options()->getOptionValue('sidearea_link_color');
		}

		if (!empty($link_styles)) {

			echo qode_startit_dynamic_css('.qodef-side-menu .widget li a, .qodef-side-menu .widget a:not(.qbutton)', $link_styles);

		}

		if (qode_startit_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo qode_startit_dynamic_css('.qodef-side-menu .widget a:hover, .qodef-side-menu .widget li:hover, .qodef-side-menu .widget li:hover>a', array(
				'color' => qode_startit_options()->getOptionValue('sidearea_link_hover_color')
			));
		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_link_styles');

}

if (!function_exists('qode_startit_side_area_border_styles')) {

	function qode_startit_side_area_border_styles()
	{

		if (qode_startit_options()->getOptionValue('side_area_enable_bottom_border') == 'yes') {

			if (qode_startit_options()->getOptionValue('side_area_bottom_border_color') !== '') {

				echo qode_startit_dynamic_css('.qodef-side-menu .widget', array(
					'border-bottom:' => '1px solid ' . qode_startit_options()->getOptionValue('side_area_bottom_border_color'),
					'margin-bottom:' => '10px',
					'padding-bottom:' => '10px',
				));

			}

		}

	}

	add_action('qode_startit_style_dynamic', 'qode_startit_side_area_border_styles');

}