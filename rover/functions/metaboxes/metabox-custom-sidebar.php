<?php 
/**
 * Metaboxes for Custom Sidebar
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Custom Sidebar', 'TR'),
	'id' => $prefix . 'custom_sidebar_meta_box',
	'pages' => array('page', 'post'),
	'callback' => '',
	'context' => 'side',
	'priority' => 'default',
);

$options = array(
	array(
			'name' => '',
			'desc' => __('Choose a sidebar for your page or single post.', 'TR'),
			'id' => $prefix . 'custom_sidebar',
			'std' => '',
			'prompt' => __('Choose sidebar..','TR'),
			'target' => 'sidebar',
			'class' => 'noborder',
			'type' => 'sidebar_select',
	),
);

new meta_boxes_generator($config,$options);
?>