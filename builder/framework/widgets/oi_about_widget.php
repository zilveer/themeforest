<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: About Widget
 	Plugin URI: http://www.orange-idea.com
 	Description: A widget thats displays your profile
 	Version: 1.0
 	Author: OrangeIdea
 	Author URI:   http://www.orange-idea.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init', 'oi_about_widget');

function oi_about_widget() {
	register_widget('OI_About_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class OI_About_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function OI_About_Widget() {
		
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'oi-about-widget',
								'description'	=> __( 'OI: About Widget', 'orangeidea' )
							);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 200,
								'height'	=> 350,
								'id_base'	=> 'oi-about-widget'
							);

		/* Create the widget. */
		$this->__construct( 'oi-about-widget', 'OrangeIdea: About Widget ', $widget_ops);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['title'] );
		$main_background = $instance['main_background'];
		$main_content = $instance['main_content'];

		$time_id = rand();

		/* Before widget (defined by themes). */
		// Before widget (defined by theme functions file)
	echo $before_widget;
	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;
		?>

		<div class="oi_about_widget">
        	<div class="oi_about_widget_bg" style="background-image:url(<?php echo  $instance['main_background']?>)">
            	<div class="oi_about_widget_avatar_holder"><?php echo get_avatar( get_the_author_meta( 'ID' ),130 );?></div>
            </div>
            <?php echo  $instance['main_content']?>
        </div>

		<?php

		// After widget (defined by theme functions file)
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	// Stripslashes for html inputs
	$instance['main_background'] = $new_instance['main_background'];
	$instance['main_content'] = $new_instance['main_content'];

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(	'title'				=> __( 'About Me' , 'orangeidea' ),
						'main_background'	=> '',
						'main_content'	=> ''
					);
	
	$instance = wp_parse_args((array) $instance, $defaults);
	?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'orangeidea') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'main_background' ); ?>"><?php _e('Backdround Image URL:', 'orangeidea') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'main_background' ); ?>" name="<?php echo $this->get_field_name( 'main_background' ); ?>" value="<?php echo $instance['main_background']; ?>" />
	</p>
    
    <p>
		<label for="<?php echo $this->get_field_id( 'main_content' ); ?>"><?php _e('Content:', 'orangeidea') ?></label>
		<textarea  style="height:200px;" type="text" class="widefat" id="<?php echo $this->get_field_id( 'main_content' ); ?>" name="<?php echo $this->get_field_name( 'main_content' ); ?>" ><?php echo $instance['main_content']; ?></textarea>
	</p>

	<?php
	}
}
?>