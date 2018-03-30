<?php
return array(
	"title" => __("Sitemap With Pages, Categories, Posts and Portfolios", "theme_admin"),
	"shortcode" => 'sitemap',
	"attributes" => 'type="all"',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Columns",'theme_admin'),
			"id" => "shows",
			"default" => array(),
			"options" => array(
				"pages" => __("Pages",'theme_admin'),
				"categories" => __("Categories",'theme_admin'),
				"posts" => __("Posts",'theme_admin'),
				"portfolios" => __("Portfolios",'theme_admin'),
			),
			"type" => "multiselect",
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
	),
);
