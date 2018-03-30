<?php

$pexeto_general_options= array( array(
"name" => "General",
"type" => "title",
"img" => PEXETO_IMAGES_URL."icon_general.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"main", "name"=>"Main Settings"), array("id"=>"sidebars", "name"=>"Sidebars"), array("id"=>"update", "name"=>"Theme Update"))
),

/* ------------------------------------------------------------------------*
 * MAIN SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'main'
),


array(
"name" => "Featured Category",
"id" => PEXETO_SHORTNAME."_featured_cat",
"type" => "select",
"options" => $pexeto_categories,
"desc" => "If you use the Featured Posts Template you can select the Featured category here."),

array(
"name" => "Favicon image URL",
"id" => PEXETO_SHORTNAME."_favicon",
"type" => "upload",
"desc" => "Upload a favicon image - with .ico extention."
),

array(
"name" => "Widgetized Footer",
"id" => PEXETO_SHORTNAME."_widgetized_footer",
"type" => "checkbox",
"std" => 'on'),

array(
"name" => "Display page title on pages",
"id" => PEXETO_SHORTNAME."_show_page_title",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If "ON" selected, the page title will be displayed in the beginning of the page content
as a main title. This option is available for the Default Page Template and Contact Page Template.'
),

array(
"name" => "Google Analytics Code",
"id" => PEXETO_SHORTNAME."_analytics",
"type" => "textarea",
"desc" => "You can paste your generated Google Analytics here and it will be automatically set to the theme."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SIDEBARS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'sidebars'
),

array(
"name"=>"Add Sidebar",
"id"=>'sidebars',
"type"=>"custom",
"button_text"=>'Add Sidebar',
"fields"=>array(
	array('id'=>'_sidebar_name', 'type'=>'text', 'name'=>'Sidebar Name')
),
"desc"=>"You can add as many custom sidebars you like and after that for each page you will be
able to assign a different sidebar/"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * THEME UPDATE
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'update'
),

array(
"name" => "Envato Marketplace Username",
"id" => PEXETO_SHORTNAME."_tf_username",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert the username of the account you used to purchase the theme from ThemeForest. For more information you can refer to the \"Updates\" section of the documentation."
),

array(
"name" => "Envato Marketplace API Key",
"id" => PEXETO_SHORTNAME."_tf_api_key",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert your API Key here. To obtain your API Key, visit your \"My Settings\" page on any of the Envato Marketplaces (ThemeForest). For more information you can refer to the \"Updates\" section of the documentation."
),

array(
"type" => "close"),


array(
"type" => "close"));

pexeto_add_options($pexeto_general_options);