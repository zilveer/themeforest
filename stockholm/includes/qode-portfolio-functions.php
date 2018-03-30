<?php

if(!function_exists('qode_get_portfolio_image_meta')) {
	function qode_get_portfolio_image_meta($image_src) {
		global $wpdb;

		//init variables
		$meta_array = array();

		//is $image_src set?
		if($image_src !== '') {
			//run query
			$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";

			//get id
			$meta_array[] = $id = $wpdb->get_var($query);

			//get image title
			$meta_array[] = $title = get_the_title($id);

			//get image alt
			$meta_array[] = $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
		}

		//return meta array
		return $meta_array;
	}
}