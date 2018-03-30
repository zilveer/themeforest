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
		"subtitle" => __( "Testimonial author name.", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_author",
		"default" => "",
		"size"=> 50,
		"type" => "text"
	),
array(
		"name" => __( "Company Name", "mk_framework" ),
		"subtitle" => __( "Company or whatever position the author has. will be shown below name.", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_company",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Website URL", "mk_framework" ),
		"subtitle" => __( "Author website URL. its completely optional.", "mk_framework" ),
		"desc" => __( "please include http://", "mk_framework" ),
		"id" => "_url",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Author Quote", "mk_framework" ),
		"subtitle" => __( "Please fill this form as the author quote. you are allowed to use any type of HTML code and shortcode.", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_desc",
		"default" => "",
		"type" => "editor"
	),


);
new mk_metaboxesGenerator( $config, $options );
