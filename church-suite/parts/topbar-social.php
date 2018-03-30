<?php
$webnus_options = webnus_options();

$webnus_options['webnus_top_social_icons_facebook'] = isset( $webnus_options['webnus_top_social_icons_facebook'] ) ? $webnus_options['webnus_top_social_icons_facebook'] : '';
$webnus_options['webnus_top_social_icons_twitter'] = isset( $webnus_options['webnus_top_social_icons_twitter'] ) ? $webnus_options['webnus_top_social_icons_twitter'] : '';
$webnus_options['webnus_top_social_icons_dribbble'] = isset( $webnus_options['webnus_top_social_icons_dribbble'] ) ? $webnus_options['webnus_top_social_icons_dribbble'] : '';
$webnus_options['webnus_top_social_icons_pinterest'] = isset( $webnus_options['webnus_top_social_icons_pinterest'] ) ? $webnus_options['webnus_top_social_icons_pinterest'] : '';
$webnus_options['webnus_top_social_icons_vimeo'] = isset( $webnus_options['webnus_top_social_icons_vimeo'] ) ? $webnus_options['webnus_top_social_icons_vimeo'] : '';
$webnus_options['webnus_top_social_icons_youtube'] = isset( $webnus_options['webnus_top_social_icons_youtube'] ) ? $webnus_options['webnus_top_social_icons_youtube'] : '';
$webnus_options['webnus_top_social_icons_google'] = isset( $webnus_options['webnus_top_social_icons_google'] ) ? $webnus_options['webnus_top_social_icons_google'] : '';
$webnus_options['webnus_top_social_icons_linkedin'] = isset( $webnus_options['webnus_top_social_icons_linkedin'] ) ? $webnus_options['webnus_top_social_icons_linkedin'] : '';
$webnus_options['webnus_top_social_icons_rss'] = isset( $webnus_options['webnus_top_social_icons_rss'] ) ? $webnus_options['webnus_top_social_icons_rss'] : '';
$webnus_options['webnus_top_social_icons_instagram'] = isset( $webnus_options['webnus_top_social_icons_instagram'] ) ? $webnus_options['webnus_top_social_icons_instagram'] : '';
$webnus_options['webnus_top_social_icons_flickr'] = isset( $webnus_options['webnus_top_social_icons_flickr'] ) ? $webnus_options['webnus_top_social_icons_flickr'] : '';
$webnus_options['webnus_top_social_icons_reddit'] = isset( $webnus_options['webnus_top_social_icons_reddit'] ) ? $webnus_options['webnus_top_social_icons_reddit'] : '';
$webnus_options['webnus_top_social_icons_delicious'] = isset( $webnus_options['webnus_top_social_icons_delicious'] ) ? $webnus_options['webnus_top_social_icons_delicious'] : '';
$webnus_options['webnus_top_social_icons_lastfm'] = isset( $webnus_options['webnus_top_social_icons_lastfm'] ) ? $webnus_options['webnus_top_social_icons_lastfm'] : '';
$webnus_options['webnus_top_social_icons_tumblr'] = isset( $webnus_options['webnus_top_social_icons_tumblr'] ) ? $webnus_options['webnus_top_social_icons_tumblr'] : '';
$webnus_options['webnus_top_social_icons_skype'] = isset( $webnus_options['webnus_top_social_icons_skype'] ) ? $webnus_options['webnus_top_social_icons_skype'] : '';

$webnus_options['webnus_facebook_ID'] = isset( $webnus_options['webnus_facebook_ID'] ) ? $webnus_options['webnus_facebook_ID'] : '';
$webnus_options['webnus_twitter_ID'] = isset( $webnus_options['webnus_twitter_ID'] ) ? $webnus_options['webnus_twitter_ID'] : '';
$webnus_options['webnus_dribbble_ID'] = isset( $webnus_options['webnus_dribbble_ID'] ) ? $webnus_options['webnus_dribbble_ID'] : '';
$webnus_options['webnus_pinterest_ID'] = isset( $webnus_options['webnus_pinterest_ID'] ) ? $webnus_options['webnus_pinterest_ID'] : '';
$webnus_options['webnus_vimeo_ID'] = isset( $webnus_options['webnus_vimeo_ID'] ) ? $webnus_options['webnus_vimeo_ID'] : '';
$webnus_options['webnus_youtube_ID'] = isset( $webnus_options['webnus_youtube_ID'] ) ? $webnus_options['webnus_youtube_ID'] : '';
$webnus_options['webnus_google_ID'] = isset( $webnus_options['webnus_google_ID'] ) ? $webnus_options['webnus_google_ID'] : '';
$webnus_options['webnus_linkedin_ID'] = isset( $webnus_options['webnus_linkedin_ID'] ) ? $webnus_options['webnus_linkedin_ID'] : '';
$webnus_options['webnus_rss_ID'] = isset( $webnus_options['webnus_rss_ID'] ) ? $webnus_options['webnus_rss_ID'] : '';
$webnus_options['webnus_instagram_ID'] = isset( $webnus_options['webnus_instagram_ID'] ) ? $webnus_options['webnus_instagram_ID'] : '';
$webnus_options['webnus_flickr_ID'] = isset( $webnus_options['webnus_flickr_ID'] ) ? $webnus_options['webnus_flickr_ID'] : '';
$webnus_options['webnus_reddit_ID'] = isset( $webnus_options['webnus_reddit_ID'] ) ? $webnus_options['webnus_reddit_ID'] : '';
$webnus_options['webnus_delicious_ID'] = isset( $webnus_options['webnus_delicious_ID'] ) ? $webnus_options['webnus_delicious_ID'] : '';
$webnus_options['webnus_lastfm_ID'] = isset( $webnus_options['webnus_lastfm_ID'] ) ? $webnus_options['webnus_lastfm_ID'] : '';
$webnus_options['webnus_tumblr_ID'] = isset( $webnus_options['webnus_tumblr_ID'] ) ? $webnus_options['webnus_tumblr_ID'] : '';
$webnus_options['webnus_skype_ID'] = isset( $webnus_options['webnus_skype_ID'] ) ? $webnus_options['webnus_skype_ID'] : '';

if($webnus_options['webnus_top_social_icons_facebook'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_facebook_ID'] .'" class="facebook"><i class="fa-facebook"></i></a>';
if($webnus_options['webnus_top_social_icons_twitter'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_twitter_ID'] .'" class="twitter"><i class="fa-twitter"></i></a>';
if($webnus_options['webnus_top_social_icons_dribbble'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_dribbble_ID'].'" class="dribble"><i class="fa-dribbble"></i></a>';
if($webnus_options['webnus_top_social_icons_pinterest'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_pinterest_ID'] .'" class="pinterest"><i class="fa-pinterest"></i></a>';
if($webnus_options['webnus_top_social_icons_vimeo'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_vimeo_ID'] .'" class="vimeo"><i class="fa-vimeo-square"></i></a>';
if($webnus_options['webnus_top_social_icons_youtube'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_youtube_ID'] .'" class="youtube"><i class="fa-youtube"></i></a>';	
if($webnus_options['webnus_top_social_icons_google'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_google_ID'] .'" class="google"><i class="fa-google"></i></a>';	
if($webnus_options['webnus_top_social_icons_linkedin'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_linkedin_ID'] .'" class="linkedin"><i class="fa-linkedin"></i></a>';	
if($webnus_options['webnus_top_social_icons_rss'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_rss_ID'] .'" class="rss"><i class="fa-rss-square"></i></a>';
if($webnus_options['webnus_top_social_icons_instagram'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_instagram_ID'] .'" class="instagram"><i class="fa-instagram"></i></a>';	
if($webnus_options['webnus_top_social_icons_flickr'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_flickr_ID'] .'" class="other-social"><i class="fa-flickr"></i></a>';	
if($webnus_options['webnus_top_social_icons_reddit'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_reddit_ID'] .'" class="other-social"><i class="fa-reddit"></i></a>';
if($webnus_options['webnus_top_social_icons_delicious'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_delicious_ID'] .'" class="other-social"><i class="fa-delicious"></i></a>';	
if($webnus_options['webnus_top_social_icons_lastfm'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_lastfm_ID'] .'" class="other-social"><i class="fa-lastfm-square"></i></a>';
if($webnus_options['webnus_top_social_icons_tumblr'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_tumblr_ID'] .'" class="other-social"><i class="fa-tumblr-square"></i></a>';
if($webnus_options['webnus_top_social_icons_skype'])
	echo '<a target="_blank" href="'. $webnus_options['webnus_skype_ID'] .'" class="other-social"><i class="fa-skype"></i></a>'; 
?>