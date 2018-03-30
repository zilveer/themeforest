<?php
$config = array(
	'title' => __('Slide Options', TEMPLATENAME),
	'id' => 'slideshow',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		'name' => __('URL (optional)', TEMPLATENAME),
		'desc' => __('The url that the slider item linked to.', TEMPLATENAME),
		'id' => '_link_to',
		'default' => '',
		'type' => 'superlink'
	),
);
new metaboxesGenerator($config,$options);