<?php
require_once IAMD_TD.'/framework/theme_widgets/twitter.php';
require_once IAMD_TD.'/framework/theme_widgets/mailchimp.php';
require_once IAMD_TD.'/framework/theme_widgets/flickr.php';
require_once IAMD_TD.'/framework/theme_widgets/recent_posts.php';
require_once IAMD_TD.'/framework/theme_widgets/recent_pages.php';
require_once IAMD_TD.'/framework/theme_widgets/portfolio_widgets.php';

add_action('widgets_init', 'dttheme_widgets');
function dttheme_widgets() {
	#Twitter
	register_widget('MY_Twitter');

	#Mailchimp
	register_widget('MY_Mailchimp');

	#Flickr
	register_widget('MY_Flickr');

	#Recent Posts
	register_widget('MY_Recent_Posts');

	#My Portfolio Widgets
	register_widget('MY_Portfolio_Widget');
	
}
?>