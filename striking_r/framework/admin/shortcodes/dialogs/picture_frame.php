<?php
return array(
	"title" => __("Picture Frame", "theme_admin"),
	"shortcode" => 'picture_frame',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Image Source Url",'theme_admin'),
			"id" => "source",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => __("Image Title (Optional)&#x200E;",'theme_admin'),
			"id" => "title",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Align (Optional)&#x200E;",'theme_admin'),
			"id" => "align",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"left" => __('Left','theme_admin'),
				"right" => __('Right','theme_admin'),
				"center" => __('Center','theme_admin'),
			),
			"type" => "select",
		),
	),
	"custom" => '',
);