<?php

return array(
	'position' => array(
		'label' => _x('Position', 'job position', 'ait-toolkit'),
		'type'  => 'text',
		'help'  => __('Position of member in the company, community, etc', 'ait-toolkit'),
	),

	'about' => array(
		'label' => __('About member', 'ait-toolkit'),
		'type'  => 'textarea',
		'rows'  => 8,
		'help'  => __('Information about member', 'ait-toolkit'),
	),

	'aboutShort' => array(
		'label' => __('Short Description', 'ait-admin'),
		'type'  => 'text',
		'help'  => __('Short information about member - used in Members Element or short description in Member Element', 'ait-admin'),
	),

	'contacts' => array(
		'label' => __('Contact Data', 'ait-admin'),
		'type'  => 'clone',
		'max'   => 10,
		'help'  => __('Add new Contact Data by click on "+ Add New Item" link, or remove existing Contact Data by click on red cross. Click on "Remove All Items" link to remove all existing Contact Data.', 'ait-admin'),
		'items' => array(
			'title' => array(
				'label' => __('Title', 'ait-admin'),
				'type'  => 'text',
				'help'  => __("Text of contact", 'ait-admin'),
			),
			'url' => array(
				'label' => __('Link', 'ait-admin'),
				'type'  => 'url',
				'help'  => __("Contact link, use valid URL format with 'http://", 'ait-admin'),
			),
		),
		'default' => array(),
	),

	'icons' => array(
		'label' => __('Social Icons', 'ait-toolkit'),
		'type' => 'clone',
		'max' => 10,
		'default' => array(),
		'items' => array(
			'title' => array(
				'label' => __('Title', 'ait-toolkit'),
				'type'  => 'text',
				'help'  => __('Social icon title', 'ait-toolkit'),
			),
			'icon' => array(
				'label'    => __('Icon', 'ait-admin'),
				'type'     => 'font-awesome-select',
				'category' => 'social',
				'help'     => __('Social icon', 'ait-admin'),
			),
			'url' => array(
				'label' => __('Link', 'ait-toolkit'),
				'type'  => 'url',
				'help'  => __('Social icon link, use valid URL format with http://', 'ait-toolkit'),
			),
		),
		'help' => __('Add new Social Icon by click on "+ Add New Item" link, or remove existing Social Icon by click on red cross. Click on "Remove All Items" link to remove all existing Social Icons.', 'ait-toolkit'),
	),
);
