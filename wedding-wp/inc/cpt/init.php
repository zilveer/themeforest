<?php
$path = dirname(__FILE__);
$files = glob($path . '/*.php');

foreach($files as $file)
	if( __FILE__ != basename($file) )
		include_once $file;
		
include_once 'metaboxes/init.php';

 ?>