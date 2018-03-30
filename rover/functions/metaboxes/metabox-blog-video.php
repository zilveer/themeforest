<?php 
/**
 * Metaboxes for Video
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Video Options', 'TR'),
	'id' => $prefix . 'blog_video_meta_box',
	'pages' => array('post'),
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
			'vimeo' => __('Vimeo', 'TR'),
			'self-hosted' => __('Self hosted video', 'TR')
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
		'name' => __('Ogv', 'TR'),
		'desc' => __('The URL to the .ogv video file', 'TR'),
		'id' => $prefix . 'video_ogv',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Mp4', 'TR'),
		'desc' => __('The URL to the .mp4 video file', 'TR'),
		'id' => $prefix . 'video_mp4',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Webm', 'TR'),
		'desc' => __('The URL to the .webm video file', 'TR'),
		'id' => $prefix . 'video_webm',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Poster Image', 'TR'),
		'desc' => __('The preivew image.', 'TR'),
		'id' => $prefix . 'video_poster_image',
		'std' => '',
		'size' => '60',
		'type' => 'upload'
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