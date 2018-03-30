<?php

// Recent Posts
// ----------------------------------------------------
class BoxyWidgetRecentTweets extends BoxyWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetRecentTweets() {
		$widget_opts = array(
			'classname' => 'theme-widget-recent-tweets', // class of the <li> holder
			'description' => __( 'Displays recent tweets from a username.','espresso' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-recent-tweets', __('[espresso] Twitter Feed','espresso'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'twitter_user_desc',
				'type'=>'desc',
				'title'=>'When you enter your Twitter username, be sure to enter it <i>without</i> the "@" symbol.',
				'default'=>''
			),
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Recent Tweets','espresso')
			),
			array(
				'name'=>'twitter_user',
				'type'=>'text',
				'title'=>'Twitter Username', 
				'default'=>''
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many tweets?','espresso'), 
				'default'=>'3'
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>'Button Text (optional)', 
				'default'=>''
			),
			array(
				'name'=>'button_url',
				'type'=>'text',
				'title'=>'Button URL (optional)', 
				'default'=>''
			),
			array(
				'name'=>'new_window',
				'type'=>'set',
				'title'=>'Open button URL in a new window?', 
				'default'=>'',
				'options'=>array(true=>'Yes')
			)
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		extract($args);
		
		global $espresso_twitter_settings;
		
		if (ot_get_option('twitter_oauth_access_token') && ot_get_option('twitter_oauth_access_token_secret') && ot_get_option('twitter_consumer_key') && ot_get_option('twitter_consumer_secret')){
		
			$load = intval($instance['load']);
			$title = $instance['title'];
			$twitter_user = $instance['twitter_user'];
			$button_text = $instance['button_text'];
			$button_url = $instance['button_url'];
			$new_window = $instance['new_window'];
			
			?><div class="tweets-widget"><?php
				
				echo ($title ? $before_title.$title.$after_title : '');
				
				if ($button_url || $button_text) {
				
					?><a href="<?php echo $button_url; ?>"<?php if ($new_window){ ?>target="_blank"<?php } ?> class="widget-button"><?php echo $button_text; ?></a><?php
				
				} ?>
			
				<div class="tweets-container">
					
					<?php
					
					$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
					$getfield = '?include_entities=true&include_rts=true&screen_name='.$twitter_user.'&count='.$load;
					$requestMethod = 'GET';
					$twitter = new TwitterAPIExchange($espresso_twitter_settings);
					$tweets = $twitter->setGetfield($getfield)
					          ->buildOauth($url, $requestMethod)
					          ->performRequest();
					          
					$tweets = json_decode($tweets);
						
					if (!empty($tweets)) {
						echo '<ul>';
						foreach ($tweets as $key => $tweet) {
							
							?>
							<li>
								<span class="tweet_text"><?php echo wpautop(str_replace('&apos;', '\'', espresso_add_links($tweet->text))); ?></span>
								<span class="tweet_time"><i class="fa fa-twitter"></i>&nbsp;<?php echo boxy_relativeTime(strtotime($tweet->created_at)); ?> <?php _e('via','espresso'); ?> <a href="http://twitter.com/<?php echo $twitter_user; ?>" target="_blank">@<?php echo $twitter_user; ?></a></span>
							</li>
							<?php
															
						}
						echo '</ul>';
					}
					?>
					
				</div>
			
			</div><?php

		} else {
			
			echo '<p style="color:#dd0000;"><strong>Important:</strong> You need to enter your Twitter Settings on the Theme Options panel before you can use this widget.</p>';
			
		}
		
	}
}