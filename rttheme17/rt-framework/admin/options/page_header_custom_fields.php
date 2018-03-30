<?php
#-----------------------------------------
#	RT-Theme page_header_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Page Header Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/ 
	
	$customFields = array(

				array(
					"description" 		=> __("Use these options to create a unique header for this content",'rt_theme_admin'), 
					"type" 			=> "info_text_only",
					"hr"        => "true",
				),

				array(
					"name"			=> "_header_background_image",
					"title"			=> __("Header Background Image",'rt_theme_admin'),
					"description"		=> "Upload a background image for the header of this content. The header width is 940px",
					"type"			=> "upload"
				),

  				array(
					"title"			 => __("CUSTOM CODING or SHORTCODES",'rt_theme_admin'), 
					"type"			 => "heading"
				),

 				array(
					"name"			=> "_header_text",
					"title"			=> __("Free Code Space for Advanced Users",'rt_theme_admin'),
					"description"		=> "You can use shortcodes or your html codes in this space, it will be placed in front of the background image <br/> For example <code>".htmlspecialchars('<h4 class="alignright">CALL US NOW: 0800 383 8883 </h4>')."</code>",
					"type"			=> "textarea",
					"hr"				=> "true"
				),

				array(
					"title" 		=> __("Disable Header Image & Text for This Content",'rt_theme_admin'),
					"name" 		=> "_disable_header_image",   
					"type"		=> "checkbox"
				),
	);

	$settings  = array( 
		"name"		=> THEMENAME ." Header Options",
		"scope"		=> array('post','page','portfolio','products','product'),
		"slug"		=> "rt_page_header_custom_fields_template",
		"capability"	=> "edit_post",
		"context"		=> "normal",
		"priority"	=> "default"
	);

?>