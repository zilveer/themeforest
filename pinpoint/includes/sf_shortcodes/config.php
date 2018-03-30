<?php 
	$absolute_path = __FILE__;
	$file_path = explode( 'wp-content', $absolute_path );
	$wp_path = $file_path[0];
	
	require_once( $wp_path . '/wp-load.php' );
?>