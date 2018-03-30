<?php
	
	/*
	*
	*	Custom Video Widget
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	class sf_video_widget extends WP_Widget {
		
		function __construct() {
			global $themename;
			
			$widget_ops = array( 'classname' => 'widget-video', 'description' => 'Embedded video from YouTube, Vimeo, etc' );
			$control_ops = array( 'width' => 250, 'height' => 200, 'id_base' => 'video-widget' ); //default width = 250
			parent::__construct( 'video-widget', 'Swift Framework Video Widget', $widget_ops, $control_ops );
		}
	
		function form($instance) {
		$defaults = array( 'title' => 'Video', 'url' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
	
	?>
			
		<p>
			<label><?php _e('Title', 'swiftframework');?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label><?php _e('Video URL', 'swiftframework');?>:</label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" class="widefat" type="text"/>
		</p>
			
	<?php	
		}
	
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['url'] = strip_tags( $new_instance['url'] );
			
			return $instance;
		}
		
		function widget($args, $instance) {
			
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			$url = $instance['url'];
			
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; 
			
			if ($url)
			global $wp_embed;
			$post_embed = $wp_embed->run_shortcode('[embed width="258" height="200"]'.$url.'[/embed]');
			echo $post_embed;
					
			echo $after_widget;
	
		}
			
	}
	
	add_action( 'widgets_init', 'sf_load_video_widget' );
	
	function sf_load_video_widget() {
		register_widget('sf_video_widget');
	}

?>
