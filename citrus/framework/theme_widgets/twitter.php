<?php 
/** My Twitter Widget
  * Objective:
  *		1.To list out the latest tweets
**/
class MY_Twitter extends WP_Widget {
	#1.constructor
	function MY_Twitter() {
		$widget_options = array("classname"=>'tweetbox', 'description'=>'To Show latest twitter tweets');
		parent::__construct(false,IAMD_THEME_NAME.__(' Twitter Widget','dt_themes'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array( 'title' => __('Latest Tweets','dt_themes'), 'count' => '3', 'username' => '',
						'exclude_replies'=>'1' , 'time'=>'1', 'display_avatar'=>'1', 'consumer_key'=>'','consumer_secret'=>'','access_token'=>'','access_token_secret'=>'') );
						
		$title = 					empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
		$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
		$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
		$access_token_secret = 		empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
		$count = 					empty($instance['count']) ? '' : strip_tags($instance['count']);
		$username = 				empty($instance['username']) ? '' : strip_tags($instance['username']);
		$exclude_replies = 			empty($instance['exclude_replies']) ? 0 : 1;
		$time = 					empty($instance['time']) ? 0 : 1;
		$display_avatar = 			empty($instance['display_avatar']) ? 0 : 1;?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" 
            type="text" value="<?php echo esc_attr($consumer_key); ?>" /></label></p>
            
        <p><label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" 
            type="text" value="<?php echo esc_attr($consumer_secret); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" 
            type="text" value="<?php echo esc_attr($access_token); ?>" /></label></p>
            
        <p><label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret:','dt_themes');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" 
            type="text" value="<?php echo esc_attr($access_token_secret); ?>" /></label></p>

        <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Enter your twitter username:','dt_themes');?>
           <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>"
            type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
            
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many entries do you want to show:','dt_themes');?>
        	<select class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>">
            <?php for($i = 1; $i <= 20; $i++):	
					$selected = ($count == $i ) ? "selected='selected'" : "";?>
	              <option <?php echo($selected);?> value="<?php echo($i);?>"><?php echo($i);?></option>
            <?php endfor;?>
            </select></label></p>
            
        <p><input type="checkbox"  id="<?php echo $this->get_field_id('exclude_replies');?>" name="<?php echo $this->get_field_name('exclude_replies');?>" 
			<?php checked($exclude_replies); ?> /> <label for="<?php echo $this->get_field_id('exclude_replies'); ?>"><?php _e('Exclude @replies','dt_themes');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo $this->get_field_id('time');?>" name="<?php echo $this->get_field_name('time');?>" 
			<?php checked($time); ?> /> <label for="<?php echo $this->get_field_id('time'); ?>"><?php _e('Show time of tweet','dt_themes');?></label></p>
            
        <p><input type="checkbox"  id="<?php echo $this->get_field_id('display_avatar');?>" name="<?php echo $this->get_field_name('display_avatar');?>" 
				<?php checked($display_avatar); ?> /> <label for="<?php echo $this->get_field_id('display_avatar'); ?>"><?php _e('Show user avatar','dt_themes');?></label></p>		
<?php
	}
	
	#3.processes & saves the twitter widget option
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = strip_tags($new_instance['consumer_key']);
		$instance['consumer_secret'] = strip_tags($new_instance['consumer_secret']);
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['exclude_replies'] = empty($new_instance['exclude_replies']) ? 0 : 1;
		$instance['time'] = empty($new_instance['time']) ? 0 : 1;
		$instance['display_avatar'] = empty($new_instance['display_avatar']) ? 0 : 1;
		return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
			$title = 			empty($instance['title']) ?	'' : strip_tags($instance['title']);
			$consumer_key = 			empty($instance['consumer_key']) ?	'' : strip_tags($instance['consumer_key']);
			$consumer_secret = 			empty($instance['consumer_secret']) ?	'' : strip_tags($instance['consumer_secret']);
			$access_token = 			empty($instance['access_token']) ?	'' : strip_tags($instance['access_token']);
			$access_token_secret = 			empty($instance['access_token_secret']) ?	'' : strip_tags($instance['access_token_secret']);
			$count = 			empty($instance['count']) ? '' : strip_tags($instance['count']);
			$username = 		empty($instance['username']) ? '' : strip_tags($instance['username']);
			$exclude_replies = 	empty($instance['exclude_replies']) ? false : true;
			$time = 			empty($instance['time']) ? false : true;
			$display_avatar = 	empty($instance['display_avatar']) ? false : true ;

		echo $before_widget;			
			
			$title = apply_filters('widget_title', $title );
			if ( !empty( $title ) ) { echo $before_title . "<a href='http://twitter.com/$username/' title='".strip_tags($title)."'>".$title ."</a>". $after_title; };
			
			#$messages = mytheme_get_tweet($count, $username, $time, $exclude_replies, $display_avatar);
			#echo $messages;
			
			if($username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 

					$transName = 'list_tweets';
					$cacheTime = 10;
			
					require_once 'twitteroauth/twitteroauth.php';
						$twitterConnection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret );
						$twitterData = $twitterConnection->get('statuses/user_timeline',array('screen_name' => $username, 'count' => $count,'exclude_replies' => $exclude_replies));
			
						 if($twitterConnection->http_code != 200) {
							 $twitterData = get_transient($transName);
						 }
			 
					set_transient($transName, $twitterData, 60 * 10);
					$twitter = get_transient($transName);
				
				echo "<ul class='tweet_list'>";
					if($twitter && is_array($twitter)) {
						foreach( $twitter as $tweet ):
	
							$latestTweet = $tweet->text;
							$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
							$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
							
							$twitterTime = strtotime($tweet->created_at);
							$twitterTime = !empty($tweet->utc_offset) ? $twitterTime+($tweet->utc_offset ) : $twitterTime;
							$timeAgo = date_i18n(  get_option('date_format'), $twitterTime ); 
							
							echo '<li class="tweet">';
							
									if( $display_avatar )
										echo '<span class="tweet-thumb"><a href="http://twitter.com/'.$username.'" title=""><img src="'.$tweet->user->profile_image_url.'" alt="" /></a></span>';
									
									echo '<span class="tweet-text avatar_'.$display_avatar.'">'.$latestTweet.'</span>';
									
									if( $time )
										echo "<span class='tweet-time'>{$timeAgo}</span> ";
								
							echo '</li>';
	
						endforeach;
					} else {
						echo '<li>'.__('No public Tweets found!','dt_themes').'</li>';
					}
				echo "</ul>";
			}
		echo $after_widget;
	}
}?>