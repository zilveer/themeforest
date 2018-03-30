<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************
$sidebars = TMM::get_option('sidebars');
if (is_string($sidebars) AND !empty($sidebars)) {
	$sidebars = unserialize($sidebars);
}

//***

$content = array(
	'forms' => array(
		'title' => '',
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'sidebars.php', array('sidebars' => $sidebars, 'custom_html_pagepath' => $pagepath))
	),
);

//*************************************
$sections = array(
	'name' => __('Custom Sidebars', 'cardealer'),
	'css_class' => 'shortcut-sidebar',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-format-aside'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

