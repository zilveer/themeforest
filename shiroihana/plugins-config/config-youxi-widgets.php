<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

// Make sure the plugin is active
if( ! defined( 'YOUXI_WIDGETS_VERSION' ) ) {
	return;
}

/* ==========================================================================
	Youxi Widgets plugin config
============================================================================= */

/**
 * Disable Enqueuing Scripts
 */
add_filter( 'youxi_widgets_social-widget_enqueue_scripts', '__return_false' );

/**
 * Disable specific widgets
 */
add_filter( 'youxi_widgets_use_quote', '__return_false' );
add_filter( 'youxi_widgets_use_rotating_quotes', '__return_false' );

/**
 * Mapbox Access Token
 */
add_filter( 'youxi_widgets_mapbox_access_token', 'shiroi_mapbox_access_token' );

/**
 * Twitter Keys
 */
if( ! function_exists( 'shiroi_widgets_twitter_keys' ) ):

function shiroi_widgets_twitter_keys( $keys ) {

	return wp_parse_args( get_option( 'youxi_external_api_twitter_option', array() ), array(
		'consumer_key'       => '', 
		'consumer_secret'    => '', 
		'oauth_token'        => '',  
		'oauth_token_secret' => ''
	));
}
endif;
add_filter( 'youxi_widgets_twitter_keys', 'shiroi_widgets_twitter_keys' );

/**
 * Instagram Access Token
 */
if( ! function_exists( 'shiroi_instagram_access_token' ) ):

function shiroi_instagram_access_token( $access_token ) {

	$instagram_option = get_option( 'youxi_external_api_instagram_option', array() );

	if( ! empty( $instagram_option['access_token'] ) ) {
		$access_token = $instagram_option['access_token'];
	}

	return $access_token;
}
endif;
add_filter( 'youxi_widgets_instagram_access_token', 'shiroi_instagram_access_token' );

/**
 * Fetch Twitter Keys from Theme Options
 */
if( ! function_exists( 'shiroi_widgets_twitter_keys' ) ):

function shiroi_widgets_twitter_keys( $keys ) {
	return array(
		'consumer_key'       => trim( Youxi()->option->get( 'twttr_consumer_key' ) ), 
		'consumer_secret'    => trim( Youxi()->option->get( 'twttr_consumer_secret' ) ), 
		'oauth_token'        => trim( Youxi()->option->get( 'twttr_access_token' ) ), 
		'oauth_token_secret' => trim( Youxi()->option->get( 'twttr_access_token_secret' ) )
	);
}
endif;
add_filter( 'youxi_widgets_twitter_keys', 'shiroi_widgets_twitter_keys' );

/**
 * Set Widget Templates Directory
 */
if( ! function_exists( 'shiroi_widgets_template_dir' ) ):

function shiroi_widgets_template_dir( $path ) {
	return trailingslashit( 'widget-templates' );
}
endif;
add_filter( 'youxi_widgets_template_dir', 'shiroi_widgets_template_dir' );

/**
 * Instagram Client ID
 */
if( ! function_exists( 'shiroi_youxi_instagram_client_id' ) ):

function shiroi_youxi_instagram_client_id( $client_id ) {
	return '49e1e410b32a446c90477501b98ed7e1';
}
endif;
add_filter( 'youxi_instagram_client_id', 'shiroi_youxi_instagram_client_id' );

/**
 * Match Widget Area Locations
 */
if( ! function_exists( 'shiroi_widget_sidebar_location' ) ):

	function shiroi_widget_sidebar_location( $sidebar_id ) {
		$regexes = array(
			'/^footer_widget_area_/' => 'footer'
		);

		foreach( $regexes as $regex => $location ) {
			if( preg_match( $regex, $sidebar_id ) ) {
				return $location;
			}
		}

		return 'sidebar';
	}
endif;
add_filter( 'youxi_widgets_sidebar_location', 'shiroi_widget_sidebar_location' );

/**
 * Recognized Social Icons
 */
if( ! function_exists( 'shiroi_youxi_widgets_social_icons' ) ):

function shiroi_youxi_widgets_social_icons( $icons ) {

	return array(
		'500px' => '500px', 
		'apple' => 'apple', 
		'bebo' => 'bebo', 
		'behance' => 'behance', 
		'blogger' => 'blogger', 
		'bloglovin' => 'bloglovin', 
		'buffer' => 'buffer', 
		'chimein' => 'chimein', 
		'coderwall' => 'coderwall', 
		'dailymotion' => 'dailymotion', 
		'delicious' => 'delicious', 
		'deviantart' => 'deviantart', 
		'digg' => 'digg', 
		'disqus' => 'disqus', 
		'dribbble' => 'dribbble', 
		'envato' => 'envato', 
		'facebook' => 'facebook', 
		'feedburner' => 'feedburner', 
		'flattr' => 'flattr', 
		'flickr' => 'flickr', 
		'forrst' => 'forrst', 
		'foursquare' => 'foursquare', 
		'friendfeed' => 'friendfeed', 
		'github' => 'github', 
		'googleplus' => 'googleplus', 
		'grooveshark' => 'grooveshark', 
		'identica' => 'identica', 
		'instagram' => 'instagram', 
		'lanyrd' => 'lanyrd', 
		'lastfm' => 'lastfm', 
		'linkedin' => 'linkedin', 
		'myspace' => 'myspace', 
		'netcodes' => 'netcodes', 
		'newsvine' => 'newsvine', 
		'outlook' => 'outlook', 
		'pinterest' => 'pinterest', 
		'playstore' => 'playstore', 
		'reddit' => 'reddit', 
		'rss' => 'rss', 
		'skype' => 'skype', 
		'slideshare' => 'slideshare', 
		'soundcloud' => 'soundcloud', 
		'spotify' => 'spotify', 
		'steam' => 'steam', 
		'stumbleupon' => 'stumbleupon', 
		'technorati' => 'technorati', 
		'tripadvisor' => 'tripadvisor', 
		'tumblr' => 'tumblr', 
		'twitter' => 'twitter', 
		'viadeo' => 'viadeo', 
		'vimeo' => 'vimeo', 
		'vine' => 'vine', 
		'vkontakte' => 'vkontakte', 
		'wikipedia' => 'wikipedia', 
		'windows' => 'windows', 
		'wordpress' => 'wordpress', 
		'xbox' => 'xbox', 
		'xing' => 'xing', 
		'yahoo' => 'yahoo', 
		'yelp' => 'yelp', 
		'youtube' => 'youtube', 
		'zerply' => 'zerply', 
		'zynga' => 'zynga'
	);
}
endif;
add_filter( 'youxi_widgets_recognized_social_icons', 'shiroi_youxi_widgets_social_icons' );