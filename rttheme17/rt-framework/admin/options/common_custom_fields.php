<?php
#-----------------------------------------
#	RT-Theme common_custom_fields.php
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

	    // WooCommerce
	    if ( class_exists( 'Woocommerce' ) ) {
			if(woocommerce_get_page_id('shop') == @$_GET["post"]){
				$hideCustomTemplates = "TRUE";
			} 
	    }

	$savedTemplates = get_option('rt_template_names_array');

	if(is_array($savedTemplates) && !@$hideCustomTemplates){
		foreach($savedTemplates as $key => $value){
			$options[$key]=$value;
		}
	}
	 
	
	$customFields = array(
		array(
			"title" 			=> __("Template Selection",'rt_theme_admin'), 
			"name"			=> "custom_sidebar_position",
			"description" 		=> __('Select a template for this page/post. You can create new templates or customize defaults via <a href="admin.php?page=rt_template_options">Template Builder</a>.','rt_theme_admin'),
			"options" 		=>  $options,
			"select" 			=> __("Select a Template",'rt_theme_admin'), 
			"type" 			=> "select"
		),
	);

	$settings  = array( 
		"name"		=> THEMENAME ." Template Options",
		"scope"		=> array('post','page'),
		"slug"		=> "rt_common_custom_fields_template",
		"capability"	=> "edit_page",
		"context"		=> "side",
		"priority"	=> "default"
	); 
?>