<?php




    add_action( 'widgets_init', 'latest_tweets' );
    function latest_tweets() { return register_widget('latest_tweets'); }

class latest_tweets extends WP_Widget
{


    public function __construct()
    {
        parent::__construct(
            'twitter-widget','[ CUSTOM ] Latest Tweets ', array('description' => __('[ CUSTOM ] Latest Tweets ', 'theme2035'),)
        );
    }

    //widget output
    public function widget($args, $instance) {
        extract($args);

        echo $before_widget;

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }

        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }


        if(empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])){
            echo '<strong>Please configure your Twitter API keys</strong>' . $after_widget;
            return;
        }

        $tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
        $diff = time() - $tp_twitter_plugin_last_cache_time;
        $crt = 0;

        if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){

            if(!require_once locate_template('/inc/twitteroauth.php')){
                echo '<strong>Twitteroauth.php file is not found!</strong>' . $after_widget;
                return;
            }

            if (!function_exists('getConnectionWithAccessToken')) {
                function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret)
                {
                    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
                    return $connection;
                }
            }

            $connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
            $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');

            if(!empty($tweets->errors)){
                if($tweets->errors[0]->message == 'Invalid or expired token'){
                    echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://apps.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
                }else{
                    echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
                }
                return;
            }

            $image = $tweets[1]->user->profile_image_url;

            for($i = 0;$i <= count($tweets); $i++){
                if(!empty($tweets[$i])){
                    $tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
                    $tweets_array[$i]['text'] = $tweets[$i]->text;
                    $tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
                }
            }

            update_option('tp_twitter_plugin_tweets',serialize($tweets_array));
            update_option('tp_twitter_plugin_last_cache_time',time());

        }

        function convert_links($status,$targetBlank=true,$linkMaxLen=250){

            $target=$targetBlank ? " target=\"_blank\" " : "";


            $status = preg_replace_callback(
                "/((http:\/\/|https:\/\/)[^ )]+)/",
                function($matches,$targetBlank=true,$linkMaxLen=250) {
                    $target=$targetBlank ? " target=\"_blank\" " : "";
                    return "<a href=\"$matches[1]\" title=\"$matches[1]\" $target >$matches[1]</a>";
                },
                $status
            );

            $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
            $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);


            return $status;
        }

        function relative_time($a) {
      
            $b = strtotime("now");
            $c = strtotime($a);
            $d = $b - $c;
            $minute = 60;
            $hour = $minute * 60;
            $day = $hour * 24;
            $week = $day * 7;

            if(is_numeric($d) && $d > 0) {
                if($d < 3) return "right now";
                if($d < $minute) return floor($d) . " seconds ago";
                if($d < $minute * 2) return "about 1 minute ago";
                if($d < $hour) return floor($d / $minute) . " minutes ago";
                if($d < $hour * 2) return "about 1 hour ago";
                if($d < $day) return floor($d / $hour) . " hours ago";
                if($d > $day && $d < $day * 2) return "yesterday";
                if($d < $day * 365) return floor($d / $day) . " days ago";
                return "over a year ago";
            }
        }


        $tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
        if(!empty($tp_twitter_plugin_tweets)){

            echo '<div class="tweets-author">'; ?>
            <?php echo '</div>';
            $username = $instance['username'];
            print '<div class="tweet-list">';
            $count = '1';
            foreach($tp_twitter_plugin_tweets as $tweet){
                print '<div class="tweet-box clearfix"><div class="tweet-content">'.'<p>'.convert_links($tweet['text']).'</p><div class="time">'.relative_time($tweet['created_at']).'</div></div></div>';
                if($count == $instance['tweetsnumber']){ break; }
                $count++;
            }
            ?>
                <div class="twitter-link clearfix"><i class="fa fa-twitter"></i><a href="https://twitter.com/<?php echo esc_attr($instance['username']); ?>" class="twitter-follow-button" data-show-count="false" data-lang="en"><?php echo __('Follow me','theme2035-fm'); ?></a>
                </div>
                <?php 
            print '</div>';
        }



        echo $after_widget;
    }


    //save widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['consumerkey'] = strip_tags( $new_instance['consumerkey'] );
        $instance['consumersecret'] = strip_tags( $new_instance['consumersecret'] );
        $instance['accesstoken'] = strip_tags( $new_instance['accesstoken'] );
        $instance['accesstokensecret'] = strip_tags( $new_instance['accesstokensecret'] );
        $instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
        $instance['username'] = strip_tags( $new_instance['username'] );
        $instance['tweetsnumber'] = strip_tags( $new_instance['tweetsnumber'] );

        if($old_instance['username'] != $new_instance['username']){
            delete_option('tp_twitter_plugin_last_cache_time');
        }

        return $instance;
    }


    //widget settings form
    public function form($instance) {
        $defaults = array( 
            'title' => 'Latest Tweets', 
            'consumerkey' => '', 
            'consumersecret' => '', 
            'accesstoken' => '', 
            'accesstokensecret' => '', 
            'cachetime' => '60', 
            'username' => '', 
            'tweetsnumber' => '3' 
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __('Title:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
        </p>
          
        <p>
        <label for="<?php echo $this->get_field_id( 'consumerkey' ); ?>"><?php echo __('Twitter Application API Key: <a href="https://apps.twitter.com/">apps.twitter.com</a> ', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumerkey' ); ?>" name="<?php echo $this->get_field_name( 'consumerkey' ); ?>" value="<?php echo $instance['consumerkey']; ?>"  />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'consumersecret' ); ?>"><?php echo __('Twitter Application API Secret:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'consumersecret' ); ?>" name="<?php echo $this->get_field_name( 'consumersecret' ); ?>" value="<?php echo $instance['consumersecret']; ?>"  />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'accesstoken' ); ?>"><?php echo __('Account Access Token:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'accesstoken' ); ?>" name="<?php echo $this->get_field_name( 'accesstoken' ); ?>" value="<?php echo $instance['accesstoken']; ?>"  />
        </p>
          
        <p>
        <label for="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>"><?php echo __('Account Access Token Secret   :', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>" name="<?php echo $this->get_field_name( 'accesstokensecret' ); ?>" value="<?php echo $instance['accesstokensecret']; ?>"  />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'cachetime' ); ?>"><?php echo __('Cache Duration:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'cachetime' ); ?>" name="<?php echo $this->get_field_name( 'cachetime' ); ?>" value="<?php echo $instance['cachetime']; ?>"  />
        </p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php echo __('Twitter Feed Screen Name*:', 'theme2035'); ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>"  />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id( 'tweetsnumber' ); ?>"><?php echo __('Tweet Numbers to show:', 'theme2035'); ?></label>
        <?php echo '<p><label>Tweets to display:</label>
                    <select type="text" name="'.$this->get_field_name( 'tweetsnumber' ).'" id="'.$this->get_field_id( 'tweetsnumber' ).'">';
        $i = 1;
        for(i; $i <= 10; $i++){
            echo '<option value="'.$i.'"'; if($instance['tweetsnumber'] == $i){ echo ' selected="selected"'; } echo '>'.$i.'</option>';
        }
        echo '
                    </select></p>';
    }
}
