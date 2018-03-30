<?php
#-----------------------------------------
#	RT-Theme rt_common_custom_fields_custom_posts.php
#	version: 1.0
#-----------------------------------------

#
# 	Common Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/


	#
	#	Get all templates
	#
	
	$options =  array(
			"right" 	=> 	"Content + Right Sidebar", 
			"left" 	=> 	"Content + Left Sidebar",
			"full" 	=> 	"Full Width - No Sidebar",
	);
	
	$customFields = array(
		array(
			"title" 			=> __("Template Selection",'rt_theme_admin'), 
			"name"			=> "custom_sidebar_position",
			"description" 		=> __('Select a template for this content.','rt_theme_admin'),
			"options" 		=>  $options,
			"select" 			=> __("Select a Template",'rt_theme_admin'), 
			"type" 			=> "select"
		),
	);

	$settings  = array( 
		"name"		=> THEMENAME ." Template Options",
		"scope"		=> array('products','portfolio','product'),
		"slug"		=> "rt_common_custom_fields_custom_posts",
		"capability"	=> "edit_post",
		"context"		=> "side",
		"priority"	=> "default"
	);

?>