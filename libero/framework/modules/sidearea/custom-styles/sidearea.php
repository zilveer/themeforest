<?php

if (!function_exists('libero_mikado_side_area_slide_from_right_type_style')) {

	function libero_mikado_side_area_slide_from_right_type_style()
	{

		if (libero_mikado_options()->getOptionValue('side_area_type') == 'side-menu-slide-from-right') {

			if (libero_mikado_options()->getOptionValue('side_area_width') !== '' && libero_mikado_options()->getOptionValue('side_area_width') >= 30) {
				echo libero_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-side-menu', array(
					'right' => '-'.libero_mikado_options()->getOptionValue('side_area_width') . '%',
					'width' => libero_mikado_options()->getOptionValue('side_area_width') . '%'
				));
			}

			if (libero_mikado_options()->getOptionValue('side_area_content_overlay_color') !== '') {

				echo libero_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-wrapper .mkd-cover', array(
					'background-color' => libero_mikado_options()->getOptionValue('side_area_content_overlay_color')
				));

			}
			if (libero_mikado_options()->getOptionValue('side_area_content_overlay_opacity') !== '') {

				echo libero_mikado_dynamic_css('.mkd-side-menu-slide-from-right.mkd-right-side-menu-opened .mkd-wrapper .mkd-cover', array(
					'opacity' => libero_mikado_options()->getOptionValue('side_area_content_overlay_opacity')
				));

			}
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_slide_from_right_type_style');

}

if (!function_exists('libero_mikado_side_area_icon_color_styles')) {

	function libero_mikado_side_area_icon_color_styles()
	{

		if (libero_mikado_options()->getOptionValue('side_area_icon_color') !== '') {

			echo libero_mikado_dynamic_css('a.mkd-side-menu-button-opener .mkd-lines', array(
				'background-color' => libero_mikado_options()->getOptionValue('side_area_icon_color')
			));

		}
		if (libero_mikado_options()->getOptionValue('side_area_icon_hover_color') !== '') {

			echo libero_mikado_dynamic_css('a.mkd-side-menu-button-opener:hover .mkd-lines', array(
				'background-color' => libero_mikado_options()->getOptionValue('side_area_icon_hover_color')
			));

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_icon_color_styles');

}

if (!function_exists('libero_mikado_side_area_opener_text_styles')) {

    function libero_mikado_side_area_opener_text_styles()
    {
        $text_styles = array();

        if (libero_mikado_options()->getOptionValue('side_area_icon_text_color') !== '') {
            $text_styles['color'] = libero_mikado_options()->getOptionValue('side_area_icon_text_color');
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_fontsize') !== '') {
            $text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_text_fontsize')) . 'px';
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_lineheight') !== '') {
            $text_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_text_lineheight')) . 'px';
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_text_letterspacing')) . 'px';
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_texttransform') !== '') {
            $text_styles['text-transform'] = libero_mikado_options()->getOptionValue('side_area_icon_text_texttransform');
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('side_area_icon_text_google_fonts')) . ', sans-serif';
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_fontstyle') !== '') {
            $text_styles['font-style'] = libero_mikado_options()->getOptionValue('side_area_icon_text_fontstyle');
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_fontweight') !== '') {
            $text_styles['font-weight'] = libero_mikado_options()->getOptionValue('side_area_icon_text_fontweight');
        }

        if (!empty($text_styles)) {
            echo libero_mikado_dynamic_css('.mkd-side-menu-button-opener .mkd-side-area-icon-text', $text_styles);
        }
        if (libero_mikado_options()->getOptionValue('side_area_icon_text_color_hover') !== '') {
            echo libero_mikado_dynamic_css('.mkd-side-menu-button-opener:hover .mkd-side-area-icon-text', array(
                'color' => libero_mikado_options()->getOptionValue('side_area_icon_text_color_hover')
            ));
        }

    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_opener_text_styles');
}

if (!function_exists('libero_mikado_side_area_icon_spacing_styles')) {

	function libero_mikado_side_area_icon_spacing_styles()
	{
		$icon_spacing = array();

		if (libero_mikado_options()->getOptionValue('side_area_icon_padding_left') !== '') {
			$icon_spacing['padding-left'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_padding_left')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_icon_padding_right') !== '') {
			$icon_spacing['padding-right'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_padding_right')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_icon_margin_left') !== '') {
			$icon_spacing['margin-left'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_margin_left')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_icon_margin_right') !== '') {
			$icon_spacing['margin-right'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_icon_margin_right')) . 'px';
		}

		if (!empty($icon_spacing)) {

			echo libero_mikado_dynamic_css('a.mkd-side-menu-button-opener', $icon_spacing);

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_icon_spacing_styles');
}

if (!function_exists('libero_mikado_side_area_alignment')) {

	function libero_mikado_side_area_alignment()
	{

		if (libero_mikado_options()->getOptionValue('side_area_aligment')) {

			echo libero_mikado_dynamic_css('.mkd-side-menu-slide-from-right .mkd-side-menu, .mkd-side-menu-slide-with-content .mkd-side-menu, .mkd-side-area-uncovered-from-content .mkd-side-menu', array(
				'text-align' => libero_mikado_options()->getOptionValue('side_area_aligment')
			));

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_alignment');

}

if (!function_exists('libero_mikado_side_area_styles')) {

	function libero_mikado_side_area_styles()
	{

		$side_area_styles = array();

		if (libero_mikado_options()->getOptionValue('side_area_background_color') !== '') {
			$side_area_styles['background-color'] = libero_mikado_options()->getOptionValue('side_area_background_color');
		}
        if (libero_mikado_options()->getOptionValue('side_area_background_image') !== '') {
            $side_area_styles['background-image'] = 'url('.libero_mikado_options()->getOptionValue('side_area_background_image').')';
            $side_area_styles['background-repeat'] = 'no-repeat';
            $side_area_styles['background-position'] = 'center center';
            $side_area_styles['background-size'] = 'cover';
        }

		if (libero_mikado_options()->getOptionValue('side_area_padding_top') !== '') {
			$side_area_styles['padding-top'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_padding_top')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_padding_right') !== '') {
			$side_area_styles['padding-right'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_padding_right')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_padding_bottom') !== '') {
			$side_area_styles['padding-bottom'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_padding_bottom')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_padding_left') !== '') {
			$side_area_styles['padding-left'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_padding_left')) . 'px';
		}

		if (!empty($side_area_styles)) {
			echo libero_mikado_dynamic_css(array(
				'.mkd-side-menu',
				'.mkd-side-area-uncovered-from-content .mkd-side-menu',
				'.mkd-side-menu-slide-from-right .mkd-side-menu'), $side_area_styles);
		}

		if (libero_mikado_options()->getOptionValue('side_area_close_icon') == 'dark') {
			echo libero_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
				'color' => '#000000'
			));
		}

		if (libero_mikado_options()->getOptionValue('side_area_close_icon_size') !== '') {
			echo libero_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu', array(
				'height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'padding' => 0,
			));
			echo libero_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu span', array(
				'font-size' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'width' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
				'line-height' => libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_styles');

}

if (!function_exists('libero_mikado_side_area_title_styles')) {

	function libero_mikado_side_area_title_styles()
	{

		$title_styles = array();

		if (libero_mikado_options()->getOptionValue('side_area_title_color') !== '') {
			$title_styles['color'] = libero_mikado_options()->getOptionValue('side_area_title_color');
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_fontsize') !== '') {
			$title_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_title_fontsize')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_lineheight') !== '') {
			$title_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_title_lineheight')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_texttransform') !== '') {
			$title_styles['text-transform'] = libero_mikado_options()->getOptionValue('side_area_title_texttransform');
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
			$title_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_fontstyle') !== '') {
			$title_styles['font-style'] = libero_mikado_options()->getOptionValue('side_area_title_fontstyle');
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_fontweight') !== '') {
			$title_styles['font-weight'] = libero_mikado_options()->getOptionValue('side_area_title_fontweight');
		}

		if (libero_mikado_options()->getOptionValue('side_area_title_letterspacing') !== '') {
			$title_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
		}

		if (!empty($title_styles)) {

			echo libero_mikado_dynamic_css('.mkd-side-menu-title h4, .mkd-side-menu-title h5', $title_styles);

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_title_styles');

}

if (!function_exists('libero_mikado_side_area_text_styles')) {

	function libero_mikado_side_area_text_styles()
	{
		$text_styles = array();

		if (libero_mikado_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_fontsize') !== '') {
			$text_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_text_fontsize')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_lineheight') !== '') {
			$text_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_text_lineheight')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_fontweight') !== '') {
			$text_styles['font-weight'] = libero_mikado_options()->getOptionValue('side_area_text_fontweight');
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_fontstyle') !== '') {
			$text_styles['font-style'] = libero_mikado_options()->getOptionValue('side_area_text_fontstyle');
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_texttransform') !== '') {
			$text_styles['text-transform'] = libero_mikado_options()->getOptionValue('side_area_text_texttransform');
		}

		if (libero_mikado_options()->getOptionValue('side_area_text_color') !== '') {
			$text_styles['color'] = libero_mikado_options()->getOptionValue('side_area_text_color');
		}

		if (!empty($text_styles)) {

			echo libero_mikado_dynamic_css(array(
				'.mkd-side-menu .widget',
				'.mkd-side-menu .widget.widget_search form',
				'.mkd-side-menu .widget.widget_search form input[type="text"]',
				'.mkd-side-menu .widget.widget_search form input[type="submit"]',
				'.mkd-side-menu .widget h6',
				'.mkd-side-menu .widget h6 a',
				'.mkd-side-menu .widget p',
				'.mkd-side-menu .widget li',
				'.mkd-side-menu .widget.widget_rss li',
				'.mkd-side-menu #wp-calendar caption',
				'.mkd-side-menu .widget li',
				'.mkd-side-menu h4',
				'.mkd-side-menu .widget.widget_archive select',
				'.mkd-side-menu .widget.widget_categories select',
				'.mkd-side-menu .widget.widget_text select',
				'.mkd-side-menu .widget.widget_search form input[type="submit"]',
				'.mkd-side-menu #wp-calendar th',
				'.mkd-side-menu #wp-calendar td',
				'.mkd-side-menu .q_social_icon_holder i.simple_social',
				'.mkd-side-menu span',
				'.mkd-side-menu .widget_categories label'),
			$text_styles);

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_text_styles');

}

if (!function_exists('libero_mikado_side_area_link_styles')) {

	function libero_mikado_side_area_link_styles()
	{
		$link_styles = array();

		if (libero_mikado_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
			$link_styles['font-family'] = libero_mikado_get_formatted_font_family(libero_mikado_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_font_size') !== '') {
			$link_styles['font-size'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sidearea_link_font_size')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_line_height') !== '') {
			$link_styles['line-height'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sidearea_link_line_height')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
			$link_styles['letter-spacing'] = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_font_weight') !== '') {
			$link_styles['font-weight'] = libero_mikado_options()->getOptionValue('sidearea_link_font_weight');
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_font_style') !== '') {
			$link_styles['font-style'] = libero_mikado_options()->getOptionValue('sidearea_link_font_style');
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_text_transform') !== '') {
			$link_styles['text-transform'] = libero_mikado_options()->getOptionValue('sidearea_link_text_transform');
		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_color') !== '') {
			$link_styles['color'] = libero_mikado_options()->getOptionValue('sidearea_link_color');
		}

		if (!empty($link_styles)) {

			echo libero_mikado_dynamic_css('.mkd-side-menu .widget li a, .mkd-side-menu .widget a:not(.qbutton), .mkd-side-menu .widget_rss li a.rsswidget', $link_styles);

		}

		if (libero_mikado_options()->getOptionValue('sidearea_link_hover_color') !== '') {
			echo libero_mikado_dynamic_css('.mkd-side-menu .widget a:hover, .mkd-side-menu .widget ul li:hover>a', array(
				'color' => libero_mikado_options()->getOptionValue('sidearea_link_hover_color')
			));
		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_link_styles');

}

if (!function_exists('libero_mikado_side_area_border_styles')) {

	function libero_mikado_side_area_border_styles()
	{

		if (libero_mikado_options()->getOptionValue('side_area_enable_bottom_border') == 'yes') {

			if (libero_mikado_options()->getOptionValue('side_area_bottom_border_color') !== '') {

				echo libero_mikado_dynamic_css('.mkd-side-menu .widget', array(
					'border-bottom' => '1px solid ' . libero_mikado_options()->getOptionValue('side_area_bottom_border_color'),
					'margin-bottom' => '10px',
					'padding-bottom' => '10px',
				));

			}

		}

	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_side_area_border_styles');

}