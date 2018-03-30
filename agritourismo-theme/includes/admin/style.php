<?php
global $orange_themes_managment;
$orangeThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => "Style Settings",
	"slug" => "custom-styling"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"font_style", "name"=>"Font Style"),
		array("slug"=>"page_colors", "name"=>"Page Colors/Style")
		)
),

/* ------------------------------------------------------------------------*
 * PAGE FONT SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'font_style'
),

array(
	"type" => "row"
),

array(
	"type" => "google_font_select",
	"title" => "Main Menu Font:",
	"id" => $orange_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => "Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",
	"default_font" => array('font' => "Ropa Sans", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => "Titles Font:",
	"id" => $orange_themes_managment->themeslug."_google_font_2",
	"sort" => "alpha",
	"info" => "Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",
	"default_font" => array('font' => "Coustard", 'txt' => "(default)")
),

array(
	"type" => "close"

),

array(
"type" => "row",

),
array(
	"type" => "title",
	"title" => "Font Size"
),

array(
	"type" => "input",
	"title" => "Main menu font size in PX:",
	"id" => $orange_themes_managment->themeslug."_font_size_1",
	"number" => "yes",
	"std" => "19"
),


array(
	"type" => "close"

),

array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE COLORS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_colors'
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => "Enable Responsive"
),

array(
	"type" => "checkbox",
	"title" => "Enable",
	"id" => $orange_themes_managment->themeslug."_responsive"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Page Layout"
),

array(
	"type" => "radio",
	"id" => $orange_themes_managment->themeslug."_page_layout",
	"radio" => array(
		array("title" => "Boxed:", "value" => "boxed"),
		array("title" => "Wide:", "value" => "wide"),
	),
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Page Background Settings"
),

array(
	"type" => "select",
	"title" => "Texture",
	"id" => $orange_themes_managment->themeslug."_bg_texture",
	"options"=>array(
		array("slug"=>"texture-1", "name"=>"Texture-1"), 
		array("slug"=>"texture-2", "name"=>"Texture-2"),
		array("slug"=>"texture-3", "name"=>"Texture-3"),
		array("slug"=>"texture-4", "name"=>"Texture-4"),
		array("slug"=>"texture-5", "name"=>"Texture-5"),
	)
),



array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => "Page Color Settings"
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_1", 
	"title" => "Main menu color:",
	"std" => "3c1805",
),

array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_2", 
	"title" => "Article Links Color:",
	"std" => "e6dfba",
),


array( 
	"type" => "color", 
	"id" => $orange_themes_managment->themeslug."_color_3", 
	"title" => "Very Top line color:",
	"std" => "4c5c12",
),

array(
	"type" => "close"
),
array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
);

$orange_themes_managment->add_options($orangeThemes_slider_options);
?>