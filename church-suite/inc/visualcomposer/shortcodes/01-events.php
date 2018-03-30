<?php
vc_map( array(
        'name' =>'Webnus Events',
        'base' => 'events',
        "icon" => "events",
		"description" => "Show Upcoming Events",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"List"=>"list",
								"List 2"=>"list2",
								"Cover"=>"cover",
								"Grid"=>"grid",
								"Modern"=>"modern",
								"Clean"=>"clean",
								"Minimal"=>"minimal",
							),
							"description" => esc_html__( "You can choose among these pre-designed types.", 'webnus_framework')
						),
						array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Post Count', 'webnus_framework' ),
						'param_name' => 'count',
						'value' => '',
						'std' => '6',
						'description' => esc_html__( 'Number of event(s) to show. Note: When you type nothing it puts for default 6 events to show.', 'webnus_framework')
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'webnus_framework' ),
							'param_name' => 'category',
							'value' => '',
							'description' => wp_kses( __('Type category ID or leave blank to show all categories.<br>Note: Pick up the ID & fallow this instruction: admin panel > events > ID column.','webnus_framework'), array( 'br' => array() ) )
						),		
						array(
							'heading' => esc_html__('Just Upcoming?', 'webnus_framework') ,
							'description' => esc_html__('Check this for show only upcoming event(s). To show all events, uncheck this.', 'webnus_framework'),
							'param_name' => 'upcoming',
							'value' => array( esc_html__( 'Just Show Upcoming Events', 'webnus_framework' ) => 'enable'),
							'type' => 'checkbox',
							'std' => 'enable',
						) ,
					
						
					),      
		) );
?>