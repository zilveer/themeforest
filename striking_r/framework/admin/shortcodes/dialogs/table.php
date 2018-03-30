<?php
return array(
	"title" => __("Table", "theme_admin"),
	"shortcode" => 'styled_table',
	"type" => 'enclosing',
	"options" => array(
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Width",'theme_admin'),
			"desc" => __("You can use % or px as units for width",'theme_admin'),
			"id" => "width",
			"default" => "",
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"units" => array('px','%'),
			'default_unit' => 'px',
			"type" => "measurement",
		),
	),
	"custom" => '',
);