<?php
session_start();
$pp_url = 'http://themes.themegoods.com/ares_wp/';
//$pp_url = 'http://localhost/';

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
}

if(isset($_GET['pp_menu_style']))
{
	$_SESSION['pp_menu_style'] = $_GET['pp_menu_style'];
}

if(isset($_GET['pp_blog_layout']))
{
	$_SESSION['pp_blog_layout'] = $_GET['pp_blog_layout'];
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>