<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

//***

$content = array(
	'block1' => array(
		'title' => __('API key google', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'api_key_google' => array(
				//'title' => __('API key google', 'diplomat'),
				'type' => 'text',
				'default_value' => "",
				'description' => 'You can find the instructions on the folowing page to <a class="admin-link" target="_blank" href="http://forums.webtemplatemasters.com/how-to-obtain-the-google-api-key-for-google-maps/">get your API key</a>',
				'custom_html' => ''
			),
		)
	),
	'block2' => array(
		'title' => __('Twitter widget ID', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'twitter_widget_id' => array(
				//'title' => __('Twitter widget ID', 'diplomat'),
				'type' => 'text',
				'default_value' => "351293746240958465",
				'description' => 'You can find the instructions on the folowing page to <a class="admin-link" target="_blank" href="https://twitter.com/settings/widgets">get your Twitter widget ID</a>',
				'custom_html' => ''
			)
		)
	)
);


$sections = array(
	'name' => __("API settings", 'diplomat'),
	'css_class' => 'shortcut-footer',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-admin-generic'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

