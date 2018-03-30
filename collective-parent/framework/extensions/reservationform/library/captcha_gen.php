<?php
session_start();

$width  = 120;
$height =  40;
$length =   5;

$baseList = '0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$code    = '';
$counter = 0;

$image = @imagecreate($width, $height) or die(__('Cannot initialize GD!', 'tfuse'));

for( $i=0; $i<10; $i++ ) {
    imageline($image, 
    mt_rand(0,$width), mt_rand(0,$height), 
    mt_rand(0,$width), mt_rand(0,$height), 
    imagecolorallocate($image, 155, 225, 237));
}

for( $i=0, $x=0; $i<$length; $i++ ) {
    $actChar = substr($baseList, rand(0, strlen($baseList)-1), 1);
    $x += 10 + mt_rand(0,10);
    imagechar($image, mt_rand(3,5), $x, mt_rand(5,20), $actChar, 
    imagecolorallocate($image, mt_rand(0,155), mt_rand(0,155), mt_rand(0,155)));
    $code .=strtolower($actChar);
}
   
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
$_SESSION['securityCode'.$_REQUEST['form_id']] = $code;


?>