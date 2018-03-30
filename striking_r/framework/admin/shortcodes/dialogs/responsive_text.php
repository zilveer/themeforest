<?php
return array(
	"title" => __("Responsive Text", "theme_admin"),
	"shortcode" => 'responsive_text',
	"type" => 'enclosing',
	"options" => array(
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array (
			"name" => __("Compression",'theme_admin'),
			"id" => "compression",
			"default" => '10',
			"min" => 1,
			"max" => 100,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Max Font Size (Optional)&#x200E;",'theme_admin'),
			"id" => "max",
			"default" => '0',
			"min" => 0,
			"max" => 100,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Min Font Size (Optional)&#x200E;",'theme_admin'),
			"id" => "min",
			"default" => '0',
			"min" => 0,
			"max" => 50,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Line Height (Optional)&#x200E;",'theme_admin'),
			"id" => "lineHeight",
			"default" => '1',
			"min" => 1,
			"max" => 3,
			"step" => "0.1",
			"type" => "range"
		),
		array (
			"name" => __("Original Font Size (Optional)&#x200E;",'theme_admin'),
			"id" => "fontSize",
			"default" => '0',
			"min" => 0,
			"max" => 100,
			"step" => "1",
			"type" => "range"
		),
	),
	"custom" => '',
);