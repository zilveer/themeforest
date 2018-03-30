<?php
return array(
	"title" => __("Gallery", "theme_admin"),
	"shortcode" => 'gallery',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Gallery Columns",'theme_admin'),
			"id" => "columns",
			"default" => '3',
			"options" => array(
				"1" => '1',
				"2" => '2',
				"3" => '3',
				"4" => '4',
				"5" => '5',
				"6" => '6',
				"7" => '7',
				"8" => '8',
			),
			"type" => "select",
		),
		array(
			"name" => __("Order",'theme_admin'),
			"id" => "order",
			"default" => 'ASC',
			"options" => array(
				"DESC" => __('DESC','theme_admin'),
				"ASC" => __('ASC','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Order By (Optional)&#x200E;",'theme_admin'),
			'desc' => __("specify the item used to sort the display thumbnails",'theme_admin'),
			"id" => "orderby",
			"default" => 'menu_order',
			"options" => array(
				"menu_order" => __('Menu order','theme_admin'),
				"title" => __('Title','theme_admin'),
				"ID" => __('Date/Time','theme_admin'),
				"rand" => __('Random','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Size (Optional)&#x200E;",'theme_admin'),
			'desc' => __("specify the image size to use for the thumbnail display.",'theme_admin'),
			"id" => "size",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"thumbnail" => __('Thumbnail','theme_admin'),
				"medium" => __('Medium','theme_admin'),
				"large" => __('Large','theme_admin'),
				"full" => __('Full','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("link",'theme_admin'),
			'desc' => __("If you set it to lightbox, when you click on the image, it will open as a lightbox.",'theme_admin'),
			"id" => "link",
			"default" => 'post',
			"options" => array(
				"file" => __('Lightbox','theme_admin'),
				"post" => __('Attachment Page','theme_admin'),
				"none" => __('None', 'theme_admin'),
			),
			"type" => "select",
		),
		array (
			"name" => __("Caption",'theme_admin'),
			"id" => "caption",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Image Effect",'theme_admin'),
			"desc" => "Effect when hover the image.",
			"id" => "effect",
			"default" => 'none',
			"options" => array(
				"grayscale" => __("Grayscale",'theme_admin'),
				"blur" => __("Blur",'theme_admin'),
				"zoom" => __("Zoom",'theme_admin'),
				"rotate" => __("Rotate",'theme_admin'),
				"morph" => __("Morph",'theme_admin'),
				"tilt" => __("Tilt",'theme_admin'),
				"none" => __("None",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Lightbox Title",'theme_admin'),
			"id" => "lightboxtitle",
			"default" => 'caption',
			"options" => array(
				"caption" => __('Caption of Image','theme_admin'),
				"title" => __('Title of Image','theme_admin'),
				"none" => __('None','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Lightbox Image Dimension Restriction",'theme_admin'),
			"desc" => __("If you enable this option, the lightbox dimension will be restricted to fit the browse screen size.",'theme_admin'),
			"id" => "lightbox_fittoview",
			"default" => true,
			"type" => "toggle"
		),
	),
	"custom" => '',
);