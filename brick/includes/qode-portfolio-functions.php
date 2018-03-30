<?php

if(!function_exists('qode_get_portfolio_image_meta')) {
	function qode_get_portfolio_image_meta($image_src) {
		global $wpdb;

		//init variables
		$meta_array = array();

		//is $image_src set?
		if($image_src !== '') {
			//run query
			$query = $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $image_src);

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

if (!function_exists('qodeComparePortfolioImages')) {
	/**
	 * Function that compares two portfolio image for sorting
	 * @param $a int first image
	 * @param $b int second image
	 * @return int result of comparison
	 */
	function qodeComparePortfolioImages($a, $b){
		if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
			if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
				return 0;
			}
			return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
		}

		return 0;
	}
}

if (!function_exists('qodeComparePortfolioOptions')){
	/**
	 * Function that compares two portfolio options for sorting
	 * @param $a int first option
	 * @param $b int second option
	 * @return int result of comparison
	 */
	function qodeComparePortfolioOptions($a, $b){
		if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
			if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
				return 0;
			}
			return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
		}

		return 0;
	}
}