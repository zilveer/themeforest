<?php

require_once( '../../../../../wp-load.php' );

return array(
	'consumerKey' => theme_get_option('advanced', 'twitter_consumerKey'),
	'consumerSecret' => theme_get_option('advanced', 'twitter_consumerSecret'),
	'accessToken' => theme_get_option('advanced', 'twitter_accessToken'),
	'accessTokenSecret' => theme_get_option('advanced', 'twitter_accessTokenSecret'),
);