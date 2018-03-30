<?php
/**
 *  This file contains functions related to add to favorites feature
 */


if ( ! function_exists( 'add_to_favorite' ) ) {
	/**
	 * Add to favorites
	 */
	function add_to_favorite() {
		if ( isset( $_POST[ 'property_id' ] ) && isset( $_POST[ 'user_id' ] ) ) {
			$property_id = intval( $_POST[ 'property_id' ] );
			$user_id = intval( $_POST[ 'user_id' ] );
			if ( $property_id > 0 && $user_id > 0 ) {
				if ( add_user_meta( $user_id, 'favorite_properties', $property_id ) ) {
					_e( 'Added to Favorites', 'framework' );
				} else {
					_e( 'Failed!', 'framework' );
				}
			}
		} else {
			_e( 'Invalid Parameters!', 'framework' );
		}
		die;
	}

	add_action( 'wp_ajax_add_to_favorite', 'add_to_favorite' );
}


if ( ! function_exists( 'is_added_to_favorite' ) ) {
	/**
	 * Check if a property is already added to favorites of a given user
	 *
	 * @param $user_id
	 * @param $property_id
	 * @return bool
	 */
	function is_added_to_favorite( $user_id, $property_id ) {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM $wpdb->usermeta WHERE meta_key='favorite_properties' AND meta_value=" . $property_id . " AND user_id=" . $user_id );
		if ( isset( $results[ 0 ]->meta_value ) && ( $results[ 0 ]->meta_value == $property_id ) ) {
			return true;
		} else {
			return false;
		}
	}
}


if ( ! function_exists( 'remove_from_favorites' ) ) {
	/**
	 * Remove from favorites
	 */
	function remove_from_favorites() {
		if ( isset( $_POST[ 'property_id' ] ) && isset( $_POST[ 'user_id' ] ) ) {
			$property_id = intval( $_POST[ 'property_id' ] );
			$user_id = intval( $_POST[ 'user_id' ] );
			if ( $property_id > 0 && $user_id > 0 ) {
				if ( delete_user_meta( $user_id, 'favorite_properties', $property_id ) ) {
					echo 3;
					/* Removed successfully! */
				} else {
					echo 2;
					/* Failed to remove! */
				}
			} else {
				echo 1;
				/* Invalid parameters! */
			}
		} else {
			echo 1;
			/* Invalid parameters! */
		}
		die;
	}

	add_action( 'wp_ajax_remove_from_favorites', 'remove_from_favorites' );
}
