<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_redirect_video_search' ) ) {
	/**
	 * Redirect video search to the appropriate template
	 *
	 * @access public
	 * @param object $query
	 * @return void
	 */
	function wolf_redirect_video_search() {

		if ( wolf_is_video_search() ) {
			wolf_videos_get_template( 'search-videos.php' );
			exit();
		}
	}
	add_filter( 'template_redirect', 'wolf_redirect_video_search' );
}

if ( ! function_exists( 'wolf_search_filter' ) ) {
	/**
	 * Exlude post types from search
	 *
	 * @access public
	 * @param object $query
	 * @return void
	 */
	function wolf_search_filter( $query ) {
		global $wp_post_types;
    		$wp_post_types['page']->exclude_from_search = true;
	}
	add_action( 'init', 'wolf_search_filter' );
}

if ( ! function_exists( 'wolf_video_search_results' ) ) {
	/**
	 * Display only video post type in video search results
	 *
	 * @param object $query
	 * @return object $query
	 */
	function wolf_video_search_results( $query ) {


		if ( isset( $_GET['post-type'] ) && 'video' == $_GET['post-type'] && class_exists( 'Wolf_Videos' ) ) {

			if ( $query->is_search ) {
				$posts_per_page = ( wolf_get_theme_option( 'video_posts_per_page' ) ) ? wolf_get_theme_option( 'video_posts_per_page' ) : 12;
				$query->set( 'post_type', 'video' );
				$query->set( 'posts_per_page', $posts_per_page );
			}
		}
		return $query;
	}
	add_filter( 'pre_get_posts', 'wolf_video_search_results' );
}

if ( ! function_exists( 'wolf_get_video_results_count' ) ) {
	/**
	 * Get the number of video search results
	 *
	 * @access public
	 * @return int
	 */
	function wolf_get_video_results_count() {
		if ( wolf_is_video_search() ) {
			$s = ( isset( $_GET['s'] ) ) ? $_GET['s'] : '';
			if ( $s ) {
				$search_query = new WP_Query( "s=$s&showposts=-1" );
				return absint( $search_query->post_count );
			}
		}
	}
}