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
		"name" => __( "Company Name", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"subtitle" => __( "", "mk_framework" ),
		"id" => "_company",
		"default" => "",
		"option_structure" => 'sub',
		"divider" => true,
		"size"=> 50,
		"type" => "text"
	),

	array(
		"name" => __( "Website URL", "mk_framework" ),
		"desc" => __( "Include http://", "mk_framework" ),
		"subtitle" => __( "URL to the client's website or any external source. Optional!", "mk_framework" ),
		"id" => "_url",
		"default" => "",
		"type" => "text"
	),


);
new mk_metaboxesGenerator( $config, $options );
