<?php

return array(
	"name" => __("Icon", 'health-center') ,
	"value" => "icon",
	"options" => array(
		array(
			'name' => __('Name', 'health-center') ,
			'id' => 'name',
			'default' => '',
			'type' => 'icons',
		) ,
		array(
			"name" => __("Color (optional)", 'health-center') ,
			"id" => "color",
			"default" => "",
			"prompt" => '',
			"options" => array(
				'accent1' => __('Accent 1', 'health-center'),
				'accent2' => __('Accent 2', 'health-center'),
				'accent3' => __('Accent 3', 'health-center'),
				'accent4' => __('Accent 4', 'health-center'),
				'accent5' => __('Accent 5', 'health-center'),
				'accent6' => __('Accent 6', 'health-center'),
				'accent7' => __('Accent 7', 'health-center'),
				'accent8' => __('Accent 8', 'health-center'),
			) ,
			"type" => "select",
		) ,
		array(
			'name' => __('Size', 'health-center'),
			'id' => 'size',
			'type' => 'range',
			'default' => 16,
			'min' => 8,
			'max' => 100,
		),
		array(
			"name" => __("Style", 'health-center') ,
			"id" => "style",
			"default" => '',
			"prompt" => __('Default', 'health-center'),
			"options" => array(
				'inverted-colors' => __('Invert colors', 'health-center'),
				'box' => __('Box', 'health-center'),
			) ,
			"type" => "select",
		) ,
	)
);