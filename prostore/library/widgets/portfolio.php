<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/widgets/portfolio.php
 * @file	 	1.0
 */
?>
<?php

// Widget class.
class Widget_Portfolio extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function Widget_Portfolio() {
	
		/* Widget settings. */
		$widget_ops = array( 
		    'classname' => 'widget_portfolio', 
		    'description' => __('A widget that displays your recent portfolios.', 'prostore-theme') 
		);

		/* Widget control settings. */
		$control_ops = array( 
		    'width' => 300,  'height' => 350, 'id_base' => 'widget_portfolio' 
		);

		/* Create the widget. */
		$this->WP_Widget( 'Widget_Portfolio', __('proStore - Recent Portfolios', 'prostore-theme'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		
		/* Our variables from the widget settings. */
		$number = ( isset($instance['number']) ) ? $instance['number'] : 0;
		$desc = $instance['desc'];
		
		/* Before widget (defined by themes). */
		
		echo $before_widget;
		
		/* Display Widget */
		?>
       	<?php 
       		
       		/* Display the widget title if one was input (before and after defined by themes). */
       		if ( $title )
       			echo $before_title . $title . $after_title; 
       		?>		    
		    
				    
		    
		    <div class="widget_portfolio flexslider">
		    	<ul class="slides">
			    <?php if ($desc) { ?>
	            	<p><?php echo $desc; ?></p>
	           	<?php }
           	 	
       		    $args = array(
       		        'post_type' => 'portfolio',
       		        'orderby' => 'menu_order',
       		        'order' => 'ASC',
       		        'posts_per_page' => $number
       		    );
       		    $query = new WP_Query( $args );
       		    
       			while ( $query->have_posts() ) : $query->the_post();
       			
 					//Check if post has a featured image set else get the first image from the gallery and use it. If both statements are false display fallback image. 
					if ( has_post_thumbnail() ) {
						
						//get featured image
					    $thumb = get_post_thumbnail_id();
					    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
					  
					} else {
					
						$attachments = get_children(
					        array(
					        	'post_parent' => get_the_ID(), 
					        	'post_type' => 'attachment', 
					        	'post_mime_type' => 'image', 
					        	'orderby' => 'menu_order'
					        	)
					    );
					    
					    if ( ! is_array($attachments) ) continue;
					    	$count = count($attachments);
					    	$first_attachment = array_shift($attachments);
					    
					     $img_url = wp_get_attachment_url( $first_attachment->ID,'full' ); //get full URL to image (use "large" or "medium" if the image is too big)
					
					}
					
					?>
         			<li>	
 	    		    <article class="portfolio-item text-center">
		    			<div class="post-thumb preload">
	    					<a title="<?php printf(__('Permanent Link to %s', 'prostore-theme'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
	    					<?php
								$thumb = featured_image_link_portf($post->ID);
							?>
							<img src="<?php echo $thumb; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" />
  	    					</a>
	    				</div>
 	    				<h3><a title="<?php printf(__('Permanent Link to %s', 'prostore-theme'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	    	        </article>
    	        	</li>
       		<?php endwhile; ?>	
           	<?php wp_reset_postdata(); ?>
           	</ul>
    	</div><!-- End Recent Portfolios Widget -->
	
	<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
	    $instance['desc'] = $new_instance['desc'];

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Our Recent Works.',
			'desc' => '',
			'number' => 3
 		);
 		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
 		<p><!-- Widget Title: Text Input -->
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'prostore-theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
 		
		<p><!-- Number Input: Text Input -->
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Posts to Display:', 'prostore-theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		
        <p><!-- Description Input: Text Input -->
        	<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description:', 'prostore-theme') ?></label>
        	<textarea class="widefat" rows="6" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
        </p>
	
	<?php
	}
}

register_widget( 'Widget_Portfolio' );