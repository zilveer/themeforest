<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
//$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';
//*************************************

$folio_archive_per_page = array();
for ($i = 3; $i <= 21; $i++) {
	$folio_archive_per_page[$i] = $i;
}

//***

$content = array(
	
	'block4' => array(
		'title' => __('Archive Page Layout', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'folio_archive_layout' => array(
				'title' => __('Default Layout', 'diplomat'),
				'type' => 'select',
				'default_value' => 4,
				'values' => array(					
					3 => __('3 Columns', 'diplomat'),
					4 => __('4 Columns', 'diplomat'),
					5 => __('5 Columns', 'diplomat'),
					6 => __('6 Columns', 'diplomat'),
				),
				'description' => __('Archive Page layout for Portfolio. I.e. skills, clients listing pages.', 'diplomat'),
				'custom_html' => ''
			),
			'folio_archive_per_page' => array(
				'title' => __('Items per page', 'diplomat'),
				'type' => 'select',
				'default_value' => 8,
				'values' => $folio_archive_per_page,
				'description' => __('Please type here an amount of items to be displayed per portfolio page.', 'diplomat'),
				'custom_html' => ''
			),
			'folio_archive_sidebar' => array(
				'title' => __('Archive Page Sidebar', 'diplomat'),
				'type' => 'select',
				'default_value' => 'no_sidebar',
				'values' => array(
					'no_sidebar' => __('No sidebar', 'diplomat'),
					'sbl' => __('Left', 'diplomat'),
					'sbr' => __('Rigth', 'diplomat'),
				),
				'description' => __('Archive Page sidebar position for Portfolio', 'diplomat'),
				'custom_html' => ''
			),
		)
	),
	'block5' => array(
		'title' => __('Single Page Layout', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'folio_show_related_works' => array(
				'title' => __('Show Related Works on single page', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show Related Works on single page', 'diplomat'),
				'custom_html' => ''
			),
			'single_folio_hide_clients' => array(
				'title' => __('Hide Single Folio Clients', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_skills' => array(
				'title' => __('Hide Single Folio Skills', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
			'single_folio_hide_metadata' => array(
				'title' => __('Hide Single Folio Metadata', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),                    
            'single_folio_like_button' => array(
				'title' => __('Hide Single Folio Like Button', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 0,
				'description' => '',
				'custom_html' => ''
			),
		)
	),
	'block6' => array(
		'title' => __('Social Share Buttons', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
			'folio_show_twitter' => array(
				'title' => __('Show / Hide Twitter', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show / Hide Twitter Social Share Button on single page', 'diplomat'),
				'custom_html' => ''
			),
			'folio_show_facebook' => array(
				'title' => __('Show / Hide Facebook', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show / Hide Facebook Social Share Button on single page', 'diplomat'),
				'custom_html' => ''
			),
			'folio_show_google' => array(
				'title' => __('Show / Hide Google+', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show / Hide Google+ Social Share Button on single page', 'diplomat'),
				'custom_html' => ''
			),
			'folio_show_pinterest' => array(
				'title' => __('Show / Hide Pinterest', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Show / Hide Pinterest Social Share Button on single page', 'diplomat'),
				'custom_html' => ''
			),		
		)
	),
);




//*************************************
//*************************************
$sections = array(
	'name' => __('Portfolio', 'diplomat'),
	'css_class' => 'shortcut-portfolio',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-portfolio'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;

