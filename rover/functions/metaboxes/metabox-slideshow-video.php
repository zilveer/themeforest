<?php 
/**
 * Metaboxes for Slideshow
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Video Options', 'TR'),
	'id' => $prefix . 'slideshow_video_meta_box',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Embed Player', 'TR'),
		'id' => $prefix . 'embed_player',
		'desc' => __('Choose the embed player of video you wish to display.',  'TR'),
		'std' => 'youtube',
		'options' => array(
			'youtube' => __('Youtube', 'TR'),
			'vimeo' => __('Vimeo', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Youtube Or Vimeo ID', 'TR'),
		'id' => $prefix . 'video_embed_id',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Video Height', 'TR'),
		'id' => $prefix . 'video_height',
		'desc' => __('The video height (e.g. 380), if you leave it as blank, it will display the video with 16:9.',  'TR'),
		'std' => '',
		'size' => '60',
		'class' => 'noborder',
		'type' => 'text'
	)
);

new meta_boxes_generator($config,$options);
?>