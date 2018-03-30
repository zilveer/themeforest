<?php

function venedor_tweets_ago($time) {
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

   $now = time();

   $difference = $now - $time;
   
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if ($difference != 1) {
       $periods[$j].= "s";
   }

   return __('about', 'venedor') ." $difference $periods[$j] ". __('ago', 'venedor');
}

add_action('widgets_init', 'venedor_tweets_load_widgets');

function venedor_tweets_load_widgets() {
	register_widget('Venedor_Tweets_Widget');
}

class Venedor_Tweets_Widget extends WP_Widget {

	function Venedor_Tweets_Widget() {
		$widget_ops = array('classname' => 'twitter-tweets', 'description' => __('The most recent tweets from twitter.', 'venedor'));

		$control_ops = array('id_base' => 'tweets-widget');

        parent::__construct('tweets-widget', __('Venedor: Twitter', 'venedor'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = (int) $instance['count'];
        $row = (int) $instance['row'];
        
        if ($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count && $row) {

            echo $before_widget;

            if ($title) {
                echo $before_title.$title.$after_title;
            }

            ?>
            <div class="twitter-box">
            <?php

            $widget_id = $args['widget_id'];

            $trans_key = 'twitter_tweets_' . $widget_id . '_' . $twitter_id . '_' . $count;
            $trans_expire = 60 * 30;

            if (false === ($twitterData = get_transient($trans_key))) {

                // preparing credentials
                $credentials = $consumer_key . ':' . $consumer_secret;
                $toSend = base64_encode($credentials);

                // http post arguments
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

                $token = '';
                if($keys)
                    $token = $keys->access_token;

                    // we have bearer token wether we obtained it from API or from options
                    $args = array(
                        'httpversion' => '1.1',
                        'blocking' => true,
                        'headers' => array(
                            'Authorization' => "Bearer " . $token
                    )
                );

                add_filter('https_ssl_verify', '__return_false');
                $api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$twitter_id.'&count='.$count;
                $response = wp_remote_get($api_url, $args);

                set_transient($trans_key, wp_remote_retrieve_body($response), $trans_expire);
            }

            $twitter = json_decode(get_transient($trans_key), true);

            if ($twitter && is_array($twitter)) {
                ?>
                <div class="twitter-slider owl-carousel">
                <?php
                $i = 0;
                foreach($twitter as $tweet):
                    if (empty($tweet['text'])) continue;
                    ?>
                    <?php if ($i % $row == 0) : ?><div class="twitter-slide"><?php endif; ?>
                    <div class="twitter-tweet">
                        <p class="tweet-text">
                            <?php
                            $latestTweet = $tweet['text'];;
                            $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
                            $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
                            echo $latestTweet;
                            ?>
                        </p>
                        <?php
                        $twitterTime = strtotime($tweet['created_at']);
                        $timeAgo = venedor_tweets_ago($twitterTime);
                        ?>
                        <a target="_blank" class="tweet-date" href="http://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id_str'] ?>"><?php echo $timeAgo; ?></a>
                    </div>
                    <?php if ($i % $row == $row - 1) : ?></div><?php endif; ?>
                    <?php $i++; endforeach; ?>
                <?php if ($i % $row != 0) : ?></div><?php endif; ?>
            </div>
            <?php
            }
            ?>
            </div>
            <script type="text/javascript">
            jQuery(function($) {
                $("#<?php echo $widget_id; ?> .twitter-slider").owlCarousel({
                    pagination : false,
                    navigation : true,
                    navigationText: false,
                    singleItem: true,
                    //transitionStyle : "fade"
                    autoPlay: 5000
                });
            });
            </script>
            <?php
		    echo $after_widget;
        }
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];
        $instance['row'] = $new_instance['row'];
        
		return $instance;
	}

	function form($instance) {
		$defaults = array('title' => __('Twitter Tweets', 'venedor'), 'twitter_id' => '', 'count' => 6, 'row' => 2, 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php echo __('Consumer Key', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php echo __('Consumer Secret', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php echo __('Access Token', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php echo __('Access Token Secret', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php echo __('Twitter ID', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

        <p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php echo __('Number of Tweets', 'venedor') ?>:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id('row'); ?>"><?php echo __('Number of Rows', 'venedor') ?>:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('row'); ?>" name="<?php echo $this->get_field_name('row'); ?>" value="<?php echo $instance['row']; ?>" />
        </p>
        
        <p><strong><?php echo __('Info', 'venedor') ?>:</strong><br/><?php echo __('You can find or create <a href="http://dev.twitter.com/apps">Twitter App here</a>.', 'venedor') ?></p>

	<?php
	}
}
?>