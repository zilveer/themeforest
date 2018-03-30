<?php
class Artbees_Widget_Twitter extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => 'Displays a list of twitter feeds' );
		WP_Widget::__construct( 'twitter', THEME_SLUG.' - '.'Twitter Feeds', $widget_ops );

	}


	function widget( $args, $instance ) {
		extract( $args );
		global $mk_options;
		$title = $instance['title'];
		$username = $instance['username'];
		$skin = $instance['skin'];
		$uniqid = $instance['uniqid'];
		$count = isset( $instance['count'] ) ? (int)$instance['count'] : 1;
		$consumer_key = $mk_options['twitter_consumer_key'];
		$consumer_secret = $mk_options['twitter_consumer_secret'];
		$access_token = $mk_options['twitter_access_token'];
		$access_token_secret = $mk_options['twitter_access_token_secret'];
		$uniqid = isset($uniqid) ? $uniqid : $args['widget_id'];

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

		$transName = 'mk_jupiter_tweets_'.$uniqid;

		if (false === get_transient($transName)) {

			$token = get_option('mk_twitter_token_'.$uniqid);

			delete_option('mk_twitter_token_'.$uniqid);
			

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
					update_option('mk_twitter_token_'.$uniqid, $keys->access_token);
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

			set_transient($transName, wp_remote_retrieve_body($response), HOUR_IN_SECONDS);
		}
		@$twitter = json_decode(get_transient($transName), true);


		if($twitter && is_array($twitter)) {
		?>

					<div id="tweets_<?php echo $uniqid; ?>">
						
						<ul class="mk-tweet-list <?php echo $skin; ?>">
							<?php foreach($twitter as $tweet): ?>
							<li>
								<svg class="mk-svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1664 1792"><path d="M1620 408q-67 98-162 167 1 14 1 42 0 130-38 259.5t-115.5 248.5-184.5 210.5-258 146-323 54.5q-271 0-496-145 35 4 78 4 225 0 401-138-105-2-188-64.5t-114-159.5q33 5 61 5 43 0 85-11-112-23-185.5-111.5t-73.5-205.5v-4q68 38 146 41-66-44-105-115t-39-154q0-88 44-163 121 149 294.5 238.5t371.5 99.5q-8-38-8-74 0-134 94.5-228.5t228.5-94.5q140 0 236 102 109-21 205-78-37 115-142 178 93-10 186-50z"/></svg>
								<span class="tweet-text">
								<?php
								$latestTweet = $tweet['text'];
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
								echo $latestTweet;
								?>
								</span>
								<?php
								
								$twitterTime = strtotime($tweet['created_at']);
								$timeAgo = mk_ago($twitterTime);
								?>
								<a href="http://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id_str']; ?>" class="tweet-time"><?php echo $timeAgo; ?></a>
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
		$instance['uniqid'] = $new_instance['uniqid'];
		$instance['skin'] = $new_instance['skin'];
		$instance['count'] = (int) $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
		$skin = isset( $instance['skin'] ) ? esc_attr( $instance['skin'] ) : 'light';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 1;
		$uniqid = uniqid();
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skin' ); ?>"><?php _e('Skin:', 'mk_framework'); ?></label>
			<select name="<?php echo $this->get_field_name( 'skin' ); ?>" id="<?php echo $this->get_field_id( 'skin' ); ?>" class="widefat">
				<option value="dark"<?php selected( $skin, 'dark' );?>><?php _e('For Dark Backgrounds', 'mk_framework'); ?></option>
				<option value="light"<?php selected( $skin, 'light' );?>><?php _e('For Light Backgrounds', 'mk_framework'); ?></option>
			</select>
		</p>
		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Count', 'mk_framework'); ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		<em><?php _e('First Please refer to Theme Options > Advanced > Twitter API and complete the process in order to authenticate.', 'mk_framework'); ?></em>

		<input id="<?php echo $this->get_field_id( 'uniqid' ); ?>" name="<?php echo $this->get_field_name( 'uniqid' ); ?>" type="hidden" value="<?php echo $uniqid; ?>" size="3" />
<?php

	}
}

register_widget("Artbees_Widget_Twitter");