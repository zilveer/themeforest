<?php

/*

Plugin Name: Vimeo
Plugin URI: http://themeforest.net/user/Tauris/
Description: Display a Vimeo video.
Version: 1.1
Author: Tauris
Author URI: http://themeforest.net/user/Tauris/

*/


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'pr_widget_vimeo' );

/* Function that registers our widget. */
function pr_widget_vimeo() {
	register_widget( 'PR_Widget_Vimeo' );
}

// Widget class.
class PR_Widget_Vimeo extends WP_Widget {


	function PR_Widget_Vimeo() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'pr_widget_vimeo', 'description' => 'Display a Vimeo video.' );

		/* Create the widget. */
		$this->WP_Widget( 'pr_widget_vimeo', '(C) Vimeo', $widget_ops );
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
        	<iframe src="http://player.vimeo.com/video/<?php echo $id ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>        
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
		$defaults = array( 'title' => 'Vimeo Video', 'id' => '6686768');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>  
        
        <p>
        <label for="<?php echo $this->get_field_id('id'); ?>">Video ID:</label>
		<input id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $instance['id']; ?>" size="10" />
        </p>
        
        
        <?php
	}
}