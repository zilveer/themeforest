<?php
/**
 * Header links for edit forms.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/header-links.php
 *
 * @package TribeCommunityEvents
 * @since  3.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }
$current_user = wp_get_current_user();

if( is_user_logged_in() ) {
	echo '<div id="my-events"><a href="'. tribe_community_events_list_events_link() .'" class="button vamtam-button button-border accent2 hover-accent1"><span class="btext">'. __( 'My Events', 'tribe-events-community' ) .'</span></a></div>';
	echo '<div id="not-user">'. __( 'Not', 'tribe-events-community' ) .' <i>'. $current_user->display_name .'</i>? <a href="'.tribe_community_events_logout_url() .'">'. __( 'Log Out', 'tribe-events-community' ) .'</a></div>';
	echo '<div style="clear:both"></div>';
}

echo tribe_community_events_get_messages();

