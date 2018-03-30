<?php
#-----------------------------------------
#	RT-Theme background_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Background Options
#

/**
* @var  array  $customFields  Defines the custom fields available
*/ 
	
	$customFields = array(
				array(
					"description" 		=> __("Use this options to create a unique background for this content",'rt_theme_admin'), 
					"type" 			=> "info_text_only",
					"hr"        => "true",
				),

				array(
					"name"			=> "_background_image_url",
					"title"			=> __("Background Image",'rt_theme_admin'),
					"description"		=> __('Please choose an image or write an image url to use for background.','rt_theme_admin'),
					"type"			=> "upload",
				),

				array(
					"title" 			=> __("DISPLAY OPTIONS",'rt_theme_admin'), 
					"type" 			=> "heading"
				),

				array(
				"title"      => __("Position",'rt_theme_admin'),
				"name"        => "_background_position",
				"options"   => array(		
								"left"         =>"Left",
								"center"       =>"Center",
								"right"        =>"Right"
								), 
								
				"hr"        => "true",
				"type"      => "radio"),

				array(
				"title"      => __("Repeat",'rt_theme_admin'),
				"name"        => "_background_repeat",
				"options"   => array(		
								"repeat"       =>"Tile",
								"repeat-x"     =>"Tile Horizontally",
								"repeat-y"     =>"Tile Vertically",
								"no-repeat"    =>"No Repeat"
								), 					
				"hr"        => "true",
				"type"      => "radio"),
			
				array(
				"title"      => __("Attachment",'rt_theme_admin'),
				"name"        => "_background_attachment",
				"options"   => array(		
								"Scroll"        =>"Scroll",
								"Fixed"         =>"Fixed"  
								), 					
				"hr"        => "true",
				"type"      => "radio"), 


				array(
				"title" 	=> __("100% Background Image",'rt_theme_admin'),
				"description" 	=> __('You can use this background image as 100% scaled and fixed positioned. If you turn on this feature "Display Options" will be ignored.','rt_theme_admin'),
				"name" 	=> "_full_width_background", 
				"hr"      => "true",
				"type"	 => "checkbox"),
			
			
				array(
				"title"      => __("Background Color",'rt_theme_admin'),
				"description" 		=> __('Click right side of the box below to pick a color. If you would like to turn back the default color, just delete the value and update this post.','rt_theme_admin'),
				"name"        => "_background_color",
				"type"      => "colorpicker"),
			
			
			
				array(
				"title" 		=> __("BACKGROUND OVERLAY",'rt_theme_admin'), 
				"type" 		=> "heading"),
			
			
				array(
				"title"      	=> __("Overlay Image",'rt_theme_admin'),
				"description"  => __('You can replace the cross overlay image with yours','rt_theme_admin'),
				"name"        	=> "_background_overlay_image_url",
				"hr"       	=> "true",
				"type"      	=> "upload"),
			
				array(
				"title" 		=> __("Turn ON/OFF Background Overlay",'rt_theme_admin'),
				"name" 		=> "_enable_background_overlay",  
				"default"		=> "checked",
				"type"		=> "checkbox"),

				array(
				"name" 			=> "_rt_hidden", 
				"statical_value"	=> "saved",
				"type"			=> "hidden"),
	 
	);

	$settings  = array( 
		"name"		=> THEMENAME ." Background Options",
		"scope"		=> array('post','page','portfolio','products','product'),
		"slug"		=> "rt_background_custom_fields_template",
		"capability"	=> "edit_post",
		"context"		=> "normal",
		"priority"	=> "default"
	);

?>