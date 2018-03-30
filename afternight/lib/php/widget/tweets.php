<?php
    class widget_tweets extends WP_Widget {
        function widget_tweets() {
            $widget_ops = array( 'classname' => 'tweets', 'description' => 'Display Latest tweets' );
            parent::__construct( 'widget_cosmo_tweets' , _TN_ . ' : ' . __('Latest tweets','cosmotheme') , $widget_ops );

        }

        function form($instance) {
            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = null;
            }

            if( isset($instance['number']) ){
                $number = esc_attr($instance['number']);
            }else{
                $number = 10;
            }

            if( isset($instance['username']) ){
                $username = esc_attr($instance['username']);
            }else{
                $username = null;
            }
            ////////////////////
            if( isset($instance['consumerKey']) ){
                $consumerKey = esc_attr($instance['consumerKey']);
            }else{
                $consumerKey = null;
            }

            if( isset($instance['consumerSecret']) ){
                $consumerSecret = esc_attr($instance['consumerSecret']);
            }else{
                $consumerSecret = null;
            }

            if( isset($instance['accessToken']) ){
                $accessToken = esc_attr($instance['accessToken']);
            }else{
                $accessToken = null;
            }
            if( isset($instance['accessTokenSecret']) ){
                $accessTokenSecret = esc_attr($instance['accessTokenSecret']);
            }else{
                $accessTokenSecret = null;
            }

            /////////////////////
        	if( isset($instance['dynamic']) ){
                $dynamic = esc_attr( $instance['dynamic'] );
            }else{
                $dynamic = '';
            }
        ?>
         <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter User Name' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of latest tweets to show' , 'cosmotheme' ); ?>:</label>
          <input id="<?php echo $this->get_field_id( 'number' ); ?>"  size="3" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id( 'dynamic' ); ?>"><?php _e( 'Animated' , 'cosmotheme' ); ?>:</label>
        	<input type="checkbox" id="<?php echo $this->get_field_id( 'dynamic' ); ?>"  <?php checked( $dynamic , true ); ?>  name="<?php echo $this->get_field_name( 'dynamic' ); ?>"  value="1" />
        </p>

        <p>
        	<span class="hint"><?php echo sprintf(__( 'Now you need to do it to create an application in %s https://dev.twitter.com/apps %s and fill the requirements there. Once finished you will have your consumer key, consumer secret, access token and access token secret.' , 'cosmotheme' ), '<a href="https://dev.twitter.com/apps">', '</a>' ); ?></span>
        	
        </p>

		<p>
	        <label for="<?php echo $this->get_field_id( 'consumerKey' ); ?>"><?php _e( 'Consumer key' , 'cosmotheme' ); ?>:</label>
	        <input id="<?php echo $this->get_field_id( 'consumerKey' ); ?>"   name="<?php echo $this->get_field_name('consumerKey'); ?>" type="text" value="<?php echo $consumerKey; ?>" />
        </p>

		<p>
	        <label for="<?php echo $this->get_field_id( 'consumerSecret' ); ?>"><?php _e( 'Consumer secret' , 'cosmotheme' ); ?>:</label>
	        <input id="<?php echo $this->get_field_id( 'consumerSecret' ); ?>"   name="<?php echo $this->get_field_name('consumerSecret'); ?>" type="text" value="<?php echo $consumerSecret; ?>" />
        </p>

		<p>
	        <label for="<?php echo $this->get_field_id( 'accessToken' ); ?>"><?php _e( 'Access token' , 'cosmotheme' ); ?>:</label>
	        <input id="<?php echo $this->get_field_id( 'accessToken' ); ?>"   name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo $accessToken; ?>" />
        </p>

        <p>
	        <label for="<?php echo $this->get_field_id( 'accessTokenSecret' ); ?>"><?php _e( 'Access token secret' , 'cosmotheme' ); ?>:</label>
	        <input id="<?php echo $this->get_field_id( 'accessTokenSecret' ); ?>"   name="<?php echo $this->get_field_name('accessTokenSecret'); ?>" type="text" value="<?php echo $accessTokenSecret; ?>" />
        </p>

        <?php
        }

        function update( $new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags($new_instance['title']);
            $instance['number']     = strip_tags($new_instance['number']);
            $instance['username']   = strip_tags($new_instance['username']);
            $instance['dynamic']   = strip_tags($new_instance['dynamic']);

            
            $instance['consumerKey']   = strip_tags($new_instance['consumerKey']);
            $instance['consumerSecret']   = strip_tags($new_instance['consumerSecret']);
            $instance['accessToken']   = strip_tags($new_instance['accessToken']);
            $instance['accessTokenSecret']   = strip_tags($new_instance['accessTokenSecret']);
            return $instance;
        }

        function the_tweets( $username , $number, $dynamic, $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret  ){
        	$feed_classes = 'dynamic';
        	if( $dynamic != 1 ){
        		$feed_classes = 'static';
        	}

        	$feed_info = array(
        			'username' => $username, 
        			'number' => $number, 
        			'consumerKey' => $consumerKey, 
        			'consumerSecret' => $consumerSecret, 
        			'accessToken' => $accessToken, 
        			'accessTokenSecret' => $accessTokenSecret);

			echo '<div class="cosmo-twit-container ' . $feed_classes . '">';
            $tweets = self::get_tweets( $feed_info , $classes = '' , $before = "<div class='tweet_item'><p>" , $after = "</p></div>" , $static_class = $feed_classes );
            echo $tweets[0];
			echo '</div>';
            echo $tweets[1];
        }

		
		function get_tweets( $feed_info , $classes = '' , $before = "<div class='tweet_item'><p>" , $after = "</p></div>", $static_class = '' ){

			/*=====================================================================================================*/
			/*
			* JSON list of tweets using:
			*         http://dev.twitter.com/doc/get/statuses/user_timeline
			* Cached using WP transient API.
			*        http://www.problogdesign.com/wordpress/use-the-transients-api-to-list-the-latest-commenter/
			*/
			
			// Configuration.
			$numTweets = $feed_info['number'];
			$name = $feed_info['username'];
			$transName = $this -> id.'_'.$feed_info['username']; // Name of value in database.
			$cacheTime = 60; // Time in minutes between updates.
			
			// Do we already have saved tweet data? If not, lets get it.
			if(false === ($tweets = get_transient($transName) ) ||  get_transient($transName) == '') :    
			
				get_template_part('/lib/php/twitteroauth/twitteroauth');
			    
			    $twitterConnection = new TwitterOAuth(
								$feed_info['consumerKey'],	// Consumer Key
								$feed_info['consumerSecret'],   	// Consumer secret
								$feed_info['accessToken'],       // Access token
								$feed_info['accessTokenSecret']    	// Access token secret
							);

			    $twitterData = $twitterConnection->get(
								  'statuses/user_timeline',
								  array(
								    'screen_name'     => $name,
								    'count'           => $numTweets,
								    'exclude_replies' => false
								  )
								);
			    if($twitterConnection->http_code != 200){
			        $twitterData = get_transient($transName);
			    }
	

				if( !is_wp_error( $twitterData ) ) {
					// Get tweets into an array.
					//$twitterData = json_decode($json['body'], true);
					
					// Now update the array to store just what we need.
					// (Done here instead of PHP doing this for every page load)
					if( is_array($twitterData) &&	 !isset($twitterData['error']) ){   
						foreach ($twitterData as $tweet) :
							// Core info.
							if(isset( $tweet->user )){
								$name = $tweet->user->name;
								$permalink = 'http://twitter.com/#!/'. $name .'/status/'. $tweet->id_str;
								
								/* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
								$image = $tweet->user->profile_image_url;
								
								// Message. Convert links to real links.
								$pattern = '/http:(\S)+/';
								$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
								$text = preg_replace($pattern, $replace, $tweet->text);
								
								// Need to get time in Unix format.
								$time = $tweet->created_at;
								$time = date_parse($time);
								$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
								$tweet_id = $tweet->id_str;

								// Now make the new array.
								$tweets[] = array(
												'text' => $text,
												'name' => $name,
												'permalink' => $permalink,
												'image' => $image,
												'time' => $uTime,
												'id'=>	$tweet_id	
												);	
							}
							
						endforeach;
					}else{ 
						$tweets = false;
					}
					
					if(is_array($tweets) && count($tweets) > 0){
						// Save our new transient.
						set_transient($transName, $tweets, 60 * $cacheTime);
						set_transient($transName.'_old', $tweets, 1000000 * 60 * $cacheTime);	
					}
				} /*EOF !is_wp_error( $json ) */	
			endif; 
			
			/*If tweets are unavailable, we show the old version of tweets*/	  
			if(!$tweets){
				$tweets = get_transient($transName.'_old');
			}
			
			echo '<div class="cosmo_twitter">
				  <div class="slides_container">';
			// Now display the tweets.
			  
			if($tweets){ 
				foreach($tweets as $t) : ?>
					
					<?php echo $before ?>
								<i class="icon-twitter"></i> <?php echo $t['name'] . ': '. $t['text']; ?>
								<span class="tweet-time date st"><?php echo human_time_diff($t['time'], current_time('timestamp')); ?> ago</span>
							
					<?php echo $after ?>
					  
				<?php endforeach; 
			}else{
				echo $before;
				if( $feed_info['username'] == ''){
					_e('Please add the Twitter user name' , 'cosmotheme');
				}else{
					_e('Unable to read tweets !!!' , 'cosmotheme');
				}
				
				echo $after;

			}
				echo '</div>
				</div>   '; 
		}

        
        

		// Use this function to retrieve the followers count
		function followers_count($screen_name = 'cosmothemes')
		{
			$key = 'my_followers_count_' . $screen_name;

			// Let's see if we have a cached version
			$followers_count = get_transient($key);
			if ($followers_count !== false)
				return $followers_count;
			else
			{
				// If there's no cached version we ask Twitter
				$response = wp_remote_get("http://api.twitter.com/1/users/show.json?screen_name={$screen_name}");
				if (is_wp_error($response))
				{
					// In case Twitter is down we return the last successful count
					return get_option($key);
				}
				else
				{
					// If everything's okay, parse the body and json_decode it
					$json = json_decode(wp_remote_retrieve_body($response));
					$count = $json->followers_count;

					if(is_numeric($count)){   
						// Store the result in a transient, expires after 1 day
						// Also store it as the last successful using update_option
						set_transient($key, $count, 60*60); /*1 h cache*/
						update_option($key, $count);
					}
					return $count;
				}
			}
		}


        function widget($args, $instance) {
            extract( $args );
            if( !empty( $instance['title'] ) ){
               $title = trim( apply_filters('widget_title', $instance['title'] ) );
            }else{
               $title = '';
            }

            if( isset($instance['number'])){
                $number = $instance['number'];
            }else{
                $number = 10;
            }


            if( isset($instance['username'])){
                $username = $instance['username'];
            }else{
                $username = null;
            }

            if( isset($instance['consumerKey']) ){
                $consumerKey = esc_attr($instance['consumerKey']);
            }else{
                $consumerKey = null;
            }

            if( isset($instance['consumerSecret']) ){
                $consumerSecret = esc_attr($instance['consumerSecret']);
            }else{
                $consumerSecret = null;
            }

            if( isset($instance['accessToken']) ){
                $accessToken = esc_attr($instance['accessToken']);
            }else{
                $accessToken = null;
            }
            if( isset($instance['accessTokenSecret']) ){
                $accessTokenSecret = esc_attr($instance['accessTokenSecret']);
            }else{
                $accessTokenSecret = null;
            }

        	if( isset($instance['dynamic']) && $instance['dynamic'] == 1){ 
                $dynamic = $instance['dynamic']; 
            }else{
                $dynamic = 0; 
            }
            
            echo $before_widget;
  

            if ( strlen( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            
            self::the_tweets( $username , $number, $dynamic, $consumerKey, $consumerSecret, $accessToken, $accessTokenSecret );
            
            
            echo $after_widget;
        }
    }

  

?>