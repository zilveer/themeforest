<?php
return array(
	"title" => __("Contact Info", "theme_admin"),
	"shortcode" => 'contact_info',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Color (Optional)&#x200E;",'theme_admin'),
			"id" => "color",
			"default" => "",
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"black" => 'Black',
				"gray" => 'Gray',
				"red" => 'Red',
				"yellow" => 'Yellow',
				"blue" => 'Blue',
				"pink" => 'Pink',
				"green" => 'Green',
				"rosy" => 'Rosy',
				"orange" => 'Orange',
				"magenta" => 'Magenta',
			),
			"type" => "select",
		),
		array(
			"name" => __("Phone",'theme_admin'),
			"id" => "phone",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("Cell Phone",'theme_admin'),
			"id" => "cellphone",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("Fax",'theme_admin'),
			"id" => "fax",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("email",'theme_admin'),
			"id" => "email",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("link",'theme_admin'),
			"id" => "link",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("Address",'theme_admin'),
			"id" => "address",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("City",'theme_admin'),
			"id" => "city",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("State",'theme_admin'),
			"id" => "state",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("Zip",'theme_admin'),
			"id" => "zip",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
		array(
			"name" => __("Name",'theme_admin'),
			"id" => "name",
			"default" => "",
			"size" => 30,
			"type" => "text"
		),
	),
);
