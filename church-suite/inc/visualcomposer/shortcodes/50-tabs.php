<?php

$attributes = array(
			"type"=>'colorpicker',
			"heading"=>esc_html__('Icon color', 'webnus_framework'),
			"param_name"=> "icon_color",
			"value"=>"",
			"description" => esc_html__( "Select icon color", 'webnus_framework')
);
vc_add_param('vc_tab', $attributes);

$attributes = array(
			"type" => "iconfonts",
			"heading" => esc_html__( "Icon", 'webnus_framework' ),
			"param_name" => "icon_name",
			'value'=>'',
			"description" => esc_html__( "Select Icon", 'webnus_framework')
);
vc_add_param('vc_tab', $attributes);

$attributes =   array(
                "type" => "dropdown",
                "heading" => esc_html__( "Type", 'webnus_framework' ),
                "param_name" => "tabs_type",
                "value" => array(
				"Type 1"=>'',
				"Type 2"=>'2',
				),
                "description" => esc_html__( "Select Tabs Type", 'webnus_framework')
);
vc_add_param('vc_tabs', $attributes);

$attributes =   array(
                "type" => "dropdown",
                "heading" => esc_html__( "Type", 'webnus_framework' ),
                "param_name" => "tabs_type",
                "value" => array(
				"Type 1"=>'',
				"Type 2"=>'2',
				),
                "description" => esc_html__( "Select Tabs Type", 'webnus_framework')
);
vc_add_param('vc_tour', $attributes);
?>