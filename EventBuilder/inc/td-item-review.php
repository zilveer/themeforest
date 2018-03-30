<?php

function tdSubmitListingReviewForm() {

  	if ( isset( $_POST['tdSubmitListingReview_nonce'] ) && wp_verify_nonce( $_POST['tdSubmitListingReview_nonce'], 'tdSubmitListingReview_html' ) ) {

		session_start();
		/**
		 * Form posting handler
		 */
		$pagePath = explode('/wp-content/', dirname(__FILE__));
    	include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

		/**
		* Add transaction info to database 
		*/

		$user_name = $_POST['submit_review_name'];
		$user_email = $_POST['submit_review_email'];
		$listing_id = $_POST['rating-listing-id'];
		$rating_names = $_POST['rating-names'];
		$rating_values = $_POST['rating-values'];
		$rating_comment = $_POST['rating-comment'];
		$date = date('Y-m-d H:i:s');

		$comma_separated_names = implode(", ", $rating_names);
		$comma_separated_values = implode(", ", $rating_values);

		$num = 0;
		$total = 0;
		$totalValue = 0;
		$array = explode(', ', $comma_separated_values); //split string into array seperated by ', '
		foreach($array as $value)  {

			$total = $total + $value;
			$num++;

		}

		$totalValue = $total/$num;

		$post_reviews = array();
		$post_reviews = get_post_meta($listing_id, 'listing_reviews', true);

		$parent = new stdClass;
		$parent->review_id = uniqid();
		$parent->user_ip = td_get_the_user_ip();
		$parent->user_name =  $user_name;
		$parent->user_email = $user_email;
		$parent->listing_id = $listing_id;
		$parent->listing_review_names = $comma_separated_names;
		$parent->listing_review_values = $comma_separated_values;
		$parent->listing_review_values_med = $totalValue;
		$parent->listing_review_comment = $rating_comment;
		$parent->date = $date;
		$post_reviews[] = $parent;

		update_post_meta($listing_id, 'listing_reviews', $post_reviews);

        //=========================================

	} 

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_tdSubmitListingReviewForm', 'tdSubmitListingReviewForm' );
add_action( 'wp_ajax_nopriv_tdSubmitListingReviewForm', 'tdSubmitListingReviewForm' );


