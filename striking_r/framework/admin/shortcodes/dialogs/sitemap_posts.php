<?php
return array(
	"title" => __("Sitemap With Posts", "theme_admin"),
	"shortcode" => 'sitemap',
	"attributes" => 'type="posts"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Show Comment",'theme_admin'),
			"id" => "show_comment",
			"desc" => __(" ",'theme_admin'),
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("number",'theme_admin'),
			"desc" => __("Sets the number of Pages to display.<br> 0: Display all Pages.",'theme_admin'),
			"id" => "number",
			"default" => '0',
			"min" => 0,
			"max" => 200,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Category (Optional)&#x200E;",'theme_admin'),
			"id" => "cat",
			"default" => array(),
			"target" => 'cat',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Posts (Optional)&#x200E;",'theme_admin'),
			"desc" => __("The specific posts you want to display",'theme_admin'),
			"id" => "posts",
			"default" => array(),
			"target" => 'post',
			"chosen" => true,
			"prompt" => __("Select Posts..",'theme_admin'),
			"type" => "multiselect",
		),
		array(
			"name" => __("Author (Optional)&#x200E;",'theme_admin'),
			"id" => "author",
			"default" => array(),
			"target" => 'author',
			"chosen" => true,
			"prompt" => __("Select Authors..",'theme_admin'),
			"type" => "multiselect",
		),
	),
);
