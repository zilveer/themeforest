<?php 
/**
 * Metaboxes for Audio
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Audio Options', 'TR'),
	'id' => $prefix . 'blog_audio_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Ogg', 'TR'),
		'desc' => __('The URL to the .ogg audio file', 'TR'),
		'id' => $prefix . 'audio_ogg',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Mp3', 'TR'),
		'desc' => __('The URL to the .mp3 audio file', 'TR'),
		'id' => $prefix . 'audio_mp3',
		'std' => '',
		'size' => '60',
		'class' => 'noborder',
		'type' => 'text'
	)
);

new meta_boxes_generator($config,$options);
?>