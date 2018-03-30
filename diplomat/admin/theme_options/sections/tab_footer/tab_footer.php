<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	'copyright_text' => array(
		'title' => __('Copyrights', 'diplomat'),
		'type' => 'textarea',
		'default_value' => sprintf(__('Copyright &copy; %d. ThemeMakers. All rights reserved', 'diplomat'), date('Y')),
		'description' => '',
		'custom_html' => ''
	),
	'hide_footer' => array(
		'title' => __('Disable Footer Widget Area', 'diplomat'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('If checked, all the footer widgets will not be appeared in the bottom of each page.', 'diplomat'),
		'custom_html' => ''
	),
);


$sections = array(
	'name' => __("Footer", 'diplomat'),
	'css_class' => 'shortcut-footer',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-editor-kitchensink'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

