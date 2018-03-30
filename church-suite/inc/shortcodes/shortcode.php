<?php
$path = get_template_directory() . '/inc/shortcodes/';
$files = glob($path . '/*.php');
foreach($files as $file)
	if( __FILE__ != basename($file) )
		include_once $file;
 ?>