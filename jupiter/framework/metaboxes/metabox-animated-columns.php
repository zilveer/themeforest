<?php
$config  = array(
	'title' => sprintf( '%s Animated Columns Options', THEME_NAME ),
	'id' => 'mk-animated-column-meta',
	'pages' => array(
		'animated-columns'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);

$options = array(
	array(
		"name" => __( "Icon Type", "mk_framework" ),
		"desc" => __( "Choose whether you want to upload your own image (as icon) or a font icon?", "mk_framework" ),
		"id" => "_icon_type",
		"default" => 'icon',
		"options" => array(
			"icon" => __( "Font Icon", 'mk_framework' ),
			"image" => __( 'Upload Image', 'mk_framework' ),

		),
		"type" => "select"
	),
	array(
        "name" => __( "Add Icon Class Name", "mk_framework" ),
        "desc" => __( "<a target='_blank' href='".admin_url( 'admin.php?page=icon-library')."'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework" ),
        "id" => "_icon",
        "default" => "",
        "type" => "text",
         "dependency" => array(
            'element' => "_icon_type",
            'value' => array(
                'icon',
            )
        ) ,
    ),
      array(
        "name" => __("Upload Image", "mk_framework"),
        "desc" => __("This image will be scaled down to the size you choose in animated column shortcode options.", "mk_framework"),
        "id" => "_image_icon",
        "default" => '',
        "preview" => false,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_icon_type",
            'value' => array(
                'image',
            )
        ) ,
    ),
	array(
		"name" => __( "Column Title", "mk_framework" ),
		"desc" => __( "This text will be used as column title", "mk_framework" ),
		"id" => "_title",
		"default" => "",
		"type" => "text"
	),
	array(
		"name" => __( "Columns Short Description", "mk_framework" ),
		"id" => "_desc",
		"default" => '',
		"type" => "textarea"
	),
	array(
		"name" => __("Button URL", "mk_framework" ),
        "desc" => __( "Fill this field with a link including http://", "mk_framework" ),
		"id" => "_link",
		"default" => '',
		"type" => "text"
	),
	
	array(
		"name" => __( "Button Text", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_text",
		"default" => "Learn More",
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
);
new mkMetaboxesGenerator( $config, $options );
