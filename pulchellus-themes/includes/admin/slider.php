<?php
global $different_themes_managment;
$differentThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => "Slider Settings",
	"slug" => "sliders"
),

array(
	"type" => "tab",
	"slug"=>'sliders'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"homepage_slider", "name"=>"Homepage Slider"),
		)
),

/* ------------------------------------------------------------------------*
 * HOMEPAGE SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'homepage_slider'
),

array(
	"type" => "row",

),

array(
	"type" => "title",
	"title" => "Slider Type"
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_slider_enable",
	"title" => "Enable Homepage Slider",
	"radio" => array(
		array("title" => "Off", "value" => "off"),
		array("title" => "On", "value" => "on"),
	),
),
array(
	"type" => "close",

),

array(
	"type" => "row",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_slider_enable", "value" => "on")
	)

),
array(
	"type" => "layer_slider_select",
	"title" => "Slider",
	"id" => $different_themes_managment->themeslug."_home_slider",
	"info" => "Sliders You can create with LayerSlider WP (included with the theme). By creating homepage slider, choose <strong>borderlesslight</strong> style. And set The slider size <strong>940x400px.</strong>",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_slider_enable", "value" => "on")
	)

),
array(
	"type" => "close",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_slider_enable", "value" => "on")
	)

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