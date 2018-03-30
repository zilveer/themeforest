<?php
return array(
	"title" => __("Dailymotion", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="dailymotion"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Clip_id",'theme_admin'),
			"desc" => __("the id from the clip's URL (e.g. http://www.dailymotion.com/video/<span style='color:red'>xf3fk2</span>_didacticiel-quicklist_tech)",'theme_admin'),
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
			"name" => __("Related",'theme_admin'),
			"desc" => __("Sets whether or not loads related videos when the current video begins playback.",'theme_admin'),
			"id" => "related",
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
			"name" => __("Chromeless",'theme_admin'),
			"desc" => __("Sets whether or not display controls or not during video playback.",'theme_admin'),
			"id" => "chromeless",
			"default" => 'default',
			"type" => "tritoggle"
		),
	),
);
