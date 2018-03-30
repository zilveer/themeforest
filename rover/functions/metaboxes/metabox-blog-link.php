<?php 
/**
 * Metaboxes for Blog
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Link Options', 'TR'),
	'id' => $prefix . 'blog_link_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => esc_html__('The URL', 'TR'),
		'desc' => __('Insert the URL you wish to link to.', 'TR'),
		'id' => $prefix . 'blog_type_url',
		'rows' => '2',
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea'
	),
);

new meta_boxes_generator($config,$options);
?>