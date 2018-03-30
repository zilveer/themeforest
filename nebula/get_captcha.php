<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
session_start();

if(isset($_GET['check']) && !empty($_GET['check']))
{
	if($_GET['captcha-code']==$_SESSION['random_number'])
	{
		echo 'true';
	}
	else
	{
		echo __( 'Please enter correct captcha text', THEMEDOMAIN );
	}
		
	exit;
}
else
{
	$word_1 = '';
	$word_2 = '';
	
	for ($i = 0; $i < 4; $i++) 
	{
		$word_1 .= chr(rand(97, 122));
	}
	for ($i = 0; $i < 4; $i++) 
	{
		$word_2 .= chr(rand(97, 122));
	}
	
	$_SESSION['random_number'] = $word_1.' '.$word_2;
	
	$dir = '/images/';
	
	$image = imagecreatetruecolor(165, 50);
	
	$font = "recaptchaFont.ttf"; // font style
	
	$color = imagecolorallocate($image, 0, 0, 0);// color
	
	$white = imagecolorallocate($image, 255, 255, 255); // background color white
	
	imagefilledrectangle($image, 0,0, 709, 99, $white);
	
	imagettftext ($image, 22, 0, 5, 30, $color, $dir.$font, $_SESSION['random_number']);
	
	header("Content-type: image/png");
	
	imagepng($image);  
}
?>