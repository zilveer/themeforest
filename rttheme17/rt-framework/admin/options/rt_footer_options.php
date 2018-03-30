<?php

$options = array (
 
	array(
	"name"      => __("Footer Copyright Text",'rt_theme_admin'),
	"desc"      => __("The copyright text area on left side of footer. You can also use shorcodes and HTML within this field.",'rt_theme_admin'),
	"id"        => THEMESLUG."_footer_copy",
	"default"   => "Copyright &copy; 2011 Company Name, Inc.",
	"type"      => "textarea"),


	array(
	"name" 		=> __("FOOTER WIDGETS",'rt_theme_admin'), 
	"type" 		=> "heading"),


	array(
	"name"      => __("Footer Widgets",'rt_theme_admin'),
	"desc"      => __("Show footer widgets and use 'Sidebar for Footer'.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_show_footer_widgets",
	"type"      => "checkbox",
	"hr"        => "true",
	"default"	=> "on"
	),
	
	array(
	"name"      => __("Footer Widget Layout",'rt_theme_admin'),
	"desc"      => __("Select the layout of the footer widgets.",'rt_theme_admin'),
	"id"        => THEMESLUG."_footer_box_width",
	"options"   =>  array(
						5 => "1/5", 
						4 => "1/4",
						3 => "1/3",
						2 => "1/2",
						1 => "1/1"
					),
	"default"   => "4",
	"hr"        => "true",
	"help"      => "true",
	"type"      => "select"),

); 
?>