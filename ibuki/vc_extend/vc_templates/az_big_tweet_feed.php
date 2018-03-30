<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

$twitter_slides_class = null;
if ($twitter_mode == "more_tweet") {
	$twitter_slides_class = 'slides';
}

$tweet_id = null;
if ($twitter_mode == "one_tweet") {
	$tweet_id = 'twitter-feed';
} else {
	$tweet_id = 'twitter-feed-slide';
}

$class = setClass(array('tweet_list', $twitter_slides_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '<div id="'.$tweet_id.'" class="'.$el_class.'">
			<a href="https://twitter.com/' . $twitter_username . '" target="_blank" class="twitter-username-icon"><i class="font-icon-social-twitter"></i></a>
			<ul'.$class.'>';

if ($twitter_mode == "one_tweet") {
	$num_tweet = 1;
	$tweets = getTweets($num_tweet, $twitter_username);
	foreach($tweets as $tweet) {

		$output .= '
				<li>
					<span class="tweet_text">' . TwitterFilter($tweet['text']) . '</span>
					<span class="tweet_time"><a href="https://twitter.com/' . $twitter_username . '/status/' . $tweet['id_str'] . '">' . date('j F o \a\t g:i A', strtotime($tweet['created_at'])) . '</a></span>
				</li>';		
	}

} else {

	$tweets = getTweets(intval($num_tweet), $twitter_username);
	foreach($tweets as $tweet) {

		$output .= '
				<li>
					<span class="tweet_text">' . TwitterFilter($tweet['text']) . '</span>
					<span class="tweet_time"><a href="https://twitter.com/' . $twitter_username . '/status/' . $tweet['id_str'] . '">' . date('j F o \a\t g:i A', strtotime($tweet['created_at'])) . '</a></span>
				</li>';		
	}
}

$output .= '</ul>
			</div>';

echo $output.$this->endBlockComment('az_big_twitter_feed');

?>