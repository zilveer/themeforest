<?php
session_start();
$pp_url = 'http://www.gallyapp.com/tf_themes/hermes_wp/';

if(isset($_GET['reset']) && $_GET['reset'])
{
	session_destroy();
}
else
{
	if(isset($_GET['pp_bg_color']))
	{
		$_SESSION['pp_bg_color'] = $_GET['pp_bg_color'];
	}
	
	if(isset($_GET['pp_header_bg']))
	{
		$_SESSION['pp_header_bg'] = $_GET['pp_header_bg'];
	}
	
	if(isset($_GET['pp_bg_pattern']))
	{
		$_SESSION['pp_bg_pattern'] = $_GET['pp_bg_pattern'];
	}
	
	if(isset($_GET['pp_theme_style']))
	{
		$_SESSION['pp_theme_style'] = $_GET['pp_theme_style'];
	}
	
	if(isset($_GET['pp_font']))
	{
		$_SESSION['pp_font'] = $_GET['pp_font'];
	}
	
	if(isset($_GET['pp_body_font']))
	{
		$_SESSION['pp_body_font'] = $_GET['pp_body_font'];
	}
	
	if(isset($_GET['pp_slider_effect']))
	{
		$_SESSION['pp_slider_effect'] = $_GET['pp_slider_effect'];
	}
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>