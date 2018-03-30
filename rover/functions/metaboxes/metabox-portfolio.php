<?php 
/**
 * Metaboxes for Portfolio
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Portfolio Options', 'TR'),
	'id' => $prefix . 'portfolio_meta_box',
	'pages' => array('portfolio'),
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
		'id' => $prefix . 'portfolio_type',
		'desc' => __('Choose the type of portfolio you wish to display.',  'TR'),
		'std' => 'image',
		'options' => array(
			'image' => __('Image', 'TR'),
			'slideshow' => __('Slideshow', 'TR'),
			'video' => __('Video', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Date', 'TR'),
		'id' => $prefix . 'portfolio_date',
		'desc' => __('What was the date of the completed portfolio.',  'TR'),
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Client', 'TR'),
		'id' => $prefix . 'portfolio_client',
		'desc' => __('For whom was the portfolio completed.',  'TR'),
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => esc_html__('Client Url', 'TR'),
		'desc' => __('What is the URL for the Portfolio?', 'TR'),
		'id' => $prefix . 'portfolio_client_url',
		'rows' => '2',
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea'
	),
);

new meta_boxes_generator($config,$options);
?>