<?php

/**************************************

INDEX

USER RATING AJAX CALL

***************************************/


/**************************************
USER RATING AJAX CALL
***************************************/

	add_action('wp_ajax_user_rating', 'user_rating');
	add_action('wp_ajax_nopriv_user_rating', 'user_rating');

	function user_rating() {

		// GET VARS
		$star_rating = $_REQUEST['star_rating'];
		$post_id = $_REQUEST['post_id'];
		$user_ratings_cookie_string = mb_cookie_get_key_value ("cookbook_cookie", "user-ratings");

		// BOUNCER
		if (!wp_verify_nonce($_REQUEST['nonce'], 'user_rating_' . $post_id )) {
			exit('NONCE INCORRECT!');
		}
		if (!isset($_COOKIE['cookbook_cookie'])) die();

		//UPDATE POST LIKES
		$cmb_post_user_ratings = get_post_meta($post_id,'cmb_post_user_ratings',true);
		$cmb_post_user_ratings = mb_add_value_to_delim_string($cmb_post_user_ratings, $star_rating, "¤", true);
		update_post_meta($post_id,'cmb_post_user_ratings',$cmb_post_user_ratings);

		//UPDATE USER LIKES
		$this_rating_string = $post_id . "-" . $star_rating;
		$user_ratings_cookie_string = mb_add_value_to_delim_string ($user_ratings_cookie_string, $this_rating_string, "¤", false);
		mb_update_cookie_key_value('cookbook_cookie', 'user-ratings', $user_ratings_cookie_string);

		//OUTPUT
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo esc_attr($cmb_post_user_ratings);
		}

		die();

	}

