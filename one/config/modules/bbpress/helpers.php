<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if( !function_exists('thb_is_bbpress_search') ) {
	/**
	 * Add the bbPress search page and search results page to the thb_is_archive function
	 * @return string
	 */
	function thb_is_bbpress_search( $results ) {
		$results = $results || bbp_is_search() || bbp_is_search_results() || bbp_is_user_home() || bbp_is_topic_tag();
		return $results;
	}

	add_filter( 'thb_is_archive', 'thb_is_bbpress_search' );
}