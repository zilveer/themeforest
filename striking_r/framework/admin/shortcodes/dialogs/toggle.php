<?php
return array(
	"title" => __("Toggle",'theme_admin'),
	"shortcode" => 'toggle',
	"type" => 'enclosing',
	"options" => array(
		array(
			"name" => __("Title",'theme_admin'),
			"id" => "title",
			"default" => "",
			"class" => "full",
			"type" => "text"
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Open",'theme_admin'),
			"desc" => __("If true, the toggle will be opened after init.",'theme_admin'),
			"id" => "open",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Icon Color (Optional)&#x200E;",'theme_admin'),
			"id" => "iconColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Title Font Size (Optional)&#x200E;",'theme_admin'),
			"id" => "titleSize",
			"min" => 0,
			"max" => 45,
			"step" => "1",
			"unit" => 'px',
			"default" => 0,
			"type" => "range"
		),
		array(
			"name" => __("Icon Font Size (Optional)&#x200E;",'theme_admin'),
			"id" => "iconSize",
			"min" => 0,
			"max" => 45,
			"step" => "1",
			"unit" => 'px',
			"default" => 0,
			"type" => "range"
		),
		array(
			"name" => __("Align (Optional)&#x200E;",'theme_admin'),
			"id" => "align",
			"default" => 'left',
			"options" => array(
				"left" => __('Left','theme_admin'),
				"right" => __('Right','theme_admin'),
			),
			"type" => "select",
		),
	),
	"custom" => '',
);