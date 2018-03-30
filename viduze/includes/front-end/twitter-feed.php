<?php
/**
 * Top 10 Twitter Widget
 *
 * Displays tweets.
 * 
 * @package Top10
 * @subpackage Widgets
 * @since Top10 1.0
 */


	
		$cache = wp_cache_get('TT_Widget_Tweets', 'widget');
    	ob_start();
		
			function print_twitter_widget( $item_xml ){ ?>
			<!--TWEET SECTION START-->
			

		  <?php
		 
			   
		  $defaults = array(
		    'title' => __('Recent Tweets', 'tt'),
			'type' => 'Standard',
			'twitter_handle' => get_option(THEME_NAME_S.'_twitter_user'),
			'consumer_key' => get_option(THEME_NAME_S.'_twitter_consumer_key'),
            'consumer_secret' =>  get_option(THEME_NAME_S.'_twitter_consumer_sec'),
            'access_token' =>  get_option(THEME_NAME_S.'_twitter_access_token'),
            'access_token_secret' =>  get_option(THEME_NAME_S.'_twitter_access_secrete'),
			'num_tweets' =>  get_option(THEME_NAME_S.'_twitter_number_item'),
		    );
		    $instance = wp_parse_args( (array) $instance, $defaults );
		
			if(empty($instance['consumer_key']) || empty($instance['consumer_secret']) || empty($instance['access_token']) || empty($instance['access_token_secret'])):
				echo __('Please configure your twitter widget.', 'tt');
			else:
			
            if ( !class_exists('TwitterOAuth') )
                require_once get_template_directory() . '/includes/front-end/twitteroauth/twitteroauth.php';

            $twitterConnection = new TwitterOAuth(
                $instance['consumer_key'],
                $instance['consumer_secret'],
                $instance['access_token'],
                $instance['access_token_secret']
            );
			
			$args['screen_name'] = $instance['twitter_handle'];
			$args['count'] = $instance['num_tweets'];

            $tweets = $twitterConnection->get(
                'statuses/user_timeline/',
                $args
            );

            if ( !$tweets || isset( $tweets->errors ) ):
				if(isset($tweets->errors) && !empty($tweets->errors)){
					foreach($tweets->errors as $error){
						echo '<p>Error: '.$error->message.'</p><br/>';
					}
				}else{
					echo '<p>Error: Connect to twitter failed.</p><br/>';
				}
			else:
			?>
            
        	<div class="tweets resize"> <i class="fa fa-twitter"></i>
             <h4><?php echo $instance['twitter_handle']; ?></h4>
            	<marquee behavior="scroll"  direction="up" scrollamount="1" width="86%">
			<?php
			foreach ( $tweets as $tweet ) {
				echo '';
				$datetime_format = apply_filters( 'displaytweets_datetime_format', "l M j \- g:ia" );
                $posted_since = apply_filters( 'displaytweets_posted_since', date_i18n( $datetime_format , strtotime( $tweet->created_at ) ) );
				
				
				if ( $link_date )
					$posted_since = "<a  href=\"https://twitter.com/{$tweet->user->screen_name}/status/{$tweet->id_str}\">{$posted_since}</a>";

				$text = preg_replace( "#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a class='tweet-link' href=\"\\2\" target=\"_blank\">\\2</a>", $tweet->text );
				$text = preg_replace( "#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $text );
				$text = preg_replace( "/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $text );
				$text = preg_replace( "/#(\w+)/", "<a href=\"http://twitter.com/search?q=%23\\1&src=hash\" target=\"_blank\">#\\1</a>", $text );
				
				echo "<p>{$text} <small class=\"tweet-date muted\">- {$posted_since}</small></p>";
				echo '';
			}
			  ?>
			 
            </marquee>
            </div>
            
		<?php endif; endif; } ?>
		
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('tt_widget_tweets', $cache, 'widget');
	
