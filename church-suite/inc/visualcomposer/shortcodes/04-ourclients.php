<?php
$item_array = array();
global $wpdb;
if(empty($wpdb)) die('WPDB not found...!');
 $query = $wpdb->get_results($wpdb->prepare(
 "SELECT ID, post_title
 FROM $wpdb->posts
 WHERE post_type = '%s' AND post_status='publish'
 ",'client'
 ));

  if(!empty($query))
  {
  	$item_array['All'] = 0;
	 foreach ( $query as $q ) {
      $item_array[$q->post_title] = $q->ID;
    }
	
  }else{
  	
	$item_array['No Client Found'] = -1;
  }



vc_map( array(
        'name' =>'Our Clients',
        'base' => 'ourclients',
		"description" => "Our Clients",
        'category' => esc_html__( 'Webnus Shortcodes', 'webnus_framework' ),
        "icon" => "webnus_ourclients",
		'params'=>array(
					array(
							"type" => "dropdown",
							"heading" => esc_html__( "Type", 'webnus_framework' ),
							"param_name" => "type",
							"value" => array(
								"Grid"=>"1",
								"Carousel"=>"2",		
							),
							"description" => esc_html__( "OurClients Type", 'webnus_framework')
					),
					array(
							'type' => 'attach_images',
							'heading' => esc_html__( 'Clients Images', 'webnus_framework' ),
							'param_name' => 'client_images',
							'value' => '',
							'description' => esc_html__( 'OurClients Images', 'webnus_framework')
					),
					
		)
        
    ) );


?>