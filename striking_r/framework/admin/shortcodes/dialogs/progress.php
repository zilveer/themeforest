<?php
return array(
	"title" => __("Progress", "theme_admin"),
	"shortcode" => 'progress',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => 'default',
			"options" => array(
				"default" => 'Default',
				"radius" => 'Radius',
				"round" => 'Round',
			),
			"type" => "select",
		),
		array(
			"name" => __("Size",'theme_admin'),
			"id" => "size",
			"default" => 'default',
			"options" => array(
				"default" => 'Default',
				"small" => 'Small',
				"large" => 'Large',
			),
			"type" => "select",
		),
		array (
			"name" => __("Percent",'theme_admin'),
			"id" => "percent",
			"default" => '0',
			"min" => 0,
			"max" => 100,
			"step" => "1",
			'unit' => '%',
			"type" => "range",
		),
		array(
			"name" => __("Show Percent Text",'theme_admin'),
			"id" => "text",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Text Color (Optional)&#x200E;",'theme_admin'),
			"id" => "textcolor",
			"default" => "",
			"type" => "color",
			"format" => 'hex',
		),
		array(
			"name" => __("Bar Color (Optional)&#x200E;",'theme_admin'),
			"id" => "barcolor",
			"default" => "",
			"type" => "color",
			"format" => 'hex',
		),
		array(
			"name" => __("Track Color (Optional)&#x200E;",'theme_admin'),
			"id" => "trackcolor",
			"default" => "",
			"type" => "color",
			"format" => 'hex',
		),
	),
	"custom" => '',
);