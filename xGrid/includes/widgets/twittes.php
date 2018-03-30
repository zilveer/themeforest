<?php

/**
 * Twitter
 */
add_action('widgets_init', 'bd_tweets_load');
function bd_tweets_load(){
	register_widget('bd_tweets_load');
}
class bd_tweets_load extends WP_Widget {
function bd_tweets_load(){
    $widget_ops = array('classname' => 'bd-tweets', 'description' => '');
    $control_ops = array('id_base' => 'bd-tweets');
    $this->WP_Widget('bd-tweets', theme_name . ' - Twitter', $widget_ops, $control_ops);
}
function widget($args, $instance){
    global $bd_data;
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $count = $instance['count'];
    $consumer_key 			= $bd_data['twitter_consumer_key'];
    $consumer_secret 		= $bd_data['twitter_consumer_secret'];
    $access_token 			= $bd_data['twitter_access_token'];
    $access_token_secret 	= $bd_data['twitter_access_token_secret'];
    $twitter_id 			= $bd_data['twitter_username'];
    echo $before_widget;
    if($title) {
        echo $before_title.'<a href="http://twitter.com/'. $twitter_id .'" target="_blank">'.$title.'</a>'.$after_title;
    }
    if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {
        $transName = 'list_tweets';
        $cacheTime = 10;
        if(false === ($twitterData = get_transient($transName))) {
            $twitterConnection = new TwitterOAuth(
                $consumer_key,
                $consumer_secret,
                $access_token,
                $access_token_secret
            );
            $twitterData = $twitterConnection->get(
                'statuses/user_timeline',
                    array(
                        'screen_name'     => $twitter_id,
                        'count'           => $count,
                        'exclude_replies' => false
                    )
            );
            if($twitterConnection->http_code != 200){
                $twitterData = get_transient($transName);
            }
            set_transient($transName, $twitterData, 60 * $cacheTime);
        }
        $twitter = get_transient($transName);
        if($twitter && is_array($twitter)) {
        ?>
            <a href="https://twitter.com/<?php echo $twitter_id ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php echo $twitter_id ?></a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <div class="clear"></div>

            <div class="bd-twitter-widget" id="tweets_<?php echo $args['widget_id']; ?>">
                <ul class="tweet_list">
                    <?php
                        foreach($twitter as $tweet):
                    ?>
                    <li class="twitter-item">
                        <p class="twitter-text">
                            <i class="icon social_icon-twitter"></i>
                            <?php
                                $latestTweet = $tweet->text;
                                $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                                $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                                echo $latestTweet;
                            ?>
                        </p>
                        <?php
                            $twitterTime = strtotime($tweet->created_at);
                            $timeAgo = $this->ago($twitterTime);
                        ?>
                        <a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a>
                    </li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </div>
        <?php
        }
    }
    echo $after_widget;
}
function ago($time){
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
function update($new_instance, $old_instance){
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = $new_instance['count'];
    delete_transient('list_tweets');
    return $instance;
}
function form($instance){
    $defaults = array('title' => __('Follow Me @' , 'bd'),'count' => 4);
    $instance = wp_parse_args((array) $instance, $defaults);
    ?>
   	<?php
		global $bd_data;
		$consumer_key 			= $bd_data['twitter_consumer_key'];
    	$consumer_secret 		= $bd_data['twitter_consumer_secret'];
    	$twitter_id 			= $bd_data['twitter_username'];
		if( empty($twitter_id) && empty($consumer_key) && empty($consumer_secret) )
			echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; color: #990000;">Error : Setup Twitter API settings Go to Theme panel > Twitter API</p>';
	?>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','bd') ?></label>
        <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of Tweets:','bd') ?></label>
        <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
    </p>
<?php
}

}