<?php
vc_map( array(
	"name" =>"Webnus Button",
	"base" => "button",
	"description" => "Button shortcode",
	"category" => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
	"icon" => "webnus_button",
	"params" => array(
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Shape", 'webnus_framework' ),
			"param_name" => "shape",
			"value" => array(
				"Default"=>"",
				"Square"=>"square",
				"Rounded"=>"rounded",
				),
			"description" => esc_html__( "Button Type", 'webnus_framework')
			),
			
			array(
			"type" => "textarea",
			"heading" => esc_html__( "Content", 'webnus_framework' ),
			"param_name" => "btn_content",
			"value"=>'',
			"description" => esc_html__( "Button Text Content", 'webnus_framework')
			),
			
			array(
			"type" => "textfield",
			"heading" => esc_html__( "URL", 'webnus_framework' ),
			"param_name" => "url",
			"value"=>'#',
			"description" => esc_html__( "Button URL Link", 'webnus_framework')
			),
									
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Target", 'webnus_framework' ),
			"param_name" => "target",
			"description" => esc_html__( "Button URL Target", 'webnus_framework'),
			"value" => array(
				"Self"=>"_self",
				"Blank"=>"_blank",
				"Parent"=>"_parent",
				"Top"=>"_top",
				),
			),
			
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color", 'webnus_framework' ),
			"param_name" => "color",
			"description" => esc_html__( "Button Color", 'webnus_framework'),
			"value" => array(
				"Green"=>"green",
				"Red"=>"red",
				"Blue"=>"blue",
				"Gray"=>"gray",
				"Dark gray"=>"dark-gray",
				"Cherry"=>"cherry",
				"Orchid"=>"orchid",
				"Pink"=>"pink",
				"Orange"=>"orange",
				"Teal"=>"teal",
				"SkyBlue"=>"skyblue",
				"Jade"=>"jade",
				"White"=>"white",
				"Black"=>"black",
				),
			),
									
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Size", 'webnus_framework' ),
			"param_name" => "size",
			"description" => esc_html__( "Button Size", 'webnus_framework'),
			"value" => array(
				"Small"=>"small",
				"Medium"=>"medium",
				"Large"=>"large",	
				),
			),

			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Bordered?", 'webnus_framework' ),
			"param_name" => "border",
			"value"=>array('Normal'=>'false','Bordered'=>'true'),
			"description" => esc_html__( "Is button bordered?", 'webnus_framework')
			),
			
			array(
			"type" => "iconfonts",
			"heading" => esc_html__( "Icon", 'webnus_framework' ),
			"param_name" => "icon",
			"value"=>'',
			"description" => esc_html__( "Select Button Icon", 'webnus_framework')
			),	
	),
));
?>