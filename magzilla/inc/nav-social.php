<?php
global $ft_option;

// Build social profiles array
$profiles = array ( 
	'sp_feed' => 'rss',
	'sp_facebook' => 'facebook-square', 
	'sp_twitter' => 'twitter-square', 
	'sp_google' => 'google-plus-square',
	'sp_linkedin' => 'linkedin-square', 
	'sp_instagram' => 'instagram', 
	'sp_flickr' => 'flickr',
	'sp_foursquare' => 'foursquare',
	'sp_vimeo' => 'vimeo-square', 
	'sp_youtube' => 'youtube-square',
	'sp_dribble' => 'dribbble',
	'sp_tumblr' => 'tumblr-square',
	'sp_pinterest' => 'pinterest-square'
);
// Loop through array and output the item only if the field is not empty
foreach ( $profiles as $profile => $class ) {
	if ( !empty ( $ft_option[$profile] )) { 
		echo '<a href="' . esc_url( $ft_option[$profile] ) . '" target="_blank">
		<i class="fa fa-'.esc_attr( $class ).'"></i></a>';
	}
}
?>