<?php

function om_widget_tweets_init() {
	register_widget( 'om_widget_tweets' );
}
add_action( 'widgets_init', 'om_widget_tweets_init' );

/* Widget Class */

class om_widget_tweets extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_tweets',
			__('Latest Tweets','om_theme'),
			array(
				'classname' => 'om_widget_tweets',
				'description' => __('A widget that displays your latest tweets.', 'om_theme')
			)
		);
	}
	
	function om_relative_time($time_value)
	{
	  $time_value = strtotime($time_value);
	  $delta = time() - $time_value;
	
	  if ($delta < 60) {
	    return __('less than a minute ago','om_theme');
	  } elseif($delta < 120) {
	    return __('about a minute ago','om_theme');
	  } elseif($delta < (60*60)) {
	    return (round(delta / 60)) .' '. __('minutes ago','om_theme');
	  } elseif($delta < (120*60)) {
	    return __('about an hour ago','om_theme');
	  } elseif($delta < (24*60*60)) {
	    return __('about','om_theme'). ' ' . (round($delta / 3600)) .' '. __('hours ago','om_theme');
	  } elseif($delta < (48*60*60)) {
	    return __('1 day ago','om_theme');
	  } else {
	    return (round($delta / 86400)) .' '. __('days ago','om_theme');
	  }
	}

	/* Front-end display of widget. */
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		$instance['postcount']=intval($instance['postcount']);
		
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		require_once("twitteroauth/twitteroauth.php");

		$connection = new TwitterOAuth($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
		$tweets = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$instance['username'].'&count='.$instance['postcount'].($instance['retweets']?'&include_rts=true':'').($instance['replies']?'&exclude_replies=true':''));
		if(empty($tweets->errors)) {
			$statusHTML = array();
		  for ($i=0; $i<count($tweets); $i++){
		    $username = $tweets[$i]->user->screen_name;
		    $status = $tweets[$i]->text;
		    $status=preg_replace('/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;\'">\:\s\<\>\)\]\!])/','<a href="$1" target="_blank">$1</a>',$status);
		    $status=preg_replace('/\B@([_a-z0-9]+)/i','@<a href="http://twitter.com/$1" target="_blank">$1</a>',$status);
		    $statusHTML[]='<li><div class="tweet-status">'.$status.'</div><div class="tweet-time"><a href="http://twitter.com/'.$username.'/statuses/'.$tweets[$i]->id_str.'" target="_blank">'.$this->om_relative_time($tweets[$i]->created_at).'</a></div></li>';
		  }

			?>
				<ul class="latest-tweets"><?php echo implode('',$statusHTML) ?></ul>
				<?php if($instance['follow_text']) { ?>
				<p class="twitter-follow">
					<a href="http://twitter.com/<?php echo $instance['username']; ?>" target="_blank" class="icon-twitter"><span><?php echo $instance['follow_text']; ?></span></a>
				</p>
				<?php } ?>
			<?php
		} else {
			echo '<p>'.__('An error has occured.','om_theme').'</p>';
		}
		echo $after_widget;
	}

	/* Sanitize widget form values as they are saved. */

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		$instance['follow_text'] = strip_tags( $new_instance['follow_text'] );
		$instance['retweets'] = strip_tags( $new_instance['retweets'] );
		$instance['replies'] = strip_tags( $new_instance['replies'] );
		
		$instance['consumerkey'] =  $new_instance['consumerkey'] ;
		$instance['consumersecret'] =  $new_instance['consumersecret'] ;
		$instance['accesstoken'] =  $new_instance['accesstoken'] ;
		$instance['accesstokensecret'] =  $new_instance['accesstokensecret'] ;

		return $instance;
	}
	
	/* Back-end widget form. */
	
	function form( $instance ) {

		/* Default widget settings. */
		$defaults = array(
			'title' => 'Latest Tweets',
			'username' => 'mopc007',
			'postcount' => '2',
			'follow_text' => 'Follow @mopc007',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter username e.g. mopc007', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
		<!-- Retweets: Check Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'retweets' ); ?>"><?php _e('Include retweets', 'om_theme') ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'retweets' ); ?>" name="<?php echo $this->get_field_name( 'retweets' ); ?>" value="true" <?php if( $instance['retweets'] == 'true') echo 'checked="checked"'; ?> />
		</p>
		
		<!-- Replies: Check Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'replies' ); ?>"><?php _e('Exclude replies', 'om_theme') ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'replies' ); ?>" name="<?php echo $this->get_field_name( 'replies' ); ?>" value="true" <?php if( $instance['replies'] == 'true') echo 'checked="checked"'; ?> />
		</p>
		
		<!-- Follow Text: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'follow_text' ); ?>"><?php _e('Follow Text e.g. Follow @mopc007', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'follow_text' ); ?>" name="<?php echo $this->get_field_name( 'follow_text' ); ?>" value="<?php echo $instance['follow_text']; ?>" />
		</p>

		<!--  -->
		<p>
			<b>You need to create an Application at <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a> and fill the fields below:</b>
		</p>
		
		<!-- Consumer key: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'consumerkey' ); ?>"><?php _e('OAuth Consumer key', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumerkey' ); ?>" name="<?php echo $this->get_field_name( 'consumerkey' ); ?>" value="<?php echo $instance['consumerkey']; ?>" />
		</p>		

		<!-- Consumer secret: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'consumersecret' ); ?>"><?php _e('OAuth Consumer secret', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'consumersecret' ); ?>" name="<?php echo $this->get_field_name( 'consumersecret' ); ?>" value="<?php echo $instance['consumersecret']; ?>" />
		</p>		

		<!-- Access token: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'accesstoken' ); ?>"><?php _e('Access token', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'accesstoken' ); ?>" name="<?php echo $this->get_field_name( 'accesstoken' ); ?>" value="<?php echo $instance['accesstoken']; ?>" />
		</p>		

		<!-- Access token secret: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>"><?php _e('Access token secret', 'om_theme') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>" name="<?php echo $this->get_field_name( 'accesstokensecret' ); ?>" value="<?php echo $instance['accesstokensecret']; ?>" />
		</p>		

		
	<?php
	}
}

?>