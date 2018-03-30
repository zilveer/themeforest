<?php
add_action( 'wp_ajax_qoon_ajax_request', 'qoon_ajax_request' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request', 'qoon_ajax_request' );
function qoon_ajax_request() {
		wp_reset_postdata();
		global $post;
		if ($_GET['type'] =='post'){
		$new_post_id = get_post_meta($_GET['menu_item'], '_menu_item_object_id', true );
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($new_post_id) );
		}else{
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($_GET['menu_item']) );
		}
		$result['new_posts']['url'] = $feat_image;
		
		
		
		wp_reset_postdata();
		print json_encode($result);
		die();
	}


add_action( 'wp_ajax_qoon_ajax_request_c', 'qoon_ajax_request_c' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_c', 'qoon_ajax_request_c' );
function qoon_ajax_request_c() {
		wp_reset_postdata();
		global $post;
		$post = get_post($_GET['id']);
		$feat_image = wp_get_attachment_url( get_post_thumbnail_id($_GET['id']) );
		$previd = $_GET['last'];
		$nextid = $_GET['first'];
		
		if($_GET['tags'] !="all"){
			$previous_post = get_previous_post(true,"","portfolio-tags");
			$next_post = get_next_post(true,"","portfolio-tags");
		}else{
			$previous_post = get_previous_post();
			$next_post = get_next_post();
		}

		if($previous_post!=''){
			$nextid = $previous_post->ID;
		};
		if($next_post!=''){
			$previd = $next_post->ID;
		};
		
		$title  = get_the_title($_GET['id']);
		$date = get_the_date( get_option( 'date_format' ), $_GET['id']);
		$cat = get_the_terms( $_GET['id'], 'portfolio-category' );
		if (isset($cat) && ($cat!='')){
			$cat_name = ''; 
			foreach($cat  as $vallue=>$key){
				$cat_name  .= ''.$key->name.', ';
			}
		};
		
		
		$result['new_posts']['cur'] = $_GET['id'];
		$result['new_posts']['url'] = $feat_image;
		$result['new_posts']['prev'] = $previd;
		$result['new_posts']['next'] = $nextid;
		$result['new_posts']['title'] = $title;
		$result['new_posts']['date'] = $date;
		$result['new_posts']['cat'] = substr($cat_name, '0', '-2');
		$result['new_posts']['descr'] = get_post_meta($_GET['id'], 'port-description', true);
		$result['new_posts']['details'] = get_permalink($_GET['id']);
		
		
		
		wp_reset_postdata();
		print json_encode($result);
		die();
	}




add_action( 'wp_ajax_qoon_ajax_request_m', 'qoon_ajax_request_m' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_m', 'qoon_ajax_request_m' );
function qoon_ajax_request_m() {
		
	wp_reset_postdata();
	global $post;
	$post = get_post($_GET['id']);
	$previous_post = get_previous_post();
	$previd = $_GET['prev'];
	$nextid = $previous_post->ID;
	
	
	$cur_feat_image = wp_get_attachment_url( get_post_thumbnail_id($_GET['id']) );
	$next_feat_image = wp_get_attachment_url( get_post_thumbnail_id($previd) );
	$prev_feat_image = wp_get_attachment_url( get_post_thumbnail_id($nextid) );
	
	$result['new_posts']['cur'] = $cur_feat_image;
	$result['new_posts']['prev'] = $next_feat_image;
	$result['new_posts']['next'] = $prev_feat_image;
	$result['new_posts']['nextid'] = $nextid;
	
	
	wp_reset_postdata();
	print json_encode($result);
	die();
}



add_action( 'wp_ajax_qoon_ajax_request_m_load', 'qoon_ajax_request_m_load' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_m_load', 'qoon_ajax_request_m_load' );
function qoon_ajax_request_m_load() {
		
	wp_reset_postdata();
	global $post;
	$post = get_post($_GET['id']);
	$previd = $_GET['last'];
	$nextid = $_GET['first'];
	
	if($_GET['tags'] !="all"){
		$previous_post = get_previous_post(true,"","portfolio-tags");
		$next_post = get_next_post(true,"","portfolio-tags");
	}else{
		$previous_post = get_previous_post();
		$next_post = get_next_post();
	}
	if($previous_post!=''){
		$nextid = $previous_post->ID;
	};
	if($next_post!=''){
		$previd = $next_post->ID;
	};
	
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($_GET['id']) );
	$title  = get_the_title($_GET['id']);
	$date = get_the_date( get_option( 'date_format' ), $_GET['id']);
	$cat = get_the_terms( $_GET['id'], 'portfolio-category' );
	if (isset($cat) && ($cat!='')){
		$cat_name = ''; 
		foreach($cat  as $vallue=>$key){
			$cat_name  .= ''.$key->name.', ';
		}
	};
	
	
	
	
	$result['new_posts']['url'] = $feat_image;
	$result['new_posts']['prev'] = $previd;
	$result['new_posts']['next'] = $nextid;
	$result['new_posts']['title'] = $title;
	$result['new_posts']['date'] = $date;
	$result['new_posts']['cat'] = substr($cat_name, '0', '-2');
	$result['new_posts']['descr'] = get_post_meta($_GET['id'], 'port-description', true);
	$result['new_posts']['details'] = get_permalink($_GET['id']);
	
	
	wp_reset_postdata();
	print json_encode($result);
	die();
}




?>