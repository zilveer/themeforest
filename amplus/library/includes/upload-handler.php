<?php
// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
	if (file_exists($wpLoad)) {
		require_once($wpLoad);
		break;
	}
	$wpLoad = '../'.$wpLoad;
}

// get upload path
$wpUploadDir = wp_upload_dir();

$uploaddir = $wpUploadDir['path'] . '/';
$uploadname = basename($_FILES['uploadfile']['name']);
$uploadname = str_ireplace(" ", "_", $uploadname);

if(file_exists($uploaddir.$uploadname)) {
    $uploadname = time().$uploadname;
}
 
$uploadfile = $uploaddir.$uploadname;

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
  echo $uploadname;
} else {
  // WARNING! DO NOT USE "FALSE" STRING AS A RESPONSE!
  // Otherwise onSubmit event will not be fired
  echo "error";
}
