<?php 
/**
 * Metaboxes for Page
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Page Options', 'TR'),
	'id' => $prefix . 'page_meta_box',
	'pages' => array('page'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
			'name' => __('Page Header Title', 'TR'),
			'desc' => __('Set the title for the page header.', 'TR'),
			'id' => $prefix . 'page_header_title',
			'std' => '',
			'rows' => '2',
			'class' => 'noborder',
			'type' => 'textarea'
	),
);

new meta_boxes_generator($config,$options);
?>