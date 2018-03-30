<?php
	
	$designare_general_options= array( array(
		"name" => "Sliders Settings",
		"type" => "title",
		"img" => DESIGNARE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"camera", "name"=>"Designare Slider"), array("id"=>"flex", "name"=>"Flex Slider"), array("id"=>"rev","name" => "Revolution Slider"))
	),
	
	
	/* ------------------------------------------------------------------------*
	 * Camera Slider
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'camera'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Designare Slider Settings</h3>"
	),
	
	array(
		"name" => "Show timeline",
		"id" => DESIGNARE_SHORTNAME."_camera_timeline",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Show Controls",
		"id" => DESIGNARE_SHORTNAME."_camera_controls",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Show thumbnails",
		"id" => DESIGNARE_SHORTNAME."_camera_thumbnails",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Transition Effect",
		"id" => DESIGNARE_SHORTNAME."_camera_transition",
		"type" => "select",
		"options" => array(array("name"=>"Random", "id"=>"random"), array("name"=>"Simple Fade", "id"=>"simpleFade"), array("name"=>"Curtain Top-Left", "id"=>"curtainTopLeft"), array("name"=>"Custain Top-Right", "id"=>"curtainTopRight"), array("name"=>"Curtain Bottom-Left", "id"=>"curtainBottomLeft"), array("name"=>"Curtain Bottom-Right", "id"=>"curtainBottomRight"), array("name"=>"Curtain Slice-Left", "id"=>"curtainSliceLeft"), array("name"=>"Curtain Slice-Right", "id"=>"curtainSliceRight"), array("name"=>"Blind Curtain Top-Left", "id"=>"blindCurtainTopLeft"), array("name"=>"Blind Curtain Top-Right", "id"=>"blindCurtainTopRight"), array("name"=>"Blind Curtain Bottom-Left", "id"=>"blindCurtainBottomLeft"), array("name"=>"Blind Curtain Bottom-Right", "id"=>"blindCurtainBottomRight"), array("name"=>"Blind Curtain Slice-Bottom", "id"=>"blindCurtainSliceBottom"), array("name"=>"Blind Curtain Slice-Top", "id"=>"blindCurtainSliceTop"), array("name"=>"Stampede", "id"=>"stampede"), array("name"=>"Mosaic", "id"=>"mosaic"), array("name"=>"Mosaic Reverse", "id"=>"mosaicReverse"), array("name"=>"Mosaic Random", "id"=>"mosaicRandom"), array("name"=>"Mosaic Spiral", "id"=>"mosaicSpiral"), array("name"=>"Mosaic Spiral Reverse", "id"=>"mosaicSpiralReverse"), array("name"=>"Top Left Bottom Right", "id"=>"topLeftBottomRight"), array("name"=>"Bottom Right Top Left", "id"=>"bottomRightTopLeft"), array("name"=>"Bottom Left Top Right", "id"=>"bottomLeftTopRight"), array("name"=>"Bottom Left Top Right", "id"=>"bottomLeftTopRight")),
		"std" => "random",
		"description" => ""
	),
	
	array(
		"name" => "Transition Duration",
		"id" => DESIGNARE_SHORTNAME."_camera_transition_duration",
		"type" => "text",
		"std" => 500,
		"description" => "The duration of the transition between slides."
	),
	
	array(
		"name" => "Slide Duration",
		"id" => DESIGNARE_SHORTNAME."_camera_slide_duration",
		"type" => "text",
		"std" => 5500,
		"description" => "The duration of each slide"
	),
	
	array(
		"name" => "Autoplay",
		"id" => DESIGNARE_SHORTNAME."_camera_autoplay",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Pause on Hover",
		"id" => DESIGNARE_SHORTNAME."_camera_pause_hover",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => "Play/Pause on mouse out/over"
	),
	
	array(
		"name" => "Slider Height",
		"id" => DESIGNARE_SHORTNAME."_camera_height",
		"type" => "text",
		"std" => "400px",
		"description" => "The height of the slider."
	),

	
	array(
		"type" => "close"
	),
	
	/* ------------------------------------------------------------------------*
	 * Flex Slider
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'flex'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>HOMEPAGE - Flex Slider Settings</h3>"
	),

	array(
		"name" => "Show Direction Controls",
		"id" => DESIGNARE_SHORTNAME."_flex_navigation",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),

	array(
		"name" => "Show Controls",
		"id" => DESIGNARE_SHORTNAME."_flex_controls",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Transition Effect",
		"id" => DESIGNARE_SHORTNAME."_flex_transition",
		"type" => "select",
		"options" => array(array("name"=>"Slide", "id"=>"slide"), array("name"=>"Fade", "id"=>"fade")),
		"std" => "random",
		"description" => ""
	),
	
	array(
		"name" => "Transition Duration",
		"id" => DESIGNARE_SHORTNAME."_flex_transition_duration",
		"type" => "text",
		"std" => 500,
		"description" => "The duration of the transition between slides."
	),
	
	array(
		"name" => "Slide Duration",
		"id" => DESIGNARE_SHORTNAME."_flex_slide_duration",
		"type" => "text",
		"std" => 5500,
		"description" => "The duration of each slide"
	),
	
	array(
		"name" => "Autoplay",
		"id" => DESIGNARE_SHORTNAME."_flex_autoplay",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Pause on Hover",
		"id" => DESIGNARE_SHORTNAME."_flex_pause_hover",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => "Play/Pause on mouse out/over"
	),
	
	array(
		"name" => "Slider Height",
		"id" => DESIGNARE_SHORTNAME."_flex_height",
		"type" => "text",
		"std" => "400px",
		"description" => "The height of the slider."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>PROJECTS - Flex Slider Settings</h3>"
	),

	array(
		"name" => "Show Direction Controls",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_navigation",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),

	array(
		"name" => "Show Controls",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_controls",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Transition Effect",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_transition",
		"type" => "select",
		"options" => array(array("name"=>"Slide", "id"=>"slide"), array("name"=>"Fade", "id"=>"fade")),
		"std" => "random",
		"description" => ""
	),
	
	array(
		"name" => "Transition Duration",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_transition_duration",
		"type" => "text",
		"std" => 500,
		"description" => "The duration of the transition between slides."
	),
	
	array(
		"name" => "Slide Duration",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_slide_duration",
		"type" => "text",
		"std" => 5500,
		"description" => "The duration of each slide"
	),
	
	array(
		"name" => "Autoplay",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_autoplay",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => ""
	),
	
	array(
		"name" => "Pause on Hover",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_pause_hover",
		"type" => "checkbox",
		"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
		"std" => "true",
		"description" => "Play/Pause on mouse out/over"
	),
	
	array(
		"name" => "Slider Height",
		"id" => DESIGNARE_SHORTNAME."_projs_flex_height",
		"type" => "text",
		"std" => "400px",
		"description" => "The height of the slider."
	),
	
	array(
		"type" => "close"
	),
	
	/* ------------------------------------------------------------------------*
	 * Revolution Slider
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'rev'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Revolution Slider Settings</h3>"
	),

	
	array(
		"type" => "documentation",
		"text" => "<p>You can adjust the settings indivually for each created Revolution Slider in the <a href='admin.php?page=revslider'>Revolution Slider menu page</a>.</p>"
	),	
	/*close array*/
	
	array(
		"type" => "close"
	),
	
	array(
		"type" => "close"
	));
	
	designare_add_options($designare_general_options);
	
?>