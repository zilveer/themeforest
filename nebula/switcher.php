<?php
session_start();
$pp_url = 'http://localhost';
//$pp_url = 'http://themes.themegoods.com/keres_wp/';

if(isset($_GET['pp_header_style']))
{
	$_SESSION['pp_header_style'] = $_GET['pp_header_style'];
}

if(isset($_GET['pp_layout']))
{
	$_SESSION['pp_layout'] = $_GET['pp_layout'];
}

if(isset($_GET['pp_boxed_bg_image']))
{
	$_SESSION['pp_boxed_bg_image'] = $_GET['pp_boxed_bg_image'];
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>