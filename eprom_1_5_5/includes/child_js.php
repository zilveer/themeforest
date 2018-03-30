<?php

$_GET = array_map('strip_tags', $_GET);

$wp_load = dirname(__FILE__);
 
for ($i = 0; $i < 8; $i++) {
	$wp_load = dirname($wp_load);
	if (file_exists($wp_load . '/wp-load.php')) break;
	if ($i == 7) { 
	    echo 'Error: wp-load.php doesn\'t exists';
		die();
	}
}

require_once($wp_load . '/wp-load.php');

global $r_option;

header('Content-type: text/javascript');

echo $r_option['custom_js']; 
?>
