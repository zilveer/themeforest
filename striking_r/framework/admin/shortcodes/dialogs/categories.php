<?php
return array(
	"title" => __("Categories", "theme_admin"),
	"shortcode" => 'categories',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Display as dropdown",'theme_admin'),
			"id" => "dropdown",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show post counts",'theme_admin'),
			"id" => "count",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show hierarchy",'theme_admin'),
			"id" => "hierarchy",
			"default" => false,
			"type" => "toggle"
		),
	),
);
