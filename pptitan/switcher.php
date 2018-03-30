<?php
session_start();
$pp_url = 'http://localhost';
//$pp_url = 'http://themes.themegoods.com/keres_wp/';

if(isset($_GET['pp_homepage_style']))
{
	$_SESSION['pp_homepage_style'] = $_GET['pp_homepage_style'];
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$pp_url ) ;
?>