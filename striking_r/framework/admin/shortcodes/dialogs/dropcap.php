<?php
return array(
	"title" => __("Drop Cap", "theme_admin"),
	"shortcode" => 'dropcap',
	"type" => 'enclosing',
	"options" => array(
		array(
			"name" => __("Style",'theme_admin'),
			"id" => "style",
			"default" => 'dropcap1',
			"options" => array(
				"dropcap1" => 'dropcap1',
				"dropcap2" => 'dropcap2',
				"dropcap3" => 'dropcap3',
				"dropcap4" => 'dropcap4',
			),
			"type" => "select",
		),
		array(
			"name" => __("Color (Optional)&#x200E;",'theme_admin'),
			"id" => "color",
			"default" => "",
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"black" => 'Black',
				"gray" => 'Gray',
				"red" => 'Red',
				"yellow" => 'Yellow',
				"blue" => 'Blue',
				"pink" => 'Pink',
				"green" => 'Green',
				"rosy" => 'Rosy',
				"orange" => 'Orange',
				"magenta" => 'Magenta',
			),
			"type" => "select",
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "text"
		),
	),
	"custom" => '',
);