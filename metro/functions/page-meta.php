<?php

/*************************************************************************************
 *	Add MetaBox to Page edit page
 *************************************************************************************/

$om_page_meta_box=array (
	'sidebar' => array (
		'id' => 'om-page-meta-box-sidebar',
		'name' => __('Sidebar', 'om_theme'),
		'callback' => 'om_page_meta_box_sidebar',
		'fields' => array (
			array (
				'name' => __('Choose the sidebar','om_theme'),
				'desc' => '',
				'id' => OM_THEME_SHORT_PREFIX.'sidebar',
				'type' => 'sidebar',
				'std' => ''
			),
			
			array ( "name" => __('Page Individual Sidebar Position','om_theme'),
					"desc" => __('Normally sidebar position for all pages can be specified under "Appearance > Theme Options > Sidebars", but you can set sidebar position for current page manually.','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."sidebar_custom_pos",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('Default (As in "Theme Options")', 'om_theme'),
						'left' => __('Left Side', 'om_theme'),
						'right' => __('Right Side', 'om_theme'),
					)
			),
		),
	),
	
	'portfolio' => array (
		'id' => 'om-page-meta-box-portfolio',
		'name' => __('Portfolio categories to show', 'om_theme'),
		'callback' => 'om_page_meta_box_portfolio',
		'fields' => array (
			array (
				'name' => __('Choose the category','om_theme'),
				'desc' => __('You can create multiple portfolio pages and show different categories on the each page. If you want to display specific portfolio category firstly create it, then add child sub-categories for it and choose the root category here','om_theme'),
				'id' => OM_THEME_SHORT_PREFIX.'portfolio_categories',
				'type' => 'portfolio_root_cats',
				'std' => ''
			),
		),
	),

	
	'homepage' => array (
		'id' => 'om-page-meta-box-homepage',
		'name' => __('Homepage blocks to show', 'om_theme'),
		'callback' => 'om_page_meta_box_homepage',
		'fields' => array (
			array (
				'name' => __('Choose the blocks','om_theme'),
				'desc' => __('You can choose which homepage blocks to show on this page. If you choose the block from the list - child blocks of this block will be shown on the page','om_theme'),
				'id' => OM_THEME_SHORT_PREFIX.'homepage_blocks',
				'type' => 'homepage_root_pages',
				'std' => ''
			),
		),
	),	
);
 
function om_add_page_meta_box() {
	global $om_page_meta_box;
	
	foreach($om_page_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'page',
			'normal',
			'high'
		);
	}
 
}
add_action('add_meta_boxes', 'om_add_page_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_page_meta_box_sidebar() {
	global $om_page_meta_box;

	echo om_generate_meta_box($om_page_meta_box['sidebar']['fields']);
}

function om_page_meta_box_portfolio() {
	global $om_page_meta_box;

	echo om_generate_meta_box($om_page_meta_box['portfolio']['fields']);
}

function om_page_meta_box_homepage() {
	global $om_page_meta_box;

	echo om_generate_meta_box($om_page_meta_box['homepage']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_page_metabox($post_id) {
	global $om_page_meta_box;
 
	om_save_metabox($post_id, $om_page_meta_box);

}
add_action('save_post', 'om_save_page_metabox');

/*************************************************************************************
 *	Load JS Scripts and Styles
 *************************************************************************************/
 
function om_page_meta_box_scripts() {
	wp_register_script('om-admin-page-meta', TEMPLATE_DIR_URI . '/admin/js/page-meta.js', array('jquery'));
	wp_enqueue_script('om-admin-page-meta');
}
add_action('admin_print_scripts', 'om_page_meta_box_scripts');
