<?php vc_map( array(
	"name" =>"SlideUp Note",
	"base" => "slideup",
	"description" => "SlideUp Note",
	"icon" => "slideup",
	"category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
	"params" => array(
		array(
			"type"=>'textfield',
			"heading"=>esc_html__('Title', 'webnus_framework'),
			"param_name"=> "title",
			"value"=>"",
			"description" => esc_html__( "Note Title", 'webnus_framework')
		),
		array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Title color (leave bank for default color)', 'webnus_framework'),
			"param_name"=> "title_color",
			"value"=>"",
			"description" => esc_html__( "Select title background color", 'webnus_framework')
		),
		array(
			"type"=>'textarea',
			"heading"=>esc_html__('Content', 'webnus_framework'),
			"param_name"=> "slideup_content",
			"value"=>"",
			"description" => esc_html__( "Note Content", 'webnus_framework')	
		),    
	),
)); ?>