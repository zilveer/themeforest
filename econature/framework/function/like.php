<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.2.1
 * 
 * Likes Operator
 * Changed by CMSMasters
 * 
 */


$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($parse_uri[0] . 'wp-load.php');


$post_ID = $_POST['id'];


$ip = $_SERVER['REMOTE_ADDR'];

$ip_name = str_replace('.', '-', $ip);


if ($post_ID != '') {
	$likes = (get_post_meta($post_ID, 'cmsms_likes', true) != '') ? get_post_meta($post_ID, 'cmsms_likes', true) : '0';
	
	
	$ipPost = new WP_Query(array( 
		'post_type' => 		'cmsms_like', 
		'post_status' => 	'draft', 
		'post_parent' => 	$post_ID, 
		'name' => 			$ip_name 
	));
	
	
	$ipCheck = $ipPost->posts;
	
	
    if (isset($_COOKIE['like-' . $post_ID]) || count($ipCheck) != 0) {
		echo $likes;
	} else {
		$plusLike = $likes + 1;
		
		
		update_post_meta($post_ID, 'cmsms_likes', $plusLike);
		
		
		setcookie('like-' . $post_ID, time(), time() + 31536000, '/');
		
		
		wp_insert_post(array( 
			'post_type' => 		'cmsms_like', 
			'post_status' => 	'draft', 
			'post_parent' => 	$post_ID, 
			'post_name' => 		$ip_name, 
			'post_title' => 	$ip 
		));
		
		
		echo $plusLike;
	}
}

