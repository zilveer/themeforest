<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

get_header();

if(have_posts())
{
	the_post();
	the_content();
}

get_footer();
