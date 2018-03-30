<?php

$id = $_GET['id'];
$width = $_GET['w'];
$height = $_GET['h'];
$crop = 1; // $_GET['c'];

if( is_numeric($id) ) {
	thb_render_image( $id, $width, $height, $crop );
}
else {
	$image = wp_get_image_editor($id);
	if( !is_wp_error( $image ) ) {
		$image->resize($width, $height, $crop);
		$image->stream();
	}
}