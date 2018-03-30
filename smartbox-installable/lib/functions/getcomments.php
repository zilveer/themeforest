<?php

$wpLocation = str_replace("wp-content/themes/smartbox/lib/functions", "", dirname(__FILE__));

require_once( $wpLocation . 'wp-load.php' ) ;


if (isset($_POST['id'])){
		
	global $post, $wp_query;
	
	$args = array(
		'post_id' => $_POST['id'], // use post_id, not post_ID
		'order' => 'ASC'
	);
		
	$wp_query->comments = get_comments( $args );
    wp_list_comments( array('callback'=>'designaretheme_comment'));
			
} 

?>