<?php
return array(
	"title" => __("vimeo", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="vimeo"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Clip_id",'theme_admin'),
			"desc" => __("the number from the clip's URL (e.g. http://vimeo.com/<span style='color:red'>123456</span>)",'theme_admin'),
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
		array(
			"name" => __("Byline",'theme_admin'),
			"desc" => __('Sets whether or not show the byline on the video','theme_admin'),
			"id" => "byline",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Title",'theme_admin'),
			"desc" => __('Sets whether or not show the title on the video','theme_admin'),
			"id" => "title",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Portrait",'theme_admin'),
			"desc" => __("Sets whether or not show the user's portrai on the video",'theme_admin'),
			"id" => "portrait",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Autoplay",'theme_admin'),
			"desc" => __("Sets whether or not automatically start playback of the video.",'theme_admin'),
			"id" => "autoplay",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Loop",'theme_admin'),
			"desc" => __('Sets whether or not play the initial video again and again.','theme_admin'),
			"id" => "loop",
			"default" => 'default',
			"type" => "tritoggle"
		),
	),
);
