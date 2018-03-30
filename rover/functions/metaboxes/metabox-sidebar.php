<?php 
/**
 * Metaboxes for Sidebar
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Sidebar Options', 'TR'),
	'id' => $prefix . 'sidebar_meta_box',
	'pages' => array('sidebar'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Name', 'TR'),
		'id' => $prefix . 'sidebar_name',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Description', 'TR'),
		'desc' => __('Write your description of the sidebar in this field.', 'TR'),
		'id' => $prefix . 'sidebar_desc',
		'rows' => '5',
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea'
	)
);

new meta_boxes_generator($config,$options);
?>