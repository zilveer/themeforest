<?php
$config  = array(
	'title' => sprintf( '%s Testimonials Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'testimonial'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);
$options = array(
array(
		"name" => __( "Author Name", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_author",
		"default" => "",
		"type" => "text"
	),
array(
		"name" => __( "Company Name / Job Title", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_company",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "URL to Author's Website (optional)", "mk_framework" ),
		"desc" => __( "include http://", "mk_framework" ),
		"id" => "_url",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Quote", "mk_framework" ),
		"desc" => __( "Please fill below area with the quote", "mk_framework" ),
		"id" => "_desc",
		"default" => "",
		"type" => "editor"
	),


);
new mkMetaboxesGenerator( $config, $options );
