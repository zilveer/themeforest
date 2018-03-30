<?php
return array(
	"title" => __("Sitemap With Portfolios", "theme_admin"),
	"shortcode" => 'sitemap',
	"attributes" => 'type="portfolios"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Show Comment",'theme_admin'),
			"id" => "show_comment",
			"desc" => __(" ",'theme_admin'),
			"default" => false,
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
			"target" => 'portfolio_category',
			"chosen" => true,
			"prompt" => __("Select Categories..",'theme_admin'),
			"type" => "multiselect",
		),
	),
);
