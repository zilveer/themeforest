<?php
$config  = array(
	'title' => sprintf( '%s Timeline Options', THEME_NAME ),
	'id' => 'mk-timeline-meta',
	'pages' => array(
		'timeline'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);

$options = array(
	array(
		"name" => __("Link to URL (Optional)", "mk_framework" ),
        "desc" => __( "Fill this field with a link includinge http://", "mk_framework" ),
		"id" => "_link",
		"default" => '',
		"type" => "text"
	),
	array(
		"name" => __( "Button Target", "mk_framework" ),
		"desc" => __( "Please choose this column link target.", "mk_framework" ),
		"id" => "_target",
		"default" => '_self',
		"options" => array(
			"_self" => __( "Same window", 'mk_framework' ),
			"_blank" => __( 'New Window', 'mk_framework' ),

		),
		"type" => "select"
	),
	array(
        "name" => __( "Add Icon Class Name", "mk_framework" ),
        "desc" => __( "<a target='_blank' href='".admin_url( 'admin.php?page=icon-library')."'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework" ),
        "id" => "_icon",
        "default" => "",
        "type" => "text"
    ),
);
new mkMetaboxesGenerator( $config, $options );
