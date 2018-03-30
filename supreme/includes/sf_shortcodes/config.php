<?php
	$wp_load = "../wp-load.php";
	$i = 0;
	
	while (!file_exists($wp_load) && $i++ < 10) {
		$wp_load = "../$wp_load";
	}
	
	require($wp_load);
?>