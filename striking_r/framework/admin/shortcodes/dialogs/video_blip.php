<?php
return array(
	"title" => __("Blip.tv", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="blip"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Clip_id",'theme_admin'),
			"desc" => __("the id from the clip's URL (e.g. http://blip.tv/channel/video-title-<span style='color:red'>5491601</span>)",'theme_admin'),
			"id" => "clip_id",
			"size" => 30,
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
	),
);
