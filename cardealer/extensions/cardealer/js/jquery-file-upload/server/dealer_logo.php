<?php
$user_ID = get_current_user_id();
if (!$user_ID) {
	exit;
}
$targetFolder = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_ID;
@mkdir($targetFolder, 0755);
$targetFolder.='/logo';
@mkdir($targetFolder, 0755);

if (!empty($_FILES)) {
	$tempFile = $_FILES['files']['tmp_name'][0];
	$fileParts = pathinfo($_FILES['files']['name'][0]);

	$new_file_name = "logo." . $fileParts['extension'];
	$targetFile = $targetFolder . '/' . $new_file_name;

	// Validate the file type
	$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions

	if (in_array($fileParts['extension'], $fileTypes)) {
		move_uploaded_file($tempFile, $targetFile);
		TMM_Helper::tmm_resize_image($targetFile, 200, 200, true, null, null, 100);
	}
}

if (isset($_GET['delete'])) {
	if ($_GET['delete'] == 'true') {
		TMM_Helper::delete_dir($targetFolder);
	}
	exit;
}

$user_logo = TMM_Cardealer_User::get_user_logo_url($user_ID);
if (!empty($user_logo)) {
	$response = array();
	$script_url = $_SERVER['PHP_SELF']; //for IIS servers
	if (isset($_SERVER['SCRIPT_URL'])) {
		$script_url = $_SERVER['SCRIPT_URL'];
	}
	$response['files'] = array(
		array(
			'url' => $user_logo,
			'thumbnailUrl' => $user_logo . '?tmp=' . uniqid(),
			'name' => 'logo',
			'type' => '',
			'size' => '',
			'deleteUrl' => $script_url . '?action=app_cardealer_upload_cardealer_logo&delete=true',
			'deleteType' => 'GET',
		)
	);
	echo json_encode($response);
}




