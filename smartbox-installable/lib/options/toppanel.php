<?php

$designare_info_options= array( array(
"name" => "Header Layout",
"type" => "title",
"img" => DESIGNARE_IMAGES_URL."icon_home.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"header_layout", "name"=>"Header Style"), array("id"=>"top_panel", "name"=>"Top Bar"))
),

/*
array(
"type" => "open",
"subtitles"=>array(array("id"=>"contact_form", "name"=>"Contact Form"), array("id"=>"social_net", "name"=>"Social"))
),
*/


array(
"type" => "subtitle",
"id"=>'header_layout'
),

array(
"type" => "documentation",
"text" => '<h3>Fixed Header ON/OFF</h3>'
),

array(
"name" => "Fixed Header?",
"id" => DESIGNARE_SHORTNAME."_fixed_menu",
"type" => "checkbox",
"std" => "on"
),

array(
"type" => "documentation",
"text" => '<h3>Header Layout</h3>'
),

array(
	"type" => "documentation",
	"text" => '<p><b>Note:</b> After choose the header style, go to the next tab <b>Top Bar</b> and add your contents.</p>'
),

array(
	"name" => "Header Style Type",
	"id" => DESIGNARE_SHORTNAME."_header_style_type",
	"type" => "select",
	"options" => array(array('id'=>'style1', 'name'=>'Style 1'), array('id'=>'style2','name'=>'Style 2'), array('id'=>'style3','name'=>'Style 3'), array('id'=>'style4','name'=>'Style 4')),
	"std" => 'style1'
),


array(
	"type" => "close"
),

/* ------------------------------------------------------------------------*
 * Top Contents
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'top_panel'
),

	array(
		"type" => "documentation",
		"text" => "<h3>Top Bar Contents</h3>"
	),
	
	array(
	"type" => "documentation",
	"text" => '<p><b>Note:</b> This options are not avaiable for header style 1.</p>'
),

	array(
		"name" => "Columns Order",
		"id" => DESIGNARE_SHORTNAME."_toppanel_columns_order_four",
		"type" => "select",
		"options" => array(array("name"=>"x | x | x | x", "id"=>"one_four"), array("name"=>"x | xx | x", "id"=>"two_one_two_four"), array("name"=>"xxx | x", "id"=>"three_one_four"), array("name"=>"x | xxx", "id"=>"one_three_four")),
		"std" => "one_four"
	),
	
	array(
		"name" => "Telephone",
		"id" => DESIGNARE_SHORTNAME."_telephone_menu",
		"type" => "text",
		"desc" => "Insert number to display above the menu. <br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Email",
		"id" => DESIGNARE_SHORTNAME."_email_menu",
		"type" => "text",
		"desc" => "Insert email to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Address",
		"id" => DESIGNARE_SHORTNAME."_address_menu",
		"type" => "text",
		"desc" => "Insert address to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Text Field",
		"id" => DESIGNARE_SHORTNAME."_text_field_menu",
		"type" => "text",
		"desc" => "Insert a custom text line.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Enable Social Icons",
		"id" => DESIGNARE_SHORTNAME."_enable_socials",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"type" => "close"
	),
	
	array(
	"type" => "close"));

designare_add_options($designare_info_options);