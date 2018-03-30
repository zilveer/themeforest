<?php

if (isset($_GET['hash'])) {
	header("Content-Type: image/png");
	//***
	$hash= $_GET['hash'];
	$hash_string = substr($hash, 7, 5);

// Verification Image Background Selection

	$background = 'verify.png';

// Verification Image Variables

	$img_handle = imagecreatefrompng($background);
	$text_colour = imagecolorallocate($img_handle, 255, 255, 255);
	$font_size = 5;

	$size_array = getimagesize($background);
	$img_w = $size_array[0];
	$img_h = $size_array[1];

	$horiz = round(($img_w / 2) - ((strlen($hash_string) * imagefontwidth(5)) / 2), 1);
	$vert = round(($img_h / 2) - (imagefontheight($font_size) / 2));

// Make the Verification Image

	imagestring($img_handle, $font_size, $horiz, $vert, $hash_string, $text_colour);
	imagepng($img_handle);

// Destroy the Image to keep Server Space

	imagedestroy($img_handle);
}
