<?php

vc_map( array(
        'name' =>'Webnus Countdown',
        'base' => 'countdown',
        "icon" => "icon-wpb-countdown",
		"description" => "Countdown",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => __( 'Type', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'type',
							'value' => array(
								"Rose"=>"rose",
								"Jasmine"=>"jasmine",
								"Violet"=>"violet",
							),
							'description' => __( 'Select Countdown Type', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Date and Time', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'datetime',
							'value' => '',
							'description' => __( 'Enter date and time (11October 2015 9:00)', 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Finished text', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'done',
							'value' => '',
							'description' => __( 'Finished text', 'WEBNUS_TEXT_DOMAIN')
						),
						
        ),
        
    ) );

?>