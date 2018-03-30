<?php

$options = array (

	array(
	"type"      => "hr"),	 

	array(
	"name"      => __("Custom Favicon",'rt_theme_admin'),
	"desc"      => __("Provide a valid url to the favicon image or use the upload button to upload a favicon.ico image. <br /><br />Max Icon size allowed : 16x16px.<br /> File extension required :  &#39;.ico&#39; ",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_favicon_url",
	"type"      => "upload"),	 
	
	array(
	"name"      => __("GLOBAL PAGE LAYOUT",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
			"name" => __("Default Layout",'rt_theme_admin'),
			"desc"    => __("Select and set a default layout for contents. This option will be used if there is no template selected inside page/post screen by using the 'Template Options' box. For product and portfolio categories please use their options; Portfolio Options and Product Options",'rt_theme_admin'),
			"id" => RT_THEMESLUG."_sidebar_position",
			"options" =>  array(
							"right" => 	"Content + Right Sidebar", 
							"left"  => 	"Content + Left Sidebar",
							"full"  => 	"Full Width - No Sidebar",
						),
			"default"	=> "right",
			"hr"		=> true,
			"default"   => "full",
			"type" => "select"),	


	array(
	"name"      => __("GOOGLE ANALYTICS",'rt_theme_admin'), 
	"type"      => "heading"), 
	
	array(
	"name"      => __("Analytics Code",'rt_theme_admin'),
	"desc"      => __("Paste in here the complete google analytics code or any other tracking code that needs to be placed in the footer before the end of the html body content.",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_google_analytics",
	"type"      => "textarea",				
	),

	array(
	"name"      => __("GOOGLE MAPS",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
	"name"      => __("Google API Key",'rt_theme_admin'),
	"desc"      => sprintf(__("Enter your Google API key. Refer this documentation %s to learn how to get your API key.",'rt_theme_admin'),'<a href="http://docs.rtthemes.com/document/how-to-generate-a-google-api-key-of-your-own/" target="_blank">http://docs.rtthemes.com/document/how-to-generate-a-google-api-key-of-your-own/</a>'),
	"id"        => RT_THEMESLUG."_google_api_key",
	"type"      => "text",				
	),

	array(
	"name"      => __("MISCELLANEOUS OPTIONS",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Allow comments on pages",'rt_theme_admin'),
	"desc"      => __("Turn ON this option if you want to allow comments on regular pages. Make sure 'Allow Comments' box is also checked for individual pages. If you dont see that option in your pages make sure to turn on the &#39;discussions&#39; option in the screen options below the admin name while you are in that page editing the content.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_allow_page_comments",
	"type"      => "checkbox2"
	), 			 

	array(
	"name"      => __("Responsive Design",'rt_theme_admin'),
	"desc"      => __("Activate the Responsive Design feature. Turning on this option will make the website adjust it&#39;s design to smaller screens (mobile and pad devices) automatically.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_close_responsive",
	"type"      => "checkbox2",
	"default"	=> "on"
	), 

	array(
	"name"      => __("Animated Content Blocks",'rt_theme_admin'),
	"desc"      => __("Activate the animated contents blocks that triggered by page scrolling",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_content_animations",
	"type"      => "checkbox2",
	"default"	=> "on"
	), 

	array(
	"name"      => __("Page Loading Effect",'rt_theme_admin'),
	"desc"      => __("Activate the page loaing effect that appears when enter a page during the page loading",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_page_loading",
	"type"      => "checkbox2",
	"default"	=> ""
	), 

	array(
	"name"      => __("Close Update Notifications",'rt_theme_admin'),
	"desc"      => __("Turn OFF this option if you don&#39;t want to be informed about theme updates. It can speed up the admin backend loading time. Note: You can turn on update notifications at the theme download settings at Themeforest.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_update_notifications",
	"type"      => "checkbox2",
	"default"	=> "on"
	),
	 
	array(
	"name"      => __("Show WPML Plugin's Languages at Top",'rt_theme_admin'),
	"desc"      => __("Show the WPML language flags on top of each page in your website. Note: This only works when the WPML plugin is installed and actived.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_show_flags",
	"default"   => "checked",
	"type"      => "checkbox2",
	),

	array(
	"name"      => __("Floating Sidebars",'rt_theme_admin'),
	"desc"      => __("Enable/disable the floating sidebars. Floating sidebar means that the sidebar content will follow the page content and stay visible while scrolling the page.",'rt_theme_admin'),				
	"id"        => RT_THEMESLUG."_floating_sidebars",
	"default"   => "checked",
	"type"      => "checkbox2",
	),


	array(
	"name"      => __("FREE CODE SPACES",'rt_theme_admin'), 
	"type"      => "heading"), 

	array(
		"name" => __("Info",'rt_theme_admin'),
		"desc" => __("You can use any valid (html / javascript / css) code in the fields below. The input will not be formatted and put directly into each page just before the &#60;&#47;head&#62; or &#60;&#47;body&#62; tags!" ,'rt_theme_admin'),
		"type" => "info",
	),

	array(
	"name"      => __("Space for before &lt;/head&gt;",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_space_for_head",
	"type"      => "textarea",				
	),

	array(
	"name"      => __("Space for before &lt;/body&gt;",'rt_theme_admin'),
	"id"        => RT_THEMESLUG."_space_for_footer",
	"type"      => "textarea",	
	"hr"		=> true			
	),

); 
?>