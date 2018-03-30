<?php
return array(
	"title" => __("Flickr", "theme_admin"),
	"shortcode" => 'flickr',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => 'page',
			"options" => array(
				"user" => __("User",'theme_admin'),
				"group" => __("Group",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Flickr id (<a href='http://idgettr.com/' target='_blank'>idGettr</a>)",'theme_admin'),
			"id" => "id",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("Count",'theme_admin'),
			"desc" => "",
			"id" => "count",
			"default" => '4',
			"min" => 0,
			"max" => 20,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Display",'theme_admin'),
			"id" => "display",
			"default" => 'latest',
			"options" => array(
				"latest" => __('Latest','theme_admin'),
				"random" => __('Random','theme_admin'),
			),
			"type" => "select",
		),
	),
);
