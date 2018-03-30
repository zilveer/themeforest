<?php

function td_favoriteForm() {

  	if ( isset( $_POST['favoriteForm_nonce'] ) && wp_verify_nonce( $_POST['favoriteForm_nonce'], 'favoriteForm_html' ) ) {

		session_start();
		/**
		 * Form posting handler
		 */
		$pagePath = explode('/wp-content/', dirname(__FILE__));
    	include_once(str_replace('wp-content/' , '', $pagePath[0] . '/wp-load.php'));

		/**
		* Add transaction info to database 
		*/

		global $wpdb;

		$wpdb->query('CREATE TABLE IF NOT EXISTS `td_favorites` (
	        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        `user_id` TEXT NOT NULL,
	        `listing_id` TEXT NOT NULL,
	        `listing_type` TEXT NOT NULL
	    ) ENGINE = MYISAM ;');

		$listing_id = $_POST['favorite_listing_id'];
		$user_id = $_POST['favorite_user_id'];
		$status = $_POST['favorite_status'];
		if(isset($_POST['favorite_type'])) { $type = $_POST['favorite_type']; };

		if($status == 0) {

			$favorite_information = array(
			    'user_id' => $user_id,
			    'listing_id' => $listing_id
		  	); 

			$insert_format = array('%s', '%s');

			$wpdb->insert('td_favorites', $favorite_information, $insert_format);

			$response = 1;

		} else {

			$favorite_information = array(
			    'user_id' => $user_id,
			    'listing_id' => $listing_id
		  	); 

			$wpdb->delete( 'td_favorites', $favorite_information, $where_format = null );

			$response = 0;

		} 

        //=========================================

	} else {

		$response = 3;

  	}

  	echo esc_attr($response);

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_favoriteForm', 'td_favoriteForm' );
add_action( 'wp_ajax_nopriv_favoriteForm', 'td_favoriteForm' );



function td_favoriteUpdateForm() {

  	if ( isset( $_POST['favoriteUpdateForm_nonce'] ) && wp_verify_nonce( $_POST['favoriteUpdateForm_nonce'], 'favoriteUpdateForm_html' ) ) {

  		$listing_id = $_POST['favorite_listing_id'];

  		global $wpdb;
  		$allFav = $wpdb->get_var( 'SELECT COUNT(*) FROM td_favorites WHERE listing_id = "'.$listing_id.'" ' );

	    if(empty($allFav)) {
	      	$allFav = 0;
	    }

		$response = $allFav;

	  } else {

  	}

  	echo esc_attr($response);

  	die(); // this is required to return a proper result

}
add_action( 'wp_ajax_favoriteUpdateForm', 'td_favoriteUpdateForm' );
add_action( 'wp_ajax_nopriv_favoriteUpdateForm', 'td_favoriteUpdateForm' );


