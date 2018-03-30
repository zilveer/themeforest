<?php
return array(
	"title" => __("Flash", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="flash"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Src",'theme_admin'),
			"desc" => __('Specifies the location (URL) of the movie to be loaded','theme_admin'),
			"id" => "src",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Id (Optional)&#x200E;",'theme_admin'),
			"id" => "id",
			"default" => "",
			"type" => "text",
		),
		array (
			"name" => __("Width (Optional)&#x200E;",'theme_admin'),
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Height (Optional)&#x200E;",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Play",'theme_admin'),
			"id" => "play",
			"desc" => __("Specifies whether the movie begins playing immediately on loading in the browser.",'theme_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("flashvars (Optional)&#x200E;",'theme_admin'),
			"desc" => __("variable to pass to Flash Player.",'theme_admin'),
			"id" => "flashvars",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
	),
);
