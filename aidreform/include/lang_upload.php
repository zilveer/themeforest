<?php
if ( isset($_FILES["mofile"]) ) {
	require '../../../../wp-load.php';
	$target_path_mo = get_template_directory() . "/languages/" . $_FILES["mofile"]["name"][0];
	if (move_uploaded_file($_FILES["mofile"]["tmp_name"][0], $target_path_mo)) {
		chmod($target_path_mo, 0777);
	}
	echo "New Language Uploaded Successfully";
}
else {
	echo "Please select Mo file";
}
?>