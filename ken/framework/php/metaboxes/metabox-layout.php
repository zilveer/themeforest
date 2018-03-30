<?php
$config  = array(
	'title' => sprintf( '%s Page layout', THEME_NAME ),
	'id' => 'mk-layout-metabox',
	'pages' => array(
		'portfolio',
		'post',
		'page'
	),
	'callback' => '',
	'context' => 'side',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "Page Layout", "mk_framework" ),
		"subtitle" => __( "Please choose this page's layout. Default : Full layout", "mk_framework" ),
		"id" => "_layout",
		"default" => 'full',
		"placeholder" => 'false',
		"width" => 230,
		"options" => array(
			"full" => 'No sidebar',
			"right" => 'Right Sidebar',
			"left" => 'Left Sidebar',
		),
		"type" => "select"
	),

	array(
    "name" => __("Choose a Sidebar", "mk_framework" ),
    "subtitle" => __( "Assign a custom sidebar to this page.", "mk_framework" ),
    "id" => "_sidebar",
    "width" => 230,
    "default" => '',
    'placeholder' => 'true',
    "options" => mk_get_sidebar_options(),
    "type" => "select"
  ),



);

new mk_metaboxesGenerator( $config, $options );
