<?php

/*

Plugin Name: YouTube
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display a YouTube video.
Version: 1.1
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'pr_widget_youtube' );

/* Function that registers our widget. */
function pr_widget_youtube() {
	register_widget( 'PR_Widget_Youtube' );
}

// Widget class.
class PR_Widget_Youtube extends WP_Widget {


	function PR_Widget_Youtube() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pr_widget_youtube', 'description' => 'Display a YouTube video.' );

		/* Create the widget. */
		$this->WP_Widget( 'pr_widget_youtube', '(C) YouTube', $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$id = $instance['id'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display name from widget settings. */
		?>        
		<div class="video-container">
        	<iframe src="http://www.youtube.com/embed/<?php echo $id ?>" frameborder="0" allowfullscreen></iframe>
		</div>
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );		

		return $instance;
	}
	
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'YouTube Video', 'id' => 'YW8p8JO2hQw');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>  
        
        <p>
        <label for="<?php echo $this->get_field_id('id'); ?>">Video ID:</label>
		<input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $instance['id']; ?>" size="14" />
        </p>
        
        
        <?php
	}
}