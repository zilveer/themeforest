<?php

add_action('wp_ajax_pexeto_upload', 'pexeto_upload_file');


function pexeto_upload_file(){

	//verify the AJAX request referer, will die if the nonce is invalid
	check_ajax_referer($_GET['nonce_name'], 'pexeto_nonce', true);

	if(current_user_can('edit_posts')){
		$uploads_dir=wp_upload_dir();
		 
		$uploaddir = $uploads_dir['path'];
		$uploadname=basename($_FILES['pexetofile']['name']);

		if(file_exists($uploaddir.'/'.$uploadname)){
			$uploadname=time().$uploadname;
		}

		$uploadfile = $uploaddir.'/'.$uploadname;
		 
		 
		if (move_uploaded_file($_FILES['pexetofile']['tmp_name'], $uploadfile)) {
			echo $uploadname;
			exit;
		} else {
		  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
		  // Otherwise onSubmit event will not be fired
		  die("error");
		}
	}else{
		die('you don\'t have permission to upload a file');
	}
}


