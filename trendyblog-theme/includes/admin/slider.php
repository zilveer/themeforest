<?php
global $different_themes_managment;
$differentThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => esc_html__("Slider Settings", THEME_NAME),
	"slug" => "sliders"
),

array(
	"type" => "tab",
	"slug"=>'sliders'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"main_slider", "name"=>esc_html__("Main News Slider", THEME_NAME)),
		array("slug"=>"breaking_slider", "name"=>esc_html__("Breaking News Slider", THEME_NAME)),
		)
),


/* ------------------------------------------------------------------------*
 * MAIN NEWS SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'main_slider'
),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html__("Main News Sliders Settings", THEME_NAME)
),

array(
	"type" => "scroller",
	"id" => $different_themes_managment->themeslug."_main_slider_count",
	"title" => esc_html__("Main Slider Slide Count (Small Slider Only)", THEME_NAME),
	"max" => "100",
	"std" => "8"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME)
),
   
array(
	"type" => "closesubtab"
),

/* ------------------------------------------------------------------------*
 * BREAKING NEWS SLIDER SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'breaking_slider'
),


array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Breaking News Slider", THEME_NAME)
),

array(
	"type" => "checkbox",
	"title" => __("Show In Posts:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_breaking_news_post",
),
array(
	"type" => "checkbox",
	"title" => __("Show In Pages:", THEME_NAME),
	"id"=> $different_themes_managment->themeslug."_breaking_news_page"
),
array(
	"type" => "checkbox",
	"title" => __("Show In Blog:", THEME_NAME),
	"id"=> $different_themes_managment->themeslug."_breaking_news_blog"
),
array(
	"type" => "checkbox",
	"title" => __("Show In Homepage:", THEME_NAME),
	"id"=> $different_themes_managment->themeslug."_breaking_news_home"
),
array(
	"type" => "title",
	"title" => esc_html__("Breaking News Slider Categories", THEME_NAME)
),
array(
	"type" => "multiple_select",
	"title" => esc_html__("Set Categories", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_breaking_slider",
	"taxonomy" => "category",
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME)
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