<?php
#-----------------------------------------
#	RT-Theme rt_common_custom_fields.php
#-----------------------------------------

#
# 	Common Custom Fields for the scope list provided 
#

// the post type
$post_type = $this->get_current_post_type();

// default sidebars	
$default_sidebars =  array(
	"right" => "Content + Right Sidebar", 
	"left"  => "Content + Left Sidebar",
	"full"  => "Full Width - No Sidebar",
);

/*
	Add default sidebars to the scope list
*/
$scope	= array();

if( in_array($post_type, $scope ) ){

	$customFields = array(
		array(
			"title"       => __("Template Selection",'rt_theme_admin'), 
			"name"        => "custom_sidebar_position",
			"description" => __('Select a template for this content.','rt_theme_admin'),
			"options"     => $default_sidebars,
			"select"      => __("Select a Template",'rt_theme_admin'), 
			"type"        => "select"
		),
	);

	$settings  = array( 
		"name"       => "Template Options",
		"scope"      => $scope, //scope list
		"slug"       => "rt_common_custom_fields_custom_posts",
		"capability" => "edit_post",
		"context"    => "side",
		"priority"   => "default"
	);
}

/*
	Add all templates and default sidebars to the scope list
*/

$scope	= array('products','portfolio','page','post','product','staff');

if( in_array($post_type, $scope ) ){
	$savedTemplates = get_option(RT_THEMESLUG.'_template_names_array');

	if(is_array($savedTemplates)){
		foreach($savedTemplates as $templateID => $templateData){
			$default_sidebars[$templateID]=$templateData["name"];
		}
	}

	$customFields = array(
		array(
			"title"       => __("Template Selection",'rt_theme_admin'), 
			"name"        => "custom_sidebar_position",
			"description" => __('Select a template for this content.','rt_theme_admin'),
			"options"     => $default_sidebars,
			"select"      => __("Select a Template",'rt_theme_admin'), 
			"type"        => "select"
		),
	);

	$settings  = array( 
		"name"       => "Template Options",
		"scope"      => $scope, //scope list
		"slug"       => "rt_common_custom_fields_custom_posts",
		"capability" => "edit_post",
		"context"    => "side",
		"priority"   => "default"
	);
}
?>
