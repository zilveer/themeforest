<?php 
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	
	$order = explode(',',$_GET['order']);
	$parent = $_GET['slideshow'];
	
	foreach($order as $key => $value) {
	  if($value == "") {
		unset($order[$key]);
	  }
	}
	$new_order = array_values($order); 

	$slide_require_query = 'SELECT * FROM `'.$wpdb->prefix.'dt-slides` WHERE `SLIDE_PARENT` = '.$parent;	
	$slides = $wpdb->get_results($slide_require_query);
	$slides_count = count($slides);

	for($i = 0; $i < $slides_count; $i++)
	{
		$slide_update_query = 'UPDATE `'.$wpdb->prefix.'dt-slides` SET `ORDER`='.$i.' WHERE `ID`='.$new_order[$i].';';
		$wpdb->get_results($slide_update_query);
	}
	
	echo '<div class="page-success">The slides were succesfully ordered.</div>';
?>