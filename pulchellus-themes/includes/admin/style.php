<?php
global $different_themes_managment;
$differentThemes_slider_options= array(
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
		array("slug"=>"page_style", "name"=>"Page Style"),

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
	"type" => "row",

),

array(
	"type" => "google_font_select",
	"title" => "Font Style:",
	"id" => $different_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => "Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",
	"default_font" => array('font' => "Default", 'txt' => "(default)")
),


array(
	"type" => "close",

),

array(
	"type" => "save",
	"title" => "Save Changes"
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE  SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_style'
),

array(
	"type" => "row",

),

array(
	"type" => "title",
	"title" => "Page Layout"
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_layout",
	"radio" => array(
		array("title" => "Boxed", "value" => "boxed"),
		array("title" => "Stretched", "value" => "stretched"),
	),
),

array(
	"type" => "close",

),
array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => "Page Header Image"
),

array(
	"type" => "upload",
	"title" => "Image: ",
	"id" => $different_themes_managment->themeslug."_header_image"
),

array(
	"type" => "close",

),

array(
	"type" => "row",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_layout", "value" => "boxed")
	)
),

array(
	"type" => "title",
	"title" => "Page Background Image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_layout", "value" => "boxed")
	)
),

array(
	"type" => "upload",
	"title" => "Image: ",
	"id" => $different_themes_managment->themeslug."_bg_image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_layout", "value" => "boxed")
	)
),


array(
	"type" => "close",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_layout", "value" => "boxed")
	)

),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => "Color Skin"
),

array(
	"type" => "select",
	"title" => "Color Skin",
	"id" => $different_themes_managment->themeslug."_color_skin",
	"options"=>array(
		array("slug"=>"winter", "name"=>"Winter"), 
		array("slug"=>"summer", "name"=>"Summer"),
		array("slug"=>"autumn", "name"=>"Autumn"),
		array("slug"=>"spring", "name"=>"Spring")
	),
	"std" => "winter"
),
array(
	"type" => "close",

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

$different_themes_managment->add_options($differentThemes_slider_options);
?>