<?php

return array(

	'subtitle' => array(
		'label'   => __('Subtitle', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Text displayed with main title of service box', 'ait-toolkit'),
	),
	'iconFont' => array(
		'label'   => __('Icon Font', 'ait-admin'),
		'type'    => 'font-awesome-select',
		'default' => '',
		'help'    => __("Class of icon from FontAwesome", 'ait-admin'),
	),
	'image' => array(
		'label'   => __('Image', 'ait-toolkit'),
		'type'    => 'image',
		'default' => '',
		'help'    => __('URL of image displayed in service box', 'ait-toolkit'),
	),
	'hoverImage' => array(
		'label'   => __('Hover Image', 'ait-toolkit'),
		'type'    => 'image',
		'default' => '',
		'help'    => __('URL of image displayed in service box on hover event', 'ait-toolkit'),
	),
	'description' => array(
		'label' => __('Description', 'ait-toolkit'),
		'type'  => 'textarea',
		'rows'  => 6,
		'help'  => __('Main text displayed in service box', 'ait-toolkit'),
	),
	'readMoreText' => array(
		'label'   => __('"Read more" text', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Text for "Read more" link', 'ait-toolkit'),
	),
	'link' => array(
		'label'   => __('Link', 'ait-toolkit'),
		'type'    => 'url',
		'default' => '',
		'help'    => __('URL of "Read more" link, use valid URL format with http://', 'ait-toolkit'),
	),
);
