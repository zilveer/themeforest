<?php
if($photo_set_hash && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
	global $sitepress;
	$photo_set_hash = icl_object_id( $photo_set_hash, 'car', true, $sitepress->get_default_language() );
}

$args = array(
	'is_new_car' => 0,
	'photo_set_hash' => $photo_set_hash,
	'car_cover_image' => $car_cover_image,
);
TMM_Car_Image::get_car_image_upload_template($args);
