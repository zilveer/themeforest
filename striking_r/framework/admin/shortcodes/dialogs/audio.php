<?php
return array(
	"title" => __("Audio", "theme_admin"),
	"shortcode" => 'audio',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("mp3 Source",'theme_admin'),
			"id" => "mp3",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Ogg Source (Optional)&#x200E;",'theme_admin'),
			"id" => "ogg",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array (
			"name" => __("Width",'theme_admin'),
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Height",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Preload",'theme_admin'),
			"id" => "preload",
			"desc" => __("Select this if you want the audio to start downloading as soon the user loads the page.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Autoplay",'theme_admin'),
			"id" => "autoplay",
			"desc" => __("Select this if you want the audio to start playing as soon as the page is loaded.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Loop",'theme_admin'),
			"id" => "audio_loop",
			"desc" => __("Select this if you want loop the audio when it ends .",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
	),
);
