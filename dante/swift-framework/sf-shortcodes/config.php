<?php 
	if (!function_exists('sf_wp_path')) {
		function sf_wp_path() {
			$wp_path = "";
			if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/")) {
				$wp_path = preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
			} else {
				$wp_path = preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
			}
			
			if (strpos($wp_path, 'interface.php') !== FALSE) {
				$absolute_path = __FILE__;
				$file_path = explode( 'wp-content', $absolute_path );
				$wp_path = $file_path[0];
			}
			
			return $wp_path;	
		}
	}
	
	$wp_path = sf_wp_path();
	
	if (strpos($wp_path, '/') !== false) {
		require_once( $wp_path . '/wp-load.php' );
	} else {
		require_once( $wp_path . '\wp-load.php' );
	}
?>