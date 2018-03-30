<?php
	
// Events Widget
if (class_exists('Tribe__Events__Main')): include('upcoming-events.php'); endif;

// Recent Posts
include('recent-posts.php');

// Text Widget
include('text.php');

// Hours Widget
include('hours.php');

// Map Widget
include('map.php');

// Twitter
include('twitter/versions-proxy.php');
include('twitter/recent-tweets.php');

// Facebook
include('facebook/facebook.php');
include('facebook/facebook-feed.php');

// Register the widgets
function load_widgets() {
	
	if (class_exists('Tribe__Events__Main')): register_widget('BoxyWidgetUpcomingEvents'); endif;
	register_widget('BoxyWidgetRecentPosts');
	register_widget('BoxyWidgetTextWidget');
	register_widget('BoxyWidgetHoursWidget');
	register_widget('BoxyWidgetMapWidget');
	register_widget('BoxyWidgetRecentTweets');
	register_widget('BoxyWidgetFacebookFeed');
	
}

add_action('widgets_init', 'load_widgets');