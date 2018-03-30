<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
$config = array(
	'title' => sprintf('%s Employees Options', THEME_NAME) ,
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'employees'
	) ,
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(
	array(
		"name" => __("Single Employee Page?", "mk_framework") ,
		"desc" => __("If you enable this option, This employee member will have a single post so you can add extra content in above editor.", "mk_framework") ,
		"id" => "_single_post",
		"default" => 'false',
		"options" => array(
			"false" => __("No", "mk_framework") ,
			"true" => __("Yes please", "mk_framework") ,
		) ,
		"type" => "select"
	) ,
	
	array(
		"name" => __("Single Post Layout", "mk_framework") ,
		"desc" => __("Choose single post layout style.", "mk_framework") ,
		"id" => "_employees_single_layout",
		"default" => 'style1',
		"preview" => false,
		"options" => array(
			"style1" => __("Style 1", "mk_framework") ,
			"style2" => __("Style 2", "mk_framework") ,
			"style3" => __("Style 3", "mk_framework") ,
		) ,
		"type" => "select",
		"dependency" => array(
            'element' => "_single_post",
            'value' => array(
                'true',
            )
        ) ,
	) ,
	
	array(
		"name" => __("Header Hero Background Image", "mk_framework") ,
		"desc" => __("Upload an image for single post > style 3 layout > header hero background image. Best image size for this field is 1920px * 550px.  (Specific to style 3)", "mk_framework") ,
		"id" => "_header_hero_bg_image",
		"default" => "",
		"type" => "upload",
		"dependency" => array(
            'element' => "_single_post",
            'value' => array(
                'true',
            )
        ) ,
	) ,
	
	array(
		"name" => __('Header Hero Background Color', 'mk_framework') ,
		"desc" => __("choose a color for single post > style 3 layout > header hero background color. (Specific to style 3)", "mk_framework") ,
		"id" => "_header_hero_bg_color",
		"default" => "#636667",
		"type" => "color",
		"dependency" => array(
            'element' => "_single_post",
            'value' => array(
                'true',
            )
        ) ,
	) ,
	
	array(
		"name" => __("Header Hero Content Skin", "mk_framework") ,
		"desc" => __("Specific to style 3", "mk_framework") ,
		"id" => "_header_hero_skin",
		"default" => 'light',
		"preview" => false,
		"options" => array(
			"light" => __("Light", "mk_framework") ,
			"dark" => __("Dark", "mk_framework") ,
		) ,
		"type" => "select"
	) ,
	
	array(
		"name" => __("Link to a URL", "mk_framework") ,
		"desc" => __("Optionally you can add URL to this memeber such as a detailed page. Please note that this option will only work when you dont enable single employee page in above option.", "mk_framework") ,
		"id" => "_permalink",
		"default" => "",
		"type" => "superlink",
		"dependency" => array(
            'element' => "_single_post",
            'value' => array(
                'false',
            )
        ) ,
	) ,
	
	array(
		"name" => __("Employee Position", "mk_framework") ,
		"desc" => __("Please enter team member's Position in the company.", "mk_framework") ,
		"id" => "_position",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("About Member", "mk_framework") ,
		"desc" => __("This text will be shown in employees loop. To show content in single employee, you should add your content into above WP editor.", "mk_framework") ,
		"id" => "_desc",
		"default" => "",
		"type" => "editor"
	) ,
	
	array(
		"name" => __("Email Address", "mk_framework") ,
		"desc" => __("", "mk_framework") ,
		"id" => "_email",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Social Network (Facebook)", "mk_framework") ,
		"desc" => __("Please enter full URL of this social network(include http://).", "mk_framework") ,
		"id" => "_facebook",
		"default" => "",
		"type" => "text"
	) ,
	
	array(
		"name" => __("Social Network (Twitter)", "mk_framework") ,
		"desc" => __("Please enter full URL of this social network(include http://).", "mk_framework") ,
		"id" => "_twitter",
		"default" => "",
		"type" => "text"
	) ,
	array(
		"name" => __("Social Network (Google Plus)", "mk_framework") ,
		"desc" => __("Please enter full URL of this social network(include http://).", "mk_framework") ,
		"id" => "_googleplus",
		"default" => "",
		"type" => "text"
	) ,
	
	array(
		"name" => __("Social Network (Linked In)", "mk_framework") ,
		"desc" => __("Please enter full URL of this social network(include http://).", "mk_framework") ,
		"id" => "_linkedin",
		"default" => "",
		"type" => "text"
	) ,

	array(
		"name" => __("Social Network (Instagram)", "mk_framework") ,
		"desc" => __("Please enter full URL of this social network(include http://).", "mk_framework") ,
		"id" => "_instagram",
		"default" => "",
		"type" => "text"
	) ,
	
	array(
		"desc" => __("Please Use the featured image metabox to upload your employee photo and then assign to the post.", "mk_framework") ,
		"type" => "info"
	) ,
);
new mkMetaboxesGenerator($config, $options);
