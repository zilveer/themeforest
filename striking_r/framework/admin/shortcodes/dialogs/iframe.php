<?php
return array(
	"title" => __("Iframe", "theme_admin"),
	"shortcode" => 'iframe',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Src",'theme_admin'),
			"id" => "src",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array (
			"name" => __("Width",'theme_admin'),
			"id" => "width",
			"default" => '',
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"units" => array('px','%'),
			'default_unit' => 'px',
			"type" => "measurement",
		),
		array (
			"name" => __("Height",'theme_admin'),
			"id" => "height",
			"default" => '0',
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range",
			'unit' => 'px',
		),
	),
	"custom" => '',
);