<?php
session_start();
$pp_url = 'http://themes.themegoods.com/core_wp/';

if(isset($_GET['pp_portfolio_style']))
{
	$_SESSION['pp_portfolio_style'] = $_GET['pp_portfolio_style'];
	header( 'Location: '.$pp_url.'?gallery=fashion-2012' ) ;
	exit;
}

if(isset($_GET['pp_homepage_slideshow_style']))
{
	$_SESSION['pp_homepage_slideshow_style'] = $_GET['pp_homepage_slideshow_style'];
	header( 'Location: '.$pp_url ) ;
	exit;
}

if(isset($_GET['pp_skin']))
{
	$_SESSION['pp_skin'] = $_GET['pp_skin'];
	header( 'Location: '.$pp_url ) ;
	exit;
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>