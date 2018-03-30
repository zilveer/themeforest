<?php

vc_map( array(
        'name' =>'Webnus Distance',
        'base' => 'distance',
		"description" => "Vertical Space",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_distance",
		'params'=>array(
			array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'webnus_framework' ),
					'param_name' => 'type',
					'value' => array(
						
						'Distance 1'=>'1',
						'Distance 2'=>'2',
						'Distance 3'=>'3',
						'Distance 4'=>'4',
						'Distance 5'=>'5',
					),
					'description' => wp_kses( __( 'How much empty space would you like to add?<br><br>Distance 1 => height: 20px<br>Distance 2 => height: 40px<br>Distance 3 => height: 60px<br>Distance 4 => height: 80px<br>Distance 5 => height: 100px', 'webnus_framework'), array( 'br' => array() ) )
			),
		)
        
    ) );


?>