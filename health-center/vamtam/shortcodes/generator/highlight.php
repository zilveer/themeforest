<?php

return array(
	"name" => __("Highlight", 'health-center') ,
	"value" => "highlight",
	"options" => array(
		array(
			"name" => __("Type", 'health-center') ,
			"id" => "type",
			"default" => '',
			"options" => array(
				"light" => __("light", 'health-center') ,
				"dark" => __("dark", 'health-center') ,
			) ,
			"type" => "select",
		) ,
		array(
			"name" => __("Content", 'health-center') ,
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		) ,
	)
);