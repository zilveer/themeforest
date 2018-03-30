<?php

$id = $_GET['id'];
$width = $_GET['w'];
$height = $_GET['h'];

$mime_type = get_post_mime_type($id);
$image_url = thb_image_get_size($id, array($width, $height));

$res = thb_read_url($image_url);

if( !empty($res) ) {
	switch ( $mime_type ) {
		case 'image/jpeg':
			header( 'Content-Type: image/jpeg' );
		case 'image/png':
			header( 'Content-Type: image/png' );
		case 'image/gif':
			header( 'Content-Type: image/gif' );
	}

	echo $res;
}
else {
	header( 'Content-Type: image/jpeg' );
	echo '';
}