<?php
$work_array = array();
global $wpdb;
if(empty($wpdb)) die('WPDB not found...!');
  $work_query = $wpdb->get_results($wpdb->prepare(
  	"SELECT ID, post_title 
  	FROM $wpdb->posts
  	WHERE post_type = '%s' AND post_status='publish'
  	",'portfolio'
  ));
 
  if(!empty($work_query))
  {
  	$work_array['All'] = 0;
	 foreach ( $work_query as $work ) {
      $work_array[$work->post_title] = $work->ID;
    }
	
  }else{
  	
	$work_array['No Portfolio Found'] = -1;
  }
vc_map( array(
        'name' =>'Webnus RecentWorks',
        'base' => 'recentworks',
         "icon" => "webnus_recentworks",
        "description" => "Portfolio",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params'=>array(

						array(
							"type" => "textfield",
							"heading" => __( "Posts count", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "count",
							"value" => '8',
							"description" => __( "Webnus portfolio", 'WEBNUS_TEXT_DOMAIN')
						),					
						array(
							'type' => 'dropdown',
							'heading' => __( 'Columns', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'cols',
							'value' => array('2 Columns'=>'2','3 Columns'=>'3','4 Columns'=>'4','5 Columns'=>'5','6 Columns'=>'6'),
							'std'=>'4',
							'description' => __( 'Contact form type', 'WEBNUS_TEXT_DOMAIN')
						),				
						array(
							'type' => 'checkbox',
							'heading' => __( 'Hide Filters', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'hfilters',
							'value' => array( __( 'Yes, plese', 'js_composer' ) => 'yes' ),
							'description' => __( 'Hide categories', 'WEBNUS_TEXT_DOMAIN')
						),																	
						array(
							'type' => 'checkbox',
							'heading' => __( 'Is full width?', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'full',
							'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),		
							'description' => __( 'Portfolio layout(Full-width or Boxed)', 'WEBNUS_TEXT_DOMAIN')
						),											
						array(
							'type' => 'checkbox',
							'heading' => __( 'Space between columns', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'space',
							'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
							
							'description' => __( 'Has space between columns?', 'WEBNUS_TEXT_DOMAIN')
						),	
		)
    ) );


?>