<?php
/* twitter */
add_action( 'widgets_init', 'latest_tweet_widget' );
function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	function Latest_Tweets() {
		$widget_ops = array( 'classname' => 'twitter-widget'  );
		$control_ops = array( 'id_base' => 'twitter-widget' );
		parent::__construct( 'twitter-widget','Ask me - Twitter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		  = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = (int)$instance['no_of_tweets'];
		$accounts	  = esc_attr($instance['accounts']);

		echo $before_widget;
			if ( $title )
				echo $before_title.$title.$after_title;?>
	
			<div class="widget_twitter">
				<?php $consumer_key  = vpanel_options('twitter_consumer_key');
				$consumer_secret     = vpanel_options('twitter_consumer_secret');
				$access_token        = vpanel_options('twitter_access_token');
				$access_token_secret = vpanel_options('twitter_access_token_secret');
				$tweets = get_transient('vpanel_twitter_widget_'.$args["widget_id"].$accounts);
				if ($tweets == false) { 
					$tweets = vpanel_twitter_tweets($consumer_key, $consumer_secret, $access_token, $access_token_secret, $accounts, $no_of_tweets);
					set_transient('vpanel_twitter_widget_'.$args["widget_id"].$accounts, $tweets, 3600);
				}
				echo ($tweets);?>
				<div class="clearfix"></div>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$widget_id                = explode("-",$this->get_field_id("widget_id"));
		$widget_id                = $widget_id[1]."-".$widget_id[2]."-".$widget_id[3];
		$instance				  = $old_instance;
		$instance['title']		  = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		$instance['accounts']	  = strip_tags( $new_instance['accounts'] );
		delete_transient('vpanel_twitter_widget_'.$widget_id.$instance['accounts']);
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '@Follow Me' , 'no_of_tweets' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>">No of Tweets to show : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo (int)$instance['no_of_tweets']; ?>" type="text" size="3">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accounts' ); ?>">Twitter username : </label>
			<input id="<?php echo $this->get_field_id( 'accounts' ); ?>" name="<?php echo $this->get_field_name( 'accounts' ); ?>" value="<?php if (isset($instance['accounts']) && !empty($instance['accounts'])) {echo esc_attr($instance['accounts']);} ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>