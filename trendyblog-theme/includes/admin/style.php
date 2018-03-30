<?php
global $different_themes_managment;
$differentThemes_slider_options= array(
 array(
	"type" => "navigation",
	"name" => esc_html__("Style Settings", THEME_NAME),
	"slug" => "custom-styling"
),

array(
	"type" => "tab",
	"slug"=>'custom-styling'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"font_style", "name"=>esc_html__("Font Style", THEME_NAME)),
		array("slug"=>"page_colors", "name"=>esc_html__("Page Colors/Style", THEME_NAME)),
		array("slug"=>"page_layout", "name"=>esc_html__("Layout", THEME_NAME))
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
	"type" => "title",
	"title" => esc_html__("Fonts",THEME_NAME)
),

array(
	"type" => "google_font_select",
	"title" => esc_html__("Body Font:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_google_font_1",
	"sort" => "alpha",
	"info" => esc_html__("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Titillium Web", 'txt' => "(default)")
),
array(
	"type" => "google_font_select",
	"title" => esc_html__("Headings
    (headings, menu links, dropcap first letter, panel subtitle):",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_google_font_2",
	"sort" => "alpha",
	"info" => esc_html__("Font previews You Can find here: <a href='http://www.google.com/webfonts' target='_blank'>Google Fonts</a>",THEME_NAME),
	"default_font" => array('font' => "Titillium Web", 'txt' => "(default)")
),


array(
	"type" => "close"

),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Font sizes",THEME_NAME)
),

array(
	"type" => "scroller",
	"title" => esc_html__("Body Font Size in PX (default 14px):",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_font_size_1",
	"max" => '30',
	"std" => "14"
),

array(
	"type" => "scroller",
	"title" => esc_html__("Main Menu Font Size in PX (default 16px):",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_font_size_2",
	"max" => '30',
	"std" => "16"
),
array(
	"type" => "scroller",
	"title" => esc_html__("Main Menu Description Font Size in PX (default 12px):",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_font_size_3",
	"max" => '30',
	"std" => "12"
),
array(
	"type" => "scroller",
	"title" => esc_html__("Main Menu Submenu Font Size in PX (default 12px):",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_font_size_4",
	"max" => '30',
	"std" => "12"
),



array(
	"type" => "close"

),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Font Character Sets", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Cyrillic Extended (cyrillic-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_cyrillic_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Cyrillic (cyrillic):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_cyrillic"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Greek Extended (greek-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_greek_ex"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Greek (greek):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_greek"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Vietnamese (vietnamese):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_vietnamese"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Latin Extended (latin-ext):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_font_latin_ex"
),

array(
	"type" => "close",

),
array(
	"type" => "save",
	"title" => esc_html__("Save Changes",THEME_NAME)
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
	"title" => esc_html__("Default Category/News page Color", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_default_cat_color", 
	"title" => esc_html__("Color:", THEME_NAME),
	"std" => "f85050",
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Colors", THEME_NAME)
),

array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_1", 
	"title" => esc_html__("Color
    (link hover, weather forecast icon, weather forecast temp, logo span,
    dropcap first letter, quotes, meta calendar icon):", THEME_NAME),
	"std" => "f85050",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_2", 
	"title" => esc_html__("Background
    (mark, button, search icon in menu, format, tags hover, post format hover,
    input submit, shop hover icon, pagination current link, shop button,
    span format icon, review border, rating result, transition line, wide slider
    controls, filter shop handle):", THEME_NAME),
	"std" => "f85050",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_3", 
	"title" => esc_html__("Border
    (drop down menu, tags hover, slider pager top border):", THEME_NAME),
	"std" => "f85050",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_4", 
	"title" => esc_html__("Heading Colors in Post Content:", THEME_NAME),
	"std" => "222",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_5", 
	"title" => esc_html__("Content Link Color:", THEME_NAME),
	"std" => "FC8D8D",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_6", 
	"title" => esc_html__("Toggle background color:", THEME_NAME),
	"std" => "eee",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_7", 
	"title" => esc_html__("Toggle icon background:", THEME_NAME),
	"std" => "ddd",
),
array( 
	"type" => "color", 
	"id" => $different_themes_managment->themeslug."_color_8", 
	"title" => esc_html__("Toggle icon color:", THEME_NAME),
	"std" => "999",
),


array(
	"type" => "close"
),

array(
	"type" => "row",

),
array(
	"type" => "title",
	"title" => esc_html__("Body Backgrounds (only boxed view)",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_body_bg_type",
	"radio" => array(
		array("title" => esc_html__("Pattern:",THEME_NAME), "value" => "pattern"),
		array("title" => esc_html__("Custom Image:",THEME_NAME), "value" => "image"),
		array("title" => esc_html__("Color:",THEME_NAME), "value" => "color"),
	),
	"std" => "pattern"
),

array(
	"type" => "select",
	"title" => esc_html__("Patterns ",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_pattern",
	"options"=>array(
		array("slug"=>"2", "name"=>esc_html__("Texture 1",THEME_NAME)), 
		array("slug"=>"3", "name"=>esc_html__("Texture 2",THEME_NAME)), 
		array("slug"=>"4", "name"=>esc_html__("Texture 3",THEME_NAME)), 
		array("slug"=>"5", "name"=>esc_html__("Texture 4",THEME_NAME)), 
	),
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "pattern")
	)
),

array(
	"type" => "color",
	"title" => esc_html__("Body Background Color:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_color",
	"std" => "f1f1f1",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "color")
	)
),

array(
	"type" => "upload",
	"title" => esc_html__("Body Background Image:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),

array(
	"type" => "input",
	"title" => esc_html__("Background Image Url:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_body_image_url",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "title",
	"title" => esc_html__("Image Repeat",THEME_NAME),
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_body_image_repeat",
	"radio" => array(
		array("title" => esc_html__("Repeat X:",THEME_NAME), "value" => "repeat-x"),
		array("title" => esc_html__("Repeat Y:",THEME_NAME), "value" => "repeat-y"),
		array("title" => esc_html__("Repeat X and Y:",THEME_NAME), "value" => "repeat"),
		array("title" => esc_html__("Off:",THEME_NAME), "value" => "no-repeat"),
	),
	"std" => "no-repeat",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_body_bg_type", "value" => "image")
	)
),
array(
	"type" => "close",

),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME),
),
   
array(
	"type" => "closesubtab"
),
/* ------------------------------------------------------------------------*
 * PAGE LAYOUT
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=> 'page_layout'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Menu", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_stickyMenu",
	"radio" => array(
		array("title" => esc_html__("Sticky:", THEME_NAME), "value" => "on"),
		array("title" => esc_html__("Fixed:", THEME_NAME), "value" => "off"),
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
	"title" => esc_html__("Header Style", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_headerStyle",
	"radio" => array(
		array("title" => esc_html__("Logo + Menu:", THEME_NAME), "value" => "1"),
		array("title" => esc_html__("Logo + Banner + Menu:", THEME_NAME), "value" => "2"),
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
	"title" => esc_html__("Enable Responsive", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Enable", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_responsive"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Back To Top Button", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_backToTop"
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Page Layout", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_page_layout",
	"radio" => array(
		array("title" => esc_html__("Boxed:", THEME_NAME), "value" => "boxed"),
		array("title" => esc_html__("Wide:", THEME_NAME), "value" => "wide"),
	),
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