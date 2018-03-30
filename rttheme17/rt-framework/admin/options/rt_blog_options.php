<?php

$options = array (

	array(
	"name"    => __("Info",'rt_theme_admin'),
	"desc"    => __('These options are only related with post category, archive and single post pages. If you would like to have more control on how to display your posts, customize "<a href="admin.php?page=rt_template_options">Default Blog Template</a>" or create a new one according your preferences. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Create Blog" steps.','rt_theme_admin'),
	"type"    => "info"),				
 
	array(
	"name"    => __("Author info box under posts.",'rt_theme_admin'),
	"id"      => THEMESLUG."_hide_author_info",
	"desc"    => 'You can place a little information box under the posts about the author of the post. Turn ON this option and update your "Biographical Info" on your <a href="profile.php">profile page</a>.',
	"hr"		=> "true",
	"type"    => "checkbox"), 
 
	array(
	"name"    => __("Full Blog Texts",'rt_theme_admin'),
	"id"      => THEMESLUG."_autocut",
	"desc"    => "As default the blog texts automaticaly minifies on listing pages. Turn ON this option if you would like to have the blog posts in full length on the blog listing pages or blog categories. Please note that you can split the text by using <a href=\"http://en.support.wordpress.com/splitting-content/excerpts/\">Excerpts</a> or <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a> after turning ON this option.",
	"default"   => "",
	"hr"		=> "true",
	"type"    => "checkbox"), 


	array(
	"name"    => __("Date Format",'rt_theme_admin'),
	"id"      => THEMESLUG."_date_format",
	"default" => "F j, Y",
	"desc"    => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time' target='_blank'>Formatting Date and Time</a>",
	"hr"		=> "true",
	"type"    => "text"),	 

	array(
	"name"      => __("Hide Author",'rt_theme_admin'),
	"desc"      => __("Turn ON this option to hide author name on blog posts.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_hide_author",
	"type"      => "checkbox",
	"hr"		=> "true",
	"default"   => "on",
	),

	array(
	"name"      => __("Hide Categories",'rt_theme_admin'),
	"desc"      => __("Turn ON this option to hide category list on blog posts.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_hide_categories",
	"type"      => "checkbox",
	"hr"		=> "true",
	"default"   => "on",
	), 		

	array(
	"name"      => __("Hide Big Dates",'rt_theme_admin'),
	"desc"      => __("Turn ON this option to hide the big dates on blog posts.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_hide_dates",
	"hr"		=> "true",
	"type"      => "checkbox"
	),

	array(
	"name"      => __("Hide Comment Numbers",'rt_theme_admin'),
	"desc"      => __("Turn ON this option to hide the comment numbers on blog posts.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_hide_commnent_numbers",
	"hr"		=> "true",
	"type"      => "checkbox"
	), 	

	array(
	"name"      => __("Show Small Dates",'rt_theme_admin'),
	"desc"      => __("Turn ON this option to show small dates on blog posts.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_show_small_dates",
	"type"      => "checkbox"
	), 		

	array(
	"name"    => __("SIDEBAR OPTIONS FOR BLOG",'rt_theme_admin'), 
	"type"    => "heading"), 

	array(
	"name"    => __("Default Sidebar Position for Blog",'rt_theme_admin'),
	"desc"    => __('Select a default sidebar position for your categories and single post pages.','rt_theme_admin'),
	"id"      => THEMESLUG."_sidebar_position_blog",
	"select"  => __("Select",'rt_theme_admin'),
				"options" =>  array(
				"right"   => 	"Content + Right Sidebar", 
				"left"    => 	"Content + Left Sidebar",
				"full"    => 	"Full Width - No Sidebar",
				),
	"hr"      => true,
	"default" => "right",
	"type"    => "select"),				

); 
?>