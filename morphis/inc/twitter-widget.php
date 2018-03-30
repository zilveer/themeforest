<?php
/**
 * Plugin Name: Twitter Widget
 * Description: A widget that displays twitter feeds.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'twitter_widget' );


function twitter_widget() {
	register_widget( 'twitter_feed_widget' );
}

class twitter_feed_widget extends WP_Widget {

	function twitter_feed_widget() {
		$widget_ops = array( 'classname' => 'twitter-feed', 'description' => __('A widget that displays twitter feeds.', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter-feed' );
		
		$this->WP_Widget( 'twitter-feed', __('MORPHIS: Twitter Feed', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );		
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){				
				var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';				
				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
						action: 'morphis_action_twitter_strip_ajax',
						user_id: '<?php echo $instance['twitter_username']; ?>',
						count: <?php echo $instance['num_tweets']; ?>,
						widgetized: '1',
					},
					success: function(response) {	
						//$('#tweets-sidebar-<?php echo $instance['twitter_username'] . $args['widget_id']; ?>').append( response );
						$('#tweets-sidebar-<?php echo $instance['twitter_username'] . $args['widget_id']; ?>').append( response );
					}
				});				
			});			
		</script>
		<?php
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		printf('<div class="inner"><div id="tweets-sidebar-'. $instance['twitter_username'] . $args['widget_id'] .'"></div></div>');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['num_tweets'] = strip_tags( $new_instance['num_tweets'] );
		

		return $instance;
	}

	
	function form( $instance ) {

		
	
		//Set up some default widget settings.		
		global $NHP_Options; 
		$options_morphis = $NHP_Options->options; 

		$defaults = array( 'title' => '', 'twitter_username' => $options_morphis['twitter_username'], 'name' => 'Jan Intia', 'num_tweets' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_username' ); ?>"><?php _e('Twitter Username:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_username' ); ?>" name="<?php echo $this->get_field_name( 'twitter_username' ); ?>" value="<?php echo $instance['twitter_username']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_tweets' ); ?>"><?php _e('Number of Tweets:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_tweets' ); ?>" name="<?php echo $this->get_field_name( 'num_tweets' ); ?>" value="<?php echo $instance['num_tweets']; ?>" style="width:20%;" />
		</p>

	<?php
	}
}

?>