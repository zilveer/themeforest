<?php
return array(
	"title" => __("Links", "theme_admin"),
	"shortcode" => 'links',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Show name",'theme_admin'),
			"id" => "name",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show description",'theme_admin'),
			"id" => "desc",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show images",'theme_admin'),
			"id" => "images",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show Rating",'theme_admin'),
			"id" => "rating",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Category",'theme_admin'),
			"id" => "cat",
			"default" => '',
			"target" => 'link_category',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "select",
		),
		array(
			"name" => __("Show Category Title",'theme_admin'),
			"id" => "cat_title",
			"default" => true,
			"type" => "toggle"
		),
	),
);
