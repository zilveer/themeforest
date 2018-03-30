<?php get_header();
	global $vbegy_sidebar_all;
	$blog_style = vpanel_options("home_display");
	get_template_part("loop-question","archive");
	vpanel_pagination();
get_footer();?>