<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	$id = $_GET['id'];
	update_option('frontpage-order-'.$id,$_GET['order']); 
	echo '<div class="page-success">The front page elements were succesfully ordered.</div>';
?>