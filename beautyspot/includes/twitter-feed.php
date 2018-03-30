<?php

/* -----------------------------------------------------------------------------

    Load Storm Twitter class
    https://github.com/stormuk/storm-twitter

----------------------------------------------------------------------------- */

include( 'storm-twitter.class.php' );


/* -----------------------------------------------------------------------------

    Initialize the Twitter app

----------------------------------------------------------------------------- */

$config = array(
    'directory' => '', //The path used to store the .tweetcache cache file.
    'key' => esc_attr( lsvr_get_field( 'twitter_consumer_key' ) ),
    'secret' => esc_attr( lsvr_get_field( 'twitter_consumer_secret' ) ),
    'token' => esc_attr( lsvr_get_field( 'twitter_access_token' ) ),
    'token_secret' => esc_attr( lsvr_get_field( 'twitter_access_token_secret' ) ),
    'cache_expire' => 3600 //The duration of the cache
);

global $lsvr_twitter_app;
$lsvr_twitter_app = new StormTwitter($config);


/* -----------------------------------------------------------------------------

    RESPONSE

----------------------------------------------------------------------------- */

$username = esc_attr( lsvr_get_field( 'twitter_feed_username', '' ) );
$limit = (int) esc_attr( lsvr_get_field( 'twitter_feed_count' ) );

if ( $username !== '' && $limit > 0 ) {

    global $lsvr_twitter_app;
    $tweets = $lsvr_twitter_app->getTweets( $limit, $username );
    echo json_encode( $tweets );

}

?>