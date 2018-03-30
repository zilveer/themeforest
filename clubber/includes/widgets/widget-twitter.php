<?php

class wz_Twitter_Widget extends WP_Widget {
    /*--------------------------------------------------*/
    /* CONSTRUCT THE WIDGET
    /*--------------------------------------------------*/
    function wz_Twitter_Widget() {
        /* Widget name and description */
        $widget_opts = array(
            'classname' => 'wz_tweet_widget',
            'description' => __('Display your latest Tweets', 'wizedesign')
        );
        parent::__construct('wz_tweet_widget', esc_html__('CLUBBER - Twitter', 'clubber'), $widget_opts);
    }
    /*--------------------------------------------------*/
    /* DISPLAY THE WIDGET
    /*--------------------------------------------------*/
    /* outputs the content of the widget
     * @args --> The array of form elements*/
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = apply_filters('widget_title', $instance['title']);
        global $wz_twitter_username, $wz_twitter_count;
        $wz_twitter_count = $instance['count'];
		$wz_twitter_consumerkey = $instance['consumerkey'];
		$wz_twitter_consumersecret = $instance['consumersecret'];
		$wz_twitter_accesstoken = $instance['accesstoken'];
		$wz_twitter_accesstokensecret = $instance['accesstokensecret'];
		$wz_twitter_username = $instance['username'];
		
        /* before widget */
        echo $before_widget;
        /* display title */
        if ($title)
            echo $before_title . $title . $after_title;
        /* display the widget */

    @require_once 'twitteroauth/twitteroauth.php';
 
    $twitterConnection = new TwitterOAuth(
        $wz_twitter_consumerkey,    // Consumer Key
        $wz_twitter_consumersecret, // Consumer secret
        $wz_twitter_accesstoken,    // Access token
        $wz_twitter_accesstokensecret   // Access token secret
        );
 
    $twitterData = $twitterConnection->get(
        'statuses/user_timeline',
          array(
            'screen_name'     => $wz_twitter_username,   // Your Twitter Username
            'count'           => $wz_twitter_count,        // Number of Tweets to display
            'exclude_replies' => true
          )
        );  
 
        if($twitterData && is_array($twitterData)) {
        ?>
            <div class="tweets_list">
                <ul>
                    <?php foreach($twitterData as $tweet): ?>
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
                        $timeAgo = ago($twitterTime);
                        ?>
                        <div class="meta"><a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date" class="no-ajax"><?php echo $timeAgo; ?></a></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
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
		$instance['consumerkey'] = strip_tags($new_instance['consumerkey']);
		$instance['consumersecret'] = strip_tags($new_instance['consumersecret']);
		$instance['accesstoken'] = strip_tags($new_instance['accesstoken']);
		$instance['accesstokensecret'] = strip_tags($new_instance['accesstokensecret']);
		$instance['username'] = strip_tags($new_instance['username']);
        return $instance;
    }
    /*--------------------------------------------------*/
    /* WIDGET ADMIN FORM
    /*--------------------------------------------------*/
    /* @instance	The array of keys and values for the widget. */
    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Twitter Feed',
            'name' => '',
            'count' => '3'
        ));
        // Display the admin form
?>
        <p>
		<label for="<?php
        echo $this->get_field_id('title');
?>"><?php
        _e('Title:', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('title');
?>" name="<?php
        echo $this->get_field_name('title');
?>" value="<?php
        echo $instance['title'];
?>" />
	</p>		
		
	<p>
		<label for="<?php
        echo $this->get_field_id('consumerkey');
?>"><?php
        _e('Consumer key', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('consumerkey');
?>" name="<?php
        echo $this->get_field_name('consumerkey');
?>" value="<?php
        echo $instance['consumerkey'];
?>" />
	</p>

	<p>
		<label for="<?php
        echo $this->get_field_id('consumersecret');
?>"><?php
        _e('Consumer secret', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('consumersecret');
?>" name="<?php
        echo $this->get_field_name('consumersecret');
?>" value="<?php
        echo $instance['consumersecret'];
?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('count');
?>"><?php
        _e('Access token', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('accesstoken');
?>" name="<?php
        echo $this->get_field_name('accesstoken');
?>" value="<?php
        echo $instance['accesstoken'];
?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('accesstokensecret');
?>"><?php
        _e('Access token secret', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('accesstokensecret');
?>" name="<?php
        echo $this->get_field_name('accesstokensecret');
?>" value="<?php
        echo $instance['accesstokensecret'];
?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('username');
?>"><?php
        _e('Username', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('username');
?>" name="<?php
        echo $this->get_field_name('username');
?>" value="<?php
        echo $instance['username'];
?>" />
	</p>
	
	<p>
		<label for="<?php
        echo $this->get_field_id('count');
?>"><?php
        _e('Number of tweets', 'wizedesign');
?></label>
		<input type="text" class="widefat" id="<?php
        echo $this->get_field_id('count');
?>" name="<?php
        echo $this->get_field_name('count');
?>" value="<?php
        echo $instance['count'];
?>" />
	</p>
	
<p>You can sign up for a API key <a href="https://dev.twitter.com/" target="_blank">here</a></small></p>
	<?php
    } // end form
} // end class
add_action('widgets_init', create_function('', 'register_widget("wz_Twitter_Widget");'));



/**
 * Format the time when displaying our latest Tweets
 */
function ago($time){
   $periods = array("second", "minute", "hour", "day", "week", "month", "year");
   $lengths = array("60","60","24","7","4.35","12","10");
 
   $now = time();
   $difference = $now - $time;
   $tense = "ago";
 
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }
 
   $difference = round($difference);
 
   if($difference != 1) {
       $periods[$j].= "s";
   }
 
   return "$difference $periods[$j] ago ";
}
 
/**
 * Display out latest Tweets using the Twitter 1.1 API
 */

?>