<?php
$emp_array = array();
global $wpdb;
if(empty($wpdb)) die('WPDB not found...!');
  $emp_query = $wpdb->get_results($wpdb->prepare( 
  	"SELECT ID, post_title 
  	FROM $wpdb->posts
  	WHERE post_type = '%s' AND post_status='publish'
  	",'employee'
  ));

  if(!empty($emp_query))
  {
  	
	 foreach ( $emp_query as $emp ) {
      $emp_array[$emp->post_title] = $emp->ID;
    }
	
  }else{
  	
	$emp_array['No Employee Found'] = -1;
  }


vc_map( array(
        'name' =>'Webnus Employees',
        'base' => 'employees',
		"description" => "Employees custom posts",
        "icon" => "webnus_employees",
        'params'=>array(
					
					
					array(
							'type' => 'dropdown',
							'heading' => __( 'Columns', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'cols',
							'value'=>array('Two'=>'2', 'Three'=>'3', 'Four'=>'4'),
							'description' => __( 'Employees column type', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'checklist',
							'heading' => __( 'Employees', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'emps',
							'value'=>$emp_array,
							'description' => __( 'Select employees to add', 'WEBNUS_TEXT_DOMAIN')
					),
					

					
		),
		'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        
    ) );
?>