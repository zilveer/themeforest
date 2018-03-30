<?php
session_start();
$pp_url = 'http://localhost/';

if(isset($_GET['reset']) && $_GET['reset'])
{
	session_destroy();
}
else
{
	if(isset($_GET['pp_skin_opt']))
	{
		$_SESSION['pp_skin'] = $_GET['pp_skin_opt'];
	}
	
	if(isset($_GET['pp_menu']))
	{
		$_SESSION['pp_menu'] = $_GET['pp_menu'];
	}
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>