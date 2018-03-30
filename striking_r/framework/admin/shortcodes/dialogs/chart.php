<?php
return array(
	"title" => __("Google Chart", "theme_admin"),
	"shortcode" => 'chart',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => "data",		
			"id" => "data",
			"default" => "",
			"rows" => "2",
			"type" => "textarea"
		),
		array(
			"name" => "labels",		
			"id" => "labels",
			"default" => "",
			"rows" => "2",
			"type" => "textarea"
		),
		array(
			"name" => "colors",		
			"id" => "colors",
			"default" => "",
			"rows" => "2",
			"type" => "textarea"
		),
		array(
			"name" => "bg",
			"id" => "bg",
			"size" => 30,
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => "size",		
			"id" => "size",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => "title",		
			"id" => "title",
			"size" => 30,
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => "type",		
			"id" => "type",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => "advanced",		
			"id" => "advanced",
			"default" => "",
			"type" => "textarea"
		),
	),
);
