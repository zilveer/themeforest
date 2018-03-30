<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//*************************************

$content = array(

	'skin_composer' => array(
		'title' => __('Skin Composer', 'diplomat'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'skin_composer.php')
	),

	'show_style_switcher' => array(
		'title' => __('Show / Hide Style Switcher', 'diplomat'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('Show / Hide Style Switcher from Front End.', 'diplomat'),
		'custom_html' => ''
	),

	'block0' => array(
		'title' => __('Elements', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'general_elements' => array(
				'title' => __('Website Elements Color', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_elements'),
				'description' => __('General website elements color(Such elements like icons, some backgrounds etc.). Do not edit this field to use default theme styling.
									Notice: All the styles below may override this color if necessary. ', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
		)
	),
	'block1' => array(
		'title' => __('Text', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'general_font_family' => array(
				'title' => __('Website Font Family', 'diplomat'),
				'type' => 'google_font_select',
				'default_value' => TMM_OptionsHelper::get_default_value('general_font_family'),
				'description' => '',
				'custom_html' => '',
				'is_reset' => true
			),
			'general_font_size' => array(
				'title' => __('Website Font Size', 'diplomat'),
				'type' => 'slider',
				'default_value' => TMM_OptionsHelper::get_default_value('general_font_size'),
				'min' => 12,
				'max' => 18,
				'description' => __('General website font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_text_color' => array(
				'title' => __('Website Text Color', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_text_color'),
				'description' => __('General website text color. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_normal_links_color' => array(
				'title' => __('Website Normal Links Color', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_normal_links_color'),
				'description' => __('General website links color. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_mouseover_links_color' => array(
				'title' => __('Website Mouseover Links Color', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_mouseover_links_color'),
				'description' => __('General website mouseover links color. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
		)
	),
	'block2' => array(
		'title' => __('Backgrounds', 'diplomat'),
		'type' => 'items_block',
		'items' => array(

			'header_top_bg_color' => array(
				'title' => __('Website Top Header Background', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('header_top_bg_color'),
				'description' => __('General website top header background color. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),

			'header_bottom_bg_color' => array(
				'title' => __('Website Bottom Header Background', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('header_bottom_bg_color'),
				'description' => __('General website bottom header background color. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
			'header_bottom_bg_blue_color' => array(
				'title' => __('Website Bottom Header Background (Default Blue Header Type)', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('header_bottom_bg_blue_color'),
				'description' => __('General website bottom header background color (default blue header type). Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),

			'body_pattern_selected' => array(
				'title' => __('Website Background', 'diplomat'),
				'type' => 'select',
				'css_class' => 'showhide',
				'default_value' => TMM_OptionsHelper::get_default_value('body_pattern_selected'),
				'values' => array(
					0 => __('Background Color', 'diplomat'),
					1 => __('Custom Background Image', 'diplomat'),
					2 => __('Patterns', 'diplomat'),
				),
				'description' => __('General website background. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => TMM::draw_free_page($pagepath . 'body_pattern_selected.php'),
				'is_reset' => true
			),

			'general_footer_top_bg_color' => array(
				'title' => __('Website Top Footer Background', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_footer_top_bg_color'),
				'description' => __('General website top footer background color (The top area where is copyright info located). Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
			'general_footer_bottom_bg_color' => array(
				'title' => __('Website Bottom Footer Background', 'diplomat'),
				'type' => 'color',
				'default_value' => TMM_OptionsHelper::get_default_value('general_footer_bottom_bg_color'),
				'description' => __('General website bottom footer background color (The bottom area where is copyright info located). Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),

		)
	),
	'custom_css' => array(
		'title' => __('Custom CSS Styles', 'diplomat'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => '',
		'custom_html' => ''
	),
);
//*************************************

$child_sections['styling_headings'] = array(
	'name' => __('Headings', 'diplomat'),
	'sections' => array(
		'block1' => array(
			'title' => __('H1 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h1_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h1_font_family'),
					'description' => __('H1 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h1_font_size'),
					'min' => 35,
					'max' => 48,
					'description' => __('H1 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h1_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h1_font_color'),
					'description' => __('H1 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('H2 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h2_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h2_font_family'),
					'description' => __('H2 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h2_font_size'),
					'min' => 25,
					'max' => 48,
					'description' => __('H2 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h2_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h2_font_color'),
					'description' => __('H2 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('H3 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h3_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h3_font_family'),
					'description' => __('H3 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h3_font_size'),
					'min' => 18,
					'max' => 28,
					'description' => __('H3 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h3_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h3_font_color'),
					'description' => __('H3 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block4' => array(
			'title' => __('H4 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h4_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h4_font_family'),
					'description' => __('H4 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h4_font_size'),
					'min' => 16,
					'max' => 26,
					'description' => __('H4 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h4_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h4_font_color'),
					'description' => __('H4 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block5' => array(
			'title' => __('H5 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h5_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h5_font_family'),
					'description' => __('H5 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h5_font_size'),
					'min' => 14,
					'max' => 24,
					'description' => __('H5 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h5_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h5_font_color'),
					'description' => __('H5 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block6' => array(
			'title' => __('H6 Heading', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'h6_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('h6_font_family'),
					'description' => __('H6 heading font from google family. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('h6_font_size'),
					'min' => 12,
					'max' => 20,
					'description' => __('H6 heading font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'h6_font_color' => array(
					'title' => __('Font Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('h6_font_color'),
					'description' => __('H6 heading cont color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);
//*************************************
$child_sections['styling_main_navigation'] = array(
	'name' => __('Main Navigation', 'diplomat'),
	'sections' => array(
		'block1' => array(
			'title' => __('General', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_font' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_font'),
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_first_level_font_size' => array(
					'title' => __('First Level\'s Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_first_level_font_size'),
					'min' => 12,
					'max' => 16,
					'description' => __('Main navigation first level\'s font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_second_level_font_size' => array(
					'title' => __('Second Level\'s Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_second_level_font_size'),
					'min' => 11,
					'max' => 15,
					'description' => __('Main navigation seconds level\'s font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Links Color (First level)', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_def_text_color' => array(
					'title' => __('Normal', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_def_text_color'),
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('Links Color (Second level)', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'main_nav_dd_def_text_color' => array(
					'title' => __('Normal', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_dd_def_text_color'),
					'description' => __('A normal, visited and unvisited link color for main navigation. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'main_nav_dd_hover_bg_color' => array(
					'title' => __('Mouseover Background', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('main_nav_dd_hover_bg_color'),
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		)
	)
);
//*************************************
$child_sections['styling_content'] = array(
	'name' => __('Content', 'diplomat'),
	'sections' => array(
		'block1' => array(
			'title' => __('Links Color Options', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'content_normal_link_color' => array(
					'title' => __('Normal', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('content_normal_link_color'),
					'description' => __('A normal, visited and unvisited link color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'content_mouseover_link_color' => array(
					'title' => __('Mouse Over', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('content_mouseover_link_color'),
					'description' => __('A link when the user mouses over it. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Donate Buttons', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'donate_buttons_bg' => array(
					'title' => __('Donate Buttons Background', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('donate_buttons_bg'),
					'description' => __('A checked and hover button color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block3' => array(
			'title' => __('Pagination', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'pagination_bg' => array(
					'title' => __('Pagination Buttons Background', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('pagination_bg'),
					'description' => __('An active and hover button color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block4' => array(
			'title' => __('Search Button Color', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'search_button_color' => array(
					'title' => '',
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('search_button_color'),
					'description' => __('Search button color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		)
	)
);
//*************************************
$child_sections['styling_buttons'] = array(
	'name' => __('Buttons', 'diplomat'),
	'sections' => array(
		'block1' => array(
			'title' => __('General Styles', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'buttons_font_family' => array(
					'title' => __('Font Family', 'diplomat'),
					'type' => 'google_font_select',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_font_family'),
					'description' => '',
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_font_size' => array(
					'title' => __('Font Size', 'diplomat'),
					'type' => 'slider',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_font_size'),
					'min' => 11,
					'max' => 20,
					'description' => __('General buttons font size in pixels. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block2' => array(
			'title' => __('Normal Color Styles', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'buttons_text_color' => array(
					'title' => __('Text', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_text_color'),
					'description' => __('A normal, visited and unvisited default button\'s text color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_bg_color' => array(
					'title' => __('Background', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_bg_color'),
					'description' => __('A normal, visited and unvisited default button\'s background color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
                'buttons_border_color' => array(
					'title' => __('Border Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_border_color'),
					'description' => __('A normal, visited and unvisited default button\'s border color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
		'block3' => array(
			'title' => __('Mouseover Color Styles', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'buttons_hover_text_color' => array(
					'title' => __('Text', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_hover_text_color'),
					'description' => __('Default button\'s text color when the user mouses over it. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'buttons_hover_bg_color' => array(
					'title' => __('Background', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_hover_bg_color'),
					'description' => __('Default button\'s background color when the user mouses over it. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
                'buttons_hover_border_color' => array(
					'title' => __('Border Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('buttons_hover_border_color'),
					'description' => __('A normal, visited and unvisited default button\'s border color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
			)
		),
	)
);
//*************************************
$child_sections['styling_widgets'] = array(
	'name' => __('Widgets', 'diplomat'),
	'sections' => array(
		'block1' => array(
			'title' => __('Normal Color Styles', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'widget_title_color' => array(
					'title' => __('Title Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('widget_title_color'),
					'description' => __('Widget\'s title text color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'widget_title_bg_color' => array(
					'title' => __('Title Background Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('widget_title_bg_color'),
					'description' => __('Widget\'s title background color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'widget_text_color' => array(
					'title' => __('Text Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('widget_text_color'),
					'description' => __('Widget text color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)

			)
		),
		'block2' => array(
			'title' => __('Footer Widgets', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'footer_widget_title_color' => array(
					'title' => __('Title Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('footer_widget_title_color'),
					'description' => __('Footer widget\'s title text color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'footer_widget_text_color' => array(
					'title' => __('Text Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('footer_widget_text_color'),
					'description' => __('Footer widget text color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
		'block2' => array(
			'title' => __('Featured Event Widget', 'diplomat'),
			'type' => 'items_block',
			'items' => array(
				'featured_event_widget_title_bg_color' => array(
					'title' => __('Title Background Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('featured_event_widget_title_bg_color'),
					'description' => __('Featured Event widget title background color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				),
				'featured_event_widget_date_bg_color' => array(
					'title' => __('Date Background Color', 'diplomat'),
					'type' => 'color',
					'default_value' => TMM_OptionsHelper::get_default_value('featured_event_widget_date_bg_color'),
					'description' => __('Featured Event widget date background color. Do not edit this field to use default theme styling.', 'diplomat'),
					'custom_html' => '',
					'is_reset' => true
				)
			)
		),
	)
);

//*************************************
//*************************************
$sections = array(
	'name' => __('Styling', 'diplomat'),
	'css_class' => 'shortcut-styling',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
    'menu_icon' => 'dashicons-welcome-write-blog'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;


