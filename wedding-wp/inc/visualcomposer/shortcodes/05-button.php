<?php
vc_map( array(
	"name" =>"Webnus Button",
	"base" => "button",
	"description" => "Button shortcode",
	"category" => esc_html__( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
	"icon" => "webnus_button",
	"params" => array(
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Shape", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "shape",
			"value" => array(
				"Default"=>"",
				"Square"=>"square",
				"Rounded"=>"rounded",
				),
			"description" => esc_html__( "Button Type", 'WEBNUS_TEXT_DOMAIN')
			),
			
			array(
			"type" => "textarea",
			"heading" => esc_html__( "Content", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "btn_content",
			"value"=>'',
			"description" => esc_html__( "Button Text Content", 'WEBNUS_TEXT_DOMAIN')
			),
			
			array(
			"type" => "textfield",
			"heading" => esc_html__( "URL", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "url",
			"value"=>'#',
			"description" => esc_html__( "Button URL Link", 'WEBNUS_TEXT_DOMAIN')
			),
									
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Target", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "target",
			"description" => esc_html__( "Button URL Target", 'WEBNUS_TEXT_DOMAIN'),
			"value" => array(
				"Self"=>"_self",
				"Blank"=>"_blank",
				"Parent"=>"_parent",
				"Top"=>"_top",
				),
			),
			
			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Color", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "color",
			"description" => esc_html__( "Button Color", 'WEBNUS_TEXT_DOMAIN'),
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
			"heading" => esc_html__( "Size", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "size",
			"description" => esc_html__( "Button Size", 'WEBNUS_TEXT_DOMAIN'),
			"value" => array(
				"Small"=>"small",
				"Medium"=>"medium",
				"Large"=>"large",	
				),
			),

			array(
			"type" => "dropdown",
			"heading" => esc_html__( "Bordered?", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "border",
			"value"=>array('Normal'=>'false','Bordered'=>'true'),
			"description" => esc_html__( "Is button bordered?", 'WEBNUS_TEXT_DOMAIN')
			),
			
			array(
			"type" => "iconfonts",
			"heading" => esc_html__( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "icon",
			"value"=>'',
			"description" => esc_html__( "Select Button Icon", 'WEBNUS_TEXT_DOMAIN')
			),	
	),
));
?>