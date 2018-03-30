<?php	 		 	
/*
-----------------------------------------------------------------------------------

 	Plugin Name: Latest Posts Widget For Sidebar/Footer
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
add_action('widgets_init', 'OrangeIdea_load_latest_post_simple_widgets');

function OrangeIdea_load_latest_post_simple_widgets()
{
	register_widget('OrangeIdea_Latest_Posts_Simple_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
	class OrangeIdea_Latest_Posts_Simple_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OrangeIdea_Latest_Posts_Simple_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'OrangeIdea_latest_post_simple_widget', 'description' => __( 'OrangeIdea: Latest Posts | SIMPLE', 'orangeidea' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'OrangeIdea_latest_post_simple_widget' );

		/* Create the widget. */		
		$this->__construct( 'OrangeIdea_latest_post_simple_widget', 'OrangeIdea: Latest Posts | SIMPLE ', $widget_ops);
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
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );

	
	?>
	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
    	
   		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail'); ?>
    	 <div class="oi_popular_widget_post_holder  simple_latest_post_widget">
            <div class="oi_popular_widget_post_content">
            	<a class="title_a" href="<?php echo the_permalink(); ?>"><?php the_title(); ?> </a>
                <div class="oi_popular_widget_post_content_date"><?php the_time( get_option( 'date_format' ) ); ?> <a href="<?php echo the_permalink(); ?>"><?php comments_number( 'no responses', 'one response', '% responses' ); ?></a></div>
            </div>
         </div>
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
	$defaults = array( 'title' => __( 'Latest Posts' , 'orangeidea' ), 'number_of_posts_to_show' => '3' );
	
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