<?php 
class Theme_Options_Page_Media extends Theme_Options_Page_With_Tabs {
	public $slug = 'media';

	function __construct(){
		$this->name = __('Media Settings','theme_admin');
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'html5',
				"name" => __("Html5 video",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "html5_width",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "html5_height",
						"default" => 355,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					/*
					array(
						"name" => __("Download Links",'theme_admin'),
						"id" => "html5_download",
						"desc" => __("If you want to support devices that don't support HTML5 or Flash, include links to the video source.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),*/
					array(
						"name" => __("Preload",'theme_admin'),
						"id" => "html5_preload",
						"desc" => __("Select this if you want the video to start downloading as soon the user loads the page.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"id" => "html5_autoplay",
						"desc" => __("Select this if you want the video to start playing as soon as the page is loaded.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Loop",'theme_admin'),
						"id" => "html5_loop",
						"desc" => __("Select this if you want loop the video when it ends .",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Always Show Controls",'theme_admin'),
						"id" => "html5_alwaysShowControls",
						"desc" => __("Hide controls when playing and mouse is not over the video",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Hide Video Controls On Load",'theme_admin'),
						"id" => "html5_hideVideoControlsOnLoad",
						"desc" => __("Display the video control",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Click To Play Pause",'theme_admin'),
						"id" => "html5_clickToPlayPause",
						"desc" => __("Enable click video element to toggle play/pause",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("iPad Use Native Controls",'theme_admin'),
						"id" => "html5_iPadUseNativeControls",
						"desc" => __("force iPad's native controls",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("iPhone Use Native Controls",'theme_admin'),
						"id" => "html5_iPhoneUseNativeControls",
						"desc" => __("force iPhone's native controls",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Android Use Native Controls",'theme_admin'),
						"id" => "html5_androidUseNativeControls",
						"desc" => __("force iPhone's native controls",'theme_admin'),
						"default" => true,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'flash',
				"name" => __("Flash",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "flash_width",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "flash_height",
						"default" => 355,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'youtube',
				"name" => __("YouTube",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "youtube_width",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "youtube_height",
						"default" => 380,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Autohide",'theme_admin'),
						"desc" => __('Set whether the video controls will automatically hide after a video begins playing.','theme_admin'),
						"id" => "youtube_autohide",
						"default" => '2',
						"options" => array(
							"0" => __('Visible','theme_admin'),
							"1" => __('Hide all','theme_admin'),
							"2" => __('Hide video progress bar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"desc" => __('Sets whether or not the initial video will autoplay when the player loads','theme_admin'),
						"id" => "youtube_autoplay",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Controls",'theme_admin'),
						"desc" => __('Sets whether or not display the video player controls.','theme_admin'),
						"id" => "youtube_controls",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Disablekb",'theme_admin'),
						"desc" => __('Enable it will disable the player keyboard controls.','theme_admin'),
						"id" => "youtube_disablekb",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Fs",'theme_admin'),
						"desc" => __('Sets whether or not enable the fullscreen button.','theme_admin'),
						"id" => "youtube_fs",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Loop",'theme_admin'),
						"desc" => __('Enable it will will cause the player to play the initial video again and again.','theme_admin'),
						"id" => "youtube_loop",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Rel",'theme_admin'),
						"desc" => __('Sets whether the player should load related videos once playback of the initial video starts.','theme_admin'),
						"id" => "youtube_rel",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("showinfo",'theme_admin'),
						"desc" => __('Enable it will will cause the player to play the initial video again and again.','theme_admin'),
						"id" => "youtube_showinfo",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Modestbranding",'theme_admin'),
						"desc" => __('Sets whether or not show a YouTube logo.','theme_admin'),
						"id" => "youtube_modestbranding",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("enablejsapi",'theme_admin'),
						"desc" => __('Sets whether or not enabling the JavaScript API handlers for player','theme_admin'),
						"id" => "youtube_enablejsapi",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Theme",'theme_admin'),
						"desc" => __('Set whether the embedded player will display player controls (like a \'play\' button or volume control) within a dark or light control bar. ','theme_admin'),
						"id" => "youtube_theme",
						"default" => 'light',
						"options" => array(
							"light" => __('Light','theme_admin'),
							"dark" => __('Dark','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'vimeo',
				"name" => __("Vimeo",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "vimeo_width",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "vimeo_height",
						"default" => 355,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Byline",'theme_admin'),
						"desc" => __('Sets whether or not show the byline on the video','theme_admin'),
						"id" => "vimeo_byline",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Title",'theme_admin'),
						"desc" => __('Sets whether or not show the title on the video','theme_admin'),
						"id" => "vimeo_title",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Portrait",'theme_admin'),
						"desc" => __("Sets whether or not show the user's portrai on the video",'theme_admin'),
						"id" => "vimeo_portrait",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"desc" => __("Sets whether or not automatically start playback of the video.",'theme_admin'),
						"id" => "vimeo_autoplay",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Loop",'theme_admin'),
						"desc" => __('Sets whether or not play the initial video again and again.','theme_admin'),
						"id" => "vimeo_loop",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'dailymotion',
				"name" => __("Dailymotion",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "dailymotion_width",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "dailymotion_height",
						"default" => 355,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Related",'theme_admin'),
						"desc" => __("Sets whether or not loads related videos when the current video begins playback.",'theme_admin'),
						"id" => "dailymotion_related",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"desc" => __("Sets whether or not automatically start playback of the video.",'theme_admin'),
						"id" => "dailymotion_autoplay",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Chromeless",'theme_admin'),
						"desc" => __("Sets whether or not display controls or not during video playback.",'theme_admin'),
						"id" => "dailymotion_chromeless",
						"default" => false,
						"type" => "toggle"
					),
				),
			),
			array(
				"slug" => 'bliptv',
				"name" => __("Blip.tv",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "blip_height",
						"default" => 630,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "blip_height",
						"default" => 355,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
				),
			),
			array(
				"slug" => 'audio',
				"name" => __("Audio",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Width",'theme_admin'),
						"desc" => "",
						"id" => "audio_width",
						"default" => 400,
						"min" => 0,
						"max" => 960,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Height",'theme_admin'),
						"desc" => "",
						"id" => "audio_height",
						"default" => 30,
						"min" => 0,
						"max" => 100,
						"unit" => 'px',
						"type" => "range"
					),
					array(
						"name" => __("Preload",'theme_admin'),
						"id" => "audio_preload",
						"desc" => __("Select this if you want the audio to start downloading as soon the user loads the page.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"id" => "audio_autoplay",
						"desc" => __("Select this if you want the audio to start playing as soon as the page is loaded.",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Loop",'theme_admin'),
						"id" => "audio_loop",
						"desc" => __("Select this if you want loop the audio when it ends .",'theme_admin'),
						"default" => false,
						"type" => "toggle"
					),
				),
			),
		);
		return $options;
	}
}
