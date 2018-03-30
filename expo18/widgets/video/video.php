<?php

function om_widget_video_init() {
	register_widget( 'om_widget_video' );
}
add_action( 'widgets_init', 'om_widget_video_init' );

/* Widget Class */

class om_widget_video extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_video',
			__('Custom Video','om_theme'),
			array(
				'classname' => 'om_widget_video',
				'description' => __('A widget that displays your YouTube, Vimeo and etc. Video, that has embed code.', 'om_theme')
			),
			array (
				'width' => 320,
				'height' => 380
			)
		);
	}

	/* Front-end display of widget. */
		
	function widget( $args, $instance ) {
		extract( $args );
	
		$title = apply_filters('widget_title', $instance['title'] );
	
		echo $before_widget;
	
		if ( $title )
			echo $before_title . $title . $after_title;
	
		echo '<div class="video-embed">'.$instance['code'].'</div>';
	
		echo $after_widget;
	
	}


	/* Sanitize widget form values as they are saved. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['code'] = stripslashes( $new_instance['code'] );
	
		return $instance;
	}


	/* Back-end widget form. */
		 
	function form( $instance ) {
	
		// Set up some default widget settings
		$defaults = array(
			'title' => 'Video Widget',
			'code' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'om_theme') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
		<!-- Code: Textarea -->
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e('Embed code:', 'om_theme') ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" rows="12" name="<?php echo $this->get_field_name( 'code' ); ?>" ><?php echo stripslashes(htmlspecialchars($instance['code'], ENT_QUOTES)); ?></textarea>
		</p>
			
	<?php
	}
}
?>