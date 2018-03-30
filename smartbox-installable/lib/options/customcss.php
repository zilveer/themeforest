<?php
	
	$designare_general_options= array( array(
		"name" => "Custom CSS",
		"type" => "title",
		"img" => DESIGNARE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"customcss", "name"=>"Custom CSS"))
	),
	
	
	
	/* ------------------------------------------------------------------------*
	 * CUSTOM CSS
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'customcss'
	),
	
	array(
		"type" => "documentation",
		"text" => "<p>You can use this textarea to add your custom CSS. This will be loaded last so it will override the other CSS from the theme. Tags will be striped.</p>"
	),
	
	array(
		"name" => "Apply Custom CSS",
		"id" => "enable_custom_css",
		"type" => "checkbox",
		"std" => "off"
	),
	
	array(
		"id" => DESIGNARE_SHORTNAME."_custom_css",
		"type" => "textarea"
	),
		
	/*close array*/
	/*
array(
		"type" => "close"
	),
*/
	
	array(
		"type" => "close"
	));
	
	designare_add_options($designare_general_options);
	
?>