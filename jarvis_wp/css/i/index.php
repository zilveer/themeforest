<?php
// Include placeholder generator class
require('placeholder.class.php');

// Get variables from $_GET
$width           = isset($_GET['w']) ? trim($_GET['w']) : null;
$height          = isset($_GET['h']) ? trim($_GET['h']) : null;
$backgroundColor = isset($_GET['bgColor']) ? strtolower(trim($_GET['bgColor'])) : null;
$textColor       = isset($_GET['textColor']) ? strtolower(trim($_GET['textColor'])) : null;
$cache			 = isset($_GET['c']) && $_GET['c'] == 1 ? true : false;

try {
    $placeholder = new Placeholder();
    $placeholder->setWidth($width);
    $placeholder->setHeight($height);
	$placeholder->setCache($cache);
    if ($backgroundColor) $placeholder->setBackgroundColor($backgroundColor);
    if ($textColor) $placeholder->setTextColor($textColor);
    $placeholder->render();
} catch (Exception $e){
    die($e->getMessage());
}
