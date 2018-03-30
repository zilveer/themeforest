<?php

return array(

	'title' => array(
		'label'   => __('Title', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Text displayed as title in header of table', 'ait-toolkit'),
	),

	'subtitle' => array(
		'label'   => __('Subtitle', 'ait-admin'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Text displayed as subtitle in header of table', 'ait-admin'),
	),

	'description' => array(
		'label'   => __('Description', 'ait-toolkit'),
		'type'    => 'textarea',
		'default' => '',
		'help'    => __('Text displayed below title in header of table', 'ait-toolkit'),
	),

	'price' => array(
		'label'   => __('Price', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Text displayed as price in header of table', 'ait-toolkit'),
	),

	'rows' => array(
		'label' => __('Table Rows', 'ait-toolkit'),
		'type'  => 'clone',
		'max'   => 'infinity',
		'help'  => __('Add new Row by click on "+ Add New Item" link, or remove existing Row by click on red cross. Click on "Remove All Items" link to remove all existing Rows.', 'ait-toolkit'),
		'items' => array(
			'description' => array(
				'label' => __('Row Text', 'ait-toolkit'),
				'type'  => 'text',
				'help'  => __('Text displayed in row', 'ait-toolkit'),
			),
		),
		'default' => array(
			array(
				'description' => '',
			),
		),
	),

	'buttonText' => array(
		'label'   => __('Button Text', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Title of button in footer of table', 'ait-toolkit'),
	),

	'buttonLink' => array(
		'label'   => __('Button Link', 'ait-toolkit'),
		'type'    => 'text',
		'default' => '',
		'help'    => __('Link used for button, use valid URL format with http://', 'ait-toolkit'),
	),

	'featured' => array(
		'label'   => __('Featured', 'ait-toolkit'),
		'type'    => 'on-off',
		'default' => true,
		'help'    => __('Highlight table as featured', 'ait-toolkit'),
	),
);
