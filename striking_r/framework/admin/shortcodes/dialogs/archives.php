<?php
return array(
	"title" => __("Archives", "theme_admin"),
	"shortcode" => 'archives',
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
	),
);
