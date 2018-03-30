<?php

$codeSample= htmlspecialchars('<h4 class="alignright">CALL US NOW: 0800 383 8883 </h4>');
$options = array (

	array(
	"name"      => __("Logo",'rt_theme_admin'),
	"desc"      => __("Please choose an image file or write url of your logo.",'rt_theme_admin'),
	"id"        => THEMESLUG."_logo_url",
	"hr"        => "true",
	"type"      => "upload"),

	array(
	"name"      => __("Show Logo Container",'rt_theme_admin'),
	"desc"      => __("You can turn on/off the logo container which has shadows and border.",'rt_theme_admin'),
	"id"        => THEMESLUG."_logo_container",
	"default"   => "checked",
	"type"      => "checkbox"),
 
	array(
	"name"      => __("SUB PAGE HEADER",'rt_theme_admin'), 
	"type"      => "heading"),

	array(
	"name"      => __("Default Header Background Image",'rt_theme_admin'),
	"desc"      => __("Upload a default background image for the header of all contents. The header width is 940px",'rt_theme_admin'),
	"id"        => THEMESLUG."_header_background_image",
	"hr"        => "true",
	"type"      => "upload"),
 
	array(
	"name"      => __("Free code space for advanced users",'rt_theme_admin'),
	"desc"      => __('You can use shortcodes or your html codes in this space, it will be placed in front of the background image<br/> For example <code>'.$codeSample.'</code>','rt_theme_admin'),
	"id"        => THEMESLUG."_header_text",
	"type"      => "textarea",				
	),
 
	array(
	"name"      => __("SUB PAGE TOP BAR",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Show Search",'rt_theme_admin'),
	"id"        => THEMESLUG."_show_search",
	"desc"      => __('Show search form field on top of the sub pages.','rt_theme_admin'),	
	"type"      => "checkbox",
	"default"   => "checked",
	"help"      => "true"),  
	
	array(
	"name"      => __("BREADCRUMB MENU",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Breadcrumb Menus",'rt_theme_admin'),
	"desc"      => __("You can turn on/off breadcrumb menus",'rt_theme_admin'),
	"id"        => THEMESLUG."_breadcrumb_menus",
	"hr"        => "true",
	"default"   => "checked",
	"type"      => "checkbox"),
	
	array(
	"name"      => __("Breadcrumb Menu Text",'rt_theme_admin'),
	"desc"      => __("The text before the breadcrumb menu",'rt_theme_admin'),
	"id"        => THEMESLUG."_breadcrumb_text",
	"default"   => __("You are here:",'rt_theme_admin'), 
	"type"      => "text",
	"hr"        => "true"),

); 
?>