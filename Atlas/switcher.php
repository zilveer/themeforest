<?php
session_start();
$pp_url = 'http://www.gallyapp.com/tf_themes/atlas_wp/';

if(isset($_GET['pp_menu_style']))
{
	$_SESSION['pp_menu_style'] = $_GET['pp_menu_style'];
}

if(isset($_GET['pp_homepage_style']))
{
	$_SESSION['pp_homepage_style'] = $_GET['pp_homepage_style'];
	header( 'Location: '.$pp_url ) ;
	exit;
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>