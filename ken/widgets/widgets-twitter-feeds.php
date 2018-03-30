<?php

/*
	TWITTER WIDGET
*/

class Artbees_Widget_Twitter extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => 'Displays a list of twitter feeds' );
		WP_Widget::__construct( 'twitter', THEME_SLUG.' - '.'Twitter Feeds', $widget_ops );


	}


	function widget( $args, $instance ) {
		extract( $args );
		global $mk_settings;
		$title = $instance['title'];
		$username = $instance['username'];
		$count = isset( $instance['count'] ) ? (int)$instance['count'] : 1;
		$consumer_key = $mk_settings['twitter-consumer-key'];
		$consumer_secret = $mk_settings['twitter-consumer-secret'];
		$access_token = $mk_settings['twitter-access-token'];
		$access_token_secret = $mk_settings['twitter-access-token-secret'];

		if ( $count < 1 ) {
			$count = 1;
		}
		if ( $count > 30 ) {
			$count = 30;
		}




		if($username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$transName = 'mk_Ken_tweets_'.$args['widget_id'];
		$cacheTime = 10;
		if(false === ($twitterData = get_transient($transName))) {

			$token = get_option('mk_twitter_token_'.$args['widget_id']);

			delete_option('mk_twitter_token_'.$args['widget_id']);
			

			if(!$token) {

				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode($credentials);

				$args = array(
					'method' => 'POST',
					'httpversion' => '1.1',
					'blocking' => true,
					'headers' => array(
						'Authorization' => 'Basic ' . $toSend,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);

				add_filter('https_ssl_verify', '__return_false');
				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

				$keys = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					update_option('mk_twitter_token_'.$args['widget_id'], $keys->access_token);
					$token = $keys->access_token;
				}
			}
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username.'&count='.$count;
			$response = wp_remote_get($api_url, $args);

			set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
		}
		@$twitter = json_decode(get_transient($transName), true);


		if($twitter && is_array($twitter)) {
		?>

					<div id="tweets_<?php echo $args['widget_id']; ?>">
						
						<ul class="mk-tweet-list">
							<?php foreach($twitter as $tweet): ?>
							<li>
								<?php
								$twitterTime = strtotime($tweet['created_at']);
								$timeAgo = mk_ago($twitterTime);
								?>
								<a href="http://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id_str']; ?>" class="tweet-time"><?php echo $timeAgo; ?></a>
								<span class="tweet-text">
								<?php
								$latestTweet = $tweet['text'];
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
								echo $latestTweet;
								?>
								</span>
								
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
		<?php 
		echo $after_widget;
		}

	}
			

	}
	

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['skin'] = $new_instance['skin'];
		$instance['count'] = (int) $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
		$skin = isset( $instance['skin'] ) ? esc_attr( $instance['skin'] ) : 'light';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Count</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		<em>First Please refer to Theme Options > Third Party API > Twitter API and complete the process in order to authenticate.</em>
<?php

	}
}
/***************************************************/
