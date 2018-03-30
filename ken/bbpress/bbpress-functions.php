<?php


if(!is_admin()){ add_action('bbp_enqueue_scripts', 'mk_bbpress_register_assets',15); }


function mk_bbpress_register_assets() {

	 wp_dequeue_style('bbp-default');
	wp_enqueue_style( 'mk-theme-bbpress', THEME_DIR_URI.'/bbpress/bbpress.css');
}



add_filter('bbp_get_topic_class', 'mk_bbpress_add_topic_class');
function mk_bbpress_add_topic_class($classes)
{
	$voices = bbp_get_topic_voice_count() > 1 ? "multi" : "single";

	$classes[] = 'topic-voices-'.$voices;
	return $classes;
}


add_filter('bbp_get_single_forum_description', 'mk_bbpress_filter_form_message',10,2 );
add_filter('bbp_get_single_topic_description', 'mk_bbpress_filter_form_message',10,2 );



function mk_bbpress_filter_form_message( $retstr, $args )
{
	return false;
}


add_filter( 'bbp_no_breadcrumb', '__return_true' );
