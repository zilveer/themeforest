<?php

/**************************************
INDEX

AJAX DELETE SLIDER ITEM
CHECK FOR UPDATES

***************************************/


/**************************************
AJAX DELETE SLIDER ITEM
***************************************/

	//AJAX CALL
	add_action('wp_ajax_del_slider_item', 'del_slider_item');
	add_action('wp_ajax_nopriv_del_slider_item', 'del_slider_item_must_login');

	function del_slider_item() {
		if (!wp_verify_nonce($_REQUEST['nonce'], 'del_slider_item_nonce')) {
			exit('NONCE INCORRECT!');
		}

		$del_item_id = $_REQUEST['item_id'];
		delete_post_meta($del_item_id, 'cmb_slider_feature');

		//update order_array
		$results_slider_posts = get_posts(array(
			'numberposts'		=> -1,
			'meta_key'			=> 'cmb_slider_feature',
			'meta_value'		=> 'checked',
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
			'post_type'    		=> 'post',
			'post_status'     	=> 'publish',
			'suppress_filters'  => true,
		));
		mb_get_updated_order_array($results_slider_posts);

		$result['type'] = 'success';

		//check if this is an ajax call
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		      $result = json_encode($result);
		      echo $result;
		}

		die();

	}

	function del_slider_item_must_login() {
		die();
	}