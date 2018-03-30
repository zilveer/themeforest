<?php
#-----------------------------------------
#	RT-Theme testimonial_custom_fields.php
#-----------------------------------------

#
# 	Staff Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/ 

 

$customFields = array(

		array(
			"description"	=> __("Testimonials can be used to show your client's remarks about anything they commented on. You can have them shown in any part of your website. Attach a featured image to show a (rounded) thumbnail image of the person or company-logo beside the testimonial text. Testimonial items can be listed and called : <br /><br />1) In the template builder by adding a testimonial box,<br />2) Directly in a page by the use of the testimonial shortcode.",'rt_theme_admin'),	
			"type"			=> "info_text_only",
		),
		array(
			"title" => __("The Testimonial Text",'rt_theme_admin'), 
			"type"  => "heading"
		),
		array(
			"title" => __("Testimonial Text",'rt_theme_admin'),
			"description"	=> __("Testimonial Text : Enter the text which needs to appear as the testimonial text. Valid HTML code (h-tags, a-tags, divs) is allowed, but we suggest to keep the formatting as simple as possible.",'rt_theme_admin'),	
			"name"  => "_testimonial",
			"type"  => "textarea",	
			"label_position"  => "block",				
		),

		array(
			"title" => __("Testimonial Info",'rt_theme_admin'), 
			"type"  => "heading"
		),

		array(
			"type"  => "table_start"
		),

		array(
			"title" => __("Client's Name",'rt_theme_admin'), 
			"description"	=> __("Client's Name : The supplied name will appear at the bottom of the Testimonial.",'rt_theme_admin'),
			"name"  => "_name",
			"type"  => "inline_text",
			"label_position"  => "block",	
		),		

		array(
			"type" => "td_col"
		),

		array(
			"title" => __("Client's Job Title",'rt_theme_admin'), 
			"description"	=> __("Client's Job Title : The supplied Job Title will appear at the bottom of the Testimonial.",'rt_theme_admin'),			
			"name"  => "_title",
			"type"  => "inline_text",
			"label_position"  => "block",	
		),

		array(
			"type" => "table_end"
		),		
		
		array(
			"type"  => "table_start"
		),

		array(
			"title" => __("Client's Link Text",'rt_theme_admin'), 
			"description"	=> __("Client's Link Text: The text that the link will be applied.",'rt_theme_admin'),			
			"name"  => "_link_text",
			"type"  => "inline_text",
			"label_position"  => "block",	
		),

		array(
			"type" => "td_col"
		),

		array(
			"title" => __("Client's Link",'rt_theme_admin'), 
			"description"	=> __("Client's Link : The supplied link will appear at the bottom of the Testimonial and will link to the supplied URL.",'rt_theme_admin'),			
			"name"  => "_link",
			"type"  => "inline_text",
			"label_position"  => "block",	
		),

		array(
			"type" => "table_end"
		),						
);


 

$settings  = array( 
	"name"       => __("Testimonial Options",'rt_theme_admin'), 
	"scope"      => "testimonial",
	"slug"       => "rt_testimonial_custom_fields",
	"capability" => "edit_post",
	"context"    => "normal",
	"priority"   => "high" 
);