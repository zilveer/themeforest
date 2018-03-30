<?php

$attributes = array(
			"type"=>'colorpicker',
			"heading"=>__('Icon color', 'WEBNUS_TEXT_DOMAIN'),
			"param_name"=> "icon_color",
			"value"=>"",
			"description" => __( "Select icon color", 'WEBNUS_TEXT_DOMAIN')
);
vc_add_param('vc_tab', $attributes);

$attributes = array(
			"type" => "iconfonts",
			"heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "icon_name",
			'value'=>'',
			"description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN')
);
vc_add_param('vc_tab', $attributes);

$attributes =   array(
                "type" => "dropdown",
                "heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "tabs_type",
                "value" => array(
				"Type 1"=>'',
				"Type 2"=>'2',
				),
                "description" => __( "Select Tabs Type", 'WEBNUS_TEXT_DOMAIN')
);
vc_add_param('vc_tabs', $attributes);

$attributes =   array(
                "type" => "dropdown",
                "heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "tabs_type",
                "value" => array(
				"Type 1"=>'',
				"Type 2"=>'2',
				),
                "description" => __( "Select Tabs Type", 'WEBNUS_TEXT_DOMAIN')
);
vc_add_param('vc_tour', $attributes);
?>