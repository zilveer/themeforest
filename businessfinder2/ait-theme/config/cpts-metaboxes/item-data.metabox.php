<?php

return array(

	'subtitle' => array(
		'label' => __('Subtitle', 'ait-admin'),
		'type' => 'text',
		'default' => "",
	),

	'featuredItem' => array(
		'label'        => __('Item Featured', 'ait-toolkit'),
		'type'         => 'on-off',
		'default'      => true,
		'capabilities' => true,
	),

	'headerType' => array(
		'label'    => __('Item Header', 'ait-toolkit'),
		'type'     => 'select',
		'selected' => 'map',
		'default' => array(
			'none'  => __('No header', 'ait-toolkit'),
			'map'   => __('Map', 'ait-toolkit'),
			'image' => __('Image', 'ait-toolkit'),
		),
		'capabilities' => true,
		'help' => __('Select type of header on page', 'ait-toolkit'),
	),

	array('section' => array('id' => 'headerType-image', 'title' => __('Image Options', 'ait-toolkit'), 'capabilities' => true)),

	'headerImage' => array(
		'label'   => __('Header Image', 'ait-toolkit'),
		'type'    => 'image',
		'default' => '',
		'help'    => __('Image displayed in header', 'ait-toolkit'),
	),

	'headerHeight' => array(
		'label' => __('Header Height', 'ait-admin'),
		'type' => 'number',
		'default' => "",
		'unit' => 'px',
	),

	array('section' => array('title' => __('General', 'ait-toolkit'))),

	'map' => array(
		'label' => __('Address', 'ait-toolkit'),
		'type' => 'map',
		'default' => array(
			'address'    => '',
			'latitude'   => '1',
			'longitude'  => '1',
			'streetview' => false,
		),
		'capabilities' => true,
		'help' => __('Specify address and position of item', 'ait-toolkit'),
	),

	'telephone' => array(
		'label'        => __('Telephone', 'ait-toolkit'),
		'type'         => 'string',
		'capabilities' => true,
		'help'         => __('Telephone number related to item', 'ait-toolkit'),
	),

	'telephoneAdditional' => array(
		'label' => __('Additional telephone numbers', 'ait-toolkit'),
		'type' => 'clone',
		'max' => 5,
		'items' => array(
			'number' => array(
				'label' => __('Number', 'ait-toolkit'),
				'type' => 'string',
			),
		),
		'default' => array(),
		'help' => __('Additional telephone numbers related to item', 'ait-toolkit'),
		'capabilities' => true,
	),

	'email' => array(
		'label'        => __('Email', 'ait-toolkit'),
		'type'         => 'string',
		'default'      => '',
		'capabilities' => true,
		'help'         => __('Email address related to item', 'ait-toolkit'),
	),

	'showEmail' => array(
		'label'        => __('Show Email', 'ait-toolkit'),
		'type'         => 'on-off',
		'default'      => true,
		'capabilities' => true,
		'help'         => __('Display or hide email address on page', 'ait-toolkit'),
	),

	'contactOwnerBtn' => array(
		'label'        => __('Contact owner button', 'ait-toolkit'),
		'type'         => 'on-off',
		'default'      => 'off',
		'capabilities' => true,
		'help'         => __('Create contact form on page', 'ait-toolkit'),
	),

	'web' => array(
		'label'        => __('Web', 'ait-toolkit'),
		'type'         => 'url',
		'default'      => '',
		'capabilities' => true,
		'help'         => __('Web address, use valid URL format with http://', 'ait-toolkit'),
	),

	'webLinkLabel' => array(
		'label'        => __('Web Link Label', 'ait-toolkit'),
		'type'         => 'string',
		'default'      => '',
		'capabilities' => true,
		'help'         => __('Text displayed instead of full web address', 'ait-toolkit'),
	),

	array('section' => array('id' => 'itemOpeningHours', 'title' => __('Opening Hours', 'ait-toolkit'), 'capabilities' => true)),

	'displayOpeningHours' => array(
		'label'   => __('Show', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => false,
		'basic'   => true,
		'help'    => __('Display or hide Opening Hours section', 'ait-toolkit'),
	),

	'openingHoursMonday' => array(
		'label' => __('Monday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursTuesday' => array(
		'label' => __('Tuesday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursWednesday' => array(
		'label' => __('Wednesday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursThursday' => array(
		'label' => __('Thursday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursFriday' => array(
		'label' => __('Friday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursSaturday' => array(
		'label' => __('Saturday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursSunday' => array(
		'label' => __('Sunday', 'ait-toolkit'),
		'type'  => 'text',
		'basic' => true,
	),

	'openingHoursNote' => array(
		'label' => __('Note', 'ait-toolkit'),
		'type'  => 'textarea',
		'basic' => true,
	),

	array('section' => array('id' => 'itemSocialIcons', 'title' => __('Social', 'ait-toolkit'), 'capabilities' => true)),

	'displaySocialIcons' => array(
		'label'   => __('Show', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => false,
		'help'    => __('Display or hide Social Icons section', 'ait-toolkit'),
	),

	'socialIconsOpenInNewWindow' => array(
		'label'   => __('Open links in new window', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => true,
	),

	'socialIcons' => array(
		'type' => 'clone',
		'max' => 20,
		'items' => array(
			'icon' => array(
				'label'    => __('Icon', 'ait-toolkit'),
				'type'     => 'font-awesome-select',
				'category' => 'social',
				'default'  => '',
				'help'     => __('Select predefined social icon, Image will be ignored', 'ait-toolkit'),
			),
			'link' => array(
				'label'   => __('Link', 'ait-toolkit'),
				'type'    => 'url',
				'default' => '',
			),
		),
		'default' => array(),
	),

	array('section' => array('id' => 'itemGallery', 'title' => __('Gallery', 'ait-toolkit'), 'capabilities' => true)),


	'displayGallery' => array(
		'label'   => __('Show', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => false,
	),

	'gallery' => array(
		'type' => 'clone',
		'max' => 20,
		'items' => array(
			'title' => array(
				'label' => __('Title', 'ait-toolkit'),
				'type'  => 'text',
			),
			'image' => array(
				'label' => __('Image', 'ait-toolkit'),
				'type'  => 'image',
			),
		),
		'default' => array(),
		'help' => __('Display or hide Gallery section', 'ait-toolkit'),
	),

	array('section' => array('id' => 'itemFeatures', 'title' => __('Features', 'ait-toolkit'), 'capabilities' => true)),

	'displayFeatures' => array(
		'label'   => __('Show', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => false,
		'help'    => __('Display or hide Features section', 'ait-toolkit'),
	),

	'features' => array(
		'type' => 'clone',
		'max' => 20,
		'default' => array(),
		'items' => array(
			'icon' => array(
				'label' => __('Icon', 'ait-toolkit'),
				'type' => 'font-awesome-select',
				'help' => __('Icon image displayed with feature', 'ait-toolkit'),
			),
			'text' => array(
				'label' => __('Title', 'ait-toolkit'),
				'type' => 'string',
				'help' => __('Feature main text', 'ait-toolkit'),
			),
			'desc' => array(
				'label' => __('Description', 'ait-toolkit'),
				'type' => 'string',
				'help' => __('Feature descriptive text', 'ait-toolkit'),
			),
		),
	),

	array('section' => array('id' => 'itemCustomFields', 'title' => __('Custom Fields', 'ait-toolkit'), 'capabilities' => true)),

	'customFields' => array(
		'type' => 'clone',
		'max' => 99,
		'default' => array(),
		'items' => array(
			'name' => array(
				'label' => __('Name', 'ait-toolkit'),
				'type'  => 'string',
				'default' => '',
				'help'  => __('Do not use system reserved names (post_id, rating_count, rating_max, rating_mean, rating_mean_rounded), they will be ignored', 'ait-toolkit'),
			),
			'value' => array(
				'label' => __('Value', 'ait-toolkit'),
				'type'  => 'multiline-string',
				'default' => '',
			),
		),
	),
);