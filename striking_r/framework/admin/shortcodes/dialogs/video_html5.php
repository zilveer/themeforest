<?php
return array(
	"title" => __("HTML 5", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="html5"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Poster Image",'theme_admin'),
			"desc" => __("The poster image is placeholder for the video before it plays. It's also used as the image fallback for devices that don't support HTML5 Video or Flash. ",'theme_admin'),
			"id" => "poster",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("MP4 Source",'theme_admin'),
			"desc" => __("Supported by Webkit browsers (Safari, Chrome, iPhone/iPad) and Internet Explorer 9. Also supported by Flash 9 and higher, so can double as the Flash source.",'theme_admin'),
			"id" => "mp4",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("WebM Source",'theme_admin'),
			"desc" => __('Supported by newer versions of Firefox, Chrome, and Opera.','theme_admin'),
			"id" => "webm",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Ogg Source",'theme_admin'),
			"desc" => __("Supported by Firefox, Opera, Chrome, and newer versions of Safari. Unfortunately it's not as good as WebM and MP4.",'theme_admin'),
			"id" => "ogg",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Flv Source",'theme_admin'),
			"desc" => __("Use a flash player to play flv source in all browsers.",'theme_admin'),
			"id" => "flv",
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
			"name" => __("Download Links",'theme_admin'),
			"id" => "download",
			"desc" => __("If you want to support devices that don't support HTML5 or Flash, include links to the video source.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Preload",'theme_admin'),
			"id" => "preload",
			"desc" => __("Select this if you want the video to start downloading as soon the user loads the page.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Autoplay",'theme_admin'),
			"id" => "autoplay",
			"desc" => __("Select this if you want the video to start playing as soon as the page is loaded.",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Always Show Controls",'theme_admin'),
			"id" => "alwaysShowControls",
			"desc" => __("Hide controls when playing and mouse is not over the video",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Hide Video Controls On Load",'theme_admin'),
			"id" => "hideVideoControlsOnLoad",
			"desc" => __("Display the video control",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Click To Play Pause",'theme_admin'),
			"id" => "clickToPlayPause",
			"desc" => __("Enable click video element to toggle play/pause",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("iPad Use Native Controls",'theme_admin'),
			"id" => "iPadUseNativeControls",
			"desc" => __("force iPad's native controls",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("iPhone Use Native Controls",'theme_admin'),
			"id" => "iPhoneUseNativeControls",
			"desc" => __("force iPhone's native controls",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Android Use Native Controls",'theme_admin'),
			"id" => "androidUseNativeControls",
			"desc" => __("force iPhone's native controls",'theme_admin'),
			"default" => 'default',
			"type" => "tritoggle"
		),
	),
);