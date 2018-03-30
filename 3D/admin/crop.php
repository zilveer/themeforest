<?php
function iam_imgCrop($fileName, $width, $height)
{
	$filename = mb_strtolower($fileName, 'UTF-8');
	$w=$width; $h=$height;
	if(substr($fileName,-3) == 'jpg' or substr($fileName,-4) == 'jpeg' )
	{
		$image = imagecreatefromjpeg($filename);
		
			$crop = imagecreatetruecolor($w,$h);
			$w0 = imagesx($image);$h0 = imagesy($image);
			$x=floor($w0 / 2) - floor ($w / 2);
			$y=floor($h0 / 2) - floor($h / 2);
			imagecopy($crop, $image, 0, 0, $x, $y, $w, $h );
			header('Content-type: image/jpg');
			imagejpeg($crop);
			imagedestroy($crop);
	}
	else if( substr($fileName,-3) == 'png' )
	{
		$image = imagecreatefrompng($filename);
		$crop = imagecreatetruecolor($w,$h);
		$w0 = imagesx($image);$h0 = imagesy($image);
		$x=floor($w0 / 2) - floor ($w / 2);
		$y=floor($h0 / 2) - floor($h / 2);
		imagecopy($crop, $image, 0, 0, $x, $y, $w, $h );
		header('Content-type: image/png');
		imagepng($crop);
		imagedestroy($crop);
	}
	else if( substr($fileName,-3) == 'gif' )
	{
		$image = imagecreatefromgif($filename);
		$crop = imagecreatetruecolor($w,$h);
		$w0 = imagesx($image);$h0 = imagesy($image);
		$x=floor($w0 / 2) - floor ($w / 2);
		$y=floor($h0 / 2) - floor($h / 2);
		imagecopy($crop, $image, 0, 0, $x, $y, $w, $h );
		header('Content-type: image/gif');
		imagegif($crop);
		imagedestroy($crop);
	}
	else
	{ 
		echo 'Unknown format [jpg, jpeg, png, gif]';	
	}
}

iam_imgCrop($_GET['file'], $_GET['w'], $_GET['h']);
?>