<?php
return array(
	"title" => __("Youtube", "theme_admin"),
	"shortcode" => 'tvideo',
	"attributes" => 'type="youtube"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Clip_id",'theme_admin'),
			"desc" => __("the id from the clip's URL after v= (e.g. http://www.youtube.com/watch?v=<span style='color:red'>2DclLrdaxQd</span>)",'theme_admin'),
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
			"name" => __("Autohide",'theme_admin'),
			"desc" => __('Set whether the video controls will automatically hide after a video begins playing.','theme_admin'),
			"id" => "autohide",
			"default" => 'default',
			"options" => array(
				"default"  => __('Default','theme_admin'),
				"0" => __('Visible','theme_admin'),
				"1" => __('Hide all','theme_admin'),
				"2" => __('Hide video progress bar','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Autoplay",'theme_admin'),
			"desc" => __('Sets whether or not the initial video will autoplay when the player loads','theme_admin'),
			"id" => "autoplay",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Controls",'theme_admin'),
			"desc" => __('Sets whether or not display the video player controls.','theme_admin'),
			"id" => "controls",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Disablekb",'theme_admin'),
			"desc" => __('Enable it will disable the player keyboard controls.','theme_admin'),
			"id" => "disablekb",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Fs",'theme_admin'),
			"desc" => __('Sets whether or not enable the fullscreen button.','theme_admin'),
			"id" => "fs",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array (
			"name" => __("Start",'theme_admin'),
			"desc" => __('This parameter causes the player to begin playing the video at the given number of seconds from the start of the video.','theme_admin'),
			"id" => "start",
			"default" => 0,
			"min" => 0,
			"max" => 2000,
			'unit' => __('seconds','theme_admin'),
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Loop",'theme_admin'),
			"desc" => __('Enable it will will cause the player to play the initial video again and again.','theme_admin'),
			"id" => "loop",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Rel",'theme_admin'),
			"desc" => __('Sets whether the player should load related videos once playback of the initial video starts.','theme_admin'),
			"id" => "rel",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("showinfo",'theme_admin'),
			"desc" => __('Enable it will will cause the player to play the initial video again and again.','theme_admin'),
			"id" => "showinfo",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Modestbranding",'theme_admin'),
			"desc" => __('Sets whether or not show a YouTube logo.','theme_admin'),
			"id" => "modestbranding",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Theme",'theme_admin'),
			"desc" => __('Set whether the embedded player will display player controls (like a \'play\' button or volume control) within a dark or light control bar.','theme_admin'),
			"id" => "theme",
			"default" => 'default',
			"options" => array(
				"default"  => __('Default','theme_admin'),
				"light" => __('Light','theme_admin'),
				"dark" => __('Dark','theme_admin'),
			),
			"type" => "select",
		),
	),
);
