<?php
	
	/*
	*
	*	Custom Subscribers Widget
	*	------------------------------------------------
	*	Swift Framework v1.0
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	class sf_subscribers_widget extends WP_Widget {
		
		function sf_subscribers_widget() {
			global $themename;
			
			$widget_ops = array( 'classname' => 'subscribers-widget', 'description' => 'Show subscriber counts from Facebook and YouTube.' );
			$control_ops = array( 'width' => 250, 'height' => 200, 'id_base' => 'subscribers-widget' ); //default width = 250
			parent::__construct( 'subscribers-widget', 'Subscriber Count Widget', $widget_ops, $control_ops );
		}
	
		function form($instance) {
		$defaults = array( 'title' => 'Subscribers', 'facebook' => '', 'youtube' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
	
	?>
			
		<p>
			<label><?php _e('Title', 'swiftframework');?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label><?php _e('Facebook Page ID', 'swiftframework');?>:</label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" type="text"/>
		</p>
		
		<p>
			<label><?php _e('YouTube User ID', 'swiftframework');?>:</label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" type="text"/>
		</p>
			
	<?php	
		}
	
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['facebook'] = strip_tags( $new_instance['facebook'] );
			$instance['youtube'] = strip_tags( $new_instance['youtube'] );
			
			return $instance;
		}
		
				
		function widget($args, $instance) {
			
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if (isset($instance['facebook'])) {
			$facebook = $instance['facebook'];
			}
			if (isset($instance['youtube'])) {
			$youtube = $instance['youtube'];
			}
			$output = "";
			
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; 
			
			$output .= '<ul class="subscribers-list clearfix">';
			
			if ( $facebook ) {
				$output .= '<li>';
				$output .= '<a class="social-circle" href="http://www.facebook.com/'.$facebook.'" target="_blank"><i class="icon-facebook"></i></a>';
				$output .= '<span class="social-count">'.get_facebook_fan_count($facebook).'</span><span>'.__("Fans", "swiftframework").'</span>';
				$output .= '</li>';
			}
			
			if ( $youtube ) {
				$output .= '<li>';
				$output .= '<a class="social-circle" href="http://www.youtube.com/user/'.$youtube.'" target="_blank"><i class="icon-film"></i></a>';
				$output .= '<span class="social-count">'.get_youtube_subscriber_count($youtube).'</span><span>'.__("Subscribers", "swiftframework").'</span>';
				$output .= '</li>';
			}							
			
			$output .= '</ul>';
			echo $output;	
			echo $after_widget;
	
		}
			
	}
	
	add_action( 'widgets_init', 'sf_load_subscribers_widget' );
	
	function sf_load_subscribers_widget() {
		register_widget('sf_subscribers_widget');
	}

?>
