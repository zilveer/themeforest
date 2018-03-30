<?php
return array(
	"title" => __("Blockquote", "theme_admin"),
	"shortcode" => 'blockquote',
	"type" => 'enclosing',
	"options" => array(
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
		array(
			"name" => __("Cite (Optional)&#x200E;",'theme_admin'),
			"id" => "cite",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => '',
);