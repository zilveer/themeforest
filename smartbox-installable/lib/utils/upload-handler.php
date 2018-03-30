<?php

$path = dirname(__FILE__);
$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'win' : 'other';
$abspath = ($os === "win") ? substr($path, 0, strpos($path, "\wp-content"))."\wp-load.php" : substr($path, 0, strpos($path, "/wp-content"))."/wp-load.php";
require_once($abspath);

if(current_user_can('edit_posts')){
	$uploads_dir=wp_upload_dir();
	 
	$uploaddir = $uploads_dir['path'];
	$uploadname=basename($_FILES['designarefile']['name']);
	
	if(file_exists($uploaddir.'/'.$uploadname)){
		$uploadname=urlencode(time().$uploadname);
	}
	$uploadfile = $uploaddir.'/'.$uploadname;
	 
	 
	if (move_uploaded_file($_FILES['designarefile']['tmp_name'], $uploadfile)) {
	  echo $uploadname;
	} else {
	  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
	  // Otherwise onSubmit event will not be fired
	  echo "error";
	}
} else {
	echo 'you don\'t have permission to access this file';
}

?>