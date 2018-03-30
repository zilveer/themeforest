<?php

/*******************************************************
*
*	Custom Divider Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_divider_widgets' );

// Register widget
function ag_divider_widgets() {
	register_widget( 'AG_Divider_Widget' );
}

// Widget class
class ag_divider_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_Divider_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_divider_widget', 'description' => __('A widget that displays a divider with optional titling.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_divider_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_divider_widget', __('-----Custom Divider Widget-----', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$divtitle = $instance['divtitle'] ;
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
<?php if($divtitle != '') : ?>
<h4><?php echo $divtitle ?></h4>
<?php endif; ?>
	<!--Titled Divider Widget -->
	<div class="divider">
     <?php if($title != '') : ?>
     <h5><span><?php echo $title; ?></span></h5>
     <?php endif; ?>
     </div>
	<!--Titled Divider Widget-->
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
		$instance['divtitle'] = strip_tags( $new_instance['divtitle'] );
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'divtitle' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<!-- Widget Title: Text Input -->
<p>
    <label for="<?php echo $this->get_field_id( 'divtitle' ); ?>">
        <?php _e('Heading Above Divider (Optional)', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'divtitle' ); ?>" name="<?php echo $this->get_field_name( 'divtitle' ); ?>" value="<?php echo $instance['divtitle']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Divider Titling (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<?php
	}
}
?>