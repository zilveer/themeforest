<?php 
/**
 * Metaboxes for Custom Sidebar
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'mm_';

$config = array(
	'title' => __('Custom Sidebar', 'homeshop'),
	'id' => $prefix . 'custom_sidebar_meta_box',
	'pages' => array('page', 'post', 'product'),
	'callback' => '',
	'context' => 'side',
	'priority' => 'default',
);

$options = array(
	array(
			'name' => __('Choose a sidebar.', 'homeshop'),
			'desc' => '',
			'id' => $prefix . 'custom_sidebar',
			'std' => '',
			'prompt' => __('Choose sidebar..', 'homeshop'),
			'target' => 'sidebar',
			'class' => 'noborder',
			'type' => 'sidebar_select',
	),
	
	
	array(
			'name' => __('Choose a sidebar Top Banner.', 'homeshop'),
			'desc' => '',
			'id' => $prefix . 'custom_sidebar_top',
			'std' => '',
			'prompt' => __('Choose sidebar..', 'homeshop'),
			'target' => 'sidebar',
			'class' => 'noborder',
			'type' => 'sidebar_select2',
	),
	array(
			'name' => __('Choose a sidebar Bottom Banner.', 'homeshop'),
			'desc' => '',
			'id' => $prefix . 'custom_sidebar_bottom',
			'std' => '',
			'prompt' => __('Choose sidebar..', 'homeshop'),
			'target' => 'sidebar',
			'class' => 'noborder',
			'type' => 'sidebar_select2',
	),
	
	
	array(
		'name' => '',
		'id' => $prefix . 'sidebar_position_meta_box',
		'desc' => '',
		'prompt' => '',
		'std' => 'full',
		'options' => array('full' => 'Fullwidth', 'left' => 'Left','right' => 'Right' ),
		'class' => 'noborder',
		'type' => 'select'
	)
);

new meta_boxes_generator($config,$options);












?>