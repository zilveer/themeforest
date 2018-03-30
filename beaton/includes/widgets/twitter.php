<?php
class wize_widget_twitter extends WP_Widget {
	
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
	
    function wize_widget_twitter() {
        $widget_opts = array(
            'classname' => 'widget_tweet',
            'description' => __('This widget displays your latest Tweets', 'wizedesign')
        );
        parent::__construct('widget-tweet', esc_html__('BEATON - Twitter', 'wizedesign'), $widget_opts);
    }
	
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
	
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        global $twitter_account, $twitter_count;
        $twitter_count   = $instance['count'];
        $twitter_account = of_get_option('twitter_account');
        $consumer_key    = of_get_option('twitter_consumer_key');
        $consumer_secret = of_get_option('twitter_consumer_secret');
        $access_token    = of_get_option('twitter_access_token');
        $access_secret   = of_get_option('twitter_access_secret');
		
        /* before widget */
        echo $before_widget;
		
        /* display title */
		
        if ($title)
            echo $before_title . $title . $after_title;
		
        /* display the widget */
		
        @require_once 'twitteroauth/twitteroauth.php';
		
        $twitterConnection = new TwitterOAuth($consumer_key, // Consumer Key
            $consumer_secret, // Consumer secret
            $access_token, // Access token
            $access_secret // Access token secret
            );
        $twitterData       = $twitterConnection->get('statuses/user_timeline', array(
            'screen_name' => $twitter_account, // Your Twitter Username
            'count' => $twitter_count, // Number of Tweets to display
            'exclude_replies' => true
        ));
        if ($twitterData && is_array($twitterData)) {

		/* display */
		
?>
    <div class="tweets_list">
		<ul>
            <?php foreach ($twitterData as $tweet): ?>
            <li>
				<span>
<?php
                $latestTweet = $tweet->text;
                $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                echo $latestTweet;
?>
				</span>
<?php
                $twitterTime = strtotime($tweet->created_at);
                $timeAgo     = ago($twitterTime);
?>
				<div class="meta"><a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a></div>
             </li>
<?php endforeach; ?>
        </ul>
    </div><!-- end .tweets_list -->
    <?php
        }
		
        /* after widget */
		
        echo $after_widget;
    }
	
    /*--------------------------------------------------*/
    /* UPDATE THE WIDGET
    /*--------------------------------------------------*/
	
    function update($new_instance, $old_instance) {
        $instance          = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }
	
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
	
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Twitter Feed',
            'count' => '3'
        ));
		
        /* display the admin form */
		
        echo '	
    <p>
		<label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html__('Title:', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
	</p>		
	<p>
		<label for="' . esc_attr($this->get_field_id('count')) . '">' . esc_html__('Number of tweets', 'wizedesign') . '</label>
		<input type="text" class="widefat" id="' . esc_attr($this->get_field_id('count')) . '" name="' . esc_attr($this->get_field_name('count')) . '" value="' . esc_attr($instance['count']) . '" />
	</p>
	<p>' . esc_html__('Please set this account', 'wizedesign') . ' <a href="' . esc_url(get_site_url()) . '/wp-admin/admin.php?page=options-framework" target="_blank">' . esc_html__('here', 'wizedesign') . '</a>.</p>
	<p>' . esc_html__('Go to "Social Accounts".', 'wizedesign') . '</p>';
    }
} 

add_action('widgets_init', create_function('', 'register_widget("wize_widget_twitter");'));

    /*--------------------------------------------------*/
    /* Format the time when displaying our latest Tweets
    /*--------------------------------------------------*/

function ago($time) {
    $periods    = array(
        "second",
        "minute",
        "hour",
        "day",
        "week",
        "month",
        "year"
    );
    $lengths    = array(
        "60",
        "60",
        "24",
        "7",
        "4.35",
        "12",
        "10"
    );
    $now        = time();
    $difference = $now - $time;
    $tense      = "ago";
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $periods[$j] .= "s";
    }
    return "$difference $periods[$j] ago ";
}