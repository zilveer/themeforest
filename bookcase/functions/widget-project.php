<?php

/*******************************************************
*
*	Custom Project Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_projects_widgets' );

// Register widget
function ag_projects_widgets() {
	register_widget( 'AG_Projects_Widget' );
}

// Widget class
class ag_projects_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_Projects_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_projects_widget', 'description' => __('A widget that displays a project thumbnail and lightbox.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_projects_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_projects_widget', __('Custom Project Image Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$image = $instance['image'] ;
		$thumb = $instance['thumb'];
		$desc = $instance['description'];
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
<!--Project Image Widget -->
<?php 
/* Display the widget title if one was input (before and after defined by themes). */
if ( $title ) echo $before_title . $title . $after_title;
?>

<div class="hover">
    <!--Hover Effect with Background-->
    <a href="<?php echo $image; ?>" rel="prettyPhoto"> <img src="<?php echo $thumb; ?>" alt="thumbnail" width="200"/> </a> </div>

<p><?php echo $desc; ?></p>
<!--Project Thumbnail Widget-->
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Remove HTML: */
		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['thumb'] = strip_tags( $new_instance['thumb'] );
		
		/* Allow HTML in: */
		$instance['description'] =  $new_instance['description'];
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'image' => '',
		'thumb' => '',
		'description' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<!-- Widget Title: Text Input -->
<p>
    <label for="<?php echo $this->get_field_id( 'image' ); ?>">
        <?php _e('Project Image or Video (Any Size):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'thumb' ); ?>">
        <?php _e('Project Thumbnail URL (200px x 155px):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="<?php echo $instance['thumb']; ?>" />
</p>
<hr>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Project Title:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'description' ); ?>">
        <?php _e('Description (Optional):', 'framework') ?>
    </label>
    <textarea class="widefat" rows="16" cols="20 id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $instance['description']; ?></textarea>
</p>
<hr>
<?php
	}
}
?>