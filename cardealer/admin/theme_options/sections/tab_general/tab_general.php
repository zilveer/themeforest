<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$list_pages = get_posts(array(
	'post_type' => 'page',
	'numberposts'     => -1
));

$list_pages_array = array('' => 'Select Page');

if (!empty($list_pages)) {
	foreach($list_pages as $id => $page) {
		$list_pages_array[$page->ID] = $page->post_title;
	}
}

$content = array(

	'boxed_layout' => array(
		'title' => __('Enable Boxed Layout', 'cardealer'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => '',
		'custom_html' => ''
	),

	'header_type' => array(
		'title' => __('Header Type', 'cardealer'),
		'type' => 'select',
		'default_value' => 'classic',
		'values' => array(
			'classic' => __('Classic', 'cardealer'),
			'alternate' => __('Alternate', 'cardealer')
		),
		'description' => __('This option responds for all website pages. Either Classic or Alternate will take a unique header type for every page.', 'cardealer'),
		'custom_html' => ''
	),

	'sticky_nav' => array(
		'title' => __('Enable Sticky Navigation', 'cardealer'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('Enable sticky navigation bar', 'cardealer'),
		'custom_html' => ''
	),

	'breadcrumbs' => array(
		'title' => __('Enable Breadcrumbs', 'cardealer'),
		'type' => 'checkbox',
		'default_value' => 0,
		'description' => __('Enable breadcrumbs', 'cardealer'),
		'custom_html' => ''
	),
	
	'favicon_img' => array(
		'title' => __('Website Favicon', 'cardealer'),
		'type' => 'upload',
		'default_value' => TMM_THEME_URI . '/favicon.ico',
		'description' => __('Upload your favicon here. It will appear in your browser\'s address bar as per example below. Recommended dimensions: 32x32. Recommended image types: png', 'cardealer'),
		'custom_html' => TMM::draw_free_page($pagepath . 'favicon_img.php')
	),	
	
	'logo' => array(
		'title' => __('Website Logo', 'cardealer'),
		'type' => 'custom',
		'default_value' => '',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'logo.php')
	),
	'sidebar_position' => array(
		'title' => __('Default Sidebar Position', 'cardealer'),
		'type' => 'custom',
		'default_value' => 'no_sidebar',
		'description' => '',
		'custom_html' => TMM::draw_free_page($pagepath . 'sidebar_position.php')
	),
	'tracking_code' => array(
		'title' => __('Tracking Code', 'cardealer'),
		'type' => 'textarea',
		'default_value' => '',
		'description' => __('Place here your Google Analytics (or other) tracking code. It will be inserted before closing head tag in your theme.', 'cardealer'),
		'custom_html' => ''
	)
	
);

$sections = array(
	'name' => __("General", 'cardealer'),
	'css_class' => 'shortcut-options',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-admin-settings'
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

