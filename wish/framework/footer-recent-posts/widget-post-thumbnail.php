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
if ( ! class_exists( 'Wish_rpt_Widget' ) ) 
{
	// Create custom widget class extending WPH_Widget
	class Wish_rpt_Widget extends WPH_Widget
	{
	
		function __construct()
		{
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => __( 'Wish Footer Posts Widget', 'wish' ), 
				// Widget Backend Description								
				'description' => __( 'Widget created to display small post thumbnails', 'wish' ), 		
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
				'id' => 'title_rpt', 
				// field type ( text, checkbox, textarea, select, select-group )								
				'type'=>'text', 	
				// class, rows, cols								
				'class' => 'widefat', 	
				// default value						
				'std' => __( 'Posts', 'wish' ), 
				
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
				'name' => __( 'Amount of posts', 'wish' ), 							
				'desc' => __( 'Select how many Posts to show.', 'wish' ), 
				'id' => 'amount_rpt', 							
				'type'=>'select', 				
				// selectbox fields			
				'fields' => array( 								
						array( 
							// option name
							'name'  => __( '1 Post', 'wish' ), 
							// option value			
							'value' => '1' 						
						 ), 
						array( 
							'name'  => __( '2 Posts', 'wish' ), 			
							'value' => '2' 					
						 ), 
						array( 
							'name'  => __( '3 Posts', 'wish' ), 
							'value' => '3'	
						 ),array( 
							'name'  => __( '4 Posts', 'wish' ), 
							'value' => '4'	
						 ),array( 
							'name'  => __( '5 Posts', 'wish' ), 
							'value' => '5'	
						 ),array( 
							'name'  => __( '6 Posts', 'wish' ), 
							'value' => '6'	
						 ),array( 
							'name'  => __( '7 Posts', 'wish' ), 
							'value' => '7'	
						 ),array( 
							'name'  => __( '8 Posts', 'wish' ), 
							'value' => '8'	
						 ),array( 
							'name'  => __( '9 Posts', 'wish' ), 
							'value' => '9'	
						 ),array( 
							'name'  => __( '10 Posts', 'wish' ), 
							'value' => '10'	
						 ),array( 
							'name'  => __( 'All', 'wish' ), 
							'value' => '-1'	
						 )
					
						// add more options
				 ), 
				'validate' => 'my_custom_validation', 
				'filter' => 'strip_tags|esc_attr', 
				 ), 
				
				// Output type checkbox
				
			
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

		function widget( $args, $instance1 )
		{
	
			// And here do whatever you want
	
			echo '<div class="post-rpt">'.'<div class="row"><div class="col-md-12">'.$args['before_title'].$instance1['title_rpt'].$args['after_title'].'</div></div>';
			//print_r($instance1);
			// here you would get the most recent posts based on the selected amount: $instance['amount'] 
			// Then return those posts on the $out variable ready for the output
			

	$args = array( 'numberposts' => $instance1['amount_rpt'], 'post_type' => 'post', 'order' => 'DESC', 'suppress_filters' => false );
$myposts = get_posts( $args );
$i = 0;
$anim = 200;
foreach( $myposts as $key => $post ) :	setup_postdata($post);

$i = $i+1;
if( get_post_format($post->ID)!= 'audio' && get_post_format($post->ID)!= 'video' ){ 
//$thumb_url1 = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$default_attr = array(
	'class'	=> "",
	'title'	=> trim( strip_tags( $post->post_title ) ),
);
$thumb_url1 = get_the_post_thumbnail($post->ID, 'footer_posts', $default_attr);
$title1 = wish_get_words($post->post_title);
if(get_post_format($post->ID)== 'gallery'){
	if(function_exists('rwmb_meta')){
		$slides1 = rwmb_meta( 'wish_gallery_gal', 'type=image&size=full', $post->ID );
	}else{
		$slides1 = array();
	}

	foreach ($slides1 as $key => $slide){ $ids = $slide['ID'];  break; }
	$default = array(
	'class'	=> "",
	'title'	=> trim( strip_tags( $post->post_title ) ),
);
$thumb_url1 = wp_get_attachment_image( $ids, 'footer_posts', false, $default );
	}
if(get_post_format($post->ID) == 'video'){ 
 //$thumb_url1 = wp_oembed_get(get_post_meta($post->ID, 'wish_video', true));	
	}
	$thumb_available1 = '<a href="'. esc_url( get_permalink($post->ID ) ) .'" title="'. get_post(get_post_thumbnail_id())->post_title . '"><img src="http://placehold.it/65x65" class="" alt=""></a>';
	if($thumb_url1){ $thumb_available1 = '<a href="'. esc_url( get_permalink($post->ID ) ) .'" title="'. get_post(get_post_thumbnail_id())->post_title . '">
							
								'.$thumb_url1.'</a>'; }
	$anim = $anim+100;

					
		$out1 = '<div class="row animated" data-animation="fadeInUp" data-animation-delay="'.$anim.'"><div class="col-md-12"><div class="single_post"><div class="row"><div class="col-lg-4 col-md-4 col-sm-3 col-xs-3 rpt_thumb">
							'.$thumb_available1.'</div>
							<div class="rpt_heading col-lg-8 col-md-8 col-sm-9 col-xs-9">
							'.$title1.'</div>
						</div></div></div></div>';
						echo wish_filter_html($out1);
			
			}
					 endforeach; ?>
<?php echo '</div>'; ?>
				<?php wp_reset_postdata();?>
						
						
					
				
	<!-- Related Posts Ends -->
	<?php
			
		}
	
	} // class

	// Register widget
	
}