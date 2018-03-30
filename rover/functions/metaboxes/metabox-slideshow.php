<?php 
/**
 * Metaboxes for Slideshow
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Slideshow Options', 'TR'),
	'id' => $prefix . 'slideshow_meta_box',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Types', 'TR'),
		'id' => $prefix . 'slideshow_type',
		'desc' => __('Choose the type of slideshow you wish to display.',  'TR'),
		'std' => 'full',
		'options' => array(
			'full' => __('Full width Image', 'TR'),
			'text' => __('Image and Text', 'TR'),
			'video' => __('Video', 'TR')
		),
		'class' => 'noborder',
		'type' => 'radio'
	)
);

new meta_boxes_generator($config,$options);
?>