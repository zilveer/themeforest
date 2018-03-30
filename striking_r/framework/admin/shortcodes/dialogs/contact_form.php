<?php
return array(
	"title" => __("Contact Form", "theme_admin"),
	"shortcode" => 'contactform',
	"type" => 'both',
	"options" => array(
		array(
			"name" => __("email (Optional)&#x200E;",'theme_admin'),
			"id" => "email",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("Success Text (Optional)&#x200E;",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Submit Button Text (Optional)&#x200E;",'theme_admin'),
			"id" => "submit",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Submit Button Background Color (Optional)&#x200E;",'theme_admin'),
			"id" => "bgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Submit Button Text Color (Optional)&#x200E;",'theme_admin'),
			"id" => "textColor",
			"default" => "",
			"type" => "color"
		),
	),
	"custom" => '',
);