<?php

$width = isset($_GET['width'])?(int)$_GET['width']:100;
$height = isset($_GET['height'])?(int)$_GET['height']:50;
if($width > 0 && $height > 0){
	$image = imagecreatetruecolor( $width, $height );
	imagealphablending($image, true);
	imagesavealpha($image, true);
	imagefill($image,0,0,0x7fff0000);
	header( "Content-type: image/png" );
	imagepng( $image );
}