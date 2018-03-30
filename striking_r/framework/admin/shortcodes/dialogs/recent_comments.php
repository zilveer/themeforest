<?php
return array(
	"title" => __("Recent Comments",'theme_admin'),
	"shortcode" => 'recent_comments',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Count",'theme_admin'),
			"desc" => __("Number of Comments to show.",'theme_admin'),
			"id" => "count",
			"default" => '5',
			"min" => 1,
			"max" => 30,
			"step" => "1",
			"type" => "range"
		),
	),
);
