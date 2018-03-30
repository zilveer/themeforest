<?php

global $espresso_twitter_settings;

$section_title_tweets = get_post_meta($post->ID,'_recent_tweets_title',true);
$twitter_user = get_post_meta($post->ID,'_recent_tweets_user',true);
$load = get_post_meta($post->ID,'_tweet_count',true);

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?include_entities=true&include_rts=true&screen_name='.$twitter_user.'&count='.$load;
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($espresso_twitter_settings);
$tweets = $twitter->setGetfield($getfield)
          ->buildOauth($url, $requestMethod)
          ->performRequest();
          
$tweets = json_decode($tweets);

if (!empty($tweets)) {

	?><section id="recent-tweets" class="colored-block">
		<div class="shell">
			<h3><?php echo $section_title_tweets; ?></h3>
			<div class="tweets-carousel"><?php
			
				foreach ($tweets as $tweet) {
				
					?><div class="tweet">
						<div class="wrapped">
							<?php echo wpautop(espresso_add_links(str_replace('&apos;', '\'', $tweet->text))); ?>
							<small><i class="fa fa-twitter"></i>&nbsp;<?php echo boxy_relativeTime(strtotime($tweet->created_at)); ?> <?php _e('via','espresso'); ?> <a href="http://twitter.com/<?php echo $twitter_user; ?>" target="_blank">@<?php echo $twitter_user; ?></a></small>
						</div>
					</div><?php
					
				}
				?></div>
			<a href="#" class="btn-prev"><i class="fa fa-arrow-left"></i></a>
			<a href="#" class="btn-next"><i class="fa fa-arrow-right"></i></a>
		</div>
	</section><?php
}