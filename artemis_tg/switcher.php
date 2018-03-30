<?php
session_start();
$pp_url = 'http://themes.themegoods2.com/artemis/';

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
}

if(isset($_GET['pp_homepage_style']))
{
	$_SESSION['pp_homepage_style'] = $_GET['pp_homepage_style'];
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>