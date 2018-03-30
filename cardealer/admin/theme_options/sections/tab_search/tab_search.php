<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$content = array(
	'block1' => array(
		'title' => __('Search Results Page', 'cardealer'),
		'type' => 'items_block',
		'items' => array(
			'search_page_header_type' => array(
				'title' => __('Header Type', 'cardealer'),
				'show_title' => true,
				'css_class' => 'search_page_header_type',
				'type' => 'select',
				'default_value' => '0',
				'values' => array(
					0 => __('Default', 'cardealer'),
					'classic' => __('Classic', 'cardealer'),
					'alternate' => __('Alternate', 'cardealer')
				),
				'description' => __('If set to default, page will inherit general header type (check Genaral tab). Either Classic or Alternate will take a unique header type for this page.', 'cardealer'),
				'custom_html' => TMM::draw_free_page($pagepath . 'search_header.php')
			),
			'search_page_hide_title' => array(
				'title' => __('Hide Default Title', 'cardealer'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
		)
	),
);

$sections = array(
	'name' => __('Search', 'cardealer'),
	'css_class' => 'shortcut-blog',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-search'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;
