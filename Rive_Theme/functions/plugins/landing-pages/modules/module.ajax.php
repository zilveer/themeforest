<?php
add_action( 'admin_init', 'lp_register_admin_ajax' );

function lp_register_admin_ajax() {
	//clear stats button
	wp_enqueue_script( 'lp-admin-clear-stats-ajax-request', LANDINGPAGES_URLPATH . 'js/ajax.clearstats.js', array( 'jquery' ) );
	wp_localize_script( 'lp-admin-clear-stats-ajax-request', 'ajaxadmin', array( 'reseturl' => admin_url( 'admin-ajax.php' ) ) );

	//pause and play lander buttons
	wp_enqueue_script( 'lp-admin-split-test-ajax-request', LANDINGPAGES_URLPATH . 'js/ajax.split-testing.js', array( 'jquery' ) );
	wp_localize_script( 'lp-admin-split-test-ajax-request', 'lp_st_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

//***********ADDS AJAX FOR 'SPLIT TESTING' BUTTONS******************/

add_action( 'wp_ajax_lp_pause_lander', 'lp_pause_lander_callback' );
add_action( 'wp_ajax_nopriv_lp_pause_lander', 'lp_pause_lander_callback' );

function lp_pause_lander_callback() {

	$group_id = $_POST['group_id'];
	$lp_id = $_POST['lp_id'];
	$content = get_post_field( 'post_content', $group_id );
	$data = json_decode( $content, true );
	$data[$lp_id]['status']='paused';
	print_r( $data );
	$data = json_encode( $data );

	$post = array(
		'ID' =>  $group_id,
		'post_content' => $data
	);

	return wp_update_post( $post );
	die();
}

add_action( 'wp_ajax_lp_play_lander', 'lp_play_lander_callback' );
add_action( 'wp_ajax_nopriv_lp_play_lander', 'lp_play_lander_callback' );

function lp_play_lander_callback() {

	$group_id = $_POST['group_id'];
	$lp_id = $_POST['lp_id'];
	$content = get_post_field( 'post_content', $group_id );
	$data = json_decode( $content, true );
	$data[$lp_id]['status']='active';

	$data = json_encode( $data );

	$post = array(
		'ID' =>  $group_id,
		'post_content' => $data
	);

	return wp_update_post( $post );
	die();
}

//***********ADDS AJAX FOR 'CLEAR STATS' BUTTON******************/

add_action( 'wp_ajax_lp_clear_stats', 'lp_clear_stats_callback' );
add_action( 'wp_ajax_nopriv_lp_clear_stats', 'lp_clear_stats_callback' );

function lp_clear_stats_callback() {
	//echo "hi";
	$landing_page_id = $_POST['lp_id'];
	update_post_meta( $landing_page_id, 'lp_page_views_count', 0 );
	update_post_meta( $landing_page_id, 'lp_page_conversions_count', 0 );
	do_action( 'lp_clear_stats', $landing_page_id );
	echo $landing_page_id;
	die();
}

//***********ADDS AJAX FOR 'SPLIT TESTING CLONE' BUTTON******************/

add_action( 'wp_ajax_lp_st_clone', 'lp_st_clone_callback' );
add_action( 'wp_ajax_nopriv_lp_st_clone', 'lp_st_clone_callback' );

function lp_st_clone_callback() {
	$lp_id = $_POST['lp_id'];
	$clone_id = lp_duplicate_post_create_duplicate( $lp_id );
	lp_clone_lp_groups( $lp_id, $clone_id );
	echo $clone_id;
	die();
}

//***********ADDS AJAX TO RECORD CONVERSIONS AND IMPRESSIONS******************/

add_action( 'wp_enqueue_scripts', 'lp_register_ajax' );
function lp_register_ajax() {
	$current_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]."/";
	$current_url = trim( str_replace( '//', '/', $current_url ) );
	$standardize_form = get_option( 'main-landing-page-auto-format-forms' , 1 );

	// embed the javascript file that makes the AJAX request
	wp_enqueue_script( 'lp-ajax-request', LANDINGPAGES_URLPATH . 'js/ajax.tracking.js', array( 'jquery' ), '', true );
	wp_localize_script( 'lp-ajax-request', 'myajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'current_url' =>  $current_url, 'standardize_form' =>  $standardize_form ) );
}

add_action( 'wp_ajax_lp_record_conversion', 'lp_record_conversion_callback' );
add_action( 'wp_ajax_nopriv_lp_record_conversion', 'lp_record_conversion_callback' );

function lp_record_conversion_callback() {
	global $wpdb; // this is how you get access to the database
	global $user_ID;
	$global_record_admin_actions = get_option( 'lp_global_record_admin_actions', '' );
	$role = get_userdata( $user_ID );
	//echo " ".$role->user_level." ";
	//if ($role->user_level==10)
	//{
	//print 1;
	//die();
	//}
	//else
	//{
	//echo "there";
	$page_id = lp_url_to_postid( $_POST['current_url'] );
	lp_set_conversions( $page_id );
	print $page_id;
	die(); // this is required to return a proper result
	//}

}

add_action( 'wp_ajax_lp_record_impression', 'lp_record_impression_callback' );
add_action( 'wp_ajax_nopriv_lp_record_impression', 'lp_record_impression_callback' );

function lp_record_impression_callback() {
	global $wpdb; // this is how you get access to the database
	global $user_ID;
	$global_record_admin_actions = get_option( 'lp_global_record_admin_actions', '' );
	$role = get_userdata( $user_ID );
	//echo " ".$role->user_level." ";die();
	//if ($role->user_level==10)
	//{
	//print 1;
	//die();
	//}
	//else
	//{
	//echo "there";
	if ( !lp_determine_spider() ) {
		//PRINT trim($_POST['current_url']);
		$page_id = lp_url_to_postid( trim( $_POST['current_url'] ) );
		//print $page_id;
		lp_set_page_views( $page_id );

	}

	print $page_id;
	die();
	//}

}


?>
