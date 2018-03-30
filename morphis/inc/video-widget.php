<?php
/**
 * Plugin Name: Video Embed Widget
 * Description: A widget that embeds video from Youtube or Vimeo on the sidebar or in the footer.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'video_feed_widget' );


function video_feed_widget() {
	register_widget( 'video_widget' );
}

class video_widget extends WP_Widget {

	function video_widget() {
		$widget_ops = array( 'classname' => 'video-feed-widget', 'description' => __('A widget that displays video embed frames.', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 550, 'id_base' => 'video-feed-widget' );
		
		$this->WP_Widget( 'video-feed-widget', __('MORPHIS: Video Widget', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
		
		morphis_embed_video($args['widget_id'], $instance['embed_code']);
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );				
		$instance['embed_code'] =  $new_instance['embed_code'];		

		return $instance;
	}

	function form( $instance ) {

		//Set up some default widget settings.		
		$defaults = array( 'title' => __('Video Widget', 'morphis'), 'embed_code' => '');
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Heading Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'embed_code' ); ?>"><?php _e('Embed Code (Youtube, Vimeo):', 'morphis'); ?></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'embed_code' ); ?>" name="<?php echo $this->get_field_name( 'embed_code' ); ?>" style="width:80%;"><?php echo $instance['embed_code']; ?></textarea>
		</p>

	<?php
	}
}

?>