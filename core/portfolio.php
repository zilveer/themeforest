<?php
/**
 * Template Name: Video Portfolio
 * The main template file for display video portfolio page.
 *
 * @package WordPress
*/

session_start();

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

include (TEMPLATEPATH . "/templates/template-portfolio-video-flow.php");
?>