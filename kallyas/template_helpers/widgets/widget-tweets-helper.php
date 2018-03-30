<?php if(! defined('ABSPATH')){ return; }
function update_tweets( $tweets )
	{
	}

	if ( $_GET['update'] ) {
		set_transient( 'fs_tweets', $fs_tweets, 0 );//cache them for 1 hour
	}

	/*
	 * If there are tweets
	 */
	if ( $_GET['get_tweets'] )
	{
		if ( false === ( $tweets = get_transient( 'fs_tweets' ) ) ) {//if tweets are not in the cache
			echo 'false';
			set_transient( 'tweets', $tweets, 60 * 60 );//cache them for 1 hour
		}
		else {
			echo get_transient( $tweets ); //show the tweets
		}
	}
