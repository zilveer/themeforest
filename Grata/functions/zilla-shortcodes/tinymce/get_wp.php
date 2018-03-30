<?php

if (file_exists('../../../../../../wp-load.php'))
{
	// Access WordPress
	require_once('../../../../../../wp-load.php');
}
elseif (file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-load.php'))
{
	require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
}

?>