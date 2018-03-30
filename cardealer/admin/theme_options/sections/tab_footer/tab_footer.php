<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	
	'copyright_text' => array(
		'title' => __('Copyrights', 'cardealer'),
		'type' => 'textarea',
		'default_value' => sprintf(__('Copyright &copy; %d. ThemeMakers. All rights reserved', 'cardealer'), date('Y')),
		'description' => '',
		'custom_html' => ''
	),
	'hide_footer' => array(
		'title' => __('Disable Footer Widget Area', 'cardealer'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('If checked all the footer widgets would not appear in the bottom of each page.', 'cardealer'),
		'custom_html' => ''
	),
	'footer_columns' => array(
		'title' => __('Footer Columns Number', 'cardealer'),
		'type' => 'select',
		'default_value' => 4,
		'values'        => array(
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
		),
		'description' => __('Number of columns with widgets in footer area.', 'cardealer'),
		'custom_html' => ''
	)
);


$sections = array(
	'name' => __("Footer", 'cardealer'),
	'css_class' => 'shortcut-footer',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-editor-kitchensink'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

