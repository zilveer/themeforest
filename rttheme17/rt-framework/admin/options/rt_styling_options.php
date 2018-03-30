<?php
		$options    = array (
	
		array(
		"name"        => __("Info",'rt_theme_admin'),
		"desc"        => __('Use these options to customize the theme. You can also find styling options related with the main menu on <a href="admin.php?page=rt_menu_options">Menu Styling Options</a>. In order to customize site typography use <a href="admin.php?page=rt_typography_options">Typography Options</a>','rt_theme_admin'),
		"hr"          => "true",
		"type"        => "info"),				

		array(
		"name"      => __("Theme Style",'rt_theme_admin'),
		"desc"      => __("Please choose a style for your theme.",'rt_theme_admin'),
		"id"        => THEMESLUG."_17_style",
		"options"   =>	array(
						"blue"     => "Blue Style",
						"purple"   => "Purple Style", 
						"orange"   => "Orange Style", 						
						"brown"   => "Brown Style", 												
						"rose"   => "Rose Style", 		
						"green"   => "Green Style", 	
						"grey"   => "Grey Style", 		
						"gold"   => "Gold Style", 								
						),
		"default"   => "blue", 
		"type"      => "select"),  

		array(
		"name" 		=> __("PRIMARY COLOR",'rt_theme_admin'), 
		"type" 		=> "heading"),		
				
		array(
		"name"      => __("Primary Color",'rt_theme_admin'),
		"desc"      => __("You can change change heading colors, slider button colors etc. Leave blank if you want to use default colors.",'rt_theme_admin'),
		"id"        => THEMESLUG."_primary_color", 
		"default"   => "#4b9ec9",
		"dont_save" => "true",
		"type"      => "colorpicker"),

		array(
		"name" 		=> __("CONTENT STYLING",'rt_theme_admin'), 
		"type" 		=> "heading"),


		array(
		"name"      => __("Headings Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_heading_font_color",
		"hr"        => "true",
		"default"   => "#333333", 
		"dont_save" => "true",
		"type"      => "colorpicker"),


		array(
		"name"      => __("Content Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_body_font_color", 
		"default"   => "#666666", 
		"dont_save" => "true",
		"type"      => "colorpicker"),


		array(
		"name" 		=> __("CONTENT LINKS",'rt_theme_admin'), 
		"type" 		=> "heading"),


		array(
		"name"      => __("Custom Link Color",'rt_theme_admin'),		
		"id"        => THEMESLUG."_link_color",
		"hr"        => "true",
		"default"   => "#4b9ec9",
		"dont_save" => "true",
		"type"      => "colorpicker"),
		
		array(
		"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'), 
		"id"        => THEMESLUG."_link_color_hover",
		"default"   => "#4b9ec9",
		"dont_save" => "true",
		"type"      => "colorpicker"),			

		array(
		"name" 		=> __("FOOTER STYLING",'rt_theme_admin'), 
		"type" 		=> "heading"),

		array(
		"name"      => __("Footer Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_footer_font_color",
		"default"   => "#A9A9A9", 
		"dont_save" => "true",
		"hr"        => "true",
		"type"      => "colorpicker"),

		array(
		"name"      => __("Footer Link Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_footer_link_color",
		"default"   => "#919191", 
		"dont_save" => "true",
		"hr"        => "true",
		"type"      => "colorpicker"),

		array(
		"name"      => __("Footer Link Color (Hover State)",'rt_theme_admin'),
		"id"        => THEMESLUG."_footer_link_hover_color",
		"default"   => "#919191", 
		"dont_save" => "true",
		"hr"        => "true",		
		"type"      => "colorpicker"),

		array(
		"name"      => __("Footer Background Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_footer_background_color",
		"default"   => "#ffffff", 
		"hr"        => "true",
		"type"      => "colorpicker"),
	
		array(
		"name" 	=> __("Footer Transparency Level (%)",'rt_theme_admin'),
		"id" 	=> THEMESLUG."_footer_opacity", 
		"min"	=>"0",
		"max"	=>"100",
		"default"	=>"30",
		"type" 	=> "rangeinput"),

		array(
		"name" 		=> __("BREADCRUMB MENU BAR STYLING",'rt_theme_admin'), 
		"type" 		=> "heading"),

		array(
		"name"      => __("Breadcrumb Menu Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_breadcrumb_font_color",
		"default"   => "#999999", 
		"dont_save" => "true",
		"hr"        => "true",
		"type"      => "colorpicker"),

		array(
		"name"      => __("Breadcrumb Menu Link Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_breadcrumb_link_color",
		"default"   => "#595959", 
		"dont_save" => "true",
		"hr"        => "true",
		"type"      => "colorpicker"),

		array(
		"name"      => __("Breadcrumb Menu Link Color  (Hover State)",'rt_theme_admin'),
		"id"        => THEMESLUG."_breadcrumb_link_hover_color",
		"default"   => "#595959", 
		"dont_save" => "true",

		"type"      => "colorpicker"),



		array(
		"name" 		=> __("MORE CUSTOMIZATION",'rt_theme_admin'), 
		"type" 		=> "heading"),	
		
		array(
		"name"      => __("Custom CSS Codes",'rt_theme_admin'),
		"desc"      => __("Paste your css codes. Do not include &lt;style&gt;&lt;/style&gt; tags or any html tag in this field.",'rt_theme_admin'),
		"id"        => THEMESLUG."_custom_css",
		"hr"        => "true", 
		"type"      => "textarea"),
		);
?>