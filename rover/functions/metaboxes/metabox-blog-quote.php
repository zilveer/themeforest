<?php 
/**
 * Metaboxes for Blog
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Quote Options', 'TR'),
	'id' => $prefix . 'blog_quote_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('The Quote', 'TR'),
		'desc' => __('Write your quote in this field.', 'TR'),
		'id' => $prefix . 'blog_type_quote',
		'rows' => '8',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Quote From', 'TR'),
		'id' => $prefix . 'blog_type_quote_from',
		'desc' => __('The quote is from who?',  'TR'),
		'std' => '',
		'size' => '60',
		'class' => 'noborder',
		'type' => 'text'
	),
);

new meta_boxes_generator($config,$options);
?>