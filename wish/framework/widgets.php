<?php
// Check if the custom class exists
if ( ! class_exists( 'MV_My_Recent_Posts_Widget' ) ) 
{
	// Create custom widget class extending WPH_Widget
	class MV_My_Recent_Posts_Widget extends WPH_Widget
	{
	
		function __construct()
		{
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => __( 'Wish Recent Posts', 'wish' ), 
				// Widget Backend Description								
				'description' => __( 'Widget to display most recent posts', 'wish' ), 		
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
				'id' => 'title', 
				// field type ( text, checkbox, textarea, select, select-group )								
				'type'=>'text', 	
				// class, rows, cols								
				'class' => 'widefat', 	
				// default value						
				'std' => __( 'Recent Posts', 'wish' ), 
				
				'validate' => 'alpha_dash', 
				
				'filter' => 'strip_tags|esc_attr'	
				 ), 
			
				// Amount Field
				array( 
				'name' => __( 'Amount', 'wish' ), 							
				'desc' => __( 'Select how many posts to show.', 'wish' ), 
				'id' => 'amount', 							
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
						 ),
						array( 
							'name'  => __( '4 Posts', 'wish' ), 
							'value' => '4'	
						 ),
						array( 
							'name'  => __( '5 Posts', 'wish' ), 
							'value' => '5'	
						 )
					
						// add more options
				 ), 
				'validate' => 'my_custom_validation', 
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
	
			/*$out  = $args['before_title'];
			$out .= $instance['title'];
			$out .= $args['after_title'];*/
				
			// here you would get the most recent posts based on the selected amount: $instance['amount'] 
			// Then return those posts on the $out variable ready for the output
			
			
			/* Related Posts Starts */
			echo '<aside class="row widget widget_wish_latest_post"><div class="related-posts">';
			echo '<div class="col-md-12">'.$args['before_title'].$instance['title'].$args['after_title'].'</div>';
			
						/*Post Starts*/
	global $post;
	 $current = $post->ID;
	$args = array( 'numberposts' => -1, 'post_type' => 'post', 'order' => 'DESC', 'suppress_filters' => false );
$myposts = get_posts( $args );
$i = 0;
$anim = 200;
foreach( $myposts as $key => $post ) :	setup_postdata($post);

$i = $i+1;
if( get_post_format($post->ID)!= 'audio' && $i <= $instance['amount'] && $current != $post->ID ){ 
//$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$default_attr = array(
	'class'	=> "img-responsive",
	'title'	=> trim( strip_tags( $post->post_title ) ),
);
$thumb_url = get_the_post_thumbnail($post->ID, 'post-sidebar-image', $default_attr);
$title = wish_get_words($post->post_title);
if(get_post_format($post->ID)== 'gallery'){

	if(function_exists('rwmb_meta')){
		$slides = rwmb_meta( 'wish_gallery_gal', 'type=image&size=full', $post->ID );
	}else{
		$slides = array();
	}

	foreach ($slides as $key => $slide){ $ids = $slide['ID'];  break; }
	$default = array(
	'class'	=> "img-responsive",
	'title'	=> trim( strip_tags( $post->post_title ) ),
);
$thumb_url = wp_get_attachment_image( $ids, 'post-sidebar-image', false, $default );
	}
if(get_post_format($post->ID) == 'video'){ 
 $thumb_url = wp_oembed_get(get_post_meta($post->ID, 'wish_video', true));	
	}
	$thumb_available = '<img src="http://placehold.it/300x450" class="img-responsive" alt="">';
	if($thumb_url){ $thumb_available = '<div class="image video">
							
								'.$thumb_url.'
								
								<div class="picture-overlay">
									<div class="icons">
										<div><span class="icon"><a href="' . esc_url( get_permalink($post->ID) ) .'"><i class="fa fa-link"></i></a></span><span class="icon"><a class="image-popup-vertical-fit" href="'. esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ) .'" title="'. get_post(get_post_thumbnail_id())->post_title . '"><i class="fa fa-search"></i></a></span></div>
									</div>
								</div>
								                           
							</div>'; }
	$anim = $anim+100;

					
		$out = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 post animated" data-animation="fadeInUp" data-animation-delay="'.$anim.'">
							'.$thumb_available.'
							<div class="date">' . get_the_time('F d, Y') . '</div>
							<h4>'.$title.'</h4>
						</div>';
						echo wish_filter_html($out);
						
					}
					 endforeach; ?>
<?php echo '</div></aside>'; ?>
				<?php wp_reset_postdata();?>
						
						
					
				
				<!-- Related Posts Ends -->
		<?php }
	
	} // class
	// Register widget
	if ( ! function_exists( 'mv_my_register_widget' ) )
	{
		function mv_my_register_widget()
		{
			register_widget( 'MV_My_Recent_Posts_Widget' );
		}
		
		add_action( 'widgets_init', 'mv_my_register_widget', 1 );
	}
}