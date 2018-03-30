<?php
return array(
	"title" => __("Search", "theme_admin"),
	"shortcode" => 'search',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Search Button <br />Background Color (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Use this setting to customize the background color of the search button, which is gray by default. ",'theme_admin'),
			"id" => "bgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Search Button Text Color (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Use this setting to customize the background color of the search button, which is white by default. ",'theme_admin'),
			"id" => "textColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Use Search Icon Button&#x200E;",'theme_admin'),
			"id" => "useIcon",
			"default" => true,
			"type" => "toggle"
		),
	),
	"custom" => '',
);
