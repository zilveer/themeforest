<?php
$faq_array = array();
global $wpdb;
if(empty($wpdb)) die('WPDB not found...!');
  $faq_query = $wpdb->get_results($wpdb->prepare( 
  	"SELECT ID, post_title 
  	FROM $wpdb->posts
  	WHERE post_type = '%s' AND post_status='publish'
  	 ",'FAQ'
  ));

  if(!empty($faq_query))
  {
	 
	 $faq_array['All'] = 0;
  	
	 foreach ( $faq_query as $faq ) {
      $faq_array[$faq->post_title] = $faq->ID;
    }
	
  }else{
  	
	$faq_array['No FAQ Found'] = -1;
  }
//$faq_array = array('Hello'=>1, 'Bello'=>2);

vc_map( array(
        'name' =>'Webnus Faq',
        'base' => 'faq',
		"description" => "FAQ custom posts",
        "icon" => "webnus_faq",
        
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params'=>array(

					array(
							'type' => 'checklist',
							'heading' => __( 'Select FAQ', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'faq_id',
							'value' => $faq_array,
							'description' => __( 'Select FAQ to display', 'WEBNUS_TEXT_DOMAIN')
					),
					
					
		)
    ) );


?>