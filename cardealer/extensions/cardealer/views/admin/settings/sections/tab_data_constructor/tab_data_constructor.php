<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/' . $tab_key . '/custom_html/';

$content = array(
	'data_constructor' => array(
        'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'data_constructor.php'),
        'show_title' => false
    )
);

$sections = array(
	'name' => __("Car Options Editor", 'cardealer'),
	'css_class' => 'shortcut-options',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-admin-tools'
);

TMM_CarSettingsHelper::$sections[$tab_key] = $sections;