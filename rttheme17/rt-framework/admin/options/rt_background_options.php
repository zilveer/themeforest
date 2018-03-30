<?php

$options = array (

	
	array(
	"name"      => __("Background Image",'rt_theme_admin'),
	"desc"      => __('Please choose an image or write an image url to use for backgroud.','rt_theme_admin'),
	"id"        => THEMESLUG."_background_image_url",
	"hr"        => "true",
	"type"      => "upload"),
	
	
	array(
	"name"      => __("Randomized Background Images",'rt_theme_admin'),
	"desc"      => __("To activate the random background images enter image urls line by line",'rt_theme_admin'),
	"id"        => THEMESLUG."_background_image_urls",
	"help"      => "true",
	"type"      => "textarea"),

	array(
	"name" 		=> __("DISPLAY OPTIONS",'rt_theme_admin'), 
	"type" 		=> "heading"),

	array(
	"name"      => __("Position",'rt_theme_admin'),
	"id"        => THEMESLUG."_background_position",
	"options"   => array(		
					"left"         =>"Left",
					"center"       =>"Center",
					"right"        =>"Right"
					), 
					
	"hr"        => "true",
	"type"      => "radio"),

	array(
	"name"      => __("Repeat",'rt_theme_admin'),
	"id"        => THEMESLUG."_background_repeat",
	"options"   => array(		
					"repeat"       =>"Tile",
					"repeat-x"     =>"Tile Horizontally",
					"repeat-y"     =>"Tile Vertically",
					"no-repeat"    =>"No Repeat"
					), 					
	"hr"        => "true",
	"type"      => "radio"),

	array(
	"name"      => __("Attachment",'rt_theme_admin'),
	"id"        => THEMESLUG."_background_attachment",
	"options"   => array(		
					"Scroll"        =>"Scroll",
					"Fixed"         =>"Fixed"  
					), 					
	"hr"        => "true",
	"type"      => "radio"), 


	array(
	"name" 	=> __("100% Background Image",'rt_theme_admin'),
	"desc" 	=> __('You can use this background image(s) as 100% scaled and fixed positioned. If you turn on this feature "Display Options" will be ignored.','rt_theme_admin'),
	"id" 	=> THEMESLUG."_full_width_background", 
	"hr"      => "true",
	"type"	 => "checkbox"),


	array(
	"name"      => __("Background Color",'rt_theme_admin'),
	"desc" 		=> __('Click right side of the box below to pick a color. If you would like to turn back the default color, just delete the value and update this post.','rt_theme_admin'),
	"id"        => THEMESLUG."_background_color",
	"type"      => "colorpicker"),



	array(
	"name" 		=> __("BACKGROUND OVERLAY",'rt_theme_admin'), 
	"type" 		=> "heading"),


	array(
	"name"      => __("Overlay Image",'rt_theme_admin'),
	"desc"      => __('You can replace the cross overlay image with yours','rt_theme_admin'),
	"id"        => THEMESLUG."_background_overlay_image_url",
	"hr"        => "true",
	"type"      => "upload"),

	array(
	"name" 		=> __("Turn ON/OFF Background Overlay",'rt_theme_admin'),
	"id" 		=> THEMESLUG."_enable_background_overlay", 
	"hr"      	=> "true",
	"default"		=> "checked",
	"type"		=> "checkbox"),

); 
?>