<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************
$contact_forms = TMM::get_option('contact_form');
if (is_string($contact_forms) AND !empty($contact_forms)) {
	$contact_forms = maybe_unserialize($contact_forms);
}
//***

$content = array(
	'forms' => array(
		'title' => '',
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'forms.php', array('contact_forms'=>$contact_forms,'custom_html_pagepath'=>$pagepath))
	),
);


//*************************************
$sections = array(
	'name' => __('Contact Forms', 'diplomat'),
	'css_class' => 'shortcut-contact',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-forms'     
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

