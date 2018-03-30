<?php
add_action('widgets_init', 'unik_twitter_func');

function unik_twitter_func(){
	register_widget('unik_twitter');
}

class unik_twitter extends WP_Widget {

	function unik_twitter()
	{
		$widget_ops = array('classname' => 'tweets', 'description' => 'Display latest tweets (Twitter API 1.1)');
		$control_ops = array('id_base' => 'tweets-widget');
		parent::__construct('tweets-widget', 'Twitter (Unik)', $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$api_key = $instance['api_key'];
		$api_secret = $instance['api_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = intval( $instance['count']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}

		if($twitter_id && $api_key && $api_secret && $access_token && $access_token_secret && $count) {
		
		$transName = 'list_tweets_'.$args['widget_id'];
		$cacheTime = 10;
		
		if(false === ($twitterData = get_transient($transName))) {

			$token = get_option('cfTwitterToken_'.$args['widget_id']);

			// get a new token 
			delete_option('cfTwitterToken_'.$args['widget_id']);

			// getting new auth bearer only if we don't have one
			if(!$token) {
				// preparing credentials
				$credentials = $api_key . ':' . $api_secret;
				$toSend = base64_encode($credentials);

				// http post arguments
				$tweet_args = array(
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
				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $tweet_args);

				$keys = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					// saving token to wp_options table
					update_option('cfTwitterToken_'.$args['widget_id'], $keys->access_token);
					$token = $keys->access_token;
				}
			}
			// we have bearer token wether we obtained it from API or from options
			$tweet_args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$twitter_id.'&count='.$count;
			$response = wp_remote_get($api_url, $tweet_args);

			set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
		}
		
		
		@$twitter = json_decode(get_transient($transName), true);
		if($twitter && is_array($twitter)) {
			//var_dump($twitter);
		?>
		<div class="twitter-box">
			<div class="twitter-holder">
				<div class="b">
					<div class="tweets-container" id="tweets_<?php echo $args['widget_id']; ?>">
						<ul id="jtwt" class="list-unstyled twitter-widget">
							<?php foreach($twitter as $tweet): ?>
							<li class="jtwt_tweet">
								<div class="twitter-left left"><i class="icon-twitter icon-2x"></i></div>
								
								<div class="twitter-right"><?php
									$latestTweet = $tweet['text'];
									$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
									$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
									echo $latestTweet;
									?>
									
									<?php
									$twitterTime = strtotime($tweet['created_at']);
									$timeAgo = $this->ago($twitterTime);
									?>
									<p><a href="http://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id_str']; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a></p>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<span class="arrow"></span>
		</div>
		<?php }}

		echo $after_widget;
	}

	function ago($time)
	{
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] ago ";
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['api_key'] = $new_instance['api_key'];
		$instance['api_secret'] = $new_instance['api_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Tweets', 'twitter_id' => '', 'count' => 3, 'api_key' => '', 'api_secret' => '', 'access_token' => '', 'access_token_secret' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('api_key'); ?>">Api Key:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('api_key'); ?>" name="<?php echo $this->get_field_name('api_key'); ?>" value="<?php echo $instance['api_key']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('api_secret'); ?>">Api Secret:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('api_secret'); ?>" name="<?php echo $this->get_field_name('api_secret'); ?>" value="<?php echo $instance['api_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>">Access Token:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>">Access Token Secret:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter ID:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Tweets:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>
		<p><a href="http://dev.twitter.com/apps">Find or Create your Twitter App</a></p>

	<?php
	}
}
