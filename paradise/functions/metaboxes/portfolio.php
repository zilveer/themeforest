<?php
$config = array(
	'title' => __('Video File, Target Link', TEMPLATENAME),
	'id' => 'portfolio_link_box',
	'pages' => array('portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		'name' => __('URL (optional)', TEMPLATENAME),
		'desc' => __('The url that the portfolio post linked to.', TEMPLATENAME),
		'id' => 'target_link',
		'default' => '',
		'type' => 'superlink',
	),
	array(
		'name' => __('Video (optional)', TEMPLATENAME),
		'desc' => __('The video file url show in portfolio.', TEMPLATENAME),
		'id' => 'video_link',
		'default' => '',
		'type' => 'text',
		'class' => 'large-text',
	),
);
new metaboxesGenerator($config,$options);