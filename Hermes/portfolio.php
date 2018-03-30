<?php
/**
 * Template Name: Portfolio
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

session_start();

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

if(isset($_SESSION['pp_portfolio_style']))
{
	$pp_portfolio_style = $_SESSION['pp_portfolio_style'];
}
else
{
	$pp_portfolio_style = get_option('pp_portfolio_style');
}

if(empty($pp_portfolio_style))
{
	$pp_portfolio_style = '2';
}

include (TEMPLATEPATH . "/templates/template-portfolio-".$pp_portfolio_style.".php");

?>