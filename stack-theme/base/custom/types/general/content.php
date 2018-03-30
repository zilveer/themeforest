<?php

$config = array(
	'title' => __('General Options', 'theme_admin'),
	'group_id' => 'general',
	'context' => 'normal',
	'priority' => 'low',
	'types' => array( 'page' )
);
$options = array(
	array(
		'type' => 'on_off',
		'id' => 'show_main_title',
		'toggle' => 'toggle-show-title',
		'title' => __('Show Title', 'theme_admin'),
		'default' => 'on',
		'description' => __('turn off to hide title section', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_main_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Title', 'theme_admin'),
		'description' => __('this text will override the normal page/post title', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_sub_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Sub Title', 'theme_admin'),
		'description' => __('this text will be placed below Title', 'theme_admin'),
	),

	array(
		'type' => 'radio',
		'id' => 'page_layout',
		'toggle' => 'toggle-page-layout',
		'title' => __('Page Layout', 'theme_admin'),
		'description' => '',
		'default' => theme_options('page', 'default_layout', 'full-width'),
		'options' => array(
			'full-width' => 'Full Width',
			'sidebar' => 'Sidebar Right',
		)
	),
	array(
		'type' => 'select',
		'id' => 'custom_sidebar',
		'toggle_group' => 'toggle-page-layout toggle-page-layout-sidebar',
		'title' => __('Custom Sidebar', 'theme_admin'),
		'description' => __('leave blank to use default sidebar', 'theme_admin'),
		'default' => '',
		'source' => array( 
			'option-custom-sidebar' => ''
		),
		'options' => array(
			'' => 'choose ...'
		)
	),
);
new metaboxes_tool($config, $options);

$config = array(
	'title' => __('General Options', 'theme_admin'),
	'group_id' => 'general',
	'context' => 'normal',
	'priority' => 'low',
	'types' => array( 'portfolio', 'event' )
);
$options = array(
	array(
		'type' => 'on_off',
		'id' => 'show_main_title',
		'toggle' => 'toggle-show-title',
		'title' => __('Show Title', 'theme_admin'),
		'default' => 'on',
		'description' => __('turn off to hide title section', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_main_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Title', 'theme_admin'),
		'description' => __('this text will override the normal page/post title', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_sub_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Sub Title', 'theme_admin'),
		'description' => __('this text will be placed below Title', 'theme_admin'),
	),
);
new metaboxes_tool($config, $options);

?>