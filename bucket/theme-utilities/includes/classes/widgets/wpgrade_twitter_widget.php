<?php

class wpgrade_twitter_widget extends WP_Widget {

	public function __construct()
	{

		parent::__construct( 'wpgrade_twitter_widget', wpgrade::themename().' '.__('Twitter Widget','bucket'), array('description' => __('Display Latest Tweets', 'bucket')) );
	}

	function widget($args, $instance) {

		extract( $args );

		$username 	=isset( $instance['username'] ) ? $instance['username'] : 'pixelgrade'; // $instance['username'];

		echo $before_widget;
		if ( isset($instance['title']) && $instance['title'] != '') echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
		$nr_per_slide = isset( $instance['nr_per_slide'] ) ? absint( $instance['nr_per_slide'] ) : 1;
		include_once( wpgrade::themefilepath('theme-utilities/includes/vendor/twitter-api/StormTwitter.class.php') );

		$config['key'] = wpgrade::option('twitter_consumer_key');
		$config['secret'] = wpgrade::option('twitter_consumer_secret');
		$config['token'] = wpgrade::option('twitter_oauth_access_token');
		$config['token_secret'] = wpgrade::option('twitter_oauth_access_token_secret');
		$config['screenname'] = $username;
		if ( isset($config['cache_expire']) && $config['cache_expire'] < 1) $config['cache_expire'] = 3600;
//		$config['directory'] = plugin_dir_path(__FILE__) . 'vendor/twitter-api/cache';
		$config['directory'] = wpgrade::themefilepath('theme-utilities/includes/vendor/twitter-api/cache');

		$twitter = new StormTwitter($config);
		$results = $twitter->getTweets($count, $username);
		if (!isset($results['error'])) {

			$link = 'https://twitter.com/'. $username;
			$slide_count = 1;
			$tweets_nr = count($results);
			if ( $results ){
				echo '<div class="wp-slider widget-content"><ul class="widget-tweets__list pixslider js-pixslider nav cf" data-bullets data-slidesspacing="24" data-autoheight><li class="widget-tweets__tweet">';
				foreach ($results as $key => $result) { ?>
					<div class="tweet__block">
					<div class="tweet__content"><?php echo $this->get_parsed_tweet($result); ?></div>
					<?php
					echo
						'<div class="tweet__meta">' .
						//'<span class="twitter-screenname">' . ucwords($config['screenname']) . '</span>' .
						'<span class="tweet__meta-username"><a href="'.$link.'">@' . $config['screenname'] . '</a></span>';
					if ( isset( $result["created_at"] ) ) {
						echo '<span class="tweet__meta-date">' . $this->wpgrade_convert_twitter_date($result["created_at"]) . '</span></div></div>';
					}

					if ( $slide_count == $tweets_nr ){
						echo '</li>';
					} elseif ( $slide_count % $nr_per_slide == 0 ) {
						echo '</li><li class="widget-tweets__tweet">';
					}
					$slide_count++;
				}
				echo '</ul></div>';
			}
		} else {
			echo '<div class="wp-slider widget-content">'.$results['error'].'</div>';
		}
		echo $after_widget;
	}

	/**
	 * Validate and update widget options.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['count'] = absint( $new_instance['count'] );
		$instance['nr_per_slide'] = absint( $new_instance['nr_per_slide'] );
		return $instance;
	}

	function form($instance) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Tweets','bucket');
		$username = isset ($instance['username']) ? esc_attr($instance['username']) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 5;
		$nr_per_slide = isset( $instance['nr_per_slide'] ) ? absint( $instance['nr_per_slide'] ) : 1;?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'bucket'); ?>:</label>
			<input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter username', 'bucket'); ?>:</label>
			<input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of tweets','bucket'); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $count ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'nr_per_slide' ); ?>"><?php _e( 'Number of tweets per slide','bucket'); ?>:</label><br />
			<input type="number" min="1" max="20" value="<?php echo esc_attr( $nr_per_slide ); ?>" id="<?php echo $this->get_field_id( 'nr_per_slide' ); ?>" name="<?php echo $this->get_field_name( 'nr_per_slide' ); ?>" />
		</p>
	<?php
	}

	function get_parsed_tweet ($tweet) {
		// check if any entites exist and if so, replace then with hyperlinked versions

		if ( !isset($tweet['text']) ) return;

		$tweet_text = $tweet['text'];
		if (!empty($tweet['entities']['urls']) || !empty($tweet['entities']['hashtags']) || !empty($tweet['entities']['user_mentions'])) {
			foreach ($tweet['entities']['urls'] as $url) {
				$find = $url['url'];
				$replace = '<a href="'.$find.'" target="_blank" rel="nofollow">'.$find.'</a>';
				$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet['entities']['hashtags'] as $hashtag) {
				$find = '#'.$hashtag['text'];
				$replace = '<a href="http://twitter.com/#!/search/%23'.$hashtag['text'].'" target="_blank" rel="nofollow">'.$find.'</a>';
				$tweet_text = str_replace($find,$replace,$tweet_text);
			}

			foreach ($tweet['entities']['user_mentions'] as $user_mention) {
				$find = "@".$user_mention['screen_name'];
				$replace = '<a href="http://twitter.com/'.$user_mention['screen_name'].'" target="_blank" rel="nofollow">'.$find.'</a>';
				$tweet_text = str_ireplace($find,$replace,$tweet_text);
			}
		} else {
			//lets try some other way to properly autolink and shit the tweet text
			include_once( wpgrade::themefilepath('theme-utilities/includes/vendor/twitter-api/Autolink.php') );
			$autolinker = new Twitter_Autolink($tweet_text);

			$tweet_text = $autolinker->addLinks();
		}

		return $tweet_text;
	}

	function wpgrade_convert_twitter_date( $time ) {
		$date = strtotime( $time );
		//return util::human_time_diff($date);
		return $this->gbs_relative_time($date);
	}


	/**
	 * Format timestamp into relative date, with proper i18n
	 */
	function gbs_relative_time( $timestamp ){

		$difference = current_time( 'timestamp' ) - $timestamp;

		if ( $difference >= 60*60*24*365 ){        // if more than a year ago
			$int = intval( $difference / ( 60*60*24*365 ) );
			$r = sprintf( _n( '%d year ago', '%d years ago', $int, 'bucket' ), $int );
		} elseif ( $difference >= 60*60*24*7*5 ){  // if more than five weeks ago
			$int = intval( $difference / ( 60*60*24*30 ) );
			$r = sprintf( _n( '%d month ago', '%d months ago', $int, 'bucket' ), $int );
		} elseif ( $difference >= 60*60*24*7 ){        // if more than a week ago
			$int = intval( $difference / ( 60*60*24*7 ) );
			$r = sprintf( _n( '%d week ago', '%d weeks ago', $int, 'bucket' ), $int );
		} elseif ( $difference >= 60*60*24){      // if more than a day ago
			$int = intval( $difference / ( 60*60*24 ) );
			$r = sprintf( _n( '%d day ago', '%d days ago', $int, 'bucket' ), $int );
		} elseif ( $difference >= 60*60 ){         // if more than an hour ago
			$int = intval( $difference / ( 60*60 ) );
			$r = sprintf( _n( '%d hour ago', '%d hours ago', $int, 'bucket' ), $int );
		} elseif ( $difference >= 60 ){            // if more than a minute ago
			$int = intval( $difference / ( 60 ) );
			$r = sprintf( _n( '%d minute ago', '%d minutes ago', $int, 'bucket' ), $int );
		} else {                                // if less than a minute ago
			$r = __( 'moments ago', 'bucket' );
		}

		return $r;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("wpgrade_twitter_widget");'));
