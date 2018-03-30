<?php
/**
* Description: A widget example using WPH_Widget Class.
* Version: 0.1
* Author: Matt Varone
* Author URI: http://twitter.com/sksmatt
* License: GPLv2
*
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

// Check if the custom class exists
if ( ! class_exists( 'Wish_testimonial_Widget' ) ) 
{
	// Create custom widget class extending WPH_Widget
	class Wish_testimonial_Widget extends WPH_Widget
	{
	
		function __construct()
		{
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => __( 'Wish Testimonial Widget', 'wish' ), 
				// Widget Backend Description								
				'description' => __( 'Testimonial Widget', 'wish' ), 		
			 );
		
			// Configure the widget fields
			// Example for: Title ( text ) and Amount of posts to show ( select box )
		
			// fields array
			$args['fields'] = array( 							
			
				// Title field
				array( 		
				// field name/label									
				'name' => __( 'Title', 'wish' ), 		
				// field description					
				'desc' => __( 'Enter the widget title.', 'wish' ), 
				// field id		
				'id' => 'title_testimonials', 
				// field type ( text, checkbox, textarea, select, select-group )								
				'type'=>'text', 	
				// class, rows, cols								
				'class' => 'widefat', 	
				// default value						
				'std' => __( 'Testimonials', 'wish' ), 
				
				/*
					Set the field validation type/s
					///////////////////////////////
					
					'alpha_dash'			
					Returns FALSE if the value contains anything other than alpha-numeric characters, underscores or dashes.
					
					'alpha'				
					Returns FALSE if the value contains anything other than alphabetical characters.
					
					'alpha_numeric'		
					Returns FALSE if the value contains anything other than alpha-numeric characters.
					
					'numeric'				
					Returns FALSE if the value contains anything other than numeric characters.
					
					'boolean'				
					Returns FALSE if the value contains anything other than a boolean value ( true or false ).
					
					----------
					
					You can define custom validation methods. Make sure to return a boolean ( TRUE/FALSE ).
					Example:
					
					'validate' => 'my_custom_validation', 
					
					Will call for: $this->my_custom_validation( $value_to_validate );					
					
				*/
				
				'validate' => 'alpha_dash', 
				
				/*
				
					Filter data before entering the DB
					//////////////////////////////////
					
					strip_tags ( default )
					wp_strip_all_tags
					esc_attr
					esc_url
					esc_textarea
					
				*/
				
				'filter' => 'strip_tags|esc_attr'	
				 ), 
			
				// Amount Field
				array( 
				'name' => __( 'Amount', 'wish' ), 							
				'desc' => __( 'Select how many Testimonials to show.', 'wish' ), 
				'id' => 'amount_test', 							
				'type'=>'select', 				
				// selectbox fields			
				'fields' => array( 								
						array( 
							// option name
							'name'  => __( '1 Testimonial', 'wish' ), 
							// option value			
							'value' => '1' 						
						 ), 
						array( 
							'name'  => __( '2 Testimonials', 'wish' ), 			
							'value' => '2' 					
						 ), 
						array( 
							'name'  => __( '3 Testimonials', 'wish' ), 
							'value' => '3'	
						 ),array( 
							'name'  => __( '4 Testimonials', 'wish' ), 
							'value' => '4'	
						 ),array( 
							'name'  => __( '5 Testimonials', 'wish' ), 
							'value' => '5'	
						 )
					
						// add more options
				 ), 
				'validate' => 'my_custom_validation', 
				'filter' => 'strip_tags|esc_attr', 
				 ), 
				
				// Output type checkbox
				array( 
				'name' => __( 'Output as list', 'wish' ), 							
				'desc' => __( 'Wraps posts with the <li> tag.', 'wish' ), 
				'id' => 'list', 							
				'type'=>'checkbox', 				
				// checked by default: 
				'std' => 1, // 0 or 1
				'filter' => 'strip_tags|esc_attr', 
				 ), 
			
				// add more fields
			
			 ); // fields array

			// create widget
			$this->create_widget( $args );
		}
		
		// Custom validation for this widget 
		
		function my_custom_validation( $value )
		{
			if ( strlen( $value ) > 1 )
				return false;
			else
				return true;
		}
		
		// Output function

		function widget( $args, $instance )
		{
	
			// And here do whatever you want
	
			$out  = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">'.$args['before_title'];
			$out .= $instance['title_testimonials'];
			$out .= $args['after_title'];
			// here you would get the most recent posts based on the selected amount: $instance['amount'] 
			// Then return those posts on the $out variable ready for the output
			$out .= '<div class="testimonial-content">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 

 <div class="carousel-inner">';
			$args = array(
	'posts_per_page'   => $instance['amount_test'],
	'order'            => 'DESC',
	'post_type'        => 'wish_testimonials',
	'suppress_filters' => true 
);
$testimonials = get_posts( $args );
$active = '';
foreach($testimonials as $key => $testimonial){
	setup_postdata($testimonial);
	$default_attr = array(
	'class'	=> "testimonial-media-object img-circle img-responsive",
	'title'	=> trim( strip_tags( $testimonial->post_title ) ),
);
$testimonial_avatar = get_the_post_thumbnail($testimonial->ID, 'widget_testimonial_thumb', $default_attr);
if(!$testimonial_avatar){ $testimonial_avatar = '<img class="testimonial-media-object img-circle img-responsive" src="http://placehold.it/100">'; }
	if($key==0){ $active = 'active'; }else { $active = ''; }
	$out .= '<div class="item '.$active.'">';
   $out .= '
	 <div class="thumbnail adjust1">
	  <div class="col-md-12 col-sm-12 col-xs-12">'.$testimonial_avatar.'</div>
	   <div class="col-md-12 col-sm-12 col-xs-12"> 
	   <div class="caption"> <p class="text-info lead adjust2">'.$testimonial->post_title.'</p> <p><i class="fa fa-thumbs-o-up"></i> '.$testimonial->post_content.'</p> <blockquote class="adjust2"> <p>'.get_post_meta($testimonial->ID,'wish_test_name', true).'</p> <small><cite title="Source Title"><i class="fa fa-globe"></i> '.get_post_meta($testimonial->ID,'wish_test_company', true).'</cite></small> </blockquote></div>
		 
		  
		 </div> 
		 </div>
		  </div> ';
}
wp_reset_postdata();
$out .= '</div>  </div> </div></div></div> ';
//$out .= $widget_slides;
			echo wish_filter_html($out);
		}
	
	} // class

	// Register widget
	if ( ! function_exists( 'wish_testimonial_register_widget' ) )
	{
		function wish_testimonial_register_widget()
		{
			register_widget( 'Wish_testimonial_Widget' );
			register_widget( 'Wish_rpt_Widget' );
		}
		
		add_action( 'widgets_init', 'wish_testimonial_register_widget', 1 );
	}
}