<?php
vc_map( array(
        'name' =>'Sermons Speakers',
        'base' => 'speakers',
        "icon" => "sermons",
		"description" => "Show Sermons Speakers",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
				array(
					'heading' => esc_html__('Hide Speakers with no sermons', 'webnus_framework') ,
					'param_name' => 'hide',
					'value' => array( esc_html__( 'Yes', 'webnus_framework' ) => true),
					'type' => 'checkbox',
					'std' => '',
				) ,							
			),      
		) );
?>