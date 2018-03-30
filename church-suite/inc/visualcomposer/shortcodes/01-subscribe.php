<?php
vc_map( array(
        'name' =>'Webnus Subscribe',
        'base' => 'subscribe',
        "icon" => "subscribe",
		"description" => "Subscribe box",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Boxed"=>"boxed",
								"Bar"=>"bar1",
								"Flat"=>"flat",
							),
							"description" => esc_html__( "Select style type", 'webnus_framework')
						),
						array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'webnus_framework' ),
								'param_name' => 'box_title',
								'value'=>'',
								'description' => esc_html__( 'Subscribe title', 'webnus_framework'),
						),							
					
					    array(
							"type"=>'textarea',
							"param_name"=> "box_text",
							"heading"=>esc_html__('Subscribe Text', 'webnus_framework'),
							"value"=>"",
							"description" => esc_html__( "Subscribe content", 'webnus_framework')	
						),
						
						array(
							"type" => "dropdown",
							'heading' => esc_html__( 'Email Service', 'webnus_framework' ),
							'param_name' => 'service',
							"value" => array(
								"FeedBurner"=>"FeedBurner",
								"MailChimp"=>"MailChimp",
							),
							'description' => esc_html__( 'FeedBurner or MailChimp', 'webnus_framework')
						), 
						
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'FeedBurner ID', 'webnus_framework' ),
							'param_name' => 'feedburner_id',
							'value'=>'',
							'description' => esc_html__( 'Feedburner ID', 'webnus_framework'),
							"dependency" => array('element'=>'service','value'=>array('FeedBurner')),
						),	
					
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'MailChimp URL', 'webnus_framework' ),
							'param_name' => 'mailchimp_url',
							'value'=>'',
							'description' => esc_html__( 'Mailchimp form action URL', 'webnus_framework'),
							"dependency" => array('element'=>'service','value'=>array('MailChimp')),
						),	

						
						
					),    
		) );
?>