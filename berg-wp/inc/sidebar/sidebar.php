<?php
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'			=> __('Sidebar - Blog', 'BERG'),
		'id'			=> 'sidebar-1',
		'description'	=> '',
		'before_widget'	=> '<div class="widget-wrapper %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>'
	));

	register_sidebar(array(
		'name'			=> __('Sidebar - Default Template', 'BERG'),
		'id'			=> 'sidebar-2',
		'description'	=> '',
		'before_widget'	=> '<div class="widget-wrapper %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>'
	));

	register_sidebar(array(
		'name'			=> __('Sidebar - Posts', 'BERG'),
		'id'			=> 'sidebar-3',
		'description'	=> '',
		'before_widget'	=> '<div class="widget-wrapper %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>'
	));

	register_sidebar(array(
		'name'			=> __('Sidebar - Visual Composer', 'BERG'),
		'id'			=> 'sidebar-4',
		'description'	=> '',
		'before_widget'	=> '<div class="widget-wrapper %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>'
	));

	if (class_exists('WooCommerce')) {
		// register_sidebar(array(
		// 	'name'			=> 'WooCommerce Dropdown Widget Area',
		// 	'id'			=> 'woocommerce_dropdown',
		// 	'description'	=> 'This widget area should be used only for WooCommerce dropdown cart widget',
		// 	'before_widget'	=> '<div class="widget-wrapper">',
		// 	'after_widget'	=> '</div>',
		// 	'before_title'	=> '<h4 class="widget-title">',
		// 	'after_title'	=> '</h4>'
		// ));

		register_sidebar(array(
			'name'			=> 'WooCommerce Shop',
			'id'			=> 'shop',
			'description'	=> __('This widget area should be used only for WooCommerce Shop', 'BERG'),
			'before_widget'	=> '<div class="widget-wrapper %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>'
		));
	}
}
// register custom sidebars to theme
new berg_custom_sidebar();