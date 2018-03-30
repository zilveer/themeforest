<?php

if( $user == '' ) {
	return;
}

/**
 * Cache
 */
$cache_key = 'twitter_' . $user . '_' . $num;
$cache = thb_cache_get($cache_key);

if( $cache ) {
	$tweets = $cache;
}
else {
	$consumer_key = thb_get_option('twitter_consumer_key');
	$consumer_secret = thb_get_option('twitter_consumer_secret');
	$oauth_token = thb_get_option('twitter_oauth_token');
	$oauth_token_secret = thb_get_option('twitter_oauth_token_secret');

	if( $consumer_key == '' || $consumer_secret == '' || $oauth_token == '' || $oauth_token_secret == '' ) {
		return;
	}

	$user = str_replace("@", "", $user);

	$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	$connection->host = "https://api.twitter.com/1.1/";

	$tweets = $connection->get('statuses/user_timeline', array(
		'screen_name' => $user,
		'count' => $num
	));

	if( in_array($connection->http_code, array('200', '304')) ) {
		$tweets = thb_cache_set($cache_key, json_encode($tweets), 900);
	}
	else {
		$tweets = thb_cache_set($cache_key, FALSE, 600);
	}

}

$tweets = json_decode($tweets);

?>

<div class="thb-shortcode thb-twitter <?php echo implode(' ', $class); ?>">
	<?php if( $title != '' ) : ?>
		<h1 class="thb-shortcode-title"><?php echo thb_text_format($title); ?></h1>
	<?php endif; ?>

	<?php if( is_array($tweets) && count($tweets) > 0 ) : ?>
		<ul>
		<?php foreach( $tweets as $tweet ) : ?>
			<li>
				<?php echo thb_text_twitterify($tweet->text); ?>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p><?php echo __('Error retrieving tweets.', 'thb_text_domain'); ?></p>
	<?php endif; ?>
</div>