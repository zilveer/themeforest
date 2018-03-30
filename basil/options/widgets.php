<?php

/* Register the widgets */
function boxy_load_widgets() {
	register_widget('BoxyWidgetRecentTweets');
	register_widget('BoxyWidgetFacebookFeed');
}
add_action('widgets_init', 'boxy_load_widgets');




// Twitter Feed
// ----------------------------------------------------
class BoxyWidgetRecentTweets extends BoxyWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetRecentTweets() {
		$widget_opts = array(
			'classname' => 'theme-widget-recent-tweets', // class of the <li> holder
			'description' => __( 'Displays recent tweets from a username.','basil' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-recent-tweets', __('BASIL &mdash; Twitter Feed','basil'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Recent Tweets','basil')
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
				'title'=>__('How many tweets?','basil'), 
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
		
		if (ot_get_option('twitter_oauth_access_token') && ot_get_option('twitter_oauth_access_token_secret') && ot_get_option('twitter_consumer_key') && ot_get_option('twitter_consumer_secret')){
		
			$load = intval($instance['load']);
			$title = '<i class="fa fa-twitter-square"></i>&nbsp;&nbsp;'.$instance['title'];
			$twitter_user = $instance['twitter_user'];
			$button_text = $instance['button_text'];
			$button_url = $instance['button_url'];
			$new_window = $instance['new_window'];
			
			?><div class="tweets-widget"><?php
				
				echo ($title ? $before_title.$title.$after_title : '');
				
				if ($button_url || $button_text) {
				
					?><a href="<?php echo $button_url; ?>"<?php if ($new_window){ ?>target="_blank"<?php } ?> class="widget-button bgColor-1"><?php echo $button_text; ?></a><?php
				
				} ?>
			
				<div class="tweets-container">
					
					<?php
					$twitter_helper = new TwitterHelper($twitter_user);
					$tweets = $twitter_helper->get_tweets($twitter_user, $load);
					if (empty($tweets)) {
						return;
					}
					
					if (!empty($tweets)) {
						echo '<ul>';
						foreach ($tweets as $tweet) {
						
							?>
							<li>
								<span class="tweet_text"><?php echo preg_replace('~' . preg_quote($instance['twitter_user'], '~') . ': ~iu', '', $tweet->tweet_text); ?></span>
								<span class="tweet_time"><a target="_blank" href="<?php echo $tweet->tweet_link; ?>"><?php _e('Posted','basil'); ?> <?php echo ucfirst(boxy_relativeTime($tweet->created_at)); ?> &mdash; <?php _e('View on Twitter','basil'); ?></a></span>
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





// Facebook Feed
// ----------------------------------------------------
class BoxyWidgetFacebookFeed extends BoxyWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetFacebookFeed() {
		$widget_opts = array(
			'classname' => 'theme-widget-facebook-feed', // class of the <li> holder
			'description' => __( 'Displays the Facebook Feed from a user or page.','basil' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-facebook-feed', __('BASIL &mdash; Facebook Feed','basil'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Facebook Feed','basil')
			),
			array(
				'name'=>'facebook_id',
				'type'=>'text',
				'title'=>'Facebook Page ID',
				'default'=>''
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many total items?','basil'), 
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
		
		if (ot_get_option('facebook_app_id') && ot_get_option('facebook_app_secret')){
		
			global $fb;
			$fb = new Facebook(array(
				'appId' => ot_get_option('facebook_app_id'),
				'secret' => ot_get_option('facebook_app_secret')
			));
			$fb->getAccessToken();
			
			$load = intval($instance['load']);
			$title = '<i class="fa fa-facebook-square"></i>&nbsp;&nbsp;'.$instance['title'];
			$facebook_id = $instance['facebook_id'];
			$button_text = $instance['button_text'];
			$button_url = $instance['button_url'];
			$new_window = $instance['new_window'];
			
			?><div class="facebook-widget"><?php
				
				echo ($title ? $before_title.$title.$after_title : ''); ?>
				
				<?php if ($button_url || $button_text) {
				
					?><a href="<?php echo $button_url; ?>"<?php if ($new_window){ ?>target="_blank"<?php } ?> class="widget-button bgColor-1"><?php echo $button_text; ?></a><?php
				
				} ?>
				
				<ul>
					<?php
						
					$statuses = $fb->api('/' . $facebook_id . '/feed', array( 'limit' => $load, 'type' => 'message' ));
					
					if (!empty($statuses['data'])) {
						$temp_count = 0;
						foreach ($statuses['data'] as $s): $temp_count++;
							if ($temp_count <= $load){
							
								if ($s['type'] == 'photo'){
								
									if (isset($s['message'])){
										$message = $s['message'];
									} else {
										$message = $s['story'];
									}
						
									?>
									<li>
										<span class="tweet_text"><em><?php echo boxy_makeClickableLinks(boxy_char_shortalize($message)); ?></em><?php echo '<br /><strong><a href="'.$s['link'].'">View photo</a></strong>'; ?></span>
										<span class="tweet_time"><?php _e('Posted','basil'); ?> <?php echo ucfirst(boxy_relativeTime($s['created_time'],true)); ?></span>
									</li>
									<?php
									
								
								} else {
									
									if (isset($s['message'])){
										$message = $s['message'];
									} else {
										$message = $s['story'];
									}
							
									?>
									<li>
										<span class="tweet_text"><?php echo boxy_makeClickableLinks(boxy_char_shortalize($message)); ?><?php if ($s['type'] == 'link'){ echo '<br /><a href="'.$s['link'].'">Click to view link</a>'; } ?></span>
										<span class="tweet_time"><?php _e('Posted','basil'); ?> <?php echo ucfirst(boxy_relativeTime($s['created_time'],true)); ?></span>
									</li>
									<?php
								
								}
								
							} else {
								break;
							}
						endforeach;
					}
					?>
				</ul>
			
			</div><?php

		} else {
			
			echo '<p style="color:#dd0000;"><strong>Important:</strong> You need to enter your Facebook Settings on the Theme Options panel before you can use this widget.</p>';
			
		}
		
	}
}