<?php
/*
* Functions to track Post Views
* @package Houzez
* @since   Houzez 1.0
*/
if ( ! function_exists( 'houzez_getPostViews' ) ) :

	function houzez_getPostViews($postID){
		$count_key = 'houzez-post_views';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count;
	}
endif;

if ( ! function_exists( 'houzez_setPostViews' ) ) :

	function houzez_setPostViews($postID) {
		$count_key = 'houzez-post_views';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '1');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
endif;
?>