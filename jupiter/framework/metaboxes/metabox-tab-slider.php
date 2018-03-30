<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
$config = array(
	'title' => sprintf('%s Tab Slider Options', THEME_NAME) ,
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'tab_slider'
	) ,
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);

$options = array(
	
	array(
		"name" => __("Tab Icon", "mk_framework") ,
		"desc" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme).", "mk_framework") ,
		"id" => "_menu_icon",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Tab Title", "mk_framework") ,
		"desc" => __("This text will be used in tab section. If left blank the above icon will be used as tab text.", "mk_framework") ,
		"id" => "_menu_text",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Content Title", "mk_framework") ,
		"desc" => __("This text will be used as tab title", "mk_framework") ,
		"id" => "_title",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Theme Skin Color", "mk_framework") ,
		"desc" => __("", "mk_framework") ,
		"id" => "_skin_color",
		"default" => 'dark',
		"options" => array(
			"dark" => __("Dark", 'mk_framework') ,
			"light" => __('Light', 'mk_framework')
		) ,
		"type" => "select"
	) ,
	array(
		"name" => __('Content Background Color', 'mk_framework') ,
		"desc" => __("You can use solid color in tab slider background.", "mk_framework") ,
		"id" => "_bg_color",
		"default" => "",
		"type" => "color"
	) ,
	array(
		"name" => __("Image Align", "mk_framework") ,
		"desc" => __("Location of tab image.", "mk_framework") ,
		"id" => "_image_align",
		"default" => 'left',
		"options" => array(
			"left" => __("Left", 'mk_framework') ,
			"right" => __('Right', 'mk_framework')
		) ,
		"type" => "select"
	) ,
	array(
		"name" => __("Short Description", "mk_framework") ,
		"subtitle" => __('', "mk_framework") ,
		"id" => "_desc",
		"default" => '',
		"type" => "textarea"
	) ,
	array(
		"name" => __("Button Text", "mk_framework") ,
		"desc" => __("This text will be used as tab button text.", "mk_framework") ,
		"id" => "_button_text",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Button Url", "mk_framework") ,
		"desc" => __("Please enter full URL of this url(include http://).", "mk_framework") ,
		"id" => "_button_url",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Enable Share Button?", "mk_framework") ,
		"desc" => __("If you enable this option you can add share button.", "mk_framework") ,
		"id" => "_share_button",
		"default" => "false",
		"type" => "toggle"
	) ,
);
new mkMetaboxesGenerator($config, $options);
