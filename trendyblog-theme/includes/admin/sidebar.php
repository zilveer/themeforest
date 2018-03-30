<?php
global $different_themes_managment;
$differentThemes_sidebar_options= array(
 array(
	"type" => "navigation",
	"name" => "Sidebar Settings",
	"slug" => "sidebars"
),

array(
	"type" => "tab",
	"slug"=>'sidebar_settings'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
			array("slug"=>"sidebar", "name"=>esc_html__("Sidebar", THEME_NAME))
		)
),

/* ------------------------------------------------------------------------*
 * SIDEBAR GENERATOR
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=>'sidebar'
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Default Main Sidebar Position", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_sidebar_position",
	"radio" => array(
		array("title" => esc_html__("Left:", THEME_NAME), "value" => "left"),
		array("title" => esc_html__("Right:", THEME_NAME), "value" => "right"),
		array("title" => esc_html__("Custom For Each Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),
array(
	"type" => "close"
),
/*
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Default Second Sidebar Position", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_sidebar_position_2",
	"radio" => array(
		array("title" => esc_html__("Left:", THEME_NAME), "value" => "left"),
		array("title" => esc_html__("Right:", THEME_NAME), "value" => "right"),
		array("title" => esc_html__("Custom For Each Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),
array(
	"type" => "close"
),
*/
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Enable Sticky Sidebar", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Make the sidebar sticky", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_sticky_sidebar"
),
   

array(
	"type" => "close"
), 
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Add Sidebar", THEME_NAME),
),

array(
	"type" => "add_text",
	"title" => esc_html__("Add New Sidebar:", THEME_NAME),
	"id" => THEME_NAME."_sidebar_name"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Sidebar Sequence", THEME_NAME),
	"info" => esc_html__("To sort the slides just drag and drop them!", THEME_NAME)
),

array(
	"type" => "sidebar_order",
	"title" => esc_html__("Order Sidebars", THEME_NAME),
	"id" => THEME_NAME."_sidebar_name"
),
  
array(
	"type" => "close"
),
 
array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
);

$different_themes_managment->add_options($differentThemes_sidebar_options);
?>