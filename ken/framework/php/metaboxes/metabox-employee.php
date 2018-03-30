<?php
$config  = array(
	'title' => sprintf( '%s Employees Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'employees'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "Employee Position", "mk_framework" ),
		"subtitle" => __( "Position in the company", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_position",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Description", "mk_framework" ),
		"subtitle" => __( "short description about the team member.", "mk_framework" ),
		"desc" => __( "You are allowed to use HTML code as well as shortcodes.", "mk_framework" ),
		"id" => "_desc",
		"default" => "",
		"type" => "editor"
	),
	array(
		"name" => __( "Email Address", "mk_framework" ),
		"subtitle" => __( "Employee email address", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_email",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Website", "mk_framework" ),
		"subtitle" => __( "Personal Blog or website", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_website",
		"default" => "",
		"type" => "text"
	),
		array(
		"name" => __( "Facebook", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_facebook",
		"default" => "",
		"type" => "text"
	),

		array(
		"name" => __( "Twitter", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_twitter",
		"default" => "",
		"type" => "text"
	),
		array(
		"name" => __( "Linked In", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_linkedin",
		"default" => "",
		"type" => "text"
	),

	array(
		"name" => __( "Instagram", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_instagram",
		"default" => "",
		"type" => "text"
	),

	array(
		"name" => __( "Dribbble", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_dribbble",
		"default" => "",
		"type" => "text"
	),
		array(
		"name" => __( "Google Plus", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_googleplus",
		"default" => "",
		"type" => "text"
	),

	array(
		"name" => __( "Pinterest", "mk_framework" ),
		"subtitle" => __( "Social Network", "mk_framework" ),
		"desc" => __( "Please enter full URL of this social network(include http://).", "mk_framework" ),
		"id" => "_pinterest",
		"default" => "",
		"type" => "text"
	),





);
new mk_metaboxesGenerator( $config, $options );
