<?php
$config  = array(
	'title' => sprintf( '%s Clients Options', THEME_NAME ),
	'id' => 'mk-metaboxes-notab',
	'pages' => array(
		'pricing'
	),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'core'
);


$options = array(
	array(
		"name" => __( "Table Skin Color", "mk_framework" ),
		"subtitle" => __( "This color will be applied only to this plan. If left blank the default skin will be applied.", "mk_framework" ),
		"id" => "skin",
		"default" => "",
		"type" => "color"
	),
	array(
		"name" => __("Featured Plan?", "mk_framework" ),
        "subtitle" => __( "If enabled this plan will have special design to grab attention.", "mk_framework" ),
		"desc" => __( "If you would like to select this item as featured enable this option.", "mk_framework" ),
		"id" => "featured",
		"default" => 'false',
		"type" => "toggle"
	),
	array(
		"name" => __( "Price", "mk_framework" ),
		"subtitle" => __( "price of the service or product.", "mk_framework" ),
        "desc" => __( "Include the currency symbol.", "mk_framework" ),
		"id" => "_price",
		"default" => "",
		"type" => "text"
	),

		
	array(
		"name" => __( "Features", "mk_framework" ),
		"subtitle" => __( 'You can learn more on documentation on how to make a sample pricing table list. switch to Text mode to see html code.', "mk_framework" ),
		"id" => "_features",
		"default" => '<ul>
	<li>10 Projects</li>
	<li>32 GB Storage</li>
	<li>Unlimited Users</li>
	<li>15 GB Bandwidth</li>
	<li><i class="mk-icon-times"></i></li>
	<li>Enhanced Security</li>
	<li>Retina Display Ready</li>
	<li><i class="mk-icon-check"></i></li>
	<li><i class="mk-icon-star"></i><i class="mk-icon-star"></i><i class="mk-icon-star"></i><i class="mk-icon-star"></i><i class="mk-icon-star"></i></li>
</ul>',
		"type" => "editor"
	),
	array(
		"name" => __( "Button Text", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_text",
		"default" => "Purchase",
		"type" => "text"
	),

	array(
		"name" => __( "Button URL", "mk_framework" ),
		"desc" => __( "", "mk_framework" ),
		"id" => "_btn_url",
		"default" => "",
		"type" => "text"
	),



);
new mk_metaboxesGenerator( $config, $options );
