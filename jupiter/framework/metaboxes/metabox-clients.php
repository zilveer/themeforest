<?php
$config  = array(
	'title' => sprintf( '%s Clients Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'clients'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(


	array(
		"name" => __( "URL to Clients Website (optional)", "mk_framework" ),
		"desc" => __( "include http://", "mk_framework" ),
		"id" => "_url",
		"default" => "",
		"size"=> 50,
		"type" => "text"
	),

array(
		"desc" => __( "Please use the featured image metabox to upload your Clients Logo and then assign to the post. The image width should not exceed 170px and height is depending on your shortcode settings, default is 110px though you can change height from 50 to 300", "mk_framework" ),
		"type" => "info"
	),

);
new mkMetaboxesGenerator( $config, $options );
