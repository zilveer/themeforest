<?php
return array(
	"title" => __("Highlight", "theme_admin"),
	"shortcode" => 'highlight',
	"type" => 'enclosing',
	"options" => array(
		array(
			"name" => __("Type (Optional)&#x200E;",'theme_admin'),
			"id" => "type",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"light" => __("light",'theme_admin'),
				"dark" => __("dark",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => '',
);