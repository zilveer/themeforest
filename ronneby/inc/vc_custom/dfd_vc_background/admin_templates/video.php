<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Video source', 'dfd'),
	'param_name' => 'dfd_video_variant',
	'value' => array(
		__('Self hosted video','dfd') => 'self-hosted',
		__('Youtube','dfd') => 'youtube',
		__('Vimeo','dfd') => 'vimeo',
	),
	/*'description' => __('Enter your video URL. You can upload a video through <a href=''.home_url().'/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.', 'dfd'),*/
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __('Link to the video in MP4 Format', 'dfd'),
	'param_name' => 'dfd_video_url_mp4',
	'value' => '',
	/*'description' => __('Enter your video URL. You can upload a video through <a href=''.home_url().'/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.', 'dfd'),*/
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __('Link to the video in WebM / Ogg Format', 'dfd'),
	'param_name' => 'dfd_video_url_webm',
	'value' => '',
	'description' => __('IE, Chrome & Safari <a href="http://www.w3schools.com/html/html5_video.asp" target="_blank">support</a> MP4 format, while Firefox & Opera prefer WebM / Ogg formats. You can upload the video through <a href="'.home_url().'"/wp-admin/media-new.php" target="_blank">WordPress Media Library</a>.', 'dfd'),
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd')
);
/*youtube*/
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __('Enter YouTube video ID', 'dfd'),
	'param_name' => 'dfd_youtube_video_id',
	'value' => '',
	'description' => __('Enter YouTube ID. Example - tSqJIIcxKZM', 'dfd'),
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('youtube')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __('Enter Vimeo video ID', 'dfd'),
	'param_name' => 'dfd_vimeo_video_id',
	'value' => '',
	'description' => __('Enter Vimeo ID. Example - 67628182', 'dfd'),
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('vimeo')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'checkbox',
	'class' => '',
	'heading' => __('Extra Options', 'dfd'),
	'param_name' => 'dfd_video_opts',
	'value' => array(
			__('Loop','dfd') => 'loop',
			__('Muted','dfd') => 'muted',
		),
	/*'description' => __('Select options for the video.', 'dfd'),*/
	//'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
/*youtube*/
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => __('Placeholder Image', 'dfd'),
	'param_name' => 'dfd_video_poster',
	'value' => '',
	'description' => __('Placeholder image is displayed in case background videos are restricted (Ex - on mobiles).', 'dfd'),
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	//'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd')
);
/*youtube*/
//$row_params[] = array(
//	'type' => 'number',
//	'class' => '',
//	'heading' => __('Start Time', 'dfd'),
//	'param_name' => 'dfd_oembed_start_time',
//	'value' => '',
//	'suffix' => 'seconds',
//	/*'description' => __('Enter time in seconds from where video start to play.', 'dfd'),*/
//	'dependency' => Array('element' => 'dfd_video_variant','value' => array('oembed')),
//	'group' => esc_attr__('Background options', 'dfd')
//);
//$row_params[] = array(
//	'type' => 'number',
//	'class' => '',
//	'heading' => __('Stop Time', 'dfd'),
//	'param_name' => 'dfd_oembed_stop_time',
//	'value' => '',
//	'suffix' => 'seconds',
//	'description' => __('You may start / stop the video at any point you would like.', 'dfd'),
//	'dependency' => Array('element' => 'dfd_video_variant','value' => array('oembed')),
//	'group' => esc_attr__('Background options', 'dfd')
//);
//$row_params[] = array(
//	'type' => 'checkbox',
//	'class' => '',
//	'heading' => __('Play video only when in viewport', 'dfd'),
//	'param_name' => 'dfd_in_viewport',
//	//'admin_label' => true,
//	'value' => array(esc_attr__('Yes, please') => 'yes'),
//	'description' => __('Video will be played only when user is on the particular screen position. Once user scroll away, the video will pause.', 'dfd'),
//	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
//	'group' => esc_attr__('Background options', 'dfd')
//);
$row_params[] = array(
	'type' => 'ult_switch',
	'class' => '',
	'heading' => __('Display Controls', 'dfd'),
	'param_name' => 'dfd_enable_controls',
	//'admin_label' => true,
	//'value' => array(esc_attr__('Yes, please') => 'yes'),
	'value' => 'yes',
	'options' => array(
		'yes' => array(
				'label' => esc_html__('Yes, please','dfd'),
				'on' => 'Yes',
				'off' => 'No',
			),
		),
	'description' => __('Display play / pause controls for the video on bottom right position.', 'dfd'),
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => __('Color of Controls Icon', 'dfd'),
	'param_name' => 'dfd_controls_color',
	//'admin_label' => true,
	//'description' => __('Display play / pause controls for the video on bottom right position.', 'dfd'),
	'dependency' => Array('element' => 'dfd_enable_controls','value' => array('display_control')),
	'group' => esc_attr__('Background options', 'dfd')
);