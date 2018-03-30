<?php 
/**
 * Metaboxes for Blog
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Blog Options', 'TR'),
	'id' => $prefix . 'blog_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
			'name' => esc_html__('Exclude Featured Image ',  'TR'),
			'desc' => esc_html__('Exclude the featured image from gallery or slidershow.',  'TR'),
			'id' => $prefix . 'exclude_featured_image',
			'std' => 0,
			'type' => 'checkbox',
	),
	array(
		'name' => __('Types', 'TR'),
		'id' => $prefix . 'blog_type',
		'desc' => __('Choose the type of blog you wish to display.',  'TR'),
		'std' => 'image',
		'options' => array(
			'standard' => __('Standard', 'TR'),
			'image' => __('Image', 'TR'),
			'slideshow' => __('Slideshow', 'TR'),
			'audio' => __('Audio', 'TR'),
			'video' => __('Video', 'TR'),
			'link' => __('Link', 'TR'),
			'quote' => __('Quote', 'TR')
		),
		'class' => 'noborder',
		'type' => 'radio'
	),
);

new meta_boxes_generator($config,$options);
?>