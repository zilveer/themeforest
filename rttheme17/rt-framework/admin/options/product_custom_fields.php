<?php
#-----------------------------------------
#	RT-Theme product_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Portfolio Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(
	  
	array(
		"name"			=> "short_description",
		"title"			=> __("Short Description",'rt_theme_admin'),
		"description"		=> __('Short description for product listing pages. If you want to show price info in the listing pages, you can use  this code in this field.','rt_theme_admin'),
		"type"			=> "textarea" 
	),  
	
	array(
		"title"			 => __("Related Products",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	array(
		"title" 			=> __("Select Related Products",'rt_theme_admin'), 
		"name"			=> "related_products[]",
		"options" 		=> RTTheme::rt_get_products(),
		"select" 			=> __("Select products",'rt_theme_admin'),
		"type" 			=> "selectmultiple"
	),


	//document tabs
	
	array(
		"title"			 => __("ATTACHED DOCUMENTS",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "attached_documents",
		"title"			=> __("Attached Files", 'rt_theme_admin'),
		"description"		=> __("You can attach unlimited file to this product. Put all the file urls line by line. Use \"|\ delimiter to add file names. Example: <pre style=\"font-style:normal;\">File Name | http://file_url<br />File Name | http://file_url</pre>",'rt_theme_admin'),		
		"type"			=> "textarea" 
	),
 
	//free tabs
	
	array(
		"title"			 => __("FREE TABS",'rt_theme_admin'), 
		"type"			 => "heading"
	),		 

	array(
		"name"			=> "free_tab_1_title",
		"title"			=> __("#1 - Free Tab Name ", 'rt_theme_admin'),
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "free_tab_1_content",
		"title"			=> __("#1 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea",
		"richeditor"		=> "true"		
	),

	array(
		"title"			 => "", 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "free_tab_2_title",
		"title"			=> __("#2 - Free Tab Name", 'rt_theme_admin'),		
		"type"			=> "text" 
	),
	
	array(
		"name"			=> "free_tab_2_content",
		"title"			=> __("#2 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea",
		"richeditor"		=> "true"
	),

	array(
		"title"			 => "", 
		"type"			 => "heading"
	),	
	
	array(
		"name"			=> "free_tab_3_title",
		"title"			=> __("#3 - Free Tab Name", 'rt_theme_admin'),		
		"type"			=> "text",
		"richeditor"		=> "true"
	),
	
	array(
		"name"			=> "free_tab_3_content",
		"title"			=> __("#3 - Free Tab Content", 'rt_theme_admin'),
		"type"			=> "textarea",
		"richeditor"		=> "true"
	),

);

$settings  = array( 
	"name"		=> THEMENAME ." Product Options",
	"scope"		=> "products",
	"slug"		=> "product_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);

?>