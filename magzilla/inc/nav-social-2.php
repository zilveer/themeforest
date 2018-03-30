<?php
global $ft_option;

// Build social profiles array
$profiles = array (
	'sp_feed' => 'rss rss-icon',
	'sp_facebook' => 'facebook-square facebook-icon',
	'sp_twitter' => 'twitter-square twitter-icon',
	'sp_google' => 'google-plus-square google-plus-icon',
	'sp_linkedin' => 'linkedin-square linkedin-icon',
	'sp_instagram' => 'instagram instagram-icon',
	'sp_flickr' => 'flickr flickr-icon',
	'sp_foursquare' => 'foursquare foursquare-icon',
	'sp_vimeo' => 'vimeo-square vimeo-icon',
	'sp_youtube' => 'youtube-square youtube-icon',
	'sp_dribble' => 'dribbble dribbble-icon',
	'sp_tumblr' => 'tumblr-square tumblr-icon',
	'sp_pinterest' => 'pinterest-square pinterest-icon'
);
// Loop through array and output the item only if the field is not empty
foreach ( $profiles as $profile => $class ) {
	if ( !empty ( $ft_option[$profile] )) {
		echo '<li><a class="'.esc_attr( $class ).'-icon" href="' . esc_url( $ft_option[$profile] ) . '" target="_blank">
		<i class="fa fa-'.esc_attr( $class ).'"></i></a></li>';
	}
}
?>