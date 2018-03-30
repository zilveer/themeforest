<?php
global $orange_themes_managment;
$orangeThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => "Slider Settings",
	"slug" => "sliders"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"header_slider", "name"=>"Header Slider"),
		)
),

/* ------------------------------------------------------------------------*
 * HEADER SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'header_slider'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Header Slider",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "off")
	)
),


array(
	"type" => "checkbox",
	"title" => "Enable Header Slider:",
	"id"=>$orange_themes_managment->themeslug."_header_slider"
),

array(
	"type" => "title",
	"title" => "Slide 1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "upload",
	"title" => "Image:",
	"info" => "Suggested image size is 115x139px",
	"id" => $orange_themes_managment->themeslug."_slider_image_1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
), 
array(
	"type" => "input",
	"title" => "Title:",
	"id" => $orange_themes_managment->themeslug."_slider_title_1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "textarea",
	"title" => "Text:",
	"id" => $orange_themes_managment->themeslug."_slider_text_1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Link:",
	"id" => $orange_themes_managment->themeslug."_slider_link_1",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),
array(
	"type" => "title",
	"title" => "Slide 2",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "upload",
	"title" => "Image:",
	"info" => "Suggested image size is 115x139px",
	"id" => $orange_themes_managment->themeslug."_slider_image_2",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
), 
array(
	"type" => "input",
	"title" => "Title:",
	"id" => $orange_themes_managment->themeslug."_slider_title_2",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "textarea",
	"title" => "Text:",
	"id" => $orange_themes_managment->themeslug."_slider_text_2",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Link:",
	"id" => $orange_themes_managment->themeslug."_slider_link_2",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),
array(
	"type" => "title",
	"title" => "Slide 3",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "upload",
	"title" => "Image:",
	"info" => "Suggested image size is 115x139px",
	"id" => $orange_themes_managment->themeslug."_slider_image_3",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
), 
array(
	"type" => "input",
	"title" => "Title:",
	"id" => $orange_themes_managment->themeslug."_slider_title_3",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),

array(
	"type" => "textarea",
	"title" => "Text:",
	"id" => $orange_themes_managment->themeslug."_slider_text_3",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => "Link:",
	"id" => $orange_themes_managment->themeslug."_slider_link_3",
	"protected" => array(
		array("id" => $orange_themes_managment->themeslug."_header_slider", "value" => "on")
	)
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