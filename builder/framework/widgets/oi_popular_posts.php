<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Poppular Posts Widget For Sidebar/Footer
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your popular posts
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com

 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'OrangeIdea_load_popular_post_widgets');

function OrangeIdea_load_popular_post_widgets()
{
	register_widget('OrangeIdea_Popular_Posts_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Popular_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OrangeIdea_Popular_Posts_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_popular_post_widget', 'description' => __( 'OrangeIdea: Popular Posts', 'orangeidea' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_popular_post_widget' );

		/* Create the widget. */		
		$this->__construct( 'OrangeIdea_popular_post_widget', 'OrangeIdea: Popular Posts ', $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$number_of_posts_to_show = $instance['number_of_posts_to_show'];

	// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
	<?php
    // Loop
	$args = array( 
		'post_type' => 'post',
		'posts_per_page' => $number_of_posts_to_show,
		'orderby' => 'comment_count',
		'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );

	
	?>
	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
    	
   		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-image-gallery'); ?>
    	 <div class="oi_popular_widget_post_holder">
         	<div class="oi_popular_widget_post_image">
            	<?php if ($large_image_url[0] !='') {?>
				<a class="oi_image_link" href="<?php echo the_permalink(); ?>"><img class="img-responsive" src="<?php echo $large_image_url[0]; ?>" alt="<?php the_title(); ?>"></a>
                <?php }else{?>
                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/framework/core/images/oi_format_standard_w.png" alt="<?php the_title(); ?>" >
				<?php };?>
                
            </div>
            <div class="oi_popular_widget_post_content">
            	<div class="oi_popular_widget_post_content_date"><?php the_time( get_option( 'date_format' ) ); ?></div>
            	<h5 class="oi_blog_post_title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a></h5>
                <div class="oi_popular_widget_post_content_date"><a href="<?php echo the_permalink(); ?>"><?php comments_number( 'no responses', 'one response', '% responses' ); ?></a></div>
            </div>
         <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
	<?php endwhile;  ?> 
    <?php endif; ?>
	<?php	 		 	

	// After widget (defined by theme functions file)
	echo $after_widget;
	wp_reset_postdata();
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['number_of_posts_to_show'] = stripslashes( $new_instance['number_of_posts_to_show']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'Popular Posts' , 'orangeidea' ), 'number_of_posts_to_show' => '3' );
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>


	<!-- Number of Posts: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'number_of_posts_to_show' ); ?>"><?php _e('Number of posts to show:', 'orangeidea') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_posts_to_show' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts_to_show' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['number_of_posts_to_show'] ), ENT_QUOTES)); ?>" />
	</p>

	<?php	 		 	
	}
}
?>