<?php
vc_map( array(
    'name' =>'Webnus GoogleMap',
    'base' => 'gmap',
	'description' => 'Google map',
    'icon' => 'webnus_map',
	'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    'params'=>array(
			array(
				'heading' => __('Address (optional)', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Please enter your desired address to be show on the map unless you\'ve used the Latitude and Longitude options.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'address',
				'type' => 'textfield',
			) ,
			array(
				'heading' => __('Latitude', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('This option is not necessary if an address is set.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'latitude',
				'type' => 'textfield',
			) ,
			array(
				'heading' => __('Longitude', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('This option is not necessary if an address is set.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'longitude',
				'type' => 'textfield',
			) ,
			array(
				'heading' => __('Zoom', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Default map zoom level. (1-19)<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'zoom',
				'std' => '17',
				'type' => 'textfield'
			) ,
			array(
				'heading' => __('Marker', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Enable an arrow pointing at the address.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'marker',
				'value' => array( __( 'Enable', 'WEBNUS_TEXT_DOMAIN' ) => 'enable'),
				'type' => 'checkbox',
				'std' => 'enable',
			) ,
			array(
				'heading' => __('Popup Marker Content', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Content to be shown in a popup above the marker.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'html',
				'type' => 'textarea',
			) ,
			array(
				'heading' => __('Popup Marker Display', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Enable to open the popup above the marker by default.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'),
				'param_name' => 'popup',
				'value' => array( __( 'Enable', 'WEBNUS_TEXT_DOMAIN' ) => 'enable' ),
				'type' => 'checkbox'
			) ,
			array(
				'heading' => __('Controls (optional)', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => sprintf(__('This option is proper for advanced users only. Please refer to the <a href="%s" title="Google Maps API documentation">API documentation</a> for details.<br/><br/>', 'WEBNUS_TEXT_DOMAIN'), 'https://developers.google.com/maps/documentation/javascript/controls'),
				'param_name' => 'controls',
				'type' => 'textarea',
			) ,
			array(
				'heading' => __('Scrollwheel', 'WEBNUS_TEXT_DOMAIN') ,
				'param_name' => 'scrollwheel',
				'description' => __('<br/>', 'WEBNUS_TEXT_DOMAIN') ,
				'value' => array( __( 'Enable', 'WEBNUS_TEXT_DOMAIN' ) => 'enable' ),
				'type' => 'checkbox'
			) ,
			array(
				'heading' => __('MapType', 'WEBNUS_TEXT_DOMAIN') ,
				'param_name' => 'maptype',
				'description' => __('<br/>', 'WEBNUS_TEXT_DOMAIN') ,
				'std' => 'ROADMAP',
				"value" => array(
				"Default road map"=>'ROADMAP',
				"Google Earth satellite"=>'SATELLITE',
				"Mixture of normal and satellite"=>'HYBRID',
				"Physical map"=>'TERRAIN',
				),
				'type' => 'dropdown',
			) ,

			array(
				"type"=>'colorpicker',
				"heading"=>__('Hue (optional)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "hue",
				"description" => __('Defines the overall hue for the map.<br/><br/>', 'WEBNUS_TEXT_DOMAIN')
			),
			array(
				'heading' => __('Width (optional)', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Set to 0 is the full width. (0-960)<br/><br/>', 'WEBNUS_TEXT_DOMAIN') ,
				'param_name' => 'width',
				'std' => '0',
				'type' => 'textfield'
			) ,	
			
			array(
				'heading' => __('Height', 'WEBNUS_TEXT_DOMAIN') ,
				'description' => __('Default is 400.<br/><br/>', 'WEBNUS_TEXT_DOMAIN') ,
				'param_name' => 'height',
				'std' => '400',
				'type' => 'textfield'
				
			) ,
		),
        
    ) );
?>